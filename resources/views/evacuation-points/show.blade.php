@extends('layouts.backend')

@section('content')
<!-- PAGE CONTENT -->
<main class="bg-gray-100 min-h-screen">

  <!-- CONTAINER -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
      <div class="flex items-center space-x-3">
        <div class="p-2 bg-blue-100 rounded-lg">
        <svg class="w-6 h-6 text-blue-600" 
             fill="none" 
             stroke="currentColor" 
             viewBox="0 0 24 24">
             
          <path stroke-linecap="round" 
                stroke-linejoin="round" 
                stroke-width="1.5" 
                d="M12 21s-6-5.686-6-10a6 6 0 1112 0c0 4.314-6 10-6 10z" />
                
          <circle cx="12" cy="11" r="2.5" />
        </svg>
        </div>
        <div>
          <h1 class="text-2xl font-bold text-gray-800">Evacuation Point</h1>
          <p class="text-sm text-gray-500">List of all Evacuation Point</p>
        </div>
      </div>
      </div>

    <!-- MAP CONTAINER -->
    <div class="bg-white shadow-lg rounded-xl p-4">

      <div class="w-full h-[500px] rounded-lg overflow-hidden border">

       <iframe
        class="w-full h-[500px] rounded-lg border"
        loading="lazy"
        allowfullscreen
        src="https://www.google.com/maps?q={{ $evacuationPoint->latitude }},{{ $evacuationPoint->longitude }}&z=15&output=embed">
      </iframe>

      </div>

    </div>

  </div>

</main>
@endsection