# Flatsome Child — OneOffice (Wonderland Việt Nam)

Child theme tùy biến trên theme cha **Flatsome**. **Mọi tùy biến nằm trong child theme — không sửa parent.**

> 👤 **Admin / quản trị nội dung:** đọc **[`_HUONG-DAN-QUAN-TRI.md`](_HUONG-DAN-QUAN-TRI.md)** (đổi SĐT, email, chat, form, SEO, go-live).
> 👨‍💻 File README này dành cho **lập trình viên**.

---

## 1. Page templates V2 (PHP thuần — render trực tiếp, KHÔNG dùng UX Builder)

| File | Trang | Ghi chú |
|---|---|---|
| `page-templates/template-home-v2.php` | Trang chủ (page **233**) | Hero + counter, lý do, quy trình, tòa nhà nổi bật, testimonial, đội ngũ, KH, CTA |
| `page-templates/template-vptg-v2.php` | Văn phòng trọn gói (page **751**) | Loại hình VP, lý do, FAQ |

Template **bỏ qua `post_content`** (render từ mảng PHP). `post_content` được thay bằng "SEO mirror" để Yoast đọc — backup gốc ở postmeta `_oo_v2_original_content`.

## 2. inc/ — mỗi file 1 chức năng (require trong `functions.php`)

| File | Chức năng | Rollback |
|---|---|---|
| `home-v2-loader.php` | Đăng ký template V2, enqueue CSS/JS có điều kiện, nạp font **Plus Jakarta Sans**, CSS single-product | xóa dòng require |
| `schema-markup.php` | Schema **LocalBusiness** (home) + **FAQPage** (VPTG) + **Article** (bài viết) | xóa require / hàm tương ứng |
| `uchat-widget.php` | Nhúng **UChat** live chat (uhchat.net) vào footer | xóa dòng require |
| `seo-extras.php` | **Honeypot** chống spam CF7 + đảm bảo **1 H1/bài viết** | xóa dòng require |

## 3. assets/

- **CSS:** `home-v2.css`, `vptg-v2.css`, `single-product-v2.css` (V2) · `sprint1.css`, `main.css`, `single-page.css` (chung)
- **JS:** `home-v2.js` (reveal on scroll + counter số liệu + testimonial slider) · `vptg-v2.js` · `custom.js` (popup báo giá product + tinh chỉnh product) · `sprint1.js`

## 4. Tích hợp ngoài theme (cần biết khi bảo trì)

- **Form CF7** gửi mail qua plugin **WP Mail SMTP** (Gmail) → `yasuaola@gmail.com`. 3 form: 286 (Liên hệ), 601 (Báo giá popup), 465 (Ký gửi).
- **Popup "Nhận báo giá"** trên trang sản phẩm = `[contact-form-7 id="601"]` trong `wp-content/plugins/devtung-mvc/Views/product/detail.php` (backup: `detail.php.oo-bak` cùng thư mục).
- **`robots.txt`** ở webroot gốc (`E:\oneoffice\robots.txt`).

## 5. Backup / rollback (DB postmeta + file)

| Backup | Nội dung |
|---|---|
| `_oo_v2_original_content` (postmeta 233/751) | shortcode gốc trước SEO mirror |
| `_oo_cf7_form_backup` / `_oo_cf7_props_backup` (postmeta 601…) | form CF7 gốc |
| `_oo_backup_kirki_fonts` (option) | option font Kirki gốc |
| `_home_v2_backups/*.sql` | dump post_content page 233/751 |
| `detail.php.oo-bak` | bản tĩnh popup trước khi đổi shortcode |
| `_dev-notes/` | ghi chú quá trình dev (lưu trữ) |
