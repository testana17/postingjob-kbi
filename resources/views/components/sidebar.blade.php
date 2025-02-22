<aside class="w-64 bg-[#1a237e] text-white shadow-lg rounded-lg h-[calc(100vh-88px)] p-6">
    <h2 class="text-xl font-semibold mb-4">Hello, {{ Auth::user()->name }}</h2> <!-- Greeting with user's name -->

    <div class="mt-2 space-y-2">
        @if (Auth::user()->role === 'company')
            <a href="{{ route('jobs-company.index') }}" 
               class="flex items-center block px-4 py-3 rounded-lg transition duration-200 ease-in-out
                      {{ request()->routeIs('jobs-company.index') ? 'bg-[#3949ab]' : 'text-white hover:bg-[#5c6bc0]' }}">
                <i class="fas fa-briefcase mr-2"></i> <!-- Briefcase icon -->
                Jobs
            </a>

            <a href="{{ route('applications.index') }}" 
               class="flex items-center block px-4 py-3 rounded-lg transition duration-200 ease-in-out
                      {{ request()->routeIs('applications.index') ? 'bg-[#3949ab]' : 'text-white hover:bg-[#5c6bc0]' }}">
                <i class="fas fa-file-alt mr-2"></i> <!-- File icon -->
                Applications
            </a>
        @else
            <a href="{{ route('user.dashboard') }}" 
               class="flex items-center block px-4 py-3 rounded-lg transition duration-200 ease-in-out
                      {{ request()->routeIs('user.dashboard') ? 'bg-[#3949ab]' : 'text-white hover:bg-[#5c6bc0]' }}">
                <i class="fas fa-list mr-2"></i> <!-- List icon -->
                Job List
            </a>

            <a href="{{ route('applied.jobs') }}" 
               class="flex items-center block px-4 py-3 rounded-lg transition duration-200 ease-in-out
                      {{ request()->routeIs('applied.jobs') ? 'bg-[#3949ab]' : 'text-white hover:bg-[#5c6bc0]' }}">
                <i class="fas fa-check-circle mr-2"></i> <!-- Check circle icon -->
                Applied Jobs
            </a>
        @endif
    </div>
</aside>
