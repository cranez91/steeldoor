<?php

namespace App\Http\Controllers\Api;

use App\Models\JobOpportunity;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use App\Http\Requests\JobOpportunityRequest;
use App\Http\Requests\JobApplicationRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Resources\ShortJobOpportunityResource;
use App\Http\Resources\JobOpportunityResource;
use App\Http\Resources\ApplicantsResource;
use Illuminate\Support\Facades\Storage;


class JobOpportunityController extends Controller
{
    private const STORAGE_DISK = 'resumes';

    /**
     * Get the list of Job Opportunities with minimum of data.
     *
     * @param  
     * @return \App\Http\Resources\ShortJobOpportunityResource
     */
    public function adminDashboard()
    {
        return ShortJobOpportunityResource::collection( $this->getAllJobOpportunities() );
    }

    /**
     * Get the list of Job Opportunities.
     *
     * @param  
     * @return \App\Http\Resources\JobOpportunityResource
     */
    public function jobOpportunities()
    {
        return JobOpportunityResource::collection( $this->getAllJobOpportunities() );
    }

    /**
     * Get the list of applicants of the given Job.
     *
     * @param  string  $slug  The slug of the job opportunity.
     * @return \App\Http\Resources\ApplicantsResource
     */
    public function applicants(string $slug)
    {
        $jobOpportunity = $this->getJobOpportunityBySlug($slug);
        return ApplicantsResource::collection( $jobOpportunity->applicants()->get() );
    }

    /**
     * Stores the user application for a job.
     *
     * @param  \App\Http\Requests\JobApplicationRequest  $request  The request object containing the job application data.
     * @return \Illuminate\Http\Response
     */
    public function applyToJob(JobApplicationRequest $request)
    {
        // Getting the resume file from the request
        $resumeFile = $request->file('resume');
        $resumeFileName = uniqid() . '_' . $resumeFile->getClientOriginalName();

        // Storing the resume file into the resumes folder
        $resumePath = $this->storeFile($resumeFile, $resumeFileName);
        $jobOpportunity = JobOpportunity::where('slug', $request->input('opportunity'))->first();

        // Creating the JobSeeker instance
        $application = JobSeeker::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'resume' => $resumeFileName,
            'job_opportunity_id' => $jobOpportunity->id
        ]);

        return response()->json([
            'message' => 'Job application submitted successfully',
            'data' => $application
        ]);
    }

    /**
     * Get the specified job opportunity.
     *
     * @param  string  $slug  The slug of the job opportunity.
     * @return \App\Http\Resources\JobOpportunityResource
     */
    public function show(string $slug)
    {
        $jobOpportunity = $this->getJobOpportunityBySlug($slug);
        return new JobOpportunityResource($jobOpportunity);
    }

    public function create()
    {
        return view('admin.job-opportunities.create');
    }

    /**
     * Stores the job opportunity.
     *
     * @param  \App\Http\Requests\JobOpportunityRequest  $request  The request object containing the job opportunity data.
     * @return \Illuminate\Http\Response
     */
    public function store(JobOpportunityRequest $request)
    {
        // Creating a new JobOpportunity with the validated data
        $jobOpportunity = JobOpportunity::create($request->validated());

        // Generating the slug for the jobOpportunity
        $company = $jobOpportunity->company_name;
        $title = $jobOpportunity->title;
        $jobOpportunity->slug = Str::slug("$company $title");
        $jobOpportunity->update();

        return response()->json([
            'message' => 'Job application created successfully'
        ]);
    }

    /**
     * Updates the job opportunity.
     *
     * @param  \App\Http\Requests\JobOpportunityRequest  $request  The request object containing the job opportunity data.
     * @param  string  $slug  The slug of the job opportunity.
     * @return \Illuminate\Http\Response
     */
    public function update(JobOpportunityRequest $request, string $slug)
    {
        // Updating the JobOpportunity with the validated data
        $jobOpportunity = $this->getJobOpportunityBySlug($slug);
        $jobOpportunity->update($request->validated());
        
        $company = $jobOpportunity->company_name;
        $title = $jobOpportunity->title;
        $jobOpportunity->slug = Str::slug("$company $title");
        $jobOpportunity->update();

        return response()->json([
            'message' => 'Job application updated successfully',
            'data' => $jobOpportunity
        ]);
    }

    /**
     * Deletes the job opportunity.
     *
     * @param  string  $slug  The slug of the job opportunity.
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $slug)
    {
        $jobOpportunity = $this->getJobOpportunityBySlug($slug);
        $jobOpportunity->delete();
        
        return response()->json([
            'message' => 'Job opportunity deleted successfully'
        ]);
    }

    
    /**
     * Looks for a job opportunity by slug.
     *
     * @param  string  $slug  The slug of the job opportunity.
     * @return \App\Models\JobOpportunity  The job opportunity object.
     */
    private function getJobOpportunityBySlug(string $slug)
    {
        return JobOpportunity::getBySlug($slug);
    }

    /**
     * Get all the jobs
     *
     * @return \Illuminate\Database\Eloquent\Collection  A collection of job opportunities.
     */
    private function getAllJobOpportunities()
    {
        return JobOpportunity::all();
    }

    /**
     * Stores the resume file into our storage disk
     *
     * @param  string  $file  The resume file.
     * @param  string  $fileName  The name of the resume file.
     * @return string  the resume file path.
     */
    private function storeFile(string $file, string $fileName)
    {
        $path = Storage::disk(self::STORAGE_DISK)->putFileAs('/', $file, $fileName);
        return Storage::disk(self::STORAGE_DISK)->url($path);
    }
}
