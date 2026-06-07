# 💬 Chat widget — Đề xuất thay UChat

## Vấn đề hiện tại với UChat
- Widget "Hỗ trợ" đang **đè lên** nút Messenger/Zalo/Phone (đặc biệt trên mobile, sticky bar dưới)
- Giao diện cổ, không hiện đại
- Khó tùy biến vị trí

## 🏆 Khuyến nghị: Tawk.to

| Tiêu chí | Tawk.to | Crisp | Tidio | UChat hiện tại |
|---|---|---|---|---|
| **Giá** | 🟢 **MIỄN PHÍ vĩnh viễn** (no ads) | 🟡 Free tier giới hạn 2 agent | 🟡 Free tier: 50 chat/tháng | 🟢 Free |
| **Giao diện** | 🟢 Hiện đại, minimal | 🟢 Hiện đại nhất | 🟢 Đẹp | 🟡 Cũ |
| **Vị trí widget** | 🟢 Tùy biến X/Y offset | 🟢 Tùy biến | 🟡 Cố định | 🔴 Cố định |
| **Mobile responsive** | 🟢 Tốt | 🟢 Tốt | 🟢 Tốt | 🟡 |
| **Ẩn trên mobile** | 🟢 Có (CSS rule) | 🟢 Có | 🟡 Khó | 🔴 Khó |
| **App di động trả lời** | 🟢 iOS + Android | 🟢 iOS + Android | 🟢 iOS + Android | 🟡 |
| **Tiếng Việt** | 🟢 Có | 🟢 Có | 🟢 Có | 🟢 Có |
| **Visitor tracking** | 🟢 Real-time | 🟢 Real-time | 🟢 | 🟡 |
| **Chatbot tự động** | 🟡 Cơ bản | 🟢 Tốt | 🟢 AI tốt | 🔴 Không |
| **Số agent miễn phí** | 🟢 Vô hạn | 🔴 2 | 🔴 3 | 🟢 1 |

**→ Tawk.to thắng:** 100% free, agent vô hạn, vị trí tùy biến, ẩn mobile được — giải quyết đúng pain point của bạn.

---

## 🚀 Cách thay UChat → Tawk.to (5 phút)

### Bước 1 — Đăng ký tài khoản
1. Vào https://www.tawk.to/ → **Sign Up Free** (dùng email business)
2. Tạo Property: **Site Name** = `OneOffice`, **Site URL** = `https://oneoffice.vn/` (hoặc URL production)
3. Sau khi setup, lấy **mã embed** dạng:
   ```html
   <!--Start of Tawk.to Script-->
   <script type="text/javascript">
   var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
   (function(){
   var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
   s1.async=true;
   s1.src='https://embed.tawk.to/XXXXX/YYYYY';
   s1.charset='UTF-8';
   s1.setAttribute('crossorigin','*');
   s0.parentNode.insertBefore(s1,s0);
   })();
   </script>
   <!--End of Tawk.to Script-->
   ```
   (Sao chép cả block)

### Bước 2 — Thay code trong child theme
File: `wp-content/themes/flatsome-child/inc/uchat-widget.php`

Hiện tại:
```php
add_action( 'wp_footer', 'oo_uchat_widget', 99 );
function oo_uchat_widget() {
    if ( is_admin() ) return;
    echo '<script src="https://uhchat.net/code.php?f=cad774"></script>' . "\n";
}
```

Đổi thành (thay `XXXXX/YYYYY` bằng mã của bạn):
```php
add_action( 'wp_footer', 'oo_tawk_widget', 99 );
function oo_tawk_widget() {
    if ( is_admin() ) return;
    ?>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/XXXXX/YYYYY';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    <?php
}
```

### Bước 3 — Cấu hình vị trí widget (không đè nút Messenger)
Vào Tawk.to Dashboard → **Administration → Chat Widget → Widget Appearance**:

- **Position:** `Bottom Right`
- **Bottom Offset:** `90px` (cao hơn nút Messenger 60px của Call Now Button)
- **Right Offset:** `20px` (mặc định)

**Hoặc** đặt sang trái:
- **Position:** `Bottom Left`
- **Left Offset:** `100px` (tránh nút floating của ta bên trái)

### Bước 4 — Ẩn widget trên mobile (tuỳ chọn — nếu vẫn đè sticky bar)
Thêm vào `assets/css/design-system.css`:
```css
@media (max-width: 768px) {
    iframe[title*="chat widget" i],
    iframe[src*="tawk.to" i] { display: none !important; }
}
```

### Bước 5 — Đặt giờ làm việc + chatbot chào (tuỳ chọn)
Vào **Administration → Schedule** → set giờ 8h–18h
Vào **Messaging → Triggers** → tạo lời chào tự động khi khách vào trang

---

## 🔄 Cách rollback về UChat
Khôi phục `inc/uchat-widget.php` về bản gốc (đã commit ở git history).

---

## 🆚 Plan B: Crisp (nếu thích AI bot)

Crisp có chatbot AI miễn phí tốt hơn Tawk.to. Trade-off: chỉ 2 agent free.

Đăng ký: https://crisp.chat/en/ → cài plugin **"Crisp - Live Chat and Chatbot"** từ WordPress repo (không cần code).

---

**Tóm lại:** Tawk.to là lựa chọn an toàn cho doanh nghiệp BĐS — free forever, dễ ẩn mobile, không đè nút Messenger.
