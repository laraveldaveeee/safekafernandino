<nav class="relative bg-gradient-to-r from-gray-900 to-gray-800 shadow-lg">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">

      <!-- LEFT SIDE -->
      <div class="flex items-center">
        <!-- Mobile menu button -->
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

        <!-- Desktop Menu -->
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

      <!-- RIGHT SIDE -->
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
</nav>