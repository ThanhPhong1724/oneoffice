# OneOffice — Design System (Wonderland Việt Nam)

> Hệ thiết kế thống nhất toàn site: màu, typography, spacing, radius, shadow,
> button/card/section/form. Nguồn chân lý: `assets/css/design-system.css`.

---

## 1. Bảng màu (color tokens)

Bảng màu lấy từ **logo Wonderland**: teal (chính) · navy (tối) · blue (phụ) · cyan (nhấn).

| Token | Hex | Dùng cho |
|---|---|---|
| `--primary` | `#129C94` | Màu thương hiệu chính: CTA, link, icon, giá |
| `--primary-d` | `#0C7B73` | Hover / điểm cuối gradient |
| `--primary-l` | `#E6F5F3` | Nền tint nhạt, badge |
| `--secondary` | `#1571B5` | Xanh dương logo: nút phụ, badge thông báo |
| `--secondary-d` | `#115E96` | Hover của secondary |
| `--accent` | `#6FE4ED` | Cyan nhấn (text nổi, highlight nền tối) |
| `--accent-soft` | `#E6F6F8` | Nền nhấn rất nhạt |
| `--dark` | `#063443` | Navy: hero, CTA cuối trang, footer |
| `--dark-2` | `#0A4A5D` | Navy sáng hơn (gradient) |
| `--background` | `#F6FAFB` | Nền site |
| `--surface` | `#FFFFFF` | Nền card/section sáng |
| `--surface-alt` | `#EDF4F5` | Nền section xen kẽ |
| `--text-main` | `#172B35` | Heading |
| `--text-body` | `#2C3A45` | Body |
| `--text-muted` | `#5B6C76` | Chú thích, phụ |
| `--border` | `#E1E8EC` | Viền card/input |
| `--gold` | `#C9A24B` | CTA đặc biệt (dùng RẤT tiết chế) |

> **Đã loại bỏ:** hồng `#ef6594` (lạc tông). Các sắc teal cũ trùng lặp
> (`#00a1b2`, `#008a9a`, `#007d8c`, `#11a48d`) đã gộp về `--primary`/`--primary-d`.

## 2. Typography
- Font: **Plus Jakarta Sans** (đã set global).
- H1 `clamp(28–44px)` · H2 `clamp(24–34px)` · H3 `22px` · H4 `18px` · body `16px` · small `14px` · caption `13px`.
- line-height: heading `1.2`, body `1.65`. Heading weight `700`.

## 3. Spacing / Radius / Shadow
- Spacing: `--sp-1..--sp-9` = `4 / 8 / 12 / 16 / 24 / 32 / 48 / 64 / 96px`. Section pad `clamp(56–96px)`.
- Radius: `--r-sm 8px` · `--r 14px` · `--r-lg 20px` · `--r-pill 999px`.
- Shadow (navy-tint): `--sh-sm` · `--sh` · `--sh-lg` · `--sh-primary` (glow teal cho nút).

## 4. Component rules

**Button** (class `.oo-btn--*`, hoặc tự áp cho `.btn-phone`/`.btn-trang`/CF7/Woo):
| | Nền | Chữ | Hover |
|---|---|---|---|
| `--primary` | gradient teal→teal-d | trắng | nhấc 2px + glow |
| `--secondary` | blue | trắng | blue-d |
| `--outline` | trong suốt, viền teal | teal | fill teal |
| `--gold` | gold | navy | gold-d |

**Card** (`.oo-card`): nền trắng + `--sh-sm`, hover `--sh` nhấc 4px, radius `--r`.
- Trên nền trắng → dùng **shadow**. Trên nền màu/alt → dùng **border**, bỏ shadow (`.oo-card--bordered`/`--flat`).

**Section** (`.oo-section--light/soft/tint/dark`): nhịp nền sáng → alt → tint → navy.

**Image** (`.oo-img`, `.oo-zoom`): radius `--r`, `object-fit:cover`, hover `scale(1.04)`.

**Form**: input/select/textarea viền `--border`, radius `--r-sm`, focus viền teal + ring `rgba(18,156,148,.12)`. Lỗi đỏ `--danger`, ok `--success`.

## 4b. Gradient & Motion (mục 9–10 trong `design-system.css`)
Logo Wonderland là **gradient teal→cyan→blue** ⇒ UI dùng gradient có kiểm soát:
- `--grad-brand` = `120deg #16A085 → #129C94 → #1486A8 → #1571B5` (nút primary, "sweep" khi hover).
- `--grad-dark` = navy→teal-blue (CTA cuối trang `.hv2-final/.vp2-final`, `.oo-section--dark`, hero overlay).
- `.oo-grad-text` (chữ gradient), `.oo-title-underline` (gạch chân gradient), số liệu `.hv2-reasons__stat` (gradient).

**Motion** (mức "tinh tế"):
- Reveal-on-scroll trang cũ → `assets/js/oo-motion.js` (tự bỏ qua V2 vì V2 có hệ riêng; failsafe 6s; tôn trọng `prefers-reduced-motion`).
- Hero Ken Burns pan nhẹ (`@keyframes oo-kenburns`), hover zoom ảnh card, card lift, sticky header "kính mờ" (`.stuck .header-main`), link nội dung gạch chân chạy.

## 5. Kiến trúc file & thứ tự load
```
main.css → category-page.css → single-page.css → sprint1.css → design-system.css   (toàn site, ưu tiên 10)
                                                                        ↓
            home-v2.css / vptg-v2.css / single-product-v2.css   (theo trang, ưu tiên 30 — nạp SAU)
```
- `design-system.css` override layer cũ + Flatsome/Woo/CF7, **không đụng V2** (V2 nạp sau).
- Token thương hiệu đã được **migrate trực tiếp** vào tất cả file (hex `#129C94`), nên đồng bộ kể cả nơi hardcode.

### ⚠️ 5 NGUỒN màu thương hiệu (đều đã đổi #00a1b2 → #129C94)
Màu teal đến từ **5 nơi**, không chỉ CSS — nhớ khi đổi brand sau này:
1. **CSS child theme** (9 file `assets/css/`) — migrate hex trực tiếp.
2. **CSS plugin `devtung-mvc`** (`product-category.css`, `component-other.css`) — migrate hex.
3. **Flatsome Customizer** → theme_mod `color_primary` (option `theme_mods_flatsome-child` trong DB). In ra `<style id="custom-css">`. Backup: `theme_mods_flatsome-child_oo_backup`.
4. **Call Now Button plugin** → biến `--cnb-theme-color` (inline `<style>` từ setting plugin). Override bằng `:root{--cnb-theme-color:#129C94 !important}` trong `design-system.css`.
5. **Cache**: `main.css` từng hardcode `ver='1.1'` → đã đổi sang `filemtime()` để tự cache-bust.

## 6. Rollback
| Muốn bỏ | Cách |
|---|---|
| Design system (token+gradient+component) | Comment block `wp_enqueue_style('oneoffice-design-system', …)` |
| Motion (reveal-on-scroll) | Comment block `wp_enqueue_script('oneoffice-motion', …)` |
| Màu Customizer cũ | `update_option('theme_mods_flatsome-child', get_option('theme_mods_flatsome-child_oo_backup'))` |
| Màu hex trong file CSS | Chạy ngược script migrate (`#129C94`→`#00a1b2`). **Không** `git checkout` (sẽ mất work khác chưa commit) |
| 1 token | Sửa `:root` trong `design-system.css` |

## 7. Lịch sử
- **2026-06-06 — Pass 1 (đồng bộ):** Tạo design system. Gộp 4 sắc teal → `#129C94` (logo). Bỏ hồng → cyan/blue.
  Đồng bộ radius (sp2 16→14, building-item 16→14). Sửa rogue `#00ff00`.
- **2026-06-06 — Pass 2 (cao cấp):** Gradient thương hiệu (nút/section/stat), reveal-on-scroll (`oo-motion.js`),
  hero Ken Burns, hover zoom, sticky glass, nhịp typography. Đổi màu ở **5 nguồn** (xem mục 5):
  child CSS · plugin devtung CSS · Customizer `color_primary` · Call Now Button `--cnb-theme-color` · sửa cache `main.css`.
- **2026-06-06 — Pass 3 (gradient maximalist, mục 11):** Theo yêu cầu "spam gradient": mọi khối teal phẳng → gradient —
  nút nền đặc (+sweep), nền badge/slider/chip, **chữ giá/badge hạng → chữ gradient** (gồm cả ký tự con như `$`),
  nút outline đổ gradient khi hover.
  ⚠️ **Bài học:** chữ gradient (`background-clip:text` + `text-fill:transparent`) phải (a) có `background` gradient `!important`
  để thắng nền pill sẵn có, (b) áp cả phần tử CON (vd `$`) — nếu không sẽ thành **chữ trong suốt = vô hình**.
  Đã quét `invisibleTextEls` = **0** trên home/category/product.
  Test Playwright desktop/mobile: **0 lỗi console · 0 tràn ngang · 0 teal cũ · 0 chữ vô hình**.
