@extends('components.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="md:text-xl text-sm font-semibold text-gray-500">Application</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg">
            <thead>
                <tr class="bg-gray-50">
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">No</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Nama Pelamar</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Posisi</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">CV</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @forelse ($applications as $index => $application)
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6 border-b border-gray-200">{{ $index + $applications->firstItem() }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $application->user->name }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $application->job->judul }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">
                            <a href="{{ asset('storage/' . $application->cv_path) }}" 
                               target="_blank" 
                               class="text-blue-600 hover:text-blue-800 transition-colors">
                                Lihat CV
                            </a>
                        </td>
                        <td class="py-4 px-6 border-b border-gray-200">
                            <form action="{{ route('applications.update', $application->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" 
                                        onchange="this.form.submit()"
                                        class="px-3 py-1 rounded-full text-xs font-semibold
                                        {{ $application->status == 'accepted' ? 'bg-green-100 text-green-800' : 
                                           ($application->status == 'rejected' ? 'bg-red-100 text-red-800' : 
                                           'bg-yellow-100 text-yellow-800') }}">
                                    <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>
                                    <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>
                                        Accepted
                                    </option>
                                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>
                                        Rejected
                                    </option>
                                </select>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 px-6 text-center text-gray-500">
                            Tidak ada aplikasi yang tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        @if ($applications->hasPages())
            {{ $applications->links() }}
        @else
            <nav role="navigation" class="flex justify-between">
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-not-allowed">
                    « Previous
                </span>
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md">
                    1
                </span>
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md cursor-not-allowed">
                    Next »
                </span>
            </nav>
        @endif
    </div>
</div>

<style>
    /* Style the select dropdown to match status pills */
    select option {
        @apply bg-white text-gray-700;
        padding: 8px 12px;
    }
    
    /* Remove default select styling */
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
</style>
@endsection