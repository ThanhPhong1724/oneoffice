
<div class="row category-page-row border-top">
  <div class="col large-12">

    <!-- Form search -->
    <form id="custom-search-form" role="search" method="get" class="wl-search-form" action="#">
      <div class="row">
        <!-- Ô tìm kiếm -->
        <div class="col large-4 small-12">
          <div class="search-input-wrapper">
            <div class="input-with-icon">
              <span class="search-icon">
                <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M24.0002 24.5002L17.6562 18.1562" stroke="#222531" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="square"></path>
                  <path d="M12 20.5C16.4183 20.5 20 16.9183 20 12.5C20 8.08172 16.4183 4.5 12 4.5C7.58172 4.5 4 8.08172 4 12.5C4 16.9183 7.58172 20.5 12 20.5Z" stroke="#222531" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="square"></path>
                </svg>
              </span>
              <input type="search" id="search-field" class="form-control" name="s" placeholder="Tìm theo tên tòa nhà, tên đường..." value="<?php echo esc_attr($formData['searchTerm']); ?>">
            </div>
            <input type="hidden" name="post_type" value="product">
          </div>
        </div>

        <!-- Dropdown Khu vực -->
        <div class="col large-2 small-12">
          <div class="custom-dropdown-wrapper">
            <div class="dropdown-label">Khu vực</div>
            <div class="custom-dropdown" id="quan-dropdown">
              <div class="dropdown-display" id="quan-display">
                <span class="selected-count">(<?php echo count($formData['selectedDistricts']); ?>) đã chọn</span>
                <i class="fa fa-chevron-down dropdown-arrow"></i>
              </div>
              <div class="dropdown-menu" id="quan-menu" style="display:none;">
                <div class="selected-items" id="selected-quan-items"></div>

                <!-- Ô tìm kiếm -->
                <div class="dropdown-search">
                  <input type="text" id="quan-search" placeholder="Tìm quận hoặc phường...">
                </div>

                <div class="dropdown-options">
                  <?php foreach ($formData['districts'] as $district): ?>
                    <?php $isChecked = in_array($district['slug'], $formData['selectedDistricts'], true); ?>
                    <div class="dropdown-option district" data-value="<?php echo esc_attr($district['slug']); ?>">
                      <input type="checkbox" id="quan_<?php echo esc_attr($district['slug']); ?>" value="<?php echo esc_attr($district['slug']); ?>" <?php checked($isChecked); ?>>
                      <label for="quan_<?php echo esc_attr($district['slug']); ?>"><?php echo esc_html($district['name']); ?></label>
                    </div>

                    <?php if (!empty($district['wards'])): ?>
                      <?php foreach ($district['wards'] as $ward): ?>
                        <?php $isWardChecked = in_array($ward['slug'], $formData['selectedDistricts'], true); ?>
                        <div class="dropdown-option ward" data-parent="<?php echo esc_attr($district['slug']); ?>" data-value="<?php echo esc_attr($ward['slug']); ?>">
                          <input type="checkbox" id="ward_<?php echo esc_attr($ward['slug']); ?>" value="<?php echo esc_attr($ward['slug']); ?>" <?php checked($isWardChecked); ?>>
                          <label for="ward_<?php echo esc_attr($ward['slug']); ?>"><?php echo esc_html($ward['name']); ?></label>
                        </div>
                      <?php endforeach; ?>
                    <?php endif; ?>

                  <?php endforeach; ?>
                </div>

                <input type="hidden" id="current-quan-input" name="filter_location" value="<?php echo esc_attr(implode(',', $formData['selectedDistricts'])); ?>">
              </div>
            </div>
          </div>
        </div>

        <!-- Dropdown Giá -->
        <div class="col large-2 small-12">
          <div class="price-dropdown-wrapper">
            <div class="dropdown-label">Giá</div>
            <div class="custom-dropdown" id="price-dropdown">
              <div class="dropdown-display" id="price-display">
                <span class="price-range-text">$<?php echo $formData['minPrice']; ?> - $<?php echo $formData['maxPrice']; ?></span>
                <i class="fa fa-chevron-down dropdown-arrow"></i>
              </div>
              <div class="dropdown-menu price-dropdown-menu" id="price-menu">
                <div class="price-controls">

                  <!-- Thanh slider 2 đầu -->
                  <div class="range-slider">
                    <input type="range" id="range-min" min="0" max="100" value="<?php echo $formData['minPrice']; ?>" step="1">
                    <input type="range" id="range-max" min="0" max="100" value="<?php echo $formData['maxPrice']; ?>" step="1">
                    <div class="slider-track"></div>
                  </div>

                  <!-- Nhập số thủ công -->
                  <div class="price-inputs-row">
                    <div class="price-input-group">
                      <label>Từ</label>
                      <input type="number" id="price-min-input" class="price-input" min="0" max="100" value="<?php echo $formData['minPrice']; ?>">
                    </div>
                    <div class="price-input-group">
                      <label>Đến</label>
                      <input type="number" id="price-max-input" class="price-input" min="0" max="100" value="<?php echo $formData['maxPrice']; ?>">
                    </div>
                  </div>

                  <div class="price-buttons">
                    <button type="button" class="btn-price-reset">Đặt lại</button>
                    <button type="button" class="btn-price-apply">Áp dụng</button>
                  </div>
                </div>

                <!-- Hidden inputs để submit form -->
                <input type="hidden" id="min_price" name="min_price" value="<?php echo $formData['minPrice']; ?>">
                <input type="hidden" id="max_price" name="max_price" value="<?php echo $formData['maxPrice']; ?>">
              </div>
            </div>
          </div>
        </div>

        <!-- Dropdown Hạng -->
        <div class="col large-2 small-12">
          <div class="custom-dropdown-wrapper">
            <div class="dropdown-label">Hạng</div>

            <div class="custom-dropdown" id="hang-dropdown">
              
              <div class="dropdown-display" id="hang-display">
                <span class="selected-hang">
                  (<?php echo count($formData['selectedRanks']); ?>) đã chọn
                </span>
                <i class="fa fa-chevron-down dropdown-arrow"></i>
              </div>

              <div class="dropdown-menu" id="hang-menu" style="display:none;">

                <div class="selected-items" id="selected-hang-items"></div>

                <div class="dropdown-options">
                  <?php foreach ($formData['ranks'] as $rank): ?>
                    <?php $isChecked = in_array($rank['slug'], $formData['selectedRanks'], true); ?>

                    <div class="dropdown-option" data-value="<?php echo esc_attr($rank['slug']); ?>">

                      <input type="checkbox"
                        id="hang_<?php echo esc_attr($rank['slug']); ?>"
                        value="<?php echo esc_attr($rank['slug']); ?>"
                        <?php checked($isChecked); ?>>

                      <label for="hang_<?php echo esc_attr($rank['slug']); ?>">
                        <?php echo esc_html($rank['name']); ?>
                      </label>

                    </div>
                  <?php endforeach; ?>
                </div>

                <input type="hidden"
                  id="current-hang-input"
                  name="filter_rank"
                  value="<?php echo esc_attr(implode(',', $formData['selectedRanks'])); ?>">

              </div> <!-- /dropdown-menu -->
            </div> <!-- /custom-dropdown -->

          </div>
        </div>


        <!-- Nút tìm kiếm -->
        <div class="col large-2 small-12">
          <div class="search-button-wrapper">
            <button type="submit" class="btn btn-search">Tìm kiếm</button>
          </div>
        </div>
      </div>
    </form>
    <!-- End Form search -->

    <!-- Breadcrum -->
    <?php
      if ( function_exists('yoast_breadcrumb') ) {
        yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
      }
    ?>
    <!-- End Breadcrum -->

    <!-- SectionBuilding -->
    <div class="shop-container">
      <section class="SectionBuilding">

        <!-- Header giới thiệu -->
        <div class="SectionBuildingHeader">
          <h1 class="SectionBuildingTitle">Cho thuê văn phòng Hà Nội</h1>
          <p>Nhận được ngay báo giá, thông tin chi tiết của hàng ngàn toà nhà văn phòng lớn nhỏ. Với dịch vụ tư vấn của Wonderland, bạn sẽ không lo bỏ lỡ những văn phòng đẹp, phù hợp nhất với mức giá tốt nhất. Ngoài ra, thông tin tư vấn chuyên sâu của chúng tôi sẽ mang lại cho bạn cái nhìn toàn cảnh, chi tiết, công bằng mà không dễ có được sau một vài lần ghé thăm toà nhà hoặc được chia sẻ từ phía bên cho thuê.</p>
        </div>

        <!-- Danh sách districts dưới dạng tag -->
        <div class="row">
          <div class="col SectionBuildingTagList">
              <?php foreach ($tagData as $district): ?>
                  <a class="SectionBuildingTag" href="<?= htmlspecialchars($district['link']) ?>">
                      <?= htmlspecialchars($district['name']) ?>
                  </a>
              <?php endforeach; ?>
          </div>
        </div>

        <!-- Lặp từng district, hiển thị sản phẩm nếu có -->
        <?php foreach ($districtData as $district): ?>
          <?php if (!empty($district['products'])): ?>
            <div class="BuildingQuanHeader">
              <h4 class="BuildingQuanTitle">
                Cho thuê văn phòng quận <?= esc_html($district['name']); ?>
              </h4>
              <a class="BuildingQuanLink" href="<?= esc_url($district['link']); ?>">Xem thêm</a>
            </div>

            <div class="row list-building">
              <?php /* Chỉ hiện tối đa 4 toà mỗi quận cho gọn — bấm "Xem thêm" để xem hết */ ?>
              <?php foreach (array_slice($district['products'], 0, 4) as $product): ?>
                <div class="col large-3 small-12 pb-0">
                  <div class="building-item">

                    <!-- Hình ảnh sản phẩm -->
                    <div class="thumb">
                      <a href="<?= esc_url($product['link']); ?>" title="<?= esc_attr($product['name']); ?>">
                        <img 
                          src="<?= esc_url($product['thumbnail']); ?>" 
                          alt="<?= esc_attr($product['name']); ?>" 
                          class="img-responsive thumb-blog"
                        />
                      </a>
                    </div>

                    <div class="content BuildingItemContent">
                        <h3>
                            <a class="BuildingItemName" href="<?= esc_url($product['link']); ?>" title="<?= esc_attr($product['name']); ?>">
                                <?= esc_html($product['name']); ?>
                            </a>
                        </h3>
                        <span class="BuildingItemLocation"><?php echo $product['_vi_tri']; ?></span>
                        <div class="meta">
                            <span class="price"><?php echo $product['_gia_hien_thi']; ?></span>
                            <span class="btn-care quan_tam js-btn-care BuildingItemCare" type="button" data-id="<?php echo $product['id']; ?>">
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
          <?php endif; ?>
        <?php endforeach; ?>
      </section>
    </div>

    <!-- End SectionBuilding -->

    <!-- ============================================================
         WL SECTIONS ADDITIONS (Phân hạng, Gợi ý, FAQ, Thị trường)
         ============================================================ -->

    <!-- Section 1: Phân hạng tòa nhà văn phòng cho thuê tại Hà Nội -->
    <section class="wl-listing-section wl-ranking-section">
      <div class="wl-section-header text-center">
        <h2 class="wl-section-title">Phân hạng các tòa nhà văn phòng cho thuê tại Hà Nội</h2>
        <p class="wl-section-subtitle">Các tòa nhà văn phòng cho thuê tại Hà Nội được phân loại thành hạng A, B và C dựa trên các tiêu chí như vị trí trung tâm, chất lượng xây dựng, trang thiết bị kỹ thuật, dịch vụ vận hành và mức giá thuê. Mỗi phân hạng đáp ứng các nhu cầu và ngân sách khác nhau của doanh nghiệp.</p>
      </div>
      <div class="row wl-ranking-row">
        <div class="col large-4 medium-4 small-12">
          <div class="wl-ranking-card card-grade-a">
            <a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/?filter_rank=toa-nha-hang-a') ); ?>" class="wl-ranking-card-link">
              <div class="wl-ranking-icon">
                <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.5">
                  <path d="M20 60V8a2 2 0 0 1 2-2h20a2 2 0 0 1 2 2v52" stroke-linecap="round"/>
                  <path d="M10 60V24a2 2 0 0 1 2-2h8v38m32 0V34a2 2 0 0 0-2-2h-8v28M4 60h56" stroke-linecap="round"/>
                  <line x1="28" y1="14" x2="36" y2="14" stroke-linecap="round"/>
                  <line x1="28" y1="22" x2="36" y2="22" stroke-linecap="round"/>
                  <line x1="28" y1="30" x2="36" y2="30" stroke-linecap="round"/>
                  <line x1="28" y1="38" x2="36" y2="38" stroke-linecap="round"/>
                  <line x1="28" y1="46" x2="36" y2="46" stroke-linecap="round"/>
                </svg>
              </div>
              <h3 class="wl-ranking-card-title">Tòa nhà hạng A tại Hà Nội</h3>
              <p class="wl-ranking-card-desc">Vị trí đắc địa tại trung tâm Hoàn Kiếm, Ba Đình. Trang thiết bị tối tân, quản lý chuyên nghiệp chuẩn quốc tế dành cho tập đoàn lớn.</p>
            </a>
          </div>
        </div>
        <div class="col large-4 medium-4 small-12">
          <div class="wl-ranking-card card-grade-b">
            <a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/?filter_rank=toa-nha-hang-b') ); ?>" class="wl-ranking-card-link">
              <div class="wl-ranking-icon">
                <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.5">
                  <path d="M14 60V16a2 2 0 0 1 2-2h32a2 2 0 0 1 2 2v44" stroke-linecap="round"/>
                  <path d="M6 60V32a2 2 0 0 1 2-2h6v28m36 0V38a2 2 0 0 0-2-2h-6v24M2 60h60" stroke-linecap="round"/>
                  <rect x="22" y="22" width="6" height="6" rx="1"/>
                  <rect x="36" y="22" width="6" height="6" rx="1"/>
                  <rect x="22" y="34" width="6" height="6" rx="1"/>
                  <rect x="36" y="34" width="6" height="6" rx="1"/>
                  <rect x="22" y="46" width="6" height="6" rx="1"/>
                  <rect x="36" y="46" width="6" height="6" rx="1"/>
                </svg>
              </div>
              <h3 class="wl-ranking-card-title">Tòa nhà hạng B tại Hà Nội</h3>
              <p class="wl-ranking-card-desc">Sự cân bằng hoàn hảo giữa chi phí và chất lượng. Tòa nhà hiện đại, tập trung nhiều ở Cầu Giấy, Đống Đa, Thanh Xuân.</p>
            </a>
          </div>
        </div>
        <div class="col large-4 medium-4 small-12">
          <div class="wl-ranking-card card-grade-c">
            <a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/?filter_rank=toa-nha-hang-c') ); ?>" class="wl-ranking-card-link">
              <div class="wl-ranking-icon">
                <svg viewBox="0 0 64 64" fill="none" stroke="currentColor" stroke-width="1.5">
                  <rect x="16" y="20" width="32" height="40" rx="2" stroke-linecap="round"/>
                  <path d="M8 60h48" stroke-linecap="round"/>
                  <line x1="24" y1="28" x2="28" y2="28" stroke-linecap="round"/>
                  <line x1="36" y1="28" x2="40" y2="28" stroke-linecap="round"/>
                  <line x1="24" y1="38" x2="28" y2="38" stroke-linecap="round"/>
                  <line x1="36" y1="38" x2="40" y2="38" stroke-linecap="round"/>
                  <line x1="24" y1="48" x2="28" y2="48" stroke-linecap="round"/>
                  <line x1="36" y1="48" x2="40" y2="48" stroke-linecap="round"/>
                </svg>
              </div>
              <h3 class="wl-ranking-card-title">Tòa nhà hạng C tại Hà Nội</h3>
              <p class="wl-ranking-card-desc">Lựa chọn tối ưu ngân sách cho doanh nghiệp vừa và nhỏ, startup. Diện tích thuê linh hoạt, phân bổ khắp các quận.</p>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 2: Gợi ý các tòa nhà văn phòng Hà Nội nổi bật -->
    <section class="wl-listing-section wl-suggestions-section">
      <div class="wl-section-header text-center">
        <h2 class="wl-section-title">Gợi ý các tòa nhà văn phòng Hà Nội nổi bật</h2>
        <p class="wl-section-subtitle">Danh sách chọn lọc các tòa nhà văn phòng theo khu vực, phân hạng và xu hướng tìm kiếm phổ biến nhất tại thủ đô.</p>
      </div>
      <div class="row wl-suggestions-row">
        <div class="col large-4 medium-4 small-12">
          <div class="wl-suggestion-card">
            <a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/') ); ?>" class="wl-suggestion-link">
              <div class="wl-suggestion-img" style="background-image: url('<?php echo esc_url( home_url('/wp-content/uploads/2026/06/Keangnam-Nam%20Tu%20Liem.jpg') ); ?>');"></div>
              <div class="wl-suggestion-content">
                <h3 class="wl-suggestion-title">Khu vực tập trung nhiều văn phòng nhất</h3>
                <p class="wl-suggestion-desc">Cầu Giấy, Nam Từ Liêm và Đống Đa là các "trung tâm" văn phòng mới của Hà Nội với nguồn cung dồi dào, thiết kế hiện đại và giá thuê cạnh tranh.</p>
              </div>
            </a>
          </div>
        </div>
        <div class="col large-4 medium-4 small-12">
          <div class="wl-suggestion-card">
            <a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/') ); ?>" class="wl-suggestion-link">
              <div class="wl-suggestion-img" style="background-image: url('<?php echo esc_url( home_url('/wp-content/uploads/2026/06/Lotte-Ba%20Dinh.jpg') ); ?>');"></div>
              <div class="wl-suggestion-content">
                <h3 class="wl-suggestion-title">Top 20+ tòa nhà văn phòng Hà Nội tốt nhất</h3>
                <p class="wl-suggestion-desc">Tổng hợp những tòa nhà văn phòng nổi bật nhất về dịch vụ vận hành, thiết kế kiến trúc độc đáo, đạt tỷ lệ lấp đầy cao nhất năm nay.</p>
              </div>
            </a>
          </div>
        </div>
        <div class="col large-4 medium-4 small-12">
          <div class="wl-suggestion-card">
            <a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/') ); ?>" class="wl-suggestion-link">
              <div class="wl-suggestion-img" style="background-image: url('<?php echo esc_url( home_url('/wp-content/uploads/2026/06/CSB-Hoan%20Kiem.jpg') ); ?>');"></div>
              <div class="wl-suggestion-content">
                <h3 class="wl-suggestion-title">Top tòa nhà Hạng A ở quận trung tâm</h3>
                <p class="wl-suggestion-desc">Khám phá các cao ốc văn phòng hạng sang đạt tiêu chuẩn LEED quốc tế tại Hoàn Kiếm, Ba Đình, khẳng định vị thế và thương hiệu của doanh nghiệp.</p>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="text-center wl-suggestions-more">
        <a href="<?php echo esc_url( home_url('/tu-van/kinh-nghiem/') ); ?>" class="wl-btn-more">Xem tất cả bài viết</a>
      </div>
    </section>

    <!-- Section 3: Câu hỏi thường gặp khi thuê văn phòng tại Hà Nội (FAQ) -->
    <section class="wl-listing-section wl-faq-section">
      <div class="wl-section-header text-center">
        <h2 class="wl-section-title">Câu hỏi thường gặp khi thuê văn phòng tại Hà Nội</h2>
        <p class="wl-section-subtitle">Giải đáp các thắc mắc phổ biến nhất của doanh nghiệp về quy trình, chi phí và thủ tục thuê văn phòng tại Hà Nội.</p>
      </div>
      <div class="wl-faq-accordion">
        <div class="wl-faq-item">
          <button class="wl-faq-trigger" aria-expanded="false">
            <span>Các dạng văn phòng cho thuê phổ biến tại Hà Nội?</span>
            <svg class="wl-faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div class="wl-faq-content">
            <div class="wl-faq-content-inner">
              <p>Tại Hà Nội, doanh nghiệp có thể lựa chọn các loại hình văn phòng sau:</p>
              <ul>
                <li><strong>Văn phòng truyền thống:</strong> Doanh nghiệp tự thiết kế, thi công và quản lý không gian riêng.</li>
                <li><strong>Văn phòng trọn gói (Coworking Space):</strong> Đã setup sẵn nội thất, wifi, phòng họp, quầy lễ tân chung, phù hợp cho startup hoặc văn phòng đại diện.</li>
                <li><strong>Văn phòng ảo (Virtual Office):</strong> Dùng để đặt địa chỉ đăng ký kinh doanh và tiếp nhận thư tín.</li>
                <li><strong>Văn phòng chia sẻ:</strong> Thuê chỗ ngồi làm việc cố định hoặc linh hoạt trong không gian chung.</li>
              </ul>
            </div>
          </div>
        </div>
        
        <div class="wl-faq-item">
          <button class="wl-faq-trigger" aria-expanded="false">
            <span>Giá thuê văn phòng tại Hà Nội dao động khoảng bao nhiêu?</span>
            <svg class="wl-faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div class="wl-faq-content">
            <div class="wl-faq-content-inner">
              <p>Mức giá thuê văn phòng Hà Nội phụ thuộc rất lớn vào quận và hạng tòa nhà:</p>
              <ul>
                <li><strong>Văn phòng hạng A:</strong> Từ $25 đến trên $60 / m² / tháng (tập trung chủ yếu tại Hoàn Kiếm, Ba Đình).</li>
                <li><strong>Văn phòng hạng B:</strong> Từ $15 đến $28 / m² / tháng (phổ biến tại Cầu Giấy, Đống Đa, Thanh Xuân).</li>
                <li><strong>Văn phòng hạng C:</strong> Từ $10 đến $15 / m² / tháng (phù hợp doanh nghiệp vừa và nhỏ).</li>
              </ul>
              <p>Lưu ý: Giá thuê thường chưa bao gồm thuế VAT và phí dịch vụ quản lý của tòa nhà.</p>
            </div>
          </div>
        </div>

        <div class="wl-faq-item">
          <button class="wl-faq-trigger" aria-expanded="false">
            <span>Phí dịch vụ ngoài giờ (OT) được tính thế nào?</span>
            <svg class="wl-faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div class="wl-faq-content">
            <div class="wl-faq-content-inner">
              <p>Phí làm việc ngoài giờ tại các tòa nhà văn phòng được tính theo một trong các cách sau:</p>
              <ul>
                <li>Tính theo giờ và diện tích thuê (ví dụ: 0.02 USD/m²/giờ).</li>
                <li>Tính theo thiết bị sử dụng (ví dụ: dựa trên số lượng điều hòa chạy ngoài giờ, khoảng 100,000 - 300,000đ/giờ/họng lạnh).</li>
                <li>Khoán trọn gói theo tháng nếu doanh nghiệp thường xuyên làm thêm ngoài giờ.</li>
                <li>Một số tòa nhà hạng C hoặc văn phòng tư nhân nhỏ có thể miễn phí tiền điện ngoài giờ nếu chỉ sử dụng thiết bị văn phòng cơ bản mà không chạy điều hòa tổng.</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="wl-faq-item">
          <button class="wl-faq-trigger" aria-expanded="false">
            <span>Thời hạn thuê và phương thức thanh toán phổ biến?</span>
            <svg class="wl-faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div class="wl-faq-content">
            <div class="wl-faq-content-inner">
              <p>Hợp đồng thuê văn phòng truyền thống tại Hà Nội thường quy định:</p>
              <ul>
                <li><strong>Thời hạn thuê tối thiểu:</strong> Thường là 2 đến 3 năm. Nếu ký hợp đồng ngắn hơn, giá thuê có thể cao hơn.</li>
                <li><strong>Đặt cọc:</strong> Thường là 3 tháng tiền thuê.</li>
                <li><strong>Kỳ thanh toán:</strong> Thanh toán 3 tháng/lần hoặc 6 tháng/lần tùy thuộc vào thỏa thuận và quy mô của doanh nghiệp.</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="wl-faq-item">
          <button class="wl-faq-trigger" aria-expanded="false">
            <span>Diện tích văn phòng trung bình cho mỗi nhân viên là bao nhiêu?</span>
            <svg class="wl-faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div class="wl-faq-content">
            <div class="wl-faq-content-inner">
              <p>Theo tiêu chuẩn thiết kế văn phòng hiện đại, diện tích trung bình được khuyến nghị là:</p>
              <ul>
                <li><strong>Tiêu chuẩn cơ bản:</strong> 4m² - 5m² / người (đã bao gồm không gian làm việc cá nhân và lối đi chung).</li>
                <li><strong>Tiêu chuẩn rộng rãi:</strong> 6m² - 8m² / người (nếu văn phòng có thêm pantry, phòng họp lớn, khu vực giải trí).</li>
                <li>Doanh nghiệp nên tính toán cả tốc độ tăng trưởng nhân sự trong vòng 2-3 năm tới để lựa chọn diện tích thuê phù hợp nhất.</li>
              </ul>
            </div>
          </div>
        </div>

        <div class="wl-faq-item">
          <button class="wl-faq-trigger" aria-expanded="false">
            <span>Wonderland hỗ trợ gì cho khách hàng đi thuê văn phòng?</span>
            <svg class="wl-faq-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
          </button>
          <div class="wl-faq-content">
            <div class="wl-faq-content-inner">
              <p>Wonderland Việt Nam hỗ trợ toàn diện và hoàn toàn miễn phí dịch vụ cho khách thuê:</p>
              <ul>
                <li>Khảo sát, lọc danh sách các tòa nhà có diện tích trống phù hợp nhu cầu chỉ sau 1 cuộc gọi.</li>
                <li>Đồng hành đi xem thực tế và đánh giá chi tiết ưu/nhược điểm của từng tòa nhà.</li>
                <li>Hỗ trợ phân tích báo giá, đàm phán giảm giá thuê, miễn phí thời gian setup và các điều khoản hợp đồng có lợi nhất.</li>
                <li>Cung cấp gói giải pháp thiết kế - thi công nội thất văn phòng chuyên nghiệp với ưu đãi đặc biệt cho khách hàng của Wonderland.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section 4: Thị trường văn phòng cho thuê tại Hà Nội -->
    <section class="wl-listing-section wl-market-section">
      <div class="row wl-market-row">
        <div class="col large-7 medium-7 small-12">
          <div class="wl-market-text">
            <h2 class="wl-section-title text-left">Thị trường văn phòng cho thuê Hà Nội</h2>
            <p>Thị trường văn phòng Hà Nội đang chứng kiến sự dịch chuyển mạnh mẽ từ các quận trung tâm cũ (Hoàn Kiếm, Ba Đình) sang các trung tâm tài chính và công nghệ mới nổi (Cầu Giấy, Nam Từ Liêm, Thanh Xuân) nhờ hạ tầng giao thông kết nối đồng bộ và nguồn cung dồi dào từ các dự án tòa nhà mới khánh thành.</p>
            <p>Mức giá thuê tại Hà Nội giữ mức ổn định và có sự phân hóa rõ rệt, mở ra nhiều cơ hội lựa chọn tối ưu cho các doanh nghiệp trong nước và quốc tế:</p>
          </div>
          
          <div class="wl-market-table-wrapper">
            <table class="wl-market-table">
              <thead>
                <tr>
                  <th>Khu vực cho thuê phổ biến</th>
                  <th>Giá thuê văn phòng trung bình</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/quan-hoan-kiem/') ); ?>">Cho thuê văn phòng Quận Hoàn Kiếm</a></td>
                  <td><strong>$25 - $60+</strong>/m²/tháng</td>
                </tr>
                <tr>
                  <td><a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/quan-ba-dinh/') ); ?>">Cho thuê văn phòng Quận Ba Đình</a></td>
                  <td><strong>$20 - $45</strong>/m²/tháng</td>
                </tr>
                <tr>
                  <td><a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/quan-dong-da/') ); ?>">Cho thuê văn phòng Quận Đống Đa</a></td>
                  <td><strong>$15 - $35</strong>/m²/tháng</td>
                </tr>
                <tr>
                  <td><a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/quan-cau-giay/') ); ?>">Cho thuê văn phòng Quận Cầu Giấy</a></td>
                  <td><strong>$12 - $30</strong>/m²/tháng</td>
                </tr>
                <tr>
                  <td><a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/quan-nam-tu-liem/') ); ?>">Cho thuê văn phòng Quận Nam Từ Liêm</a></td>
                  <td><strong>$12 - $28</strong>/m²/tháng</td>
                </tr>
                <tr>
                  <td><a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/quan-thanh-xuan/') ); ?>">Cho thuê văn phòng Quận Thanh Xuân</a></td>
                  <td><strong>$11 - $25</strong>/m²/tháng</td>
                </tr>
                <tr>
                  <td><a href="<?php echo esc_url( home_url('/cho-thue-van-phong-ha-noi/quan-tay-ho/') ); ?>">Cho thuê văn phòng Quận Tây Hồ</a></td>
                  <td><strong>$15 - $35</strong>/m²/tháng</td>
                </tr>
              </tbody>
            </table>
          </div>
          
          <div class="wl-market-more">
            <a href="<?php echo esc_url( home_url('/lien-he/') ); ?>" class="wl-btn-primary">Nhận báo giá chi tiết tất cả khu vực</a>
          </div>
        </div>
        <div class="col large-5 medium-5 small-12">
          <div class="wl-market-image-wrapper">
            <img src="<?php echo esc_url( home_url('/wp-content/uploads/2020/11/leadvisors-tower-36-pham-van-dong-bac-tu-liem-ha-noi.jpg') ); ?>" alt="Thị trường văn phòng cho thuê Hà Nội" class="wl-market-image">
            <div class="wl-image-badge">
              <span>Leadvisors Tower Phạm Văn Đồng</span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
      const triggers = document.querySelectorAll(".wl-faq-trigger");
      triggers.forEach(trigger => {
        trigger.addEventListener("click", function() {
          const parent = this.parentElement;
          const isExpanded = this.getAttribute("aria-expanded") === "true";
          
          // Close other items
          document.querySelectorAll(".wl-faq-item").forEach(item => {
            if (item !== parent) {
              item.classList.remove("active");
              item.querySelector(".wl-faq-trigger").setAttribute("aria-expanded", "false");
              item.querySelector(".wl-faq-content").style.maxHeight = null;
            }
          });
          
          // Toggle current item
          parent.classList.toggle("active");
          this.setAttribute("aria-expanded", !isExpanded);
          const content = parent.querySelector(".wl-faq-content");
          if (parent.classList.contains("active")) {
            content.style.maxHeight = content.scrollHeight + "px";
          } else {
            content.style.maxHeight = null;
          }
        });
      });
    });
    </script>

  </div>
</div>
<?php echo do_shortcode('[block id="tiet-kiem-95"]'); ?>