<?php

namespace App\Http\Controllers;

use App\Models\JobOpportunity;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use App\Http\Requests\JobOpportunityRequest;
use App\Http\Requests\JobApplicationRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class JobOpportunityController extends Controller
{
    public function adminDashboard()
    {
        // Implementation for admin dashboard
    }

    public function adminJobOpportunities()
    {
        $jobOpportunities = JobOpportunity::all();
        return view('admin.job-opportunities', compact('jobOpportunities'));
    }

    public function create()
    {
        return view('admin.job-opportunities.create');
    }

    public function store(JobOpportunityRequest $request)
    {
        // Creating a new JobOpportunity with the validated data
        $jobOpportunity = JobOpportunity::create($request->validated());

        // Generating the slug for the jobOpportunity
        $company = $jobOpportunity->company_name;
        $title = $jobOpportunity->title;
        $jobOpportunity->slug = Str::slug("$company $title");
        $jobOpportunity->update();

        return redirect()->route('admin.job-opportunities.index');
    }

    public function edit()
    {
        return view('admin.job-opportunities.edit');
    }

    public function update(JobOpportunityRequest $request, JobOpportunity $jobOpportunity)
    {
        // Updating the JobOpportunity with the validated data
        $jobOpportunity->update($request->validated());

        return redirect()->route('admin.job-opportunities.index');
    }

    public function jobOpportunities()
    {
        $jobOpportunities = JobOpportunity::all();
        return view('job-opportunities.index', compact('jobOpportunities'));
    }

    public function showJobOpportunity(string $slug)
    {
        $jobOpportunity = JobOpportunity::where('slug', $slug)->first();
        return view('job-opportunities.show', compact('jobOpportunity'));
    }

    public function applyToJob(JobApplicationRequest $request)
    {
        
        // Getting the resume file from the request
        $resumeFile = $request->file('resume');
        $resumeFileName = $resumeFile->getClientOriginalName();

        // Storing the resume file into the resumes folder
        $resumePath = $resumeFile->store('resumes'); 

        $jobOpportunity = JobOpportunity::where('slug', $request->input('opportunity'))->first();

        // Creating the JobSeeker instance
        JobSeeker::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'resume' => $resumePath,
            'job_opportunity_id' => $jobOpportunity->id
        ]);

        return Redirect::back()->with('success', 'Job application submitted successfully!');
    }
}
