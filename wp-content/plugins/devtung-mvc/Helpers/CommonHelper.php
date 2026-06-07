<?php
if (!function_exists('dump')) {
    function dump(...$vars) {
        echo '<pre>';
        foreach ($vars as $v) {
            var_dump($v);
        }
        echo '</pre>';
    }
}

if (!function_exists('dd')) {
    function dd(...$vars) {
        dump(...$vars);
        die(1);
    }
}


if (!function_exists('dt_get_url_segments')) {
    function dt_get_url_segments() {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        // Bỏ base path khi WP cài trong thư mục con (vd /oneoffice) →
        // segment đúng trên CẢ root (production) lẫn subdir (local). Trước đây
        // 'oneoffice' bị tính là 1 segment → trang HN bị nhầm là đã lọc quận → ra view search.
        $base = trim(parse_url(home_url('/'), PHP_URL_PATH), '/');
        if ($base !== '' && ($path === $base || strpos($path, $base . '/') === 0)) {
            $path = trim(substr($path, strlen($base)), '/');
        }
        return $path === '' ? array() : explode('/', $path);
    }
}