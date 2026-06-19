<?php
/**
 * Fix phân trang category blog top-level (A+B).
 *
 * Vấn đề: woo-permalink-manager (Premmerce) gỡ base "category". Category CON
 * (vd /tu-van/tien-ich-xung-quanh/page/2/) vẫn có rewrite rule và chạy 200,
 * nhưng category CHA top-level (/tu-van/page/2/) THIẾU rule -> trả 404.
 * Hệ quả: menu "Tin tức" trỏ /tu-van/ chỉ xem được 10 bài mới nhất, mọi bài
 * cũ hơn (vd "Đài quan sát Skywalk...") bị kẹt ở trang 2+ không truy cập được.
 *
 * Flatsome ĐÃ render đúng link phân trang (.nav-pagination -> /{slug}/page/N/),
 * chỉ cần đăng ký rewrite rule cho các category top-level là đủ. Vì "Tư vấn"
 * là category cha của toàn bộ chuyên mục, /tu-van/ gộp sẵn bài của cả nhánh
 * -> fix này đồng thời cho phép xem HẾT bài + duyệt theo trang ổn định.
 *
 * KHÔNG đổi template, KHÔNG đổi giao diện, KHÔNG sửa DB/menu. Deploy-safe (code).
 * Rollback: xoá require_once trong functions.php.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/** Phiên bản rule — tăng số này nếu đổi logic để buộc flush lại 1 lần. */
function oo_cat_paged_rules_version() {
	return '2';
}

/**
 * Chèn rule ^{slug}/page/N cho category cha (parent=0) LÊN ĐẦU mảng rewrite.
 *
 * Phải dùng filter (không dùng add_rewrite_rule 'top') với priority cao để
 * chạy SAU WooCommerce/Premmerce — nếu không rule catch-all của Premmerce
 * (^([^/]+)/page/N -> product_cat=$1) sẽ khớp trước và ép "tu-van" thành
 * product_cat không tồn tại -> 404.
 */
add_filter( 'rewrite_rules_array', 'oo_prepend_top_category_paged_rules', 9999 );
function oo_prepend_top_category_paged_rules( $rules ) {
	if ( ! is_array( $rules ) ) return $rules;

	$parents = get_terms( array(
		'taxonomy'   => 'category',
		'parent'     => 0,
		'hide_empty' => false,
		'fields'     => 'id=>slug',
	) );
	if ( is_wp_error( $parents ) || empty( $parents ) ) return $rules;

	$mine = array();
	foreach ( $parents as $slug ) {
		if ( empty( $slug ) ) continue;
		$mine[ '^' . $slug . '/page/([0-9]+)/?$' ] = 'index.php?category_name=' . $slug . '&paged=$matches[1]';
	}

	// Hợp nhất: rule của ta đứng trước -> được khớp trước rule catch-all.
	return $mine + $rules;
}

/**
 * LƯU Ý: nội dung lưới bài trên trang category KHÔNG do main query render, mà do
 * plugin devtung-mvc (shortcode [dt_post_category] -> PostModel::category()).
 * Phần phân trang LÁT BÀI đã được sửa trong chính PostModel::category()
 * (đọc 'paged'). File này chỉ lo phần rewrite để URL /{slug}/page/N không 404.
 */

/**
 * Flush 1 lần khi version thay đổi (không flush mỗi request -> không hại hiệu năng).
 * Tự chạy lại trên hosting sau khi deploy vì option chưa tồn tại ở DB production.
 */
add_action( 'init', 'oo_maybe_flush_category_paged_rules', 21 );
function oo_maybe_flush_category_paged_rules() {
	if ( get_option( 'oo_cat_paged_rules_ver' ) !== oo_cat_paged_rules_version() ) {
		flush_rewrite_rules( false );
		update_option( 'oo_cat_paged_rules_ver', oo_cat_paged_rules_version() );
	}
}
