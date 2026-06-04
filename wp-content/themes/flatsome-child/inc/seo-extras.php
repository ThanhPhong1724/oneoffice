<?php
/**
 * SEO Extras — bổ sung 2 việc:
 *   1) Chống spam cơ bản cho mọi form CF7 (honeypot, không cần API key/plugin).
 *   2) Đảm bảo mỗi bài viết chỉ có 1 thẻ H1 (hạ H1 trong nội dung xuống H2).
 *
 * Để tắt: xoá dòng require_once trong functions.php.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* =============================================================
 * 1) HONEYPOT chống spam — áp dụng cho TẤT CẢ form CF7
 *    Bot thường tự điền mọi input; ô ẩn này người thật không thấy.
 *    Nếu ô có giá trị => coi là spam, không gửi mail.
 * ============================================================= */
add_filter( 'wpcf7_form_elements', 'oo_cf7_inject_honeypot' );
function oo_cf7_inject_honeypot( $html ) {
    $hp = '<span class="oo-hp-field" aria-hidden="true">'
        . '<label>Để trống ô này nếu bạn là người thật</label>'
        . '<input type="text" name="oo_hp_website" value="" size="20" tabindex="-1" autocomplete="off">'
        . '</span>';
    return $hp . $html;
}

add_action( 'wp_head', 'oo_cf7_honeypot_css', 1 );
function oo_cf7_honeypot_css() {
    echo '<style id="oo-hp-css">.oo-hp-field{position:absolute!important;left:-9999px!important;top:-9999px!important;width:1px;height:1px;overflow:hidden;opacity:0;pointer-events:none;}</style>' . "\n";
}

add_filter( 'wpcf7_spam', 'oo_cf7_honeypot_check', 9 );
function oo_cf7_honeypot_check( $spam ) {
    if ( $spam ) return $spam;
    if ( isset( $_POST['oo_hp_website'] ) && trim( (string) $_POST['oo_hp_website'] ) !== '' ) {
        return true; // honeypot bị điền => bot
    }
    return $spam;
}

/* =============================================================
 * 2) MỘT H1/BÀI VIẾT — hạ mọi <h1> trong nội dung bài xuống <h2>
 *    (tiêu đề bài đã là H1 do theme render).
 * ============================================================= */
add_filter( 'the_content', 'oo_demote_content_h1', 20 );
function oo_demote_content_h1( $content ) {
    if ( ! is_singular( 'post' ) ) return $content;
    return preg_replace( '/<(\/?)h1(\s|>)/i', '<$1h2$2', $content );
}
