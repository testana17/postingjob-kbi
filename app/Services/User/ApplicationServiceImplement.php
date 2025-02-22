<?php

namespace App\Services\User;

use App\Models\Application;
use App\Repositories\User\ApplicationRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class ApplicationServiceImplement implements ApplicationService
{
    protected $applicationRepository;

    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    public function getAllJobs(int $perPage = 10): LengthAwarePaginator
    {
        return $this->applicationRepository->getAllJobs($perPage);
    }

    public function applyForJob(array $data, $jobId): Application
    {
        return $this->applicationRepository->create($data, $jobId);
    }

    public function getAppliedJobIds(string $userId): array // Change to string
    {
        return $this->applicationRepository->getAppliedJobIds($userId);
    }
}