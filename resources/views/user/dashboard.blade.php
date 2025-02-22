@extends('components.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container mx-auto px-4">
        <h1 class="md:text-xl text-sm font-semibold text-gray-500">Daftar Pekerjaan</h1>

        @if(session('success'))
            <script>
                // Show the success modal when the page loads
                window.onload = function() {
                    document.getElementById('successModal').classList.remove('hidden');
                    setTimeout(function() {
                        document.getElementById('successModal').classList.add('hidden');
                    }, 2000); // Hide after 2 seconds
                };
            </script>
        @endif

        <!-- Success Modal -->
        <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white text-green-500 p-6 rounded-lg shadow-lg w-1/3">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Success</h2>
                    <button onclick="closeSuccessModal()" class="text-green-500 hover:text-green-700">
                        <i class="fas fa-times"></i> <!-- Font Awesome close icon -->
                    </button>
                </div>
                <p class="mt-2">{{ session('success') }}</p>
            </div>
        </div>

        <!-- Job List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($jobs as $job)
                <div class="bg-white shadow-md rounded-lg p-5 hover:shadow-lg transition">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-cyan-700">{{ $job->judul }}</h3>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                            {{ $job->type === 'Full-Time' ? 'bg-green-100 text-green-800' : 
                            ($job->type === 'Remote' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ $job->type }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">{{ $job->lokasi }}</p>
                    <p class="text-sm text-gray-900 font-semibold mt-1">Rp{{ number_format($job->gaji, 2, ',', '.') }} / month</p>

                    <div class="flex justify-between items-center mt-4">
                        <button onclick="openApplyModal('{{ $job->id }}')" class="inline-block px-6 py-3 bg-[#1a237e] text-white font-medium rounded-full hover:bg-[#151d69] transition-colors duration-200">Apply</button>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500 col-span-3 text-center">Tidak ada pekerjaan tersedia.</p>
            @endforelse
        </div>

        <div class="mt-52 flex justify-center">
            @if ($jobs->hasPages())
                {{ $jobs->links('vendor.pagination.tailwind') }}
            @else
                <ul class="inline-flex space-x-2 text-gray-400">
                    <li class="px-3 py-2 bg-gray-200 rounded-lg cursor-not-allowed">«</li>
                    <li class="px-3 py-2 bg-gray-200 rounded-lg cursor-not-allowed">1</li>
                    <li class="px-3 py-2 bg-gray-200 rounded-lg cursor-not-allowed">»</li>
                </ul>
            @endif
        </div>
        
    </div>

    <!-- Modal for Uploading CV -->
    <div id="applyModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-lg font-semibold mb-4">Unggah CV Anda</h2>
            <form id="applyForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="cv_path" required class="mb-4">
                <div class="flex justify-end">
                    <button type="button" onclick="closeApplyModal()" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-cyan-500 text-white rounded-lg">Kirim</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openApplyModal(jobId) {
            // Set the action URL for the form
            const form = document.getElementById('applyForm');
            form.action = `/jobs/${jobId}/apply`; // Adjust URL according to your route
            
            // Show the modal
            document.getElementById('applyModal').classList.remove('hidden');
        }

        function closeApplyModal() {
            // Hide the modal
            document.getElementById('applyModal').classList.add('hidden');
        }
    </script>
@endsection