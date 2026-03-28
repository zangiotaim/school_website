    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.15.9/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/flowbite@4.0.1/dist/flowbite.min.css">
    <script src="https://unpkg.com/flowbite@4.0.1/dist/flowbite.js"></script>
    <script>
function homepage() {
    window.location.replace('index.php');
}
    </script>
    <!-- jsdelivr -->
    <script src="https://cdn.jsdelivr.net/npm/@barba/core"></script>
    <style>
        .site-notice-track {
            display: inline-flex;
            width: max-content;
            animation: siteNoticeScroll 24s linear infinite;
        }

        @keyframes siteNoticeScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
    </style>
    <div class="overflow-hidden bg-blue-700 py-2 text-white">
        <div class="site-notice-track whitespace-nowrap text-sm font-semibold tracking-wide">
            <span class="px-8 inline-flex items-center gap-2"><span class="rounded-full bg-blue-500/25 px-2.5 py-0.5 text-[11px] font-bold tracking-widest text-blue-100 ring-1 ring-blue-200/40">EN</span><span>Site is currently in test mode. Content is being filled up and updated gradually. Please check back soon for the full experience.</span></span>
            <span class="px-8 inline-flex items-center gap-2"><span class="rounded-full bg-emerald-500/25 px-2.5 py-0.5 text-[11px] font-bold tracking-widest text-emerald-100 ring-1 ring-emerald-200/40">UZ</span><span>Veb-sayt hozir sinov rejimida ishlamoqda. Kontent bosqichma-bosqich to‘ldirilmoqda va yangilanmoqda. Iltimos, to‘liq imkoniyatlar uchun tez orada qayta tashrif buyuring.</span></span>
            <span class="px-8 inline-flex items-center gap-2"><span class="rounded-full bg-blue-500/25 px-2.5 py-0.5 text-[11px] font-bold tracking-widest text-blue-100 ring-1 ring-blue-200/40">EN</span><span>Site is currently in test mode. Content is being filled up and updated gradually. Please check back soon for the full experience.</span></span>
            <span class="px-8 inline-flex items-center gap-2"><span class="rounded-full bg-emerald-500/25 px-2.5 py-0.5 text-[11px] font-bold tracking-widest text-emerald-100 ring-1 ring-emerald-200/40">UZ</span><span>Veb-sayt hozir sinov rejimida ishlamoqda. Kontent bosqichma-bosqich to‘ldirilmoqda va yangilanmoqda. Iltimos, to‘liq imkoniyatlar uchun tez orada qayta tashrif buyuring.</span></span>
        </div>
    </div>
    <header class="shadow-inherit text-gray-600 body-font z-50 opacity-95"
        style="box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1); background-image: url(assets/images/defaults/header_bg4.png); background-size:cover; background-repeat:no-repeat;">
        <div class="container mx-auto flex flex-wrap py-3 px-5 flex-col md:flex-row items-center">
            <a class="flex items-center gap-3 title-font font-medium text-gray-900 mb-4 md:mb-0">
                <img onclick="homepage()" style="cursor: pointer;" class="h-[100px] w-[100px] rounded-full object-cover"
                    src="assets/images/defaults/logo_white.png" alt="School logo">
                <span class="max-w-[16rem] text-base font-extrabold leading-tight tracking-tight text-slate-900 sm:text-lg md:text-xl">Zangiota tuman ixtisoslashtirilgan maktabi</span>
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base md:font-bold justify-center">
                <a href="index.php" class="text-sm md:text-base mr-5 hover:text-gray-900">Home</a>
                <a href="about_us.php" class="text-sm md:text-base mr-5 hover:text-gray-900">About</a>
                <a href="staff.php" class="text-sm md:text-base mr-5 hover:text-gray-900">Staff</a>
                <a href="notices.php" class="text-sm md:text-base mr-5 hover:text-gray-900">Notices</a>
                <a href="extra_resources.php" class="text-sm md:text-base mr-5 hover:text-gray-900">Extras</a>
                <a href="contact_us.php" class="text-sm md:text-base mr-5 hover:text-gray-900">Contact Us</a>
            </nav>
            <button onclick="joinus()"
                class="inline-flex items-center border-0 py-1 px-3 focus:outline-none rounded text-base mt-4 md:mt-0 text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Join
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                    <path d="M5 12h14M12 5l7 7-7 7"></path>
                </svg>
            </button>
        </div>
    </header>
