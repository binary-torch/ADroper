<?php

namespace App\Http\Controllers;

use App\ApplicationType;
use App\Course;
use App\Application;
use App\Http\Requests\CreateApplicationFormRequest;
use App\Http\Resources\ApplicationTypeCollection;
use Illuminate\Http\Request;
use App\Http\Resources\CourseCollection;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portal.application.create');
    }
    
    /**
     * Get the available courses and sections.
     *
     * @return PortalController[]|CourseCollection|\Illuminate\Database\Eloquent\Collection
     */
    public function courses(){
        return new CourseCollection(Course::all());
    }
    
    /**
     * Get the available courses and sections.
     *
     * @return ApplicationTypeCollection
     */
    public function types(){
        return new ApplicationTypeCollection(ApplicationType::all());
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param CreateApplicationFormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateApplicationFormRequest $request)
    {
        $application = auth()->user()->applications()->where('application_type_id', $request->application_type_id)->first();
        
        if($application){
            return response()->json([
                'error' => 'You have requested this course already!',
            ], 403);
        }
        
        Auth::user()->applications()->create($request->all());
        
        return response()->json([
            'data' => 'okay',
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
    }
}
