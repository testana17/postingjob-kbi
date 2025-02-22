<?php

namespace App\Services\Job;

use App\Repositories\Job\JobRepository;

class JobServiceImplement implements JobService
{
    protected $jobRepository;

    public function __construct(JobRepository $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    public function getAll()
    {
        return $this->jobRepository->getAll();
    }

    public function getJobById($id)
    {
        return $this->jobRepository->findById($id);
    }

    public function createJob(array $data)
    {
        return $this->jobRepository->create($data);
    }

    public function updateJob($id, array $data)
    {
        return $this->jobRepository->update($id, $data);
    }

    public function deleteJob($id)
    {
        return $this->jobRepository->delete($id);
    }
}
