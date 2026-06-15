/*!
 * Home V2 — Wonderland Việt Nam
 * Vanilla JS, no jQuery. Scoped to .home-v2.
 */
(function () {
    'use strict';

    var root = document.querySelector('.home-v2');
    if (!root) return;

    /* -------------------------------------------------
     * 1) Reveal-on-scroll (progressive enhancement)
     *    Skip entirely if user prefers reduced motion or
     *    no IntersectionObserver — element stays naturally visible.
     * ------------------------------------------------- */
    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* -------------------------------------------------
     * 0) Hero background slider — LUÔN tự chạy mỗi 2s (kể cả khi người dùng
     *    không làm gì), đổi ảnh mượt kiểu "morph" (mờ chồng + zoom nhẹ, do CSS lo).
     *    Mũi tên để đổi thủ công + reset đồng hồ. Hỗ trợ vuốt trên mobile.
     *    KHÔNG dừng khi hover (để chạy liên tục theo yêu cầu).
     * ------------------------------------------------- */
    (function initHeroSlider() {
        var hero = root.querySelector('.hv2-hero--slider');
        if (!hero) return;
        var slides = hero.querySelectorAll('.hv2-hero__slide');
        if (slides.length < 2) return;

        var idx = 0, timer = null;
        var INTERVAL = 2000;   // 2s mỗi ảnh — chỉnh số này để nhanh/chậm hơn

        function show(n) {
            idx = (n + slides.length) % slides.length;
            slides.forEach(function (s, i) { s.classList.toggle('is-active', i === idx); });
        }
        function next() { show(idx + 1); }
        function prev() { show(idx - 1); }
        function start() { stop(); timer = setInterval(next, INTERVAL); }
        function stop()  { if (timer) { clearInterval(timer); timer = null; } }

        var btnPrev = hero.querySelector('.hv2-hero__arrow--prev');
        var btnNext = hero.querySelector('.hv2-hero__arrow--next');
        if (btnPrev) btnPrev.addEventListener('click', function () { prev(); start(); });
        if (btnNext) btnNext.addEventListener('click', function () { next(); start(); });

        // Vuốt trên mobile để đổi ảnh
        var sx = null;
        hero.addEventListener('touchstart', function (e) { sx = e.touches[0].clientX; }, { passive: true });
        hero.addEventListener('touchend', function (e) {
            if (sx === null) return;
            var t = e.changedTouches[0];
            if (t && Math.abs(t.clientX - sx) > 45) { (t.clientX - sx < 0 ? next : prev)(); start(); }
            sx = null;
        });

        // Tự chạy ngay; chỉ tạm dừng khi hero ra khỏi màn hình (tiết kiệm), chạy lại khi cuộn vào.
        if ('IntersectionObserver' in window) {
            var hio = new IntersectionObserver(function (entries) {
                entries.forEach(function (en) { en.isIntersecting ? start() : stop(); });
            }, { threshold: 0.15 });
            hio.observe(hero);
        }
        start();
    })();

    /* -------------------------------------------------
     * 0b) Tòa nhà nổi bật — carousel theo NHÓM, hiện 6 tòa/nhóm (desktop) ·
     *     4 (tablet) · 1 (mobile). Tự chuyển nhóm mỗi 3s bằng hiệu ứng morph
     *     (mờ chồng + zoom nhẹ) giống slideshow ở hero. Mũi tên hiện khi hover,
     *     hỗ trợ vuốt, tạm dừng khi rê chuột. Không JS → lưới card bình thường.
     * ------------------------------------------------- */
    (function initBuildingsCarousel() {
        var carousel = root.querySelector('.hv2-buildings__carousel');
        if (!carousel) return;
        var track = carousel.querySelector('.hv2-buildings__track');
        if (!track) return;
        var allCards = Array.prototype.slice.call(track.querySelectorAll('.hv2-buildings__card'));
        if (allCards.length < 2) return;

        var btnPrev = carousel.querySelector('.hv2-buildings__arrow--prev');
        var btnNext = carousel.querySelector('.hv2-buildings__arrow--next');

        // Dựng stage xếp chồng các "trang" để cross-dissolve; giữ track làm nguồn (ẩn đi).
        var stage = document.createElement('div');
        stage.className = 'hv2-buildings__stage';
        track.parentNode.insertBefore(stage, track);
        track.style.display = 'none';

        var pages = [], page = 0, timer = null, curPV = 0;
        var INTERVAL = 4000;

        function perView() {
            var w = window.innerWidth;
            return w <= 640 ? 1 : (w <= 1024 ? 4 : 6);
        }

        function buildPages() {
            curPV = perView();
            stage.innerHTML = '';
            pages = [];
            var count = Math.ceil(allCards.length / curPV);
            for (var p = 0; p < count; p++) {
                var pageEl = document.createElement('div');
                pageEl.className = 'hv2-buildings__page hv2-buildings__grid';
                for (var i = p * curPV; i < Math.min((p + 1) * curPV, allCards.length); i++) {
                    pageEl.appendChild(allCards[i]); // di chuyển node vào trang
                }
                stage.appendChild(pageEl);
                pages.push(pageEl);
            }
            if (page >= pages.length) page = pages.length - 1;
            pages.forEach(function (pg, i) { pg.classList.toggle('is-active', i === page); });
            updateArrows();
        }

        function updateArrows() {
            // Dùng visibility (không phải display) để CSS ẩn mũi tên trên mobile vẫn thắng.
            var multi = pages.length > 1;
            if (btnPrev) btnPrev.style.visibility = multi ? '' : 'hidden';
            if (btnNext) btnNext.style.visibility = multi ? '' : 'hidden';
        }

        function show(p) {
            if (pages.length < 2) return;
            page = (p + pages.length) % pages.length;
            pages.forEach(function (pg, i) { pg.classList.toggle('is-active', i === page); });
        }
        function next() { show(page + 1); }
        function prev() { show(page - 1); }
        function start() { stop(); if (pages.length > 1) timer = setInterval(next, INTERVAL); }
        function stop() { if (timer) { clearInterval(timer); timer = null; } }

        if (btnPrev) btnPrev.addEventListener('click', function () { prev(); start(); });
        if (btnNext) btnNext.addEventListener('click', function () { next(); start(); });

        // Vuốt
        var sx = null;
        stage.addEventListener('touchstart', function (e) { sx = e.touches[0].clientX; }, { passive: true });
        stage.addEventListener('touchend', function (e) {
            if (sx === null) return;
            var t = e.changedTouches[0];
            if (t && Math.abs(t.clientX - sx) > 45) { (t.clientX - sx < 0 ? next : prev)(); start(); }
            sx = null;
        });

        // Tạm dừng khi rê chuột (để kịp đọc / bấm vào card)
        carousel.addEventListener('mouseenter', stop);
        carousel.addEventListener('mouseleave', start);

        // Đổi breakpoint → dựng lại nhóm
        var rT;
        window.addEventListener('resize', function () {
            clearTimeout(rT);
            rT = window.setTimeout(function () { if (perView() !== curPV) buildPages(); }, 200);
        });

        buildPages();
        // Chỉ auto-chạy khi khối trong viewport
        if ('IntersectionObserver' in window) {
            var bio = new IntersectionObserver(function (entries) {
                entries.forEach(function (en) { en.isIntersecting ? start() : stop(); });
            }, { threshold: 0.1 });
            bio.observe(carousel);
        } else {
            start();
        }
    })();

    var revealEls = root.querySelectorAll(
        '.hv2-secthead, .hv2-areas__item, .hv2-reasons__card, ' +
        '.hv2-process__item, .hv2-team__card, ' +
        '.hv2-final__card, .hv2-quickform__card'
    );

    if ('IntersectionObserver' in window && !prefersReduced) {
        revealEls.forEach(function (el) { el.classList.add('hv2-prereveal'); });

        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -20px 0px' });
        revealEls.forEach(function (el) { io.observe(el); });

        // BẢO HIỂM (không phá hiệu ứng): chỉ hiện phần ĐANG TRONG/QUA màn hình,
        // KHÔNG hiện sạch below-fold. → card dưới vẫn "trôi vào" khi cuộn tới, dù chờ bao lâu.
        // Đồng thời đảm bảo nội dung không bao giờ ẩn vĩnh viễn (kể cả nếu IO trục trặc).
        var revealInView = function () {
            var vh = window.innerHeight;
            revealEls.forEach(function (el) {
                if (!el.classList.contains('is-in') && el.getBoundingClientRect().top < vh * 0.9) {
                    el.classList.add('is-in');
                }
            });
        };
        window.addEventListener('load', revealInView);
        window.addEventListener('scroll', revealInView, { passive: true });
        window.addEventListener('resize', revealInView);
        setTimeout(revealInView, 1500);
    }

    /* -------------------------------------------------
     * 2) Number counters (hero stats + reasons stats)
     *    Hero dùng data-count/data-suffix; reasons parse text "6.000+".
     * ------------------------------------------------- */
    function parseTarget(el) {
        var dc = el.getAttribute('data-count');
        if (dc !== null && dc !== '') {
            return { target: parseInt(dc, 10), suffix: el.getAttribute('data-suffix') || '', thousands: true };
        }
        var txt = (el.textContent || '').trim();
        return {
            target: parseInt(txt.replace(/[^0-9]/g, ''), 10),
            suffix: /\+/.test(txt) ? '+' : '',
            thousands: /\./.test(txt)
        };
    }
    function fmt(n, thousands) { return thousands ? n.toLocaleString('vi-VN') : String(n); }
    function animateCount(el) {
        var info = parseTarget(el);
        if (isNaN(info.target) || info.target === 0) return;
        var duration = 1200, start = performance.now();
        function tick(now) {
            var t = Math.min(1, (now - start) / duration);
            var eased = 1 - Math.pow(1 - t, 3); // easeOutCubic
            el.textContent = fmt(Math.floor(info.target * eased), info.thousands) + info.suffix;
            if (t < 1) requestAnimationFrame(tick);
            else el.textContent = fmt(info.target, info.thousands) + info.suffix;
        }
        requestAnimationFrame(tick);
    }
    function observeCounters(els) {
        if (!els.length || prefersReduced) return; // reduced-motion: giữ số tĩnh sẵn có
        if (!('IntersectionObserver' in window)) { els.forEach(animateCount); return; }
        var done = false;
        var co = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting && !done) { done = true; els.forEach(animateCount); co.disconnect(); }
            });
        }, { threshold: 0.4 });
        co.observe(els[0]);
    }
    observeCounters(root.querySelectorAll('.hv2-hero__stats strong[data-count]'));
    observeCounters(root.querySelectorAll('.hv2-reasons__stat'));

    /* -------------------------------------------------
     * 3) Testimonial slider
     * ------------------------------------------------- */
    var cards = root.querySelectorAll('.hv2-testi__card');
    var dots  = root.querySelectorAll('.hv2-testi__dot');
    if (cards.length > 1 && dots.length === cards.length) {
        var current = 0;
        var timer = null;
        var paused = false;

        function go(idx) {
            current = (idx + cards.length) % cards.length;
            cards.forEach(function (c, i) { c.classList.toggle('is-active', i === current); });
            dots.forEach(function (d, i)  { d.classList.toggle('is-active', i === current); });
        }
        function next() { go(current + 1); }

        function start() { stop(); timer = setInterval(function () { if (!paused) next(); }, 6000); }
        function stop()  { if (timer) clearInterval(timer); }

        function prev() { go(current - 1); }

        dots.forEach(function (dot, i) {
            dot.addEventListener('click', function () { go(i); start(); });
        });

        var btnPrev = root.querySelector('.hv2-testi__arrow--prev');
        var btnNext = root.querySelector('.hv2-testi__arrow--next');
        if (btnPrev && btnNext) {
            btnPrev.addEventListener('click', function () { prev(); start(); });
            btnNext.addEventListener('click', function () { next(); start(); });
        }

        /* Kéo/vuốt (chuột + cảm ứng) để gạt qua lại testimonial */
        var track = root.querySelector('.hv2-testi__track');
        if (track) {
            var startX = null, dragging = false;
            var down = function (x) { startX = x; dragging = true; paused = true; track.style.cursor = 'grabbing'; };
            var up   = function (x) {
                if (!dragging || startX === null) return;
                var dx = x - startX;
                if (Math.abs(dx) > 45) { (dx < 0 ? next : prev)(); start(); }
                dragging = false; startX = null; paused = false; track.style.cursor = 'grab';
            };
            track.style.cursor = 'grab';
            track.style.touchAction = 'pan-y';
            track.addEventListener('mousedown', function (e) { e.preventDefault(); down(e.clientX); });
            window.addEventListener('mouseup', function (e) { if (dragging) up(e.clientX); });
            track.addEventListener('touchstart', function (e) { down(e.touches[0].clientX); }, { passive: true });
            track.addEventListener('touchend', function (e) { up((e.changedTouches[0] || {}).clientX != null ? e.changedTouches[0].clientX : startX); });
        }

        var testiSection = root.querySelector('.hv2-testi');
        if (testiSection) {
            testiSection.addEventListener('mouseenter', function () { paused = true; });
            testiSection.addEventListener('mouseleave', function () { paused = false; });
        }

        // Start only when in view
        if ('IntersectionObserver' in window) {
            var toio = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) { entry.isIntersecting ? start() : stop(); });
            }, { threshold: 0.2 });
            toio.observe(cards[0]);
        } else {
            start();
        }

        // Touch swipe
        var track = root.querySelector('.hv2-testi__track');
        if (track) {
            var startX = 0, dx = 0, touching = false;
            track.addEventListener('touchstart', function (e) {
                touching = true; startX = e.touches[0].clientX; dx = 0;
            }, { passive: true });
            track.addEventListener('touchmove', function (e) {
                if (!touching) return; dx = e.touches[0].clientX - startX;
            }, { passive: true });
            track.addEventListener('touchend', function () {
                if (!touching) return; touching = false;
                if (Math.abs(dx) > 60) { dx < 0 ? next() : go(current - 1); start(); }
            });
        }
    }

    /* -------------------------------------------------
     * 4) Smooth scroll to #anchors within page
     * ------------------------------------------------- */
    root.querySelectorAll('a[href^="#"]').forEach(function (a) {
        a.addEventListener('click', function (e) {
            var href = a.getAttribute('href');
            if (!href || href === '#') return;
            var target = document.querySelector(href);
            if (!target) return;
            e.preventDefault();
            var topOffset = 80;
            var top = target.getBoundingClientRect().top + window.scrollY - topOffset;
            window.scrollTo({ top: top, behavior: 'smooth' });
        });
    });

})();
