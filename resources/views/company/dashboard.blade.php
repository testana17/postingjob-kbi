@extends('components.app')

@section('title', 'Dashboard')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="md:text-xl text-sm font-semibold text-gray-500">Job Listings</h2>
    </div>

    <!-- Tabel Job Listings -->
    <div class="overflow-x-auto">
        <table id="jobsTable" class="min-w-full bg-white rounded-lg">
            <thead>
                <tr class="bg-gray-50">
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">No</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Job Title</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Type</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Location</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Salary</th>
                    <th class="py-4 px-6 text-center text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                @foreach ($jobs as $index => $job)
                    <tr class="hover:bg-gray-50">
                        <td class="py-4 px-6 border-b border-gray-200">{{ $index + 1 }}</td>
                        <td class="py-4 px-6 border-b border-gray-200 font-semibold">{{ $job->judul }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $job->type === 'Full-Time' ? 'bg-green-100 text-green-800' : 
                                ($job->type === 'Remote' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ $job->type }}
                            </span>
                        </td>
                        <td class="py-4 px-6 border-b border-gray-200">{{ $job->lokasi }}</td>
                        <td class="py-4 px-6 border-b border-gray-200">Rp{{ number_format($job->gaji, 2, ',', '.') }} / month</td>
                        <td class="py-4 px-6 border-b border-gray-200 text-center">
                            <div class="flex justify-center space-x-3">
                                <a href="{{ route('jobs-company.edit', ['jobs_company' => $job->id]) }}" 
                                   class="text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <button onclick="openModal('{{ $job->id }}')" 
                                        class="text-red-600 hover:text-red-800 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                                
                                <button onclick="openDetailModal('{{ $job->judul }}', '{{ $job->deskripsi }}')" 
                                        class="text-gray-600 hover:text-gray-800 transition-colors">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        @if ($jobs->hasPages()) {{-- Cek apakah ada pagination --}}
            {{ $jobs->links() }}
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

   <div class="flex justify-center md:mt-32">
        <a href="{{ route('jobs-company.create') }}" class="inline-block px-6 py-3 bg-[#1a237e] text-white font-medium rounded-full hover:bg-[#151d69] transition-colors duration-200">
            Create Job
        </a>
    </div>


     

    <div id="deleteModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-lg font-semibold mb-4">Konfirmasi Hapus</h2>
            <p>Apakah Anda yakin ingin menghapus pekerjaan ini?</p>
            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded-lg">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">OK</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Job Detail Modal -->
    <div id="detailModal" class="fixed inset-0 hidden bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h3 id="modalTitle" class="text-lg font-bold"></h3>
            <p id="modalDescription" class="text-gray-700 mt-2"></p>
            <button onclick="closeDetailModal()" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>
    <!-- Rest of your code remains the same -->

    <style>
        /* Custom DataTables Styling */
        .dataTables_wrapper .dataTables_length select {
            @apply border border-gray-300 rounded-md px-3 py-1 mx-2;
        }
        .dataTables_wrapper .dataTables_filter input {
            @apply border border-gray-300 rounded-md px-3 py-1 ml-2;
        }
        .dataTables_wrapper .dataTables_info {
            @apply py-4 text-sm text-gray-600;
        }
        .dataTables_wrapper .dataTables_paginate {
            @apply py-4;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            @apply px-3 py-1 mx-1 rounded-md;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            @apply bg-blue-500 text-white;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            @apply bg-gray-100;
        }
    </style>

    <script>
        $(document).ready(function () {
            $('#jobsTable').DataTable({
                "paging": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthMenu": [10, 25, 50, 100],
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ data per halaman",
                    "zeroRecords": "Tidak ada data ditemukan",
                    "info": "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    "infoEmpty": "Tidak ada data",
                    "infoFiltered": "(disaring dari _MAX_ total data)",
                    "search": "Cari:",
                },
                // Add custom styling
                "dom": '<"top"fl>rt<"bottom"ip>',
                "classes": {
                    "sTable": "border-separate border-spacing-y-2"
                }
            });
        });

 function openDetailModal(title, description) {
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalDescription').innerText = description;
            document.getElementById('detailModal').classList.remove('hidden');
        }

        function closeDetailModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        function openModal(jobId) {
            var url = "{{ route('jobs-company.destroy', ':id') }}";
            url = url.replace(':id', jobId);
            document.getElementById("deleteForm").action = url;
            document.getElementById("deleteModal").classList.remove("hidden");
        }

        function closeModal() {
            document.getElementById("deleteModal").classList.add("hidden");
        }
        // Your existing JavaScript functions remain the same
    </script>
@endsection