<?php
function admin_menus() {
	remove_menu_page( 'edit-tags.php' );
}
add_action( 'admin_menu', 'admin_menus' );
function remove_submenu_items() {
	remove_submenu_page( 'edit.php', 'edit-tags.php' );
}
add_action( 'admin_init', 'remove_submenu_items' );

add_action( 'woocommerce_product_options_general_product_data', 'woo_add_custom_general_fields' );
add_action( 'woocommerce_process_product_meta', 'woo_add_custom_general_fields_save' );

function woo_add_custom_general_fields() {
	global $woocommerce, $post;
	woocommerce_wp_text_input(
		array(
			'id' => '_gia_hien_thi',
			'label' => __( 'Giá hiển thị', 'woocommerce' ),
			'placeholder' => 'Giá hiển thị',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: $23 - $28/ m2 (Chỉ dùng để hiển thị ra ngoài, không sử dụng để lọc tìm kiếm, nếu muốn lọc tìm kiếm hãy nhập giá chính xác ở trường trên!)', 'woocommerce' )
		)
	);
	echo '<div class="options_group"><h2 style="font-weight: bold;">THÔNG SỐ TOÀ NHÀ</h2>';
	woocommerce_wp_text_input(
		array(
			'id' => '_vi_tri',
			'label' => __( 'Vị trí', 'woocommerce' ),
			'placeholder' => 'Vị trí',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 29 Liễu Giai, Ba Đình, Hà Nội', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_chieu_cao_tang',
			'label' => __( 'Chiều cao tầng', 'woocommerce' ),
			'placeholder' => 'Chiều cao tầng',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Gồm 02 tòa tháp cao 37 tầng nằm chung trên khối đế 5 tầng, 1 tầng trệt và 03 tầng hầm', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_chieu_cao_tran',
			'label' => __( 'Chiều cao trần', 'woocommerce' ),
			'placeholder' => 'Chiều cao trần',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 2.7 m', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_dien_tich_san',
			'label' => __( 'Diện tích sàn', 'woocommerce' ),
			'placeholder' => 'Diện tích sàn',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 1200m2 - 1340m2', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_do_xe',
			'label' => __( 'Đỗ xe', 'woocommerce' ),
			'placeholder' => 'Đỗ xe',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Diện tích 3 tầng hầm', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_thang_may',
			'label' => __( 'Thang máy', 'woocommerce' ),
			'placeholder' => 'Thang máy',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 32 thang máy tốc độ cao; mỗi tháp 16 thang máy', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_dieu_hoa',
			'label' => __( 'Điều hòa', 'woocommerce' ),
			'placeholder' => 'Điều hòa',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Điều hòa trung tâm hiện đại', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_dien_du_phong',
			'label' => __( 'Điện dự phòng', 'woocommerce' ),
			'placeholder' => 'Điện dự phòng',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Máy phát điện đáp ứng 100% công suất', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_gio_lam_viec',
			'label' => __( 'Giờ làm việc', 'woocommerce' ),
			'placeholder' => 'Giờ làm việc',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 8h00 - 18h00 thứ 2 đến thứ 6, 8h00 - 12h00 thứ 7', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_huong_toa_nha',
			'label' => __( 'Hướng tòa nhà', 'woocommerce' ),
			'placeholder' => 'Hướng tòa nhà',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Tây Nam', 'woocommerce' )
		)
	);
	echo '</div>';

	echo '<div class="options_group"><h2 style="font-weight: bold;">CHI TIẾT GIÁ THUÊ VÀ DIỆN TÍCH</h2>';
	woocommerce_wp_text_input(
		array(
			'id' => '_gia_thue_gop',
			'label' => __( 'Giá thuê gộp (Giá thuê + Phí dịch vụ)', 'woocommerce' ),
			'placeholder' => 'Giá thuê gộp (Giá thuê + Phí dịch vụ)',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Từ 42 usd/m2/tháng (dự kiến)', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_gia_thue',
			'label' => __( 'Giá thuê', 'woocommerce' ),
			'placeholder' => 'Giá thuê',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Từ 35 usd/m2/tháng (dự kiến)', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_phi_dich_vu',
			'label' => __( 'Phí dịch vụ', 'woocommerce' ),
			'placeholder' => 'Phí dịch vụ',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 7 usd/m2 (dự kiến)  ', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_dien_tich_cho_thue_tieu_chuan',
			'label' => __( 'Diện tích cho thuê tiêu chuẩn', 'woocommerce' ),
			'placeholder' => 'Diện tích cho thuê tiêu chuẩn',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Linh hoạt chia thành các diện tích: 90m2, 120m2, 143m2, 180m2, 233m2, 500m2, 1000m2, 2000m2', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_tien_dien_dieu_hoa',
			'label' => __( 'Tiền điện điều hòa', 'woocommerce' ),
			'placeholder' => 'Tiền điện điều hòa',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Đã bao gồm trong phí dịch vụ', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_do_xe_may',
			'label' => __( 'Đỗ xe máy', 'woocommerce' ),
			'placeholder' => 'Đỗ xe máy',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 10 usd/xe máy/tháng  ', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_do_o_to',
			'label' => __( 'Đỗ ô tô', 'woocommerce' ),
			'placeholder' => 'Đỗ ô tô',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: 100 usd/xe/tháng  ', 'woocommerce' )
		)
	);
	woocommerce_wp_text_input(
		array(
			'id' => '_tien_dien_trong_van_phong',
			'label' => __( 'Tiền điện trong văn phòng', 'woocommerce' ),
			'placeholder' => 'Tiền điện trong văn phòng',
			'desc_tip' => 'true',
			'description' => __( 'Ví dụ: Tính thực tế tiêu thụ theo đồng hồ ', 'woocommerce' )
		)
	);
	echo '</div>';
}

function woo_add_custom_general_fields_save( $post_id ) {
	$woocommerce_text_field = $_POST['_gia_hien_thi'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_gia_hien_thi', esc_attr( $woocommerce_text_field ) );

	$woocommerce_text_field = $_POST['_vi_tri'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_vi_tri', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_chieu_cao_tang'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_chieu_cao_tang', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_chieu_cao_tran'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_chieu_cao_tran', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_dien_tich_san'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_dien_tich_san', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_do_xe'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_do_xe', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_thang_may'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_thang_may', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_dieu_hoa'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_dieu_hoa', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_dien_du_phong'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_dien_du_phong', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_gio_lam_viec'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_gio_lam_viec', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_huong_toa_nha'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_huong_toa_nha', esc_attr( $woocommerce_text_field ) );

	$woocommerce_text_field = $_POST['_gia_thue_gop'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_gia_thue_gop', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_gia_thue'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_gia_thue', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_phi_dich_vu'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_phi_dich_vu', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_dien_tich_cho_thue_tieu_chuan'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_dien_tich_cho_thue_tieu_chuan', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_tien_dien_dieu_hoa'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_tien_dien_dieu_hoa', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_do_xe_may'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_do_xe_may', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_do_o_to'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_do_o_to', esc_attr( $woocommerce_text_field ) );
	$woocommerce_text_field = $_POST['_tien_dien_trong_van_phong'];
	if ( ! empty( $woocommerce_text_field ) )
		update_post_meta( $post_id, '_tien_dien_trong_van_phong', esc_attr( $woocommerce_text_field ) );
}

if ( isset( $_GET['taxonomy'] ) ) {
	if ( strpos( $_GET['taxonomy'], 'pa_' ) !== false ) {
		add_action( $_GET['taxonomy'] . "_edit_form_fields", 'add_form_fields_example', 10, 2 );
	}
}
function add_form_fields_example( $term, $taxonomy ) {
	?>
	<tr valign="top">
		<th scope="row">Description</th>
		<td>
			<?php wp_editor( html_entity_decode( $term->description ), 'description', array( 'media_buttons' => true ) ); ?>
			<script>
				jQuery(window).ready(function () {
					jQuery('label[for=description]').parent().parent().remove();
				});
			</script>
		</td>
	</tr>
	<?php
}

add_action( 'admin_head', 'my_custom_css_admin_head' );

function my_custom_css_admin_head() {
	echo '<style>
    #flatsome-notice{
        display:none !important;
    }
    #posts-filter table thead tr #title{
        width: 35%;
    }
    #posts-filter table thead tr #post_views{
        width: 9%;
    }
    .col.cols.panel.flatsome-panel .notice.notice-warning.notice-alt.inline{
        opacity: 0;
        visibility: hidden;
        height: 0;
        margin: 0;
        padding: 0;
    }
    .flatsome-registration-form > p, #dashboard_php_nag, .menu-icon-plugins .update-plugins, .menu-icon-dashboard .update-plugins, #toplevel_page_Wordfence .update-plugins, .update-message, #wpfooter, #wp-admin-bar-wp-logo, #login h1{
        display: none !important;
    }
    .flatsome-registration-form > p.flatsome-registration-form__code{
        display: block !important;
    }
    li#wp-admin-bar-flatsome-activate{
    	display: none;
    }
</style>';
}
function my_login_logo() { ?>
	<style type="text/css">
		#login h1 a,
		.login h1 a {
			background-image: url(<?php echo home_url( '/wp-content/uploads/2020/11/logo-wonder-vuong-2.png' ) ?>);
			height: 120px;
			width: auto;
			background-size: auto 100%;
			background-repeat: no-repeat;
			padding-bottom: 0;
			pointer-events: none;
			margin: 0;
		}

		#loginform {
			margin-top: 0;
		}
	</style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


// 1) Định nghĩa class mới kế thừa và override phương thức
class WC_Widget_Custom_Layered_Nav extends WC_Widget_Layered_Nav {

	// Ghi đè phương thức layered_nav_list()
	protected function layered_nav_list( $terms, $taxonomy, $query_type ) {
		echo '<ul class="woocommerce-widget-layered-nav-list" taxonomy="' . esc_attr( $taxonomy ) . '">';

		$term_counts = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy, $query_type );
		$_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
		$found = false;
		$base_link = $this->get_current_page_url();

		foreach ( $terms as $term ) {
			$current_values = isset( $_chosen_attributes[ $taxonomy ]['terms'] ) ? $_chosen_attributes[ $taxonomy ]['terms'] : array();
			$option_is_set = in_array( $term->slug, $current_values, true );
			$count = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;

			// Bỏ qua term chính đang xem
			if ( $this->get_current_term_id() === $term->term_id ) {
				continue;
			}

			// Luôn show ra, bỏ điều kiện count > 0
			$found = true;

			$filter_name = 'filter_' . wc_attribute_taxonomy_slug( $taxonomy );
			$current_filter = isset( $_GET[ $filter_name ] ) ? explode( ',', wc_clean( wp_unslash( $_GET[ $filter_name ] ) ) ) : array();
			$current_filter = array_map( 'sanitize_title', $current_filter );

			if ( ! in_array( $term->slug, $current_filter, true ) ) {
				$current_filter[] = $term->slug;
			}

			$link = remove_query_arg( $filter_name, $base_link );

			foreach ( $current_filter as $key => $value ) {
				if ( $value === $this->get_current_term_slug() ) {
					unset( $current_filter[ $key ] );
				}
				if ( $option_is_set && $value === $term->slug ) {
					unset( $current_filter[ $key ] );
				}
			}

			if ( ! empty( $current_filter ) ) {
				asort( $current_filter );
				$link = add_query_arg( $filter_name, implode( ',', $current_filter ), $link );

				if ( 'or' === $query_type && ! ( 1 === count( $current_filter ) && $option_is_set ) ) {
					$link = add_query_arg( 'query_type_' . wc_attribute_taxonomy_slug( $taxonomy ), 'or', $link );
				}
				$link = str_replace( '%2C', ',', $link );
			}

			// Tạo HTML như bạn muốn
			$link = apply_filters( 'woocommerce_layered_nav_link', $link, $term, $taxonomy );
			$term_html = '<a rel="nofollow" href="' . esc_url( $link ) . '" slug="' . esc_attr( $term->slug ) . '">'
				. esc_html( $term->name )
				. '</a> '
				. apply_filters( 'woocommerce_layered_nav_count',
					'<span class="count">(' . absint( $count ) . ')</span>',
					$count,
					$term
				);

			echo '<li class="woocommerce-widget-layered-nav-list__item wc-layered-nav-term '
				. ( $option_is_set ? 'woocommerce-widget-layered-nav-list__item--chosen chosen' : '' )
				. '">';
			echo apply_filters( 'woocommerce_layered_nav_term_html', $term_html, $term, $link, $count );
			echo '</li>';
		}

		echo '</ul>';

		return $found;
	}
}

// 2) Hủy đăng ký widget cũ và đăng ký widget mới ngay sau khi WooCommerce load widget
add_action( 'widgets_init', function () {
	unregister_widget( 'WC_Widget_Layered_Nav' );
	register_widget( 'WC_Widget_Custom_Layered_Nav' );
}, 15 );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_script( 'jquery-ui-slider' );
	wp_enqueue_style( 'jquery-ui-css', '//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css' );
} );

// Thêm field cho Product Category - Add form
function add_product_cat_attribute_field() {
	?>
	<div class="form-field">
		<label for="attribute_taxonomy">Thuộc tính quận/huyện</label>
		<select name="attribute_taxonomy" id="attribute_taxonomy">
			<option value="">Chọn thuộc tính</option>
			<?php
			$attribute_taxonomies = wc_get_attribute_taxonomies();
			foreach ( $attribute_taxonomies as $taxonomy ) {
				echo '<option value="pa_' . esc_attr( $taxonomy->attribute_name ) . '">'
					. esc_html( $taxonomy->attribute_label ) . '</option>';
			}
			?>
		</select>
		<p class="description">Chọn thuộc tính quận/huyện cho danh mục này</p>
	</div>
	<?php
}

// Thêm field cho Product Category - Edit form (style form-table)
function edit_product_cat_attribute_field( $term, $taxonomy ) {
	$selected_attribute = get_term_meta( $term->term_id, 'district_attribute_taxonomy', true );
	?>
	<tr class="form-field">
		<th scope="row">
			<label for="attribute_taxonomy">Thuộc tính quận/huyện</label>
		</th>
		<td>
			<select name="attribute_taxonomy" id="attribute_taxonomy">
				<option value="">Chọn thuộc tính</option>
				<?php
				$attribute_taxonomies = wc_get_attribute_taxonomies();
				foreach ( $attribute_taxonomies as $taxonomy_item ) {
					$taxonomy_name = 'pa_' . $taxonomy_item->attribute_name;
					$selected = selected( $selected_attribute, $taxonomy_name, false );
					echo '<option value="' . esc_attr( $taxonomy_name ) . '" ' . $selected . '>'
						. esc_html( $taxonomy_item->attribute_label ) . '</option>';
				}
				?>
			</select>
			<p class="description">Chọn thuộc tính quận/huyện cho danh mục này</p>
		</td>
	</tr>
	<?php
}

add_action( 'product_cat_add_form_fields', 'add_product_cat_attribute_field' );
add_action( 'product_cat_edit_form_fields', 'edit_product_cat_attribute_field', 10, 2 );

// Lưu giá trị
function save_product_cat_attribute_field( $term_id ) {
	if ( isset( $_POST['attribute_taxonomy'] ) ) {
		update_term_meta( $term_id, 'district_attribute_taxonomy',
			sanitize_text_field( $_POST['attribute_taxonomy'] ) );
	}
}
add_action( 'created_product_cat', 'save_product_cat_attribute_field' );
add_action( 'edited_product_cat', 'save_product_cat_attribute_field' );

// AJAX handler for autocomplete search
add_action( 'wp_ajax_autocomplete_search', 'handle_autocomplete_search' );
add_action( 'wp_ajax_nopriv_autocomplete_search', 'handle_autocomplete_search' );

function handle_autocomplete_search() {
	// Verify nonce
	if ( ! wp_verify_nonce( $_POST['nonce'], 'autocomplete_search_nonce' ) ) {
		wp_die( 'Security check failed' );
	}

	$search_term = sanitize_text_field( $_POST['search_term'] );
	$category = sanitize_text_field( $_POST['category'] );
	$district_taxonomy = sanitize_text_field( $_POST['district_taxonomy'] );

	if ( strlen( $search_term ) < 2 ) {
		wp_send_json_error( 'Từ khóa quá ngắn' );
	}

	$results = array();

	// Helper function to highlight search term
	function highlight_search_term( $text, $search_term ) {
		if ( empty( $search_term ) ) {
			return $text;
		}

		// Escape special regex characters in search term
		$escaped_term = preg_quote( $search_term, '/' );

		// Replace search term with bold version (case insensitive)
		return preg_replace( '/(' . $escaped_term . ')/iu', '<strong>$1</strong>', $text );
	}

	// Search products by name
	$product_args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => 5,
		's' => $search_term,
	);

	// Add category filter if specified
	if ( ! empty( $category ) ) {
		$product_args['tax_query'] = array(
			array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => $category,
			)
		);
	}

	$products = get_posts( $product_args );

	foreach ( $products as $product ) {
		$vitri = get_post_meta( $product->ID, '_vi_tri', true );
		$description = ! empty( $vitri ) ? $vitri : '';

		// Highlight search term in product title
		$highlighted_title = highlight_search_term( $product->post_title, $search_term );

		// Highlight search term in description (position)
		$highlighted_description = highlight_search_term( $description, $search_term );

		$results[] = array(
			'type' => 'product',
			'value' => $product->post_title,
			'label' => $highlighted_title,
			'description' => $highlighted_description,
			'link' => get_permalink( $product->ID ),
			'is_link' => true,
		);
	}

	// Search streets based on district_taxonomy
	if ( ! empty( $district_taxonomy ) ) {
		// Tạo street taxonomy từ district taxonomy
		// pa_quan-ha-noi -> pa_duong-ha-noi
		// pa_quan-ho-chi-minh -> pa_duong-ho-chi-minh

		$street_taxonomy = '';
		if ( $district_taxonomy === 'pa_quan-ha-noi' ) {
			$street_taxonomy = 'pa_duong-ha-noi';
			$location_name = 'Hà Nội';
		} elseif ( $district_taxonomy === 'pa_quan-ho-chi-minh' ) {
			$street_taxonomy = 'pa_duong-ho-chi-minh';
			$location_name = 'TP. Hồ Chí Minh';
		} else {
			// Fallback pattern: thay 'quan' thành 'duong'
			$street_taxonomy = str_replace( 'quan-', 'duong-', $district_taxonomy );
			$location_name = 'Việt Nam';
		}

		if ( ! empty( $street_taxonomy ) ) {
			$streets = get_terms( array(
				'taxonomy' => $street_taxonomy,
				'hide_empty' => false,
				'name__like' => $search_term,
				'number' => 5,
			) );

			if ( ! is_wp_error( $streets ) && ! empty( $streets ) ) {
				foreach ( $streets as $street ) {
					// Highlight search term in street name
					$highlighted_street_name = highlight_search_term( $street->name, $search_term );

					$results[] = array(
						'type' => 'street',
						'value' => $street->name,
						'label' => $highlighted_street_name,
						'description' => 'Đường tại ' . $location_name,
						'link' => '',
						'is_link' => false,
					);
				}
			}
		}
	}

	// Limit total results
	$results = array_slice( $results, 0, 10 );

	if ( empty( $results ) ) {
		wp_send_json_error( 'No results found' );
	}

	wp_send_json_success( $results );
}

function add_custom_category_pagination_rules() {
	// Rule cho category pagination với query parameters
	add_rewrite_rule(
		'^([^/]+)/page/([0-9]+)/?(.*)$',
		'index.php?product_cat=$matches[1]&paged=$matches[2]',
		'top'
	);
}

add_action( 'init', 'add_custom_category_pagination_rules' );

// Ensure paged is registered as query var
function add_paged_query_var( $vars ) {
	$vars[] = 'paged';
	return $vars;
}
add_filter( 'query_vars', 'add_paged_query_var' );

// Handle pagination with custom query parameters
function handle_custom_pagination() {
	// Get paged from URL path
	if ( preg_match( '/\/page\/(\d+)\//', $_SERVER['REQUEST_URI'], $matches ) ) {
		$paged = intval( $matches[1] );
		set_query_var( 'paged', $paged );

		// Also set global variable
		global $paged;
		$paged = intval( $matches[1] );
	}
}
add_action( 'wp', 'handle_custom_pagination', 1 );

// flush_rewrite_rules đã chạy — giữ commented out để tránh chạy mỗi request
// add_action( 'init', function () { flush_rewrite_rules(); } );


// Bỏ query string khi so sánh menu active
add_filter('nav_menu_css_class', function($classes, $item){
    if (!empty($item->url)) {
        // URL hiện tại, bỏ query string và hash
        $current_url = strtok(home_url(add_query_arg([], $_SERVER['REQUEST_URI'])), '?#');

        // URL menu, bỏ query string và hash
        $menu_url = strtok($item->url, '?#');

        // So sánh
        if ($current_url === $menu_url) {
            $classes[] = 'current-menu-item';
        } else {
            // Loại bỏ nhầm active trước đó nếu có
            $classes = array_diff($classes, ['current-menu-item']);
        }
    }
    return $classes;
}, 10, 2);



function enqueue_fancybox(){
    wp_enqueue_style('fancybox-css', 'https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3/dist/jquery.fancybox.min.css', [], '3.5.7');
    wp_enqueue_script('fancybox-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3/dist/jquery.fancybox.min.js', ['jquery'], '3.5.7', true);
}
add_action('wp_enqueue_scripts','enqueue_fancybox', 20);

add_action('wp_footer', function(){
?>
<script>
	jQuery(function($){
		$("[data-fancybox='gallery']").fancybox({
		loop: true,
		buttons : [ "zoom", "slideShow", "fullScreen", "thumbs", "close" ],
		thumbs : {
			autoStart : true,
			loop: false,
			// axis: 'x' // Bắt buộc: dùng horizontal
		}
		});

	});
</script>
<?php
});


function remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
        $script = $scripts->registered['jquery'];
        if ( $script->deps ) { // kiểm tra dependencies
            $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
        }
    }
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate' );


function load_fontawesome() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css' );
}
add_action( 'wp_enqueue_scripts', 'load_fontawesome' );


function enqueue_building_assets_swiper() {
    // Swiper
    wp_enqueue_style( 'swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script( 'swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
}
add_action( 'wp_enqueue_scripts', 'enqueue_building_assets_swiper' );

add_action('wp_footer', function(){
?>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const gallery = document.querySelector("#BuildingGalleryMobile .BuildingGallery");
		if (gallery) {
			new Swiper(gallery, {
				loop: false,
				slidesPerView: "auto",
				spaceBetween: 12,
			});
		}
	});
</script>
<?php
});

// Thêm OG tags cho sản phẩm WooCommerce
add_action('wp_head', 'custom_woocommerce_og_tags');
function custom_woocommerce_og_tags() {
    if ( is_product() ) {
        global $product;
        if ( $product ) {
            $title = get_the_title();
            $desc  = wp_strip_all_tags( $product->get_short_description() );
            $img   = wp_get_attachment_url( $product->get_image_id() );

            echo '<meta property="og:title" content="'.esc_attr($title).'" />' . "\n";
            echo '<meta property="og:description" content="'.esc_attr($desc).'" />' . "\n";
            echo '<meta property="og:image" content="'.esc_url($img).'" />' . "\n";
            echo '<meta property="og:type" content="product" />' . "\n";
        }
    }
}



function dtm_enqueue_scripts() {
  wp_enqueue_script(
    'dtm-custom',
    get_stylesheet_directory_uri() . '/assets/js/custom.js',
    array(), // hoặc array('jquery')
    null,
    true // 🔥 load ở footer
  );
}
add_action('wp_enqueue_scripts', 'dtm_enqueue_scripts');




add_filter( 'wpseo_breadcrumb_links', 'dtm_customize_yoast_breadcrumb' );

function dtm_customize_yoast_breadcrumb( $links ) {

    /* -------------------------
     * CASE 1: SINGLE PRODUCT
     * ------------------------- */
	if ( is_singular( 'product' ) ) {

		$terms = get_the_terms( get_the_ID(), 'product_cat' );
		if ( empty( $terms ) || is_wp_error( $terms ) ) {
			return $links;
		}

		$root     = null;
		$district = null;

		foreach ( $terms as $term ) {

			$ancestors = get_ancestors( $term->term_id, 'product_cat' );
			$ancestors = array_reverse( $ancestors ); // root → gần

			// Ví dụ: [root, quan, phuong]
			if ( isset( $ancestors[0] ) ) {
				$root = get_term( $ancestors[0], 'product_cat' );
			}

			if ( isset( $ancestors[1] ) ) {
				$district = get_term( $ancestors[1], 'product_cat' );
			}
		}

		// Nếu thiếu thì dừng
		if ( ! $root || ! $district ) {
			return $links;
		}

		$new = array(
			array(
				'url'  => home_url('/'),
				'text' => 'Trang chủ',
			),
			array(
				'url'  => get_term_link( $root ),
				'text' => $root->name,
			),
			array(
				'url'  => get_term_link( $district ),
				'text' => $district->name,
			),
			array(
				'url'  => get_permalink(),
				'text' => get_the_title(),
			),
		);

		return $new;
	}


    /* -------------------------
     * CASE 2: PRODUCT CATEGORY ARCHIVE
     * ------------------------- */
    if ( is_tax( 'product_cat' ) ) {

        $term = get_queried_object();

        $new = array(
            $links[0], // Home
        );

        // Lấy danh mục cha nếu có
        $ancestors = array_reverse( get_ancestors( $term->term_id, 'product_cat' ) );
        foreach ( $ancestors as $ancestor_id ) {
            $ancestor = get_term( $ancestor_id, 'product_cat' );
            $new[] = array(
                'url'  => get_term_link( $ancestor ),
                'text' => $ancestor->name,
            );
        }

        // Category hiện tại
        $new[] = array(
            'url'  => get_term_link( $term ),
            'text' => $term->name,
        );

        return $new;
    }


    /* -------------------------
     * CASE 3: BLOG POST
     * ------------------------- */
    if ( is_single() && get_post_type() === 'post' ) {

        $cats = get_the_category();
        if ( empty( $cats ) ) return $links;

        $primary = $cats[0];

        return array(
            $links[0], // Home
            array(
                'url'  => get_category_link( $primary->term_id ),
                'text' => $primary->name,
            ),
        );
    }

    return $links;
}

remove_action(
  'woocommerce_single_product_summary',
  'woocommerce_template_single_title',
  5
);

/* =============================================================
 * SPRINT 1 — Assets, Menu, CTA, Social Share
 * ============================================================= */

add_action( 'wp_enqueue_scripts', 'oneoffice_sprint1_assets' );
function oneoffice_sprint1_assets() {
    $uri = get_stylesheet_directory_uri();
    // Pass site config to JS — fix hardcoded URLs in custom.js (handle = dtm-custom)
    wp_localize_script( 'dtm-custom', 'ooSite', array(
        'homeUrl' => trailingslashit( home_url() ),
    ) );

    // Main stylesheet extracted from header.php (replaces inline <style>)
    // Version = filemtime để tự cache-bust mỗi lần sửa (trước đây hardcode '1.1' gây cache cũ).
    wp_enqueue_style(
        'oneoffice-main',
        $uri . '/assets/css/main.css',
        array(),
        filemtime( get_stylesheet_directory() . '/assets/css/main.css' )
    );

    // Category page overrides
    wp_enqueue_style(
        'oneoffice-category-page',
        $uri . '/assets/css/category-page.css',
        array( 'oneoffice-main' ),
        filemtime( get_stylesheet_directory() . '/assets/css/category-page.css' )
    );

    // Single page overrides (Contact, Consignment, etc.)
    wp_enqueue_style(
        'oneoffice-single-page',
        $uri . '/assets/css/single-page.css',
        array( 'oneoffice-main' ),
        filemtime( get_stylesheet_directory() . '/assets/css/single-page.css' )
    );

    // Sprint 1 overrides & new UI components
    wp_enqueue_style(
        'oneoffice-sprint1',
        $uri . '/assets/css/sprint1.css',
        array( 'oneoffice-main' ),
        filemtime( get_stylesheet_directory() . '/assets/css/sprint1.css' )
    );

    // Design System — tokens + component primitives toàn site.
    // Nạp SAU cùng trong nhóm global (dep đủ 4 file) ⇒ override layer cũ.
    // V2 (home/vptg/product) nạp ưu tiên 30 → vẫn nạp sau file này, không bị đụng.
    // ROLLBACK: comment cả block wp_enqueue_style() này.
    wp_enqueue_style(
        'oneoffice-design-system',
        $uri . '/assets/css/design-system.css',
        array( 'oneoffice-main', 'oneoffice-category-page', 'oneoffice-single-page', 'oneoffice-sprint1' ),
        filemtime( get_stylesheet_directory() . '/assets/css/design-system.css' )
    );

    // Single Blog Post stylesheet
    if ( is_single() && get_post_type() === 'post' ) {
        wp_enqueue_style(
            'oneoffice-single-post',
            $uri . '/assets/css/single-post.css',
            array( 'oneoffice-design-system' ),
            filemtime( get_stylesheet_directory() . '/assets/css/single-post.css' )
        );
    }

    // Global motion — reveal-on-scroll cho trang cũ (tự bỏ qua V2 + reduced-motion).
    // ROLLBACK: comment block wp_enqueue_script() này.
    wp_enqueue_script(
        'oneoffice-motion',
        $uri . '/assets/js/oo-motion.js',
        array(),
        filemtime( get_stylesheet_directory() . '/assets/js/oo-motion.js' ),
        true
    );

    // jQuery Cookie — moved from CDN hardcode in header.php to proper enqueue
    wp_enqueue_script(
        'jquery-cookie',
        'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js',
        array( 'jquery' ),
        '1.4.1',
        false
    );

    // Sprint 1 JS — animations, counters, CTA
    wp_enqueue_script(
        'oneoffice-sprint1',
        $uri . '/assets/js/sprint1.js',
        array( 'jquery', 'jquery-cookie' ),
        filemtime( get_stylesheet_directory() . '/assets/js/sprint1.js' ),
        true
    );
}

// Disable AddToAny automatic insertion in content (posts/pages/etc)
add_filter( 'addtoany_sharing_disabled', '__return_true' );

// Social share button for single product pages (WooCommerce) - disabled duplicate bottom summary share widget
// add_action( 'woocommerce_single_product_summary', 'oneoffice_product_social_share', 60 );
function oneoffice_product_social_share() {
    // Disabled in favor of the custom circular sharing widget in the header card (detail.php)
}

// Social share for single blog posts — appended after content
add_filter( 'the_content', 'oneoffice_post_social_share' );
function oneoffice_post_social_share( $content ) {
    if ( ! is_single() || get_post_type() !== 'post' ) return $content;
    
    $post_url = get_permalink();
    $encoded_url = urlencode( $post_url );
    
    ob_start();
    ?>
    <div class="oneoffice-post-share">
        <span class="share-label">Chia sẻ bài viết:</span>
        <div class="oo-share-buttons">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $encoded_url; ?>" target="_blank" rel="noopener" class="oo-share-btn oo-share-btn--facebook" title="Chia sẻ lên Facebook">
                <svg viewBox="0 0 24 24" class="oo-share-icon"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                <span>Facebook</span>
            </a>
            <a href="https://sp.zalo.me/share_ua/new?url=<?php echo $encoded_url; ?>" target="_blank" rel="noopener" class="oo-share-btn oo-share-btn--zalo" title="Chia sẻ qua Zalo">
                <svg viewBox="0 0 27.64 25.07" class="oo-share-icon"><path d="M12.92,12.02c-0.46-0.26-1.03-0.14-1.38,0.26c-0.48,0.55-0.48,1.65-0.02,2.22c0.34,0.42,0.93,0.56,1.38,0.3c0.53-0.3,0.71-0.8,0.72-1.39C13.61,12.84,13.46,12.33,12.92,12.02z M12.92,12.02c-0.46-0.26-1.03-0.14-1.38,0.26c-0.48,0.55-0.48,1.65-0.02,2.22c0.34,0.42,0.93,0.56,1.38,0.3c0.53-0.3,0.71-0.8,0.72-1.39C13.61,12.84,13.46,12.33,12.92,12.02z  M13.81,0C6.19,0,0,5.61,0,12.53c0,3.23,1.37,6.16,3.58,8.39H3.56c0,0,0.03,0.03,0.08,0.06c0.07,0.07,0.13,0.13,0.2,0.19 c0.21,0.26,0.4,0.72,0.02,1.38c-0.5,0.86-1.49,1.67-2.23,2.06c-0.15,0.08-0.13,0.31,0.03,0.34c1.18,0.23,2.56,0.13,3.83-0.24 c1.47-0.43,2.21-0.9,3.74-0.36v-0.01c1.44,0.46,2.98,0.73,4.59,0.73c7.64,0,13.82-5.61,13.82-12.53S21.45,0,13.81,0z M8.55,16.42 c-1.44,0.02-2.88,0.01-4.32,0.01c-0.43,0-0.84-0.08-1.07-0.5c-0.24-0.46-0.08-0.88,0.2-1.27c1.05-1.41,2.11-2.82,3.16-4.23 c0.1-0.13,0.25-0.23,0.26-0.5h-2.3c-0.21,0-0.42,0.02-0.62-0.03C3.43,9.84,3.18,9.57,3.18,9.13c0-0.46,0.25-0.79,0.71-0.79 c1.53-0.03,3.07-0.04,4.6,0c0.66,0.02,0.95,0.62,0.68,1.24C8.99,10,8.71,10.36,8.45,10.72c-0.98,1.3-1.94,2.59-3,4 c1.08,0,2.03-0.01,2.98,0c0.45,0.01,0.88,0.08,0.99,0.63C9.54,16.03,9.24,16.42,8.55,16.42z M15.41,15.37 c0,0.44-0.07,0.84-0.51,1.05c-0.43,0.21-0.81,0.1-1.11-0.27c-0.08-0.1-0.14-0.13-0.28-0.05c-1.8,0.96-3.38,0.35-3.95-1.53 c-0.38-1.23-0.22-2.38,0.58-3.43c0.79-1.03,2.45-1.39,3.51-0.35c0.3-0.36,0.63-0.67,1.16-0.46c0.53,0.23,0.59,0.68,0.59,1.18 C15.41,12.8,15.41,14.09,15.41,15.37z M17.94,15.51c-0.01,0.64-0.33,1.02-0.88,1.01c-0.54,0-0.87-0.38-0.87-1.03 c-0.01-2.28-0.01-4.54,0-6.81c0-0.68,0.31-1.03,0.86-1.04c0.57-0.02,0.88,0.36,0.89,1.05V15.51z M23.04,16.26 c-1,0.55-2.04,0.53-3.03-0.07c-1.45-0.87-1.9-3.09-0.96-4.63c0.85-1.38,2.68-1.83,4.07-0.98c1.05,0.65,1.45,1.65,1.47,2.85 C24.56,14.64,24.14,15.66,23.04,16.26z M22.2,12.07c-0.48-0.33-1.1-0.23-1.48,0.23c-0.48,0.57-0.49,1.63-0.01,2.21 c0.37,0.43,1.03,0.55,1.48,0.23c0.46-0.32,0.61-0.8,0.62-1.34C22.8,12.87,22.66,12.4,22.2,12.07z"/></svg>
                <span>Zalo</span>
            </a>
            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $encoded_url; ?>" target="_blank" rel="noopener" class="oo-share-btn oo-share-btn--linkedin" title="Chia sẻ lên LinkedIn">
                <svg viewBox="0 0 24 24" class="oo-share-icon"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.225 0z"/></svg>
                <span>LinkedIn</span>
            </a>
            <button class="oo-share-btn oo-share-btn--copy" onclick="ooCopyPostLink('<?php echo esc_js($post_url); ?>')" title="Sao chép liên kết">
                <svg viewBox="0 0 24 24" class="oo-share-icon"><path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/></svg>
                <span class="oo-copy-text">Sao chép link</span>
            </button>
        </div>
    </div>
    <?php
    return $content . ob_get_clean();
}

// Remove CDN jQuery cookie from header (now loaded via wp_enqueue)
add_action( 'wp_head', 'oneoffice_remove_cdn_jquery_cookie', 1 );
function oneoffice_remove_cdn_jquery_cookie() {
    // No-op: the CDN call in header.php was replaced by wp_enqueue_script above.
    // Header.php no longer contains the CDN <script> tag after Sprint 1 cleanup.
}

/* =============================================================
 * HOME V2 — Wonderland (page template + assets, conditional load)
 * Rollback: xoá dòng require_once dưới đây.
 * ============================================================= */
require_once __DIR__ . '/inc/home-v2-loader.php';

/* =============================================================
 * SCHEMA MARKUP — Organization/LocalBusiness + FAQPage
 * Bổ sung cho Yoast schema (WebSite, WebPage, BreadcrumbList).
 * Rollback: xoá dòng require_once dưới đây.
 * ============================================================= */
require_once __DIR__ . '/inc/schema-markup.php';

/* =============================================================
 * UCHAT — live-chat widget (uhchat.net), nhúng toàn site.
 * Rollback: xoá dòng require_once dưới đây.
 * ============================================================= */
require_once __DIR__ . '/inc/uchat-widget.php';

/* =============================================================
 * COMPANY V3 — 7 trang Thông tin công ty / Liên hệ / Ký gửi.
 * Rollback: xoá dòng require_once dưới đây + chạy ngược script
 * assign template (xem company-v3-loader.php).
 * ============================================================= */
require_once __DIR__ . '/inc/company-v3-loader.php';

/* =============================================================
 * [oo_link path="/..." class="..."]Text[/oo_link]
 * Helper shortcode: resolve URL theo home_url() → an toàn subdir lẫn root.
 * Dùng cho các block UX-Builder/static muốn link nội bộ mà không hardcode '/oneoffice'.
 * ============================================================= */
add_shortcode( 'oo_link', function ( $atts, $content = '' ) {
    $a = shortcode_atts( array( 'path' => '/', 'class' => '', 'target' => '_self' ), $atts );
    $url = esc_url( home_url( $a['path'] ) );
    $cls = $a['class'] ? ' class="' . esc_attr( $a['class'] ) . '"' : '';
    $tgt = $a['target'] !== '_self' ? ' target="' . esc_attr( $a['target'] ) . '" rel="noopener"' : '';
    return '<a href="' . $url . '"' . $cls . $tgt . '>' . do_shortcode( $content ) . '</a>';
} );

/* =============================================================
 * SEO EXTRAS — honeypot chống spam CF7 + đảm bảo 1 H1/bài viết.
 * Rollback: xoá dòng require_once dưới đây.
 * ============================================================= */
require_once __DIR__ . '/inc/seo-extras.php';

/* =============================================================
 * DYNAMIC DOMAIN TRANSLATION FILTER
 * Automatically replaces production domain links with current environment URL
 * ============================================================= */
function oo_clean_chatgpt_wrappers( $content ) {
    if ( empty( $content ) ) {
        return $content;
    }
    
    // Check if there are any ChatGPT-related indicators
    if ( strpos( $content, 'markdown-new-styling' ) === false && 
         strpos( $content, 'TyagGW_' ) === false && 
         strpos( $content, 'text-message' ) === false &&
         strpos( $content, 'flex-col' ) === false &&
         strpos( $content, 'empty:hidden' ) === false &&
         strpos( $content, 'bg-token' ) === false ) {
        return $content;
    }
    
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    
    // Wrap to ensure valid XML and force UTF-8 encoding
    $wrapped_html = '<?xml encoding="utf-8" ?><div>' . $content . '</div>';
    $dom->loadHTML($wrapped_html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_clear_errors();
    
    $xpath = new DOMXPath($dom);
    
    // Find all div elements
    $divs = $xpath->query('//div');
    $div_list = [];
    foreach ($divs as $div) {
        $div_list[] = $div;
    }
    
    // Sort by depth (node path length) descending so we process innermost divs first
    usort($div_list, function($a, $b) {
        return strlen($b->getNodePath()) - strlen($a->getNodePath());
    });
    
    $chatgpt_indicators = [
        'markdown-new-styling',
        'TyagGW_table',
        'TyagGW_',
        'text-message',
        'flex',
        'grow',
        'prose',
        'token-',
        'bg-token',
        'empty:hidden',
        'keyboard-focused',
        'min-h-',
        'rounded-xl',
        'border-gray-'
    ];
    
    foreach ($div_list as $div) {
        // Skip the root wrapper div we added
        if ($div->getNodePath() === '/div') {
            continue;
        }
        
        $class = $div->getAttribute('class');
        $data_message = $div->getAttribute('data-message-id');
        
        $is_chatgpt = false;
        if (!empty($data_message)) {
            $is_chatgpt = true;
        } else {
            foreach ($chatgpt_indicators as $indicator) {
                if (strpos($class, $indicator) !== false) {
                    $is_chatgpt = true;
                    break;
                }
            }
        }
        
        if ($is_chatgpt) {
            if (!$div->parentNode) {
                continue;
            }
            
            // Check if it has meaningful content
            $meaningful_tags = ['img', 'table', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'ul', 'ol', 'li', 'blockquote', 'a', 'hr', 'iframe'];
            $has_meaningful_tags = false;
            foreach ($meaningful_tags as $tag) {
                if ($div->getElementsByTagName($tag)->length > 0) {
                    $has_meaningful_tags = true;
                    break;
                }
            }
            
            $has_text = false;
            if (trim($div->textContent) !== '') {
                $has_text = true;
            }
            
            if ($has_meaningful_tags || $has_text) {
                // Unwrap: replace $div with its children
                $fragment = $dom->createDocumentFragment();
                while ($div->firstChild) {
                    $fragment->appendChild($div->firstChild);
                }
                $div->parentNode->replaceChild($fragment, $div);
            } else {
                // Remove: completely remove the div
                $div->parentNode->removeChild($div);
            }
        }
    }
    
    // Return inner HTML of the wrapper div
    $root_div = $dom->getElementsByTagName('div')->item(0);
    $clean_content = '';
    if ($root_div) {
        foreach ($root_div->childNodes as $child) {
            $clean_content .= $dom->saveHTML($child);
        }
    } else {
        $clean_content = $dom->saveHTML();
    }
    
    return $clean_content;
}
add_filter( 'the_content', 'oo_clean_chatgpt_wrappers', 10 );

function oo_dynamic_internal_links_filter( $content ) {
    if ( empty( $content ) ) {
        return $content;
    }
    $production_domain = 'https://oneoffice.vn';
    $current_domain    = untrailingslashit( home_url() );
    
    // Replace production domain with current domain
    $content = str_replace( $production_domain, $current_domain, $content );
    
    // Also handle http variant of production domain just in case
    $content = str_replace( 'http://oneoffice.vn', $current_domain, $content );
    
    return $content;
}
add_filter( 'the_content', 'oo_dynamic_internal_links_filter', 99 );
add_filter( 'the_excerpt', 'oo_dynamic_internal_links_filter', 99 );
add_filter( 'woocommerce_short_description', 'oo_dynamic_internal_links_filter', 99 );

/**
 * Fix wp-content/uploads URLs that WPML/Polylang incorrectly rewrites
 * by injecting language prefix (e.g. /vi/trang-chu-3/) before /wp-content/.
 * Must run very late (priority 9999) to catch any rewriting that happens after
 * the oo_dynamic_internal_links_filter.
 */
function oo_fix_upload_urls( $content ) {
    if ( empty( $content ) ) {
        return $content;
    }
    // Match any URL where something like /vi/trang-chu-3/ or /vi/ gets inserted
    // between /oneoffice/ (or site base) and /wp-content/uploads/
    // Pattern: /oneoffice/[anything that's NOT wp-content]/wp-content/uploads/
    $content = preg_replace(
        '#(/oneoffice)/(?:vi/)?(?:[^"\'<>\s]+/)*?(wp-content/uploads/)#',
        '$1/$2',
        $content
    );
    return $content;
}
add_filter( 'the_content', 'oo_fix_upload_urls', 9999 );
add_filter( 'the_excerpt', 'oo_fix_upload_urls', 9999 );
add_filter( 'woocommerce_short_description', 'oo_fix_upload_urls', 9999 );

/* Inject inline style directly into file upload input for "dinhkem" on the ky-gui page */
function oo_add_inline_style_to_dinhkem( $content ) {
    if ( strpos( $content, 'name="dinhkem"' ) !== false ) {
        $content = str_replace( 'name="dinhkem"', 'name="dinhkem" style="width: 100%; padding-bottom: 38px;"', $content );
    }
    return $content;
}
add_filter( 'wpcf7_form_elements', 'oo_add_inline_style_to_dinhkem', 10 );



