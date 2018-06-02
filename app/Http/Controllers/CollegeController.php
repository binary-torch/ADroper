<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseCollection;

class CollegeController extends Controller
{
    /**
     * Get the available courses and sections.
     * @return CourseCollection
     */
    public function courses()
    {
        return new CourseCollection(
            auth()->user()
                ->college()
                ->first()
                ->courses()
                ->get()
        );
    }
}
