<?php
admin_start_form_protection_buffer();
?>
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.15.9/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@barba/core"></script>
<link rel="stylesheet" href="https://unpkg.com/flowbite@4.0.1/dist/flowbite.min.css">
<script src="https://unpkg.com/flowbite@4.0.1/dist/flowbite.js"></script>
<script>

    function logoutpashupatisession(){
        window.location.replace('logout.php');
    }

    function indexme(){
        window.location.replace('index.php');
    }

</script>
    <div class="min-h-screen flex flex-col">
    <header class="shadow-inherit text-gray-600 body-font z-50 bg-white/95 backdrop-blur" style="box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.08), 0 8px 10px -6px rgb(0 0 0 / 0.08);">
      <div class="container mx-auto flex flex-wrap items-center gap-4 px-5 py-3 md:flex-row">
        <a class="flex items-center gap-3 title-font font-medium text-gray-900">

          <img onclick="indexme()" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="h-16 w-16 rounded-full object-contain sm:h-20 sm:w-20 lg:h-24 lg:w-24" viewBox="0 0 24 24" src="../assets/images/defaults/logo_white.png" style="cursor: pointer;">

          <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-[11px] font-black uppercase tracking-[0.32em] text-blue-700 shadow-sm sm:text-xs">ADMIN PANEL</span>
        </a>

        <nav class="order-3 flex w-full flex-wrap items-center gap-2 text-base font-semibold text-slate-600 md:order-2 md:ml-auto md:w-auto md:gap-5">
          <a href="dashboard.php" class="rounded-full px-3 py-1.5 transition hover:bg-blue-50 hover:text-blue-700">Dashboard</a>
          <a href="staff.php" class="rounded-full px-3 py-1.5 transition hover:bg-blue-50 hover:text-blue-700">Staff</a>
          <a href="site_content.php" class="rounded-full px-3 py-1.5 transition hover:bg-blue-50 hover:text-blue-700">Content</a>
          <a href="manage_admins.php" class="rounded-full px-3 py-1.5 transition hover:bg-blue-50 hover:text-blue-700">Admins</a>
        </nav>

        <button onclick="logoutpashupatisession()" class="order-2 inline-flex items-center rounded-full border border-blue-700 bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 md:order-3">Logout <?php echo $_SESSION["usr_nam"]; ?>
          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
            <path d="M5 12h14M12 5l7 7-7 7"></path>
          </svg>
        </button>
      </div>
    </header>
    <style>
      main {
        flex: 1 1 auto;
      }
    </style>
    
