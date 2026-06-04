# Home V2 — Tóm tắt triển khai & hướng dẫn duyệt

## 1. Hướng đã chọn
**Option B2** — Page Template PHP custom trong `flatsome-child`.

- Trade-off so với 2 option spec: lai giữa A (full control HTML/CSS) và B (chạy trong WP context) — chọn vì cho UI đẹp ngang A, **không cần port**, an toàn nhất.
- Decision matrix chi tiết: xem [_home_v2_option_evaluation.md](./_home_v2_option_evaluation.md).

## 2. File đã tạo / sửa

| File | Trạng thái | Mô tả |
|---|---|---|
| `page-templates/template-home-v2.php` | mới | Template với 10 section, data động từ DB |
| `assets/css/home-v2.css` | mới | CSS scoped `.home-v2` — tokens, responsive |
| `assets/js/home-v2.js` | mới | Vanilla JS — reveal, counter, testi slider |
| `inc/home-v2-loader.php` | mới | Đăng ký template + enqueue có điều kiện |
| `functions.php` | sửa 1 dòng | Thêm `require_once __DIR__ . '/inc/home-v2-loader.php';` ở cuối file |
| `_home_v2_inventory.md` | mới | Content inventory 3 bảng |
| `_home_v2_option_evaluation.md` | mới | Decision matrix + lý do chọn |
| `_home_v2_backups/page-233-and-blocks-*.sql` | mới | Backup page 233 + blocks 554/557/771 (chỉ export, không ghi đè) |

**KHÔNG sửa:**
- Parent theme Flatsome ❌
- Page 233 (Trang chủ cũ) ❌
- Option `page_on_front` ❌
- Permalink / taxonomy / product slug ❌
- Plugin / WordPress core ❌

## 3. Nội dung lấy từ source hiện tại

Mọi text/ảnh đều có nguồn từ DB. Chi tiết mapping ở `_home_v2_inventory.md`:

- Hero H1 & CTA → biên tập từ section banner page 233
- 8 khu vực + ảnh + link → section address page 233 (đúng image IDs 783, 787, 789, 791, 794, 798, 1869, 1870)
- 3 lý do 500+/6000+/10+ → section reason page 233
- 6 bước quy trình → block 771
- 5 testimonial → section feedback page 233 (rút gọn, giữ tên/chức danh/công ty/ảnh)
- 5 nhân sự đội ngũ → block 554
- 35 logo khách hàng → section customer page 233 (đúng gallery IDs 944-1090)
- 3 CTA cuối → block 557
- Hotline `0966 68 1616` → block 771
- 6 tòa nhà nổi bật → `WP_Query post_type=product` (lấy động, không hard-code)

## 4. Nội dung placeholder — cần khách duyệt / cung cấp

| Mục | Trạng thái |
|---|---|
| Form tư vấn nhanh (Quick consult) | UI có, submit chuyển `/lien-he/` qua query string — **cần khách cấu hình backend form** (Telegram/Email/CRM) |
| Sub-headline hero | Đã ghép từ B2 + B4 nguồn DB — **cần khách approve wording** |
| Hero background image | Đang dùng image ID 883 (đã verify có sẵn tại `/2020/12/03.jpg`) — fallback đã setup nếu thiếu |
| Stats trong hero (500+/6000+/10+) | Lấy từ section "reason" (đã có sẵn trong source) — không bịa số mới |
| Wording tòa nhà nổi bật | Lấy động 6 product mới nhất — nếu muốn fix list cụ thể, đổi `WP_Query` trong template |

## 5. URL test

| URL | Mục đích | Kết quả |
|---|---|---|
| `http://localhost/oneoffice/trang-chu-v2/` | Home V2 (new) | ✅ Render tốt cả 3 viewport |
| `http://localhost/oneoffice/` | Trang chủ cũ (233) | ✅ Nguyên vẹn, H1 cũ còn |
| `http://localhost/oneoffice/product/toa-nha-hang-a/taisei-square-ha-noi/` | Product page | ✅ home-v2 CSS KHÔNG load (scoping đúng) |
| `http://localhost/oneoffice/tin-tuc/` | News archive | ⚠️ Trả 404 — issue có sẵn của site (không phải do home-v2) |

## 6. Kết quả test Playwright

| Viewport | Overflow | Images | Console errors (do home-v2) | File screenshot |
|---|---|---|---|---|
| 1440×900 Desktop | ✅ Không | 62/62 OK | 0 | `homev2-desktop-1440-v3.jpg` |
| 768×1024 Tablet | ✅ Không (753 < 768) | 62/62 OK | 0 | `homev2-tablet-768.jpg` |
| 390×844 Mobile | ✅ Không (375 < 390) | 63/63 OK | 0 | `homev2-mobile-390.jpg` |
| Mobile menu | ✅ Nền trắng rõ, không xuyên nền | — | 0 | `homev2-mobile-menu.jpg` |

3 errors duy nhất trong console là **Roboto font 404** với URL hardcode hosting cũ (`muneerjohosting`) — issue có sẵn của parent Flatsome, không liên quan home-v2 và KHÔNG xử lý trong scope này theo nguyên tắc an toàn (không sửa parent theme).

Screenshot tại: thư mục root project `E:\oneoffice\homev2-*.jpg`.

## 7. Bước duyệt trước khi set V2 thành homepage

1. **Xem trực tiếp** `http://localhost/oneoffice/trang-chu-v2/` — duyệt giao diện trên desktop + tablet + mobile.
2. **Cho ý kiến** từng section: muốn giữ/đổi/thêm/bớt phần nào.
3. **Cung cấp nội dung còn thiếu** (xem mục 4 — đặc biệt là backend form + approve wording sub-headline).
4. **Khi đã duyệt OK**, để set V2 thành trang chủ chính, chạy 1 trong 2:
   - **Cách 1 (wp-admin):** Settings → Reading → "Your homepage displays: A static page" → Homepage chọn "Trang chủ V2" → Save.
   - **Cách 2 (SQL):** `UPDATE tlq_options SET option_value=5217 WHERE option_name='page_on_front';`

## 8. Cách rollback hoàn toàn

```sql
-- 1. Xoá page V2 trong wp-admin (Pages → Trash → Delete permanently)
--    hoặc SQL:
DELETE FROM tlq_postmeta WHERE post_id = 5217;
DELETE FROM tlq_posts WHERE ID = 5217;
```

Xoá các file:
- `flatsome-child/page-templates/template-home-v2.php`
- `flatsome-child/assets/css/home-v2.css`
- `flatsome-child/assets/js/home-v2.js`
- `flatsome-child/inc/home-v2-loader.php`

Trong `flatsome-child/functions.php`, xoá block (cuối file):
```php
/* HOME V2 — Wonderland (...) */
require_once __DIR__ . '/inc/home-v2-loader.php';
```

Backup page 233 + blocks tại `flatsome-child/_home_v2_backups/page-233-and-blocks-*.sql`.

## 9. Có thể iterate tiếp ở đâu

- Tinh chỉnh CSS: `assets/css/home-v2.css` (CSS variables ở `:root` của `.home-v2`)
- Đổi nội dung text/ảnh: `page-templates/template-home-v2.php` — phần đầu file là PHP arrays `$oo_districts`, `$oo_reasons`, `$oo_process`, `$oo_testimonials`, `$oo_team`, `$oo_final_cta`
- Đổi số lượng tòa nhà nổi bật: sửa `posts_per_page` trong `WP_Query` cuối phần data
- Đổi animation/slider: `assets/js/home-v2.js`
