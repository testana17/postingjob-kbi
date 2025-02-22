@extends('layouts.app')

@section('content')
<div class="flex min-h-screen w-full items-center justify-center p-4">
    <div class="w-full max-w-md p-8 bg-white shadow-lg shadow-cyan-300/50 rounded-lg dark:bg-cyan-800">

        <div class="space-y-2 text-center">
            <h2 class="text-2xl font-bold text-cyan-700 dark:text-white md:text-2xl">
                Welcome Back
            </h2>
            <p class="text-sm text-cyan-600 dark:text-cyan-300 md:text-base">
                Access your account to explore amazing features.
            </p>
        </div>

        @if (session('error'))
        <div class="mt-4 text-red-500 text-sm text-center bg-red-100 dark:bg-red-700/20 p-2 rounded-md">
            {{ session('error') }}
        </div>
    @endif
    
    @if(session('debug'))
    <p>Token: {{ session('debug') }}</p>
@endif


        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-cyan-700 dark:text-cyan-300">
                    Email Address
                </label>
                <input 
                type="email" 
                id="email" 
                name="email" 
                required 
                class="w-full p-3 border rounded-lg bg-cyan-50 dark:bg-cyan-700 dark:text-white 
                    focus:ring-2 focus:ring-cyan-500 text-sm md:text-base 
                    @error('email') border-red-500 @enderror"
                value="{{ old('email') }}"  {{-- Tambahkan old() agar input tidak kosong setelah error --}}
            >
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            
            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-cyan-700 dark:text-cyan-300">
                    Password
                </label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    required 
                    class="w-full p-3 border rounded-lg bg-cyan-50 dark:bg-cyan-700 dark:text-white focus:ring-2 focus:ring-cyan-500 text-sm md:text-base @error('password') border-red-500 @enderror"
                >
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            @if ($errors->any())
    {{-- <div class="text-red-500 text-sm text-center bg-red-100 dark:bg-red-700/20 p-2 rounded-md">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div> --}}
@endif


            <button 
                type="submit" 
                class="w-full bg-cyan-600 text-white font-medium py-3 rounded-md hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-300 dark:focus:ring-cyan-700 text-sm md:text-base transition-colors"
            >
                Sign in
            </button>
        </form>

        <div class="mt-6 text-center text-sm md:text-base">
            <span class="text-cyan-700 dark:text-cyan-300">Don't have an account? </span>
            <a 
                href="{{ route('register') }}" 
                class="text-cyan-600 dark:text-cyan-400 font-semibold hover:underline"
            >
                Sign up
            </a>
        </div>
    </div>
</div>
@endsection