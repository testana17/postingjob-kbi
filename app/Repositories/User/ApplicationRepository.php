<?php

namespace App\Repositories\User;

use App\Models\Application;
use Illuminate\Pagination\LengthAwarePaginator;

interface ApplicationRepository
{
    /**
     * Membuat entri aplikasi baru.
     *
     * @param array $data
     * @return Application
     */
    public function create(array $data, $jobId): Application;

    /**
     * Mengambil semua pekerjaan dengan paginasi.
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllJobs(int $perPage = 10): LengthAwarePaginator;

    /**
     * Mengambil ID pekerjaan yang telah dilamar oleh pengguna.
     *
     * @param int $userId
     * @return array
     */
    public function getAppliedJobIds(string $userId): array; // Add this line
}