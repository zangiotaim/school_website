<?php
include 'config/db.php';
include_once 'includes/content_helpers.php';
include_once 'includes/functions.php';

try {
    $row = db_select_one($connection, "SELECT * FROM web_content WHERE id = 1");
    $flash_notice = db_select_one($connection, "SELECT * FROM flash_notice WHERE id = 1");
    $carousel_images = get_carousel_images($connection);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$heroImages = array_slice($carousel_images ?? [], 0, 3);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/utilities.css">
    <link rel="icon" type="image/x-icon" href="assets/images/logo2.png">
    <link rel="stylesheet" href="css/animation.css">
</head>

<body>
    <?php include('includes/header.php') ?>

    <main class="bg-slate-50">
        <section class="relative overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.10),_transparent_30%),radial-gradient(circle_at_top_right,_rgba(219,234,254,0.85),_transparent_28%),linear-gradient(180deg,#f8fbff_0%,#eef5ff_100%)]">
            <div class="mx-auto w-full max-w-[90rem] px-4 pt-6 pb-3 sm:px-6 lg:px-8">
                <div class="mb-3">
                    <div class="w-full rounded-3xl border border-white/70 bg-white/80 p-6 shadow-lg shadow-slate-200/60 backdrop-blur">
                        <span class="inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.25em] text-blue-700">Welcome to school life</span>
                        <h1 class="mt-4 max-w-5xl text-3xl font-black tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">
                            Zangiota tuman ixtisoslashtirilgan maktabi
                        </h1>
                        <p class="mt-3 max-w-[90rem] text-[1.1rem] leading-7 text-slate-600">
                            <?php echo $row['one']; ?>
                        </p>
                        <div class="mt-6 flex flex-wrap gap-3">
                            <a href="join_us.php" class="inline-flex items-center justify-center rounded-full bg-blue-700 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-700/20 transition hover:bg-blue-800">Join Us</a>
                            <a href="about.php" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-blue-500 hover:text-blue-700">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mx-auto w-full max-w-[90rem] px-4 pb-3 sm:px-6 lg:px-8">
                <div class="grid gap-4 md:grid-cols-[1.2fr_1fr] md:h-[420px] lg:h-[520px]">
                    <div class="relative overflow-hidden rounded-3xl ring-1 ring-slate-200 shadow-2xl shadow-slate-300/40 md:h-full bg-blue-50">
                        <?php if (!empty($heroImages[0])) : ?>
                            <img src="<?php echo escape_html($heroImages[0]['image_url']); ?>" alt="<?php echo escape_html($heroImages[0]['alt_text'] ?? 'School image'); ?>" class="absolute inset-0 h-full w-full object-cover">
                        <?php endif; ?>
                    </div>

                    <div class="grid gap-4 md:grid-rows-2 md:h-full">
                        <div class="relative overflow-hidden rounded-3xl ring-1 ring-slate-200 shadow-2xl shadow-slate-300/40 md:h-full bg-blue-50">
                            <?php if (!empty($heroImages[1])) : ?>
                                <img src="<?php echo escape_html($heroImages[1]['image_url']); ?>" alt="<?php echo escape_html($heroImages[1]['alt_text'] ?? 'School image'); ?>" class="absolute inset-0 h-full w-full object-cover">
                            <?php endif; ?>
                        </div>
                        <div class="relative overflow-hidden rounded-3xl ring-1 ring-slate-200 shadow-2xl shadow-slate-300/40 md:h-full bg-blue-50">
                            <?php if (!empty($heroImages[2])) : ?>
                                <img src="<?php echo escape_html($heroImages[2]['image_url']); ?>" alt="<?php echo escape_html($heroImages[2]['alt_text'] ?? 'School image'); ?>" class="absolute inset-0 h-full w-full object-cover">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-[linear-gradient(180deg,#eef5ff_0%,#f8fbff_42%,#f8fafc_100%)]">
            <div class="mx-auto max-w-[90rem] px-4 pt-4 pb-8 sm:px-6 lg:px-8">
            <div class="mb-5 rounded-3xl border border-slate-200 bg-white/80 p-6 shadow-sm backdrop-blur">
                <h2 class="text-2xl font-black tracking-tight text-slate-900 sm:text-3xl">Why Zangiota IM?</h2>
                <p class="mt-3 text-[1.1rem] leading-7 text-slate-600">
                    <?php echo $row['two']; ?>
                </p>
            </div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-4">
                <div class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="mb-4 flex items-center gap-4">
                        <div class="inline-flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 ring-1 ring-amber-100">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <circle cx="12" cy="8.5" r="4.5" />
                                <path d="m9.5 13 2.5 2 2.5-2" />
                                <path d="M10 14.5V20l2-1.5 2 1.5v-5.5" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold leading-snug text-slate-900">Highly Qualified Teachers</h3>
                    </div>
                    <p class="text-[1.1rem] leading-7 text-slate-600"><?php echo $row['three']; ?></p>
                </div>
                <div class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="mb-4 flex items-center gap-4">
                        <div class="inline-flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 ring-1 ring-emerald-100">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M3 14c4-1 6-5 9-5 2.5 0 3.5 1.5 5.5 1.5 1.2 0 2.4-.5 3.5-1.5" />
                                <path d="M4 18c3-1.2 5.2-4.2 8.2-4.2 2.7 0 3.6 1.7 5.7 1.7 1 0 1.9-.3 3.1-1" />
                                <path d="M7 9c.8-1.7 2.1-3.1 4-4" />
                                <path d="M13.5 6.5c.5-1.2 1.3-2.2 2.5-3" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold leading-snug text-slate-900">Peaceful Environment</h3>
                    </div>
                    <p class="text-[1.1rem] leading-7 text-slate-600"><?php echo $row['four']; ?></p>
                </div>
                <div class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="mb-4 flex items-center gap-4">
                        <div class="inline-flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-sky-50 text-sky-600 ring-1 ring-sky-100">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <rect x="4" y="5" width="16" height="11" rx="2" />
                                <path d="M10 19h4" />
                                <path d="M12 16v3" />
                                <path d="M8 9h8" />
                                <path d="M8 12h5" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold leading-snug text-slate-900">Digital Learning</h3>
                    </div>
                    <p class="text-[1.1rem] leading-7 text-slate-600"><?php echo $row['five']; ?></p>
                </div>
                <div class="group rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-xl">
                    <div class="mb-4 flex items-center gap-4">
                        <div class="inline-flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 ring-1 ring-violet-100">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M12 3l7 4v5c0 4.2-2.6 7.7-7 9-4.4-1.3-7-4.8-7-9V7l7-4Z" />
                                <path d="M9.5 12.5l1.7 1.7 3.3-4.2" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold leading-snug text-slate-900">Facilitated Development Environment</h3>
                    </div>
                    <p class="text-[1.1rem] leading-7 text-slate-600"><?php echo $row['six']; ?></p>
                </div>
            </div>
            </div>
        </section>

        <section class="mx-auto max-w-[90rem] px-4 pt-4 pb-8 sm:px-6 lg:px-8">
            <div class="grid gap-8 lg:grid-cols-2">
                <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <h2 class="text-2xl font-black tracking-tight text-slate-900">What students say about us?</h2>
                    <p class="mt-3 text-[1.1rem] leading-7 text-slate-600">
                        <?php echo $row['seven']; ?>
                    </p>
                </div>
                <div class="rounded-3xl border border-blue-100 bg-gradient-to-br from-blue-50 via-white to-sky-50 p-6 shadow-sm shadow-blue-100">
                    <h2 class="text-2xl font-black tracking-tight text-slate-900">Computer Engineering</h2>
                    <p class="mt-3 text-[1.1rem] leading-7 text-slate-700">
                        <?php echo $row['eight']; ?>
                    </p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="join_us.php" class="inline-flex items-center rounded-full bg-blue-700 px-5 py-3 text-sm font-semibold text-white transition hover:bg-blue-800">Join Computer Engineering</a>
                        <a href="about.php#courses" class="inline-flex items-center rounded-full border border-blue-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:border-blue-300 hover:text-blue-700">Explore Courses</a>
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
                            <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">' . $flash_notice['title'] . '</h3>
                            <img class="object-cover w-full rounded-lg" src="' . $flash_notice['image_url'] . '" alt="">
                            <p class="mt-3 font-bold">' . $flash_notice['message'] . '</p>
                        </div>
                        <div class="justify-between items-center pt-0 space-y-4 sm:flex sm:space-y-0">
                            <a href="about.php" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">See About School</a>
                            <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                                <button id="close-modal" type="button" class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-blue-700 sm:w-auto hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
        ?>
    </main>

    <script>
        const modalEl = document.getElementById('info-popup');
        if (modalEl) {
            const privacyModal = new Modal(modalEl, { placement: 'center' });
            privacyModal.show();
            const closeModalEl = document.getElementById('close-modal');
            if (closeModalEl) {
                closeModalEl.addEventListener('click', function() {
                    privacyModal.hide();
                });
            }
        }
    </script>
</body>

</html>
