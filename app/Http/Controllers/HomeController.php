<?php

namespace App\Http\Controllers;

use App\Models\JobOpportunity;
use App\Models\JobSeeker;
use Illuminate\Http\Request;
use App\Http\Requests\JobApplicationRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function jobOpportunities()
    {
        return view('job-opportunities.index');
    }

    public function showJobOpportunity(string $slug)
    {
        return view('job-opportunities.show', compact('slug'));
    }

    public function adminDashboard()
    {
        return view('admin.job-opportunities.dashboard');
    }

    public function applicants(string $slug)
    {
        return view('admin.job-opportunities.applicants', compact('slug'));
    }

    public function createOpportunity()
    {
        return view('admin.job-opportunities.create');
    }

    public function editOpportunity(string $slug)
    {
        return view('admin.job-opportunities.edit', compact('slug'));
    }
}
