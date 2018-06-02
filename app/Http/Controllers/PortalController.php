<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ApplicationCollection;

class PortalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.index');
    }


    /**
     * Get all user's applications.
     *
     * @param Request $request
     * @return mixed
     */
    public function applications(Request $request)
    {
        return new ApplicationCollection(
            $request->user()
                ->applications()
                ->get()
        );
    }
}
