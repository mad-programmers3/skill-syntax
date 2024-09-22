<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Supports\Helper;
use Illuminate\Http\Request;

class DatabaseCrudController extends Controller
{
    use Helper;

    protected $model;
    protected $modelName;

    // Constructor to initialize the model
    public function __construct($model)
    {
        $this->model = $model;
        $this->modelName = basename(str_replace('\\', '/', get_class($this->model)));
    }

    // return all records
    public function index($with = [])
    {
        return $this->customHandleRequest(function () use ($with) {
            $query = $this->model->query();
            foreach ($with as $w) {
                if ($w) $query->with($w);
            }
            $data = $query->get();


            return response()->json(['result' => $data, 'status' => 2000], 200);
        }, 'view');
    }

    // for insert new record
    public function store(Request $request)
    {
        return $this->customHandleRequest(function () use ($request) {
            $this->model->create($request->all()); // Use instance method
            return response()->json(['success' => true, 'message' => $this->modelNameFormatted() . ' created successfully.']);
        }, 'add');
    }


    // for update old record
    public function update(Request $request, $id)
    {
        return $this->customHandleRequest(function () use ($request, $id) {
            $record = $this->model->findOrFail($id); // Use instance method
            $record->fill($request->all());
            $record->save(); // Use save() instead of update()

            return response()->json(['success' => true, 'message' => $this->modelNameFormatted() . ' updated successfully.']);
        }, 'edit');
    }


    // for delete old record
    public function destroy($id)
    {
        return $this->customHandleRequest(function () use ($id) {
            $record = $this->model->where('id', $id)->first(); // Use instance method

            if ($record) {
                $record->delete();
                return response()->json(['success' => true, 'message' => $this->modelNameFormatted() . ' deleted successfully.']);
            }
            return response()->json(['success' => false, 'message' => $this->modelNameFormatted() . ' not found.']);
        }, 'delete');
    }

    // check the given title is it unique or not
    public function checkTitle(Request $request)
    {
        return $this->handleRequest(function () use ($request) {
            $id = $request->input('id');
            $title = $request->input('title');
            $exists = $this->model->where('title', $title)->where('id', '!=', $id)->exists(); // Use instance method

            return response()->json(['isUnique' => !$exists]);
        });
    }



    private function modelNameFormatted() {
        /************************************
         *  subCategory => sub Category     *
         *  SubCategory => Sub Category     *
         * **********************************/

        // Use preg_replace to add a space before each uppercase letter (except the first letter)
        return preg_replace('/(?<!^)([A-Z])/', ' $1', $this->modelName);
    }

    // returns lower and underscored replaced with space
    private function modelNameLwrUdr() {
        /************************************
         *  sub Category => sub_category     *
         *  Sub Category => sub_category     *
         * **********************************/
        return strtolower(str_replace(' ', '_', $this->modelNameFormatted()));
    }

    private function customHandleRequest($callback, $task = false) {
        $moduleNameLwr = $this->modelNameLwrUdr();

        return $this->handleRequest($callback, $task, $moduleNameLwr);
    }
}
