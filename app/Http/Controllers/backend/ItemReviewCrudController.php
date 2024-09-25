<?php

namespace App\Http\Controllers\backend;


use App\Models\Review;
use Illuminate\Http\Request;

class ItemReviewCrudController extends DatabaseCrudController
{
    private $revCon;

    public function __construct($model)
    {
        parent::__construct($model);
        $this->revCon = new ReviewController();
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


    // for delete old record
    public function destroy($id, $afterDone = false)
    {
        return parent::destroy($id, function ($result) {
            $this->revCon->destroy($result['review_id']);
        });
    }

}
