<?php
/**
 * COMPANY V3 — Loader
 *
 * Đăng ký template-company-v3.php cho 7 trang Thông tin công ty.
 * Cấu trúc tương tự home-v2-loader.php nhưng tách riêng để rollback độc lập.
 *
 * Rollback: xoá dòng require_once trong functions.php (CSS/JS không nạp, template
 * không register; các page sẽ rơi về default — vẫn render UX-Builder cũ vì content
 * post_content gốc không bị động).
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* 1) Đăng ký template trong UI wp-admin */
add_filter( 'theme_page_templates', 'oo_cv3_register_template' );
function oo_cv3_register_template( $templates ) {
    $templates['page-templates/template-company-v3.php'] = 'Company V3 — Thông tin / Liên hệ / Ký gửi';
    return $templates;
}

/* 2) Trỏ template_include sang file trong sub-folder */
add_filter( 'template_include', 'oo_cv3_template_include', 99 );
function oo_cv3_template_include( $template ) {
    if ( ! is_page() ) return $template;
    $slug = get_page_template_slug( get_queried_object_id() );
    if ( $slug === 'page-templates/template-company-v3.php' ) {
        $file = get_stylesheet_directory() . '/' . $slug;
        if ( file_exists( $file ) ) return $file;
    }
    return $template;
}

/* 3) Enqueue CSS/JS (chỉ khi page đang dùng template này) */
add_action( 'wp_enqueue_scripts', 'oo_cv3_enqueue', 30 );
function oo_cv3_enqueue() {
    if ( ! is_page() ) return;
    if ( get_page_template_slug( get_queried_object_id() ) !== 'page-templates/template-company-v3.php' ) return;

    $uri = get_stylesheet_directory_uri();
    $dir = get_stylesheet_directory();

    // Plus Jakarta Sans đã được home-v2-loader đăng ký global → reuse nếu có
    if ( function_exists( 'oo_enqueue_plus_jakarta_sans' ) ) {
        oo_enqueue_plus_jakarta_sans();
    }

    wp_enqueue_style(
        'oneoffice-company-v3',
        $uri . '/assets/css/company-v3.css',
        array( 'oneoffice-main', 'oneoffice-sprint1', 'oneoffice-design-system' ),
        filemtime( $dir . '/assets/css/company-v3.css' )
    );
    wp_enqueue_script(
        'oneoffice-company-v3',
        $uri . '/assets/js/company-v3.js',
        array(),
        filemtime( $dir . '/assets/js/company-v3.js' ),
        true
    );
}
