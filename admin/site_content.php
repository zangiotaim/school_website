<?php
include '../config/db.php';
include_once '../includes/admin_auth.php';
include_once '../includes/content_helpers.php';
include_once '../includes/functions.php';
admin_require_auth(true);

function get_site_content_editor_sections(): array
{
    return [
        'home' => [
            'id' => 1,
            'title' => 'Home',
            'description' => 'Homepage highlights, selling points, and featured engineering content.',
            'fields' => [
                ['column' => 'one', 'name' => 'homeOne', 'label' => 'School Introduction', 'rows' => 5],
                ['column' => 'two', 'name' => 'homeTwo', 'label' => 'Why Choose This School?', 'rows' => 5],
                ['column' => 'three', 'name' => 'homeThree', 'label' => 'Why Choose This School? - Qualified Teachers', 'rows' => 5],
                ['column' => 'four', 'name' => 'homeFour', 'label' => 'Why Choose This School? - Peaceful Environment', 'rows' => 5],
                ['column' => 'five', 'name' => 'homeFive', 'label' => 'Why Choose This School? - Digital Learning', 'rows' => 5],
                ['column' => 'six', 'name' => 'homeSix', 'label' => 'Why Choose This School? - Development Environment', 'rows' => 5],
                ['column' => 'seven', 'name' => 'homeSeven', 'label' => 'Student Voice', 'rows' => 5],
                ['column' => 'eight', 'name' => 'homeEight', 'label' => 'Computer Engineering', 'rows' => 5],
            ],
        ],
        'about' => [
            'id' => 2,
            'title' => 'About',
            'description' => 'Long-form school description, rules, courses, and facilities.',
            'fields' => [
                ['column' => 'one', 'name' => 'aboutOne', 'label' => 'Introduction', 'rows' => 5],
                ['column' => 'two', 'name' => 'aboutTwo', 'label' => 'Principal Message', 'rows' => 5],
                ['column' => 'three', 'name' => 'aboutThree', 'label' => 'Rules and Regulations Intro', 'rows' => 5],
                ['column' => 'four', 'name' => 'aboutFour', 'label' => 'Rule 1', 'rows' => 2],
                ['column' => 'five', 'name' => 'aboutFive', 'label' => 'Rule 2', 'rows' => 2],
                ['column' => 'six', 'name' => 'aboutSix', 'label' => 'Rule 3', 'rows' => 2],
                ['column' => 'seven', 'name' => 'aboutSeven', 'label' => 'Rule 4', 'rows' => 2],
                ['column' => 'eight', 'name' => 'aboutEight', 'label' => 'Rule 5', 'rows' => 2],
                ['column' => 'nine', 'name' => 'aboutNine', 'label' => 'Rule 6', 'rows' => 2],
                ['column' => 'ten', 'name' => 'aboutTen', 'label' => 'Rule 7', 'rows' => 2],
                ['column' => 'eleven', 'name' => 'aboutEleven', 'label' => 'Rule 8', 'rows' => 2],
                ['column' => 'twelve', 'name' => 'aboutTwelve', 'label' => 'Rule 9', 'rows' => 2],
                ['column' => 'thirteen', 'name' => 'aboutThirteen', 'label' => 'Rule 10', 'rows' => 2],
                ['column' => 'fourteen', 'name' => 'aboutFourteen', 'label' => 'Our Courses', 'rows' => 5],
                ['column' => 'fifteen', 'name' => 'aboutFifteen', 'label' => 'Engineering Course Details', 'rows' => 5],
                ['column' => 'sixteen', 'name' => 'aboutSixteen', 'label' => 'Management and CS Details', 'rows' => 5],
                ['column' => 'seventeen', 'name' => 'aboutSeventeen', 'label' => 'Facilities Overview', 'rows' => 5],
                ['column' => 'eighteen', 'name' => 'aboutEighteen', 'label' => 'Physics Lab', 'rows' => 5],
                ['column' => 'ninteen', 'name' => 'aboutNinteen', 'label' => 'Computer Lab', 'rows' => 5],
                ['column' => 'twenty', 'name' => 'aboutTwenty', 'label' => 'Electronics and Network Lab', 'rows' => 5],
                ['column' => 'twentyone', 'name' => 'aboutTwentyone', 'label' => 'Library', 'rows' => 5],
            ],
        ],
        'extra' => [
            'id' => 6,
            'title' => 'Extra',
            'description' => 'Extra resources and supporting page description.',
            'fields' => [
                ['column' => 'one', 'name' => 'extraOne', 'label' => 'Extra Page Description', 'rows' => 5],
            ],
        ],
        'contact' => [
            'id' => 4,
            'title' => 'Contact Us',
            'description' => 'Main copy shown on the contact page.',
            'fields' => [
                ['column' => 'one', 'name' => 'contactOne', 'label' => 'Contact Page Description', 'rows' => 5],
            ],
        ],
        'join' => [
            'id' => 5,
            'title' => 'Join Us',
            'description' => 'Intro text shown above the admission form.',
            'fields' => [
                ['column' => 'one', 'name' => 'joinOne', 'label' => 'Join Us Description', 'rows' => 5],
            ],
        ],
    ];
}

function render_site_content_section(string $sectionKey, array $section, array $contentRow, bool $isFirst): string
{
    $headingId = 'accordion-collapse-heading-' . $section['id'];
    $bodyId = 'accordion-collapse-body-' . $section['id'];
    $expanded = $isFirst ? 'true' : 'false';
    $bodyClass = $isFirst ? '' : 'hidden';
    $buttonRadiusClass = $isFirst ? ' rounded-t-xl' : '';
    $borderBottomClass = $isFirst ? ' border-b-0' : ' border-b-0';
    $html = [];

    $html[] = '<h2 id="' . $headingId . '">';
    $html[] = '    <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-slate-600 border border-slate-200' . $borderBottomClass . $buttonRadiusClass . ' focus:ring-4 focus:ring-orange-100 hover:bg-orange-50 gap-3" data-accordion-target="#' . $bodyId . '" aria-expanded="' . $expanded . '" aria-controls="' . $bodyId . '">';
    $html[] = '        <span class="text-left">';
    $html[] = '            <span class="block text-base font-semibold text-slate-900">' . escape_html($section['title']) . '</span>';
    $html[] = '            <span class="mt-1 block text-sm text-slate-500">' . escape_html($section['description']) . '</span>';
    $html[] = '        </span>';
    $html[] = '        <svg data-accordion-icon class="w-3 h-3 shrink-0 ' . ($isFirst ? 'rotate-180' : '') . '" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">';
    $html[] = '            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>';
    $html[] = '        </svg>';
    $html[] = '    </button>';
    $html[] = '</h2>';
    $html[] = '<div id="' . $bodyId . '" class="' . $bodyClass . '" aria-labelledby="' . $headingId . '">';
    $html[] = '    <div class="border border-t-0 border-slate-200 bg-white p-5 shadow-sm">';
    $html[] = '        <form action="" method="POST" class="space-y-5">';
    $html[] = '            <input type="hidden" name="content_section" value="' . escape_html($sectionKey) . '">';

    foreach ($section['fields'] as $field) {
        $html[] = '            <div>';
        $html[] = '                <label class="mb-2 block text-sm font-semibold text-slate-800">' . escape_html($field['label']) . '</label>';
        $html[] = '                <textarea name="' . escape_html($field['name']) . '" rows="' . (int) ($field['rows'] ?? 4) . '" class="block w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-orange-400 focus:outline-none focus:ring-4 focus:ring-orange-100">' . escape_html($contentRow[$field['column']] ?? '') . '</textarea>';
        $html[] = '            </div>';
    }

    $html[] = '            <div class="flex justify-end">';
    $html[] = '                <button type="submit" class="rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-4 focus:ring-emerald-200">Save ' . escape_html($section['title']) . '</button>';
    $html[] = '            </div>';
    $html[] = '        </form>';
    $html[] = '    </div>';
    $html[] = '</div>';

    return implode("\n", $html);
}

$sectionDefinitions = get_site_content_editor_sections();
$contentRows = [];
$statusMessage = null;
$statusType = 'success';

try {
    $contentRows = get_web_content_sections($connection);
} catch (Exception $e) {
    $statusMessage = 'Unable to load existing site content.';
    $statusType = 'error';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sectionKey = $_POST['content_section'] ?? '';

    if (!isset($sectionDefinitions[$sectionKey])) {
        $statusMessage = 'Unknown content section.';
        $statusType = 'error';
    } else {
        $definition = $sectionDefinitions[$sectionKey];
        $setParts = [];
        $values = [];

        foreach ($definition['fields'] as $field) {
            $setParts[] = '`' . $field['column'] . '` = ?';
            $values[] = normalize_multiline_text($_POST[$field['name']] ?? '');
        }

        $values[] = $definition['id'];
        $updateSql = 'UPDATE `web_content` SET ' . implode(', ', $setParts) . ' WHERE `id` = ?';

        if (db_execute($connection, $updateSql, $values)) {
            $statusMessage = $definition['title'] . ' content updated successfully.';
            $statusType = 'success';
            $contentRows = get_web_content_sections($connection);
        } else {
            $statusMessage = 'Failed to update ' . strtolower($definition['title']) . ' content.';
            $statusType = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Content | Pashupati</title>
    <script defer src="https://unpkg.com/alpinejs@3.2.3/dist/cdn.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../assets/images/admin_logo.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</head>

<body class="bg-slate-50">
    <?php include('../includes/admin_header.php') ?>

    <main class="px-4 py-8 sm:px-6 lg:px-8">
        <section class="mx-auto max-w-6xl">
            <div class="rounded-3xl bg-gradient-to-r from-slate-900 via-slate-800 to-orange-700 px-6 py-8 text-white shadow-xl">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-orange-200">Content Studio</p>
                <h1 class="mt-3 text-3xl font-semibold sm:text-4xl">Edit the site section by section</h1>
                <p class="mt-3 max-w-3xl text-sm leading-6 text-slate-200 sm:text-base">
                    Each panel saves independently now, so we can update one page without risking unrelated content.
                    This keeps large edits easier to review and makes the admin page much less stressful to use.
                </p>
            </div>
        </section>

        <section class="mx-auto mt-6 grid max-w-6xl gap-6 lg:grid-cols-[280px_minmax(0,1fr)]">
            <aside class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm">
                <h2 class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Sections</h2>
                <div class="mt-4 space-y-3">
                    <?php foreach ($sectionDefinitions as $sectionKey => $section): ?>
                        <a href="#section-<?php echo escape_html($sectionKey); ?>" class="block rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 transition hover:border-orange-300 hover:bg-orange-50">
                            <span class="block text-sm font-semibold text-slate-900"><?php echo escape_html($section['title']); ?></span>
                            <span class="mt-1 block text-xs text-slate-500"><?php echo count($section['fields']); ?> editable field<?php echo count($section['fields']) === 1 ? '' : 's'; ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </aside>

            <section>
                <?php if ($statusMessage !== null): ?>
                    <div class="mb-5 rounded-2xl border px-4 py-3 text-sm shadow-sm <?php echo $statusType === 'success' ? 'border-emerald-200 bg-emerald-50 text-emerald-800' : 'border-red-200 bg-red-50 text-red-800'; ?>">
                        <?php echo escape_html($statusMessage); ?>
                    </div>
                <?php endif; ?>

                <div class="mb-5 rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm text-slate-600 shadow-sm">
                    The editor below is driven by one shared PHP configuration now.
                    That means adding or renaming a content field only needs one source of truth instead of repeated markup and update logic.
                </div>

                <div class="space-y-5">
                    <?php
                    $isFirstSection = true;
                    foreach ($sectionDefinitions as $sectionKey => $section) {
                        echo '<div id="section-' . escape_html($sectionKey) . '" class="overflow-hidden rounded-3xl">';
                        echo '<div id="accordion-collapse-' . escape_html($sectionKey) . '" data-accordion="collapse">';
                        echo render_site_content_section($sectionKey, $section, $contentRows[$section['id']] ?? [], $isFirstSection);
                        echo '</div>';
                        echo '</div>';
                        $isFirstSection = false;
                    }
                    ?>
                </div>
            </section>
        </section>
    </main>

    <?php include('../includes/admin_footer.php') ?>
</body>

</html>
