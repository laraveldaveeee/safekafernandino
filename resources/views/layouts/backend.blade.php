{{-- <!DOCTYPE html>
 <html class="h-full">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
	<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
	<link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
	<title></title>
</head>
  <body class="h-full"> --}}


  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
  <title>RescueOps | Emergency Dashboard</title>
  <!-- Tailwind CSS v3 + Font Awesome + Google Fonts -->
  <script src="https://cdn.tailwindcss.com"></script>
  	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            'sans': ['Inter', 'system-ui', 'Segoe UI', 'sans-serif'],
          },
          colors: {
            'dark-bg': '#0a0f1c',
            'dark-sidebar': '#0f172f',
            'dark-card': '#111827',
            'light-bg': '#f1f5f9',
            'light-sidebar': '#ffffff',
            'light-card': '#ffffff',
            'accent': '#ef4444',
            'accent-hover': '#dc2626',
            'accent-soft': '#fef2f2',
            'success': '#10b981',
            'warning': '#f59e0b',
            'info': '#3b82f6',
          },
          boxShadow: {
            'soft': '0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05)',
            'card': '0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -4px rgba(0, 0, 0, 0.02)',
            'sidebar': '4px 0 10px -5px rgba(0, 0, 0, 0.05)',
          }
        }
      }
    }
  </script>
  <style>
    * {
      transition: background-color 0.2s ease, border-color 0.2s, color 0.2s;
    }
    body {
      transition: background 0.3s;
    }
    /* custom scroll */
    ::-webkit-scrollbar {
      width: 5px;
    }
    ::-webkit-scrollbar-track {
      background: #e2e8f0;
      border-radius: 10px;
    }
    ::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 10px;
    }
    .dark ::-webkit-scrollbar-track {
      background: #1e293b;
    }
    .dark ::-webkit-scrollbar-thumb {
      background: #334155;
    }
    .sidebar-link {
      transition: all 0.2s ease;
    }
    .sidebar-link.active {
      background-color: rgba(239, 68, 68, 0.1);
      color: #ef4444;
      border-right: 3px solid #ef4444;
    }
    .dark .sidebar-link.active {
      background-color: rgba(239, 68, 68, 0.15);
      color: #f87171;
    }
    .card-hover {
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .card-hover:hover {
      transform: translateY(-2px);
      box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.1);
    }
  </style>
  <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-light-bg dark:bg-dark-bg font-sans antialiased">

  <!-- main flex layout: sidebar + content -->
  <div class="flex h-screen overflow-hidden">
    
    <!-- ================= SIDEBAR ================= -->
    <aside class="w-72 flex-shrink-0 bg-light-sidebar dark:bg-dark-sidebar shadow-sidebar border-r border-gray-200 dark:border-gray-800 flex flex-col transition-all duration-300 z-10 overflow-y-auto">
      <!-- Logo & Brand -->
      <div class="px-6 py-6 border-b border-gray-100 dark:border-gray-800">
        <div class="flex items-center gap-3"> 
           <img src="{{ asset('img/sf-logo.png') }}" class="h-9 w-auto"> 
          <div>
            <h1 class="text-xl font-bold text-gray-800 dark:text-white">SafeKa<span class="text-accent">Fernandino</span></h1>
            <p class="text-xs text-gray-500 dark:text-gray-400">San Fernando Pampanga</p>
          </div>
        </div>
      </div>

  @include ('layouts.nav')

   <!-- Bottom user & theme -->
      <div class="p-5 border-t border-gray-100 dark:border-gray-800 mt-auto">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-accent to-rose-500 flex items-center justify-center text-white text-sm font-bold">AD</div>
            <div class="text-sm">
              <p class="font-medium text-gray-700 dark:text-gray-200">{{ Auth::user()->name }}</p>
              <p class="text-xs text-gray-400">Administrator</p>
            </div>
          </div>
          <button id="mobileThemeToggle" class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-600 dark:text-gray-300">
            <i class="fas fa-moon dark:hidden"></i>
            <i class="fas fa-sun hidden dark:inline"></i>
          </button>
        </div>
      </div>
    </aside>


	@yield('content')
 <div id="evacuation-section" class="section-content hidden animate-fadeIn"><div class="bg-light-card dark:bg-dark-card rounded-2xl p-6 shadow-card"><h2 class="text-xl font-bold mb-4"><i class="fas fa-map-marker-alt mr-2 text-info"></i>Evacuation Points</h2><div class="grid grid-cols-1 md:grid-cols-2 gap-4"><div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20"><p class="font-bold">Community Center</p><p class="text-sm">Capacity: 250 people</p><div class="mt-2 bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full inline-block">Open</div></div><div class="p-4 rounded-xl bg-amber-50 dark:bg-amber-900/20"><p class="font-bold">High School Gym</p><p class="text-sm">Capacity: 400 people</p><div class="mt-2 bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">Near Capacity</div></div></div></div></div>
   </main>
  </div>

 <script src="{{ asset('js/app.js') }}"></script>

  <style>
    .animate-fadeIn {
      animation: fadeIn 0.3s ease-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(6px);}
      to { opacity: 1; transform: translateY(0);}
    }
    .section-content {
      transition: all 0.2s;
    }
  </style>

  <script>
    // Theme Toggle (both buttons)
    function setTheme(isDark) {
      if (isDark) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
      } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
      }
    }
    // Check initial
    if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
    const mobileBtn = document.getElementById('mobileThemeToggle');
    const desktopBtn = document.getElementById('desktopThemeToggle');
    const toggleTheme = () => {
      const isDark = document.documentElement.classList.contains('dark');
      setTheme(!isDark);
    };
    mobileBtn?.addEventListener('click', toggleTheme);
    desktopBtn?.addEventListener('click', toggleTheme);

 
    // Get all sidebar links
    const navLinks = document.querySelectorAll('.sidebar-link');
    const pageTitleSpan = document.getElementById('pageTitle');
    
    function activateSection(sectionId) {
      // Hide all section contents
      sections.forEach(sec => {
        const el = document.getElementById(`${sec}-section`);
        if (el) el.classList.add('hidden');
      });
      const activeContent = document.getElementById(`${sectionId}-section`);
      if (activeContent) activeContent.classList.remove('hidden');
      // Update page title
      if (pageTitleSpan && sectionMap[sectionId]) {
        pageTitleSpan.innerText = sectionMap[sectionId];
      }
      // Update active class on sidebar
      navLinks.forEach(link => {
        const linkSection = link.getAttribute('data-section');
        if (linkSection === sectionId) {
          link.classList.add('active');
        } else {
          link.classList.remove('active');
        }
      });
    }

  </script>
</body>
</html>