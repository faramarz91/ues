<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->hasRole(UserRole::Admin->value)){
            return redirect()->route('admin.exams.index');
        } elseif (Auth::user()->hasRole(UserRole::Teacher->value)){
            return view('admin.analyzer');
        } else {
            return view('exams.index');
        }
    }
}
