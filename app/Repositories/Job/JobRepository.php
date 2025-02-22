<?php

namespace App\Repositories\Job;

use App\Models\JobUser;

interface JobRepository
{
    public function getAll();
    public function data(); // Menambahkan method untuk DataTables
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}
