<?php

namespace App\Supports;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

trait BaseCrudHelper
{
    protected $model, $with = [], $showWith = []; // Define these in the main controller

    // Fetch all records
    public function index()
    {
        try {
            $data = $this->model->with($this->with)->get(); // Fetch all records with optional relationships
            return $this->retRes('Successfully fetched all records', $data, 2000);
        } catch (\Exception $e) {
            return $this->retRes('Failed to fetch records', null, 500);
        }
    }

    // Show a single record by ID
    public function show($id)
    {
        try {
            $record = $this->model->with($this->showWith)->findOrFail($id); // Fetch the record with optional relationships
            return $this->retRes('Successfully found record', $record, 2000);
        } catch (ModelNotFoundException $e) {
            return $this->retRes('Record not found', null, 404);
        } catch (\Exception $e) {
            return $this->retRes('Something went wrong with fetching the record', null, 500);
        }
    }

    // Store a new record
    public function store(Request $request, array $rules)
    {
        try {
            $validatedData = $request->validate($rules);
            $record = $this->model->create($validatedData); // Create a new record
            return $this->retRes('Successfully created record', $record, 201);
        } catch (\Exception $e) {
            return $this->retRes('Failed to create record', null, 500);
        }
    }

    // Update an existing record
    public function update(Request $request, $id, array $rules)
    {
        try {
            $validatedData = $request->validate($rules);
            $record = $this->model->findOrFail($id); // Find the record by ID
            $record->update($validatedData); // Update the record
            return $this->retRes('Successfully updated record', $record, 2000);
        } catch (ModelNotFoundException $e) {
            return $this->retRes('Record not found', null, 404);
        } catch (\Exception $e) {
            return $this->retRes('Failed to update record', null, 500);
        }
    }

    // Delete a record by ID
    public function destroy($id)
    {
        try {
            $record = $this->model->findOrFail($id); // Find the record by ID
            $record->delete(); // Delete the record
            return $this->retRes('Successfully deleted record', null, 2000);
        } catch (ModelNotFoundException $e) {
            return $this->retRes('Record not found', null, 404);
        } catch (\Exception $e) {
            return $this->retRes('Failed to delete record', null, 500);
        }
    }

    // Helper method for consistent response formatting
    private function retRes($message, $result = null, $status = 2000)
    {
        return response()->json([
            'message' => $message,
            'result' => $result,
            'status' => $status
        ]);
    }
}
