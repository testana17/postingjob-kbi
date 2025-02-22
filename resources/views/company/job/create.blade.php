@extends('components.app')

@section('title', 'Create Job')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
    <h1 class="md:text-xl text-sm font-semibold mb-4 text-gray-700">Create New Job</h1>

    <form action="{{ route('jobs-company.store') }}" method="POST" class="space-y-4">
        @csrf

        <div class="flex flex-wrap -mx-2">
        <div class="w-full md:w-1/2 px-2">
            <label for="judul" class="block text-sm font-medium text-gray-700">Job Title</label>
            <input type="text" id="judul" name="judul" required
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
        </div>

        <div class="w-full md:w-1/2 px-2">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700">Job Description</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required
                class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400"></textarea>
        </div>
        </div>
        <div class="flex flex-wrap -mx-2">
            <div class="w-full md:w-1/2 px-2">
                <label for="gaji" class="block text-sm font-medium text-gray-700">Salary</label>
                <input type="number" id="gaji" name="gaji" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
            </div>
            <div class="w-full md:w-1/2 px-2">
                <label for="kategori" class="block text-sm font-medium text-gray-700">Category</label>
                <input type="text" id="kategori" name="kategori" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
            </div>
        </div>

        <!-- Two columns row: Job Type and Location -->
        <div class="flex flex-wrap -mx-2">
            <div class="w-full md:w-1/2 px-2">
                <label for="type" class="block text-sm font-medium text-gray-700">Job Type</label>
                <select id="type" name="type" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
                    <option value="" disabled selected>Select Job Type</option>
                    <option value="Remote">Remote</option>
                    <option value="FullTime">Full-Time</option>
                    <option value="Parttime">Part-Time</option>
                    <option value="Contract">Contract</option>
                </select>
            </div>
            <div class="w-full md:w-1/2 px-2">
                <label for="lokasi" class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" id="lokasi" name="lokasi" required
                    class="mt-1 block w-full px-4 py-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:border-blue-400">
            </div>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('jobs-company.index') }}" class="text-orange-600 hover:text-gray-800 font-semibold">
                <i class="fas fa-arrow-left text-orange-500"></i> Back
            </a>
            
            <button type="submit"
                class="bg-cyan-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 transition">
                Save Job
            </button>
        </div>
    </form>
</div>
@endsection
