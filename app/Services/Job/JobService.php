<?php

namespace App\Services\Job;

interface JobService
{
    public function getAll();
    public function getJobById($id);
    public function createJob(array $data);
    public function updateJob($id, array $data);
    public function deleteJob($id);
}
