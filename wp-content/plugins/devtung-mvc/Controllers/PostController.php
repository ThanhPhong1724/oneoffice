<?php
namespace DevTung\MVC\Controllers;
use DevTung\MVC\Models\PostModel;
use DevTung\MVC\Models\ProductCategoryModel;

class PostController extends BaseController {

    public function __construct() {
        add_shortcode('dt_post_category', [$this, 'category']);
        add_shortcode('dt_post_detail', [$this, 'detail']);
    }
    
    public function index(){
        $data = PostModel::index(); 
        return $this->render('product/index');
    }

    public function category(){
        $data = PostModel::category(12); 
        return $this->render('post/category', $data);
    }

    public function detail() {
        // Lấy bài viết hiện tại
        $post = PostModel::getCurrentPost();

        // Lấy các bài viết liên quan
        $related_posts = PostModel::getRelatedPosts($post->ID ?? 0);

        // Lấy districts (segment URL hoặc query string)
        $tagData = ProductCategoryModel::getDistrictsWithWards();

        // Chuẩn bị dữ liệu để gửi vào View
        $data = [
            'post' => $post,
            'related_posts' => $related_posts,
            'tagData'  => $tagData,
        ];

        return $this->render('post/detail', $data);
    }
}