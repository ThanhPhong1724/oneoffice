<?php
/**
 * Template Name: Home V2
 *
 * Trang chủ V2 — Cho thuê văn phòng Hà Nội (Wonderland Việt Nam).
 * Layout PHP custom — KHÔNG dùng Flatsome shortcode để có full control HTML/CSS.
 * Data lấy động từ DB (WP_Query products, get_permalink, wp_get_attachment_url).
 *
 * KHÔNG sửa parent theme. Header/Footer dùng lại của Flatsome.
 * KHÔNG động chạm page 233 (homepage cũ).
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/* =========================================================
 * DATA — lấy từ inventory (xem _home_v2_inventory.md)
 * Tất cả nội dung dưới đây đều có nguồn gốc từ DB hiện tại.
 * ========================================================= */

// 8 khu vực — copy từ section "address" page 233
$oo_districts = array(
    array( 'name' => 'Hoàn Kiếm',    'img_id' => 783,  'href' => home_url( '/cho-thue-van-phong-ha-noi/quan-hoan-kiem/' ) ),
    array( 'name' => 'Hai Bà Trưng', 'img_id' => 787,  'href' => home_url( '/cho-thue-van-phong-ha-noi/quan-hai-ba-trung/' ) ),
    array( 'name' => 'Ba Đình',      'img_id' => 789,  'href' => home_url( '/cho-thue-van-phong-ha-noi/quan-ba-dinh/' ) ),
    array( 'name' => 'Đống Đa',      'img_id' => 791,  'href' => home_url( '/cho-thue-van-phong-ha-noi/quan-dong-da/' ) ),
    array( 'name' => 'Cầu Giấy',     'img_id' => 1870, 'href' => home_url( '/cho-thue-van-phong-ha-noi/quan-cau-giay/' ) ),
    array( 'name' => 'Nam Từ Liêm',  'img_id' => 794,  'href' => home_url( '/cho-thue-van-phong-ha-noi/quan-nam-tu-liem/' ) ),
    array( 'name' => 'Thanh Xuân',   'img_id' => 1869, 'href' => home_url( '/cho-thue-van-phong-ha-noi/quan-thanh-xuan/' ) ),
    array( 'name' => 'Tây Hồ',       'img_id' => 798,  'href' => home_url( '/cho-thue-van-phong-ha-noi/quan-tay-ho/' ) ),
);

// 3 lý do — copy từ section "reason" page 233 (text rút gọn, giữ đúng ý)
$oo_reasons = array(
    array(
        'icon_id' => 1095,
        'stat'    => '500+',
        'label'   => 'tòa nhà văn phòng',
        'desc'    => 'Đại lý cho thuê liên tục trên 10 năm tại tất cả các tòa nhà văn phòng hạng A-B-C, cung cấp nhiều lựa chọn nhất cho khách hàng.',
    ),
    array(
        'icon_id' => 1096,
        'stat'    => '6.000+',
        'label'   => 'khách thuê văn phòng',
        'desc'    => 'Đại lý cho thuê hàng đầu nhiều năm liên tục — nhận được hợp tác và ưu đãi tốt nhất từ các tòa nhà cho khách hàng.',
    ),
    array(
        'icon_id' => 1100,
        'stat'    => '10+',
        'label'   => 'năm kinh nghiệm',
        'desc'    => 'Đội ngũ tư vấn giàu kinh nghiệm, kiến thức thị trường sâu rộng — hỗ trợ khách hàng trong suốt quá trình tìm thuê và đàm phán.',
    ),
);

// 6 bước quy trình — copy từ block 771
$oo_process = array(
    array( 'step' => '01', 'title' => 'Tiếp nhận yêu cầu',  'desc' => 'Tiếp nhận yêu cầu thuê, tư vấn sơ bộ về thị trường, nguồn cung, các lưu ý khi thuê văn phòng.' ),
    array( 'step' => '02', 'title' => 'Báo giá, cung cấp thông tin', 'desc' => 'Gửi báo giá đầy đủ thông tin, hình ảnh các tòa nhà phù hợp + hồ sơ năng lực đại lý.' ),
    array( 'step' => '03', 'title' => 'Khảo sát thực tế',   'desc' => 'Lên lịch khảo sát thực tế, làm việc với tòa nhà theo thứ tự ưu tiên và kế hoạch phù hợp.' ),
    array( 'step' => '04', 'title' => 'Lựa chọn địa điểm',  'desc' => 'Hỗ trợ lập báo cáo đánh giá ưu nhược điểm từng tòa nhà, bảng so sánh, phân tích tài chính.' ),
    array( 'step' => '05', 'title' => 'Tư vấn đàm phán',    'desc' => 'Cung cấp thông tin thị trường, giá thuê giao dịch, phân tích các điều khoản hợp đồng cần đàm phán.' ),
    array( 'step' => '06', 'title' => 'Hỗ trợ sau hợp đồng','desc' => 'Hỗ trợ miễn phí trong suốt quá trình thuê & vận hành văn phòng nếu có vấn đề phát sinh.' ),
);

// 5 testimonial — rút gọn từ DB, GIỮ NGUYÊN tên/chức danh/công ty/ảnh
$oo_testimonials = array(
    array(
        'name'  => 'Mr. Masaaki Yamane',
        'title' => 'Tổng Giám Đốc — Panasonic R&D Vietnam',
        'img_id'=> 995,
        'quote' => 'Wonderland Việt Nam đã đồng hành với chúng tôi rất cẩn thận, chu đáo, tỉ mỉ — giúp chúng tôi đạt được mức giá và các ưu đãi tốt nhất tại Lotte Center Hanoi. Tôi rất hài lòng với dịch vụ chuyên nghiệp của Wonderland.',
    ),
    array(
        'name'  => 'Mr. Đỗ Cao Bảo',
        'title' => 'Chủ Tịch — Công ty hệ thống thông tin FPT IS',
        'img_id'=> 998,
        'quote' => 'Tôi thực sự hài lòng với thời gian làm việc cùng Wonderland Việt Nam. FPT IS đã ký được hợp đồng thuê văn phòng với tổng diện tích khoảng 10.000m² rất tốt đẹp tại Keangnam Landmark 72.',
    ),
    array(
        'name'  => 'Ms. Vũ Thị Tuyết Minh',
        'title' => 'Giám Đốc Chi Nhánh — DKSH Hà Nội',
        'img_id'=> 1001,
        'quote' => 'Wonderland luôn là đại lý cung cấp thông tin đầy đủ, chính xác và kịp thời nhất. Các bước làm việc hết sức chuyên nghiệp — chính là lý do chúng tôi lựa chọn Wonderland là đơn vị tư vấn chính thức.',
    ),
    array(
        'name'  => 'Ms. Nguyễn Thị Minh Ngọc',
        'title' => 'Trưởng phòng Hành Chính — Omron Vietnam',
        'img_id'=> 1003,
        'quote' => 'Wonderland là đại lý có lượng thông tin đầy đủ, rõ ràng và mức giá chào chính xác nhất. Quá trình thuê văn phòng của chúng tôi đã diễn ra rất thuận lợi và tốt đẹp.',
    ),
    array(
        'name'  => 'Ms. Elodie Berthonneau',
        'title' => 'Giám Đốc Quốc Gia — Qatar Airways',
        'img_id'=> 1004,
        'quote' => 'Wonderland đã rất chuyên nghiệp, thông thạo và hiệu quả — vượt qua sự mong đợi của tôi. Tôi không chỉ tìm được tòa nhà ưng ý mà còn tìm được vị trí văn phòng đẹp nhất trong tòa nhà.',
    ),
);

// 5 đội ngũ — copy từ block 554
$oo_team = array(
    array( 'img_id' => 1050, 'name' => 'Nguyễn Minh Anh',    'edu' => 'Msc. Financial Management / BSc. Real Estate', 'exp' => '15 năm kinh nghiệm' ),
    array( 'img_id' => 1051, 'name' => 'Đoàn Thị Hằng',      'edu' => 'Cử nhân',           'exp' => '10 năm kinh nghiệm' ),
    array( 'img_id' => 1052, 'name' => 'Nguyễn Kim Anh',     'edu' => 'BSc. Economics',     'exp' => '7 năm kinh nghiệm' ),
    array( 'img_id' => 1053, 'name' => 'Dương Phương Linh',  'edu' => 'Thạc sỹ kinh tế',    'exp' => '4 năm kinh nghiệm' ),
    array( 'img_id' => 1054, 'name' => 'Đoàn Trường Giang',  'edu' => 'Cử nhân',           'exp' => '6 năm kinh nghiệm' ),
);

// 3 CTA cuối — copy từ block 557
$oo_final_cta = array(
    array(
        'img_id'=> 408,
        'title' => 'Tìm hiểu kinh nghiệm thuê văn phòng',
        'desc'  => 'Những chia sẻ từ thực tiễn phục vụ hàng nghìn khách hàng, giúp Bạn nắm rõ được công việc cần làm.',
        'href'  => esc_url( home_url( '/cam-nang/' ) ),
    ),
    array(
        'img_id'=> 412,
        'title' => 'Tìm kiếm các văn phòng phù hợp',
        'desc'  => 'Tìm kiếm nhanh chóng các tòa nhà phù hợp với nhu cầu. Nắm rõ sự phân bố nguồn cung văn phòng tại Hà Nội.',
        'href'  => esc_url( home_url( '/cho-thue-van-phong-ha-noi/' ) ),
    ),
    array(
        'img_id'=> 413,
        'title' => 'Liên hệ Tư vấn & Báo giá',
        'desc'  => 'Gọi tư vấn 0966.68.1616, gửi yêu cầu thuê qua email hoặc chat trực tiếp với chuyên viên tư vấn.',
        'href'  => esc_url( home_url( '/lien-he/' ) ),
    ),
);

// Hero background — ưu tiên ảnh ID 883 (gốc) nếu có, fallback sang ảnh thật khác
$oo_hero_bg_id  = 883;
$oo_hero_bg_url = wp_get_attachment_url( $oo_hero_bg_id );
if ( ! $oo_hero_bg_url || ! file_exists( str_replace( site_url('/'), ABSPATH, $oo_hero_bg_url ) ) ) {
    // Fallback ảnh có sẵn trong uploads
    $oo_hero_bg_url = home_url( '/wp-content/uploads/2020/11/leadvisors-tower-36-pham-van-dong-bac-tu-liem-ha-noi.jpg' );
}

// Tòa nhà nổi bật — lấy động 6 sản phẩm publish
$oo_buildings = get_posts( array(
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC',
    'fields'         => 'ids',
) );

get_header(); ?>

<div class="home-v2" role="main">

    <?php /* =========================================================
     * 1) HERO
     * ========================================================= */ ?>
    <section class="hv2-hero" aria-label="Cho thuê văn phòng Hà Nội"
             style="background-image: linear-gradient(135deg, rgba(6,52,67,.80) 0%, rgba(21,113,181,.42) 60%, rgba(18,156,148,.50) 100%), url('<?php echo esc_url( $oo_hero_bg_url ); ?>');">
        <div class="hv2-container">
            <div class="hv2-hero__inner">
                <span class="hv2-hero__eyebrow">Wonderland Việt Nam · 10+ năm kinh nghiệm</span>
                <h1 class="hv2-hero__title">
                    Cho thuê văn phòng Hà&nbsp;Nội và thi công nội thất<br>
                    tại tất cả các toà nhà <span class="hv2-accent hv2-nowrap">Hạng&nbsp;A‑B‑C</span>
                </h1>
                <p class="hv2-hero__sub">
                    Tư vấn miễn phí — hỗ trợ đàm phán giá &amp; điều khoản tốt nhất.
                    Trên 10 năm kinh nghiệm cho thuê &amp; thi công nội thất văn phòng chuyên nghiệp.
                </p>
                <div class="hv2-hero__cta">
                    <a href="tel:0966681616" class="hv2-btn hv2-btn--primary" aria-label="Tư vấn miễn phí qua hotline">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
                        Tư vấn miễn phí: 0966 68 1616
                    </a>
                    <a href="<?php echo esc_url( home_url( '/cho-thue-van-phong-ha-noi/' ) ); ?>" class="hv2-btn hv2-btn--ghost">
                        Xem tòa nhà văn phòng
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <ul class="hv2-hero__stats" aria-label="Số liệu nổi bật">
                    <?php foreach ( $oo_reasons as $r ) : ?>
                    <li>
                        <strong data-count="<?php echo esc_attr( preg_replace('/[^0-9]/','',$r['stat']) ); ?>"
                                data-suffix="<?php echo strpos( $r['stat'],'+' )!==false ? '+' : ''; ?>">
                            <?php echo esc_html( $r['stat'] ); ?>
                        </strong>
                        <span><?php echo esc_html( $r['label'] ); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <a href="#hv2-quickform" class="hv2-hero__scroll" aria-label="Cuộn xuống">
            <span></span>
        </a>
    </section>

    <?php /* =========================================================
     * 2) QUICK CONSULT FORM
     * NOTE: backend chưa có form chuyên dụng cho homepage — submit
     *       sẽ chuyển khách sang /lien-he/ với query string. Khi
     *       khách cấu hình form, chỉ cần đổi action.
     * ========================================================= */ ?>
    <section class="hv2-quickform" id="hv2-quickform" aria-label="Tư vấn nhanh">
        <div class="hv2-container">
            <div class="hv2-quickform__card">
                <div class="hv2-quickform__head">
                    <h2>Tìm văn phòng phù hợp chỉ trong 30&nbsp;giây</h2>
                    <p>Chia sẻ nhu cầu — chuyên viên tư vấn sẽ gửi báo giá &amp; danh sách tòa nhà phù hợp ngay.</p>
                </div>
                <?php
                if ( function_exists( 'wpcf7_contact_form' ) ) {
                    $home_form = get_page_by_path( 'tu-van-nhanh-trang-chu', OBJECT, 'wpcf7_contact_form' );
                    if ( ! $home_form ) {
                        $home_form = get_page_by_title( 'Tư vấn nhanh - Trang chủ', OBJECT, 'wpcf7_contact_form' );
                    }
                    if ( $home_form ) {
                        add_filter( 'wpcf7_autop_or_not', '__return_false' );
                        echo do_shortcode( '[contact-form-7 id="' . $home_form->ID . '" title="' . esc_attr( $home_form->post_title ) . '"]' );
                        remove_filter( 'wpcf7_autop_or_not', '__return_false' );
                    } else {
                        // Fallback static form
                        ?>
                        <form class="hv2-quickform__form" action="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" method="get" novalidate>
                            <label class="hv2-field">
                                <span>Khu vực</span>
                                <select name="khu_vuc" required>
                                    <option value="">Chọn quận</option>
                                    <?php foreach ( $oo_districts as $d ) : ?>
                                        <option value="<?php echo esc_attr( $d['name'] ); ?>"><?php echo esc_html( $d['name'] ); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </label>
                            <label class="hv2-field">
                                <span>Hạng tòa nhà</span>
                                <select name="hang">
                                    <option value="">Tất cả</option>
                                    <option value="A">Hạng A</option>
                                    <option value="B">Hạng B</option>
                                    <option value="C">Hạng C</option>
                                </select>
                            </label>
                            <label class="hv2-field">
                                <span>Diện tích (m²)</span>
                                <select name="dien_tich">
                                    <option value="">Tất cả</option>
                                    <option value="0-100">Dưới 100</option>
                                    <option value="100-300">100 — 300</option>
                                    <option value="300-500">300 — 500</option>
                                    <option value="500-1000">500 — 1.000</option>
                                    <option value="1000+">Trên 1.000</option>
                                </select>
                            </label>
                            <label class="hv2-field">
                                <span>Số điện thoại</span>
                                <input type="tel" name="phone" placeholder="VD: 0912 345 678" pattern="[0-9 \-\+]{8,15}">
                            </label>
                            <button type="submit" class="hv2-btn hv2-btn--primary hv2-quickform__submit">
                                Nhận tư vấn miễn phí
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                            </button>
                        </form>
                        <?php
                    }
                } else {
                    // Fallback static form
                    ?>
                    <form class="hv2-quickform__form" action="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" method="get" novalidate>
                        <label class="hv2-field">
                            <span>Khu vực</span>
                            <select name="khu_vuc" required>
                                <option value="">Chọn quận</option>
                                <?php foreach ( $oo_districts as $d ) : ?>
                                    <option value="<?php echo esc_attr( $d['name'] ); ?>"><?php echo esc_html( $d['name'] ); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                        <label class="hv2-field">
                            <span>Hạng tòa nhà</span>
                            <select name="hang">
                                <option value="">Tất cả</option>
                                <option value="A">Hạng A</option>
                                <option value="B">Hạng B</option>
                                <option value="C">Hạng C</option>
                            </select>
                        </label>
                        <label class="hv2-field">
                            <span>Diện tích (m²)</span>
                            <select name="dien_tich">
                                <option value="">Tất cả</option>
                                <option value="0-100">Dưới 100</option>
                                <option value="100-300">100 — 300</option>
                                <option value="300-500">300 — 500</option>
                                <option value="500-1000">500 — 1.000</option>
                                <option value="1000+">Trên 1.000</option>
                            </select>
                        </label>
                        <label class="hv2-field">
                            <span>Số điện thoại</span>
                            <input type="tel" name="phone" placeholder="VD: 0912 345 678" pattern="[0-9 \-\+]{8,15}">
                        </label>
                        <button type="submit" class="hv2-btn hv2-btn--primary hv2-quickform__submit">
                            Nhận tư vấn miễn phí
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                        </button>
                    </form>
                    <?php
                }
                ?>
                <p class="hv2-quickform__note">
                    <!-- [NEEDS CLIENT CONTENT] Backend form chuyên dụng cho homepage chưa có — tạm thời chuyển sang /lien-he/. Cần khách cấu hình form xử lý + thông báo Telegram/Email. -->
                    Hoặc gọi trực tiếp <a href="tel:0966681616"><strong>0966 68 1616</strong></a> — phục vụ 8h–18h hàng ngày.
                </p>
            </div>
        </div>
    </section>

    <?php /* =========================================================
     * 3) KHU VỰC CHO THUÊ
     * ========================================================= */ ?>
    <section class="hv2-areas" aria-label="Khu vực cho thuê văn phòng Hà Nội">
        <div class="hv2-container">
            <header class="hv2-secthead hv2-secthead--center">
                <span class="hv2-eyebrow">Bao phủ toàn Hà Nội</span>
                <h2>Tòa nhà văn phòng cho thuê tại Hà&nbsp;Nội</h2>
                <p>Đầy đủ thông tin các tòa nhà tại 8 quận trung tâm và Tây Hà Nội.</p>
            </header>

            <ul class="hv2-areas__grid">
                <?php foreach ( $oo_districts as $d ) :
                    $img = wp_get_attachment_image_url( $d['img_id'], 'large' );
                ?>
                <li class="hv2-areas__item">
                    <a href="<?php echo esc_url( $d['href'] ); ?>" aria-label="Văn phòng cho thuê quận <?php echo esc_attr( $d['name'] ); ?>">
                        <span class="hv2-areas__img" style="background-image:url('<?php echo esc_url( $img ); ?>');"></span>
                        <span class="hv2-areas__name"><?php echo esc_html( $d['name'] ); ?></span>
                        <span class="hv2-areas__cta">Xem tòa nhà
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                        </span>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>

            <div class="hv2-areas__more">
                <a href="<?php echo esc_url( home_url( '/cho-thue-van-phong-ha-noi/' ) ); ?>" class="hv2-link">
                    Xem tất cả tòa nhà tại Hà Nội
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </section>

    <?php /* =========================================================
     * 4) LÝ DO CHỌN WONDERLAND
     * ========================================================= */ ?>
    <section class="hv2-reasons" aria-label="Lý do chọn Wonderland Việt Nam">
        <div class="hv2-container">
            <header class="hv2-secthead hv2-secthead--center">
                <span class="hv2-eyebrow">Vì sao là Wonderland</span>
                <h2>Lý do hơn 6.000 khách thuê lựa chọn Wonderland Việt&nbsp;Nam</h2>
            </header>

            <div class="hv2-reasons__grid">
                <?php foreach ( $oo_reasons as $r ) :
                    $icon = wp_get_attachment_image_url( $r['icon_id'], 'medium' );
                ?>
                <article class="hv2-reasons__card">
                    <div class="hv2-reasons__icon">
                        <?php if ( $icon ) : ?>
                            <img src="<?php echo esc_url( $icon ); ?>" alt="" loading="lazy" width="80" height="80">
                        <?php endif; ?>
                    </div>
                    <div class="hv2-reasons__stat"><?php echo esc_html( $r['stat'] ); ?></div>
                    <h3 class="hv2-reasons__label"><?php echo esc_html( $r['label'] ); ?></h3>
                    <p><?php echo esc_html( $r['desc'] ); ?></p>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* =========================================================
     * 5) QUY TRÌNH DỊCH VỤ
     * ========================================================= */ ?>
    <section class="hv2-process" aria-label="Quy trình dịch vụ Wonderland">
        <div class="hv2-container">
            <header class="hv2-secthead hv2-secthead--center">
                <span class="hv2-eyebrow">Quy trình 6 bước</span>
                <h2>Quy trình dịch vụ &amp; lợi ích của khách&nbsp;hàng</h2>
                <p>Một quy trình đã được chuẩn hoá để đảm bảo bạn nhận được giá và điều khoản tốt nhất.</p>
            </header>

            <ol class="hv2-process__list">
                <?php foreach ( $oo_process as $p ) : ?>
                <li class="hv2-process__item">
                    <span class="hv2-process__num"><?php echo esc_html( $p['step'] ); ?></span>
                    <div class="hv2-process__body">
                        <h3><?php echo esc_html( $p['title'] ); ?></h3>
                        <p><?php echo esc_html( $p['desc'] ); ?></p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ol>

            <div class="hv2-process__cta">
                <a href="tel:0966681616" class="hv2-btn hv2-btn--primary">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
                    Hotline tư vấn &amp; báo giá: 0966 68 1616
                </a>
            </div>
        </div>
    </section>

    <?php /* =========================================================
     * 6) TÒA NHÀ NỔI BẬT (WooCommerce — lấy động)
     * ========================================================= */ ?>
    <?php if ( ! empty( $oo_buildings ) ) : ?>
    <section class="hv2-buildings" aria-label="Tòa nhà nổi bật">
        <div class="hv2-container">
            <header class="hv2-secthead hv2-secthead--center">
                <span class="hv2-eyebrow">Đề xuất từ Wonderland</span>
                <h2>Tòa nhà văn phòng nổi&nbsp;bật</h2>
                <p>Một số tòa nhà có vị trí đẹp, giá thuê và tiện ích nổi trội đang được tư vấn nhiều nhất.</p>
            </header>

            <div class="hv2-buildings__grid">
                <?php foreach ( $oo_buildings as $bid ) :
                    $thumb = get_the_post_thumbnail_url( $bid, 'large' );
                    $title = get_the_title( $bid );
                    $link  = get_permalink( $bid );
                    $vitri = get_post_meta( $bid, '_vi_tri', true );
                    $gia   = get_post_meta( $bid, '_gia_hien_thi', true );
                    if ( ! $gia ) { $gia = get_post_meta( $bid, '_gia_thue', true ); }
                ?>
                <article class="hv2-buildings__card">
                    <a class="hv2-buildings__img" href="<?php echo esc_url( $link ); ?>" aria-label="<?php echo esc_attr( $title ); ?>">
                        <?php if ( $thumb ) : ?>
                            <img src="<?php echo esc_url( $thumb ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
                        <?php else : ?>
                            <span class="hv2-buildings__placeholder">Toà nhà</span>
                        <?php endif; ?>
                        <?php if ( $gia ) : ?>
                            <span class="hv2-buildings__price"><?php echo esc_html( $gia ); ?></span>
                        <?php endif; ?>
                    </a>
                    <div class="hv2-buildings__body">
                        <h3><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $title ); ?></a></h3>
                        <?php if ( $vitri ) : ?>
                        <p class="hv2-buildings__addr">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <?php echo esc_html( $vitri ); ?>
                        </p>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( $link ); ?>" class="hv2-buildings__link">Xem chi tiết
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>

            <div class="hv2-areas__more">
                <a href="<?php echo esc_url( home_url( '/cho-thue-van-phong-ha-noi/' ) ); ?>" class="hv2-btn hv2-btn--outline">
                    Xem tất cả tòa nhà
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <?php /* =========================================================
     * 7) PHẢN HỒI KHÁCH HÀNG
     * ========================================================= */ ?>
    <section class="hv2-testi" aria-label="Phản hồi khách hàng">
        <div class="hv2-container">
            <header class="hv2-secthead hv2-secthead--center">
                <span class="hv2-eyebrow">Khách hàng nói gì</span>
                <h2>Phản hồi của khách&nbsp;hàng</h2>
            </header>

            <div class="hv2-testi__track" role="region" aria-live="polite">
                <?php foreach ( $oo_testimonials as $i => $t ) :
                    $avatar = wp_get_attachment_image_url( $t['img_id'], 'thumbnail' );
                ?>
                <article class="hv2-testi__card<?php echo $i===0 ? ' is-active' : ''; ?>" data-index="<?php echo $i; ?>">
                    <div class="hv2-testi__quote-mark" aria-hidden="true">
                        <svg viewBox="0 0 44 36" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M0 36V20.9c0-5.5 1.1-10 3.4-13.6C5.6 3.7 9.5 1.1 15 0v6.3c-2.6.7-4.5 2.1-5.7 4-1.2 2-1.8 4.5-1.8 7.6h7.7V36H0Zm26.6 0V20.9c0-5.5 1.1-10 3.4-13.6 2.2-3.6 6.1-6.2 11.6-7.3v6.3c-2.6.7-4.5 2.1-5.7 4-1.2 2-1.8 4.5-1.8 7.6H42V36H26.6Z"/></svg>
                    </div>
                    <p class="hv2-testi__quote"><?php echo esc_html( $t['quote'] ); ?></p>
                    <div class="hv2-testi__person">
                        <?php if ( $avatar ) : ?>
                            <img src="<?php echo esc_url( $avatar ); ?>" alt="<?php echo esc_attr( $t['name'] ); ?>" loading="lazy" width="56" height="56">
                        <?php endif; ?>
                        <div>
                            <strong><?php echo esc_html( $t['name'] ); ?></strong>
                            <span><?php echo esc_html( $t['title'] ); ?></span>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>

            <div class="hv2-testi__nav" role="tablist">
                <?php foreach ( $oo_testimonials as $i => $t ) : ?>
                    <button type="button" class="hv2-testi__dot<?php echo $i===0 ? ' is-active' : ''; ?>" data-go="<?php echo $i; ?>" aria-label="Xem phản hồi <?php echo $i+1; ?>"></button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* =========================================================
     * 8) ĐỘI NGŨ
     * ========================================================= */ ?>
    <section class="hv2-team" aria-label="Đội ngũ tư vấn Wonderland">
        <div class="hv2-container">
            <header class="hv2-secthead hv2-secthead--center">
                <span class="hv2-eyebrow">Đội ngũ chuyên gia</span>
                <h2>Đội ngũ tư vấn chuyên nghiệp &amp; giàu kinh&nbsp;nghiệm</h2>
            </header>

            <div class="hv2-team__grid">
                <?php foreach ( $oo_team as $m ) :
                    $img = wp_get_attachment_image_url( $m['img_id'], 'medium' );
                ?>
                <article class="hv2-team__card">
                    <?php if ( $img ) : ?>
                        <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $m['name'] ); ?>" loading="lazy" class="hv2-team__avatar">
                    <?php endif; ?>
                    <h3><?php echo esc_html( $m['name'] ); ?></h3>
                    <p class="hv2-team__edu"><?php echo wp_kses_post( nl2br( $m['edu'] ) ); ?></p>
                    <p class="hv2-team__exp"><?php echo esc_html( $m['exp'] ); ?></p>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* =========================================================
     * 9) KHÁCH HÀNG TIÊU BIỂU (Logo gallery)
     * NOTE: dùng đúng IDs từ section "customer" gallery hiện tại
     * ========================================================= */ ?>
    <section class="hv2-logos" aria-label="Khách hàng tiêu biểu">
        <div class="hv2-container">
            <header class="hv2-secthead hv2-secthead--center">
                <span class="hv2-eyebrow">Khách hàng tiêu biểu</span>
                <h2>Khách hàng tiêu biểu của Wonderland tại Việt&nbsp;Nam</h2>
            </header>

            <?php
            $logo_ids = array(971,966,978,949,1085,1082,1081,955,970,977,958,1080,965,967,944,946,953,960,1084,974,1087,959,952,948,956,972,947,968,951,969,1090,976,1079,973,945);
            ?>
            <ul class="hv2-logos__grid">
                <?php foreach ( $logo_ids as $lid ) :
                    $u = wp_get_attachment_image_url( $lid, 'medium' );
                    if ( ! $u ) continue;
                ?>
                <li><img src="<?php echo esc_url( $u ); ?>" alt="" loading="lazy" width="160" height="80"></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <?php /* =========================================================
     * 10) CTA CUỐI / NEXT STEPS
     * ========================================================= */ ?>
    <section class="hv2-final" aria-label="Bắt đầu tìm thuê văn phòng">
        <div class="hv2-container">
            <header class="hv2-secthead hv2-secthead--center hv2-secthead--light">
                <span class="hv2-eyebrow">Bắt đầu ngay</span>
                <h2>Bắt đầu ngay quá trình tìm thuê văn&nbsp;phòng</h2>
            </header>

            <div class="hv2-final__grid">
                <?php foreach ( $oo_final_cta as $c ) :
                    $img = wp_get_attachment_image_url( $c['img_id'], 'medium_large' );
                ?>
                <a class="hv2-final__card" href="<?php echo esc_url( $c['href'] ); ?>">
                    <div class="hv2-final__img"<?php echo $img ? ' style="background-image:url(\''.esc_url($img).'\');"' : ''; ?>></div>
                    <div class="hv2-final__body">
                        <h3><?php echo esc_html( $c['title'] ); ?></h3>
                        <p><?php echo esc_html( $c['desc'] ); ?></p>
                        <span class="hv2-final__more">Xem thêm
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                        </span>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>

            <div class="hv2-final__contact">
                <a href="tel:0966681616" class="hv2-btn hv2-btn--primary hv2-btn--lg">
                    Gọi tư vấn ngay: 0966 68 1616
                </a>
                <a href="https://zalo.me/0966681616" class="hv2-btn hv2-btn--zalo hv2-btn--lg" target="_blank" rel="noopener">
                    Chat Zalo
                </a>
            </div>
        </div>
    </section>

</div><!-- /.home-v2 -->

<?php get_footer(); ?>
