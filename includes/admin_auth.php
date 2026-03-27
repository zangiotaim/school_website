<?php

function admin_auth_start_session()
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }
}

function admin_get_session_admin_id()
{
    admin_auth_start_session();

    return isset($_SESSION['admin_id']) ? (int) $_SESSION['admin_id'] : null;
}

function admin_get_session_role()
{
    admin_auth_start_session();

    if (!isset($_SESSION['admin_role'])) {
        return null;
    }

    return strtolower((string) $_SESSION['admin_role']);
}

function admin_get_csrf_token()
{
    admin_auth_start_session();

    if (empty($_SESSION['_admin_csrf_token'])) {
        $_SESSION['_admin_csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['_admin_csrf_token'];
}

function admin_csrf_input()
{
    return '<input type="hidden" name="_csrf_token" value="' . htmlspecialchars(admin_get_csrf_token(), ENT_QUOTES, 'UTF-8') . '">';
}

function admin_inject_csrf_tokens_into_html($html)
{
    return preg_replace_callback(
        '/<form\b[^>]*method\s*=\s*([\'"])post\1[^>]*>.*?<\/form>/is',
        function ($matches) {
            $formHtml = $matches[0];

            if (
                stripos($formHtml, 'name="_csrf_token"') !== false
                || stripos($formHtml, "name='_csrf_token'") !== false
            ) {
                return $formHtml;
            }

            $openingTagEnd = strpos($formHtml, '>');

            if ($openingTagEnd === false) {
                return $formHtml;
            }

            return substr($formHtml, 0, $openingTagEnd + 1)
                . admin_csrf_input()
                . substr($formHtml, $openingTagEnd + 1);
        },
        $html
    );
}

function admin_start_form_protection_buffer()
{
    static $bufferStarted = false;

    if ($bufferStarted) {
        return;
    }

    $bufferStarted = true;
    ob_start('admin_inject_csrf_tokens_into_html');
}

function admin_verify_csrf_request()
{
    admin_auth_start_session();

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return;
    }

    $submittedToken = $_POST['_csrf_token'] ?? '';
    $sessionToken = $_SESSION['_admin_csrf_token'] ?? '';

    if ($submittedToken === '' || $sessionToken === '' || !hash_equals($sessionToken, $submittedToken)) {
        http_response_code(403);
        exit('Invalid CSRF token.');
    }
}

function admin_is_authenticated()
{
    admin_auth_start_session();
    return isset($_SESSION["identity_code"]);
}

function admin_is_super_admin()
{
    return admin_get_session_role() === 'admin';
}

function admin_require_auth($adminOnly = false)
{
    admin_auth_start_session();
    admin_get_csrf_token();

    if (!admin_is_authenticated()) {
        header("Location: login.php");
        exit();
    }

    if ($adminOnly && !admin_is_super_admin()) {
        header("Location: manage_notices.php");
        exit();
    }

    admin_verify_csrf_request();
}

function admin_redirect_to_home()
{
    admin_auth_start_session();

    if (!admin_is_authenticated()) {
        header("Location: login.php");
        exit();
    }

    if (admin_is_super_admin()) {
        header("Location: dashboard.php");
        exit();
    }

    header("Location: manage_notices.php");
    exit();
}

function admin_logout_and_redirect()
{
    admin_auth_start_session();
    session_unset();
    session_destroy();
    header("Location:index.php");
    exit();
}
