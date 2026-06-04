# HƯỚNG DẪN QUẢN TRỊ & CẤU HÌNH WEBSITE
**OneOffice — Wonderland Việt Nam**
_Cập nhật: 2026-06-03 · Dành cho admin/người quản trị nội dung_

> Tài liệu này hướng dẫn **thay đổi thông tin** trên website mà KHÔNG cần lập trình viên cho phần lớn các mục.
> Mức độ khó: 🟢 Dễ (làm trong trang admin) · 🟡 Trung bình (sửa 1 file có chú thích rõ) · 🔴 Cần lập trình viên.

---

## MỤC LỤC
- [A. Số điện thoại / Zalo / Email / Địa chỉ](#a-thông-tin-liên-hệ-doanh-nghiệp)
- [B. Nút gọi điện nổi (Call Now Button)](#b-nút-gọi-điện-nổi)
- [C. Form liên hệ & email nhận thư (Contact Form 7)](#c-form-liên-hệ--email-nhận-thư)
- [D. Google Search Console + Analytics (Site Kit)](#d-google-search-console--analytics)
- [E. Chat & nút liên hệ nổi (UChat, Call Now Button)](#e-chat--nút-liên-hệ-nổi)
- [F. SEO Yoast cho trang mới](#f-seo-yoast-cho-trang-mới)
- [G. robots.txt & Sitemap](#g-robotstxt--sitemap)
- [H. Câu hỏi thường gặp (Schema FAQ)](#h-câu-hỏi-thường-gặp-schema-faq)
- [I. Checklist khi đổi sang tên miền thật (go-live)](#i-checklist-khi-go-live)

---

## A. THÔNG TIN LIÊN HỆ DOANH NGHIỆP
**Áp dụng cho:** SĐT hotline, link Zalo, email, địa chỉ, giờ làm việc.
**Mức độ:** 🟡 Trung bình — hiện đang được ghi cố định trong 3 file (xem bảng dưới).

> ⚠️ **Lưu ý:** Số điện thoại `0966 68 1616` hiện xuất hiện ở **nhiều chỗ**. Khi đổi số, phải sửa **tất cả** các vị trí dưới đây, nếu không sẽ còn sót số cũ.
> 💡 *Khuyến nghị:* có thể nhờ dev gom toàn bộ thông tin này vào **1 file cấu hình duy nhất** (`inc/business-info.php`) để sau này chỉ sửa 1 chỗ — xem mục [I.6].

### Vị trí cần sửa khi đổi SĐT / Zalo / Email / Địa chỉ

| File | Dòng | Nội dung |
|---|---|---|
| `flatsome-child/inc/schema-markup.php` | 38 | `'telephone' => '+84966681616'` (định dạng quốc tế, bỏ số 0 đầu) |
| ″ | 39 | `'email' => 'info@oneoffice.vn'` |
| ″ | 41–44 | Địa chỉ (`addressLocality`, `addressCountry`) |
| ″ | 47–48 | Toạ độ bản đồ (`latitude`, `longitude`) |
| ″ | 57 | Link Zalo `https://zalo.me/0966681616` |
| `flatsome-child/page-templates/template-home-v2.php` | 124, 168–170, 250, 345–347, 530–531, 533 | SĐT hiển thị + link `tel:` + Zalo |
| `flatsome-child/page-templates/template-vptg-v2.php` | 139, 218, 259, 281, 386, 390 | SĐT hiển thị + link `tel:` + Zalo |
| Plugin **Call Now Button** | — | Xem [mục B] (sửa trong admin, không sửa file) |

**Cách sửa file:** `Giao diện → Sửa file (Theme File Editor)`, hoặc sửa qua FTP/hosting.
- Link gọi: dạng `tel:0966681616` — **viết liền, không dấu cách**.
- Số hiển thị: có thể viết đẹp `0966 68 1616`.
- Link Zalo: `https://zalo.me/0966681616`.

---

## B. NÚT GỌI ĐIỆN NỔI
**Plugin:** Call Now Button — nút gọi/Zalo nổi ở góc màn hình (chủ yếu trên mobile).
**Mức độ:** 🟢 Dễ.

**Đường dẫn:** `wp-admin → Settings (Cài đặt) → Call Now Button`
- Đổi **số điện thoại** trong ô số → Lưu.
- Bật/tắt hiển thị trên desktop/mobile, đổi màu, chữ nút tại đây.

---

## C. FORM LIÊN HỆ & EMAIL NHẬN THƯ
**Plugin:** Contact Form 7 + WP Mail SMTP. **Mức độ:** 🟢 Dễ.

### ✅ Đã cấu hình (06/2026)
- **3 form** đều gửi thông báo về **`yasuaola@gmail.com`**:
  | ID | Form | Trang |
  |---|---|---|
  | 286 | Form liên hệ | `/lien-he/` |
  | 601 | Chia sẻ nhu cầu – Nhận báo giá | popup home/sản phẩm |
  | 465 | Ký gửi | `/ky-gui/` |
- Mỗi form có **template email đầy đủ** (họ tên, email, SĐT, nội dung…) + **Reply-To = email khách** → bấm *Reply* là trả lời thẳng khách.
- Form Ký gửi (465) đính kèm **file khách upload** vào email.
> Lưu ý: template mail gốc của 3 form vốn **trống** (lead trước đây đẩy qua plugin nội bộ `devtung-mvc`, không qua email). Nay đã dựng template để gửi email song song. Bản gốc lưu ở postmeta `_oo_cf7_props_backup`.

### C.1 — Đổi email nhận thư
1. `wp-admin → Liên hệ → Contact Forms` → mở form → tab **Mail**
2. Sửa ô **To (Đến)** (nhiều người nhận: ngăn cách bằng dấu phẩy) → **Lưu**.

### C.2 — Gửi mail thật qua SMTP (✅ đã cài & test OK)
Đã cài **WP Mail SMTP** + cấu hình Gmail, đã **gửi test thành công** trên local.
- **Tài khoản gửi:** `thduong.pdclub@gmail.com` (Gmail SMTP, port 587/TLS).
- **Đổi/kiểm tra:** `wp-admin → WP Mail SMTP → Settings` (host/port/tài khoản) & `→ Tools → Email Test` (nút **gửi mail test** — bấm là biết chạy hay không).
- ⚠️ App password Gmail có thể thu hồi/đổi tại [myaccount.google.com](https://myaccount.google.com) → App passwords. Đổi xong nhập lại ở WP Mail SMTP.

### C.3 — 🔑 Khi lên hosting iNet (rất quan trọng — đọc kỹ)
Localhost gửi được **không đảm bảo** hosting gửi được (một số gói share chặn port SMTP ra ngoài). Cách xử lý chắc chắn:
1. Lên hosting, vào **WP Mail SMTP → Tools → Email Test**, gửi thử.
2. **Nếu OK** → xong.
3. **Nếu lỗi/timeout** (host chặn port 587/465) → chọn 1 trong 2:
   - **(a) Dùng email tên miền của iNet** (vd `info@oneoffice.vn`): đổi host SMTP sang `mail.oneoffice.vn` (iNet cấp), port 465/587 → thường thông vì gửi nội bộ; nhớ bật **SPF/DKIM** trong DNS để ít vào spam. *(Khuyến nghị cho production — không dính giới hạn ~500 mail/ngày của Gmail.)*
   - **(b) Đổi Mailer sang API** (Brevo/SendGrid…): WP Mail SMTP hỗ trợ sẵn, gửi qua **cổng 443** (không host nào chặn). Đăng ký lấy API key, dán vào → xong.

---

## D. GOOGLE SEARCH CONSOLE + ANALYTICS
**Plugin:** Google Site Kit (đã cài sẵn & active).
**Mức độ:** 🟢 Dễ — chỉ cần đăng nhập tài khoản Google.

1. `wp-admin → Site Kit → Dashboard`
2. Bấm **Sign in with Google** → chọn tài khoản Google sở hữu website.
3. Lần lượt kết nối: **Search Console**, **Analytics (GA4)**, (tuỳ chọn) **PageSpeed Insights**.
4. Site Kit sẽ **tự động** chèn thẻ xác minh GSC và mã Analytics — **không cần dán code thủ công**.

> ✅ Khi go-live trên tên miền thật, đăng nhập lại Site Kit và thêm property cho domain mới.
> ✅ Sau khi kết nối GSC, vào Search Console gửi **Sitemap**: `sitemap_index.xml` (xem [mục G]).

---

## E. CHAT & NÚT LIÊN HỆ NỔI
Trang đang có **2 nhóm** widget nổi ở góc dưới:

### E.1 — Cụm nút Gọi / Zalo / Messenger (plugin Call Now Button)
- Cấu hình: `wp-admin → Cài đặt → Call Now Button` (xem [mục B]).
- Đổi được: số điện thoại, link Zalo, **link Messenger** (đường dẫn `facebook.com/...` trang FB).

### E.2 — Live chat UChat (✅ đã cài 06/2026)
- **Mã nhúng:** `<script src="https://uhchat.net/code.php?f=cad774"></script>`
- **Nạp tại:** `flatsome-child/inc/uchat-widget.php` (chèn vào footer toàn site).
- **Cấu hình chat** (tên, lời chào, vị trí góc phải/trái, màu, âm báo…): đăng nhập **[uhchat.net](https://uhchat.net)** bằng tài khoản `yasuaola@gmail.com` → tab **Cài đặt**.
- ⚠️ Nếu bong bóng UChat **đè** lên cụm nút Gọi/Zalo/Messenger: vào dashboard UChat đổi **"Chọn vị trí hiển thị"** sang góc còn lại.
- **Đổi tài khoản UChat khác:** thay chuỗi `f=cad774` trong file trên bằng mã của tài khoản mới.
- **Tắt UChat:** xoá dòng `require_once .../inc/uchat-widget.php` trong `functions.php`.

---

## F. SEO YOAST CHO TRANG MỚI
**Plugin:** Yoast SEO.
**Mức độ:** 🟢 Dễ.

Khi tạo **trang/bài viết mới**, kéo xuống hộp **Yoast SEO** dưới trình soạn thảo:
1. **Focus keyphrase** — từ khoá chính (vd: *cho thuê văn phòng quận Cầu Giấy*).
2. **SEO title** — tiêu đề Google (giữ < 60 ký tự). Có thể dùng biến `%%sep%%` và `%%sitename%%`.
3. **Meta description** — mô tả 120–155 ký tự, có chứa từ khoá.
4. Cố gắng đưa đèn **Readability** và **SEO** về **xanh/cam**.

**Nguyên tắc nội dung (đã áp dụng cho toàn site):**
- Mỗi trang có **đúng 1 thẻ H1**, các mục lớn dùng H2/H3.
- Có **liên kết nội bộ** tới trang liên quan (vd về trang chủ, trang danh sách toà nhà).
- **Ảnh phải có Alt text** (mô tả ảnh) — xem [mục F.1].

### F.1 — Alt text cho ảnh
- Khi tải ảnh mới: điền ô **Văn bản thay thế (Alt Text)** trong Thư viện Media.
- Toàn bộ ảnh cũ trong Media đã được điền Alt tự động (2.755 ảnh) — ảnh mới cần điền tay.

---

## G. robots.txt & SITEMAP
**File:** `E:\oneoffice\robots.txt` (thư mục gốc website).
**Mức độ:** 🟡 Trung bình.

- File đã cấu hình: cho Google vào nội dung chính, **chặn** trang admin/giỏ hàng/thanh toán/tài khoản.
- **Khi đổi tên miền:** sửa dòng cuối:
  ```
  Sitemap: http://localhost/oneoffice/sitemap_index.xml
  ```
  → đổi thành `https://oneoffice.vn/sitemap_index.xml`.
- Sitemap do Yoast tạo tự động tại `/sitemap_index.xml` — không cần làm gì thêm.

---

## H. CÂU HỎI THƯỜNG GẶP (Schema FAQ)
**File:** `flatsome-child/inc/schema-markup.php`, hàm `oo_schema_faq_vptg()` (dòng 80+).
**Mức độ:** 🟡 Trung bình.

- 7 câu hỏi/đáp ở trang **Văn phòng trọn gói** được khai báo trong mảng `$faqs`.
- Khi sửa nội dung FAQ **hiển thị** trên trang (trong `template-vptg-v2.php`), **nhớ sửa khớp** mảng `$faqs` trong file schema để Google hiểu đúng.

---

## I. CHECKLIST KHI GO-LIVE
_(chuyển từ `localhost/oneoffice` sang tên miền thật, vd `oneoffice.vn`)_

> 🔒 **BẢO MẬT — XOÁ NGAY khi lên production** (hiện đang lộ, ai cũng tải được):
> - `dup-installer/` (thư mục cài Duplicator)
> - `muneerjohosting_onceoffice.sql` (**bản dump toàn bộ database** — rất nguy hiểm nếu lộ)
> - `wp-content/backups-dup-lite/` (gói backup)
> - `installer.php` / các file `dup-installer-*` ở thư mục gốc (nếu còn)
> Đây là rác sau khi migrate — xoá hết để tránh lộ dữ liệu.

1. **Search & Replace URL** trong database: `http://localhost/oneoffice` → `https://oneoffice.vn`
   (dùng plugin *Better Search Replace* hoặc WP-CLI — **sao lưu DB trước**).
2. **robots.txt:** sửa dòng `Sitemap:` sang domain thật ([mục G]).
3. **Schema:** thông tin `url`, `logo` trong `schema-markup.php` tự dùng `home_url()` nên cập nhật theo domain mới — không cần sửa tay.
4. **Site Kit:** kết nối lại Google, thêm property domain mới, gửi sitemap ([mục D]).
5. **WP Mail SMTP (✅ đã cài):** lên hosting vào *Tools → Email Test* gửi thử. Nếu host chặn SMTP → đổi sang **email tên miền iNet** hoặc **API** ([mục C.3]). Cân nhắc đổi tài khoản gửi sang email tên miền thay cho Gmail.
6. _(Khuyến nghị)_ Nhờ dev **gom thông tin liên hệ về 1 file** `inc/business-info.php` để dễ quản trị về sau.
7. **Cache & tốc độ:** trên production nên cài 1 plugin cache (vd *LiteSpeed Cache* nếu hosting hỗ trợ, hoặc *WP Super Cache*) + bật nén Gzip. _Không nên bật cache khi đang sửa giao diện._ ⚠️ Trang chủ local đang load chậm (~80s lần đầu) — nên rà nguyên nhân khi lên production.
8. **SSL/HTTPS:** đảm bảo chứng chỉ hợp lệ, ép redirect http→https.
9. Kiểm tra lại: menu, **form liên hệ (gửi thử + xác nhận mail về `yasuaola@gmail.com`)**, nút Gọi/Zalo/Messenger, **chat UChat**, chia sẻ mạng xã hội, hiển thị mobile/tablet.

---

## J. TỐI ƯU KỸ THUẬT TỰ ĐỘNG (không cần cấu hình)
Các mục dưới chạy tự động trên child theme — chỉ cần biết để bảo trì / rollback:

| Tính năng | File | Rollback |
|---|---|---|
| **Chống spam form** (honeypot ẩn — bot điền vào sẽ bị chặn, không gửi mail) | `inc/seo-extras.php` | xoá `require_once .../seo-extras.php` trong functions.php |
| **1 thẻ H1/bài viết** (tự hạ H1 trong nội dung xuống H2) | `inc/seo-extras.php` | ″ |
| **Số chạy/counter** (500+/6.000+/10+ đếm khi cuộn tới) | `assets/js/home-v2.js` | sửa trong file JS |
| **Schema Article** cho bài viết | `inc/schema-markup.php` | xoá hàm `oo_schema_article` |

> ℹ️ Form liên hệ đã có honeypot chống spam — nếu khách báo "gửi báo lỗi", kiểm tra họ có vô tình kích hoạt trình chặn không; honeypot không hiện với người dùng thật.

---

### Liên hệ kỹ thuật
Các mục 🔴/🟡 nếu chưa rõ, gửi yêu cầu cho lập trình viên kèm **tên mục** trong tài liệu này để xử lý nhanh.
