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
    var revealEls = root.querySelectorAll(
        '.hv2-secthead, .hv2-areas__item, .hv2-reasons__card, ' +
        '.hv2-process__item, .hv2-buildings__card, .hv2-team__card, ' +
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

        // Failsafe — ensure nothing stays hidden if IO is delayed
        // (e.g. headless screenshot, slow tab) for more than 2s.
        setTimeout(function () {
            revealEls.forEach(function (el) { el.classList.add('is-in'); });
        }, 2000);
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

        dots.forEach(function (dot, i) {
            dot.addEventListener('click', function () { go(i); start(); });
        });

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
