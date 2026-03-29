<?php
include '../config/db.php';
include_once '../includes/admin_auth.php';
admin_require_auth(true);

try {
    $row = db_select_one($connection, "SELECT * FROM notification WHERE id = 1");
    $feedback = db_select_one($connection, "SELECT * FROM notification WHERE id = 2");
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Zangiota IM</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/defaults/logo_white.png">

    <style>

    </style>
</head>

<body>
    <?php include('../includes/admin_header.php') ?>

    <main>
        <section class="text-gray-600 body-font">

            <div class="container px-5 py-10 mx-auto">
            <div class="flex flex-col text-center w-full mb-12">
                <span class="mx-auto inline-flex items-center rounded-full bg-blue-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.28em] text-blue-700">ADMIN PANEL</span>
                <h1 class="mt-4 sm:text-3xl text-2xl font-black title-font mb-4 text-slate-900">Welcome to the Admin Panel</h1>
                <p class="text-sm md:text-base lg:w-2/3 mx-auto leading-relaxed text-slate-600">
                    Manage notices, staff, content, galleries, routines, and feedback from one organized dashboard. The cards below open the main admin tools used to keep the school website up to date.
                </p>
            </div>
                <div class="mx-auto grid max-w-7xl gap-4 md:grid-cols-2 xl:grid-cols-3">
                    <div class="cursor-pointer" onclick="flash_notice()">
                        <div class="flex h-full items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:bg-blue-50 hover:shadow-lg">
                            <img alt="team"
                                class="h-14 w-14 flex-shrink-0 rounded-2xl bg-gray-100 object-cover object-center"
                                src="../assets/images/admin_avatars/flash_notice.png">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-base font-bold leading-snug text-blue-700">Flash Home Welcome</h2>
                                <p class="mt-1 text-sm leading-6 text-slate-500">Create a new welcome flash card for the homepage.</p>
                            </div>
                        </div>
                    </div>



                    <div class="cursor-pointer" onclick="add_notice()">
                        <div class="flex h-full items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:bg-blue-50 hover:shadow-lg">
                            <img alt="team"
                                class="h-14 w-14 flex-shrink-0 rounded-2xl bg-gray-100 object-cover object-center"
                                src="../assets/images/admin_avatars/notice.jpg">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-base font-bold leading-snug text-blue-700">Add Notices</h2>
                                <p class="mt-1 text-sm leading-6 text-slate-500">Add, edit, or remove school notices.</p>
                            </div>
                        </div>
                    </div>
                    <div class="cursor-pointer" onclick="registered_students()">
                        <span class="relative">
                            <div class="flex h-full items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:bg-blue-50 hover:shadow-lg">
                                <img alt="team"
                                    class="h-14 w-14 flex-shrink-0 rounded-2xl bg-gray-100 object-cover object-center"
                                    src="../assets/images/admin_avatars/registered.png">
                                <div class="min-w-0 flex-1">
                                    <h2 class="text-base font-bold leading-snug text-blue-700">View Registered Student</h2>
                                    <p class="mt-1 text-sm leading-6 text-slate-500">Students who registered online.</p>
                                </div>
                            </div>
                            <?php if($row['total_notification']!=0){
                                echo '
                            <div
                                class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                                '.$row['total_notification'].'</div>';

                            }
                            ?>

                        </span>
                    </div>
                    <div class="cursor-pointer" onclick="changeRoutine()">
                        <div class="flex h-full items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:bg-blue-50 hover:shadow-lg">
                            <img alt="team"
                                class="h-14 w-14 flex-shrink-0 rounded-2xl bg-gray-100 object-cover object-center"
                                src="../assets/images/admin_avatars/routine.png">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-base font-bold leading-snug text-blue-700">Change Routine</h2>
                                <p class="mt-1 text-sm leading-6 text-slate-500">Update class routines and timetable files.</p>
                            </div>
                        </div>
                    </div>
                    <div class="cursor-pointer" onclick="changeStaff()">
                        <div class="flex h-full items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:bg-blue-50 hover:shadow-lg">
                            <img alt="team"
                                class="h-14 w-14 flex-shrink-0 rounded-2xl bg-gray-100 object-cover object-center"
                                src="../assets/images/admin_avatars/staffs.png">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-base font-bold leading-snug text-blue-700">Change Staff Details</h2>
                                <p class="mt-1 text-sm leading-6 text-slate-500">Add, remove, and modify staff details.</p>
                            </div>
                        </div>
                    </div>

                    <div class="cursor-pointer" onclick="site_content()">
                        <div class="flex h-full items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:bg-blue-50 hover:shadow-lg">
                            <img alt="team"
                                class="h-14 w-14 flex-shrink-0 rounded-2xl bg-gray-100 object-cover object-center"
                                src="../assets/images/admin_avatars/site_content.jpg">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-base font-bold leading-snug text-blue-700">Change Site Content</h2>
                                <p class="mt-1 text-sm leading-6 text-slate-500">Edit the full website content in one place.</p>
                            </div>
                        </div>
                    </div>



                    <div class="cursor-pointer" onclick="add_gallery()">
                        <div class="flex h-full items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:bg-blue-50 hover:shadow-lg">
                            <img alt="team"
                                class="h-14 w-14 flex-shrink-0 rounded-2xl bg-gray-100 object-cover object-center"
                                src="../assets/images/admin_avatars/add_gallery.png">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-base font-bold leading-snug text-blue-700">Add Gallery</h2>
                                <p class="mt-1 text-sm leading-6 text-slate-500">Add school moments, events, and photos.</p>
                            </div>
                        </div>
                    </div>

                    <div class="cursor-pointer" onclick="feedback_page()">
                        <span class="relative">
                            <div class="flex h-full items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:bg-blue-50 hover:shadow-lg">
                                <img alt="team"
                                    class="h-14 w-14 flex-shrink-0 rounded-2xl bg-gray-100 object-cover object-center"
                                    src="../assets/images/admin_avatars/feedback.png">
                                <div class="min-w-0 flex-1">
                                    <h2 class="text-base font-bold leading-snug text-blue-700">View Feedback</h2>
                                    <p class="mt-1 text-sm leading-6 text-slate-500">Read feedback submitted through the website.</p>
                                </div>
                            </div>
                            <?php if($feedback['total_notification']!=0){
                                echo '
                            <div
                                class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">
                                '.$feedback['total_notification'].'</div>';
                            }
                            ?>
                        </span>
                    </div>

                    <div class="cursor-pointer" onclick="adminAndScribe()">
                        <div class="flex h-full items-start gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-blue-200 hover:bg-blue-50 hover:shadow-lg">
                            <img alt="team"
                                class="h-14 w-14 flex-shrink-0 rounded-2xl bg-gray-100 object-cover object-center"
                                src="../assets/images/admin_avatars/adminadd.png">
                            <div class="min-w-0 flex-1">
                                <h2 class="text-base font-bold leading-snug text-blue-700">Manage Admin Access</h2>
                                <p class="mt-1 text-sm leading-6 text-slate-500">Add or remove scribes for notices.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include('../includes/admin_footer.php') ?>
</body>
<script>
function add_notice() {
    window.location.href = "add_notice.php";
}

function site_content() {
    window.location.href = "site_content.php";
}

function feedback_page() {
    window.location.href = "feedback.php";
}

function flash_notice() {
    window.location.href = "flash_notice.php";
}

function add_gallery() {
    window.location.href = "add_gallery.php";
}

function registered_students() {
    window.location.href = "registered_students.php";
}

function changeRoutine(){
    window.location.href = "change_routine.php";

}

function changeStaff(){
    window.location.href = "staff.php";

}
function adminAndScribe(){
    window.location.href = "manage_admins.php";

}


    console.clear();

</script>

</html>
