<?php
/**
 * Custom Schema Markup — Organization + FAQPage
 *
 * - Organization/LocalBusiness: output trên tất cả pages (global)
 * - FAQPage: output trên page 751 (/van-phong-tron-goi/) — có 7 FAQs
 *
 * Yoast đã output WebSite, WebPage, BreadcrumbList, Product (WooCommerce).
 * File này BỔ SUNG thêm — không xung đột với Yoast schema.
 *
 * Để tắt: xoá require_once trong functions.php.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_head', 'oo_schema_organization', 2 );
add_action( 'wp_head', 'oo_schema_faq_vptg', 2 );
add_action( 'wp_head', 'oo_schema_article', 2 );

/**
 * Article schema — cho bài viết đơn (post).
 * Bổ sung vì Yoast hiện không xuất node Article trên bài viết.
 */
function oo_schema_article() {
    if ( ! is_singular( 'post' ) ) return;
    $post = get_post();
    if ( ! $post ) return;

    $logo_url = home_url( '/wp-content/uploads/2020/11/logo-wonder-vuong-2.png' );
    $img = get_the_post_thumbnail_url( $post, 'large' );
    if ( ! $img ) $img = $logo_url;
    $desc = has_excerpt( $post ) ? get_the_excerpt( $post ) : wp_trim_words( wp_strip_all_tags( $post->post_content ), 40, '…' );

    $schema = array(
        '@context'         => 'https://schema.org',
        '@type'            => 'Article',
        'headline'         => wp_specialchars_decode( get_the_title( $post ), ENT_QUOTES ),
        'description'      => wp_specialchars_decode( $desc, ENT_QUOTES ),
        'image'            => $img,
        'datePublished'    => get_the_date( 'c', $post ),
        'dateModified'     => get_the_modified_date( 'c', $post ),
        'author'           => array(
            '@type' => 'Person',
            'name'  => get_the_author_meta( 'display_name', $post->post_author ),
        ),
        'publisher'        => array(
            '@type' => 'Organization',
            'name'  => 'Wonderland Việt Nam',
            'logo'  => array( '@type' => 'ImageObject', 'url' => $logo_url ),
        ),
        'mainEntityOfPage' => array( '@type' => 'WebPage', '@id' => get_permalink( $post ) ),
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}

/**
 * Organization / LocalBusiness schema — global, output 1 lần trên homepage.
 * Dữ liệu 100% từ nội dung thật trên site.
 */
function oo_schema_organization() {
    // Chỉ output trên homepage để tránh duplicate
    if ( ! is_front_page() ) return;

    $logo_url = home_url( '/wp-content/uploads/2020/11/logo-wonder-vuong-2.png' );

    $schema = array(
        '@context'    => 'https://schema.org',
        '@type'       => 'LocalBusiness',
        'name'        => 'Wonderland Việt Nam',
        'alternateName' => 'OneOffice',
        'description' => 'Đại lý cho thuê văn phòng hàng đầu Hà Nội — 500+ tòa nhà hạng A-B-C, 6.000+ khách thuê, 10+ năm kinh nghiệm. Tư vấn miễn phí & hỗ trợ đàm phán.',
        'url'         => home_url( '/' ),
        'logo'        => $logo_url,
        'image'       => $logo_url,
        'telephone'   => '+84966681616',
        'email'       => 'info@wonderlandvietnam.vn',
        'address'     => array(
            '@type'           => 'PostalAddress',
            'streetAddress'   => 'số 74, ngõ 310 Nghi Tàm, phường Hồng Hà',
            'addressLocality' => 'Hà Nội',
            'addressCountry'  => 'VN',
        ),
        'geo'         => array(
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
        'sameAs'      => array(
            'https://zalo.me/0966681616',
        ),
        'priceRange'  => '$',
        'areaServed'  => array(
            '@type' => 'City',
            'name'  => 'Hà Nội',
        ),
        'knowsAbout'  => array(
            'Cho thuê văn phòng',
            'Văn phòng trọn gói',
            'Văn phòng ảo',
            'Coworking Space',
            'Thi công nội thất văn phòng',
        ),
    );

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) . '</script>' . "\n";
}

/**
 * FAQPage schema — chỉ output trên page 751 (/van-phong-tron-goi/).
 * Dữ liệu lấy 100% từ $oo_vptg_faqs trong template-vptg-v2.php.
 */
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
