<?php
/**
 * Custom Schema Markup — OneOffice / Wonderland Việt Nam
 *
 * Nguyên tắc:
 * - 1 nguồn duy nhất cho Organization/LocalBusiness (inject vào graph Yoast, có @id).
 * - Không tạo node trùng @type với Yoast.
 * - Tắt schema TRÙNG/SAI từ WooCommerce (Product giá ảo, BreadcrumbList trùng Yoast).
 *
 * Phân công:
 * - Yoast  : WebPage / CollectionPage, ImageObject, BreadcrumbList, WebSite.
 * - File này: LocalBusiness (graph), Article (post), FAQPage (VPTG 751).
 * - WooCommerce: Product + BreadcrumbList -> ĐÃ TẮT (xem cuối file).
 *
 * Deploy: toàn bộ bằng code -> an toàn khi push git lên hosting (không phụ thuộc DB).
 * Để tắt: xoá require_once trong functions.php.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/** @id chung cho node tổ chức — dùng để liên kết publisher/isPartOf. */
function oo_schema_org_id() {
	return home_url( '/#localbusiness' );
}

/** URL logo chính thức. */
function oo_schema_logo_url() {
	return home_url( '/wp-content/uploads/2020/11/logo-wonder-vuong-2.png' );
}

/**
 * Dữ liệu node LocalBusiness — 100% từ thông tin thật của doanh nghiệp.
 */
function oo_schema_org_node() {
	$logo_url = oo_schema_logo_url();

	return array(
		'@type'         => 'LocalBusiness',
		'@id'           => oo_schema_org_id(),
		'name'          => 'Wonderland Việt Nam',
		'alternateName' => 'OneOffice',
		'description'   => 'Đại lý cho thuê văn phòng hàng đầu Hà Nội — 500+ tòa nhà hạng A-B-C, 6.000+ khách thuê, 10+ năm kinh nghiệm. Tư vấn miễn phí & hỗ trợ đàm phán.',
		'url'           => home_url( '/' ),
		'logo'          => array(
			'@type' => 'ImageObject',
			'url'   => $logo_url,
			'width' => 600,
			'height'=> 600,
		),
		'image'         => $logo_url,
		'telephone'     => '+84966681616',
		'email'         => 'info@wonderlandvietnam.vn',
		'address'       => array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => 'số 74, ngõ 310 Nghi Tàm, phường Hồng Hà',
			'addressLocality' => 'Hà Nội',
			'addressCountry'  => 'VN',
		),
		'geo'           => array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => '21.0285',
			'longitude' => '105.8542',
		),
		'openingHoursSpecification' => array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ),
			'opens'     => '08:00',
			'closes'    => '18:00',
		),
		'sameAs'        => array(
			'https://zalo.me/0966681616',
		),
		'priceRange'    => '$$',
		'areaServed'    => array(
			'@type' => 'City',
			'name'  => 'Hà Nội',
		),
		'knowsAbout'    => array(
			'Cho thuê văn phòng',
			'Văn phòng trọn gói',
			'Văn phòng ảo',
			'Coworking Space',
			'Thi công nội thất văn phòng',
		),
	);
}

/**
 * Inject LocalBusiness vào graph Yoast + sửa WebSite (name rỗng) + gán publisher.
 * Chạy trên MỌI trang frontend để reference publisher luôn resolve được.
 */
add_filter( 'wpseo_schema_graph', 'oo_inject_localbusiness_graph', 20, 2 );
function oo_inject_localbusiness_graph( $graph, $context = null ) {
	if ( ! is_array( $graph ) ) return $graph;

	$org_id           = oo_schema_org_id();
	$has_org_already  = false;

	foreach ( $graph as &$piece ) {
		if ( empty( $piece['@type'] ) ) continue;
		$types = (array) $piece['@type'];

		// Nếu Yoast (hoặc plugin khác) đã có node tổ chức -> không thêm nữa, tránh trùng.
		if ( array_intersect( array( 'Organization', 'LocalBusiness' ), $types ) ) {
			$has_org_already = true;
		}

		// Sửa WebSite: name/description đang rỗng + gán publisher về tổ chức.
		if ( in_array( 'WebSite', $types, true ) ) {
			if ( empty( $piece['name'] ) ) {
				$piece['name'] = 'Wonderland Việt Nam';
			}
			if ( empty( $piece['alternateName'] ) ) {
				$piece['alternateName'] = 'OneOffice';
			}
			if ( empty( $piece['description'] ) ) {
				$piece['description'] = 'Đại lý cho thuê văn phòng hàng đầu Hà Nội — tòa nhà hạng A-B-C, văn phòng trọn gói, văn phòng ảo, coworking.';
			}
			$piece['publisher'] = array( '@id' => $org_id );
		}
	}
	unset( $piece );

	if ( ! $has_org_already ) {
		$graph[] = oo_schema_org_node();
	}

	return $graph;
}

/**
 * Article schema — cho bài viết đơn (post).
 * Yoast (free, cấu hình hiện tại) không xuất node Article -> bổ sung, không trùng.
 * publisher trỏ @id tổ chức (Google merge mọi JSON-LD trên trang nên resolve được).
 */
add_action( 'wp_head', 'oo_schema_article', 2 );
function oo_schema_article() {
	if ( ! is_singular( 'post' ) ) return;
	$post = get_post();
	if ( ! $post ) return;

	$img  = get_the_post_thumbnail_url( $post, 'large' );
	if ( ! $img ) $img = oo_schema_logo_url();
	$desc = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 40, '…' );

	$schema = array(
		'@context'         => 'https://schema.org',
		'@type'            => 'Article',
		'@id'              => get_permalink( $post ) . '#article',
		'headline'         => wp_specialchars_decode( get_the_title( $post ), ENT_QUOTES ),
		'description'      => wp_specialchars_decode( $desc, ENT_QUOTES ),
		'image'            => $img,
		'datePublished'    => get_the_date( 'c', $post ),
		'dateModified'     => get_the_modified_date( 'c', $post ),
		'author'           => array(
			'@type' => 'Person',
			'name'  => get_the_author_meta( 'display_name', $post->post_author ),
		),
		'publisher'        => array( '@id' => oo_schema_org_id() ),
		'mainEntityOfPage' => array( '@type' => 'WebPage', '@id' => get_permalink( $post ) ),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}

/**
 * FAQPage schema — chỉ output trên page 751 (/van-phong-tron-goi/).
 * Dữ liệu khớp 100% với 7 FAQ hiển thị thật trong template-vptg-v2.php.
 */
add_action( 'wp_head', 'oo_schema_faq_vptg', 2 );
function oo_schema_faq_vptg() {
	if ( ! is_page( 751 ) ) return;

	$faqs = array(
		array(
			'q' => 'Văn phòng trọn gói là gì?',
			'a' => 'Văn phòng trọn gói là hình thức cho thuê văn phòng hiện đại được thiết kế và trang bị chuyên nghiệp — công ty bạn sẽ sở hữu một văn phòng làm việc riêng. Phù hợp với doanh nghiệp cần thuê văn phòng đại diện hoặc giao dịch.',
		),
		array(
			'q' => 'Những lợi ích khi thuê văn phòng trọn gói?',
			'a' => 'So với văn phòng cho thuê truyền thống, văn phòng trọn gói giúp doanh nghiệp vừa có văn phòng thực để giao dịch, vừa giảm tối đa chi phí ngoài hoạt động cốt lõi: lễ tân chuyên nghiệp, tiết kiệm trang thiết bị, không cần đầu tư phòng họp.',
		),
		array(
			'q' => 'Văn phòng ảo là gì?',
			'a' => 'Văn phòng ảo (Virtual Office) là loại hình văn phòng chỉ cung cấp dịch vụ địa chỉ và liên lạc — không cần đến diện tích thực tế. Dịch vụ gồm: địa điểm giao dịch, số điện thoại, số fax, nhân viên lễ tân, biển hiệu công ty.',
		),
		array(
			'q' => 'Những lợi ích khi thuê văn phòng ảo?',
			'a' => 'Văn phòng ảo là giải pháp hoàn hảo cho việc vận hành doanh nghiệp từ xa — giảm chi phí thuê văn phòng truyền thống nhưng vẫn vận hành chuyên nghiệp và hiệu quả.',
		),
		array(
			'q' => 'Coworking Space — Văn phòng chia sẻ là gì?',
			'a' => 'Văn phòng chia sẻ (Coworking Space) là dịch vụ cung cấp không gian làm việc có đầy đủ các chức năng của một văn phòng chuyên nghiệp — phù hợp startup và freelancer.',
		),
		array(
			'q' => 'Các dịch vụ và tiện ích tại Coworking Space?',
			'a' => 'Địa chỉ giao dịch, lễ tân/bảo vệ chuyên nghiệp, điện làm việc 24/7, điều hòa, internet, nước uống, bàn ghế hiện đại, máy fax/photocopy/scan, phòng họp hiện đại với máy chiếu và WIFI.',
		),
		array(
			'q' => 'Những lợi ích khi thuê Coworking Space?',
			'a' => 'Tính linh hoạt (thuê theo tháng), cơ sở vật chất sẵn có, môi trường hợp tác mở rộng mạng lưới, không phí bảo trì, cơ hội học hỏi qua workshop và hội thảo.',
		),
	);

	$faq_items = array();
	foreach ( $faqs as $faq ) {
		$faq_items[] = array(
			'@type'          => 'Question',
			'name'           => $faq['q'],
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text'  => $faq['a'],
			),
		);
	}

	$schema = array(
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => $faq_items,
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}

/**
 * TẮT schema WooCommerce gây trùng / sai sự thật:
 *
 * 1) Product: site dùng Product để quản lý tòa nhà cho thuê (KHÔNG bán online).
 *    WooCommerce tự xuất offers.price/availability="InStock" -> dữ liệu giá ảo,
 *    vi phạm guideline Google. -> Tắt hẳn Product structured data.
 *
 * 2) BreadcrumbList: trùng với BreadcrumbList của Yoast (Yoast giữ vai trò chính,
 *    đúng cấu trúc taxonomy). -> Tắt bản của WooCommerce.
 *
 * Trả mảng rỗng (không có @type) -> WC_Structured_Data::set_data() bỏ qua.
 */
add_filter( 'woocommerce_structured_data_product', '__return_empty_array', 99 );
add_filter( 'woocommerce_structured_data_breadcrumblist', '__return_empty_array', 99 );
