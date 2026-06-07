/* ============================================================================
 * COMPANY V3 — Reveal-on-scroll · Testimonial swipe
 * Scoped under .cv3 wrapper. Tôn trọng prefers-reduced-motion. Failsafe scroll-aware.
 * ========================================================================== */
(function () {
    'use strict';
    function ready(fn) {
        if (document.readyState !== 'loading') fn();
        else document.addEventListener('DOMContentLoaded', fn);
    }

    ready(function () {
        var root = document.querySelector('.cv3');
        if (!root) return;
        var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        /* ----- 1) Reveal-on-scroll ----- */
        if (!reduce && 'IntersectionObserver' in window) {
            var revealEls = root.querySelectorAll(
                '.cv3-secthead, .cv3-stat, .cv3-card, .cv3-step, .cv3-value, ' +
                '.cv3-split__copy, .cv3-split__media, .cv3-contact__info, .cv3-contact__form, ' +
                '.cv3-kygui-form, .cv3-final__inner, .cv3-logos li, .cv3-info-item'
            );
            revealEls.forEach(function (el) { el.classList.add('cv3-prereveal'); });

            var io = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) { entry.target.classList.add('is-in'); io.unobserve(entry.target); }
                });
            }, { threshold: 0.08, rootMargin: '0px 0px -10% 0px' });
            revealEls.forEach(function (el) { io.observe(el); });

            // Scroll-aware insurance — không phá hiệu ứng cuộn
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
            setTimeout(revealInView, 1500);
        }

        /* ----- 2) Testimonial slider (auto-rotate + click + swipe) ----- */
        var cards = root.querySelectorAll('.cv3-testi__card');
        var dots  = root.querySelectorAll('.cv3-testi__dot');
        var track = root.querySelector('.cv3-testi__track');
        if (cards.length > 1 && dots.length === cards.length) {
            var current = 0, timer = null, paused = false;
            function go(i) {
                current = (i + cards.length) % cards.length;
                cards.forEach(function (c, idx) { c.classList.toggle('is-active', idx === current); });
                dots.forEach(function (d, idx)  { d.classList.toggle('is-active', idx === current); });
            }
            function next() { go(current + 1); }
            function prev() { go(current - 1); }
            function start() { stop(); timer = setInterval(function () { if (!paused) next(); }, 7000); }
            function stop()  { if (timer) clearInterval(timer); }
            dots.forEach(function (d, i) { d.addEventListener('click', function () { go(i); start(); }); });

            if (track) {
                var sec = root.querySelector('.cv3-testi');
                if (sec) {
                    sec.addEventListener('mouseenter', function () { paused = true; });
                    sec.addEventListener('mouseleave', function () { paused = false; });
                }
                /* drag/swipe */
                var startX = null, dragging = false;
                var down = function (x) { startX = x; dragging = true; paused = true; };
                var up   = function (x) {
                    if (!dragging || startX === null) return;
                    var dx = x - startX;
                    if (Math.abs(dx) > 45) { (dx < 0 ? next : prev)(); start(); }
                    dragging = false; startX = null; paused = false;
                };
                track.addEventListener('mousedown', function (e) { e.preventDefault(); down(e.clientX); });
                window.addEventListener('mouseup', function (e) { if (dragging) up(e.clientX); });
                track.addEventListener('touchstart', function (e) { down(e.touches[0].clientX); }, { passive: true });
                track.addEventListener('touchend', function (e) {
                    up((e.changedTouches[0] || {}).clientX != null ? e.changedTouches[0].clientX : startX);
                });
            }

            if ('IntersectionObserver' in window) {
                var sec2 = root.querySelector('.cv3-testi');
                if (sec2) {
                    var sio = new IntersectionObserver(function (entries) {
                        entries.forEach(function (e) { e.isIntersecting ? start() : stop(); });
                    }, { threshold: 0.2 });
                    sio.observe(sec2);
                }
            } else { start(); }
        }
    });
})();
