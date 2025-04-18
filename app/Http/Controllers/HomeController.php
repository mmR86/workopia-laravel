<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\View\View;
use Illuminate\Http\Request;



class HomeController extends Controller
{
    // @desc Show home index view
    // @route GET /
    public function index(): View 
    {
        $jobs = Job::latest()->limit(6)->get();

        //with koristimo da bi poslali joboe kao prop izgleda
        return view('pages.index')->with('jobs', $jobs);
    }
}
