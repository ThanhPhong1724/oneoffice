# VPTG V2 — Văn phòng trọn gói — Tóm tắt triển khai

> Phiên bản mới của trang `/van-phong-tron-goi/` — làm cùng pattern Option B2 với Home V2.

## 1. Hướng & file

| File | Trạng thái |
|---|---|
| `page-templates/template-vptg-v2.php` | mới — 8 section |
| `assets/css/vptg-v2.css` | mới — scoped `.vptg-v2` |
| `assets/js/vptg-v2.js` | mới — vanilla JS (reveal + smooth scroll + FAQ accordion) |
| `inc/home-v2-loader.php` | refactor — quản lý nhiều template qua registry (Home V2 + VPTG V2) |
| `_inventory_vptg_content.txt` | mới — dump nội dung gốc page 751 |
| `_home_v2_backups/page-751-vptg-*.sql` | mới — backup page 751 |

Page mới: **ID 5218**, slug `van-phong-tron-goi-v2`. URL: `http://localhost/oneoffice/van-phong-tron-goi-v2/`.

Page gốc 751 (slug `van-phong-tron-goi`) **không bị động chạm** — vẫn hiển thị Flatsome shortcode cũ.

## 2. Cấu trúc trang (8 section)

1. **Hero** — bg image 767 (`van-phong-tron-goi-tai-ha-noi.jpg` đã verify exist), H1 ghép từ "Tìm văn phòng trọn gói, văn phòng ảo phù hợp" (page 751), 2 CTA (gọi tư vấn + xem loại), 3 stats `100+ địa điểm · 50+ thương hiệu · 5 phân khúc`
2. **Quick consult form** — 4 field (loại / khu vực / số chỗ / phone) — submit redirect `/lien-he/`
3. **3 loại văn phòng** — VPTG / Văn phòng ảo / Coworking — mỗi card có icon SVG, lead, mô tả ngắn, 4 features bullets, CTA "Nhận tư vấn loại này"
4. **Intro section** — image bên phải + badge "15+ năm kinh nghiệm", title "Văn phòng trọn gói tại Hà Nội"
5. **3 lý do chọn Wonderland** — dark teal bg, 3 card glass-morphism (50+, 100+, 1000+)
6. **6 bước quy trình** — reuse pattern Home V2, biên tập wording riêng cho VPTG
7. **FAQ 7 items** — native `<details>` + JS auto-close khác item, lấy nguyên 7 accordion từ block gốc, có ul/ol/strong format
8. **Final CTA** — 3 actions: Gọi / Zalo / Gửi yêu cầu

## 3. Nội dung lấy từ source

| Mục | Nguồn |
|---|---|
| H1 hero | page 751 section `searchtrongoi` (biên tập gọn) |
| Mô tả hero | ghép từ "Startup, doanh nghiệp vừa & nhỏ" gốc + "50+ thương hiệu Co-working" gốc |
| 3 stats hero | "100 địa điểm, 50 thương hiệu, 5 phân khúc" — câu mở section info gốc |
| 3 loại VP — mô tả & features | rút gọn từ 7 accordion FAQ gốc về VPTG / VP ảo / Coworking |
| 3 lý do Wonderland | giữ nguyên 3 đề mục "Nhiều lựa chọn / Giải pháp tối ưu / Dịch vụ chuyên nghiệp" + rút gọn mô tả |
| Quy trình 6 bước | reuse pattern Home V2 (block 771), biên tập wording phù hợp VPTG |
| 7 FAQ | giữ nguyên format gốc (h3/h4/p/ul) |
| Hotline `0966 68 1616`, Zalo | nguồn từ contact info chung của site |

## 4. Placeholder — cần khách

- **Quick form backend** — gốc dùng `[contact-form-7 id="601"]` + `[ux_sidebar id="sidebar-footer-1"]`. V2 redirect tạm `/lien-he/` với query string.
- **Wording sub-headline** — đã ghép từ source, cần khách approve.

## 5. Kết quả test Playwright

| Viewport | Overflow | Images | Console (do VPTG) | Screenshot |
|---|---|---|---|---|
| 1440×900 Desktop | ✅ Không (1425<1440) | 9/9 OK | 0 | `vptgv2-desktop-1440.jpg` |
| 768×1024 Tablet | ✅ Không (753<768) | 9/9 OK | 0 | `vptgv2-tablet-768.jpg` |
| 390×844 Mobile | ✅ Không (375<390) | 10/10 OK | 0 | `vptgv2-mobile-390.jpg` |

URL verify:
- ✅ `/van-phong-tron-goi-v2/` — V2 render OK
- ✅ `/van-phong-tron-goi/` — page 751 gốc nguyên vẹn, vptg-v2 CSS KHÔNG load, section `.searchtrongoi` còn nguyên
- ✅ Trang chủ V2 + Trang chủ 233 — không bị ảnh hưởng

3 errors console legacy Roboto font (URL hardcode hosting cũ) — đã có sẵn, không liên quan VPTG.

## 6. Rollback

Xoá page 5218 trong wp-admin (hoặc SQL `DELETE FROM tlq_posts WHERE ID=5218; DELETE FROM tlq_postmeta WHERE post_id=5218;`).
Xoá file:
- `flatsome-child/page-templates/template-vptg-v2.php`
- `flatsome-child/assets/css/vptg-v2.css`
- `flatsome-child/assets/js/vptg-v2.js`

Trong `inc/home-v2-loader.php` xoá entry `'page-templates/template-vptg-v2.php' => array(...)` khỏi `oo_child_templates_registry()`.

Page 751 giữ nguyên — không cần restore.

## 7. Bước duyệt trước khi thay thế page 751

1. Mở `/van-phong-tron-goi-v2/` xem trên 3 viewport.
2. Approve wording + cấu hình backend form.
3. Khi OK, có 2 cách thay thế:
   - **Cách an toàn:** đổi menu link "Văn phòng trọn gói" trỏ về `/van-phong-tron-goi-v2/` (không đổi slug, không động page 751). Nhược: URL sẽ là `/van-phong-tron-goi-v2/`.
   - **Cách giữ URL gốc:** đổi slug page 751 sang `van-phong-tron-goi-old` rồi đổi slug page 5218 sang `van-phong-tron-goi`. Có rủi ro permalink/SEO — cần backup + redirect.

## 8. Lưu ý quan trọng về UX Builder

Page V2 **không edit được qua UX Builder** (giống Home V2) vì `post_content` rỗng — render PHP template.

Cách edit:
- Text/ảnh: sửa các PHP array đầu file `template-vptg-v2.php` (`$oo_vptg_types`, `$oo_vptg_reasons`, `$oo_vptg_process`, `$oo_vptg_faqs`...)
- Style: sửa `assets/css/vptg-v2.css` (CSS variables ở `:root` của `.vptg-v2`)
- Animation/FAQ behavior: sửa `assets/js/vptg-v2.js`
