@extends('layouts.backend') 
@section('content')


    
    <!-- ================= MAIN CONTENT ================= -->
    <main class="flex-1 overflow-y-auto p-5 lg:p-7 transition-all duration-300">
      
      <!-- Top header bar with page title & theme toggle (secondary) -->
      <div class="flex justify-between items-center mb-7 pb-2 border-b border-gray-200 dark:border-gray-800">
        <div>
          <h2 id="pageTitle" class="text-2xl lg:text-3xl font-bold text-gray-800 dark:text-white">Dashboard</h2>
          <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Real-time overview & analytics</p>
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


<!-- DYNAMIC SECTIONS (all content changes based on sidebar) -->
<!-- Dashboard Section (Default visible) -->
<div id="dashboard-section" class="section-content animate-fadeIn">
    <!-- KPI Row --> 
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-7">
    <!-- Total Incidents -->
    <div class="bg-light-card dark:bg-dark-card rounded-2xl p-5 shadow-card border border-gray-100 dark:border-gray-800 card-hover">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Total Incidents</p>
                <h3 class="text-2xl font-bold mt-1">14</h3>
                <span class="text-success text-xs">+2 today</span>
            </div>
            <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center text-accent">
                <i class="fas fa-fire"></i>
            </div>
        </div>
    </div>

    <!-- Total Active Rescuers -->
    <div class="bg-light-card dark:bg-dark-card rounded-2xl p-5 shadow-card border border-gray-100 dark:border-gray-800 card-hover">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Total Active Rescuers</p>
                <h3 class="text-2xl font-bold mt-1">47</h3>
                <span class="text-success text-xs">+5 active</span>
            </div>
            <div class="w-10 h-10 rounded-full bg-success/10 flex items-center justify-center text-success">
                <i class="fas fa-people-carry-box"></i>
            </div>
        </div>
    </div>

    <!-- Pending Incidents -->
    <div class="bg-light-card dark:bg-dark-card rounded-2xl p-5 shadow-card border border-gray-100 dark:border-gray-800 card-hover">
        <div class="flex justify-between">
            <div>
                <p class="text-gray-500 dark:text-gray-400 text-sm">Pending Incidents</p>
                <h3 class="text-2xl font-bold mt-1">8</h3>
                <span class="text-warning text-xs">3 awaiting approval</span>
            </div>
            <div class="w-10 h-10 rounded-full bg-warning/10 flex items-center justify-center text-warning">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>
</div>
 

</main>
</div>
    @endsection