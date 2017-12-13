<?php

namespace App\Http\Controllers;

use App\Http\Resources\College;
use App\Http\Resources\CollegeCollection;
use App\Http\Resources\CourseCollection;

class CollegeController extends Controller
{
    /**
     * Get the available colleges.
     *
     * @return CollegeCollection
     */
    public function all()
    {
        return new CollegeCollection(College::all());
    }
    
    /**
     * Get the available courses and sections.
     * @return CourseCollection
     */
    public function courses()
    {
        return new CourseCollection(auth()->user()->college()->first()->courses()->get());
    }
}
