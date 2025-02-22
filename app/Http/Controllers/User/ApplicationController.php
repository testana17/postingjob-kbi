<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\ApplicationService;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Requests\User\ApplicationRequest;
use Yajra\DataTables\DataTables;

class ApplicationController extends Controller
{
    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $jobs = $this->applicationService->getAllJobs($perPage);
        $userId = Auth::id(); // No casting needed, keep it as a string
        $appliedJobs = $this->applicationService->getAppliedJobIds($userId); // Pass as string

        return view('user.dashboard', compact('jobs', 'appliedJobs'));
    }

    public function apply(ApplicationRequest $request, $job)
    {
        $data = $request->validated();
        $this->applicationService->applyForJob($data, $job);

        return redirect()->route('user.dashboard')->with('success', 'Job Applied successfully.');
    }

    public function indexMyApply()
    {
        return view('user.index'); // Ensure this view is correct
    }

    // Function to fetch applied jobs for DataTables
    public function appliedJobs(Request $request)
    {
        $userId = Auth::id();
        
        // Fetch applications for the authenticated user
        $applications = Application::where('user_id', $userId)->with('job');

        if ($request->ajax()) {
            return DataTables::of($applications)
                ->addColumn('job_title', function ($application) {
                    return $application->job->judul; // Access job title through the relationship
                })
                ->addColumn('applied_on', function ($application) {
                    return $application->created_at->format('d-m-Y'); // Format date
                })
                ->addColumn('status', function ($application) {
                    return ucfirst($application->status); // Capitalize the first letter of the status
                })
                ->make(true);
        }
    }
       
}    
