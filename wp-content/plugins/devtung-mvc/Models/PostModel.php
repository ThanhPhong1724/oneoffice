<?php
namespace DevTung\MVC\Models;

defined('ABSPATH') || exit;

class PostModel {

    public static function index() {
        return [];
    }

    public static function category($limit = 12)
    {
        $category = get_queried_object();

        if (!$category || !isset($category->term_id)) {
            return [];
        }

        // Lấy thông tin cơ bản của category
        $category_data = [
            'id'          => $category->term_id,
            'name'        => $category->name,
            'slug'        => $category->slug,
            'description' => $category->description,
            'link'        => get_category_link($category->term_id),
            'count'       => $category->count,
            // Thumbnail (nếu có plugin/theme hỗ trợ ảnh cho category)
            'thumbnail'   => function_exists('get_term_meta')
                ? get_term_meta($category->term_id, 'thumbnail_id', true)
                : '',
        ];

        if (!empty($category_data['thumbnail'])) {
            $category_data['thumbnail'] = wp_get_attachment_image_url($category_data['thumbnail'], 'medium');
        } else {
            $category_data['thumbnail'] = ''; // fallback
        }

        // Xác định trang hiện tại (hỗ trợ phân trang).
        // Ưu tiên query var 'paged'/'page'; fallback đọc /page/N từ URL.
        $paged = (int) get_query_var('paged');
        if ($paged < 1) {
            $paged = (int) get_query_var('page');
        }
        if ($paged < 1 && !empty($_SERVER['REQUEST_URI'])
            && preg_match('#/page/([0-9]+)#', $_SERVER['REQUEST_URI'], $mm)) {
            $paged = (int) $mm[1];
        }
        if ($paged < 1) {
            $paged = 1;
        }

        // Lấy bài viết trong category theo đúng trang (limit/trang = $limit,
        // trùng posts_per_page của site để khớp số trang với pagination Flatsome).
        $query = new \WP_Query([
            'cat'            => $category->term_id, // 'cat' tự gồm category con
            'posts_per_page' => $limit,
            'paged'          => $paged,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        $post_data = [];
        foreach ($query->posts as $p) {
            $post_data[] = [
                'id'        => $p->ID,
                'title'     => get_the_title($p->ID),
                'link'      => get_permalink($p->ID),
                'thumbnail' => get_the_post_thumbnail_url($p->ID, 'medium'),
                'excerpt'   => get_the_excerpt($p->ID),
                'date'      => get_the_date('d/m/Y', $p->ID),
            ];
        }
        wp_reset_postdata();

        // Gộp category + danh sách bài viết + thông tin phân trang.
        return [
            'category'   => $category_data,
            'posts'      => $post_data,
            'pagination' => [
                'current' => $paged,
                'total'   => (int) $query->max_num_pages,
            ],
        ];
    }


    /* ------------------- Các hàm bổ sung cho Detail Page ------------------- */

    /**
     * Lấy bài viết hiện tại
     */
    public static function getCurrentPost() {
        global $post;
        return $post ?? null;
    }

    /**
     * Lấy các bài viết liên quan theo danh mục
     */
    public static function getRelatedPosts($post_id, $limit = 5) {
        $categories = get_the_category($post_id);
        if (!$categories) return null;

        $category_ids = wp_list_pluck($categories, 'term_id');

        $args = [
            'category__in'       => $category_ids,
            'post__not_in'       => [$post_id],
            'posts_per_page'     => $limit,
            'ignore_sticky_posts'=> 1,
            'no_found_rows'      => true
        ];

        return new \WP_Query($args);
    }

    /**
     * Lấy segment cuối cùng từ URL nếu có ít nhất 2 segment
     */
    public static function getLastUrlSegment() {
        if (!function_exists('dt_get_url_segments')) return null;

        $segments = dt_get_url_segments();
        if (count($segments) >= 2) {
            return end($segments);
        }
        return null;
    }

    /**
     * Lấy danh sách district từ query string filter_location
     */
    public static function getDistrictsFromQuery() {
        $locationParam = sanitize_text_field($_GET['filter_location'] ?? '');
        if (empty($locationParam)) return [];
        $districts = explode(',', $locationParam);
        return array_filter(array_map('trim', $districts));
    }

    /**
     * Tổng hợp districts: ưu tiên segment, fallback query string
     */
    public static function getSelectedDistricts() {
        $district = self::getLastUrlSegment();
        if ($district) return [$district];
        return self::getDistrictsFromQuery();
    }

}
