<?php
/**
 * UChat (uhchat.net) live-chat widget — nhúng toàn site.
 *
 * Mã nhúng do tài khoản UChat cung cấp (f=cad774).
 * Vị trí hiển thị (góc phải/trái), màu, lời chào… cấu hình trong dashboard https://uhchat.net
 * (KHÔNG cấu hình ở đây — file này chỉ chèn script).
 *
 * Lưu ý: cụm nút Gọi/Zalo/Messenger (plugin Call Now Button) đang ở góc PHẢI dưới.
 * Nếu UChat cũng để góc phải và bị đè, đổi vị trí UChat trong dashboard.
 *
 * Để tắt: xoá dòng require_once trong functions.php.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_footer', 'oo_uchat_widget', 99 );

function oo_uchat_widget() {
    if ( is_admin() ) return;
    echo "\n<!-- UChat live-chat widget -->\n";
    echo '<script src="https://uhchat.net/code.php?f=cad774"></script>' . "\n";
}
