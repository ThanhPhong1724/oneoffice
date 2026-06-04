/*!
 * VPTG V2 — Văn phòng trọn gói — Wonderland
 * Vanilla JS. Scoped to .vptg-v2.
 */
(function () {
    'use strict';

    var root = document.querySelector('.vptg-v2');
    if (!root) return;

    /* -------------------------------------------------
     * 1) Reveal-on-scroll (progressive enhancement)
     * ------------------------------------------------- */
    var prefersReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var revealEls = root.querySelectorAll(
        '.vp2-secthead, .vp2-types__card, .vp2-reasons__card, ' +
        '.vp2-process__item, .vp2-intro__copy, .vp2-intro__media, ' +
        '.vp2-faq__item, .vp2-final__inner, .vp2-quickform__card'
    );

    if ('IntersectionObserver' in window && !prefersReduced) {
        revealEls.forEach(function (el) { el.classList.add('vp2-prereveal'); });

        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.08, rootMargin: '0px 0px -20px 0px' });
        revealEls.forEach(function (el) { io.observe(el); });

        // Failsafe — không để section ẩn quá 2s
        setTimeout(function () {
            revealEls.forEach(function (el) { el.classList.add('is-in'); });
        }, 2000);
    }

    /* -------------------------------------------------
     * 2) Smooth scroll for #anchors (#vp2-types, #vp2-faq)
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

    /* -------------------------------------------------
     * 3) FAQ — close other items when opening one
     *    (native <details> doesn't do this by default)
     * ------------------------------------------------- */
    var faqItems = root.querySelectorAll('.vp2-faq__item');
    faqItems.forEach(function (item) {
        item.addEventListener('toggle', function () {
            if (item.open) {
                faqItems.forEach(function (other) {
                    if (other !== item && other.open) other.open = false;
                });
            }
        });
    });

})();
