<?php

namespace App\Http\Controllers\backend;


use App\Models\Review;
use Illuminate\Http\Request;

class ItemReviewCrudController extends DatabaseCrudController
{
    public function __construct($model) {
        parent::__construct($model);
    }

    public function update(Request $request, $id)
    {
        $res = parent::update($request, $id);

        $responseData = $res->getData(true);

        // if item review relation updated then update the review
        if ($request->review && $responseData['status'] === 2000) {
            $record = Review::findOrFail($request->review['id']);
            $record->fill($request->review);
            $record->save();
        }

        return $res;
    }

}
