<?php

function escape_html($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function normalize_multiline_text($value): string
{
    $value = trim((string) $value);
    $value = preg_replace("/\r\n|\r/", "\n", $value);

    return $value;
}

function get_current_admin_id(PDO $connection, string $identityCode): ?int
{
    $row = db_select_one($connection, "SELECT `id` FROM `admins` WHERE `identity_code` = ? LIMIT 1", [$identityCode]);

    return $row ? (int) $row['id'] : null;
}

function get_notice_rows(PDO $connection, bool $includeUpdatedAt = false): array
{
    $selectUpdatedAt = $includeUpdatedAt
        ? ", DATE_FORMAT(sn.`updated_at`, '%h:%i %p %d/%m/%Y') AS `display_updated_at`"
        : "";

    $query = "SELECT sn.*,
        m.`username` AS `display_posted_by`,
        DATE_FORMAT(sn.`published_at`, '%h:%i %p %d/%m/%Y') AS `display_published_at`"
        . $selectUpdatedAt .
        " FROM `school_notice` sn
        INNER JOIN `admins` m ON sn.`posted_by_id` = m.`id`
        ORDER BY sn.`id` DESC";

    return db_select_all($connection, $query);
}
