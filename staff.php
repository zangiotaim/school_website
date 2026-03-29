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
    $labelClass = $options['label_class'] ?? 'text-slate-500';

    if (count($rows) === 0) {
        return '<div class="rounded-[2rem] border border-dashed border-slate-300 bg-white px-8 py-14 text-center text-slate-500 shadow-sm">' . escape_html($emptyMessage) . '</div>';
    }

    $html = [];

    foreach ($rows as $row) {
        $image = trim((string) ($row[$imageKey] ?? ''));
        if ($image === '') {
            $image = $fallbackImage;
        }

        $name = trim(preg_replace('/\s+/', ' ', (string) ($row['name'] ?? '')));
        $subtitle = is_callable($subtitleFormatter) ? trim((string) $subtitleFormatter($row)) : '';
        $meta = is_callable($metaFormatter) ? trim((string) $metaFormatter($row)) : '';

        $html[] = '<article class="group relative flex h-full min-h-[24.5rem] flex-col overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_14px_35px_rgba(15,23,42,0.07)] transition duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_55px_rgba(15,23,42,0.14)]">';
        $html[] = '    <div class="absolute inset-x-6 top-0 h-20 rounded-b-[1.75rem] bg-gradient-to-br ' . escape_html($accentClass) . ' opacity-95"></div>';
        $html[] = '    <div class="pointer-events-none absolute inset-x-6 top-5 h-px bg-white/70"></div>';
        $html[] = '    <div class="relative flex flex-1 flex-col text-center">';
        $html[] = '        <span class="inline-flex self-center rounded-full border border-white/75 bg-white/92 px-3.5 py-1 text-[11px] font-semibold uppercase tracking-[0.26em] ' . escape_html($labelClass) . ' shadow-sm">' . escape_html($label) . '</span>';
        $html[] = '        <div class="mx-auto mt-4 flex h-32 w-32 items-center justify-center overflow-hidden rounded-full border-[5px] border-white bg-slate-50 shadow-[0_18px_28px_rgba(15,23,42,0.12)] ring-1 ring-slate-200 sm:h-36 sm:w-36">';
        $html[] = '            <img class="h-full w-full object-cover" src="' . escape_html($image) . '" alt="' . escape_html($name) . '" onerror="this.src=\'' . escape_html($fallbackImage) . '\'">';
        $html[] = '        </div>';
        $html[] = '        <div class="mt-5 flex flex-1 flex-col">';
        $html[] = '            <h3 class="text-[1.45rem] font-semibold tracking-tight text-slate-900">' . escape_html($name) . '</h3>';

        if ($subtitle !== '') {
            $html[] = '            <p class="mt-3 text-[0.85rem] font-semibold uppercase tracking-[0.22em] text-orange-700">' . escape_html($subtitle) . '</p>';
        }

        if ($meta !== '') {
            $metaLines = array_filter(array_map('trim', preg_split('/\|/', $meta) ?: []), static function ($value): bool {
                return $value !== '';
            });
            $metaMarkup = implode('<br>', array_map('escape_html', $metaLines));
        $html[] = '            <div class="mt-5 pt-4">';
            $html[] = '                <div class="mx-auto h-px w-16 bg-slate-200"></div>';
            $html[] = '                <p class="mt-3 text-[0.92rem] leading-7 text-slate-500">' . $metaMarkup . '</p>';
            $html[] = '            </div>';
        }

        $html[] = '        </div>';

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
    <link rel="icon" type="image/x-icon" href="assets/images/logo2.png">
</head>

<body class="bg-[#f5f7fb] text-slate-900">
    <?php include 'includes/header.php'; ?>

    <main class="relative bg-[radial-gradient(circle_at_top_left,_rgba(59,130,246,0.1),_transparent_22%),radial-gradient(circle_at_top_right,_rgba(14,165,233,0.08),_transparent_28%),linear-gradient(180deg,#f8fbff_0%,#f2f7ff_52%,#eef5ff_100%)]">
        <section class="relative overflow-x-hidden bg-transparent">
            <div class="pointer-events-none absolute inset-x-0 top-0 h-40 bg-[radial-gradient(circle_at_center,_rgba(255,255,255,0.75),_transparent_65%)]"></div>
            <div class="mx-auto max-w-7xl px-4 py-9 sm:px-6 sm:py-11 lg:px-8 lg:py-12">
                <div class="max-w-[96rem]">
                        <div class="w-full max-w-[82rem] rounded-[2.2rem] border border-white/70 bg-white/78 px-6 py-5 shadow-[0_18px_45px_rgba(15,23,42,0.07)] backdrop-blur sm:px-8 sm:py-6 lg:px-10 lg:py-6">
                        <p class="text-[0.82rem] font-semibold uppercase tracking-[0.32em] text-sky-700">Meet Our People</p>
                        <div class="mt-3 inline-block bg-transparent pr-4 pb-1">
                            <h1 class="max-w-[78rem] text-[2.95rem] font-semibold tracking-[-0.04em] leading-[1.06] text-slate-900 sm:text-[3.95rem] sm:leading-[1.04] lg:text-[5rem] lg:leading-[1.02]">Leadership &amp; Staff</h1>
                        </div>
                        <p class="mt-4 max-w-5xl text-lg leading-8 text-slate-600 sm:text-[1.22rem] sm:leading-9">
                            A strong school is built by people who lead with vision, teach with purpose, and support students with care. Explore the team guiding strategy, shaping learning, and creating an environment where every learner can thrive.
                        </p>
                        <div class="mt-5 flex flex-wrap gap-3">
                            <a href="#management-committee" class="inline-flex items-center rounded-full bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">Leadership Team</a>
                            <a href="#faculty-staff" class="inline-flex items-center rounded-full border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:text-slate-900">Faculty & Staff</a>
                        </div>
                        </div>
                </div>
            </div>
        </section>

        <section id="management-committee" class="mx-auto max-w-7xl px-4 pt-3 pb-9 sm:px-6 sm:pt-4 lg:px-8">
            <div class="mb-7 rounded-[2rem] border border-slate-200 bg-white/85 px-6 py-6 shadow-[0_14px_35px_rgba(15,23,42,0.05)] backdrop-blur sm:px-8 sm:py-6 lg:px-10 lg:py-7">
                <div class="grid gap-4 lg:grid-cols-[minmax(0,2fr)_minmax(0,5fr)] lg:items-center">
                    <div class="max-w-3xl">
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-sky-700">Leadership</p>
                        <h2 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl lg:text-[2.95rem] lg:leading-[1.02]">Management Committee</h2>
                    </div>
                    <p class="max-w-2xl text-[1rem] leading-7 text-slate-600 lg:justify-self-end">
                        The management committee sets direction, oversees priorities, and helps ensure the school moves forward with clarity, confidence, and care.
                    </p>
                </div>
            </div>

            <div class="grid gap-7 sm:grid-cols-2 xl:grid-cols-4">
                <?php
                echo render_staff_cards(
                    $managementCommitteeMembers,
                    [
                        'fallback_image' => $defaultAvatar,
                        'label' => 'Leadership',
                        'label_class' => 'text-sky-700',
                        'accent_class' => 'from-sky-100 via-blue-50 to-cyan-100',
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

        <section id="faculty-staff" class="bg-transparent">
            <div class="mx-auto max-w-7xl px-4 py-9 sm:px-6 lg:px-8">
                <div class="mb-7 rounded-[2rem] border border-slate-200 bg-white/85 px-6 py-6 shadow-[0_14px_35px_rgba(15,23,42,0.05)] backdrop-blur sm:px-8 sm:py-6 lg:px-10 lg:py-7">
                    <div class="grid gap-4 lg:grid-cols-[minmax(0,2fr)_minmax(0,5fr)] lg:items-center">
                        <div class="max-w-3xl">
                            <p class="text-sm font-semibold uppercase tracking-[0.24em] text-emerald-700">Teaching & Support</p>
                            <h2 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl lg:text-[2.95rem] lg:leading-[1.02]">Faculty & Staff</h2>
                        </div>
                        <p class="max-w-2xl text-[1rem] leading-7 text-slate-600 lg:justify-self-end">
                            From the classroom to day-to-day operations, this team helps create a learning experience that feels focused, welcoming, and student-centered.
                        </p>
                    </div>
                </div>

                <div class="grid gap-7 sm:grid-cols-2 xl:grid-cols-4">
                    <?php
                    echo render_staff_cards(
                        $staffMembers,
                    [
                        'fallback_image' => $defaultAvatar,
                        'label' => 'Faculty',
                        'label_class' => 'text-emerald-700',
                        'accent_class' => 'from-blue-100 via-sky-50 to-cyan-100',
                        'subtitle_formatter' => static function (array $row): string {
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
