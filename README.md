# OneOffice — Wonderland Việt Nam (WordPress Full Site Backup)

Kho lưu trữ này chứa bản **backup toàn bộ website** OneOffice.vn (cho thuê văn phòng). Mã nguồn đã được cấu hình đầy đủ và tối ưu hóa để có thể tải lên một hosting trống và chạy được ngay.

---

## 📦 Cấu trúc Kho lưu trữ (Repository)

Bản backup này bao gồm đầy đủ các thành phần cần thiết để chạy website:
* **WordPress Core**: Toàn bộ mã nguồn cốt lõi của WordPress (thư mục root, `wp-admin`, `wp-includes`).
* **Themes**:
  * `wp-content/themes/flatsome`: Theme gốc Flatsome (bắt buộc).
  * `wp-content/themes/flatsome-child`: Theme con chứa các giao diện tùy biến (Trang chủ V2, VPTG V2, CSS, bộ lọc động...).
* **Plugins**: Toàn bộ các plugin đang kích hoạt trên trang web, bao gồm:
  * `wp-content/plugins/devtung-mvc`: Plugin tùy biến xử lý MVC, sản phẩm, và popup báo giá.
  * Các plugin thiết yếu khác (WooCommerce, Contact Form 7, ACF, Yoast SEO, W3 Total Cache...).
* **Uploads (`wp-content/uploads/`)**: Toàn bộ hình ảnh, tài liệu và media của website.
* **Database (`database/db_backup.sql`)**: Bản xuất (dump) cơ sở dữ liệu MySQL hoàn chỉnh, chứa toàn bộ cấu hình, bài viết, sản phẩm, và cài đặt trang web.
* **Cấu hình & Tệp tin bổ sung**:
  * `wp-config.php`: File cấu hình kết nối database và URL động.
  * `quantri.php`: Trang đăng nhập admin tùy biến (đã đổi tên từ `wp-login.php` để tăng bảo mật).
  * `.htaccess` & `robots.txt`: Cấu hình máy chủ Apache/LiteSpeed và chỉ dẫn robot tìm kiếm.
  * `googled4e04d17cbcca548.html`: File xác thực Google Search Console.

---

## 🚀 Hướng dẫn khôi phục (Restore) trên Hosting trống

Để khôi phục toàn bộ website trên một hosting mới hoàn toàn, bạn hãy thực hiện theo các bước sau:

### Bước 1: Tải mã nguồn lên Hosting
1. Nén hoặc tải trực tiếp toàn bộ thư mục của repository này lên thư mục gốc của hosting (thường là `public_html` hoặc `private_html`).
2. Giải nén (nếu tải lên dạng file nén).

### Bước 2: Tạo và nhập Database (Cơ sở dữ liệu)
1. Truy cập vào trang quản trị hosting (cPanel, DirectAdmin...) và tạo một cơ sở dữ liệu MySQL mới cùng một User có toàn quyền truy cập cơ sở dữ liệu đó.
2. Mở công cụ **phpMyAdmin**, chọn cơ sở dữ liệu vừa tạo.
3. Chọn thẻ **Import (Nhập)**, chọn đường dẫn đến file `database/db_backup.sql` trong mã nguồn và bấm thực hiện (Go) để khôi phục toàn bộ bảng và dữ liệu.

### Bước 3: Cấu hình file `wp-config.php`
Mở file `wp-config.php` trong thư mục gốc và sửa lại thông tin kết nối database tương ứng với hosting mới:
```php
define('DB_NAME', 'ten_database_cua_ban');
define('DB_USER', 'user_database_cua_ban');
define('DB_PASSWORD', 'mat_khau_database_cua_ban');
define('DB_HOST', 'localhost'); // Thường là localhost
```

### Bước 4: Cấu hình URL và `.htaccess`
* **Nhận diện URL tự động**: Trong `wp-config.php` đã có sẵn logic nhận diện URL động để chạy tốt trên cả localhost lẫn domain chính thức.
* **Đường dẫn con (Subfolder) vs Gốc tên miền (Root)**:
  * Nếu chạy website tại **gốc tên miền** (ví dụ `https://domain.com/`), hãy đảm bảo file `.htaccess` có giá trị `RewriteBase /` và `RewriteRule . /index.php`.
  * Chi tiết cấu hình `.htaccess` vui lòng xem trong tài liệu [deploy_guide.md](deploy_guide.md).

### Bước 5: Hoàn tất cấu hình trong Admin
1. Truy cập vào trang quản lý admin của bạn thông qua đường dẫn tùy biến: `https://ten-mien-cua-ban.com/quantri.php` (tên tài khoản và mật khẩu admin giống như ở môi trường cũ).
2. Vào phần **Cài đặt -> Đường dẫn tĩnh (Settings -> Permalinks)**.
3. Nhấp chọn **Lưu thay đổi (Save Changes)** để WordPress tự động cập nhật lại toàn bộ rewrite rules trên máy chủ mới.

---

## 🔒 Khuyến cáo Bảo mật
* **Tuyệt đối KHÔNG** công khai repository này ở chế độ công cộng (Public) trên Github/Gitlab vì file `wp-config.php` và `database/db_backup.sql` chứa các thông tin bảo mật nhạy cảm. Hãy luôn đặt repository ở chế độ **Riêng tư (Private)**.
* Sau khi deploy lên hosting thật, hãy tạo lại các khóa muối bảo mật (Authentication Unique Keys and Salts) trong `wp-config.php` để tăng cường bảo mật cho các phiên đăng nhập.
