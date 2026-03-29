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
    <!-- INFO / WARNING PANEL -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">

  <!-- LEGEND -->
  <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
    <h2 class="text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
     Legend & Status
    </h2>

    <div class="space-y-2 text-sm">

      <div class="flex items-center gap-3">
        <span class="w-3 h-3 rounded-full bg-green-500"></span>
        <span>Safe</span>
      </div>

      <div class="flex items-center gap-3">
        <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
        <span>Semi-Crowded</span>
      </div>

      <div class="flex items-center gap-3">
        <span class="w-3 h-3 rounded-full bg-orange-500"></span>
        <span>Crowded</span>
      </div>

      <div class="flex items-center gap-3">
        <span class="w-3 h-3 rounded-full bg-red-500"></span>
        <span>Danger</span>
      </div>

    </div>
  </div>

  <!-- TIPS / WARNING -->
  <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 shadow-sm">
    <h2 class="text-sm font-semibold text-blue-700 mb-2 flex items-center gap-2">
      ⚠️ Important Notes
    </h2>

    <ul class="text-sm text-blue-800 space-y-2">
      <li>• Double-click the map to automatically fill coordinates in the form.</li>
      <li>• Always verify evacuation point safety status before saving.</li>
      <li>• Keep data updated for real-time emergency response.</li>
    </ul>
  </div>

</div>
    <div id="app">
        <evacuation-point></evacuation-point> 
    </div>

  </div>
</main>

 
                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
