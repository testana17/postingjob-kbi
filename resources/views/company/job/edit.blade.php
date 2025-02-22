@extends('components.app')

@section('title', 'Edit Job')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
    <h1 class="md:text-xl text-sm font-semibold mb-4 text-gray-700">Edit Job</h1>

    <form action="{{ route('jobs-company.update', $job->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="judul" class="block text-sm font-medium text-gray-700">Job Title</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $job->judul) }}" required
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
        </div>

        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Job Description</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">{{ old('deskripsi', $job->deskripsi) }}</textarea>
        </div>

        <div class="flex flex-wrap -mx-2">
            <div class="w-full md:w-1/2 px-2">
                <label for="gaji" class="block text-sm font-medium text-gray-700">Gaji</label>
                <input type="number" id="gaji" name="gaji" value="{{ old('gaji', $job->gaji) }}" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
            </div>
            <div class="w-full md:w-1/2 px-2">
                <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                <input type="text" id="kategori" name="kategori" value="{{ old('kategori', $job->kategori) }}" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
            </div>
        </div>

        <!-- Baris dengan dua kolom: Tipe Pekerjaan dan Lokasi -->
        <div class="flex flex-wrap -mx-2">
            <div class="w-full md:w-1/2 px-2">
                <label for="type" class="block text-sm font-medium text-gray-700">Tipe Pekerjaan</label>
                <select id="type" name="type" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
                    <option value="Remote" {{ old('type', $job->type) == 'Remote' ? 'selected' : '' }}>Remote</option>
                    <option value="FullTime" {{ old('type', $job->type) == 'FullTime' ? 'selected' : '' }}>Full-Time</option>
                    <option value="Parttime" {{ old('type', $job->type) == 'Parttime' ? 'selected' : '' }}>Part-Time</option>
                    <option value="Contract" {{ old('type', $job->type) == 'Contract' ? 'selected' : '' }}>Contract</option>
                </select>
            </div>
            <div class="w-full md:w-1/2 px-2">
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $job->lokasi) }}" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
            </div>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('jobs-company.index') }}" class="text-gray-600 hover:text-gray-800">← Back</a>
            <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-green-700 transition">
                Update Job
            </button>
        </div>
    </form>
</div>
@endsection
