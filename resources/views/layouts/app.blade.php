<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'My App')</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="w-full md:w-8/12 lg:w-6/12 xl:w-5/12 mx-auto p-4">
        @yield('content')
    </div>
</body>
</html>
