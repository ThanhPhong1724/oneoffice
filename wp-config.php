<?php

/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define('DB_NAME', "oneoffice_local");


/** Username của database */
define('DB_USER', "root");


/** Mật khẩu của database */
define('DB_PASSWORD', "");


/** Hostname của database */
define('DB_HOST', "localhost");


/** Database charset sử dụng để tạo bảng database. */
define('DB_CHARSET', 'utf8mb4');


/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         's/l-ssnfz~0`F8,sn,-rYfD Ppvfs._?D#-1u4cfVCl=A2bBFknXj~.H`PKWcCN3');

define('SECURE_AUTH_KEY',  '2;YKB@J$4hq#e8l.)-f0 Q)v.&mX*q|$-!9YvFYOS`#ukSdO]<xjf.b HTQNt?JK');

define('LOGGED_IN_KEY',    'owJalVtKIfQy_ KE]NJ]56-s]:y(fdcc3#i9#OAvs8,!Z+= TUv0.PFX%&nb*`WR');

define('NONCE_KEY',        'S&G&!AYNIOFI:.[ZiB04mZ[3uzS>M)(m~6G+.])r6t&Fws*NyzOp!SI9I}x3r9d.');

define('AUTH_SALT',        'KV+ptY<c%;KhEu[c-X6o4j>Gd_]Gxe?uaHh<D#hyL<Zg|M:TUmqV%S@|)tuPY%eS');

define('SECURE_AUTH_SALT', '6@l0P:-c^f&mfw1p+S,x^|xd}KQBFbr~#CR fz,:-{b;wMbM;P;-L0~k$_Pwfw2$');

define('LOGGED_IN_SALT',   '?rNp1e(4%h*k[Ak04(0[=x+!/nx%Ss! cr_WkK&]D%&ea!T@XTAGWao2N4KS#c|F');

define('NONCE_SALT',       'E=qe1B YjkM[=)k>6wdKUg3bC)0hz8op:HY6GKOyr7Q+unm+.{`RlYWa$+J]fw^~');


/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'tlq_';


/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
/* Tắt debug để tăng tốc (ngừng ghi log deprecation mỗi request).
   Bật lại khi cần dev: đổi WP_DEBUG + WP_DEBUG_LOG = true. */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
/* ==== URL động — chạy được cả localhost lẫn Cloudflare Tunnel (demo cho khách) ==== */
if ( ! empty( $_SERVER['HTTP_HOST'] ) ) {
	$oo_host  = ! empty( $_SERVER['HTTP_X_FORWARDED_HOST'] ) ? $_SERVER['HTTP_X_FORWARDED_HOST'] : $_SERVER['HTTP_HOST'];
	$oo_host  = preg_replace( '/[^a-zA-Z0-9.\-:]/', '', $oo_host ); // chỉ giữ ký tự host hợp lệ
	$oo_https = ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' )
	         || ( ! empty( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' );
	if ( $oo_https ) { $_SERVER['HTTPS'] = 'on'; }
	$oo_proto = $oo_https ? 'https' : 'http';
	define( 'WP_HOME',    $oo_proto . '://' . $oo_host . '/oneoffice' );
	define( 'WP_SITEURL', $oo_proto . '://' . $oo_host . '/oneoffice' );
} else {
	define( 'WP_HOME',    'http://localhost/oneoffice' );
	define( 'WP_SITEURL', 'http://localhost/oneoffice' );
}
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
