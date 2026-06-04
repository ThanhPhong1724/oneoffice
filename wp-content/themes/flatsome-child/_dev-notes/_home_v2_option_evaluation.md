# Home V2 — Đánh giá Option A vs Option B

## OPTION A — Prototype HTML/CSS tĩnh

**Mô tả:** Dựng prototype tĩnh dạng `index.html` + CSS/JS thuần trong `flatsome-child/_prototype/home-v2/`. Sau khi duyệt mới port sang Flatsome/WordPress.

| Tiêu chí | Đánh giá | Điểm /10 |
|---|---|---|
| Ưu điểm | Full control design, iterate cực nhanh, không bị Flatsome quirk chèn ngang, dễ test responsive | 9 |
| Nhược điểm | **Phải port lại 100%** sang WP/Flatsome → mất công gấp đôi; nội dung trong HTML là tĩnh, không lấy động từ DB → khi port phải map lại; testing trên localhost không có WP context (header/footer/menu/CSS Flatsome đã load → khác môi trường thật) | 4 |
| Rủi ro | Cao — port có thể vỡ layout do conflict với CSS Flatsome (`section`, `.row`, `.col` của Flatsome có CSS riêng), animation/hover lúc port có thể mất | 4 |
| Khả năng ra UI đẹp | Rất cao | 10 |
| Khả năng port sang Flatsome | Phức tạp — vì shortcode Flatsome có giới hạn (vd: `[ux_banner]` không hỗ trợ form, không hỗ trợ multi-card layout phức tạp) | 4 |
| Mức an toàn | Cao (file tĩnh không động chạm WP) | 9 |
| Thời gian triển khai | 2 lần công: prototype + port | 4 |
| Khả năng rollback | Dễ — xoá file `_prototype/` | 10 |
| **Tổng** |   | **54** |

---

## OPTION B — Trang chủ V2 trực tiếp trong WordPress/Flatsome

**Mô tả:** Backup page 233 → tạo page mới `trang-chu-v2` (slug `/trang-chu-v2/`) → dựng layout trong môi trường WordPress thật. Có 2 sub-option:

### B1. Pure Flatsome shortcode trong post_content
- Edit page V2 qua wp-admin → dán shortcode `[section][row][col]...`
- CSS bổ sung trong `home-v2.css`

| Tiêu chí | Đánh giá | Điểm /10 |
|---|---|---|
| Ưu | UX Builder edit được sau này | 7 |
| Nhược | Shortcode Flatsome giới hạn UI (form tư vấn, card hover phức tạp, hero stats overlay, building card với badge/giá — khó làm đẹp bằng shortcode thuần) | 5 |
| Khả năng UI đẹp | Trung bình | 6 |

### B2. Page template PHP custom trong flatsome-child (KHUYẾN NGHỊ)
- Tạo `flatsome-child/page-templates/template-home-v2.php`
- Lấy data động: `WP_Query` products, `get_permalink`, `wp_get_attachment_url`
- HTML semantic + CSS custom `home-v2.css` + JS riêng `home-v2.js`
- Set template cho page `trang-chu-v2` trong wp-admin → page tự render layout custom
- **Không sửa parent theme**, không sửa `page.php`, không sửa Flatsome shortcode

| Tiêu chí | Đánh giá | Điểm /10 |
|---|---|---|
| Ưu | Full control HTML/CSS như Option A NHƯNG chạy trong WP context (header/footer/menu Flatsome đã có sẵn). Lấy data động từ DB nên không bịa. Build 1 lần, không phải port. | 10 |
| Nhược | Page V2 không edit qua UX Builder được — chỉ edit qua code child theme. Trade-off chấp nhận được vì child theme đã có lịch sử custom rồi (sprint1.css, header.php, footer.php). | 6 |
| Rủi ro | Thấp — chỉ thêm file mới trong child theme, page mới, không động page 233 | 9 |
| Khả năng UI đẹp | Rất cao | 10 |
| Khả năng port sang Flatsome | Đã chạy trên Flatsome (chung header/footer) — KHÔNG cần port | 10 |
| Mức an toàn | Rất cao | 9 |
| Thời gian triển khai | 1 lần công | 9 |
| Khả năng rollback | Rất dễ — xoá file template + xoá page V2 trong wp-admin (page 233 không bị động chạm) | 10 |
| **Tổng** |   | **73** |

---

## DECISION MATRIX

| Tiêu chí (trọng số) | Option A | B1 (shortcode) | B2 (PHP template) |
|---|---:|---:|---:|
| UI đẹp/hiện đại (×3) | 10 | 6 | 10 |
| Tốc độ triển khai (×2) | 4 | 7 | 9 |
| An toàn / rollback (×3) | 9 | 8 | 9 |
| Lấy data thật từ DB (×2) | 3 (tĩnh) | 8 | 10 |
| Không sửa parent theme (×3) | 10 | 10 | 10 |
| Không động page 233 (×3) | 10 | 10 | 10 |
| Bảo trì lâu dài (×1) | 4 | 8 | 7 |
| **Tổng có trọng số** | **127** | **128** | **143** |

**→ Option B2 thắng rõ ràng.**

---

## HƯỚNG ĐƯỢC CHỌN: Option B2 (PHP Page Template trong flatsome-child)

### Lý do chọn
1. **Lấy nội dung động thật từ DB** (products, attachments, taxonomies) — không phải hard-code, không bịa.
2. **Không cần port** — build 1 lần là chạy. Tiết kiệm ~50% effort so với Option A.
3. **UI đẹp ngang Option A** — vì là HTML custom hoàn toàn, không bị Flatsome shortcode giới hạn.
4. **An toàn tối đa**:
   - Không sửa parent theme Flatsome
   - Không sửa page 233 (chỉ tạo page V2 mới)
   - Không thay đổi permalink, taxonomy, product slug
   - Chỉ thêm file trong `flatsome-child/` → có thể xoá để rollback
5. **Header/Footer/Menu/CTA bar/Search dùng lại của Flatsome** — không phải làm lại header (vì spec nói "Header có sẵn dùng được").

### Trade-off chấp nhận
- Page V2 không edit qua UX Builder. Khi cần đổi text/ảnh, edit code child theme. Đây là practice phổ biến cho landing page premium, và phù hợp với fact rằng child theme đã có custom code (sprint1.css, header.php).
- Nếu sau này khách muốn UX Builder editable, có thể migrate sang B1 (shortcode) bằng cách convert HTML → shortcode tương ứng.

### Rủi ro còn lại
| Rủi ro | Mức | Mitigation |
|---|---|---|
| CSS `home-v2.css` conflict với main.css / sprint1.css | Trung bình | Scope toàn bộ CSS dưới `.home-v2` namespace + dùng `:where()` để giảm specificity |
| JS conflict (jQuery, swiper, fancybox đã load) | Thấp | home-v2.js dùng IIFE, namespace, không pollute global |
| Page V2 không lên menu được | Không phải rủi ro | Chưa link vào menu chính ở phase này; chỉ user duyệt tại `/trang-chu-v2/` |
| Khách approve xong muốn set V2 thành homepage | Không phải rủi ro lúc làm | Khi duyệt, vào Settings → Reading → đổi `page_on_front` thành ID page V2 (có hướng dẫn ở section "Bước duyệt") |
| Ảnh hero 883 missing | Đã handle | Dùng `leadvisors-tower-...jpg` làm fallback, ghi placeholder rõ ràng |

### Cách rollback
1. Vào wp-admin → Pages → tìm "Trang chủ V2" → Trash.
2. Xoá các file:
   - `flatsome-child/page-templates/template-home-v2.php`
   - `flatsome-child/assets/css/home-v2.css`
   - `flatsome-child/assets/js/home-v2.js`
   - `flatsome-child/inc/home-v2-loader.php` (nếu có)
3. Trong `functions.php` xoá block enqueue home-v2 (sẽ comment rõ trong code).
4. Page 233 (Trang chủ cũ) **không bị động chạm** — vẫn là homepage.

---

## DANH SÁCH FILE DỰ KIẾN

### Tạo mới (chỉ trong flatsome-child)
1. `flatsome-child/page-templates/template-home-v2.php` — template chính, đăng ký Template Name "Home V2"
2. `flatsome-child/assets/css/home-v2.css` — CSS scoped `.home-v2`
3. `flatsome-child/assets/js/home-v2.js` — animation, counters, sticky, smooth scroll
4. `flatsome-child/inc/home-v2-loader.php` — enqueue assets có điều kiện (chỉ khi page dùng template Home V2)
5. `flatsome-child/_home_v2_inventory.md` — đã tạo (tài liệu inventory)
6. `flatsome-child/_home_v2_option_evaluation.md` — đã tạo (file này)

### Sửa (1 dòng include)
- `flatsome-child/functions.php` — thêm 1 dòng `require_once __DIR__ . '/inc/home-v2-loader.php';`

### Database
- Tạo page mới qua wp-admin (hoặc WP-CLI/SQL) — title "Trang chủ V2", slug `trang-chu-v2`, template Home V2
- **KHÔNG sửa page 233, không sửa option `page_on_front`**

---

## DỮ LIỆU SẼ LẤY TỪ HOMEPAGE HIỆN TẠI

- ✅ H1, sub-line, CTA hero → từ section banner page 233 + biên tập
- ✅ 8 khu vực (link, ảnh) → từ section address page 233
- ✅ 3 lý do (500+, 6000+, 10+) → từ section reason page 233
- ✅ 6 bước quy trình → từ block 771
- ✅ 5 testimonial (tên, chức danh, công ty, ảnh) → từ section feedback page 233 (nội dung rút gọn)
- ✅ 5 thành viên team → từ block 554
- ✅ Logo khách hàng → từ section customer page 233 (gallery IDs)
- ✅ 3 CTA cuối → từ block 557
- ✅ Hotline 0966 68 1616 → từ block 771
- ✅ Tòa nhà nổi bật → WP_Query 6-8 sản phẩm `post_type=product` mới nhất

## NỘI DUNG SẼ ĐÁNH DẤU PLACEHOLDER

- **Form tư vấn nhanh:** UI có, submit chưa map backend → ghi rõ `[NEEDS CLIENT CONTENT — cần map backend form sau, tạm link sang /lien-he/]`
- **Sub-headline hero:** đề xuất từ source nhưng có comment `<!-- Đã biên tập từ B2+B4 — cần khách approve wording -->`
- **Ảnh hero:** dùng `leadvisors-tower-...jpg` (ảnh thật có sẵn) + comment `<!-- Ảnh placeholder, ảnh gốc ID 883 missing locally -->`
