<?php

namespace App\Http\Controllers;

use App\ApplicationType;
use App\Application;
use App\Http\Requests\CreateApplicationFormRequest;
use App\Http\Resources\ApplicationTypeCollection;
use App\Mail\ApplicationCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
     * Store a newly created resource in storage.
     *
     * @param CreateApplicationFormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateApplicationFormRequest $request)
    {
        $this->authorize('create', Application::class);
        
        $application = Auth::user()->applications()->create($request->all());
        
        $this->notifyLecturer($application);
        
        return response()
            ->json([ 'data' => 'okay'], 200);
    }
    
    /**
     * Display the specified resource for editing.
     *
     * @param  \App\Application  $application
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        return "pk";
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
    
    /**
     * Get the available courses and sections.
     *
     * @return ApplicationTypeCollection
     */
    public function types()
    {
        return new ApplicationTypeCollection(ApplicationType::all());
    }
    
    /**
     * Send an email to the lecturer who teach the registered section by the student.
     *
     * @param Application $application
     */
    public function notifyLecturer(Application $application){
        Mail::to($application->section->lecturer->email)
            ->send(new ApplicationCreated($application));
    }
}
