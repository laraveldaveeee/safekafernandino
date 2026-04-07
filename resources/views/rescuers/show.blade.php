@extends('layouts.backend')

@section('content')
    
    <!-- ================= MAIN CONTENT ================= -->
    <main class="flex-1 overflow-y-auto p-5 lg:p-7 transition-all duration-300">
      
      <!-- Top header bar with page title & theme toggle (secondary) -->
      <div class="flex justify-between items-center mb-7 pb-2 border-b border-gray-200 dark:border-gray-800">
        <div>
          <h2 id="pageTitle" class="text-2xl lg:text-3xl font-bold text-gray-800 dark:text-white">Rescuer Profile</h2>
        </div>
        <div class="flex items-center gap-3">
          <div class="relative">
            <i class="fas fa-bell text-gray-500 dark:text-gray-400 text-xl cursor-pointer hover:text-accent transition"></i>
            <span class="absolute -top-1 -right-2 bg-accent text-white text-[10px] rounded-full px-1.5 py-0.5">4</span>
          </div>
          <button id="desktopThemeToggle" class="hidden sm:flex items-center gap-2 bg-gray-100 dark:bg-gray-800 px-3 py-2 rounded-full text-sm font-medium">
            <i class="fas fa-moon dark:hidden"></i>
            <i class="fas fa-sun hidden dark:inline"></i>
            <span class="dark:hidden">Dark</span>
            <span class="hidden dark:inline">Light</span>
          </button>
        </div>
      </div>

      <div id="app">
        <rescuer-profile :user-id="{{ $user->id }}"></rescuer-profile>
        
      </div>

@endsection
