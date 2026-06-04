<?php
namespace DevTung\MVC\Services;

use DevTung\MVC\Models\ProductCategoryModel;
use DevTung\MVC\Models\ProductModel;

class ProductService {

    public static function formData() {
        // 1. Ô tìm kiếm
        $formData['searchTerm'] = !empty($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

        // 2. Dropdown Khu vực
        $formData['districts'] = ProductCategoryModel::getDistrictsWithWards();
        // dd($formData['districts']);

        // Lấy danh sách quận đã chọn
        $formData['selectedDistricts'] = [];

        $segments = dt_get_url_segments(); // ví dụ: ['cho-thue-van-phong-ha-noi', 'hoan-kiem', 'phuong-ha']

        $formData['selectedDistricts'] = [];

        // Chỉ lấy segment cuối nếu có ít nhất 2 segment
        if (count($segments) >= 2) {
            $formData['selectedDistricts'] = [end($segments)];
        }
        // Nếu không đủ segment → lấy từ query string
        else {
            $locationParam = sanitize_text_field($_GET['filter_location'] ?? '');
            if (!empty($locationParam)) {
                $districts = explode(',', $locationParam);
                $formData['selectedDistricts'] = array_filter(array_map('trim', $districts));
            }
        }

        
        // 3. Dropdown Giá
        $formData['minPrice'] = isset($_GET['min_price']) ? intval($_GET['min_price']) : 0;
        $formData['maxPrice'] = isset($_GET['max_price']) ? intval($_GET['max_price']) : 100;

        // 4. Dropdown Hạng
        $formData['ranks'] = ProductCategoryModel::getByType('rank');

        // Xử lý selectedRanks tương tự selectedDistricts
        $formData['selectedRanks'] = [];

        $segments = dt_get_url_segments();

        // Ưu tiên URL segment
        if (isset($segments[1]) && !empty($segments[1])) {
            $formData['selectedRanks'] = [$segments[1]];
        }

        // Nếu không có segment → lấy từ query string
        else {
            $rankParam = sanitize_text_field($_GET['filter_rank'] ?? '');

            if (!empty($rankParam)) {
                $formData['selectedRanks'] = array_filter(
                    array_map('trim', explode(',', $rankParam))
                );
            }
        }


        return $formData;
    }

    public static function districtData(){
        return ProductCategoryModel::getDistrictData();
    }

    public static function getBuildingWithFilter($formData){
        return ProductModel::getBuildingWithFilter($formData);
    }
    

}
