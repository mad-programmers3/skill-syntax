<?php

namespace App\Http\Controllers\backend;


use App\Models\Review;
use Illuminate\Http\Request;

class ItemReviewCrudController extends DatabaseCrudController
{
    private $revCon;

    public function __construct($model)
    {
        parent::__construct($model, 'review');
        $this->revCon = new ReviewController();
    }

    public function store(Request $request, $callBack = false)
    {
        $res = false;

        // store the review first
        $this->revCon->store($request, function ($record) use ($request, &$res) {
            // set the review_id attribute on the request with the newly created review id
            $request->merge(['review_id' => $record->id]);
            // now store the relation
            $res = parent::store($request);
        });

        return $res;
    }

    public function update(Request $request, $id, $callBack = false)
    {
        return parent::update($request, $id, function () use ($request) {
            if ($request->review) {
                $record = Review::findOrFail($request->review['id']);
                $record->fill($request->review);
                $record->save();
            }
        });
    }


    // for delete old record
    public function destroy($id, $callBack = false)
    {
        return parent::destroy($id, function ($result) {
            // delete the actual review
            $this->revCon->destroy($result['review_id']);
        });
    }

}
