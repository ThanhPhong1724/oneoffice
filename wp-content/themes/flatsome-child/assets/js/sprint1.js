/**
 * Sprint 1 — OneOffice UI enhancements
 * Scroll reveal, counter animation, floating CTA (Zalo/Messenger), sticky header class.
 */
(function ($) {
    'use strict';

    /* ----------------------------------------------------------
     * 1. STICKY HEADER — thêm class khi scroll xuống
     * ---------------------------------------------------------- */
    var $header = $('#header');
    var SCROLL_THRESHOLD = 60;

    function updateHeaderClass() {
        if ($(window).scrollTop() > SCROLL_THRESHOLD) {
            $header.addClass('header-scrolled');
        } else {
            $header.removeClass('header-scrolled');
        }
    }
    $(window).on('scroll.ooHeader', updateHeaderClass);
    updateHeaderClass();

    /* ----------------------------------------------------------
     * 2. SCROLL REVEAL — Intersection Observer (CSS .oo-reveal)
     *    Adds .oo-revealed when element enters viewport.
     *    To use: add class "oo-reveal" to any element in UX Builder.
     * ---------------------------------------------------------- */
    if ('IntersectionObserver' in window) {
        var revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('oo-revealed');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

        document.querySelectorAll('.oo-reveal').forEach(function (el) {
            revealObserver.observe(el);
        });
    } else {
        // Fallback: show everything immediately
        document.querySelectorAll('.oo-reveal').forEach(function (el) {
            el.classList.add('oo-revealed');
        });
    }

    /* ----------------------------------------------------------
     * 3. COUNTER ANIMATION — đếm từ 0 lên số đích
     *    Usage: <span class="oo-counter" data-target="150" data-suffix="+">0</span>
     * ---------------------------------------------------------- */
    function animateCounter($el) {
        var target  = parseInt($el.data('target'), 10) || 0;
        var suffix  = $el.data('suffix') || '';
        var prefix  = $el.data('prefix') || '';
        var duration = 1800; // ms
        var start    = 0;
        var startTime = null;

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            var progress = Math.min((timestamp - startTime) / duration, 1);
            // ease-out cubic
            var eased = 1 - Math.pow(1 - progress, 3);
            var current = Math.floor(eased * target);
            $el.text(prefix + current.toLocaleString('vi-VN') + suffix);
            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                $el.text(prefix + target.toLocaleString('vi-VN') + suffix);
            }
        }
        requestAnimationFrame(step);
    }

    if ('IntersectionObserver' in window) {
        var counterObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    animateCounter($(entry.target));
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });

        document.querySelectorAll('.oo-counter').forEach(function (el) {
            counterObserver.observe(el);
        });
    }

    /* ----------------------------------------------------------
     * 4. FLOATING CTA — Handled server-side in call-now-button plugin
     * ---------------------------------------------------------- */


    /* ----------------------------------------------------------
     * 5. MENU HOVER — preload submenu nếu có link
     * ---------------------------------------------------------- */
    // Đã xử lý qua CSS :hover, JS chỉ handle touch/mobile toggle nếu cần
    // (Flatsome đã có mobile menu handler riêng)

    /* ----------------------------------------------------------
     * 6. COPY POST LINK — Sao chép liên kết bài viết
     * ---------------------------------------------------------- */
    window.ooCopyPostLink = function (url) {
        var event = window.event;
        var $btn = $('.oo-share-btn--copy');
        if (event && event.currentTarget) {
            $btn = $(event.currentTarget);
        } else if (event && event.target) {
            $btn = $(event.target).closest('.oo-share-btn--copy');
        }

        var $text = $btn.find('.oo-copy-text');
        var originalText = $text.text() || 'Sao chép link';

        function showSuccess() {
            $btn.addClass('copied');
            $text.text('Đã sao chép!');
            setTimeout(function () {
                $btn.removeClass('copied');
                $text.text(originalText);
            }, 2000);
        }

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(url).then(showSuccess).catch(function (err) {
                fallbackCopy(url);
            });
        } else {
            fallbackCopy(url);
        }

        function fallbackCopy(textVal) {
            var textArea = document.createElement("textarea");
            textArea.value = textVal;
            textArea.style.top = "0";
            textArea.style.left = "0";
            textArea.style.position = "fixed";
            textArea.style.opacity = "0";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                var successful = document.execCommand('copy');
                if (successful) {
                    showSuccess();
                } else {
                    console.error('Fallback copy failed');
                }
            } catch (err) {
                console.error('Fallback copy threw error', err);
            }
            document.body.removeChild(textArea);
        }
    };

}(jQuery));
