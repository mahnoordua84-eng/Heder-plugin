/* Nexora Advanced Header - Mobile Menu JavaScript */
(function() {
    'use strict';

    var mobileMenu = {
        init: function() {
            this.bindToggle();
            this.bindClose();
            this.bindAccordion();
        },

        bindToggle: function() {
            var hamburger = document.querySelector('.nexora-hamburger');
            var menu = document.getElementById('nexora-mobile-menu');
            var overlay = document.querySelector('.nexora-mobile-overlay');

            if (!hamburger || !menu) return;

            hamburger.addEventListener('click', function() {
                var isOpen = menu.classList.contains('open');
                if (isOpen) {
                    mobileMenu.close();
                } else {
                    mobileMenu.open();
                }
            });
        },

        open: function() {
            var menu = document.getElementById('nexora-mobile-menu');
            var overlay = document.querySelector('.nexora-mobile-overlay');
            var hamburger = document.querySelector('.nexora-hamburger');

            if (!menu) return;

            menu.classList.add('open');
            if (overlay) overlay.classList.add('show');
            if (hamburger) hamburger.classList.add('active');
            hamburger.setAttribute('aria-expanded', 'true');
            document.body.classList.add('nexora-no-scroll');

            var closeBtn = menu.querySelector('.nexora-mobile-close');
            if (closeBtn) setTimeout(function() { closeBtn.focus(); }, 200);
        },

        close: function() {
            var menu = document.getElementById('nexora-mobile-menu');
            var overlay = document.querySelector('.nexora-mobile-overlay');
            var hamburger = document.querySelector('.nexora-hamburger');

            if (!menu) return;

            menu.classList.remove('open');
            if (overlay) overlay.classList.remove('show');
            if (hamburger) {
                hamburger.classList.remove('active');
                hamburger.setAttribute('aria-expanded', 'false');
            }
            document.body.classList.remove('nexora-no-scroll');
        },

        bindClose: function() {
            var overlay = document.querySelector('.nexora-mobile-overlay');
            var closeBtn = document.querySelector('.nexora-mobile-close');

            if (overlay) overlay.addEventListener('click', this.close);
            if (closeBtn) closeBtn.addEventListener('click', this.close);

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    var menu = document.getElementById('nexora-mobile-menu');
                    if (menu && menu.classList.contains('open')) {
                        mobileMenu.close();
                    }
                }
            });
        },

        bindAccordion: function() {
            var arrows = document.querySelectorAll('.nexora-mobile-arrow');
            arrows.forEach(function(arrow) {
                arrow.addEventListener('click', function(e) {
                    e.preventDefault();
                    var submenu = arrow.nextElementSibling;
                    if (!submenu) return;

                    var isOpen = submenu.classList.contains('open');
                    arrow.classList.toggle('active');
                    arrow.setAttribute('aria-expanded', !isOpen);
                    submenu.classList.toggle('open');
                });
            });
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', mobileMenu.init.bind(mobileMenu));
    } else {
        mobileMenu.init();
    }
})();
