<?php

namespace App\Http\Controllers\Api\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobUser;
use App\Http\Requests\Job\JobStoreRequest;
use App\Http\Requests\Job\UpdateJobRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobApiController extends Controller
{
    public function index()
    {
        return response()->json(JobUser::where('users_id', Auth::id())->get());
    }

    public function store(JobStoreRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $data = $request->validated();
            $data['users_id'] = Auth::id();

            $job = JobUser::create($data);
            return response()->json($job, 201);
        });
    }

    public function show($id)
    {
        $id = trim($id);

        return DB::transaction(function () use ($id) {
            $job = JobUser::where('users_id', Auth::id())->findOrFail($id);
            return response()->json($job);
        });
    }

    public function update(UpdateJobRequest $request, $id)
    {
        $id = trim($id);

        return DB::transaction(function () use ($request, $id) {
            $job = JobUser::where('id', $id)
                ->orWhereRaw("BINARY id = ?", [$id])
                ->first();

            if (!$job) {
                return response()->json(['message' => 'Job not found.'], 404);
            }

            if ($job->users_id !== Auth::id()) {
                return response()->json(['message' => 'Unauthorized.'], 403);
            }

            $job->update($request->validated());

            return response()->json([
                'message' => 'Job updated successfully',
                'job' => $job
            ]);
        });
    }

    public function destroy($id)
    {
        $id = trim($id);

        return DB::transaction(function () use ($id) {
            $job = JobUser::where('users_id', Auth::id())->findOrFail($id);
            $job->delete();

            return response()->json(null, 204);
        });
    }
}
