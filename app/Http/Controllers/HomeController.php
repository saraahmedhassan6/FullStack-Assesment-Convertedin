<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function __construct()
    {
        // apply the middleware auth to reach this page after login
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // check the role to route to create or tasks list
        if (auth()->check() && auth()->user()->isAdmin()) {
            return redirect()->route('tasks.create');
        } else {
            return redirect()->route('tasks.index');
        }
    }
}
