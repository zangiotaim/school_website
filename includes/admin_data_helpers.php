<?php

function get_admin_rows(PDO $connection): array
{
    return db_select_all($connection, "SELECT *,
        COALESCE(DATE_FORMAT(`updated_at`, '%h:%i %p %d/%m/%Y'), 'Never Updated') AS `display_updated_at`
        FROM `admins`
        WHERE `id` != 1
        ORDER BY `id` ASC");
}

function get_admin_password_hash(PDO $connection, string $identityCode): ?string
{
    $row = db_select_one($connection, "SELECT `password` FROM `admins` WHERE `identity_code` = ? LIMIT 1", [$identityCode]);

    return $row['password'] ?? null;
}

function get_feedback_rows(PDO $connection): array
{
    return db_select_all($connection, "SELECT *,
        DATE_FORMAT(`submitted_at`, '%d/%m/%Y %h:%i %p') AS `display_submitted_at`
        FROM `contactfeedback`
        ORDER BY `id` DESC");
}

function get_gallery_album_rows(PDO $connection): array
{
    return db_select_all($connection, "SELECT * FROM `gallery_album` ORDER BY `id` ASC");
}

function get_gallery_image_rows(PDO $connection, int $albumId): array
{
    return db_select_all($connection, "SELECT * FROM `gallery_images` WHERE `album_id` = ? ORDER BY `id` DESC", [$albumId]);
}

function get_management_committee_rows(PDO $connection): array
{
    return db_select_all($connection, "SELECT * FROM `management_committee` ORDER BY `id` ASC");
}

function get_registered_students(PDO $connection): array
{
    return db_select_all($connection, "SELECT *,
        DATE_FORMAT(`registered_at`, '%d/%m/%Y %h:%i %p') AS `display_registered_on`,
        DATE_FORMAT(`dob_date`, '%d/%m/%Y') AS `display_dob`
        FROM `admission_form`
        ORDER BY `id` DESC");
}

function get_routine_rows(PDO $connection): array
{
    return db_select_all($connection, "SELECT *,
        DATE_FORMAT(`updated_at`, '%h:%i %p %d/%m/%Y') AS `display_updated_at`
        FROM `schoolroutine`
        ORDER BY `id` DESC");
}

function get_staff_rows(PDO $connection): array
{
    return db_select_all($connection, "SELECT * FROM `staffs` ORDER BY `id` ASC");
}
