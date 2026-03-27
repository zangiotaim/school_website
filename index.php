<?php
include 'config/db.php';

try {
    $row = db_select_one($connection, "SELECT * FROM web_content WHERE id = 1");
    $flash_notice = db_select_one($connection, "SELECT * FROM flash_notice WHERE id = 1");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="css/utilities.css">
    <link rel="icon" type="image/x-icon" href="assets/images/logo2.png">
    <link rel="stylesheet" href="css/animation.css">
    <style>

    </style>
</head>

<body>
   
<?php include('includes/header.php') ?>

    <main class="bg-slate-50">
        <section class="relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-sky-50 via-blue-50 to-white opacity-100"></div>
            <div class="mx-auto w-full px-4 pt-6 pb-4 sm:px-6 lg:px-8">
                <div class="mb-6">
                    <div class="w-full rounded-3xl border border-white/70 bg-white/80 p-6 shadow-lg shadow-slate-200/60 backdrop-blur">
                        <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-blue-700">Welcome to school life</span>
                        <h1 class="mt-4 max-w-5xl text-3xl font-black tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">
                            Zangiota tuman ixtisoslashtirilgan maktabi
                        </h1>
                        <p class="mt-3 max-w-7xl text-sm leading-7 text-slate-600 sm:text-base">
                            <?php echo $row['one']; ?>
                        </p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="join_us.php" class="inline-flex items-center justify-center rounded-full bg-blue-700 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-700/20 transition hover:bg-blue-800">Join Us</a>
                            <a href="about_us.php" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-blue-500 hover:text-blue-700">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto w-full px-4 pb-8 sm:px-6 lg:px-8">
                <div id="default-carousel" class="relative overflow-hidden rounded-3xl shadow-2xl shadow-slate-300/40 ring-1 ring-slate-200" data-carousel="static">
                    <!-- Carousel wrapper -->
                    <div class="relative h-64 overflow-hidden sm:h-80 xl:h-[30rem]">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <span
                        class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">First
                        Slide</span>
                    <img src="assets/images/school_images/fullschool.jpg"
                        class="object-contain block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                        alt="...">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="assets/images/school_images/mainschool.jpg"
                        class="object-contain block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                        alt="...">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="assets/images/school_images/engineeringschool.jpg"
                        class="object-contain block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2"
                        alt="...">
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3"
                    data-carousel-slide-to="2"></button>
            </div>
            <!-- Slider controls -->
            <button type="button"
                class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                        </path>
                    </svg>
                    <span class="hidden">Previous</span>
                </span>
            </button>
            <button type="button"
                class="nextimage flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                    <span class="hidden">Next</span>
                </span>
                </button>
                </div>

                <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="mb-8 max-w-7xl">
                <h2 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">Why Zangiota IM?</h2>
                <p class="mt-3 text-sm leading-7 text-slate-600 sm:text-base">
                    <?php echo $row['two']; ?>
                </p>
            </div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
                <div class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="mb-5 inline-flex rounded-2xl bg-blue-50 p-3 text-blue-600">
                        <svg class="hi-outline hi-template inline-block h-8 w-8" stroke="currentColor"
                            fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-slate-900">
                        Highly Qualified Teachers
                    </h3>
                    <p class="text-sm leading-7 text-slate-600"><?php echo $row['three']; ?></p>
                </div>

                <div class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="mb-5 inline-flex rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                        <svg class="hi-outline hi-cube inline-block h-8 w-8" stroke="currentColor"
                            fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-slate-900">
                        Peaceful Environment
                    </h3>
                    <p class="text-sm leading-7 text-slate-600"><?php echo $row['four']; ?></p>
                </div>

                <div class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="mb-5 inline-flex rounded-2xl bg-violet-50 p-3 text-violet-600">
                        <svg class="hi-outline hi-cog inline-block h-8 w-8" stroke="currentColor"
                            fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-slate-900">
                        Digital Learning
                    </h3>
                    <p class="text-sm leading-7 text-slate-600"><?php echo $row['five']; ?></p>
                </div>

                <div class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="mb-5 inline-flex rounded-2xl bg-amber-50 p-3 text-amber-600">
                        <svg class="hi-outline hi-sparkles inline-block h-8 w-8" stroke="currentColor"
                            fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-bold text-slate-900">
                        Facilited Development Enviroment
                    </h3>
                    <p class="text-sm leading-7 text-slate-600"><?php echo $row['six']; ?></p>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-2">
                <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <h2 class="text-2xl font-black tracking-tight text-slate-900">What students say about us?</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">
                        <?php echo $row['seven']; ?>
                    </p>
                </div>
                <div class="rounded-3xl bg-gradient-to-br from-blue-600 to-sky-700 p-6 text-white shadow-xl shadow-blue-200">
                    <h2 class="text-2xl font-black tracking-tight">Computer Engineering</h2>
                    <p class="mt-3 text-sm leading-7 text-white/90">
                        <?php echo $row['eight']; ?>
                    </p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="join_us.php" class="inline-flex items-center rounded-full bg-white px-5 py-3 text-sm font-semibold text-blue-700 transition hover:bg-slate-100">Join Computer Engineering</a>
                        <a href="about_us.php#courses" class="inline-flex items-center rounded-full border border-white/30 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10">Explore Courses</a>
                    </div>
                </div>
            </div>
        </section>

    <?php include('includes/footer.php') ?>


    

<?php 
if ((int) $flash_notice['is_enabled'] === 1) {
echo '
<div id="info-popup" tabindex="-1" class="fadeIn hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-lg h-full md:h-auto">
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 md:p-8">
            <div class="mb-4 text-sm font-light text-gray-500 dark:text-gray-400">
                <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">'. $flash_notice['title'] .'</h3>
                <img class="object-cover w-full rounded-lg" src="'. $flash_notice['image_url'] .'" alt="">
                <p class="mt-3 font-bold">
                    '. $flash_notice['message'] . '
                </p>
            </div>
            <div class="justify-between items-center pt-0 space-y-4 sm:flex sm:space-y-0">
                <a href="about_us.php" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">See About School</a>
                <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">                  
                    <button id="close-modal" type="button" class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-auto hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
';
}
?>
</body>
<script>
const modalEl = document.getElementById('info-popup');
const privacyModal = new Modal(modalEl, {
    placement: 'center'
});

privacyModal.show();

const closeModalEl = document.getElementById('close-modal');
closeModalEl.addEventListener('click', function() {
    privacyModal.hide();
});

setInterval(updatecarsoul, 5000);

function updatecarsoul() {
    document.getElementsByClassName('nextimage')[0].click();
}
//console.clear();
</script>

</html>
