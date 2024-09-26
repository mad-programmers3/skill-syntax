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
    protected $taskPrefix;

    // Constructor to initialize the model
    public function __construct($model, $taskPrefix = false)
    {
        $this->model = $model;
        $this->modelName = basename(str_replace('\\', '/', get_class($this->model)));
        $this->taskPrefix = $taskPrefix;
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
    public function store(Request $request, $callBackBefore = false, $callBackAfter = false)
    {
        return $this->customHandleRequest(function () use ($request, $callBackBefore, $callBackAfter) {

            if (is_callable($callBackBefore)) call_user_func($callBackBefore, $request);

            $record = $this->model->create($request->all()); // Use instance method

            // if callable then call the callBack() with passing $record
            if (is_callable($callBackAfter)) call_user_func($callBackAfter, $record);

            return response()->json(['success' => true, 'result' => $record, 'message' => $this->modelNameFormatted() . ' created successfully.']);
        }, 'add');
    }


    // for update old record
    public function update(Request $request, $id, $callBack = false)
    {
        return $this->customHandleRequest(function () use ($request, $id, $callBack) {
            $record = $this->model->findOrFail($id); // Use instance method
            $record->fill($request->all());
            $record->save(); // Use save() instead of update()

            // if callable then call the callBack()
            if (is_callable($callBack)) call_user_func($callBack);

            return response()->json(['success' => true, 'message' => $this->modelNameFormatted() . ' updated successfully.', 'status' => 2000]);
        }, 'edit');
    }


    // for delete old record
    public function destroy($id, $callBack = false)
    {
        return $this->customHandleRequest(function () use ($id, $callBack) {
            // Fetch the record by its ID
            $record = $this->model->where('id', $id)->first();

            if ($record) {
                // Delete the record
                $record->delete();
                // if callable then call the callBack() with passing $record
                if (is_callable($callBack)) call_user_func($callBack, $record);

                return response()->json(['result' => $record, 'success' => true, 'message' => $this->modelNameFormatted() . ' deleted successfully.', 'status' => 2000]);
            }

            return response()->json(['success' => false, 'message' => $this->modelNameFormatted() . ' not found.' ]);
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


    private function modelNameFormatted()
    {
        /************************************
         *  subCategory => sub Category     *
         *  SubCategory => Sub Category     *
         * **********************************/

        // Use preg_replace to add a space before each uppercase letter (except the first letter)
        return preg_replace('/(?<!^)([A-Z])/', ' $1', $this->modelName);
    }

    // returns lower and underscored replaced with space
    private function modelNameLwrUdr()
    {
        /************************************
         *  sub Category => sub_category     *
         *  Sub Category => sub_category     *
         * **********************************/
        return strtolower(str_replace(' ', '_', $this->modelNameFormatted()));
    }

    private function customHandleRequest($callback, $task = false)
    {
        $moduleNameLwr = $this->taskPrefix ? $this->taskPrefix : $this->modelNameLwrUdr(); // task prefix

        return $this->handleRequest($callback, $task, $moduleNameLwr);
    }
}
