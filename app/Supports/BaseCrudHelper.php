<?php

namespace App\Supports;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use function Symfony\Component\HttpKernel\Log\record;

trait BaseCrudHelper
{
    // Define these in the main controller
    protected $model, $with = [], $showWith = [],
        $beforeStore = false, $afterStore = false,
        $beforeUpdate = false, $afterUpdate = false,
        $afterDelete = false;

    // Fetch all records
    public function index()
    {
        try {
            $data = $this->model->with($this->with)->get(); // Fetch all records with optional relationships
            return retRes('Successfully fetched all records', $data, 2000);
        } catch (Exception $e) {
            return retRes('Failed to fetch records', null, 500);
        }
    }

    // Show a single record by ID
    public function show($id)
    {
        try {
            $record = $this->model->with($this->showWith)->findOrFail($id); // Fetch the record with optional relationships
            return retRes('Successfully found record', $record, 2000);
        } catch (ModelNotFoundException $e) {
            return retRes('Record not found', null, 404);
        } catch (Exception $e) {
            return retRes('Something went wrong with fetching the record', null, 500);
        }
    }

    // Store a new record
    public function store(Request $request)
    {
        try {
            mergeAuth($request);
            call($this->beforeStore, $request);
            $record = $this->model->create($request->all()); // Create a new record
            call($this->afterStore, $record);
            return retRes('Successfully created record', $record);
        } catch (Exception $e) {
            return retRes('Failed to create record', null, 500);
        }
    }

    // Update an existing record
    public function update(Request $request, $id)
    {
        try {
            call($this->beforeUpdate, $request);
            $record = $this->model->findOrFail($id); // Find the record by ID
            $newRecord = $record->update($request->all()); // Update the record
            call($this->afterUpdate, $record, $newRecord);
            return retRes('Successfully updated record', $record);
        } catch (ModelNotFoundException $e) {
            return retRes('Record not found', null, 404);
        } catch (Exception $e) {
            return retRes('Failed to update record', null, 500);
        }
    }

    // Delete a record by ID
    public function destroy($id)
    {
        try {
            $record = $this->model->findOrFail($id); // Find the record by ID
            $record->delete(); // Delete the record
            call($this->afterDelete, $record);
            return retRes('Successfully deleted record', $record, CODE_DANGER);
        } catch (ModelNotFoundException $e) {
            return retRes('Record not found', null, 404);
        } catch (Exception $e) {
            return retRes('Failed to delete record', null, 500);
        }
    }
}
