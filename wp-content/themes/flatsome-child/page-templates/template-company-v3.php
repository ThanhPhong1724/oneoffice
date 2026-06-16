<?php
/**
 * Template Name: Company V3 — Thông tin / Hồ sơ / Đội ngũ / Quy trình / KH / Liên hệ / Ký gửi
 *
 * Một template duy nhất phục vụ 7 trang (theo slug). Mọi nội dung doanh nghiệp
 * (hotline, email, địa chỉ, số liệu, testimonial) đã được trích từ
 * post_content GỐC — không bịa.
 *
 * Rollback: xoá _wp_page_template của 7 page IDs về '' (xem company-v3-loader).
 */

if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$oo_slug      = get_post_field( 'post_name', get_queried_object_id() );
$oo_hero_bg   = wp_get_attachment_url( 883 ); // shared banner
$oo_hotline_a = '0966681616';                  // chính
$oo_hotline_d = '0966 68 1616';
$oo_hotline_k = '0988902468';                  // hotline ký gửi (giữ từ nội dung gốc)
$oo_email     = 'info@wonderlandvietnam.vn';
$oo_address   = 'số 74, ngõ 310 Nghi Tàm, phường Hồng Hà, Hà Nội';

/* ICON helper — SVG inline cho gọn + nhẹ */
function oo_cv3_icon( $name ) {
    $icons = array(
        'building'  => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 21V3h10v6h8v12H3zm2-2h6v-2H5v2zm0-4h6v-2H5v2zm0-4h6V9H5v2zm0-4h6V5H5v2zm8 12h6v-8h-6v8zm2-6h2v-2h-2v2zm0 4h2v-2h-2v2z"/></svg>',
        'users'     => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 3-1.34 3-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>',
        'award'     => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 17l-5.5 3.2 1.5-6.3-4.9-4.2 6.4-.5L12 3.5l2.5 5.7 6.4.5-4.9 4.2 1.5 6.3z"/></svg>',
        'consult'   => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM6 9h12v2H6V9zm8 5H6v-2h8v2zm4-6H6V6h12v2z"/></svg>',
        'design'    => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a.996.996 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>',
        'megaphone' => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M18 11v2h4v-2h-4zm-2 6.61c.96.71 2.21 1.65 3.2 2.39.4-.53.8-1.07 1.2-1.6-.99-.74-2.24-1.68-3.2-2.4-.4.54-.8 1.08-1.2 1.61zM20.4 5.6c-.4-.53-.8-1.07-1.2-1.6-.99.74-2.24 1.68-3.2 2.4.4.53.8 1.07 1.2 1.6.96-.72 2.21-1.65 3.2-2.4zM4 9c-1.1 0-2 .9-2 2v2c0 1.1.9 2 2 2h1v4h2v-4h1l5 3V6L8 9H4zm11.5 3c0-1.33-.58-2.53-1.5-3.35v6.69c.92-.81 1.5-2.01 1.5-3.34z"/></svg>',
        'target'    => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-3.31 0-6 2.69-6 6s2.69 6 6 6 6-2.69 6-6-2.69-6-6-6zm0 10c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm-1-4c0-.55.45-1 1-1s1 .45 1 1-.45 1-1 1-1-.45-1-1z"/></svg>',
        'rocket'    => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M9.19 6.35c-2.04 2.29-3.44 5.58-3.57 5.89L2 10.69l4.05-4.05c.47-.47 1.15-.68 1.81-.55l1.33.26zM11.17 17s3.74-1.55 5.89-3.7c5.4-5.4 4.5-9.62 4.21-10.57-.95-.3-5.17-1.19-10.57 4.21C8.55 9.09 7 12.83 7 12.83L11.17 17zm6.48-2.19c-2.29 2.04-5.58 3.44-5.89 3.57L13.31 22l4.05-4.05c.47-.47.68-1.15.55-1.81l-.26-1.33zM9 18c0 .83-.34 1.58-.88 2.12-1.18 1.18-4.62 1.61-4.62 1.61s.43-3.44 1.62-4.62C5.66 16.56 6.41 16.22 7.24 16.22 8.55 16.22 9 18 9 18z"/></svg>',
        'phone'     => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20.01 15.38c-1.23 0-2.42-.2-3.53-.56a.977.977 0 0 0-1.01.24l-1.57 1.97c-2.83-1.35-5.48-3.9-6.89-6.83l1.95-1.66c.27-.28.35-.67.24-1.02-.37-1.11-.56-2.3-.56-3.53 0-.54-.45-.99-.99-.99H4.19C3.65 3 3 3.24 3 3.99 3 13.28 10.73 21 20.01 21c.71 0 .99-.63.99-1.18v-3.45c0-.54-.45-.99-.99-.99z"/></svg>',
        'mail'      => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/></svg>',
        'pin'       => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"/></svg>',
        'zalo'      => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.4 0 0 4.86 0 10.86c0 2.8 1.18 5.34 3.1 7.27l-1.43 4.05c-.07.2.16.4.36.3l4.4-2.06c1.7.8 3.6 1.26 5.57 1.26 6.6 0 12-4.86 12-10.86C24 4.86 18.6 0 12 0zm-3.2 12.4H7.4v-3.2H6.2V8h2.6v4.4zm3.2 0c-1.4 0-2.4-1-2.4-2.4s1-2.4 2.4-2.4 2.4 1 2.4 2.4-1 2.4-2.4 2.4zm5.6 0h-1.4V8h1.4v4.4z"/></svg>',
        'check'     => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z"/></svg>',
        'shield'    => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm-2 16l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/></svg>',
        'heart'     => '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>',
    );
    return isset( $icons[$name] ) ? $icons[$name] : '';
}
?>

<div class="cv3" data-page="<?php echo esc_attr( $oo_slug ); ?>">

<?php
// ─── HERO  (ngoại trừ /thong-tin-cong-ty/ — trang đó dùng content-style) ───
$oo_hero_data = array(
    'ho-so-nang-luc'             => array( 'eyebrow' => 'Wonderland Việt Nam', 'title' => 'Hồ sơ năng lực',                    'sub' => 'Đơn vị tư vấn cho thuê văn phòng và thiết kế thi công nội thất hàng đầu tại Hà Nội.' ),
    'doi-ngu'                    => array( 'eyebrow' => 'Đội ngũ Wonderland', 'title' => 'Đội ngũ nhân sự',                   'sub' => 'Hội tụ những chuyên viên tư vấn bất động sản giàu kinh nghiệm, tận tụy và am tường thị trường sâu sắc.' ),
    'quy-trinh-dich-vu'          => array( 'eyebrow' => '6 bước chuyên nghiệp', 'title' => 'Quy trình dịch vụ',                 'sub' => 'Quy trình chuẩn hóa giúp doanh nghiệp tiết kiệm thời gian, tối ưu chi phí, ký được hợp đồng thuê tốt nhất.' ),
    'khach-hang-du-an-tieu-bieu' => array( 'eyebrow' => 'Đồng hành cùng phát triển', 'title' => 'Khách hàng & Dự án tiêu biểu',  'sub' => 'Đồng hành cùng hàng ngàn tập đoàn đa quốc gia và doanh nghiệp Việt Nam trong suốt 10+ năm.' ),
    'lien-he'                    => array( 'eyebrow' => 'Sẵn sàng tư vấn 24/7', 'title' => 'Liên hệ Wonderland Việt Nam',     'sub' => 'Chúng tôi luôn sẵn sàng lắng nghe, tư vấn và đồng hành cùng doanh nghiệp tìm văn phòng ưng ý với chi phí tối ưu.' ),
    'ky-gui'                     => array( 'eyebrow' => 'Dịch vụ ký gửi', 'title' => 'Ký gửi văn phòng',                        'sub' => 'Wonderland giúp tiếp cận hàng ngàn doanh nghiệp — văn phòng của bạn sẽ được cho thuê nhanh nhất.' ),
    'thong-tin-cong-ty'          => array( 'eyebrow' => 'Wonderland Việt Nam', 'title' => 'Đại lý cho thuê văn phòng Hà Nội',  'sub' => 'Hơn 10 năm kinh nghiệm tư vấn cho thuê văn phòng chuyên nghiệp tại Hà Nội. Mạng lưới 500+ tòa nhà · 6.000+ khách hàng.' ),
);
$hero = isset( $oo_hero_data[ $oo_slug ] ) ? $oo_hero_data[ $oo_slug ] : $oo_hero_data['thong-tin-cong-ty'];
// Overlay đậm hơn để tiêu đề trắng đọc rõ trên ảnh banner sáng
$overlay = 'linear-gradient(135deg, rgba(6,52,67,.88) 0%, rgba(21,113,181,.62) 55%, rgba(18,156,148,.70) 100%)';
?>
    <section class="cv3-hero" style="background-image: <?php echo $overlay; ?>, url('<?php echo esc_url( $oo_hero_bg ); ?>');">
        <div class="cv3-hero__inner">
            <span class="cv3-eyebrow"><?php echo esc_html( $hero['eyebrow'] ); ?></span>
            <h1 class="cv3-hero__title"><?php echo esc_html( $hero['title'] ); ?></h1>
            <p class="cv3-hero__subtitle"><?php echo esc_html( $hero['sub'] ); ?></p>
            <?php if ( $oo_slug === 'ky-gui' ) : ?>
                <div class="cv3-hero__actions">
                    <a href="tel:<?php echo $oo_hotline_k; ?>" class="cv3-btn cv3-btn--primary cv3-btn--lg"><?php echo oo_cv3_icon('phone'); ?> Gọi tư vấn ký gửi: <?php echo substr_replace($oo_hotline_k,'.',4,0); ?></a>
                    <a href="#cv3-kygui-form" class="cv3-btn cv3-btn--ghost cv3-btn--lg">Đăng ký ký gửi</a>
                </div>
            <?php elseif ( $oo_slug === 'lien-he' || $oo_slug === 'thong-tin-cong-ty' ) : ?>
                <div class="cv3-hero__actions">
                    <a href="tel:<?php echo $oo_hotline_a; ?>" class="cv3-btn cv3-btn--primary cv3-btn--lg"><?php echo oo_cv3_icon('phone'); ?> Hotline: <?php echo $oo_hotline_d; ?></a>
                    <a href="https://zalo.me/<?php echo $oo_hotline_a; ?>" target="_blank" rel="noopener" class="cv3-btn cv3-btn--ghost cv3-btn--lg"><?php echo oo_cv3_icon('zalo'); ?> Chat Zalo</a>
                </div>
            <?php endif; ?>
        </div>
    </section>

<?php
/* ============================================================================
 * NỘI DUNG THEO TỪNG TRANG  (switch theo slug)
 * ========================================================================== */
switch ( $oo_slug ) :

/* ──────────────────────────── 1. Thông tin công ty ──────────────────────────── */
case 'thong-tin-cong-ty': ?>
    <section class="cv3-section cv3-section--light">
        <div class="cv3-container">
            <div class="cv3-secthead"><span class="cv3-eyebrow">Về chúng tôi</span><h2>Wonderland Việt Nam là ai?</h2></div>
            <p class="cv3-lead">Wonderland Việt Nam (Công ty TNHH Wonderland Việt Nam) là đơn vị tư vấn cho thuê văn phòng chuyên nghiệp hàng đầu tại Hà Nội — hơn 10 năm hoạt động liên tục trên thị trường bất động sản thương mại.</p>
            <div class="cv3-stats">
                <div class="cv3-stat"><div class="cv3-stat__icon"><?php echo oo_cv3_icon('building'); ?></div><div class="cv3-stat__num">500+</div><div class="cv3-stat__label">Tòa nhà văn phòng</div><div class="cv3-stat__desc">Mạng lưới đối tác hạng A-B-C khắp Hà Nội.</div></div>
                <div class="cv3-stat"><div class="cv3-stat__icon"><?php echo oo_cv3_icon('users'); ?></div><div class="cv3-stat__num">6.000+</div><div class="cv3-stat__label">Khách thuê tin tưởng</div><div class="cv3-stat__desc">Doanh nghiệp trong và ngoài nước đã đồng hành cùng Wonderland.</div></div>
                <div class="cv3-stat"><div class="cv3-stat__icon"><?php echo oo_cv3_icon('award'); ?></div><div class="cv3-stat__num">10+</div><div class="cv3-stat__label">Năm kinh nghiệm</div><div class="cv3-stat__desc">Liên tục dẫn đầu trong tư vấn cho thuê văn phòng tại Hà Nội.</div></div>
            </div>
        </div>
    </section>
    <section class="cv3-section cv3-section--soft">
        <div class="cv3-container">
            <div class="cv3-split">
                <div class="cv3-split__copy">
                    <span class="cv3-eyebrow">Tầm nhìn</span>
                    <h2>Trở thành đại lý cho thuê văn phòng đáng tin cậy nhất Việt Nam</h2>
                    <p>Chúng tôi định hướng dài hạn để khẳng định vị thế <strong>đơn vị tư vấn cho thuê văn phòng uy tín hàng đầu</strong> — qua chất lượng dịch vụ, sự minh bạch và độ am hiểu thị trường.</p>
                    <ul class="cv3-bullets">
                        <li>Mạng lưới 500+ tòa nhà hạng A-B-C cập nhật liên tục</li>
                        <li>Quy trình tư vấn chuẩn hoá 6 bước</li>
                        <li>Đội ngũ chuyên viên 4–15 năm kinh nghiệm</li>
                    </ul>
                </div>
                <div class="cv3-split__media"><img src="<?php echo esc_url( wp_get_attachment_url( 783 ) ?: $oo_hero_bg ); ?>" alt="Wonderland Việt Nam"></div>
            </div>
        </div>
    </section>
    <section class="cv3-section cv3-section--light">
        <div class="cv3-container">
            <div class="cv3-secthead"><span class="cv3-eyebrow">Dịch vụ</span><h2>Giải pháp văn phòng toàn diện</h2><p>Từ tư vấn cho thuê truyền thống đến thi công nội thất — một điểm chạm cho mọi nhu cầu.</p></div>
            <div class="cv3-cards">
                <div class="cv3-card"><div class="cv3-card__icon"><?php echo oo_cv3_icon('consult'); ?></div><div class="cv3-card__body"><h3 class="cv3-card__title">Tư vấn cho thuê văn phòng</h3><p class="cv3-card__desc">Báo giá chính xác, so sánh đa tòa, đàm phán giúp khách hàng — hoàn toàn miễn phí.</p></div></div>
                <div class="cv3-card"><div class="cv3-card__icon"><?php echo oo_cv3_icon('design'); ?></div><div class="cv3-card__body"><h3 class="cv3-card__title">Thiết kế thi công nội thất</h3><p class="cv3-card__desc">Giải pháp sáng tạo, thi công trọn gói, tối ưu công năng diện tích văn phòng.</p></div></div>
                <div class="cv3-card"><div class="cv3-card__icon"><?php echo oo_cv3_icon('megaphone'); ?></div><div class="cv3-card__body"><h3 class="cv3-card__title">Quản lý & tiếp thị tòa nhà</h3><p class="cv3-card__desc">Đại diện chủ đầu tư tiếp cận khách thuê tiềm năng, tối đa hoá tỷ lệ lấp đầy.</p></div></div>
            </div>
        </div>
    </section>
<?php break;

/* ──────────────────────────── 2. Hồ sơ năng lực ──────────────────────────── */
case 'ho-so-nang-luc': ?>
    <section class="cv3-section cv3-section--light">
        <div class="cv3-container">
            <div class="cv3-split">
                <div class="cv3-split__copy">
                    <span class="cv3-eyebrow">Tổng quan</span>
                    <h2>Hơn 10 năm dẫn đầu thị trường cho thuê văn phòng Hà Nội</h2>
                    <p><strong>Công ty Cổ phần Tư vấn & Dịch vụ Bất động sản Wonderland Việt Nam</strong> là đơn vị tư vấn hàng đầu lĩnh vực BĐS văn phòng và thiết kế thi công nội thất tại Hà Nội.</p>
                    <p>Đối tác đáng tin cậy của <strong>500+ tòa nhà hạng A-B-C</strong>, đồng hành cùng <strong>6.000+ khách thuê</strong> đạt được điều khoản tốt nhất.</p>
                    <ul class="cv3-bullets">
                        <li>Khảo sát thực tế, đánh giá tài chính minh bạch</li>
                        <li>Đàm phán hợp đồng có lợi cho khách hàng</li>
                        <li>Hỗ trợ vận hành sau khi ký kết</li>
                    </ul>
                </div>
                <div class="cv3-split__media"><img src="<?php echo esc_url( wp_get_attachment_url( 783 ) ?: $oo_hero_bg ); ?>" alt="Hồ sơ năng lực Wonderland"></div>
            </div>
        </div>
    </section>
    <section class="cv3-section cv3-section--soft">
        <div class="cv3-container">
            <div class="cv3-secthead"><span class="cv3-eyebrow">Năng lực</span><h2>Quy mô đáng tin cậy</h2></div>
            <div class="cv3-stats">
                <div class="cv3-stat"><div class="cv3-stat__icon"><?php echo oo_cv3_icon('building'); ?></div><div class="cv3-stat__num">500+</div><div class="cv3-stat__label">Tòa nhà văn phòng</div><div class="cv3-stat__desc">Nguồn cung văn phòng dồi dào nhất Hà Nội — đại diện cho thuê & liên kết chặt chẽ.</div></div>
                <div class="cv3-stat"><div class="cv3-stat__icon"><?php echo oo_cv3_icon('users'); ?></div><div class="cv3-stat__num">6.000+</div><div class="cv3-stat__label">Khách thuê</div><div class="cv3-stat__desc">Hàng ngàn doanh nghiệp & tập đoàn đa quốc gia đã chốt được hợp đồng ưu đãi.</div></div>
                <div class="cv3-stat"><div class="cv3-stat__icon"><?php echo oo_cv3_icon('award'); ?></div><div class="cv3-stat__num">10+</div><div class="cv3-stat__label">Năm kinh nghiệm</div><div class="cv3-stat__desc">Đội ngũ giàu kinh nghiệm, quy trình thẩm định tòa nhà chặt chẽ, tối ưu thời gian.</div></div>
            </div>
        </div>
    </section>
    <section class="cv3-section cv3-section--light">
        <div class="cv3-container">
            <div class="cv3-secthead"><span class="cv3-eyebrow">Dịch vụ cốt lõi</span><h2>Ba mảng dịch vụ chủ lực</h2></div>
            <div class="cv3-cards">
                <div class="cv3-card"><div class="cv3-card__icon"><?php echo oo_cv3_icon('consult'); ?></div><div class="cv3-card__body"><h3 class="cv3-card__title">Tư vấn cho thuê văn phòng</h3><p class="cv3-card__desc">Cung cấp báo giá chính xác, hỗ trợ so sánh, đánh giá tài chính và đàm phán hợp đồng thuê có lợi nhất — hoàn toàn miễn phí cho khách hàng.</p></div></div>
                <div class="cv3-card"><div class="cv3-card__icon"><?php echo oo_cv3_icon('design'); ?></div><div class="cv3-card__body"><h3 class="cv3-card__title">Thiết kế thi công nội thất</h3><p class="cv3-card__desc">Giải pháp thiết kế sáng tạo, thi công trọn gói nội thất chuyên nghiệp, tối ưu hoá công năng sử dụng diện tích văn phòng.</p></div></div>
                <div class="cv3-card"><div class="cv3-card__icon"><?php echo oo_cv3_icon('megaphone'); ?></div><div class="cv3-card__body"><h3 class="cv3-card__title">Quản lý & tiếp thị tòa nhà</h3><p class="cv3-card__desc">Đại diện chủ đầu tư tiếp cận khách hàng tiềm năng nhanh chóng, tối đa hoá tỷ lệ lấp đầy của tòa nhà với dòng tiền ổn định.</p></div></div>
            </div>
        </div>
    </section>
<?php break;

/* ──────────────────────────── 3. Đội ngũ ──────────────────────────── */
case 'doi-ngu': ?>
    <section class="cv3-section cv3-section--light">
        <div class="cv3-container">
            <div class="cv3-secthead"><span class="cv3-eyebrow">Triết lý dịch vụ</span><h2>Đặt lợi ích khách hàng lên hàng đầu</h2></div>
            <p class="cv3-lead">Đội ngũ chuyên viên tư vấn bất động sản giàu kinh nghiệm, am hiểu sâu rộng về thị trường BĐS thương mại Hà Nội. Mỗi chuyên viên có từ <strong style="color:var(--primary)">4 đến 15 năm</strong> kinh nghiệm — luôn cung cấp thông tin trung thực, khách quan và giải pháp tối ưu.</p>
        </div>
    </section>
    <section class="cv3-section cv3-section--soft">
        <div class="cv3-container">
            <div class="cv3-secthead"><span class="cv3-eyebrow">Giá trị cốt lõi</span><h2>Bốn nguyên tắc làm việc</h2></div>
            <div class="cv3-values">
                <div class="cv3-value"><div class="cv3-value__icon"><?php echo oo_cv3_icon('shield'); ?></div><h3 class="cv3-value__title">Minh bạch</h3><p class="cv3-value__desc">Mọi thông tin báo giá, điều khoản hợp đồng được công khai rõ ràng, không phí ẩn.</p></div>
                <div class="cv3-value"><div class="cv3-value__icon"><?php echo oo_cv3_icon('heart'); ?></div><h3 class="cv3-value__title">Tận tâm</h3><p class="cv3-value__desc">Hỗ trợ khách hàng từ tư vấn đầu tiên đến vận hành sau hợp đồng — không bỏ ngang.</p></div>
                <div class="cv3-value"><div class="cv3-value__icon"><?php echo oo_cv3_icon('target'); ?></div><h3 class="cv3-value__title">Chính xác</h3><p class="cv3-value__desc">Dữ liệu thị trường cập nhật, đánh giá khách quan giúp ra quyết định đúng.</p></div>
                <div class="cv3-value"><div class="cv3-value__icon"><?php echo oo_cv3_icon('rocket'); ?></div><h3 class="cv3-value__title">Nhanh chóng</h3><p class="cv3-value__desc">Quy trình chuẩn hoá rút ngắn thời gian — báo giá đa tòa trong 15 phút.</p></div>
            </div>
        </div>
    </section>
    <section class="cv3-section cv3-section--light">
        <div class="cv3-container">
            <div class="cv3-split cv3-split--reverse">
                <div class="cv3-split__copy">
                    <span class="cv3-eyebrow">Đào tạo bài bản</span>
                    <h2>Chuyên viên am tường — quy trình chuẩn hoá</h2>
                    <p>Mỗi chuyên viên đều được đào tạo bài bản về pháp lý BĐS, kỹ năng thẩm định tòa nhà, kỹ năng đàm phán và chăm sóc khách hàng theo tiêu chuẩn quốc tế.</p>
                    <p>Hỗ trợ khách hàng <strong>trong suốt quá trình tìm thuê văn phòng</strong> — từ tư vấn ban đầu, khảo sát thực tế, đàm phán hợp đồng đến hỗ trợ vận hành sau khi ký kết.</p>
                </div>
                <div class="cv3-split__media"><img src="<?php echo esc_url( wp_get_attachment_url( 783 ) ?: $oo_hero_bg ); ?>" alt="Đội ngũ Wonderland Việt Nam"></div>
            </div>
        </div>
    </section>
<?php break;

/* ──────────────────────────── 4. Quy trình dịch vụ ──────────────────────────── */
case 'quy-trinh-dich-vu':
    $steps = array(
        array( 'Tiếp nhận yêu cầu',         'Tiếp nhận yêu cầu thuê, tư vấn sơ bộ về thị trường, nguồn cung và các lưu ý khi thuê văn phòng.' ),
        array( 'Báo giá, cung cấp thông tin', 'Gửi báo giá đầy đủ thông tin, hình ảnh các tòa nhà phù hợp kèm hồ sơ năng lực đại lý.' ),
        array( 'Khảo sát thực tế',         'Lên lịch khảo sát thực tế, làm việc với tòa nhà theo thứ tự ưu tiên và kế hoạch phù hợp.' ),
        array( 'Lựa chọn địa điểm',         'Hỗ trợ lập báo cáo đánh giá ưu nhược điểm từng tòa nhà, bảng so sánh, phân tích tài chính.' ),
        array( 'Tư vấn đàm phán',           'Cung cấp thông tin thị trường, giá thuê giao dịch, phân tích các điều khoản hợp đồng cần đàm phán.' ),
        array( 'Hỗ trợ sau hợp đồng',       'Hỗ trợ miễn phí trong suốt quá trình thuê & vận hành văn phòng nếu có vấn đề phát sinh.' ),
    );
?>
    <section class="cv3-section cv3-section--light">
        <div class="cv3-container">
            <div class="cv3-secthead"><span class="cv3-eyebrow">Lợi ích vượt trội</span><h2>Quy trình khép kín — chuyên nghiệp</h2><p>Quy trình dịch vụ khép kín giúp doanh nghiệp tiết kiệm thời gian, tối ưu hoá chi phí và ký kết được hợp đồng thuê an toàn, có lợi nhất.</p></div>
            <div class="cv3-process">
                <?php foreach ( $steps as $i => $s ) : ?>
                    <div class="cv3-step">
                        <div class="cv3-step__num"><?php echo str_pad( $i + 1, 2, '0', STR_PAD_LEFT ); ?></div>
                        <h3 class="cv3-step__title"><?php echo esc_html( $s[0] ); ?></h3>
                        <p class="cv3-step__desc"><?php echo esc_html( $s[1] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php break;

/* ──────────────────────────── 5. Khách hàng & Dự án ──────────────────────────── */
case 'khach-hang-du-an-tieu-bieu':
    $logo_ids = array(971,966,978,949,1085,1082,1081,955,970,977,958,1080,965,967,944,946,953,960,1084,974,1087,959,952,948,956,972,947,968,951,969,1090,976,1079,973,945);
    $testis = array(
        array( 'Wonderland đồng hành rất cẩn thận, chu đáo, tỉ mỉ — giúp chúng tôi đạt được mức giá và ưu đãi tốt nhất tại Lotte Center Hanoi.', 'http://localhost/oneoffice/wp-content/uploads/2020/12/a-280x280.png', 'Mr. Masaaki Yamane', 'Tổng Giám Đốc — Panasonic R&D Vietnam' ),
        array( 'FPT IS đã ký được hợp đồng thuê văn phòng tổng diện tích khoảng 10.000m² rất tốt đẹp tại Keangnam Landmark 72.', 'http://localhost/oneoffice/wp-content/uploads/2020/12/docaobao-280x278.png', 'Mr. Đỗ Cao Bảo', 'Chủ Tịch — Công ty hệ thống thông tin FPT IS' ),
        array( 'Wonderland luôn là đại lý cung cấp thông tin đầy đủ, chính xác và kịp thời nhất — chính là lý do chúng tôi chọn làm đơn vị tư vấn chính thức.', 'http://localhost/oneoffice/wp-content/uploads/2020/12/vuthituyetminh-280x280.png', 'Ms. Vũ Thị Tuyết Minh', 'Giám Đốc Chi Nhánh — DKSH Hà Nội' ),
        array( 'Wonderland là đại lý có lượng thông tin đầy đủ, rõ ràng và mức giá chào chính xác nhất. Quá trình thuê diễn ra rất thuận lợi.', 'http://localhost/oneoffice/wp-content/uploads/2020/12/nguyenthiminhngoc.png', 'Ms. Nguyễn Thị Minh Ngọc', 'Trưởng phòng Hành Chính — Omron Vietnam' ),
        array( 'Wonderland đã rất chuyên nghiệp, thông thạo, hiệu quả — vượt qua kỳ vọng của tôi. Tôi tìm được tòa nhà ưng ý với vị trí đẹp nhất.', 'http://localhost/oneoffice/wp-content/uploads/2020/12/avc.png', 'Ms. Elodie Berthonneau', 'Giám Đốc Quốc Gia — Qatar Airways' ),
    );
?>
    <section class="cv3-section cv3-section--light">
        <div class="cv3-container">
            <div class="cv3-secthead"><span class="cv3-eyebrow">Khách hàng tiêu biểu</span><h2>Hơn 6.000 doanh nghiệp đã tin tưởng</h2><p>Từ tập đoàn đa quốc gia đến doanh nghiệp Việt — Wonderland tự hào đồng hành cùng sự phát triển của khách hàng.</p></div>
            <ul class="cv3-logos">
                <?php foreach ( $logo_ids as $id ) :
                    $url = wp_get_attachment_image_url( $id, 'medium' );
                    if ( ! $url ) continue; ?>
                    <li><img src="<?php echo esc_url( $url ); ?>" alt="Khách hàng Wonderland" loading="lazy"></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
    <section class="cv3-section cv3-testi">
        <div class="cv3-container">
            <div class="cv3-secthead"><span class="cv3-eyebrow">Phản hồi khách hàng</span><h2>Ý kiến từ những người đã đồng hành</h2></div>
            <div class="cv3-testi__wrapper">
                <button type="button" class="cv3-testi__arrow cv3-testi__arrow--prev" aria-label="Previous testimonial">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>

                <div class="cv3-testi__track">
                    <?php foreach ( $testis as $i => $t ) : ?>
                        <article class="cv3-testi__card<?php echo $i === 0 ? ' is-active' : ''; ?>">
                            <p class="cv3-testi__quote"><?php echo esc_html( $t[0] ); ?></p>
                            <div class="cv3-testi__person">
                                <img src="<?php echo esc_url( $t[1] ); ?>" alt="<?php echo esc_attr( $t[2] ); ?>" loading="lazy">
                                <div>
                                    <strong class="cv3-testi__name"><?php echo esc_html( $t[2] ); ?></strong>
                                    <span class="cv3-testi__role"><?php echo esc_html( $t[3] ); ?></span>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <button type="button" class="cv3-testi__arrow cv3-testi__arrow--next" aria-label="Next testimonial">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </div>
            <div class="cv3-testi__nav">
                <?php foreach ( $testis as $i => $t ) : ?>
                    <button type="button" class="cv3-testi__dot<?php echo $i === 0 ? ' is-active' : ''; ?>" data-go="<?php echo $i; ?>" aria-label="Phản hồi <?php echo $i + 1; ?>"></button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php break;

/* ──────────────────────────── 6. Liên hệ ──────────────────────────── */
case 'lien-he': ?>
    <section class="cv3-section cv3-section--soft">
        <div class="cv3-container">
            <div class="cv3-contact">
                <div class="cv3-contact__info">
                    <h3>Thông tin liên hệ</h3>
                    <p class="cv3-contact__intro">Công ty Cổ phần Tư vấn & Dịch vụ Bất động sản Wonderland Việt Nam — đại lý cho thuê lâu năm, uy tín tại Hà Nội. Đội ngũ chuyên viên am tường thị trường sẵn sàng hỗ trợ <strong>24/7 hoàn toàn miễn phí</strong>.</p>
                    <div class="cv3-info-item">
                        <div class="cv3-info-item__icon"><?php echo oo_cv3_icon('phone'); ?></div>
                        <div>
                            <div class="cv3-info-item__label">Hotline tư vấn 24/7</div>
                            <div class="cv3-info-item__value"><a href="tel:<?php echo $oo_hotline_a; ?>"><?php echo $oo_hotline_d; ?></a></div>
                        </div>
                    </div>
                    <div class="cv3-info-item">
                        <div class="cv3-info-item__icon"><?php echo oo_cv3_icon('mail'); ?></div>
                        <div>
                            <div class="cv3-info-item__label">Email tiếp nhận</div>
                            <div class="cv3-info-item__value"><a href="mailto:<?php echo $oo_email; ?>"><?php echo $oo_email; ?></a></div>
                        </div>
                    </div>
                    <div class="cv3-info-item">
                        <div class="cv3-info-item__icon"><?php echo oo_cv3_icon('pin'); ?></div>
                        <div>
                            <div class="cv3-info-item__label">Địa chỉ văn phòng</div>
                            <div class="cv3-info-item__value"><?php echo $oo_address; ?></div>
                        </div>
                    </div>
                    <div class="cv3-info-item">
                        <div class="cv3-info-item__icon"><?php echo oo_cv3_icon('zalo'); ?></div>
                        <div>
                            <div class="cv3-info-item__label">Chat trực tuyến</div>
                            <div class="cv3-info-item__value"><a href="https://zalo.me/<?php echo $oo_hotline_a; ?>" target="_blank" rel="noopener">Zalo · <?php echo $oo_hotline_d; ?></a></div>
                        </div>
                    </div>
                </div>
                <div class="cv3-contact__form">
                    <h3>Gửi yêu cầu tư vấn</h3>
                    <p class="cv3-contact__intro">Để lại thông tin — chuyên viên Wonderland sẽ gửi báo giá và các diện tích trống phù hợp sau <strong>15 phút</strong>.</p>
                    <?php echo do_shortcode('[contact-form-7 id="286"]'); ?>
                </div>
            </div>
        </div>
    </section>
<?php break;

/* ──────────────────────────── 7. Ký gửi ──────────────────────────── */
case 'ky-gui': ?>
    <section class="cv3-section cv3-section--light">
        <div class="cv3-container">
            <div class="cv3-secthead"><span class="cv3-eyebrow">Lợi ích</span><h2>Khi ký gửi văn phòng tại Wonderland</h2><p>Hợp tác cùng Wonderland giúp tối ưu thời gian tìm kiếm khách thuê, mang lại dòng tiền nhanh nhất.</p></div>
            <div class="cv3-values">
                <div class="cv3-value"><div class="cv3-value__icon"><?php echo oo_cv3_icon('megaphone'); ?></div><h3 class="cv3-value__title">Quảng cáo</h3><p class="cv3-value__desc">Văn phòng của bạn được quảng bá, giới thiệu chuyên nghiệp và cuốn hút nhất.</p></div>
                <div class="cv3-value"><div class="cv3-value__icon"><?php echo oo_cv3_icon('target'); ?></div><h3 class="cv3-value__title">Tiếp cận</h3><p class="cv3-value__desc">Tiếp cận nhanh nhất đến các đối tượng doanh nghiệp có nhu cầu thuê thực tế.</p></div>
                <div class="cv3-value"><div class="cv3-value__icon"><?php echo oo_cv3_icon('consult'); ?></div><h3 class="cv3-value__title">Tư vấn</h3><p class="cv3-value__desc">Được tư vấn chi tiết về giá cả thị trường và các chính sách chào thuê tối ưu nhất.</p></div>
                <div class="cv3-value"><div class="cv3-value__icon"><?php echo oo_cv3_icon('rocket'); ?></div><h3 class="cv3-value__title">Nhanh chóng</h3><p class="cv3-value__desc">Tối đa hóa tỷ lệ lấp đầy, giúp văn phòng được cho thuê nhanh chóng hơn.</p></div>
            </div>
        </div>
    </section>
    <section class="cv3-section cv3-section--soft" id="cv3-kygui-form">
        <div class="cv3-container">
            <div class="cv3-secthead"><span class="cv3-eyebrow">Đăng ký ký gửi</span><h2>Gửi thông tin văn phòng ký gửi</h2><p>Đội ngũ kinh doanh sẽ liên hệ tư vấn trong vòng <strong>24 giờ</strong> sau khi nhận thông tin.</p></div>
            <div class="cv3-kygui-form">
                <?php echo do_shortcode('[contact-form-7 id="465"]'); ?>
            </div>
        </div>
    </section>
<?php break;

endswitch;

/* ──────────────────────────── FINAL CTA  (chung cho mọi trang, trừ liên hệ + ký gửi) ──────────────────────────── */
if ( ! in_array( $oo_slug, array( 'lien-he', 'ky-gui' ), true ) ) : ?>
    <section class="cv3-final">
        <div class="cv3-final__inner">
            <h2>Sẵn sàng tìm văn phòng phù hợp?</h2>
            <p>Để lại số điện thoại hoặc gọi hotline — chuyên viên Wonderland sẽ gửi báo giá &amp; danh sách tòa nhà phù hợp trong vòng 15 phút.</p>
            <div class="cv3-final__actions">
                <a href="tel:<?php echo $oo_hotline_a; ?>" class="cv3-btn cv3-btn--primary cv3-btn--lg"><?php echo oo_cv3_icon('phone'); ?> Hotline: <?php echo $oo_hotline_d; ?></a>
                <a href="<?php echo esc_url( home_url('/lien-he/') ); ?>" class="cv3-btn cv3-btn--ghost cv3-btn--lg">Liên hệ tư vấn</a>
            </div>
        </div>
    </section>
<?php endif; ?>

</div><!-- /.cv3 -->

<?php get_footer();
