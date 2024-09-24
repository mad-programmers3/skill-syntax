<?php

namespace App\Http\Controllers\backend;


use App\Models\Testimonial;

class TestimonialController extends ItemReviewCrudController
{
    public function __construct() {
        parent::__construct(new Testimonial());
    }

    public function index($with = ['review'])
    {
        return parent::index($with);
    }
}
