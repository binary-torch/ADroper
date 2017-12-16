<?php

namespace App\Http\Controllers;

use App\ApplicationStatus;
use App\ApplicationType;
use App\Application;
use App\Http\Requests\CreateApplicationFormRequest;
use App\Http\Resources\ApplicationTypeCollection;
use App\Mail\ApplicationCreated;
use App\Mail\ApplicationLecturerApproved;
use App\Mail\ApplicationUpdated;
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
        
        $fields = $request->all();
        $fields["token"] = str_limit(md5($request->user()->email . str_random()), 25, '');
        
        $application = Auth::user()->applications()->create($fields);
        
        $this->notifyLecturer($application);
        
        return response()
            ->json([ 'data' => 'okay'], 200);
    }
    
    /**
     * Display the specified resource for editing.
     *
     * @param Application $application
     * @return \Illuminate\Http\Response
     * @internal param $token
     */
    public function edit(Application $application)
    {
        return view('portal.application.edit', ["token" => $application->token]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $application
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        $request->validate([ "isApproved" => "required" ]);
        
        if($application->status->name == ApplicationStatus::Sent){
            $application->handleLecturerApproval($request->isApproved, $request->message);
            if($request->isApproved) {
                $this->notifyStudentsAffairs($application);
            };
        }else if($application->status->name == ApplicationStatus::LecturerApproved){
            $application->handleStudentsAffairsApproval($request->isApproved, $request->message);
        }
    
        $this->notifyStudent($application);
        return response()->json('okay',200);
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
     * Send an email to the student when the application updated.
     *
     * @param Application $application
     */
    public function notifyStudent(Application $application){
        Mail::to($application->user->email)
            ->send(new ApplicationUpdated($application));
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
    
    /**
     * Send an email to the lecturer who teach the registered section by the student.
     *
     * @param Application $application
     */
    public function notifyStudentsAffairs(Application $application){
        //$application->course->college->email
        Mail::to("test@cc.c")
            ->send(new ApplicationLecturerApproved($application));
    }
}
