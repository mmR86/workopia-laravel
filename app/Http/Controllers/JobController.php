<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index() {
        $title = 'Available jobz';
        $jobs = ['Web Developerz', 'Database Adminz', 'Software Engineer', 'Systems Analyst'];
    
        return view('jobs.index', compact('title', 'jobs'));
    }

    public function create() {
        return view('jobs.create');
    }
}
