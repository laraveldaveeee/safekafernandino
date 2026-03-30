@extends('layouts.backend')

@section('content')
 <main class="bg-gray-100 min-h-screen">

  <!-- CONTAINER -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
      <div class="flex items-center space-x-3">
        <div class="p-2 bg-blue-100 rounded-lg">
          <svg class="size-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
          </svg>
        </div>
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Rescuers</h1>
          <p class="text-sm text-gray-500">List of all registered rescuers</p>
        </div>
      </div>
      </div>
        <div id="app">

          <rescuers></rescuers> 
        </div>
    </div>
  </div>
</div>
</main>
@endsection
