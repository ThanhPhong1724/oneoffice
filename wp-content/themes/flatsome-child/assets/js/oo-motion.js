/* ============================================================================
 * OneOffice — Global Motion (reveal-on-scroll)
 * ----------------------------------------------------------------------------
 * Mang hiệu ứng "trôi vào khi cuộn" cho các trang CŨ (category, product, blog,
 * contact…) vốn đang tĩnh. KHÔNG chạy trên Home V2 / VPTG V2 (đã có motion riêng).
 *
 * An toàn tuyệt đối:
 *   - Progressive enhancement: chỉ ẩn element SAU khi JS chạy & gắn observer.
 *   - Reveal ngay phần đang trong màn hình lúc load.
 *   - FAILSAFE: sau 2.5s tự hiện hết → không bao giờ giấu mất nội dung.
 *   - Tôn trọng prefers-reduced-motion.
 *
 * ROLLBACK: bỏ wp_enqueue_script('oneoffice-motion', …) trong functions.php.
 * ========================================================================== */
(function () {
    'use strict';
    if (window.__ooMotion) return;
    window.__ooMotion = true;

    function ready(fn) {
        if (document.readyState !== 'loading') fn();
        else document.addEventListener('DOMContentLoaded', fn);
    }

    /* ----- LOAD MORE cho lưới toà nhà phẳng (trang quận/tìm kiếm > 12 thẻ) ----- */
    function setupLoadMore() {
        var PER = 12;
        document.querySelectorAll('.list-building').forEach(function (grid) {
            if (grid.getAttribute('data-oo-lm')) return;
            var cols = Array.prototype.filter.call(grid.children, function (c) {
                return c.classList && c.classList.contains('col');
            });
            if (cols.length <= PER) return;            // lưới ngắn (vd by-area ≤4) → bỏ qua
            grid.setAttribute('data-oo-lm', '1');
            var shown = PER;
            var apply = function () {
                cols.forEach(function (c, i) { c.style.display = i < shown ? '' : 'none'; });
            };
            var wrap = document.createElement('div');
            wrap.className = 'oo-loadmore-wrap';
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'oo-btn oo-btn--primary oo-loadmore-btn';
            var update = function () {
                var left = cols.length - shown;
                btn.textContent = 'Xem thêm ' + Math.min(PER, left) + ' toà nhà (' + left + ' còn lại)';
                wrap.style.display = left > 0 ? '' : 'none';
            };
            btn.addEventListener('click', function () { shown += PER; apply(); update(); });
            wrap.appendChild(btn);
            grid.parentNode.insertBefore(wrap, grid.nextSibling);
            apply(); update();
        });
    }

    ready(function () {
        setupLoadMore();   // chạy mọi trang có lưới toà nhà phẳng (kể cả V2 nếu có)

        // V2 có hệ reveal riêng (home-v2.js) → tránh xung đột.
        // Class .home-v2/.vptg-v2 nằm ở wrapper div (không phải body) nên query cả trang.
        var isV2 = !!document.querySelector('.home-v2, .vptg-v2');
        var reduce = window.matchMedia &&
                     window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (isV2 || reduce || !('IntersectionObserver' in window)) return;

        // Selector "an toàn" — khối nội dung rõ ràng, không phải toàn trang/header/footer.
        var sel = [
            '.building-item',                      // lưới tòa nhà (category/quận/đường) — MVC tuỳ biến
            'ul.products > li.product',            // lưới sản phẩm Woo (nếu có)
            '#post-list > article',                // danh sách bài viết
            '.blog-archive article',
            '.single-product .entry-summary',
            '.single-product .woocommerce-tabs',
            '.entry-content > h2',
            '.entry-content > h3',
            '.entry-content > figure',
            '.oo-reveal'                           // opt-in thủ công
        ].join(',');

        var els = Array.prototype.slice.call(document.querySelectorAll(sel));
        els = els.filter(function (el) {
            return !el.closest('header, #masthead, footer, .footer-wrapper, #main-menu, .mobile-sidebar');
        });
        if (!els.length) return;

        // Stagger theo cụm 4 (đẹp cho lưới tòa nhà)
        els.forEach(function (el, i) {
            el.classList.add('oo-prereveal', 'oo-d' + ((i % 4) + 1));
        });

        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) {
                    e.target.classList.add('oo-in');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -6% 0px' });

        els.forEach(function (el) { io.observe(el); });

        // Hiện ngay phần đã nằm trong viewport lúc load (tránh nháy phần trên màn hình).
        requestAnimationFrame(function () {
            var vh = window.innerHeight || document.documentElement.clientHeight;
            els.forEach(function (el) {
                var r = el.getBoundingClientRect();
                if (r.top < vh * 0.92 && r.bottom > 0) el.classList.add('oo-in');
            });
        });

        // FAILSAFE — bảo hiểm: nếu observer lỗi, sau 6s tự hiện hết (không giấu nội dung).
        // Để dài để KHÔNG phá hiệu ứng reveal khi người dùng cuộn chậm.
        setTimeout(function () {
            els.forEach(function (el) { el.classList.add('oo-in'); });
        }, 6000);
    });
})();
