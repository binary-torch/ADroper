<?php

namespace App\Http\Controllers;

use App\ApplicationType;
use App\Application;
use App\Http\Requests\CreateApplicationFormRequest;
use App\Http\Resources\ApplicationTypeCollection;
use Illuminate\Http\Request;
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
     * Store a newly created resource in storage.
     *
     * @param CreateApplicationFormRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateApplicationFormRequest $request)
    {
        $this->authorize('create', Application::class);
        
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
    
    /**
     * Get the available courses and sections.
     *
     * @return ApplicationTypeCollection
     */
    public function types()
    {
        return new ApplicationTypeCollection(ApplicationType::all());
    }
}
