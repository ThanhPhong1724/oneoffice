# Home V2 — Content Inventory & Plan

> Nguồn dữ liệu: WordPress local `oneoffice_local`, page ID 233 (Trang chủ), blocks 771, 554, 557.
> Mọi nội dung dưới đây đã được trích nguyên văn từ DB hiện tại. Không tự bịa.

---

## A. CẤU TRÚC HOMEPAGE HIỆN TẠI (page ID 233)

| # | Section label | Class CSS | Tóm tắt |
|---|---|---|---|
| 1 | `banner` | — | `[ux_slider]` + `[ux_banner bg="883"]` chứa H1 + nút "Tư vấn & báo giá 096.668.1616" |
| 2 | `info` | `.info` | Block giới thiệu, có logo `logo-wonder.png`, H2 và mô tả Wonderland |
| 3 | `address` | `.address` | "Tòa nhà văn phòng cho thuê tại Hà Nội" + grid 8 khu vực (Hoàn Kiếm → Tây Hồ) |
| 4 | `reason` | `.reason` | "Tại sao lựa chọn Wonderland Việt Nam" — 3 card (500+, 6000+, 10+ năm) |
| 5 | Block 771 | `.quy_trinh` | Quy trình dịch vụ 6 bước accordion |
| 6 | CTA | — | Button "Khám phá câu chuyện từng dự án" |
| 7 | `feedback` | `.feedback` | "Phản hồi của khách hàng" — slider 5 testimonial |
| 8 | Block 554 | `.member` | "Đội ngũ tư vấn chuyên nghiệp" — 5 nhân sự |
| 9 | `customer` | `.customer` | "Khách hàng tiêu biểu" — gallery 35 logo (visibility=hidden ở phần đầu) |
| 10 | Block 557 | `.process` | "Bắt đầu ngay quá trình tìm thuê văn phòng" — 3 CTA card |

---

## B. NỘI DUNG CÓ THẬT (lấy nguyên văn từ DB)

### B1. Hero
- **H1 hiện tại:** "Cho thuê văn phòng Hà Nội và thi công nội thất tại tất cả các toà nhà Hạng A-B-C"
- **CTA hero:** Text = "Tư vấn & báo giá 096.668.1616" — link `tel:098.890.2468` (⚠️ số tel trong link KHÁC số trong text, đây là lỗi data có sẵn)
- **Background:** image ID `883` (`2020/12/03.jpg`) — **MISSING locally** → cần thay thế.
- **Overlay:** `rgba(0, 161, 178, 0.4)` (primary color)

### B2. Info / Giới thiệu Wonderland
- Logo: `2020/11/logo-wonder.png`
- H2: "Khách hàng chia sẻ nhu cầu thuê & trải nghiệm dịch vụ chuyên nghiệp hoàn toàn miễn phí"
- Mô tả 1: "Wonderland sẽ nhanh chóng giúp Bạn thuê được văn phòng phù hợp, với giá và các điều khoản thuê có lợi nhất"
- Tagline: "Wonderland Việt Nam"
- Mô tả 2: "Trên 10 năm kinh nghiệm cho thuê & thiết kế thi công nội thất văn phòng chuyên nghiệp"

### B3. Khu vực cho thuê (Section address — XÁC NHẬN EXIST đầy đủ)
| Quận | Image ID | Local file | Link (production URL) |
|---|---|---|---|
| HOÀN KIẾM | 783 | ✅ `2020/11/hoan-kiem-thumb-1.jpg` | `/cho-thue-van-phong-ha-noi/quan-hoan-kiem/` |
| HAI BÀ TRƯNG | 787 | ✅ `2020/11/hai-ba-trung-thumb.jpg` | `/cho-thue-van-phong-ha-noi/quan-hai-ba-trung/` |
| BA ĐÌNH | 789 | ✅ `2020/11/ba-dinh-thumb.jpg` | `/cho-thue-van-phong-ha-noi/quan-ba-dinh/` |
| ĐỐNG ĐA | 791 | ✅ `2020/11/dong-da-thumb.jpg` | `/cho-thue-van-phong-ha-noi/quan-dong-da/` |
| CẦU GIẤY | 1870 | ✅ `2025/08/cho-thue-van-phong-cau-giay-ha-noi.jpg` | `/cho-thue-van-phong-ha-noi/quan-cau-giay/` |
| NAM TỪ LIÊM | 794 | ✅ `2020/11/nam-tu-liem-thumb.jpg` | `/cho-thue-van-phong-ha-noi/quan-nam-tu-liem/` |
| THANH XUÂN | 1869 | ✅ `2025/08/cho-thue-van-phong-thanh-xuan-ha-noi.jpg` | `/cho-thue-van-phong-ha-noi/quan-thanh-xuan/` |
| TÂY HỒ | 798 | ✅ `2020/11/tay-ho-thumb.jpg` | `/cho-thue-van-phong-ha-noi/quan-tay-ho/` |

Link xem tất cả: `/cho-thue-van-phong-ha-noi/`

### B4. Reason — "Tại sao lựa chọn Wonderland Việt Nam"
1. **500+ tòa nhà văn phòng** (img 1095): "Đại lý cho thuê liên tục trên 10 năm tại tất cả các tòa nhà văn phòng hạng ABC, Wonderland sẽ cung cấp cho bạn nhiều sự lựa chọn nhất. Giúp bạn tìm kiếm được văn phòng phù hợp nhất chỉ trong thời gian ngắn."
2. **6000+ khách thuê văn phòng** (img 1096): "Là đại lý cho thuê hàng đầu liên tục trong nhiều năm, với nguồn khách hàng ổn định. Wonderland luôn nhận được sự hợp tác và hỗ trợ tốt nhất từ các tòa nhà cho các chính sách thuê và ưu đãi lớn nhất cho khách hàng của mình."
3. **10+ năm kinh nghiệm** (img 1100): "Wonderland team là tập hợp những nhân sự giàu kinh nghiệm, kiến thức thị trường sâu rộng, đảm bảo hỗ trợ khách hàng tốt nhất trong suốt quá trình tìm thuê văn phòng: tìm kiếm, đánh giá, cân nhắc, lựa chọn tòa nhà và đàm phán được giá cùng các điều khoản thuê tốt nhất."

### B5. Quy trình dịch vụ (Block 771 — 6 bước accordion)
1. **TIẾP NHẬN YÊU CẦU** — "Tiếp nhận yêu cầu thuê từ khách hàng, tư vấn và cung cấp thông tin sơ bộ về thị trường, nguồn cung, các lưu ý khi thuê văn phòng." | *Bạn có được* định hướng tìm văn phòng, giúp xác định các văn phòng phù hợp với yêu cầu về: ngân sách, vị trí, chất lượng dựa trên nguồn cung sẵn có của thị trường.
2. **BÁO GIÁ, CUNG CẤP THÔNG TIN** — "Gửi báo giá bao gồm đầy đủ thông tin, hình ảnh các tòa nhà phù hợp yêu cầu thuê. Cung cấp thông tin hồ sơ năng lực." | *Bạn có được* tất cả các lựa chọn phù hợp và thông tin chi tiết chỉ sau một cuộc gọi. *Bạn hiểu về* đại lý và những hỗ trợ hữu ích từ đại lý.
3. **KHẢO SÁT THỰC TẾ** — "Lên lịch trình khảo sát thực tế và làm việc với tòa nhà theo thứ tự ưu tiên và kế hoạch phù hợp." | *Bạn tiết kiệm* thời gian, chi phí liên lạc, gặp đúng đại diện có thẩm quyền của tòa nhà.
4. **LỰA CHỌN ĐỊA ĐIỂM THUÊ** — "Hỗ trợ lập báo cáo đánh giá ưu nhược điểm từng tòa nhà, bảng so sánh, phân tích tài chính." | *Bạn có* đầy đủ thông tin, ngay cả những thông tin chưa được nhận diện trong quá trình Khảo Sát Thực Tế để ra quyết định lựa chọn phù hợp nhất.
5. **TƯ VẤN ĐÀM PHÁN** — "Cung cấp cho Khách hàng thông tin thị trường, giá thuê giao dịch tại tòa nhà. Phân tích các điều khoản hợp đồng cần đàm phán và tư vấn cách thức đàm phán." | *Bạn đạt được* mức giá và các điều kiện thuê tốt nhất.
6. **HỖ TRỢ SAU HỢP ĐỒNG** — "Trong suốt quá trình thuê & vận hành văn phòng, nếu có vấn đề phát sinh, Bạn chia sẻ thông tin và tiếp tục nhận được hỗ trợ miễn phí" | *Bạn được hỗ trợ* hiệu quả kể cả sau khi ký hợp đồng thuê. Hiểu biết của Wonderland về quy trình vận hành và đặc điểm từng Tòa Nhà sẽ giúp bạn vận hành văn phòng hiệu quả nhất.

Hotline trong block: **0966 68 1616** (link `tel:0966681616`)

### B6. Testimonial (5 testimonial — XÁC NHẬN có ảnh chân dung)
1. **Mr. Masaaki Yamane** — Tổng Giám Đốc, Panasonic R&D Vietnam — ảnh `2020/12/a-344x400.png` (995)
2. **Mr. Đỗ Cao Bảo** — Chủ Tịch, FPT IS — ảnh `2020/12/docaobao.png` (998)
3. **Ms. Vũ Thị Tuyết Minh** — Giám Đốc Chi Nhánh, DKSH Hà Nội — ảnh `2020/12/vuthituyetminh.png` (1001)
4. **Ms. Nguyễn Thị Minh Ngọc** — Trưởng phòng Hành Chính, Omron Vietnam — ảnh `2020/12/nguyenthiminhngoc.png` (1003)
5. **Ms. Elodie Berthonneau** — Giám Đốc Quốc Gia, Qatar Airways — ảnh `2020/12/avc.png` (1004)

Mỗi testimonial trong DB hiện tại đều rất DÀI (3-5 đoạn). Spec yêu cầu rút gọn → biên tập lại nhưng giữ đúng ý.

### B7. Đội ngũ (Block 554 — 5 thành viên)
| Tên | Học vấn | Kinh nghiệm | Ảnh local |
|---|---|---|---|
| Nguyễn Minh Anh | Msc. Financial Management / BSc. Real Estate | 15 năm | ✅ 1050 — `dnst1.jpg` |
| Đoàn Thị Hằng | Cử nhân | 10 năm | ✅ 1051 — `dnst2.jpg` |
| Nguyễn Kim Anh | BSc. Economics | 7 năm | ✅ 1052 — `dnst3.jpg` |
| Dương Phương Linh | Thạc sỹ kinh tế | 4 năm | ✅ 1053 — `dnst4.jpg` |
| Đoàn Trường Giang | Cử nhân | 6 năm | ✅ 1054 — `dnst5.jpg` |

### B8. Khách hàng tiêu biểu (Section customer)
- Mobile slider: 5 logo collage (IDs 1057, 1058, 1059, 1060, 1061 — `2.png`, `logo01-05.jpg`) — ✅ EXIST
- Desktop gallery: 35 logo IDs trong `[ux_gallery]` — chưa verify từng cái nhưng có thể reuse trực tiếp.

### B9. CTA cuối (Block 557 — 3 card)
1. **Tìm hiểu kinh nghiệm thuê văn phòng** (img 408) — link `cam-nang` — "Những chia sẻ từ thực tiễn phục vụ 5000 + khách hàng, giúp cho Bạn nắm rõ được những công việc phải làm."
2. **Tìm kiếm các văn phòng phù hợp** (img 412) — link `ha-noi` — "Bạn có thể nhanh chóng tìm kiếm được những tòa nhà phù hợp nhất với nhu cầu. Nắm được sự phân bổ của các nguồn cung văn phòng."
3. **Liên hệ Tư vấn & Báo giá** (img 413) — link `lien-he` — "Lựa chọn phương thức phù hợp nhất để liên hệ: Gọi tư vấn 09666.81.616 Gửi yêu cầu thuê qua email Chat (nói chuyện) với tư vấn"

### B10. Menu hiện tại (main-menu, term 403)
| Order | Title | Type | Target |
|---|---|---|---|
| 1 | (Trang chủ) | page | 233 |
| 2 | Văn phòng Hà Nội | (custom) | 561 (page) |
| 3 | (Văn phòng trọn gói) | page | 751 |
| 4-8 | Thông tin công ty + 4 sub | page | 5205, 5206, 5207, 5208, 5209 |
| 9 | (Liên hệ) | page | 429 |
| 10 | (Ký gửi) | page | 450 |
| 11 | Tin Tức | (custom) | post 29 |

→ Khớp với spec mong muốn: Trang chủ / Văn phòng Hà Nội / Văn phòng trọn gói / Thông tin công ty / Tin tức / Ký gửi. **Header có sẵn — KHÔNG cần làm lại trong V2**.

### B11. WooCommerce products (Tòa nhà nổi bật)
Lấy 8 sản phẩm gần nhất, có giá thuê và vị trí thật:

| ID | Tên | Giá | Vị trí | Ảnh local |
|---|---|---|---|---|
| 5046 | Asia Tower | 28-30$/m²/tháng | 06 Nhà Thờ, Hoàn Kiếm | ✅ |
| 4929 | Toà nhà Kinh Đô Tower | 10-11$/m²/tháng | 93 Lò Đúc, Hai Bà Trưng | ✅ |
| 4623 | Vincom Center Bà Triệu | 26-28$/m²/tháng | 191 Bà Triệu, Hai Bà Trưng | ✅ |
| 4609 | Tòa nhà Vinafor | 14-15$ | 127 Lò Đúc, Hai Bà Trưng | ✅ |
| 5187 | Imperia Sky Garden | 13-15$/m²/tháng | 423 Minh Khai, Hai Bà Trưng | ❌ MISSING |
| 5169 | Hòa Bình Green City | 12-14$/m²/tháng | 505 Minh Khai, Hai Bà Trưng | ❌ MISSING |
| 5017 | Central Building | 34-36$/m²/tháng | 31 Hai Bà Trưng, Hoàn Kiếm | ❌ MISSING |
| 4755 | Hanoi Tower | 23-25$/m²/tháng | 49 Hai Bà Trưng, Hoàn Kiếm | ❌ MISSING |

→ Strategy: dùng 4 sản phẩm có ảnh + 2 sản phẩm bổ sung query động (server-side trong page V2). Nếu ảnh missing thì WooCommerce sẽ tự fallback placeholder.

---

## C. NỘI DUNG CÓ THỂ BIÊN TẬP LẠI

| Mục | Bản hiện tại (gốc) | Bản đề xuất (biên tập, không sai ý) |
|---|---|---|
| H1 hero | "Cho thuê văn phòng Hà Nội và thi công nội thất tại tất cả các toà nhà Hạng A-B-C" | "Cho thuê văn phòng Hà Nội tại các toà nhà Hạng A-B-C" *(rút gọn — sub-headline sẽ nói về thi công nội thất)* |
| Sub-headline | (chưa có riêng trong DB) | "Tư vấn miễn phí, hỗ trợ đàm phán giá & điều khoản tốt nhất. Trên 10 năm kinh nghiệm cho thuê & thi công nội thất văn phòng chuyên nghiệp." *(ghép từ B2 + B4)* |
| Testimonials | Dài 3-5 đoạn | Rút gọn còn 2-3 câu chính, giữ đúng ý người nói + chức danh + công ty (đã có sẵn) |
| Reason card | Đoạn dài | Giữ headline + tagline ngắn 1-2 câu (rút gọn) |

---

## D. NỘI DUNG THIẾU — CẦN KHÁCH CUNG CẤP

| Mục | Trạng thái | Ghi chú |
|---|---|---|
| **Form tư vấn nhanh** (Quick consult) | UI có thể dựng, nhưng backend chưa có form chuyên dụng cho homepage | UI sẽ render nhưng submit cần `[NEEDS CLIENT CONTENT]` — đề xuất link sang `/lien-he/` |
| **Hero background hi-res** | Ảnh ID 883 missing locally | Fallback: `2020/11/leadvisors-tower-36-pham-van-dong-bac-tu-liem-ha-noi.jpg` (540KB, thật, có sẵn) — đánh dấu placeholder, cần khách duyệt |
| **Sub-headline gọn** | Chưa có riêng | Đề xuất từ nội dung thật (xem C) — cần khách approve |
| **Số liệu cập nhật** | "500+ tòa nhà / 6000+ khách thuê / 10+ năm" — đang ghi trong DB | Dùng đúng số liệu này, KHÔNG bịa thêm |
| **Stats hero** | DB chưa có stats trên hero | Đề xuất: tận dụng 3 số liệu của section Reason hiển thị thêm dưới hero — nhưng đánh dấu [đã có sẵn trong source, chỉ tái sử dụng vị trí] |
| **Khách hàng tiêu biểu — full list** | DB có gallery 35 logo (ID 944-1090) | Dùng nguyên — không bịa thêm logo |

---

## E. SỐ ĐIỆN THOẠI / LIÊN HỆ (lấy từ source)

- Hotline button đầu hero: text "**096.668.1616**" (link tel: `098.890.2468` — đây là lỗi data có sẵn, sẽ unify về `0966681616`)
- Block 771 button: "**0966 68 1616**" — link `tel:0966681616` ← coi là số chuẩn
- Block 557 description: "**09666.81.616**"
- Memory user instruction: "0966.68.1616 nếu đang có trong source" → **CONFIRMED có trong source** → dùng được.
