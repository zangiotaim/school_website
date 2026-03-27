<?php
include 'config/db.php';
include_once 'includes/functions.php';
include_once 'includes/admin_data_helpers.php';

$defaultAvatar = 'assets/images/staff/default_teacher.jpg';
$managementCommitteeMembers = [];
$staffMembers = [];

try {
    $managementCommitteeMembers = get_management_committee_rows($connection);
    $staffMembers = get_staff_rows($connection);
} catch (Exception $e) {
    $managementCommitteeMembers = [];
    $staffMembers = [];
}

function render_staff_cards(array $rows, array $options = []): string
{
    $imageKey = $options['image_key'] ?? 'image_src';
    $fallbackImage = $options['fallback_image'] ?? '';
    $subtitleFormatter = $options['subtitle_formatter'] ?? null;
    $metaFormatter = $options['meta_formatter'] ?? null;
    $emptyMessage = $options['empty_message'] ?? 'No entries available yet.';
    $accentClass = $options['accent_class'] ?? 'from-amber-100 via-orange-50 to-sky-100';
    $label = $options['label'] ?? 'Team';

    if (count($rows) === 0) {
        return '<div class="rounded-[2rem] border border-dashed border-slate-300 bg-white px-8 py-14 text-center text-slate-500 shadow-sm">' . escape_html($emptyMessage) . '</div>';
    }

    $html = [];

    foreach ($rows as $row) {
        $image = trim((string) ($row[$imageKey] ?? ''));
        if ($image === '') {
            $image = $fallbackImage;
        }

        $name = trim((string) ($row['name'] ?? ''));
        $subtitle = is_callable($subtitleFormatter) ? trim((string) $subtitleFormatter($row)) : '';
        $meta = is_callable($metaFormatter) ? trim((string) $metaFormatter($row)) : '';

        $html[] = '<article class="group relative overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-2xl">';
        $html[] = '    <div class="absolute inset-x-7 top-0 h-28 rounded-b-[2rem] bg-gradient-to-br ' . escape_html($accentClass) . ' opacity-95"></div>';
        $html[] = '    <div class="relative text-center">';
        $html[] = '        <span class="inline-flex rounded-full border border-white/70 bg-white/90 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.24em] text-slate-500 shadow-sm">' . escape_html($label) . '</span>';
        $html[] = '        <div class="mx-auto mt-5 flex h-44 w-44 items-center justify-center overflow-hidden rounded-full border-[6px] border-white bg-slate-50 shadow-xl ring-1 ring-slate-200">';
        $html[] = '            <img class="h-full w-full object-cover" src="' . escape_html($image) . '" alt="' . escape_html($name) . '" onerror="this.src=\'' . escape_html($fallbackImage) . '\'">';
        $html[] = '        </div>';
        $html[] = '        <h3 class="mt-7 text-[1.5rem] font-semibold tracking-tight text-slate-900">' . escape_html($name) . '</h3>';

        if ($subtitle !== '') {
            $html[] = '        <p class="mt-2 text-base font-medium text-orange-700">' . escape_html($subtitle) . '</p>';
        }

        if ($meta !== '') {
            $html[] = '        <p class="mt-3 text-sm leading-6 text-slate-500">' . escape_html($meta) . '</p>';
        }

        $html[] = '    </div>';
        $html[] = '</article>';
    }

    return implode("\n", $html);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <link rel="icon" type="image/x-icon" href="assets/images/logo2.png">
</head>

<body class="bg-[#f5f7fb] text-slate-900">
    <?php include 'includes/header.php'; ?>

    <main>
        <section class="relative overflow-hidden bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.08),_transparent_24%),radial-gradient(circle_at_top_right,_rgba(251,191,36,0.16),_transparent_28%),linear-gradient(180deg,#f8fbff_0%,#f5f7fb_100%)]">
            <div class="pointer-events-none absolute inset-x-0 top-0 h-40 bg-[radial-gradient(circle_at_center,_rgba(255,255,255,0.75),_transparent_65%)]"></div>
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 sm:py-14 lg:px-8 lg:py-16">
                <div class="grid gap-10 lg:grid-cols-[minmax(0,1.15fr)_300px] lg:items-center">
                    <div class="max-w-3xl">
                        <p class="text-[0.82rem] font-semibold uppercase tracking-[0.32em] text-sky-700">Meet Our People</p>
                        <h1 class="mt-4 text-4xl font-semibold tracking-tight text-slate-900 sm:text-5xl lg:text-[4.25rem] lg:leading-[0.96]">Leadership & Staff</h1>
                        <p class="mt-5 max-w-3xl text-lg leading-8 text-slate-600 sm:text-[1.32rem] sm:leading-10">
                            A strong school is built by people who lead with vision, teach with purpose, and support students with care. Explore the team guiding strategy, shaping learning, and creating an environment where every learner can thrive.
                        </p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3 lg:grid-cols-1">
                        <div class="rounded-[1.6rem] border border-slate-200/90 bg-white/92 px-6 py-4 shadow-[0_12px_30px_rgba(15,23,42,0.06)] backdrop-blur">
                            <p class="text-sm font-medium text-slate-500">Leadership Team</p>
                            <p class="mt-2 text-[2.15rem] font-semibold leading-none text-slate-900"><?php echo count($managementCommitteeMembers); ?></p>
                        </div>
                        <div class="rounded-[1.6rem] border border-slate-200/90 bg-white/92 px-6 py-4 shadow-[0_12px_30px_rgba(15,23,42,0.06)] backdrop-blur">
                            <p class="text-sm font-medium text-slate-500">Faculty & Staff</p>
                            <p class="mt-2 text-[2.15rem] font-semibold leading-none text-slate-900"><?php echo count($staffMembers); ?></p>
                        </div>
                        <div class="rounded-[1.6rem] border border-slate-200/90 bg-white/92 px-6 py-4 shadow-[0_12px_30px_rgba(15,23,42,0.06)] backdrop-blur">
                            <p class="text-sm font-medium text-slate-500">Directory Scope</p>
                            <p class="mt-2 text-[1.08rem] font-semibold leading-8 text-slate-900">Leadership, teaching, and support teams</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                <div class="max-w-3xl">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-sky-700">Leadership</p>
                    <h2 class="mt-3 text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl">Management Committee</h2>
                </div>
                <p class="max-w-2xl text-base leading-7 text-slate-600">
                    The management committee sets direction, oversees priorities, and helps ensure the school moves forward with clarity, confidence, and care.
                </p>
            </div>

            <div class="grid gap-7 sm:grid-cols-2 xl:grid-cols-4">
                <?php
                echo render_staff_cards(
                    $managementCommitteeMembers,
                    [
                        'fallback_image' => $defaultAvatar,
                        'label' => 'Leadership',
                        'accent_class' => 'from-amber-100 via-orange-50 to-sky-100',
                        'subtitle_formatter' => static function (array $row): string {
                            return trim((string) ($row['position'] ?? ''));
                        },
                        'meta_formatter' => static function (array $row): string {
                            $contact = trim((string) ($row['contact_no'] ?? ''));
                            return $contact;
                        },
                        'empty_message' => 'Leadership profiles will appear here after they are added.',
                    ]
                );
                ?>
            </div>
        </section>

        <section class="border-t border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                <div class="mb-10 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                    <div class="max-w-3xl">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-700">Teaching & Support</p>
                        <h2 class="mt-3 text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl">Faculty & Staff</h2>
                    </div>
                    <p class="max-w-2xl text-base leading-7 text-slate-600">
                        From the classroom to day-to-day operations, this team helps create a learning experience that feels focused, welcoming, and student-centered.
                    </p>
                </div>

                <div class="grid gap-7 sm:grid-cols-2 xl:grid-cols-4">
                    <?php
                    echo render_staff_cards(
                        $staffMembers,
                        [
                            'fallback_image' => $defaultAvatar,
                            'label' => 'Faculty',
                            'accent_class' => 'from-emerald-100 via-teal-50 to-sky-100',
                            'subtitle_formatter' => static function (array $row): string {
                                $subject = trim((string) ($row['subject'] ?? ''));
                                $post = trim((string) ($row['post'] ?? ''));
                                return $post;
                            },
                            'meta_formatter' => static function (array $row): string {
                                $parts = [];
                                $subject = trim((string) ($row['subject'] ?? ''));
                                $qualification = trim((string) ($row['qualification'] ?? ''));
                                $contact = trim((string) ($row['contact'] ?? ''));

                                if ($subject !== '') {
                                    $parts[] = $subject;
                                }

                                if ($qualification !== '') {
                                    $parts[] = $qualification;
                                }

                                if ($contact !== '') {
                                    $parts[] = $contact;
                                }

                                return implode(' | ', $parts);
                            },
                        'empty_message' => 'Faculty and staff profiles will appear here after they are added.',
                        ]
                    );
                    ?>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>

</html>
