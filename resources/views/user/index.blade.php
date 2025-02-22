@extends('components.app')

@section('title', 'Applied Jobs')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="md:text-xl text-sm font-semibold text-gray-500">Jobs You Have Applied For</h2>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Applied Jobs Table -->
    <div class="overflow-x-auto">
        <table id="appliedJobsTable" class="min-w-full bg-white rounded-lg">
            <thead>
                <tr class="bg-gray-50">
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">No</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Job Title</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Status</th>
                    <th class="py-4 px-6 text-left text-sm font-semibold text-gray-600">Applied On</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm">
                <!-- Data rows will be populated by DataTables -->
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function () {
            $('#appliedJobsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('applied.jobs.data') }}",
                    type: 'GET',
                },
                columns: [
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'job_title',
                        name: 'job.judul'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            return '<span class="px-3 py-1 text-xs font-semibold rounded-full ' +
                                (data === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                (data === 'accepted' ? 'bg-green-100 text-green-800' :
                                'bg-red-100 text-red-800')) +
                                '">' + data + '</span>';
                        }
                    },
                    {
                        data: 'applied_on',
                        name: 'created_at'
                    }
                ],
                pagingType: "simple_numbers",
                language: {
                    paginate: {
                        previous: "&laquo;",
                        next: "&raquo;"
                    },
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                },
                // Add custom styling
                createdRow: function(row, data, dataIndex) {
                    // Add background and padding to rows
                    $(row).addClass('hover:bg-gray-50');
                    $('td', row).addClass('py-4 px-6 border-b border-gray-200');
                },
                // Increase row spacing
                dom: '<"top"fl>rt<"bottom"ip>',
                // Add custom classes to DataTables elements
                classes: {
                    sTable: 'border-separate border-spacing-y-2',
                }
            });
        });
    </script>

    <style>
        /* Additional custom styles for DataTables */
        .dataTables_wrapper .dataTables_length select {
            @apply border border-gray-300 rounded-md px-3 py-1 mx-2;
        }
        .dataTables_wrapper .dataTables_filter input {
            @apply border border-gray-300 rounded-md px-3 py-1 ml-2;
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
@endsection