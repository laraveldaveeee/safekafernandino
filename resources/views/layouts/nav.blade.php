{{-- <nav class="relative bg-gradient-to-r from-gray-900 to-gray-800 shadow-lg">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
 
      <div class="flex items-center"> 
        <div class="sm:hidden mr-2">
          <button 
            @click="open = !open"
            type="button"
            class="inline-flex items-center justify-center rounded-lg p-2 text-gray-300 hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
          >
            <svg v-if="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <svg v-else class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Logo -->
        <div class="flex items-center">
          <img src="{{ asset('img/sf-logo.png') }}" class="h-9 w-auto">
          <span class="ml-2 text-white font-semibold text-lg hidden sm:block">
            SafeKaFernandino
          </span>
        </div>
 
        <div class="hidden sm:flex sm:ml-8 space-x-4">

          <a href="{{ route('home') }}"
            class="px-4 py-2 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('home') ? 'bg-indigo-600 text-white' : 'text-gray-200 hover:bg-white/10' }}">
            Dashboard
          </a>

          <a href="{{ route('users.index') }}"
            class="px-4 py-2 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('users.*') ? 'bg-indigo-600 text-white' : 'text-gray-200 hover:bg-white/10' }}">
            Administrator
          </a>

          <a href="{{ route('emergency-types.index') }}"
            class="px-4 py-2 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('emergency-types.*') ? 'bg-indigo-600 text-white' : 'text-gray-200 hover:bg-white/10' }}">
            Emergency Type
          </a>

          <a href="{{ route('rescuers-pending.index') }}"
            class="px-4 py-2 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('rescuers-pending.*') ? 'bg-indigo-600 text-white' : 'text-gray-200 hover:bg-white/10' }}">
            Rescuers Pending
          </a>

          <a href="{{ route('rescuers.index') }}"
            class="px-4 py-2 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('rescuers.*') ? 'bg-indigo-600 text-white' : 'text-gray-200 hover:bg-white/10' }}">
            Rescuers
          </a>

          <a href="{{ route('incidents.index') }}"
            class="px-4 py-2 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('incidents.*') ? 'bg-indigo-600 text-white' : 'text-gray-200 hover:bg-white/10' }}">
            Incidents
          </a>

          <a href="{{ route('evacuation-points.index') }}"
            class="px-4 py-2 rounded-lg text-sm font-medium transition
            {{ request()->routeIs('evacuation-points.*') ? 'bg-indigo-600 text-white' : 'text-gray-200 hover:bg-white/10' }}">
            Evacuation Point
          </a>

        </div>
      </div>
 
      <div>
        <a href="{{ route('logout') }}"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm">
          Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
          @csrf
        </form>
      </div>

    </div>
  </div>

  <!-- MOBILE MENU -->
  <div v-show="open" class="sm:hidden px-4 pb-4 space-y-2 bg-gray-900">

    <a href="{{ route('home') }}" class="block text-white py-2">Dashboard</a>
    <a href="{{ route('users.index') }}" class="block text-white py-2">Administrator</a>
    <a href="{{ route('emergency-types.index') }}" class="block text-white py-2">Emergency Type</a>
    <a href="{{ route('rescuers-pending.index') }}" class="block text-white py-2">Rescuers Pending</a>
    <a href="{{ route('rescuers.index') }}" class="block text-white py-2">Rescuers</a>
    <a href="{{ route('incidents.index') }}" class="block text-white py-2">Incidents</a>
    <a href="{{ route('evacuation-points.index') }}" class="block text-white py-2">Evacuation Point</a>

  </div>
</nav> --}}

@inject('stats','App\Stats') 

<!-- Navigation Menu -->
<nav class="flex-1 px-4 py-6 space-y-1">

    <!-- Dashboard -->
    <a href="{{ url('/home') }}"
       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition group {{ request()->is('home') ? 'active' : '' }}">
        <i class="fas fa-chart-line w-5 text-accent"></i>
        <span class="font-medium">Dashboard</span>
    </a>

    <!-- Administrator -->
    <a href="{{ url('/users') }}"
       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition {{ request()->is('users*') ? 'active' : '' }}">
        <i class="fas fa-user-cog w-5 text-info"></i>
        <span class="font-medium">Administrator</span>
    </a>

    <!-- Emergency Type -->
    <a href="{{ url('/emergency-types') }}"
       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition {{ request()->is('emergency-types*') ? 'active' : '' }}">
        <i class="fas fa-triangle-exclamation w-5 text-warning"></i>
        <span class="font-medium">Emergency Type</span>
    </a>

    <!-- Rescuers Pending -->
    <a href="{{ url('/rescuers-pending') }}"
       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition {{ request()->is('rescuers-pending') ? 'active' : '' }}">
        <i class="fas fa-user-clock w-5 text-orange-500"></i>
        <span class="font-medium">Rescuers Pending</span>
        <span class="ml-auto bg-accent/20 text-accent text-xs px-2 py-0.5 rounded-full">
            {{ $stats->totalRescuePending() }}
        </span>
    </a>

    <!-- Rescuers -->
    <a href="{{ route('rescuers.index') }}"
       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition {{ request()->is('rescuers') ? 'active' : '' }}">
        <i class="fas fa-user-nurse w-5 text-green-500"></i>
        <span class="font-medium">Rescuers</span>
    </a>

    <!-- Citizens Pending -->
    <a href="{{ url('/citizens-pending') }}"
       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition {{ request()->is('citizens-pending') ? 'active' : '' }}">
        <i class="fas fa-user-clock w-5 text-orange-500"></i>
        <span class="font-medium">Citizens Pending</span>
        <span class="ml-auto bg-accent/20 text-accent text-xs px-2 py-0.5 rounded-full">
            {{ $stats->totalCitizenPending() }}
        </span>
    </a>

    <!-- Citizens -->
    <a href="{{ url('/citizens') }}"
       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition {{ request()->is('citizens') ? 'active' : '' }}">
        <i class="fas fa-users w-5 text-blue-500"></i>
        <span class="font-medium">Citizens</span>
    </a>

    <!-- Incidents -->
    <a href="{{ url('/incidents') }}"
       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition {{ request()->is('incidents*') ? 'active' : '' }}">
        <i class="fas fa-exclamation-triangle w-5 text-red-500"></i>
        <span class="font-medium">Incidents</span>
    </a>

    <!-- Evacuation Points -->
    <a href="{{ url('/evacuation-points') }}"
       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800/60 transition {{ request()->is('evacuation-points*') ? 'active' : '' }}">
        <i class="fas fa-location-dot w-5 text-indigo-500"></i>
        <span class="font-medium">Evacuation Points</span>
    </a>

</nav>