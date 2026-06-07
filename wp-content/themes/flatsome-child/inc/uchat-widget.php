<?php
/**
 * Live-chat widget — Tawk.to (đã thay UChat vào 2026-06-07).
 *
 * Mã nhúng do tài khoản Tawk.to cung cấp (property ID: 6a2585cb8ff16b1c302951af).
 * Cấu hình vị trí widget, lời chào, giờ làm việc… trong dashboard:
 *   https://dashboard.tawk.to/ → Administration → Chat Widget
 *
 * Cấu hình vị trí widget (desktop/mobile, offset, hide on mobile…) đã được
 * set trên dashboard Tawk.to — KHÔNG override trong code này nữa.
 *
 * File vẫn giữ tên 'uchat-widget.php' để khỏi sửa nhiều nơi require.
 * Để tắt: xoá dòng require_once trong functions.php.
 * Rollback về UChat: git checkout 7ae9d4d -- inc/uchat-widget.php.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_footer', 'oo_tawk_widget', 99 );

function oo_tawk_widget() {
    if ( is_admin() ) return;
    ?>
<!-- Tawk.to live-chat widget -->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/6a2585cb8ff16b1c302951af/1jqh959lf';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!-- End Tawk.to -->
    <?php
}
