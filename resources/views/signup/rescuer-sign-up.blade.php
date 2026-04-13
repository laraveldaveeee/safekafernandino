<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Form</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen"> 
  <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-2xl">
    <h2 class="text-2xl font-bold mb-6 text-center">Sign Up</h2> 
      
    <div id="app">
      <sign-up-rescuer></sign-up-rescuer>
    </div>
  </div>

   <script src="{{ asset('js/app.js') }}"></script>

</body>
</html>