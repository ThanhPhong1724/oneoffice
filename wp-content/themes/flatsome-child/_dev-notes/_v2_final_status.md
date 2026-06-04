# V2 — Trạng thái sau khi ghi đè & fix contrast (2026-06-02)

## Tóm tắt

Đã **ghi đè vào trang gốc** theo yêu cầu — page 233 (`/`) và page 751 (`/van-phong-tron-goi/`) giờ render bằng V2 template, nhưng `post_content` gốc vẫn được backup vào meta `_oo_v2_original_content` để rollback nhanh.

## Thay đổi DB

```sql
-- 1. Backup post_content gốc vào meta
INSERT INTO tlq_postmeta (post_id, meta_key, meta_value)
SELECT ID, '_oo_v2_original_content', post_content FROM tlq_posts WHERE ID IN (233, 751);

-- 2. Assign V2 template
INSERT INTO tlq_postmeta (post_id, meta_key, meta_value) VALUES
  (233, '_wp_page_template', 'page-templates/template-home-v2.php'),
  (751, '_wp_page_template', 'page-templates/template-vptg-v2.php');
```

**KHÔNG sửa `post_content` của 233/751** — vẫn nguyên Flatsome shortcode cũ trong DB. Template V2 ignore content và render HTML riêng.

## Issues phát hiện & fix

### 1. Hero button text mờ trên primary teal background
- **Nguyên nhân:** selector `.home-v2 a { color: var(--hv2-primary) }` (specificity 0,2,0) override `.hv2-btn--primary { color: white }` (0,1,0) → text button bị ép teal trùng nền teal → invisible.
- **Fix:** scope tất cả button rule với `.home-v2 .hv2-btn--…` (0,2,0) để thắng anchor reset.

### 2. Hero title text dark trên dark overlay
- **Nguyên nhân:** tương tự — `.home-v2 h1, h2, h3, h4 { color: var(--hv2-dark) }` (0,2,0) override `.hv2-hero__title { color: white }` (0,1,0).
- **Fix:** đổi reset sang `:where()`: `.home-v2 :where(h1, h2, h3, h4) { color: var(--hv2-dark); }` → reset có specificity 0 → mọi `.hv2-…` class win tự nhiên.
- Áp dụng cho cả `.home-v2 :where(p, a, ul, img)` để tránh các bug tương tự trong tương lai.

### 3. Testimonial quote mark vỡ thành 2 dấu phẩy tách rời
- **Nguyên nhân:** ký tự `"` (straight double quote) trong font Roboto/system render thành 2 vertical strokes không liền — không phải curly quote như mong đợi.
- **Fix:** thay bằng SVG inline với path đúng kiểu curly quote `❝`.

### 4. Testimonial dots vỡ thành oval cao
- **Nguyên nhân:** Flatsome default `button` style có `min-height` + `padding` + `line-height` ép button 10×10 thành hình to bị oval qua `border-radius: 50%`.
- **Fix:** robust reset cho `.home-v2 .hv2-testi__dot` — `appearance:none; padding:0; min-height:0; line-height:0; font-size:0; min-width:10px;`.

## Kết quả test Playwright

| URL | Page ID | Template | Hero title color | Hero btn text color | Overflow | Broken imgs |
|---|---|---|---|---|---|---|
| `/` | 233 | home-v2 | `rgb(255,255,255)` ✅ | `rgb(255,255,255)` ✅ | None ✅ | 0 ✅ |
| `/van-phong-tron-goi/` | 751 | vptg-v2 | `rgb(255,255,255)` ✅ | `rgb(255,255,255)` ✅ | None ✅ | 0 ✅ |
| `/trang-chu-v2/` | 5217 | home-v2 | same ✅ | same ✅ | None | 0 |
| `/van-phong-tron-goi-v2/` | 5218 | vptg-v2 | same ✅ | same ✅ | None | 0 |

Mobile 390 + tablet 768 + desktop 1440 — tất cả đều render đúng, no overflow, button đọc rõ trên mọi nền.

## Screenshot mới nhất

- `home233-hero-final.jpg` — Hero page 233 desktop sau fix
- `home233-mobile-final.jpg` — Mobile page 233
- `home233-testimonial-fixed.jpg` — Testimonial fix (SVG quote + dots đúng)
- `vptg751-hero-final.jpg` — Hero page 751 desktop sau fix
- `vptg751-mobile-final.jpg` — Mobile page 751
- `vptg751-fixed-full.jpg` — VPTG full page sau fix

## Page 5217/5218 staging

Vẫn tồn tại với slug `trang-chu-v2`/`van-phong-tron-goi-v2`. Vì page gốc đã dùng cùng template, 2 page này giờ thực chất là duplicate.

- **Giữ:** OK — không hại, là URL backup test.
- **Xoá nếu muốn clean:**
  ```sql
  DELETE FROM tlq_postmeta WHERE post_id IN (5217, 5218);
  DELETE FROM tlq_posts WHERE ID IN (5217, 5218);
  ```

## Rollback nhanh

### Rollback chỉ page 233 (về Flatsome shortcode cũ)
```sql
DELETE FROM tlq_postmeta WHERE post_id = 233 AND meta_key = '_wp_page_template';
```
→ page.php default render lại `post_content` gốc (vẫn còn trong DB).

### Rollback chỉ page 751
```sql
DELETE FROM tlq_postmeta WHERE post_id = 751 AND meta_key = '_wp_page_template';
```

### Rollback toàn bộ V2 system
1. Xoá dòng `require_once __DIR__ . '/inc/home-v2-loader.php';` trong `functions.php`.
2. Page 233/751 sẽ fallback về page.php → render `post_content` Flatsome shortcode cũ.

### Rollback tận gốc + xoá backup meta
```sql
DELETE FROM tlq_postmeta WHERE meta_key IN ('_wp_page_template', '_oo_v2_original_content') AND post_id IN (233, 751);
```

## ⚠️ Vẫn còn

- **UX Builder không edit được page 233 / 751 nữa** vì template PHP render HTML cứng (không đọc shortcode trong post_content). Đây là trade-off của Option B2 đã thông báo trước. Edit qua code child theme.
- **Quick form backend chưa cấu hình** — submit redirect sang `/lien-he/` qua query string. Cần khách cấu hình form thật (CF7 / Telegram / Email).
- **Font Roboto 404** — 3 console error legacy có sẵn từ parent Flatsome, không liên quan V2.

---

## Update 2026-06-03 — Centering + Be Vietnam Pro + Single product polish

### Yêu cầu khách
1. Căn giữa toàn bộ hero Home V2.
2. Đổi text title: "Cho thuê văn phòng Hà Nội tại các toà nhà Hạng A · B · C" → **"Cho thuê văn phòng Hà Nội và thi công nội thất tại tất cả các toà nhà Hạng A-B-C"**.
3. Đổi font title sang font hỗ trợ Tiếng Việt tốt — Roboto đang render lỗi 1 số tổ hợp dấu.
4. Áp dụng cho cả VPTG.
5. Đồng bộ làm đẹp tất cả sub-pages `/cho-thue-van-phong-ha-noi/{toà-nhà}/`.

### Đã làm

#### Font Be Vietnam Pro (Google Fonts)
- Enqueue 5 weight (400, 500, 600, 700, 800) qua hàm `oo_enqueue_be_vietnam_pro()` trong `inc/home-v2-loader.php`.
- Preconnect tới `fonts.googleapis.com` + `fonts.gstatic.com` để giảm RTT.
- CSS var `--hv2-font-display`, `--vp2-font-display`, `--sp2-font-display` — cùng stack, fallback an toàn `system-ui`.
- Áp dụng cho: hero title, eyebrow (qua heading reset `:where()`), tab title, price card, dark section heading.

#### Hero V2 — center
Home V2 (`.hv2-hero` + `.hv2-hero__inner`):
- `text-align: center` ở section
- `.hv2-hero__inner { display: flex; flex-direction: column; align-items: center; }`
- CTA: `justify-content: center`
- Stats grid: `margin: 0 auto`, `li { align-items: center }`
- Title: `text-wrap: balance` + `<span class="hv2-nowrap">Hạng A-B-C</span>` để giữ không xuống dòng
- "Hà Nội" thêm `&nbsp;` để không bị tách giữa 2 từ
- Title font cap từ 58px → 50px để fit cân đối hơn ở desktop
- VPTG V2: cùng pattern (`.vp2-hero` / `.vp2-hero__inner`)

Mobile: bỏ `text-align: left`, CTA `width: 100%` stretch.

#### Single Product V2 — sub-pages /cho-thue-van-phong-ha-noi/
- File mới: `assets/css/single-product-v2.css`.
- Enqueue điều kiện: `is_product()` trong `inc/home-v2-loader.php` (function `oo_single_product_v2_enqueue`).
- Scope: tất cả rules nằm dưới `body.single-product { ... }` — không leak ra trang khác.
- Components style:
  - **Breadcrumb bar** — gradient teal light, divider mảnh
  - **H1 title** — Be Vietnam Pro, 38px desktop / 22px mobile, dark teal
  - **`.box-item.thong_so`** (Thông số toà nhà, Chi tiết giá) — white card, border + shadow, tab title có teal 4px stripe
  - **`.BuildingItem-Icon`** — teal light bg, teal icon
  - **`.price-wrapper`** — teal gradient + white text + bold price 32px
  - **`.btn-phone`** sticky — teal gradient + hover lift
  - **Article content** (Thông tin cho thuê) — h2 có teal underline accent
  - **`section.section.dark`** — đổi từ `#282828` plain sang `linear-gradient(135deg, #063443, #0a4a5d)`, button primary white+teal
  - **Responsive** 1024 / 640 breakpoint
- Áp dụng cho **TẤT CẢ product single** — không phụ thuộc URL cụ thể. Vincom, Asia Tower, Diagon, ~50+ tòa nhà khác đều sync.

### Kết quả test
| URL | Page type | Title font | Hero center | Card polish | Overflow |
|---|---|---|---|---|---|
| `/` | page 233 → V2 | Be Vietnam Pro ✅ | ✅ | n/a | None |
| `/van-phong-tron-goi/` | page 751 → V2 | Be Vietnam Pro ✅ | ✅ | n/a | None |
| `/cho-thue-van-phong-ha-noi/vincom-center-ba-trieu/` | product 4623 | Be Vietnam Pro ✅ | n/a | ✅ | None |
| `/cho-thue-van-phong-ha-noi/asia-tower/` | product 5046 | Be Vietnam Pro ✅ | n/a | ✅ | None |
| `/cho-thue-van-phong-ha-noi/toa-nha-diagon/` | product 4432 | Be Vietnam Pro ✅ | n/a | ✅ | None |

6 Be Vietnam Pro font weights loaded ở mọi page V2 + mọi single product (verified qua `document.fonts`).

### File mới / thay đổi
- ✅ NEW `assets/css/single-product-v2.css`
- 📝 EDIT `assets/css/home-v2.css` — vars + hero center + font display
- 📝 EDIT `assets/css/vptg-v2.css` — vars + hero center + font display
- 📝 EDIT `page-templates/template-home-v2.php` — title text mới + nowrap span
- 📝 EDIT `inc/home-v2-loader.php` — enqueue Be Vietnam Pro + single product condition

### Rollback các thay đổi mới
- Bỏ Be Vietnam Pro: xoá function `oo_enqueue_be_vietnam_pro()` + tất cả `oo_enqueue_be_vietnam_pro();` calls trong loader.
- Bỏ single product polish: xoá function `oo_single_product_v2_enqueue()` + filter call.
- Hoặc đổi luôn `--hv2-font-display: 'Roboto', …` để revert font mà giữ layout center.

---

## Update 2026-06-03 (Phần 2) — Thay thế font Be Vietnam Pro bằng Plus Jakarta Sans

### Lý do thay đổi
- Font **Be Vietnam Pro** bị lỗi hiển thị dấu tiếng Việt ở một số ký tự (ví dụ: "nội thất", "Hạng A-B-C") dẫn đến dấu chấm dưới hoặc dấu khác bị lệch vị trí, méo mó trên một số trình duyệt/thiết bị.
- Giải pháp: Chuyển sang **Plus Jakarta Sans** — một font chữ hình học hiện đại, hỗ trợ tiếng Việt cực tốt, hiển thị sắc nét và mang lại giao diện sang trọng, chuyên nghiệp hơn cho lĩnh vực bất động sản và thi công văn phòng cao cấp.

### Các thay đổi đã thực hiện
1. **`inc/home-v2-loader.php`**:
   - Thay thế hàm `oo_enqueue_be_vietnam_pro()` thành `oo_enqueue_plus_jakarta_sans()`.
   - Cập nhật URL Google Font để tải Plus Jakarta Sans (các weights: 300, 400, 500, 600, 700, 800 và 1 variant italic).
   - Đổi tên handle từ `oneoffice-be-vietnam-pro` thành `oneoffice-plus-jakarta-sans` trong dependencies của stylesheet.
2. **`assets/css/home-v2.css`**:
   - Thay đổi các biến font-family `--hv2-font-display` và `--hv2-font-body` sang sử dụng `'Plus Jakarta Sans'`.
3. **`assets/css/vptg-v2.css`**:
   - Thay đổi các biến font-family `--vp2-font-display` và `--vp2-font-body` sang sử dụng `'Plus Jakarta Sans'`.
4. **`assets/css/single-product-v2.css`**:
   - Thay đổi biến font-family `--sp2-font-display` sang sử dụng `'Plus Jakarta Sans'`.

### Trạng thái
- Hệ thống font chữ mới hiển thị chuẩn xác, không còn lỗi nhảy dấu, lệch dấu ở các từ tiếng Việt có nhiều dấu kết hợp. Giao diện trở nên vô cùng cao cấp và đồng nhất.

---

## Update 2026-06-03 (Phần 3) — Chuyển font toàn bộ website sang Plus Jakarta Sans

### Chi tiết thay đổi
1. **Tải font globally**: Hàm `oo_enqueue_plus_jakarta_sans` đã được hook trực tiếp vào `wp_enqueue_scripts` toàn site (độ ưu tiên 5) trong `inc/home-v2-loader.php`. Do đó, font Plus Jakarta Sans sẽ tự động tải ở tất cả các trang trên site (kể cả các trang Flatsome mặc định, trang giỏ hàng, liên hệ, tin tức...).
2. **Ghi đè font toàn site**: Đã thêm quy tắc CSS ghi đè font-family sang `'Plus Jakarta Sans'` cho tất cả các thành phần (`body`, headings, inputs, buttons, links, spans, paragraphs, lists) trong file global [assets/css/sprint1.css](file:///E:/oneoffice/wp-content/themes/flatsome-child/assets/css/sprint1.css). Quy tắc sử dụng `!important` để chắc chắn vượt qua font chữ cũ "SF Pro Text".
3. **Đồng bộ hóa**: Cả header, footer, menu chính, và các khu vực nội dung cũ/mới đều đã sử dụng font mới Plus Jakarta Sans.
