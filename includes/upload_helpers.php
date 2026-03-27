<?php

const DEFAULT_UPLOAD_MAX_SIZE_BYTES = 5_242_880;

function clear_upload_error_message()
{
    $GLOBALS['upload_error_message'] = null;
}

function has_upload_error()
{
    return !empty($GLOBALS['upload_error_message']);
}

function get_upload_error_message()
{
    return $GLOBALS['upload_error_message'] ?? null;
}

function set_upload_error_message($message)
{
    $GLOBALS['upload_error_message'] = $message;
}

function build_normalized_upload_name($prefix, $originalName)
{
    $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
    $extension = preg_replace('/[^a-z0-9]/', '', $extension);

    if ($extension === '') {
        $extension = 'bin';
    }

    $safePrefix = strtolower($prefix);
    $safePrefix = preg_replace('/[^a-z0-9]+/', '_', $safePrefix);
    $safePrefix = trim($safePrefix, '_');

    try {
        $randomSuffix = bin2hex(random_bytes(3));
    } catch (Exception $exception) {
        $randomSuffix = substr(uniqid('', true), -6);
    }

    return sprintf('%s_%s_%s.%s', $safePrefix, date('Ymd_His'), $randomSuffix, $extension);
}

function validate_uploaded_file($fileName, $tmpName, array $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'jfif', 'bmp'], array $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp'], $maxSizeBytes = DEFAULT_UPLOAD_MAX_SIZE_BYTES)
{
    clear_upload_error_message();

    if ($fileName === '' || $tmpName === '') {
        return true;
    }

    if (!is_uploaded_file($tmpName)) {
        set_upload_error_message('The uploaded file could not be verified.');
        return false;
    }

    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if (!in_array($extension, $allowedExtensions, true)) {
        set_upload_error_message('Only image files of type JPG, JPEG, PNG, GIF, WEBP, JFIF, or BMP are allowed.');
        return false;
    }

    $fileSize = @filesize($tmpName);
    if ($fileSize === false || $fileSize > $maxSizeBytes) {
        set_upload_error_message('The uploaded file must be 5 MB or smaller.');
        return false;
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = $finfo ? finfo_file($finfo, $tmpName) : false;
    if ($finfo) {
        finfo_close($finfo);
    }

    if ($mimeType === false || !in_array($mimeType, $allowedMimeTypes, true)) {
        set_upload_error_message('The uploaded file is not a valid supported image.');
        return false;
    }

    return true;
}

function store_uploaded_file($fileName, $tmpName, $diskDirectory, $publicDirectory, $prefix)
{
    clear_upload_error_message();

    if ($fileName === '' || $tmpName === '') {
        return null;
    }

    if (!validate_uploaded_file($fileName, $tmpName)) {
        return null;
    }

    if (!is_dir($diskDirectory) && !mkdir($diskDirectory, 0775, true) && !is_dir($diskDirectory)) {
        set_upload_error_message('The upload directory is not available.');
        return null;
    }

    $normalizedName = build_normalized_upload_name($prefix, $fileName);
    $targetFilePath = rtrim($diskDirectory, '/') . '/' . $normalizedName;

    if (!move_uploaded_file($tmpName, $targetFilePath)) {
        set_upload_error_message('The file could not be saved on the server.');
        return null;
    }

    return rtrim($publicDirectory, '/') . '/' . $normalizedName;
}
