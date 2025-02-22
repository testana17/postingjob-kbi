<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Job\JobStoreRequest;
use App\Models\JobUser;
use App\Http\Requests\Job\UpdateJobRequest;
use App\Services\Job\JobService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $jobService;

    public function __construct(JobService $jobService)
    {
        $this->middleware('auth'); // ✅ Middleware hanya bisa di dalam __construct()
        $this->jobService = $jobService;
    }

    public function index()
    {
        $jobs = $this->jobService->getAll();
        return view('company.dashboard', compact('jobs'));
    }

    public function data()
{
    return $this->jobRepository->data();
}


    public function create()
    {
        return view('company.job.create');
    }

    public function store(JobStoreRequest $request)
    {
        $this->jobService->createJob($request->validated());
        return redirect()->route('jobs-company.index')->with('success', 'Job created successfully.');
    }

    public function show($id)
    {
        $job = $this->jobService->getJobById($id);
        return view('company.show', compact('job'));
    }

    public function edit($id)
    {
        $job = $this->jobService->getJobById($id);
        return view('company.job.edit', compact('job'));
    }

    public function update(UpdateJobRequest $request, $id)
    {
        $this->jobService->updateJob($id, $request->validated());
        return redirect()->route('jobs-company.index')->with('success', 'Job updated successfully.');
    }

    public function destroy($id)
    {
        $this->jobService->deleteJob($id);
        return redirect()->route('jobs-company.index')->with('success', 'Job deleted successfully.');
    }
}
