<?php

use Green\Library\PDO\Database;

function html_escape($input, bool $doubleEncode = true)
{
    if (is_array($input)) {
        foreach (array_keys($input) as $key) {
            $input[$key] = html_escape($input[$key], $doubleEncode);
        }
        return $input;
    }

    return htmlspecialchars((string)$input, ENT_QUOTES | ENT_HTML5, 'UTF-8', $doubleEncode);
}


function e($input, $doubleEncode = true)
{
    return html_escape($input, $doubleEncode);
}

function e_attr($input)
{
    return html_escape($input, true);
}



function render_template(string $name, array $data = [])
{
    extract($data);
    include(TEMPLATE_PATH . "/{$name}.phtml");
}



/**
 * Returns if current connection is https or not
 */
function is_https(): bool
{
    return !empty($_SERVER['HTTPS']) && (string)$_SERVER['HTTPS'] !== 'off';
}

/**
 * Send no cache headers
 */
function no_cache_headers(): void
{
    header_remove('Last-Modified');
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
}


/**
 * Detect the base URL
 */
function detect_base_uri(): string
{
    $protocol = is_https() ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $scriptUri = str_replace(basename($script), '', $script);
    return $protocol . $host . $scriptUri;
}


/**
 * Read a config value
 */
function config(string $key, mixed $default = null)
{
    static $config = null;

    if ($config === null) {
        $config = require CORE_PATH . '/config.php';

        if (empty($config['app_url'])) {
            $config['app_url'] = untrailingslashit(detect_base_uri());
        }

    }

    return array_key_exists($key, $config) ? $config[$key] : $default;
}



function uri($path = '')
{
    $uri = config('app_url');

    $uri .= leadingslashit($path);
    return $uri;
}



/**
 * Redirect to a provided path or URL
 */
function redirect(
    string $path,
    int $status = 302,
    bool $native = true,
    bool $cache = false
): void {
    if ($native) {
        $path = trailingslashit(config('app_url')) . untrailingslashit($path);
    }
    if (!$cache) {
        no_cache_headers();
    }
    header("Location: {$path}", true, $status);
    exit(0);
}


function leadingslashit($string, $slash = '/')
{
    return $slash . unleadingslashit($string);
}

function unleadingslashit($string, $slashes = '/\\')
{
    return ltrim($string, $slashes);
}


function trailingslashit(string $string, string $slash = '/'): string
{
    return untrailingslashit($string) . $slash;
}

function untrailingslashit(string $string, string $slashes = '/\\'): string
{
    return rtrim($string, $slashes);
}



function fatal_server_error($title, $message, $status = 403)
{
    $message = nl2br($message, true);
    $signature = isset($_SERVER['SERVER_SIGNATURE']) ? $_SERVER['SERVER_SIGNATURE'] : '';
    $body = <<<EOD
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>{$title}</title>
</head><body>
<h1>{$title}</h1>
<p>{$message}
</p>
<hr>
<address>{$signature}</address>
</body></html>
EOD;
    no_cache_headers();
    http_response_code($status);
    echo $body;
    exit;
}


function session($key, $default = null)
{
    return array_key_exists($key, $_SESSION) ? $_SESSION[$key] : $default;
}

function session_set(string|array $key, $value = null)
{
    if (is_string($key)) {
        $_SESSION[$key] = $value;
        return;
    }

    foreach ($key as $sessKey => $sessValue) {
        $_SESSION[$sessKey] = $sessValue;
    }
}


function flash(string $type, string $message)
{
    $_SESSION['_flash'][$type] = $message;
}


function old($key, $default = '')
{
    return isset($_SESSION['_old'][$key]) ? $_SESSION['_old'][$key] : $default;
}

function bootstrap_alert($message, $type = 'info', $iconHtml = null, $dismissable = true)
{
    $class = '';

    if ($iconHtml) {
        $class = 'alert-icon';
    }

    $dismiss = '';
    if ($dismissable) {
        $class .= ' alert-dismissible';
        $dismiss = "\n" . '<button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close"></button>';
    }

    return '<div class="alert alert-' . e_attr($type) . ' ' . $class . '" role="alert">' . $iconHtml . ' ' . $message . ' ' . $dismiss .' </div>';
}

function render_flashes()
{
    $types = ['danger', 'warning', 'success', 'info', 'primary', 'secondary', 'light', 'dark'];
    $html = '';

    foreach ($types as $key) {
        if (!isset($_SESSION['_flash'][$key])) {
            continue;
        }

        $html .= bootstrap_alert(e($_SESSION['_flash'][$key]), $key);
    }


    return $html;
}


function clear_old()
{
    $_SESSION['_old'] = [];
}


function clear_flash()
{
    $_SESSION['_flash'] = [];
}



/**
 * Returns a singleton for database
 *
 * @return Database
 */
function db(): Database
{
    static $db = null;

    if ($db) {
        return $db;
    }

    $dsn = sprintf(
        "mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4",
        config('db_host'),
        config('db_port'),
        config('db_name')
    );

    $db = new Database(
        $dsn,
        config('db_user'),
        config('db_password')
    );

    return $db;
}

function get_logged_user()
{
    static $user = null;

    if ($user) {
        return $user;
    }

    $db = db();

    $result = $db->select()->from('users')
    ->where('id', '=', $_SESSION['user_id'])
    ->execute()
    ->fetch();

    $user = $result;

    return $user;
}


function allow_only_method(string|array $method)
{
    $method = (array) $method;

    if (!in_array($_SERVER['REQUEST_METHOD'], $method)) {
        fatal_server_error('Method not allowed', "Make sure your form is correct");
    }
}


function redirect_back()
{
    $referer = $_SERVER['HTTP_REFERER'] ?? config('site_url');
    redirect($referer, 302, false);
}


function is_logged(): bool
{
    return !empty($_SESSION['user_id']);
}


function is_admin(): bool
{
    if (!is_logged()) {
        return false;
    }

    $user = get_logged_user();

    return (int) $user['role'] === 1;
}


function render_csrf_input()
{
    $token = e_attr($_SESSION['_crsf_token']);
    return '<input type="hidden" name="csrf_token" value="'.$token.'">';
}

function active_class(string $path, string $class = 'active'): string
{
    return $path === $GLOBALS['__current_route'] ? $class : '';
}



function get_universities(): array
{
    return [
        'BRAC' => 'BRAC University',
        'NSU' => 'North South University',
        'IUB' => 'Independent University Bangladesh',
    ];
}


function get_departments(): array
{
    return [
        'CS' => 'Computer Science',
        'BA' => 'Business Administration',
        'ES' => 'Environmental Science',
    ];
}

function get_uni_name(string $key): string
{
    $unis = get_universities();

    return array_key_exists($key, $unis) ? $unis[$key] : 'N/A';
}


function get_dept_name(string $key): string
{
    $depts = get_departments();

    return array_key_exists($key, $depts) ? $depts[$key] : 'N/A';
}




// Function to handle file uploads
function upload_attachment($file, $prefix = '')
{
    $pathinfo = pathinfo($file['name']);


    $file_name = bin2hex(random_bytes(8))  . '_' . $prefix . '_' . md5($pathinfo['filename']) . '.' . $pathinfo['extension'];

    if (move_uploaded_file($file['tmp_name'], UPLOADS_PATH . '/' . $file_name)) {
        return $file_name;
    } else {
        return null;
    }
}

function upload_uri($name = '')
{
    return uri(UPLOADS_DIR . '/'. $name);
}
