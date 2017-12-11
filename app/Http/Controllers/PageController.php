<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('home.index');
    }
    
    public function about()
    {
        return view('about.index');
    }
    
    public function privacy()
    {
        return view('privacy.index');
    }
    
    public function terms()
    {
        return view('terms.index');
    }
}
