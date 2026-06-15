<?php
/**
 * Child theme custom page templates loader
 * (file vẫn tên `home-v2-loader.php` để giữ backward-compat với functions.php require)
 *
 * Hiện đang đăng ký:
 *   - Home V2 — Wonderland
 *   - VPTG V2 — Văn phòng trọn gói
 *   - Single Product V2 — polish cho /cho-thue-van-phong-ha-noi/{toa-nha}/
 *     (không phải template, chỉ CSS enqueue trên product single)
 *
 * Mỗi template:
 *   - Đăng ký với UI page-template trong wp-admin
 *   - Trỏ template_include sang file đúng (nằm trong sub-folder page-templates/)
 *   - Enqueue CSS/JS riêng (chỉ load khi page đang dùng template tương ứng)
 *
 * Để rollback toàn bộ: xoá dòng require_once trong functions.php.
 * Để tắt 1 template cụ thể: xoá entry trong $oo_child_templates dưới đây.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Tải font Plus Jakarta Sans globally cho toàn bộ các trang trên website
add_action( 'wp_enqueue_scripts', 'oo_enqueue_plus_jakarta_sans', 5 );

/**
 * Registry — key = template file path (relative to child theme),
 *            value = config (label + asset handles + asset files)
 */
function oo_child_templates_registry() {
    return array(
        'page-templates/template-home-v2.php' => array(
            'label'    => 'Home V2 — Wonderland',
            'handle'   => 'oneoffice-home-v2',
            'css_file' => '/assets/css/home-v2.css',
            'js_file'  => '/assets/js/home-v2.js',
        ),
        'page-templates/template-vptg-v2.php' => array(
            'label'    => 'VPTG V2 — Văn phòng trọn gói',
            'handle'   => 'oneoffice-vptg-v2',
            'css_file' => '/assets/css/vptg-v2.css',
            'js_file'  => '/assets/js/vptg-v2.js',
        ),
    );
}

/**
 * 1) Khai báo template ở folder `page-templates/` cho WP admin UI.
 */
add_filter( 'theme_page_templates', 'oo_child_templates_register' );
function oo_child_templates_register( $templates ) {
    foreach ( oo_child_templates_registry() as $path => $cfg ) {
        $templates[ $path ] = $cfg['label'];
    }
    return $templates;
}

/**
 * 2) Trỏ `template_include` sang file trong sub-folder.
 */
add_filter( 'template_include', 'oo_child_templates_include', 99 );
function oo_child_templates_include( $template ) {
    if ( ! is_page() ) return $template;
    $slug = get_page_template_slug( get_queried_object_id() );
    $registry = oo_child_templates_registry();
    if ( isset( $registry[ $slug ] ) ) {
        $file = get_stylesheet_directory() . '/' . $slug;
        if ( file_exists( $file ) ) return $file;
    }
    return $template;
}

/**
 * Helper: Plus Jakarta Sans Google Font cho V2 pages + single product polish.
 * Tách riêng vì có thể được enqueue ở nhiều nơi (V2 pages, single product, …).
 * Idempotent — gọi nhiều lần vẫn an toàn nhờ wp_enqueue dedupes by handle.
 */
function oo_enqueue_plus_jakarta_sans() {
    // Preconnect — giảm 1-2 RTT khi browser fetch font file
    add_action( 'wp_head', 'oo_plus_jakarta_sans_preconnect', 1 );

    wp_enqueue_style(
        'oneoffice-plus-jakarta-sans',
        'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap',
        array(),
        null  // null version = không append ?ver= cho Google Fonts
    );
}

function oo_plus_jakarta_sans_preconnect() {
    static $printed = false;
    if ( $printed ) return;
    $printed = true;
    echo "<link rel='preconnect' href='https://fonts.googleapis.com'>\n";
    echo "<link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>\n";
}

/**
 * 3) Enqueue CSS/JS có điều kiện — chỉ khi page dùng template tương ứng.
 *    Phụ thuộc oneoffice-main + oneoffice-sprint1 (đã đăng ký ở functions.php).
 */
add_action( 'wp_enqueue_scripts', 'oo_child_templates_enqueue', 30 );
function oo_child_templates_enqueue() {
    if ( ! is_page() ) return;
    $slug = get_page_template_slug( get_queried_object_id() );
    $registry = oo_child_templates_registry();
    if ( ! isset( $registry[ $slug ] ) ) return;

    $cfg  = $registry[ $slug ];
    $uri  = get_stylesheet_directory_uri();
    $dir  = get_stylesheet_directory();

    $css_ver = file_exists( $dir . $cfg['css_file'] ) ? filemtime( $dir . $cfg['css_file'] ) : '1.0';
    $js_ver  = file_exists( $dir . $cfg['js_file']  ) ? filemtime( $dir . $cfg['js_file']  ) : '1.0';

    // Google Font cho heading TV
    oo_enqueue_plus_jakarta_sans();

    wp_enqueue_style(
        $cfg['handle'],
        $uri . $cfg['css_file'],
        array( 'oneoffice-main', 'oneoffice-sprint1', 'oneoffice-plus-jakarta-sans' ),
        $css_ver
    );
    wp_enqueue_script(
        $cfg['handle'],
        $uri . $cfg['js_file'],
        array(),
        $js_ver,
        true
    );
}

/**
 * 3b) Home V2 — bật transparent header của Flatsome (đè lên hero), CHỈ trên template này.
 *     Tận dụng cơ chế sẵn có của parent: khi header có class 'transparent has-transparent'
 *     Flatsome tự đặt position:absolute + nền trong suốt, và tự chuyển sang header solid
 *     (sticky) khi cuộn. Màu chữ/logo sáng ở trạng thái top xử lý trong home-v2.css.
 *     Rollback: xoá filter này.
 */
add_filter( 'flatsome_header_class', 'oo_home_v2_transparent_header' );
function oo_home_v2_transparent_header( $classes ) {
    if ( is_page() && get_page_template_slug( get_queried_object_id() ) === 'page-templates/template-home-v2.php' ) {
        $classes[] = 'transparent has-transparent';
    }
    return $classes;
}

/**
 * 4) Single Product V2 — polish cho tất cả product single
 *    (URL pattern: /cho-thue-van-phong-ha-noi/{toa-nha-slug}/).
 *    Không động single-product.php của parent — chỉ thêm CSS layer.
 */
add_action( 'wp_enqueue_scripts', 'oo_single_product_v2_enqueue', 30 );
function oo_single_product_v2_enqueue() {
    if ( ! function_exists( 'is_product' ) || ! is_product() ) return;

    $uri = get_stylesheet_directory_uri();
    $dir = get_stylesheet_directory();
    $css = '/assets/css/single-product-v2.css';
    $ver = file_exists( $dir . $css ) ? filemtime( $dir . $css ) : '1.0';

    oo_enqueue_plus_jakarta_sans();

    wp_enqueue_style(
        'oneoffice-single-product-v2',
        $uri . $css,
        array( 'oneoffice-main', 'oneoffice-sprint1', 'oneoffice-plus-jakarta-sans' ),
        $ver
    );
}
