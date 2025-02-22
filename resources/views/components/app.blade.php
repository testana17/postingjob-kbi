<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</head>
<body class="">

    @include('components.navbar')

    <!-- Layout Container -->
    <div class="flex justify-center pt-32 px-6">
        <div class="flex gap-6 w-full max-w-6xl">
            @include('components.sidebar')

            <!-- Main Content -->
            <main class="flex-1 bg-white shadow rounded-lg p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <div class="mt-24"></div> 
    @include('components.footer')
    

</body>
</html>
