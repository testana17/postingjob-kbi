<nav class="bg-white shadow-sm fixed w-full z-10 flex justify-between items-center h-16 px-6">
    <!-- Logo & Dashboard Text -->
    <div class="flex items-center space-x-2 text-2xl font-bold text-[#1a237e]">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m4 0v-6m5 2l2 2M12 22V12m-4 4h8"/>
        </svg>
        <span class="">Dashboard</span>
    </div>

    <!-- Profile Dropdown -->
    <div class="relative">
        <button onclick="toggleDropdown()" class="flex items-center space-x-2 focus:outline-none">
            <i class="fas fa-user-circle text-gray-600 text-3xl"></i>
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>

        <!-- Dropdown Menu -->
      <!-- Dropdown Menu -->
<!-- Dropdown Menu -->
<div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2">
    <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-cyan-100">Edit Profil</a>

    <!-- Form Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-cyan-100">Logout</button>
    </form>
</div>

    </div>
</nav>

<script>
    function toggleDropdown() {
        document.getElementById("profileDropdown").classList.toggle("hidden");
    }
</script>
