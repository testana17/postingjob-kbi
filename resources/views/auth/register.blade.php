@extends('layouts.app')

@section('content')
<div class="flex min-h-screen w-full items-center justify-center p-4">
    <div class="w-full max-w-md p-8 bg-white shadow-lg shadow-cyan-300/50 rounded-lg dark:bg-cyan-800">
        <h2 class="text-2xl font-bold text-center text-cyan-700 dark:text-white">
            {{ request()->routeIs('register') ? 'Create Account' : 'Welcome Back' }}
        </h2>
        <p class="text-center text-cyan-600 dark:text-cyan-300 mb-6">
            {{ request()->routeIs('register') ? 'Sign up to start using our services.' : 'Access your account to explore our features.' }}
        </p>

        @if (session('error'))
            <div class="mb-4 text-red-500 text-sm text-center bg-red-100 dark:bg-red-700/20 p-2 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ request()->routeIs('register') ? route('register') : route('login') }}" class="space-y-4">
            @csrf

            <!-- Name Field (Only for Register) -->
            @if (request()->routeIs('register'))
                <div class="space-y-2">
                    <label for="name" class="block text-sm font-medium text-cyan-700 dark:text-cyan-300">Full Name</label>
                    <input type="text" id="name" name="name" required class="w-full p-3 border rounded-lg bg-cyan-50 dark:bg-cyan-700 dark:text-white focus:ring-2 focus:ring-cyan-500 text-sm md:text-base" placeholder="Your full name">
                </div>
            @endif

            <!-- Email Field -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-cyan-700 dark:text-cyan-300">Email Address</label>
                <input type="email" id="email" name="email" required class="w-full p-3 border rounded-lg bg-cyan-50 dark:bg-cyan-700 dark:text-white focus:ring-2 focus:ring-cyan-500 text-sm md:text-base" placeholder="you@example.com">
            </div>

            <!-- Password Field -->
            <div class="space-y-2">
                <label for="password" class="block text-sm font-medium text-cyan-700 dark:text-cyan-300">Password</label>
                <input type="password" id="password" name="password" required class="w-full p-3 border rounded-lg bg-cyan-50 dark:bg-cyan-700 dark:text-white focus:ring-2 focus:ring-cyan-500 text-sm md:text-base" placeholder="Your password">
            </div>

            <!-- Remember Me (Only for Login) -->
            {{-- @if (request()->routeIs('login'))
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-cyan-700 dark:text-cyan-300">
                        <input type="checkbox" name="remember" class="mr-2"> Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-cyan-600 dark:text-cyan-400 font-semibold hover:underline">
                        Forgot Password?
                    </a>
                </div>
            @endif --}}

            <button type="submit" class="w-full bg-cyan-600 text-white font-medium py-3 rounded-md hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-300 dark:focus:ring-cyan-700 text-sm md:text-base transition">
                {{ request()->routeIs('register') ? 'Sign Up' : 'Sign In' }}
            </button>
        </form>

        <div class="mt-6 text-center text-sm md:text-base">
            <span class="text-cyan-700 dark:text-cyan-300">
                {{ request()->routeIs('register') ? 'Already have an account?' : "Don't have an account yet?" }}
            </span>
            <a href="{{ request()->routeIs('register') ? route('login') : route('register') }}" class="text-cyan-600 dark:text-cyan-400 font-semibold hover:underline">
                {{ request()->routeIs('register') ? 'Sign in' : 'Sign up' }}
            </a>
        </div>
    </div>
</div>
@endsection
