# Hướng dẫn cấu hình môi trường & Bàn giao (Local vs Production)

Tài liệu này ghi lại các điểm khác biệt cấu hình giữa môi trường phát triển cục bộ (Local) và môi trường thực tế (Production) của dự án **OneOffice.vn** để tham khảo khi triển khai (deploy).

---

## 1. Cấu hình file `wp-config.php`

| Cấu hình | Cục bộ (Local) | Môi trường Thực tế (Production) |
|---|---|---|
| **DB_NAME** | `oneoffice_local` | *Tên database trên Hosting/Server* |
| **DB_USER** | `root` | *Tên user database* |
| **DB_PASSWORD**| *(Để trống)* | *Mật khẩu database* |
| **DB_HOST** | `localhost` | `localhost` hoặc IP MySQL host |
| **WP_HOME** | `http://localhost/oneoffice` | `https://oneoffice.vn` |
| **WP_SITEURL** | `http://localhost/oneoffice` | `https://oneoffice.vn` |

> [!TIP]
> Để tránh sửa trực tiếp `wp-config.php` mỗi lần deploy, bạn có thể viết câu lệnh điều kiện trong `wp-config.php`:
> ```php
> if ( $_SERVER['HTTP_HOST'] === 'localhost' ) {
>     define( 'WP_HOME', 'http://localhost/oneoffice' );
>     define( 'WP_SITEURL', 'http://localhost/oneoffice' );
> } else {
>     define( 'WP_HOME', 'https://oneoffice.vn' );
>     define( 'WP_SITEURL', 'https://oneoffice.vn' );
> }
> ```

---

## 2. Cấu hình file `.htaccess` (Đường dẫn Rewrite URL)

Vì môi trường Local chạy dưới thư mục con `/oneoffice/` còn Production chạy ngay tại gốc tên miền `/`, cấu hình `.htaccess` sẽ khác nhau:

### Cấu hình Local (chạy dưới `/oneoffice/`)
```apache
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteBase /oneoffice/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /oneoffice/index.php [L]
</IfModule>
```

### Cấu hình Production (chạy tại gốc tên miền `/`)
```apache
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
```

---

## 3. Cách thức xử lý Link động (Dynamic URLs)

Để hỗ trợ di chuyển (migrate) mượt mà giữa các môi trường mà không cần chạy lệnh sửa database thủ công:

1. **Header Dropdown Menu**: Code trong `devtung-mvc` đã được chuyển sang hàm `home_url(...)` của WordPress. Link tự động nhận diện đúng `/oneoffice/` khi ở local và `/` khi ở production.
2. **Nội dung bài viết / Sản phẩm**: Đã cấu hình bộ lọc động **Dynamic Domain Translation Filter** ở cuối file `functions.php` của Flatsome Child theme. Bộ lọc này sẽ tự động thay thế `https://oneoffice.vn` thành tên miền hiện tại (`home_url()`) khi render HTML ra trình duyệt. 

> [!NOTE]
> Nhờ bộ lọc động này, bạn không cần lo lắng nếu trong cơ sở dữ liệu vẫn lưu liên kết dạng `https://oneoffice.vn/...` vì khi tải trang trên localhost nó sẽ tự động được dịch thành `http://localhost/oneoffice/...`.

---

## 4. Các bước khôi phục từ bản backup đầy đủ (Full Site Backup)

Khi sử dụng toàn bộ repository này làm bản backup để khôi phục hoặc chuyển đổi sang hosting mới:
1. Tải toàn bộ mã nguồn của kho lưu trữ này lên thư mục gốc của hosting mới.
2. Tạo cơ sở dữ liệu MySQL mới và import file `database/db_backup.sql` thông qua phpMyAdmin hoặc dòng lệnh.
3. Sửa lại các thông số kết nối Database (`DB_NAME`, `DB_USER`, `DB_PASSWORD`, `DB_HOST`) trong file `wp-config.php` để kết nối tới database mới.
4. Cập nhật lại cấu hình `.htaccess` trên host trỏ đúng về gốc `/` (nếu chạy tại gốc tên miền) hoặc thư mục con tương ứng như hướng dẫn ở Mục 2.
5. Truy cập vào trang quản trị admin thông qua đường dẫn bảo mật `/quantri.php`. Vào phần **Cài đặt -> Đường dẫn tĩnh (Settings -> Permalinks)** và bấm **Lưu thay đổi (Save Changes)** để dọn dẹp và tự động thiết lập lại toàn bộ các đường dẫn tĩnh (rewrite rules) tương thích với máy chủ mới.
