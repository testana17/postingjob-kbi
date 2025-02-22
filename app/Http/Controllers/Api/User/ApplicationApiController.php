<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobUser;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ApplicationApiController extends Controller
{
    /**
     * Menampilkan daftar semua pekerjaan
     */
    public function index()
    {
        return response()->json(JobUser::all());
    }

    /**
     * Mengajukan lamaran untuk pekerjaan tertentu
     */
    public function apply(Request $request, $jobId)
    {
        $user = Auth::user();
    
        // Hanya user dengan role 'user' yang bisa apply
        if ($user->role !== 'user') {
            return response()->json(['message' => 'Only users can apply for jobs.'], 403);
        }
    
        $jobId = trim($jobId);
    
        return DB::transaction(function () use ($request, $user, $jobId) {
            $job = JobUser::find($jobId);
    
            if (!$job) {
                return response()->json(['message' => 'Job not found.'], 404);
            }
    
            // Cek apakah user sudah apply sebelumnya
            if (Application::where('user_id', $user->id)->where('job_id', $jobId)->exists()) {
                return response()->json(['message' => 'You have already applied for this job.'], 400);
            }
    
            // Validasi file CV
            $request->validate([
                'cv_path' => 'required|file|mimes:pdf,doc,docx|max:2048'
            ]);
    
            // Simpan file CV di 'cvs' dan gunakan nama asli
            $file = $request->file('cv_path');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('cvs', $fileName, 'public');
    
            // Simpan ke database menggunakan Application::create()
            $application = Application::create([
                'user_id' => $user->id,
                'job_id' => $jobId,
                'cv_path' => $filePath,
            ]);
    
            return response()->json([
                'message' => 'Job applied successfully.',
                'application' => $application
            ], 201);
        });
    }
    

    

    /**
     * Menampilkan daftar pekerjaan yang telah dilamar oleh user
     */
    public function appliedJobs()
    {
        $userId = Auth::id();

        return response()->json(
            Application::where('user_id', $userId)
                ->with('job') // Mengambil data job yang dilamar
                ->get()
        );
    }
}
