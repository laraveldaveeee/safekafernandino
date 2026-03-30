@extends('layouts.backend')

@section('content')
<!-- PAGE CONTENT -->
<main class="bg-gray-100 min-h-screen">

  <!-- CONTAINER -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    <!-- HEADER -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-gray-800">Rescuer Profile</h1>
      <p class="text-gray-500 text-sm">View and manage rescuer details</p>
    </div>

      <div id="app">
          <rescuers-pending-manage :rescuer-id="{{ $rescuer->id }}"></rescuers-pending-manage>
      </div>

  </div>
</main>
@endsection
