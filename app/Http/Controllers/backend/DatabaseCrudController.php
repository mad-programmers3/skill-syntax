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

    /**
     * Initializes a new instance of the class with the specified model and optional task prefix.
     *
     * @param mixed $model The model instance to be used.
     * @param bool $taskPrefix (optional) A flag indicating whether to use a task prefix.
     */
    public function __construct($model, $taskPrefix = false)
    {
        $this->model = $model;
        $this->modelName = basename(str_replace('\\', '/', get_class($this->model)));
        $this->taskPrefix = $taskPrefix;
    }

    /**
     * Retrieve all records with optional eager loading and callback manipulation.
     *
     * @param array $with An array of relationships to eager load.
     * @param callable|bool $callBackBefore A callback function to manipulate the query before execution.
     * @param callable|bool $callBackAfter A callback function to manipulate the data after retrieval.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the retrieved data and status.
     */
    public function index($with = [], $callBackBefore = false, $callBackAfter = false)
    {
        return $this->customHandleRequest(function () use ($with, $callBackBefore, $callBackAfter) {
            $query = $this->model->query();

            // call callback for manipulate query if needed
            if (is_callable($callBackBefore)) call_user_func($callBackBefore, $query);

            foreach ($with as $w)
                if ($w) $query->with($w);

            $data = $query->get();

            // after callback for manipulate the data
            if (is_callable($callBackAfter)) call_user_func($callBackAfter, $data);

            return response()->json(['result' => $data, 'status' => 2000], 200);
        }, 'view');
    }


    /**
     * Show a specific record by its ID, optionally including related models
     * and executing callbacks before and after the query.
     *
     * @param int $id The ID of the record to retrieve.
     * @param array $with An array of related models to include in the query.
     * @param callable|bool $callBackBefore Optional callback to manipulate the query before execution.
     * @param callable|bool $callBackAfter Optional callback to manipulate the record after retrieval.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the record or an error message.
     */
    public function show($id, $with = [], $callBackBefore = false, $callBackAfter = false)
    {
        return $this->customHandleRequest(function () use ($id, $with, $callBackBefore, $callBackAfter) {
            // Fetch the record by its ID
            $query = $this->model->query();

            // call callback for manipulate query if needed
            if (is_callable($callBackBefore)) call_user_func($callBackBefore, $query);

            foreach ($with as $w)
                if ($w) $query->with($w);

            $record =    $query->find($id); // Use find() to get the item or null if not found

            // If the record exists, return it with a success message
            if ($record) {
                // after callback for manipulate the record
                if (is_callable($callBackAfter)) call_user_func($callBackAfter, $record);

                return response()->json(['result' => $record, 'status' => 2000], 200);
            }

            // If the record is not found, return an error message
            return response()->json(['success' => false, 'message' => $this->modelNameFormatted() . ' not found.'], 404);
        }, 'view');
    }

    /**
     * Store a new record in the database.
     *
     * This method handles the creation of a new record using the given request data.
     * Optionally, callback functions can be passed to execute custom logic
     * before and after the record is created.
     *
     * @param \Illuminate\Http\Request $request The incoming request containing the data to be stored.
     * @param bool|callable $callBackBefore Optional callback to be executed before the record creation.
     * @param bool|callable $callBackAfter Optional callback to be executed after the record creation.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the newly created record.
     */
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



    /**
     * Updates a record in the database with the provided request data.
     *
     * Optionally allows for callback functions to be executed before and/or after
     * the record is updated. If provided, the before callback is executed before
     * the record is fetched and updated, and the after callback is executed after
     * the record is saved.
     *
     * @param \Illuminate\Http\Request $request - The incoming request containing the updated data.
     * @param int $id - The ID of the record to update.
     * @param callable|bool $callBackBefore - A callback to be executed before the update, default is false.
     * @param callable|bool $callBackAfter - A callback to be executed after the update, default is false.
     *
     * @return \Illuminate\Http\JsonResponse - JSON response indicating success or failure.
     */
    public function update(Request $request, $id, $callBackBefore = false, $callBackAfter = false)
    {
        return $this->customHandleRequest(function () use ($request, $id, $callBackBefore, $callBackAfter) {

            if (is_callable($callBackBefore)) call_user_func($callBackBefore, $request);

            $oldRecord = $this->model->findOrFail($id); // Use instance method
            $newRecord = clone $oldRecord; // Clone the old record to preserve the old data
            $newRecord->fill($request->all());
            $newRecord->save(); // Use save() instead of update()

            // if callable then call the callBack()
            if (is_callable($callBackAfter)) call_user_func($callBackAfter, $newRecord, $oldRecord);

            return response()->json(['success' => true, 'message' => $this->modelNameFormatted() . ' updated successfully.', 'status' => 2000]);
        }, 'edit');
    }



    /**
     * Deletes a record by its ID.
     *
     * @param int $id The ID of the record to be deleted.
     * @param callable|bool $callBack Optional callback function to be called after deletion, passing the deleted record.
     * @return \Illuminate\Http\JsonResponse JSON response indicating success or failure of the deletion.
     */
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


    /**
     * Check if the title is unique for the given ID.
     *
     * @param Request $request The request containing the title and ID to check.
     * @return Boolean Indicates whether the title is unique.
     */
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
