<nav class="relative bg-gradient-to-r from-gray-900 to-gray-800 shadow-lg">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <!-- Mobile menu button -->
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <button 
          type="button" 
          command="--toggle" 
          commandfor="mobile-menu" 
          class="relative inline-flex items-center justify-center rounded-lg p-2 text-gray-300 hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
        >
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 in-aria-expanded:hidden">
            <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6 not-in-aria-expanded:hidden">
            <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </button>
      </div>
      
      <!-- Logo and desktop navigation -->
      <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
        <!-- Logo -->
        <div class="flex shrink-0 items-center transform transition-transform hover:scale-105 duration-200">
          <img src="{{ asset('img/sf-logo.png') }}" alt="Safe Ka Fernandino" class="h-9 w-auto" />
          <span class="ml-2 text-white font-semibold text-lg hidden sm:inline-block">Safe Ka Fernandino</span>
        </div>
        
        <!-- Desktop navigation links -->
        <div class="hidden sm:ml-8 sm:block">
  <div class="flex space-x-2">
    <!-- Dashboard Link -->
    <a 
      href="{{ route('home') }}" 
      class="rounded-lg px-4 py-2 text-sm font-medium transition-all duration-200 group
        {{ request()->routeIs('home') ? 
          'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-md hover:shadow-lg hover:from-indigo-700 hover:to-indigo-800' : 
          'text-gray-200 hover:bg-white/10 hover:text-white' 
        }}"
    >
      <i class="fas fa-tachometer-alt mr-2 {{ !request()->routeIs('home') ? 'group-hover:scale-110 inline-block transition-transform' : '' }}"></i>
      Dashboard
    </a>
    
    <!-- Users Link -->
    <a 
      href="{{ route('users.index') }}" 
      class="rounded-lg px-4 py-2 text-sm font-medium transition-all duration-200 group
        {{ request()->routeIs('users.*') ? 
          'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-md hover:shadow-lg hover:from-indigo-700 hover:to-indigo-800' : 
          'text-gray-200 hover:bg-white/10 hover:text-white' 
        }}"
    >
      <i class="fas fa-users mr-2 {{ !request()->routeIs('users.*') ? 'group-hover:scale-110 inline-block transition-transform' : '' }}"></i>
      Users
    </a>
    
    <!-- Incidents Link -->
    <a 
      href="{{ route('incidents.index') }}" 
      class="rounded-lg px-4 py-2 text-sm font-medium transition-all duration-200 group
        {{ request()->routeIs('incidents.*') ? 
          'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-md hover:shadow-lg hover:from-indigo-700 hover:to-indigo-800' : 
          'text-gray-200 hover:bg-white/10 hover:text-white' 
        }}"
    >
      <i class="fas fa-exclamation-triangle mr-2 {{ !request()->routeIs('incidents.*') ? 'group-hover:scale-110 inline-block transition-transform' : '' }}"></i>
      Incidents
    </a> 

    <!-- Evacuation Link -->
    <a 
      href="{{ route('evacuation-points.index') }}" 
      class="rounded-lg px-4 py-2 text-sm font-medium transition-all duration-200 group
        {{ request()->routeIs('evacuation-points.*') ? 
          'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white shadow-md hover:shadow-lg hover:from-indigo-700 hover:to-indigo-800' : 
          'text-gray-200 hover:bg-white/10 hover:text-white' 
        }}"
    >
      <i class="fas fa-exclamation-triangle mr-2 {{ !request()->routeIs('evacuation-points.*') ? 'group-hover:scale-110 inline-block transition-transform' : '' }}"></i>
      Evacuation Point
    </a>

  </div>
</div>
</div>
      
    <!-- Right side actions -->
    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0 space-x-3">
      <!-- Notification button -->
   
          <a class="text-white bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form> 
        <!-- Profile dropdown -->
       
      </div>
    </div>
  </div>

  <!-- Mobile menu -->
  <el-disclosure id="mobile-menu" hidden class="block sm:hidden bg-gray-900/95 backdrop-blur-sm border-t border-gray-700">
    <div class="space-y-1 px-4 pt-2 pb-4">
      <a 
        href="/home" 
        aria-current="page" 
        class="flex items-center space-x-3 rounded-lg bg-indigo-600 px-3 py-3 text-base font-medium text-white transition-all duration-200"
      >
        <i class="fas fa-tachometer-alt"></i>
        <span>Dashboard</span>
      </a>
      <a 
        href="/users" 
        class="flex items-center space-x-3 rounded-lg px-3 py-3 text-base font-medium text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200"
      >
        <i class="fas fa-users"></i>
        <span>Users</span>
      </a>
      <a 
        href="/incidents" 
        class="flex items-center space-x-3 rounded-lg px-3 py-3 text-base font-medium text-gray-300 hover:bg-white/10 hover:text-white transition-all duration-200"
      >
        <i class="fas fa-exclamation-triangle"></i>
        <span>Incidents</span>
      </a>
      
      <!-- Mobile menu divider -->
      <div class="border-t border-gray-700 my-2"></div>
      
       
  </el-disclosure>
</nav>

<!-- Add these CSS animations for extra polish -->
<style>
  @keyframes slideIn {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .animate-slide-in {
    animation: slideIn 0.3s ease-out;
  }
  
  /* Custom scrollbar for mobile menu */
  el-disclosure {
    max-height: calc(100vh - 4rem);
    overflow-y: auto;
    scrollbar-width: thin;
  }
  
  el-disclosure::-webkit-scrollbar {
    width: 6px;
  }
  
  el-disclosure::-webkit-scrollbar-track {
    background: #1f2937;
  }
  
  el-disclosure::-webkit-scrollbar-thumb {
    background: #4b5563;
    border-radius: 3px;
  }
  
  el-disclosure::-webkit-scrollbar-thumb:hover {
    background: #6b7280;
  }
</style>