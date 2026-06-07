<?php
/**
 * OO Tunnel URL Rewrite (DEMO ONLY)
 * Đổi mọi URL hardcode (localhost/oneoffice + oneoffice.vn) trong output frontend
 * sang host hiện tại (home_url()) → chạy đúng khi xem qua Cloudflare Tunnel.
 * Tự no-op khi xem ở localhost. Xoá file này để tắt.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'template_redirect', function () {
    if ( is_admin() ) return;
    ob_start( function ( $html ) {
        if ( ! is_string( $html ) || $html === '' ) return $html;
        $home = home_url(); // động theo WP_HOME (= URL tunnel khi vào qua tunnel)
        $search = array(
            'https://localhost/oneoffice',
            'http://localhost/oneoffice',
            'https://oneoffice.vn',
            'http://oneoffice.vn',
        );
        return str_replace( $search, $home, $html );
    } );
}, 1 );
