<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    /**
     * Show the home page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        return view('home.index');
    }
    
    /**
     * Show about us page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('about.index');
    }
    
    /**
     * Show the privacy page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacy()
    {
        return view('privacy.index');
    }
    
    /**
     * Show the terms-of-use page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms()
    {
        return view('terms.index');
    }
}
