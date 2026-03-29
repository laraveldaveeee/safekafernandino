@extends('layouts.backend')

@section('content') 
<main class="bg-gray-100 min-h-screen">

  <!-- CONTAINER -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
      <div class="flex items-center space-x-3">
        <div class="p-2 bg-red-300 rounded-lg">
          <svg class="size-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <svg xmlns="http://www.w3.org/2000/svg" 
             class="w-6 h-6 text-white" 
             fill="none" 
             viewBox="0 0 24 24" 
             stroke="currentColor">
            <path stroke-linecap="round" 
                  stroke-linejoin="round" 
                  stroke-width="2" 
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
        </div>
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Incidents</h1>
          <p class="text-sm text-gray-500">List of all incidents </p>
        </div>
      </div>

    </div>
      <div id="app">
        <incidents></incidents>
      </div>
  </div>
</div>
</main>
@endsection
