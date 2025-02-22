<?php

namespace App\Repositories\Job;

use App\Models\JobUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class JobRepositoryImplement implements JobRepository
{
    public function getAll()
    {
        return JobUser::where('users_id', auth()->id())->paginate(10);
    }

    public function data()
    {
        $query = JobUser::where('users_id', Auth::id())->select(['id', 'judul', 'type', 'lokasi', 'gaji', 'created_at']);

        return DataTables::of($query)
            ->addColumn('actions', function ($job) {
                return '
                    <a href="' . route('jobs-company.edit', $job->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <button onclick="openModal(' . $job->id . ')" class="btn btn-sm btn-danger">Hapus</button>
                    <button onclick="openDetailModal(`' . $job->judul . '`, `' . $job->deskripsi . '`)" class="btn btn-sm btn-info">Detail</button>
                ';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function findById($id)
    {
        return JobUser::findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $data['users_id'] = Auth::id();
            return JobUser::create($data);
        });
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $job = JobUser::findOrFail($id);
            $job->update($data);
            return $job;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $job = JobUser::findOrFail($id);
            $job->delete();
            return true;
        });
    }
}
