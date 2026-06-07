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
          if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
              foreach ( $terms as $term ) {
                  $type = get_field('product_category_type', 'product_cat_' . $term->term_id);
                  if ( $type === 'rank' ) {
                      $rank_badge = $term->name;
                      break;
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
          <?php if ( function_exists('ADDTOANY_SHARE_SAVE_KIT') ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
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

<?php echo do_shortcode('[block id="tiet-kiem-95"]'); ?>