<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Job;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;
    // @desc Show all job listings
    // @route GET /jobs
    public function index(): View
    {
        $jobs = Job::paginate(9);
        return view('jobs.index')->with('jobs', $jobs);
    }

    // @desc Show create job form
    // @route GET /jobs/create
    public function create(): View
    {
        return view('jobs.create');
    }

    // @desc Save job to database
    // @route POST /jobs
    public function store(Request $request): RedirectResponse
    {
        // Validate the incoming request data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'salary' => 'required|integer',
        'tags' => 'nullable|string',
        'job_type' => 'required|string',
        'remote' => 'required|boolean',
        'requirements' => 'nullable|string',
        'benefits' => 'nullable|string',
        'address' => 'nullable|string',
        'city' => 'required|string',
        'state' => 'required|string',
        'zipcode' => 'required|string',
        'contact_email' => 'required|email',
        'contact_phone' => 'nullable|string',
        'company_name' => 'required|string',
        'company_description' => 'nullable|string',
        'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'company_website' => 'nullable|url',
    ]);

    //Hardcoded user ID
    $validatedData['user_id'] = auth()->user()->id;

    //Check for image
    if($request->hasFile('company_logo')) {
        //Store the file and get path
        $path = $request->file('company_logo')->store('logos', 'public');

        //Add path to validated data (add path to DB)
        $validatedData['company_logo'] = $path;
    }

    //Submit to DB
    Job::create($validatedData);

    return redirect()->route('jobs.index')->with('success', 'Job listing created successfully!');
        
    }

    // @desc Display a single job listing
    // @route GET /jobs/{$id}
    public function show(Job $job): View
    {
        return view('jobs.show')->with('job', $job);
    }

    // @desc Edit job form
    // @route GET /jobs/{$id}/edit
    public function edit(Job $job): View
    {
        //check if user is authorized
        $this->authorize('update', $job);
        //show the form
        return view('jobs.edit')->with('job', $job);
    }

    // @desc Update job listing
    // @route PUT /jobs/{$id}
    public function update(Request $request, Job $job)
    {
        //check if user is authorized
        $this->authorize('update', $job);

        // Validate the incoming request data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'salary' => 'required|integer',
        'tags' => 'nullable|string',
        'job_type' => 'required|string',
        'remote' => 'required|boolean',
        'requirements' => 'nullable|string',
        'benefits' => 'nullable|string',
        'address' => 'nullable|string',
        'city' => 'required|string',
        'state' => 'required|string',
        'zipcode' => 'required|string',
        'contact_email' => 'required|email',
        'contact_phone' => 'nullable|string',
        'company_name' => 'required|string',
        'company_description' => 'nullable|string',
        'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'company_website' => 'nullable|url',
    ]);

    //Check for image
    if($request->hasFile('company_logo')) {

        //Delete old logo
        Storage::delete('public/logos' . basename($job->company_logo));
        //Store the file and get path
        $path = $request->file('company_logo')->store('logos', 'public');

        //Add path to validated data (add path to DB)
        $validatedData['company_logo'] = $path;
    }

    //Submit to DB
    $job->update($validatedData);

    return redirect()->route('jobs.index')->with('success', 'Job listing updated successfully!');
    }

    // @desc Delete a job listing
    // @route DELETE /jobs{$id}
    public function destroy(Job $job): RedirectResponse
    {
        //check if user is authorized
        $this->authorize('delete', $job);

        // If logo, then delete it
        if($job->company_logo) {
            Storage::delete('public/logos' . basename($job->company_logo));
        }

        $job->delete();

        //Check if request came from dashboard
        if(request()->query('from') == 'dashboard') {
            return redirect()->route('dashboard')->with('success', 'Job listing deleted successfully!');
        }

        return redirect()->route('jobs.index')->with('success', 'Job listing deleted successfully!');
    }
}
