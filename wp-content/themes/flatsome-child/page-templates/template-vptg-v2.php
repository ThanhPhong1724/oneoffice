<?php
/**
 * Template Name: VPTG V2 — Văn phòng trọn gói
 *
 * Layout PHP custom — KHÔNG dùng Flatsome shortcode để có full control HTML/CSS.
 * Nội dung lấy từ page 751 (post_content gốc) + biên tập gọn.
 * Không sửa parent theme, không động page 751 (Văn phòng trọn gói cũ).
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 8 khu vực — phục vụ form tìm kiếm
$oo_districts = array(
    array( 'name' => 'Hoàn Kiếm',    'slug' => 'quan-hoan-kiem' ),
    array( 'name' => 'Hai Bà Trưng', 'slug' => 'quan-hai-ba-trung' ),
    array( 'name' => 'Ba Đình',      'slug' => 'quan-ba-dinh' ),
    array( 'name' => 'Đống Đa',      'slug' => 'quan-dong-da' ),
    array( 'name' => 'Cầu Giấy',     'slug' => 'quan-cau-giay' ),
    array( 'name' => 'Nam Từ Liêm',  'slug' => 'quan-nam-tu-liem' ),
    array( 'name' => 'Thanh Xuân',   'slug' => 'quan-thanh-xuan' ),
    array( 'name' => 'Tây Hồ',       'slug' => 'quan-tay-ho' ),
);

// 3 loại văn phòng — dữ liệu rút gọn từ FAQ accordion gốc
$oo_vptg_types = array(
    array(
        'icon' => 'package',
        'title' => 'Văn phòng trọn gói',
        'lead'  => 'Văn phòng riêng — đã trang bị đầy đủ tiện nghi',
        'desc'  => 'Văn phòng làm việc hiện đại, thiết kế chuyên nghiệp, sẵn sàng vận hành. Phù hợp doanh nghiệp cần văn phòng đại diện hoặc giao dịch — có tổng đài, số điện thoại, hộp thư riêng.',
        'features' => array( 'Văn phòng riêng', 'Tổng đài & số điện thoại riêng', 'Phòng họp chung ưu đãi', 'Lễ tân chuyên nghiệp' ),
    ),
    array(
        'icon' => 'virtual',
        'title' => 'Văn phòng ảo',
        'lead'  => 'Địa chỉ giao dịch — không cần thuê mặt bằng',
        'desc'  => 'Sở hữu địa chỉ giao dịch chuyên nghiệp, số điện thoại, fax, dịch vụ lễ tân — không cần thuê diện tích thực tế. Giải pháp tối ưu cho doanh nghiệp vận hành từ xa.',
        'features' => array( 'Địa chỉ kinh doanh hợp pháp', 'Nhận thư & xử lý thông báo thuế', 'Trả lời điện thoại & fax', 'Biển hiệu công ty' ),
    ),
    array(
        'icon' => 'coworking',
        'title' => 'Coworking Space',
        'lead'  => 'Chỗ ngồi làm việc linh hoạt — môi trường mở',
        'desc'  => 'Không gian làm việc chia sẻ với đầy đủ chức năng văn phòng chuyên nghiệp. Lựa chọn linh hoạt theo tháng, môi trường năng động — phù hợp startup và freelancer.',
        'features' => array( 'Thuê theo tháng linh hoạt', 'Internet & điện ổn định 24/7', 'Phòng họp & máy chiếu sẵn sàng', 'Workshop & networking' ),
    ),
);

// 3 lý do chọn Wonderland — từ section dark teal của page 751
$oo_vptg_reasons = array(
    array(
        'stat'  => '50+',
        'label' => 'thương hiệu Co-working',
        'title' => 'Nhiều lựa chọn nhất',
        'desc'  => 'Đối tác chính thức của 50+ thương hiệu Co-working Space trên toàn quốc — luôn có nhiều lựa chọn theo đúng nhu cầu của khách hàng.',
    ),
    array(
        'stat'  => '100+',
        'label' => 'địa điểm',
        'title' => 'Giải pháp tối ưu',
        'desc'  => 'Không chỉ giá thuê — Wonderland giúp khách hàng đàm phán được các thỏa thuận và dịch vụ ưu đãi chưa từng có khi thuê trực tiếp.',
    ),
    array(
        'stat'  => '1.000+',
        'label' => 'doanh nghiệp đã chọn',
        'title' => 'Dịch vụ chuyên nghiệp',
        'desc'  => 'Với hơn 15 năm kinh nghiệm cho thuê văn phòng, Wonderland đã tìm giải pháp thành công cho hơn 1.000 doanh nghiệp trong nước và quốc tế.',
    ),
);

// 6 bước quy trình — copy từ Home V2 (block 771)
$oo_vptg_process = array(
    array( 'step' => '01', 'title' => 'Tiếp nhận yêu cầu',  'desc' => 'Tư vấn nhu cầu thuê văn phòng trọn gói / ảo / coworking, ngân sách, vị trí ưu tiên.' ),
    array( 'step' => '02', 'title' => 'Báo giá & lựa chọn', 'desc' => 'Gửi danh sách địa điểm phù hợp kèm hình ảnh, mức giá, gói dịch vụ — tất cả trong một báo giá.' ),
    array( 'step' => '03', 'title' => 'Khảo sát thực tế',   'desc' => 'Lên lịch tham quan các địa điểm theo thứ tự ưu tiên, làm việc trực tiếp với đại diện đơn vị vận hành.' ),
    array( 'step' => '04', 'title' => 'Đánh giá & so sánh', 'desc' => 'Bảng so sánh chi tiết các phương án — phân tích chi phí, tiện ích, lợi ích lâu dài.' ),
    array( 'step' => '05', 'title' => 'Đàm phán hợp đồng',  'desc' => 'Tư vấn điều khoản, gói dịch vụ kèm — đảm bảo mức ưu đãi tốt nhất.' ),
    array( 'step' => '06', 'title' => 'Hỗ trợ sau hợp đồng','desc' => 'Hỗ trợ vận hành & xử lý vấn đề phát sinh trong suốt thời gian thuê — hoàn toàn miễn phí.' ),
);

// 7 FAQ — giữ nguyên từ page 751
$oo_vptg_faqs = array(
    array(
        'q' => 'Văn phòng trọn gói là gì?',
        'a' => '<p>Văn phòng trọn gói là hình thức cho thuê văn phòng hiện đại được thiết kế và trang bị chuyên nghiệp — công ty bạn sẽ sở hữu một văn phòng làm việc riêng.</p><p>Phù hợp với doanh nghiệp cần thuê văn phòng đại diện hoặc giao dịch. Các văn phòng đã được trang bị đầy đủ tiện nghi với tổng đài riêng, số điện thoại, hộp thư thoại và số fax riêng. Doanh nghiệp có thể sử dụng phòng họp chung với giá ưu đãi.</p>',
    ),
    array(
        'q' => 'Những lợi ích khi thuê văn phòng trọn gói?',
        'a' => '<p>So với văn phòng cho thuê truyền thống, văn phòng trọn gói giúp doanh nghiệp vừa có văn phòng thực để giao dịch, vừa giảm tối đa chi phí ngoài hoạt động cốt lõi:</p><ul><li>Lễ tân tiếp khách được đào tạo chuyên nghiệp</li><li>Không tốn phí đầu tư cho khu vực tiếp khách sang trọng</li><li>Tiết kiệm chi phí trang thiết bị: bàn, ghế, điều hòa, điện thoại, fax, máy in</li><li>Tiết kiệm chi phí mặt bằng, điện, nước, internet</li><li>Không phải đầu tư phòng họp đầy đủ trang thiết bị</li><li>Tiết kiệm chi phí bảo vệ 24/24, tạp vụ riêng</li></ul>',
    ),
    array(
        'q' => 'Văn phòng ảo là gì?',
        'a' => '<p><strong>Văn phòng ảo</strong> (Virtual Office) là loại hình văn phòng chỉ cung cấp dịch vụ địa chỉ và liên lạc — không cần đến diện tích thực tế (<strong>0m²</strong>).</p><p>Dịch vụ cung cấp gồm: địa điểm giao dịch của doanh nghiệp với địa chỉ xác định, số điện thoại, số fax, nhân viên lễ tân, biển hiệu công ty, địa chỉ nhận thư từ và các thông báo thuế, BHXH.</p><p>Khách hàng không cần chuyển đồ đạc — chỉ đặt biển hiệu, logo công ty. Có thể thuê thêm phòng họp theo giờ khi cần.</p>',
    ),
    array(
        'q' => 'Những lợi ích khi thuê văn phòng ảo?',
        'a' => '<p>Văn phòng ảo là giải pháp hoàn hảo cho việc vận hành doanh nghiệp từ xa — giảm chi phí thuê văn phòng truyền thống nhưng vẫn vận hành chuyên nghiệp và hiệu quả.</p><p>Trong thời điểm khủng hoảng kinh tế, văn phòng ảo là giải pháp thông minh cho cá nhân, doanh nghiệp vừa và nhỏ. Ngoài ra còn cung cấp các dịch vụ như phòng họp, chỗ ngồi làm việc, cho thuê nhân viên đại diện — giúp doanh nghiệp tập trung nguồn lực vào công việc kinh doanh quan trọng.</p>',
    ),
    array(
        'q' => 'Coworking Space — Văn phòng chia sẻ là gì?',
        'a' => '<p>Văn phòng chia sẻ (Coworking Space) là dịch vụ cung cấp không gian làm việc có đầy đủ các chức năng của một văn phòng chuyên nghiệp.</p><p>Đây là giải pháp hữu hiệu để cá nhân, tổ chức cùng sở hữu và chia sẻ chi phí văn phòng. Các văn phòng này thường được trang bị đầy đủ trang thiết bị — tạo điều kiện rất tốt cho hệ sinh thái startup phát triển.</p>',
    ),
    array(
        'q' => 'Các dịch vụ và tiện ích tại Coworking Space?',
        'a' => '<ul><li>Địa chỉ giao dịch</li><li>Lễ tân / bảo vệ chuyên nghiệp</li><li>Điện làm việc 24/7, điều hòa, internet đảm bảo</li><li>Nước uống (trà, cà phê, nước lọc)</li><li>Bàn ghế làm việc hiện đại sẵn sàng</li><li>Máy fax, máy photocopy, máy scan dùng chung</li><li>Phòng họp hiện đại: máy chiếu, WIFI</li><li>Hệ thống audio/video, gọi quốc tế trọn gói/tháng</li></ul>',
    ),
    array(
        'q' => 'Những lợi ích khi thuê Coworking Space?',
        'a' => '<ul><li><strong>Tính linh hoạt:</strong> thuê theo tháng (thay vì quý), tùy chọn diện tích và khu vực.</li><li><strong>Cơ sở vật chất sẵn có:</strong> không phải lắp đặt nội thất, mua máy vi tính, máy in — tất cả đã có sẵn.</li><li><strong>Môi trường hợp tác:</strong> mở rộng mạng lưới quan hệ trong không gian năng động.</li><li><strong>Không phí bảo trì:</strong> mọi sửa chữa do chủ văn phòng chịu trách nhiệm.</li><li><strong>Cơ hội học hỏi:</strong> các buổi workshop, hội thảo dành riêng cho thành viên.</li></ul>',
    ),
);

// Stats highlights — từ section info gốc
$oo_vptg_highlights = array(
    array( 'num' => '100+', 'label' => 'địa điểm' ),
    array( 'num' => '50+',  'label' => 'thương hiệu' ),
    array( 'num' => '5',    'label' => 'phân khúc' ),
);

// Hero background — ưu tiên ảnh ID 767 (đúng theme VPTG, có sẵn local)
$oo_vptg_hero_bg = wp_get_attachment_url( 767 );
if ( ! $oo_vptg_hero_bg ) {
    $oo_vptg_hero_bg = home_url( '/wp-content/uploads/2020/11/van-phong-tron-goi-tai-ha-noi.jpg' );
}
$oo_vptg_info_img = $oo_vptg_hero_bg;

get_header(); ?>

<div class="vptg-v2" role="main">

    <?php /* =========================================================
     * 1) HERO
     * ========================================================= */ ?>
    <section class="vp2-hero" aria-label="Văn phòng trọn gói — Wonderland"
             style="background-image: linear-gradient(135deg, rgba(6,52,67,.85) 0%, rgba(21,113,181,.48) 60%, rgba(18,156,148,.56) 100%), url('<?php echo esc_url( $oo_vptg_hero_bg ); ?>');">
        <div class="vp2-container">
            <div class="vp2-hero__inner">
                <span class="vp2-hero__eyebrow">Văn phòng trọn gói · Văn phòng ảo · Coworking</span>
                <h1 class="vp2-hero__title">
                    Tìm văn phòng trọn gói<br>
                    &amp; văn phòng ảo <span class="vp2-accent">phù hợp</span>
                </h1>
                <p class="vp2-hero__sub">
                    Giải pháp cho Startup, doanh nghiệp vừa &amp; nhỏ — tiết kiệm chi phí mặt bằng, sở hữu địa chỉ giao dịch chuyên nghiệp. Đối tác chính thức của 50+ thương hiệu Coworking Space trên toàn quốc.
                </p>
                <div class="vp2-hero__cta">
                    <a href="tel:0966681616" class="vp2-btn vp2-btn--primary">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
                        Tư vấn miễn phí: 0966 68 1616
                    </a>
                    <a href="#vp2-types" class="vp2-btn vp2-btn--ghost">
                        Xem các loại văn phòng
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <ul class="vp2-hero__stats" aria-label="Số liệu nổi bật">
                    <?php foreach ( $oo_vptg_highlights as $h ) : ?>
                    <li>
                        <strong><?php echo esc_html( $h['num'] ); ?></strong>
                        <span><?php echo esc_html( $h['label'] ); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </section>

    <?php /* =========================================================
     * 2) QUICK CONSULT
     * NOTE: backend chưa có form chuyên cho VPTG → chuyển sang /lien-he/
     * ========================================================= */ ?>
    <section class="vp2-quickform" aria-label="Tư vấn nhanh">
        <div class="vp2-container">
            <div class="vp2-quickform__card">
                <div class="vp2-quickform__head">
                    <h2>Tìm văn phòng phù hợp chỉ sau 1 cuộc gọi</h2>
                    <p>Chia sẻ nhu cầu — chuyên viên Wonderland sẽ gửi gợi ý địa điểm &amp; báo giá phù hợp.</p>
                </div>
                <form class="vp2-quickform__form" action="<?php echo esc_url( home_url( '/cho-thue-van-phong-ha-noi/' ) ); ?>" method="get" novalidate>
                    <label class="vp2-field">
                        <span>Khu vực</span>
                        <select name="filter_location">
                            <option value="">Chọn quận</option>
                            <?php foreach ( $oo_districts as $d ) : ?>
                                <option value="<?php echo esc_attr( $d['slug'] ); ?>"><?php echo esc_html( $d['name'] ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label class="vp2-field">
                        <span>Hạng tòa nhà</span>
                        <select name="filter_rank">
                            <option value="">Tất cả</option>
                            <option value="toa-nha-hang-a">Hạng A</option>
                            <option value="toa-nha-hang-b">Hạng B</option>
                            <option value="toa-nha-hang-c">Hạng C</option>
                        </select>
                    </label>
                    <label class="vp2-field">
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
                    
                    <button type="submit" class="vp2-btn vp2-btn--primary vp2-quickform__submit">
                        Tìm kiếm
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                    </button>
                </form>
                <p class="vp2-quickform__note">
                    <!-- [NEEDS CLIENT CONTENT] Form gốc page 751 dùng [contact-form-7 id="601"] + ux_sidebar — cần map backend khi triển khai. Tạm thời chuyển /lien-he/. -->
                    Gọi hotline 24/7 với số điện thoại: <a href="tel:0966681616"><strong>0966 68 1616</strong></a> để nhận tư vấn chuyên sâu ngay hoặc <a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" target="_blank"><strong>vui lòng điền form</strong></a> để team Wonderland liên hệ lại.
                </p>
            </div>
        </div>
    </section>

    <?php /* =========================================================
     * 3) 3 LOẠI VĂN PHÒNG
     * ========================================================= */ ?>
    <section class="vp2-types" id="vp2-types" aria-label="Các loại văn phòng">
        <div class="vp2-container">
            <header class="vp2-secthead vp2-secthead--center">
                <span class="vp2-eyebrow">Giải pháp đa dạng</span>
                <h2>Lựa chọn không gian làm việc phù hợp với&nbsp;bạn</h2>
                <p>Wonderland Vietnam là đối tác của 50+ thương hiệu Coworking trên toàn quốc — bao phủ 5 phân khúc, hơn 100 địa điểm.</p>
            </header>

            <div class="vp2-types__grid">
                <?php foreach ( $oo_vptg_types as $i => $t ) : ?>
                <article class="vp2-types__card vp2-types__card--<?php echo esc_attr( $t['icon'] ); ?>">
                    <div class="vp2-types__icon" aria-hidden="true">
                        <?php if ( $t['icon'] === 'package' ) : ?>
                        <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round" stroke-linecap="round"><path d="M8 20 L32 8 L56 20 L56 50 L32 60 L8 50 Z"/><path d="M8 20 L32 32 L56 20"/><path d="M32 32 L32 60"/></svg>
                        <?php elseif ( $t['icon'] === 'virtual' ) : ?>
                        <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round" stroke-linecap="round"><rect x="10" y="10" width="44" height="44" rx="6"/><path d="M22 28 L22 46"/><path d="M32 22 L32 46"/><path d="M42 32 L42 46"/><circle cx="32" cy="14" r="2" fill="currentColor"/></svg>
                        <?php else : ?>
                        <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round" stroke-linecap="round"><circle cx="20" cy="22" r="6"/><circle cx="44" cy="22" r="6"/><path d="M8 50 C8 42 14 38 20 38 C26 38 32 42 32 50"/><path d="M32 50 C32 42 38 38 44 38 C50 38 56 42 56 50"/></svg>
                        <?php endif; ?>
                    </div>
                    <span class="vp2-types__tag">0<?php echo $i + 1; ?></span>
                    <h3><?php echo esc_html( $t['title'] ); ?></h3>
                    <p class="vp2-types__lead"><?php echo esc_html( $t['lead'] ); ?></p>
                    <p class="vp2-types__desc"><?php echo esc_html( $t['desc'] ); ?></p>
                    <ul class="vp2-types__features">
                        <?php foreach ( $t['features'] as $f ) : ?>
                        <li>
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linejoin="round" stroke-linecap="round" aria-hidden="true"><path d="M5 13l4 4L19 7"/></svg>
                            <?php echo esc_html( $f ); ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="tel:0966681616" class="vp2-types__cta">Nhận tư vấn loại này
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M13 5l7 7-7 7"/></svg>
                    </a>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* =========================================================
     * 4) INTRO BANNER
     * ========================================================= */ ?>
    <section class="vp2-intro" aria-label="Giới thiệu văn phòng trọn gói">
        <div class="vp2-container">
            <div class="vp2-intro__grid">
                <div class="vp2-intro__copy">
                    <span class="vp2-eyebrow">100 địa điểm · 50 thương hiệu · 5 phân khúc</span>
                    <h2>Văn phòng trọn gói tại Hà&nbsp;Nội</h2>
                    <p>Một không gian làm việc chuyên nghiệp &amp; đầy cảm hứng sẽ truyền năng lượng và tăng hiệu suất công việc của bạn.</p>
                    <p>Cùng khám phá những lợi ích, sự tiện lợi bất ngờ mà loại hình văn phòng trọn gói &amp; văn phòng chia sẻ đem lại — đặc biệt phù hợp với Startup hay những cá nhân tìm kiếm cảm hứng mới trong công việc.</p>
                    <div class="vp2-intro__cta">
                        <a href="#vp2-faq" class="vp2-btn vp2-btn--outline">Khám phá chi tiết</a>
                        <a href="tel:0966681616" class="vp2-link">Hoặc gọi 0966 68 1616 →</a>
                    </div>
                </div>
                <div class="vp2-intro__media">
                    <img src="<?php echo esc_url( $oo_vptg_info_img ); ?>" alt="Văn phòng trọn gói tại Hà Nội" loading="lazy">
                    <span class="vp2-intro__badge">
                        <strong>15+</strong>
                        <span>năm kinh nghiệm</span>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <?php /* =========================================================
     * 5) WHY WONDERLAND (3 reasons)
     * ========================================================= */ ?>
    <section class="vp2-reasons" aria-label="Lý do chọn Wonderland Vietnam">
        <div class="vp2-container">
            <header class="vp2-secthead vp2-secthead--center vp2-secthead--light">
                <span class="vp2-eyebrow">Vì sao là Wonderland Vietnam</span>
                <h2>Lý do khách hàng chọn chúng&nbsp;tôi</h2>
            </header>

            <div class="vp2-reasons__grid">
                <?php foreach ( $oo_vptg_reasons as $i => $r ) : ?>
                <article class="vp2-reasons__card">
                    <div class="vp2-reasons__num">0<?php echo $i + 1; ?></div>
                    <div class="vp2-reasons__stat">
                        <strong><?php echo esc_html( $r['stat'] ); ?></strong>
                        <span><?php echo esc_html( $r['label'] ); ?></span>
                    </div>
                    <h3><?php echo esc_html( $r['title'] ); ?></h3>
                    <p><?php echo esc_html( $r['desc'] ); ?></p>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* =========================================================
     * 6) QUY TRÌNH 6 BƯỚC
     * ========================================================= */ ?>
    <section class="vp2-process" aria-label="Quy trình tư vấn">
        <div class="vp2-container">
            <header class="vp2-secthead vp2-secthead--center">
                <span class="vp2-eyebrow">Quy trình 6 bước</span>
                <h2>Quy trình dịch vụ &amp; lợi ích của khách&nbsp;hàng</h2>
                <p>Quy trình chuẩn hoá — đảm bảo khách hàng nhận được giá &amp; điều khoản tốt nhất.</p>
            </header>

            <ol class="vp2-process__list">
                <?php foreach ( $oo_vptg_process as $p ) : ?>
                <li class="vp2-process__item">
                    <span class="vp2-process__num"><?php echo esc_html( $p['step'] ); ?></span>
                    <div class="vp2-process__body">
                        <h3><?php echo esc_html( $p['title'] ); ?></h3>
                        <p><?php echo esc_html( $p['desc'] ); ?></p>
                    </div>
                </li>
                <?php endforeach; ?>
            </ol>
        </div>
    </section>

    <?php /* =========================================================
     * 7) FAQ
     * ========================================================= */ ?>
    <section class="vp2-faq" id="vp2-faq" aria-label="Câu hỏi thường gặp">
        <div class="vp2-container">
            <header class="vp2-secthead vp2-secthead--center">
                <span class="vp2-eyebrow">Câu hỏi thường gặp</span>
                <h2>Mọi thứ bạn cần biết về văn phòng trọn&nbsp;gói</h2>
            </header>

            <div class="vp2-faq__list">
                <?php foreach ( $oo_vptg_faqs as $i => $f ) : ?>
                <details class="vp2-faq__item"<?php echo $i === 0 ? ' open' : ''; ?>>
                    <summary>
                        <span class="vp2-faq__q"><?php echo esc_html( $f['q'] ); ?></span>
                        <span class="vp2-faq__toggle" aria-hidden="true">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linejoin="round" stroke-linecap="round"><path d="M6 9l6 6 6-6"/></svg>
                        </span>
                    </summary>
                    <div class="vp2-faq__a">
                        <?php echo wp_kses_post( $f['a'] ); ?>
                    </div>
                </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php /* =========================================================
     * 8) FINAL CTA
     * ========================================================= */ ?>
    <section class="vp2-final" aria-label="Bắt đầu tìm văn phòng">
        <div class="vp2-container">
            <div class="vp2-final__inner">
                <div class="vp2-final__copy">
                    <span class="vp2-eyebrow">Sẵn sàng bắt đầu</span>
                    <h2>Liên hệ Wonderland để tìm không gian phù hợp với&nbsp;bạn</h2>
                    <p>Tư vấn hoàn toàn miễn phí — gọi điện hoặc nhắn Zalo, đội ngũ chuyên viên sẽ phản hồi trong ít phút.</p>
                </div>
                <div class="vp2-final__actions">
                    <a href="tel:0966681616" class="vp2-btn vp2-btn--primary vp2-btn--lg">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92Z"/></svg>
                        Gọi 0966 68 1616
                    </a>
                    <a href="https://zalo.me/0966681616" class="vp2-btn vp2-btn--zalo vp2-btn--lg" target="_blank" rel="noopener">Chat Zalo</a>
                    <a href="<?php echo esc_url( home_url( '/lien-he/' ) ); ?>" class="vp2-btn vp2-btn--outline-light vp2-btn--lg">Gửi yêu cầu</a>
                </div>
            </div>
        </div>
    </section>

</div><!-- /.vptg-v2 -->

<?php get_footer(); ?>
