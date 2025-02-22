<?php

namespace App\Services\User;

use App\Models\Application;
use Illuminate\Pagination\LengthAwarePaginator;

interface ApplicationService
{
    /**
     * Mengambil semua pekerjaan dengan paginasi.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllJobs(int $perPage = 10): LengthAwarePaginator;

    /**
     * Melamar pekerjaan dengan data yang diberikan.
     *
     * @param array $data
     * @return Application
     */
    public function applyForJob(array $data, $jobId): Application;

    /**
     * Mengambil ID pekerjaan yang telah dilamar oleh pengguna.
     *
     * @param string $userId // Change to string
     * @return array
     */
    public function getAppliedJobIds(string $userId): array; // Change to string
}