# Hướng dẫn triển khai (Deploy) OneOffice.vn lên Hosting Production

Tài liệu này ghi lại **toàn bộ quy trình** triển khai dự án OneOffice.vn từ máy cá nhân (local) lên hosting production, bao gồm: kiểm tra trước khi deploy, các bước thực hiện, cấu hình sau khi deploy, và xử lý sự cố.

> **Cập nhật lần cuối:** 2026-06-18

---

## Mục lục

1. [Tổng quan kiến trúc Auto-Detect](#1-tổng-quan-kiến-trúc-auto-detect)
2. [Checklist trước khi Deploy](#2-checklist-trước-khi-deploy)
3. [Hướng dẫn Deploy lên Hosting bằng Git](#3-hướng-dẫn-deploy-lên-hosting-bằng-git)
4. [Cấu hình sau khi Deploy](#4-cấu-hình-sau-khi-deploy)
5. [Xử lý Link động (Dynamic URLs)](#5-xử-lý-link-động-dynamic-urls)
6. [Cấu hình file `.htaccess`](#6-cấu-hình-file-htaccess)
7. [Khôi phục từ bản backup đầy đủ](#7-khôi-phục-từ-bản-backup-đầy-đủ)
8. [Xử lý sự cố (Troubleshooting)](#8-xử-lý-sự-cố-troubleshooting)

---

## 1. Tổng quan kiến trúc Auto-Detect

Dự án đã được thiết kế để **tự động nhận diện** môi trường (Local / Cloudflare Tunnel / Production) — giảm thiểu tối đa việc phải sửa tay file config khi deploy.

### Các cơ chế tự động:

| Thành phần | Cơ chế | File |
|---|---|---|
| **Database credentials** | `$oo_is_local` kiểm tra `$_SERVER['HTTP_HOST']` → dùng DB local hoặc production tương ứng | `wp-config.php` |
| **WP_HOME / WP_SITEURL** | Tự detect protocol (`http`/`https`) + host + subdir (`/oneoffice` nếu có) | `wp-config.php` dòng 120–140 |
| **Internal links trong content** | Bộ lọc `oo_dynamic_internal_links_filter` tự thay `https://oneoffice.vn` → `home_url()` | `functions.php` dòng 1205–1222 |
| **Menu header** | Dùng `home_url(...)` thay vì hardcode URL | Child theme templates |
| **Testimonial images** | Dùng `content_url(...)` thay vì hardcode URL | `template-company-v3.php` |

> [!IMPORTANT]
> Nhờ kiến trúc này, **bạn KHÔNG cần sửa `wp-config.php` khi deploy** — file này tự nhận biết môi trường và dùng thông tin DB phù hợp.

---

## 2. Checklist trước khi Deploy

### ✅ Đã sẵn sàng (không cần làm gì thêm)

- [x] **wp-config.php** — Đã cấu hình auto-detect local/production, thông tin DB production đã được nhúng sẵn (DB: `muneerjohosting_onceoffice_new`, User: `muneerjohosting_onceoffice`)
- [x] **WP_HOME / WP_SITEURL** — Tự detect, không hardcode
- [x] **Menu & template links** — Dùng `home_url()` / `content_url()`, không hardcode localhost
- [x] **Domain filter** — Bộ lọc `oo_dynamic_internal_links_filter` hoạt động cho cả local lẫn production
- [x] **ChatGPT wrapper cleaner** — Filter `oo_clean_chatgpt_wrappers` dọn HTML thừa từ content paste
- [x] **Debug mode** — `WP_DEBUG = false`, `WP_DEBUG_LOG = false` — sẵn sàng cho production
- [x] **Database backup** — File `database/db_backup.sql` đã được export mới nhất (2026-06-18, ~34 MB)
- [x] **.gitignore** — Đã loại trừ cache, logs, file nén lớn, file IDE

### ⚠️ Cần kiểm tra/làm sau khi Deploy

| Việc cần làm | Chi tiết |
|---|---|
| **`.htaccess`** | File trong repo đang cấu hình cho local (`/oneoffice/`). Trên hosting cần đổi thành `/` — xem [Mục 6](#6-cấu-hình-file-htaccess) |
| **Import Database** | Import `database/db_backup.sql` vào DB trên hosting — xem [Mục 4](#4-cấu-hình-sau-khi-deploy) |
| **Permalinks** | Sau khi import DB, vào Settings → Permalinks → Save Changes để flush rewrite rules |
| **SSL Certificate** | Đảm bảo hosting đã cài SSL (HTTPS) — `wp-config.php` tự detect `HTTPS` |
| **File permissions** | `wp-content/uploads/` cần quyền ghi (755 cho thư mục, 644 cho file) |
| **PHP version** | Khuyến nghị PHP 8.0+ (đang dùng trên local) |

### ❌ Các file KHÔNG nên đẩy lên production

Các file sau đã được `.gitignore` loại trừ, nhưng cần lưu ý:

- `scratch/` — thư mục script tạm
- `*.zip`, `*.daf`, `*.tar.gz` — file backup cũ
- `error_log` — file log lỗi
- `.idea/`, `.vscode/`, `.gemini/` — file IDE

---

## 3. Hướng dẫn Deploy lên Hosting bằng Git

### Bước 1: Chuẩn bị trên Hosting (1Panel Terminal)

SSH vào hosting hoặc mở Terminal trên 1Panel, chạy:

```bash
# Di chuyển vào thư mục public_html
cd /home/muneerjohosting/public_html

# ⚠️ SAO LƯU TOÀN BỘ FILE HIỆN TẠI (phòng trường hợp cần rollback)
# Nếu hosting có nút Backup trong 1Panel thì dùng luôn
# Hoặc chạy:
tar -czf /home/muneerjohosting/backup_before_git_$(date +%Y%m%d).tar.gz .

# Kiểm tra git đã cài chưa
git --version
```

### Bước 2: Clone repository lên hosting

**Cách A — Fresh deploy (lần đầu / deploy lại toàn bộ):**

```bash
cd /home/muneerjohosting/public_html

# Xóa hết file cũ bên trong (giữ nguyên thư mục public_html)
# ⚠️ Đảm bảo đã backup ở Bước 1 trước khi chạy lệnh này!
rm -rf ./* ./.[!.]* 2>/dev/null

# Clone repo vào thư mục hiện tại (dấu chấm "." ở cuối)
git clone https://github.com/ThanhPhong1724/oneoffice.git .
```

> [!NOTE]
> Lệnh `git clone ... .` (có dấu chấm) sẽ clone trực tiếp vào thư mục hiện tại thay vì tạo thư mục con.
> Lệnh này **yêu cầu thư mục phải trống** — vì vậy cần `rm -rf` trước.
> Dòng `./.[!.]*` xóa cả file ẩn (như `.htaccess` cũ) nhưng giữ nguyên `.` và `..`.

**Cách B — Cập nhật code (lần sau, đã có git trong thư mục):**

```bash
cd /home/muneerjohosting/public_html

# Pull code mới nhất từ GitHub
git pull origin main
```

> [!TIP]
> **Cách B** rất tiện cho các lần cập nhật sau — chỉ pull thay đổi mới, giữ nguyên file không thuộc git (như ảnh trong `wp-content/uploads/` do user upload trên hosting).


### Bước 3: Đặt quyền file

```bash
cd /home/muneerjohosting/public_html

# Quyền thư mục
find . -type d -exec chmod 755 {} \;

# Quyền file  
find . -type f -exec chmod 644 {} \;

# wp-config.php cần bảo mật hơn
chmod 600 wp-config.php

# quantri.php cần bảo mật  
chmod 600 quantri.php
```

---

## 4. Cấu hình sau khi Deploy

### 4.1. Import Database

**Qua Terminal (SSH):**
```bash
mysql -u muneerjohosting_onceoffice -p'KM;kxx42onx{51&' muneerjohosting_onceoffice_new < /home/muneerjohosting/public_html/database/db_backup.sql
```

**Hoặc qua 1Panel → Quản lý MySQL:**
1. Mở menu **Quản lý MySQL** trên sidebar
2. Chọn database `muneerjohosting_onceoffice_new`
3. Import file `database/db_backup.sql`

> [!CAUTION]
> Import database sẽ **GHI ĐÈ** toàn bộ dữ liệu cũ trên hosting! Hãy backup DB hiện tại trên hosting trước.

### 4.2. Cập nhật `.htaccess`

File `.htaccess` trong repo đang cấu hình cho local (thư mục con `/oneoffice/`). Trên hosting cần đổi thành gốc `/`:

```bash
cd /home/muneerjohosting/public_html
cat > .htaccess << 'EOF'
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress
EOF
```

### 4.3. Flush Permalinks

1. Truy cập **`https://oneoffice.vn/quantri.php`** → đăng nhập admin
2. Vào **Cài đặt → Đường dẫn tĩnh (Settings → Permalinks)**
3. Bấm **Lưu thay đổi (Save Changes)** — không cần đổi gì, chỉ cần bấm Save

### 4.4. Kiểm tra sau deploy

| Kiểm tra | URL | Kỳ vọng |
|---|---|---|
| Trang chủ | `https://oneoffice.vn/` | Hiển thị đúng layout Home V2 |
| Danh mục VP | `https://oneoffice.vn/cho-thue-van-phong-ha-noi/` | Grid sản phẩm hiển thị, filter hoạt động |
| Chi tiết tòa nhà | `https://oneoffice.vn/cho-thue-van-phong-ha-noi/coninco-tower/` | Gallery, tabs, thông tin hiển thị |
| Tin tức | `https://oneoffice.vn/tin-tuc/` | Danh sách bài viết, responsive mobile |
| Thông tin công ty | `https://oneoffice.vn/thong-tin-cong-ty/` | Layout Company V3, chữ lead căn giữa |
| Khách hàng | `https://oneoffice.vn/khach-hang-du-an-tieu-bieu/` | Logo grid + testimonial slider |
| Liên hệ | `https://oneoffice.vn/lien-he/` | Form CF7 gửi được |
| Admin | `https://oneoffice.vn/quantri.php` | Đăng nhập dashboard |

---

## 5. Xử lý Link động (Dynamic URLs)

### Cơ chế hoạt động

Để hỗ trợ di chuyển (migrate) mượt mà giữa các môi trường mà không cần chạy lệnh sửa database thủ công:

1. **Header Dropdown Menu**: Code trong child theme đã được chuyển sang hàm `home_url(...)` của WordPress. Link tự động nhận diện đúng `/oneoffice/` khi ở local và `/` khi ở production.

2. **Nội dung bài viết / Sản phẩm**: Đã cấu hình bộ lọc động **Dynamic Domain Translation Filter** ở cuối file `functions.php` của Flatsome Child theme. Bộ lọc này sẽ tự động thay thế `https://oneoffice.vn` thành tên miền hiện tại (`home_url()`) khi render HTML ra trình duyệt.

3. **Ảnh testimonial**: Dùng `content_url('/uploads/...')` thay vì hardcode URL localhost — tự động đúng trên mọi môi trường.

> [!NOTE]
> Nhờ bộ lọc động này, bạn không cần lo lắng nếu trong cơ sở dữ liệu vẫn lưu liên kết dạng `https://oneoffice.vn/...` vì khi tải trang trên localhost nó sẽ tự động được dịch thành `http://localhost/oneoffice/...`.

---

## 6. Cấu hình file `.htaccess`

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

> [!TIP]
> Sau khi sửa `.htaccess` trên hosting, vào **Settings → Permalinks → Save Changes** để WordPress tự tạo lại đúng cấu hình.

---

## 7. Khôi phục từ bản backup đầy đủ (Full Site Backup)

Khi sử dụng toàn bộ repository này làm bản backup để khôi phục hoặc chuyển đổi sang hosting mới:

1. Clone hoặc tải toàn bộ mã nguồn của kho lưu trữ này lên thư mục gốc `public_html` của hosting mới.
2. Tạo cơ sở dữ liệu MySQL mới và import file `database/db_backup.sql` qua phpMyAdmin hoặc dòng lệnh.
3. Sửa lại các thông số kết nối Database (`DB_NAME`, `DB_USER`, `DB_PASSWORD`, `DB_HOST`) trong nhánh `else` (production) của file `wp-config.php` (dòng 43–52).
4. Cập nhật lại cấu hình `.htaccess` trên host trỏ đúng về gốc `/` (nếu chạy tại gốc tên miền) — xem Mục 6.
5. Truy cập vào trang quản trị admin qua đường dẫn bảo mật `/quantri.php`. Vào **Cài đặt → Đường dẫn tĩnh (Settings → Permalinks)** và bấm **Lưu thay đổi (Save Changes)**.

---

## 8. Xử lý sự cố (Troubleshooting)

### 8.1. Trang trắng / lỗi 500

```bash
# Kiểm tra log lỗi PHP
tail -50 /home/muneerjohosting/public_html/error_log

# Tạm bật debug để xem lỗi chi tiết (sửa wp-config.php):
# define( 'WP_DEBUG', true );
# define( 'WP_DEBUG_LOG', true );
# define( 'WP_DEBUG_DISPLAY', true );
# → Sau khi fix xong nhớ tắt lại!
```

### 8.2. Lỗi 404 trên tất cả trang (trừ trang chủ)

**Nguyên nhân:** `.htaccess` chưa đúng hoặc `mod_rewrite` chưa bật.

**Cách sửa:**
1. Kiểm tra file `.htaccess` đúng cấu hình Production (xem Mục 6)
2. Vào **Settings → Permalinks → Save Changes** để flush rewrite rules
3. Nếu vẫn lỗi: liên hệ hosting bật `mod_rewrite` cho Apache

### 8.3. Ảnh không hiển thị

**Nguyên nhân 1:** Thư mục `wp-content/uploads/` chưa được copy lên.
```bash
# Kiểm tra thư mục uploads có tồn tại và có file không
ls -la /home/muneerjohosting/public_html/wp-content/uploads/
```

**Nguyên nhân 2:** Link ảnh trong database vẫn trỏ localhost.
→ Bộ lọc `oo_dynamic_internal_links_filter` trong `functions.php` tự xử lý việc này cho content. Nhưng nếu ảnh nằm trong widget/option, có thể cần chạy search-replace:
```bash
# Trên hosting có WP-CLI:
wp search-replace 'http://localhost/oneoffice' 'https://oneoffice.vn' --all-tables --skip-columns=guid
```

### 8.4. Không truy cập được `/quantri.php`

Kiểm tra quyền file:
```bash
ls -la /home/muneerjohosting/public_html/quantri.php
# Phải có quyền đọc: -rw-------  (600) hoặc -rw-r--r-- (644)
```

### 8.5. Form CF7 không gửi được

1. Kiểm tra plugin **Contact Form 7** đã active
2. Kiểm tra **WP Mail SMTP** hoặc cấu hình SMTP server trên hosting
3. Kiểm tra **Flamingo** plugin nếu muốn lưu form submissions

---

## Phụ lục: Thông tin Hosting hiện tại

| Thông tin | Giá trị |
|---|---|
| **Panel** | 1Panel v3.8.68 |
| **URL Panel** | `onehost-amdcloudhn042501.000nethost.com:2023` |
| **Document Root** | `/home/muneerjohosting/public_html` |
| **DB Name** | `muneerjohosting_onceoffice_new` |
| **DB User** | `muneerjohosting_onceoffice` |
| **Git Repo** | `https://github.com/ThanhPhong1724/oneoffice.git` |
| **Branch** | `main` |
| **Domain** | `oneoffice.vn` |
