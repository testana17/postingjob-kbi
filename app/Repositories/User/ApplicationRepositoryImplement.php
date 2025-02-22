<?php

namespace App\Repositories\User;

use App\Models\Application;
use App\Models\JobUser ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class ApplicationRepositoryImplement implements ApplicationRepository
{
    /**
     * Membuat entri aplikasi baru dengan transaksi database.
     *
     * @param array $data
     * @return Application
     */
    public function create(array $data, $jobId): Application
    {
        return DB::transaction(function () use ($data, $jobId) {
            // Menambahkan user_id, job_id, dan status ke dalam data
            $data['user_id'] = Auth::id();
            $data['job_id'] = $jobId;
            $data['status'] = 'pending';
    
            // Handle the CV file upload
            if (isset($data['cv_path']) && $data['cv_path'] instanceof \Illuminate\Http\UploadedFile) { // Check if 'cv_path' is present and is an instance of UploadedFile
                $file = $data['cv_path']; // Get the uploaded file
                $fileName = time() . '_' . $file->getClientOriginalName(); // Create a unique filename
                $filePath = $file->storeAs('cvs', $fileName, 'public'); // Store the file in the 'cvs' directory
    
                // Add the file path to the data array
                $data['cv_path'] = $filePath; // Store the path in the cv_path column
            } else {
                // Handle the case where the CV is not valid or not provided
                throw new \Exception('Invalid CV file provided.');
            }
    
            // Create a new application entry
            return Application::create($data); // This will save the cv_path in the database
        });
    }

    /**
     * Mengambil semua pekerjaan dengan paginasi.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllJobs(int $perPage = 10): LengthAwarePaginator
    {
        return JobUser ::paginate($perPage);
    }

    /**
     * Mengambil ID pekerjaan yang telah dilamar oleh pengguna.
     *
     * @param int $userId
     * @return array
     */
    public function getAppliedJobIds(string $userId): array
    {
        return Application::where('user_id', $userId)->pluck('job_id')->toArray();
    }
}