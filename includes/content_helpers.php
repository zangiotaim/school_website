<?php

function get_web_content_sections(PDO $connection): array
{
    $rows = db_select_all($connection, "SELECT * FROM `web_content`");
    $sections = [];

    foreach ($rows as $row) {
        $sections[$row['id']] = $row;
    }

    return $sections;
}

function get_flash_notice(PDO $connection): ?array
{
    return db_select_one($connection, "SELECT * FROM `flash_notice` WHERE `id` = 1");
}
