<style>
/* Reset ChatGPT pasted HTML layout and container widths */
.product-footer div,
.product-footer section {
    max-width: 100% !important;
    width: 100% !important;
    flex-basis: 100% !important;
    float: none !important;
    padding-left: 0 !important;
    padding-right: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
}

/* Force Flatsome centered tab columns to stretch full-width */
.product-footer .large-10 {
    max-width: 100% !important;
    width: 100% !important;
    flex-basis: 100% !important;
}

/* Hide duplicate contact callout in content */
.product-footer div.z-0.flex,
.product-footer div.justify-start {
    display: none !important;
}
</style>

<div class="row content-row BuildingDetail">
  <div class="col large-12 pb-15">
    <div class="sp2-header-card">
      <div class="sp2-header-card__breadcrumbs">
        <?php
          if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
          }
        ?>
      </div>
      <div class="sp2-header-card__title-row">
        <?php
          // Lấy hạng tòa nhà (như Hạng A, B, C) từ ACF
          $terms = get_the_terms( get_the_ID(), 'product_cat' );
          $rank_badge = '';
          $district_id = null;
          $rank_id = null;
          if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
              foreach ( $terms as $term ) {
                  $type = get_field('product_category_type', 'product_cat_' . $term->term_id);
                  if ( $type === 'rank' ) {
                      $rank_badge = $term->name;
                      $rank_id = $term->term_id;
                  } elseif ( $type === 'district' ) {
                      $district_id = $term->term_id;
                  }
              }
          }
          if ( $rank_badge ) :
        ?>
          <span class="sp2-rank-badge"><?php echo esc_html( $rank_badge ); ?></span>
        <?php endif; ?>
        <h1>
          <?php echo get_the_title( get_the_ID() ); ?>
        </h1>
      </div>
      <div class="sp2-header-card__meta">
        <p class="sp2-header-card__address">
          <i class="fa-solid fa-location-dot" aria-hidden="true"></i> <?php echo esc_html( get_post_meta( get_the_ID(), '_vi_tri', true ) ); ?>
        </p>
        <div class="sp2-header-card__share">
          <?php
            $product_url = get_permalink();
            $encoded_url = urlencode( $product_url );
          ?>
          <span class="share-label">Chia sẻ:</span>
          <div class="oo-share-buttons compact">
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encoded_url; ?>" target="_blank" rel="noopener" class="oo-share-btn compact oo-share-btn--facebook" title="Chia sẻ lên Facebook">
                  <svg viewBox="0 0 24 24" class="oo-share-icon"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
              </a>
              <a href="https://sp.zalo.me/share_ua/new?url=<?php echo $encoded_url; ?>" target="_blank" rel="noopener" class="oo-share-btn compact oo-share-btn--zalo" title="Chia sẻ qua Zalo">
                  <svg viewBox="0 0 27.64 25.07" class="oo-share-icon"><path d="M12.92,12.02c-0.46-0.26-1.03-0.14-1.38,0.26c-0.48,0.55-0.48,1.65-0.02,2.22c0.34,0.42,0.93,0.56,1.38,0.3c0.53-0.3,0.71-0.8,0.72-1.39C13.61,12.84,13.46,12.33,12.92,12.02z M12.92,12.02c-0.46-0.26-1.03-0.14-1.38,0.26c-0.48,0.55-0.48,1.65-0.02,2.22c0.34,0.42,0.93,0.56,1.38,0.3c0.53-0.3,0.71-0.8,0.72-1.39C13.61,12.84,13.46,12.33,12.92,12.02z  M13.81,0C6.19,0,0,5.61,0,12.53c0,3.23,1.37,6.16,3.58,8.39H3.56c0,0,0.03,0.03,0.08,0.06c0.07,0.07,0.13,0.13,0.2,0.19 c0.21,0.26,0.4,0.72,0.02,1.38c-0.5,0.86-1.49,1.67-2.23,2.06c-0.15,0.08-0.13,0.31,0.03,0.34c1.18,0.23,2.56,0.13,3.83-0.24 c1.47-0.43,2.21-0.9,3.74-0.36v-0.01c1.44,0.46,2.98,0.73,4.59,0.73c7.64,0,13.82-5.61,13.82-12.53S21.45,0,13.81,0z M8.55,16.42 c-1.44,0.02-2.88,0.01-4.32,0.01c-0.43,0-0.84-0.08-1.07-0.5c-0.24-0.46-0.08-0.88,0.2-1.27c1.05-1.41,2.11-2.82,3.16-4.23 c0.1-0.13,0.25-0.23,0.26-0.5h-2.3c-0.21,0-0.42,0.02-0.62-0.03C3.43,9.84,3.18,9.57,3.18,9.13c0-0.46,0.25-0.79,0.71-0.79 c1.53-0.03,3.07-0.04,4.6,0c0.66,0.02,0.95,0.62,0.68,1.24C8.99,10,8.71,10.36,8.45,10.72c-0.98,1.3-1.94,2.59-3,4 c1.08,0,2.03-0.01,2.98,0c0.45,0.01,0.88,0.08,0.99,0.63C9.54,16.03,9.24,16.42,8.55,16.42z M15.41,15.37 c0,0.44-0.07,0.84-0.51,1.05c-0.43,0.21-0.81,0.1-1.11-0.27c-0.08-0.1-0.14-0.13-0.28-0.05c-1.8,0.96-3.38,0.35-3.95-1.53 c-0.38-1.23-0.22-2.38,0.58-3.43c0.79-1.03,2.45-1.39,3.51-0.35c0.3-0.36,0.63-0.67,1.16-0.46c0.53,0.23,0.59,0.68,0.59,1.18 C15.41,12.8,15.41,14.09,15.41,15.37z M17.94,15.51c-0.01,0.64-0.33,1.02-0.88,1.01c-0.54,0-0.87-0.38-0.87-1.03 c-0.01-2.28-0.01-4.54,0-6.81c0-0.68,0.31-1.03,0.86-1.04c0.57-0.02,0.88,0.36,0.89,1.05V15.51z M23.04,16.26 c-1,0.55-2.04,0.53-3.03-0.07c-1.45-0.87-1.9-3.09-0.96-4.63c0.85-1.38,2.68-1.83,4.07-0.98c1.05,0.65,1.45,1.65,1.47,2.85 C24.56,14.64,24.14,15.66,23.04,16.26z M22.2,12.07c-0.48-0.33-1.1-0.23-1.48,0.23c-0.48,0.57-0.49,1.63-0.01,2.21 c0.37,0.43,1.03,0.55,1.48,0.23c0.46-0.32,0.61-0.8,0.62-1.34C22.8,12.87,22.66,12.4,22.2,12.07z"/></svg>
              </a>
              <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $encoded_url; ?>" target="_blank" rel="noopener" class="oo-share-btn compact oo-share-btn--linkedin" title="Chia sẻ lên LinkedIn">
                  <svg viewBox="0 0 24 24" class="oo-share-icon"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z"/></svg>
              </a>
              <button class="oo-share-btn compact oo-share-btn--copy" onclick="ooCopyPostLink('<?php echo esc_js($product_url); ?>')" title="Sao chép liên kết">
                  <svg viewBox="0 0 24 24" class="oo-share-icon"><path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/></svg>
                  <span class="oo-copy-text" style="display:none;">Sao chép link</span>
              </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if( !empty($slideImages) ) : ?>
<div id="BuildingGalleryDesktop">
  <div class="row">
    <div class="col large-12">
      <div class="sp2-gallery-wrapper">
        <div class="BuildingGallery">
          <!-- Ảnh chính bên trái -->
          <div class="BuildingGallery-Featured">
            <a href="<?php echo esc_url($slideImages[0]); ?>" class="BuildingGallery-Item" data-fancybox="gallery">
              <img class="BuildingGallery-ItemIMG" src="<?php echo esc_url($slideImages[0]); ?>" alt="Hình ảnh tòa nhà nổi bật" />
            </a>
          </div>

          <!-- Ảnh phụ bên phải (2x2 grid) -->
          <div class="BuildingGallery-Side">
            <?php for($i = 1; $i <= 4 && isset($slideImages[$i]); $i++): ?>
              <a href="<?php echo esc_url($slideImages[$i]); ?>" class="BuildingGallery-Item" data-fancybox="gallery">
                <img class="BuildingGallery-ItemIMG" src="<?php echo esc_url($slideImages[$i]); ?>" alt="Góc nhìn tòa nhà" />
              </a>
            <?php endfor; ?>
          </div>

          <!-- Các ảnh còn lại được ẩn đi để kích hoạt xem ảnh hàng loạt trên Fancybox -->
          <?php for($i = 5; $i < count($slideImages); $i++): ?>
            <a href="<?php echo esc_url($slideImages[$i]); ?>" data-fancybox="gallery" style="display:none;">
              <img src="<?php echo esc_url($slideImages[$i]); ?>" alt="Ảnh thư viện" />
            </a>
          <?php endfor; ?>
        </div>
        <!-- Nút nổi dạng Glassmorphism -->
        <a href="<?php echo esc_url($slideImages[0]); ?>" class="sp2-gallery-more-btn" data-fancybox="gallery">
          <i class="fa-regular fa-image" aria-hidden="true"></i> Xem tất cả hình ảnh (<?php echo count($slideImages); ?>)
        </a>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div id="BuildingGalleryMobile">
    <div class="swiper BuildingGallery">
      <div class="swiper-wrapper">
        <?php foreach ($slideImages as $img) : ?>
          <?php if( !empty($img) ) : ?>
            <div class="swiper-slide">
              <a href="<?php echo esc_url($img); ?>" class="BuildingGallery-Item">
                <img class="BuildingGallery-ItemIMG" src="<?php echo esc_url($img); ?>" alt="Góc nhìn trên di động" />
              </a>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<div class="row sp2-main-row">
  <div class="col large-9 sp2-main-content">
    <div class="row">
      <div class="product-info summary entry-summary col large-12 <?php flatsome_product_summary_classes();?>">
        <?php
          // Hàm render thông số dạng grid 2 cột hiện đại
          function render_building_tab($title, $fields) {
              echo '<div class="sp2-spec-card">';
              echo '  <div class="sp2-spec-card__title"><strong>' . esc_html($title) . '</strong></div>';
              echo '  <div class="sp2-spec-card__grid">';
              
              foreach ($fields as $field) {
                  $value = get_post_meta(get_the_ID(), $field['key'], true);
                  if (empty($value)) {
                      $value = 'Đang cập nhật';
                  }
                  echo '  <div class="sp2-spec-item">';
                  echo '    <div class="sp2-spec-item__icon"><i class="' . esc_attr($field['icon']) . '" aria-hidden="true"></i></div>';
                  echo '    <div class="sp2-spec-item__content">';
                  echo '      <span class="sp2-spec-item__label">' . esc_html($field['label']) . '</span>';
                  echo '      <strong class="sp2-spec-item__value">' . esc_html($value) . '</strong>';
                  echo '    </div>';
                  echo '  </div>';
              }
              
              echo '  </div>';
              echo '</div>';
          }

          // Khối 1: Thông số tòa nhà
          render_building_tab('Thông số toà nhà', [
              ['label' => 'Vị trí', 'key' => '_vi_tri', 'icon' => 'fa-solid fa-location-dot'],
              ['label' => 'Chiều cao tầng', 'key' => '_chieu_cao_tang', 'icon' => 'fa-solid fa-building'],
              ['label' => 'Chiều cao trần', 'key' => '_chieu_cao_tran', 'icon' => 'fa-solid fa-arrows-up-down'],
              ['label' => 'Diện tích sàn', 'key' => '_dien_tich_san', 'icon' => 'fa-solid fa-maximize'],
              ['label' => 'Đỗ xe', 'key' => '_do_xe', 'icon' => 'fa-solid fa-square-parking'],
              ['label' => 'Thang máy', 'key' => '_thang_may', 'icon' => 'fa-solid fa-elevator'],
              ['label' => 'Điều hòa', 'key' => '_dieu_hoa', 'icon' => 'fa-solid fa-wind'],
              ['label' => 'Điện dự phòng', 'key' => '_dien_du_phong', 'icon' => 'fa-solid fa-bolt'],
              ['label' => 'Giờ làm việc', 'key' => '_gio_lam_viec', 'icon' => 'fa-solid fa-clock'],
              ['label' => 'Hướng tòa nhà', 'key' => '_huong_toa_nha', 'icon' => 'fa-solid fa-compass'],
          ]);

          // Khối 2: Chi tiết giá thuê và diện tích
          render_building_tab('Chi tiết giá thuê và diện tích', [
              ['label' => 'Giá thuê gộp (Thuế + Phí)', 'key' => '_gia_thue_gop', 'icon' => 'fa-solid fa-money-bill-wave'],
              ['label' => 'Giá thuê', 'key' => '_gia_thue', 'icon' => 'fa-solid fa-money-bill'],
              ['label' => 'Phí dịch vụ', 'key' => '_phi_dich_vu', 'icon' => 'fa-solid fa-receipt'],
              ['label' => 'Diện tích cho thuê', 'key' => '_dien_tich_cho_thue_tieu_chuan', 'icon' => 'fa-solid fa-vector-square'],
              ['label' => 'Tiền điện điều hòa', 'key' => '_tien_dien_dieu_hoa', 'icon' => 'fa-solid fa-fan'],
              ['label' => 'Đỗ xe máy', 'key' => '_do_xe_may', 'icon' => 'fa-solid fa-motorcycle'],
              ['label' => 'Đỗ ô tô', 'key' => '_do_o_to', 'icon' => 'fa-solid fa-car'],
              ['label' => 'Tiền điện văn phòng', 'key' => '_tien_dien_trong_van_phong', 'icon' => 'fa-solid fa-plug'],
          ]);

          // Khối 3: Bản đồ vị trí
          $address = get_post_meta( get_the_ID(), '_vi_tri', true );
          if ( ! empty( $address ) ) {
              echo '<div class="sp2-spec-card sp2-map-card">';
              echo '  <div class="sp2-spec-card__title"><strong>Bản đồ vị trí</strong></div>';
              echo '  <div class="sp2-map-wrapper" style="position: relative; width: 100%; overflow: hidden; margin-top: 15px; border: 1px solid var(--sp2-border); border-radius: 10px;">';
              echo '    <iframe width="100%" height="100%" frameborder="0" style="border:0; display:block;" src="https://maps.google.com/maps?q=' . urlencode($address . ' Hà Nội') . '&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed" allowfullscreen></iframe>';
              echo '  </div>';
              echo '</div>';
          }
        ?>

        <?php do_action( 'woocommerce_single_product_summary' ); ?>
      </div>

      <!-- Callout block -->
      <div class="col large-12 sp2-contact-callout">
        <div class="sp2-contact-callout__box">
          <i class="fa-solid fa-circle-info" aria-hidden="true"></i>
          <span>
            Liên hệ ngay <a href="<?php echo home_url('/'); ?>" class="sp2-contact-callout__link">Wonderland Việt Nam</a> để nhận tư vấn, thông tin diện tích trống, báo giá cập nhật thường xuyên của tòa nhà <strong><?php echo get_the_title(); ?></strong> và lựa chọn được <a href="<?php echo home_url('/cho-thue-van-phong-ha-noi/'); ?>" class="sp2-contact-callout__link">văn phòng cho thuê</a> phù hợp nhất.
          </span>
        </div>
      </div>

      <div class="col large-12 product-footer">
        <?php 
          add_filter( 'woocommerce_product_tabs', function( $tabs ) {
              if ( isset( $tabs['description'] ) ) {
                  $tabs['description']['title'] = 'THÔNG TIN CHI TIẾT VĂN PHÒNG';
              }
              return $tabs;
          }, 98 );
          do_action( 'woocommerce_after_single_product_summary' ); 
        ?>
      </div>
    </div>
  </div>

  <div class="col large-3 pl-0 sp2-sidebar-col">
    <aside class="sp2-sticky-sidebar">
      <div class="sp2-price-box">
        <span class="sp2-price-box__label">Giá thuê</span>
        <h2 class="sp2-price-box__value">
          <?php echo esc_html( get_post_meta( get_the_ID(), '_gia_hien_thi', true ) ); ?>
        </h2>
      </div>

      <div class="sp2-consult-card">
        <h3>Tư vấn thuê văn phòng</h3>
        <p> Wonderland hỗ trợ tìm kiếm, khảo sát thực tế và thương lượng giá thuê hoàn toàn miễn phí.</p>
        
        <a href="tel:0966681616" class="sp2-sidebar-btn sp2-sidebar-btn--phone">
          <i class="fa-solid fa-phone" aria-hidden="true"></i> Gọi 0966.68.1616
        </a>
        
        <!-- btn-trang và cấu trúc form phía sau là quan trọng cho jQuery click mở popup trong custom.js -->
        <a class="sp2-sidebar-btn sp2-sidebar-btn--form btn-trang">
          <i class="fa-regular fa-envelope" aria-hidden="true"></i> Gửi yêu cầu tư vấn
        </a>

        <!-- Form báo giá: render CF7 form 601 qua shortcode (có hidden fields -> submit gửi mail về yasuaola@gmail.com). Giữ giao diện .csncngbg. -->
        <?php echo do_shortcode('[contact-form-7 id="601" title="Chia sẻ nhu cầu - Nhận ngay báo giá"]'); ?>
      </div>
    </aside>
  </div>
</div>

<?php
$productID = get_the_ID();
// Gợi ý tòa nhà xung quanh (cùng quận)
$nearby_buildings = [];
if ( ! empty( $district_id ) ) {
    $nearby_query = new WP_Query([
        'post_type'      => 'product',
        'posts_per_page' => 4,
        'post__not_in'   => [ $productID ],
        'tax_query'      => [
            [
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $district_id,
            ]
        ]
    ]);
    if ( $nearby_query->have_posts() ) {
        while ( $nearby_query->have_posts() ) {
            $nearby_query->the_post();
            $nearby_buildings[] = [
                'ID'            => get_the_ID(),
                'post_title'    => get_the_title(),
                'permalink'     => get_permalink(),
                '_vi_tri'       => get_post_meta(get_the_ID(), '_vi_tri', true),
                '_gia_hien_thi' => get_post_meta(get_the_ID(), '_gia_hien_thi', true),
                'thumbnail'     => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: '',
            ];
        }
        wp_reset_postdata();
    }
}

// Gợi ý tòa nhà đồng hạng (cùng hạng hoặc cùng phân khúc giá)
$same_rank_buildings = [];
$same_rank_title = 'Tòa nhà văn phòng cùng hạng';

if ( ! empty( $rank_id ) ) {
    $same_rank_query = new WP_Query([
        'post_type'      => 'product',
        'posts_per_page' => 4,
        'post__not_in'   => [ $productID ],
        'tax_query'      => [
            [
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $rank_id,
            ]
        ]
    ]);
    if ( $same_rank_query->have_posts() ) {
        while ( $same_rank_query->have_posts() ) {
            $same_rank_query->the_post();
            $same_rank_buildings[] = [
                'ID'            => get_the_ID(),
                'post_title'    => get_the_title(),
                'permalink'     => get_permalink(),
                '_vi_tri'       => get_post_meta(get_the_ID(), '_vi_tri', true),
                '_gia_hien_thi' => get_post_meta(get_the_ID(), '_gia_hien_thi', true),
                'thumbnail'     => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: '',
            ];
        }
        wp_reset_postdata();
    }
}

if ( empty( $same_rank_buildings ) ) {
    // Fallback: gợi ý cùng phân khúc giá
    $price_str = get_post_meta( $productID, '_gia_hien_thi', true );
    preg_match('/([0-9.]+)/', $price_str, $matches);
    $current_price = !empty($matches[1]) ? floatval($matches[1]) : 0;
    if ( $current_price > 0 ) {
        $same_rank_title = 'Tòa nhà cùng phân khúc giá';
        $min_price = max(0, $current_price - 5);
        $max_price = $current_price + 5;
        $same_price_query = new WP_Query([
            'post_type'      => 'product',
            'posts_per_page' => 4,
            'post__not_in'   => [ $productID ],
            'meta_query'     => [
                [
                    'key'     => '_gia_hien_thi',
                    'value'   => [$min_price, $max_price],
                    'compare' => 'BETWEEN',
                    'type'    => 'NUMERIC',
                ]
            ]
        ]);
        if ( $same_price_query->have_posts() ) {
            while ( $same_price_query->have_posts() ) {
                $same_price_query->the_post();
                $same_rank_buildings[] = [
                    'ID'            => get_the_ID(),
                    'post_title'    => get_the_title(),
                    'permalink'     => get_permalink(),
                    '_vi_tri'       => get_post_meta(get_the_ID(), '_vi_tri', true),
                    '_gia_hien_thi' => get_post_meta(get_the_ID(), '_gia_hien_thi', true),
                    'thumbnail'     => get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: '',
                ];
            }
            wp_reset_postdata();
        }
    }
}
?>

<?php if ( ! empty( $nearby_buildings ) ) : ?>
<section class="sp2-related-section">
  <div class="row">
    <div class="col large-12 pb-0">
      <h2 class="sp2-related-title">Tòa nhà văn phòng xung quanh</h2>
      <div class="row list-building" style="margin-top:20px;">
        <?php foreach ( $nearby_buildings as $b ) : ?>
          <div class="col large-3 small-12 pb-0">
            <div class="building-item">
              <div class="thumb">
                <a href="<?php echo esc_url( $b['permalink'] ); ?>" title="<?php echo esc_attr( $b['post_title'] ); ?>">
                  <img src="<?php echo esc_url( $b['thumbnail'] ); ?>" class="img-responsive thumb-blog" alt="<?php echo esc_attr( $b['post_title'] ); ?>">
                </a>
              </div>
              <div class="content BuildingItemContent">
                <h3>
                  <a class="BuildingItemName" href="<?php echo esc_url( $b['permalink'] ); ?>" title="<?php echo esc_attr( $b['post_title'] ); ?>">
                    <?php echo esc_html( $b['post_title'] ); ?>
                  </a>
                </h3>
                <span class="BuildingItemLocation"><?php echo esc_html( $b['_vi_tri'] ); ?></span>
                <div class="meta">
                  <span class="price"><?php echo $b['_gia_hien_thi']; ?></span>
                  <span class="btn-care quan_tam js-btn-care BuildingItemCare" type="button" data-id="<?php echo $b['ID']; ?>">
                    <span>
                      <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                      <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    </span>
                    Quan tâm
                  </span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if ( ! empty( $same_rank_buildings ) ) : ?>
<section class="sp2-related-section">
  <div class="row">
    <div class="col large-12 pb-0">
      <h2 class="sp2-related-title"><?php echo esc_html( $same_rank_title ); ?></h2>
      <div class="row list-building" style="margin-top:20px;">
        <?php foreach ( $same_rank_buildings as $b ) : ?>
          <div class="col large-3 small-12 pb-0">
            <div class="building-item">
              <div class="thumb">
                <a href="<?php echo esc_url( $b['permalink'] ); ?>" title="<?php echo esc_attr( $b['post_title'] ); ?>">
                  <img src="<?php echo esc_url( $b['thumbnail'] ); ?>" class="img-responsive thumb-blog" alt="<?php echo esc_attr( $b['post_title'] ); ?>">
                </a>
              </div>
              <div class="content BuildingItemContent">
                <h3>
                  <a class="BuildingItemName" href="<?php echo esc_url( $b['permalink'] ); ?>" title="<?php echo esc_attr( $b['post_title'] ); ?>">
                    <?php echo esc_html( $b['post_title'] ); ?>
                  </a>
                </h3>
                <span class="BuildingItemLocation"><?php echo esc_html( $b['_vi_tri'] ); ?></span>
                <div class="meta">
                  <span class="price"><?php echo $b['_gia_hien_thi']; ?></span>
                  <span class="btn-care quan_tam js-btn-care BuildingItemCare" type="button" data-id="<?php echo $b['ID']; ?>">
                    <span>
                      <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                      <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                    </span>
                    Quan tâm
                  </span>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php echo do_shortcode('[block id="tiet-kiem-95"]'); ?>