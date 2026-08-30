/* Nexora Advanced Header - Frontend JavaScript */
(function() {
    'use strict';

    var header = {
        init: function() {
            this.stickyHeader();
            this.searchToggle();
            this.miniCart();
            this.cartRefresh();
            this.announcementClose();
        },

        stickyHeader: function() {
            var wrap = document.querySelector('.nexora-header-wrap');
            if (!wrap) return;
            if (!nexoraHeader.sticky) return;

            var offset = parseInt(wrap.getAttribute('data-offset'), 10) || 200;
            var stuck = false;
            var spacer = document.createElement('div');
            spacer.className = 'nexora-sticky-spacer';
            wrap.parentNode.insertBefore(spacer, wrap);

            var onScroll = function() {
                var scrollY = window.scrollY || window.pageYOffset;
                var shouldStick = scrollY > offset;

                if (shouldStick !== stuck) {
                    stuck = shouldStick;
                    if (stuck) {
                        wrap.classList.add('nexora-stuck');
                        spacer.style.display = 'block';
                        spacer.style.height = wrap.offsetHeight + 'px';
                    } else {
                        wrap.classList.remove('nexora-stuck');
                        spacer.style.display = 'none';
                    }
                }
            };

            window.addEventListener('scroll', this.throttle(onScroll, 10), { passive: true });
            onScroll();
        },

        searchToggle: function() {
            var searchWrap = document.querySelector('.nexora-search');
            if (!searchWrap) return;

            var toggle = searchWrap.querySelector('.nexora-search-toggle');
            var closeBtn = searchWrap.querySelector('.nexora-search-close');
            var field = searchWrap.querySelector('.nexora-search-field');

            if (toggle) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    searchWrap.classList.toggle('active');
                    if (searchWrap.classList.contains('active') && field) {
                        setTimeout(function() { field.focus(); }, 100);
                    }
                });
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    searchWrap.classList.remove('active');
                });
            }

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && searchWrap.classList.contains('active')) {
                    searchWrap.classList.remove('active');
                    if (toggle) toggle.focus();
                }
            });
        },

        miniCart: function() {
            var cartToggle = document.querySelector('.nexora-cart-toggle');
            var miniCart = document.querySelector('.nexora-mini-cart');
            var overlay = document.querySelector('.nexora-mini-cart-overlay');
            var closeBtn = document.querySelector('.nexora-mini-cart-close');

            if (!cartToggle || !miniCart) return;

            var miniEnabled = cartToggle.getAttribute('data-mini') === '1';
            if (!miniEnabled) return;

            cartToggle.addEventListener('click', function(e) {
                e.preventDefault();
                miniCart.classList.add('open');
                if (overlay) overlay.classList.add('show');
                document.body.classList.add('nexora-no-scroll');
            });

            var closeCart = function() {
                miniCart.classList.remove('open');
                if (overlay) overlay.classList.remove('show');
                document.body.classList.remove('nexora-no-scroll');
            };

            if (closeBtn) closeBtn.addEventListener('click', closeCart);
            if (overlay) overlay.addEventListener('click', closeCart);

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && miniCart.classList.contains('open')) {
                    closeCart();
                }
            });

            // Remove item
            var removeBtns = miniCart.querySelectorAll('.nexora-mci-remove');
            removeBtns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var key = btn.getAttribute('data-key');
                    header.removeCartItem(key);
                });
            });
        },

        removeCartItem: function(key) {
            fetch(nexoraHeader.ajaxUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=nexora_remove_cart_item&nonce=' + nexoraHeader.nonce + '&key=' + key
            }).then(function(r) { return r.json(); }).then(function() {
                header.refreshCart();
            }).catch(function() {});
        },

        cartRefresh: function() {
            // Listen for WooCommerce add-to-cart events
            document.addEventListener('DOMNodeInserted', function(e) {
                if (e.target && e.target.classList && e.target.classList.contains('added_to_cart')) {
                    header.refreshCart();
                }
            });

            jQuery(document.body).on('updated_cart_totals wc_fragments_refreshed', function() {
                header.refreshCart();
            });

            jQuery(document.body).on('added_to_cart removed_from_cart', function() {
                header.refreshCart();
            });
        },

        refreshCart: function() {
            fetch(nexoraHeader.ajaxUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'action=nexora_refresh_cart&nonce=' + nexoraHeader.nonce
            }).then(function(r) { return r.json(); }).then(function(res) {
                if (!res || !res.success) return;
                var data = res.data;
                var counters = document.querySelectorAll('.nexora-cart-count');
                counters.forEach(function(c) {
                    c.textContent = data.count;
                    c.setAttribute('data-count', data.count);
                });

                if (data.items && data.items.length >= 0) {
                    var itemsContainer = document.querySelector('.nexora-mini-cart-items');
                    var footer = document.querySelector('.nexora-mini-cart-footer');
                    if (!itemsContainer) return;

                    if (data.items.length === 0) {
                        itemsContainer.innerHTML = '<p class="nexora-mini-cart-empty">' + nexoraHeader.emptyText + '</p>';
                        if (footer) footer.style.display = 'none';
                        return;
                    }

                    var html = '';
                    data.items.forEach(function(item) {
                        html += '<div class="nexora-mini-cart-item" data-key="' + item.key + '">';
                        html += '<div class="nexora-mci-image">' + item.image + '</div>';
                        html += '<div class="nexora-mci-info">';
                        html += '<a href="' + item.url + '" class="nexora-mci-name">' + item.name + '</a>';
                        html += '<span class="nexora-mci-qty">Qty: ' + item.quantity + '</span>';
                        html += '<span class="nexora-mci-price">' + item.price + '</span>';
                        html += '</div>';
                        html += '<a href="#" class="nexora-mci-remove" data-key="' + item.key + '">&times;</a>';
                        html += '</div>';
                    });
                    itemsContainer.innerHTML = html;

                    if (footer) {
                        footer.style.display = 'flex';
                        var totalEl = footer.querySelector('.nexora-mini-cart-total span:last-child');
                        if (totalEl) totalEl.textContent = data.total;
                    }

                    header.bindRemoveButtons();
                }
            }).catch(function() {});
        },

        bindRemoveButtons: function() {
            var btns = document.querySelectorAll('.nexora-mci-remove');
            btns.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    header.removeCartItem(btn.getAttribute('data-key'));
                });
            });
        },

        announcementClose: function() {
            var ann = document.querySelector('.nexora-announcement');
            if (!ann) return;
            var closeBtn = ann.querySelector('.nexora-announcement-close');
            if (!closeBtn) return;

            closeBtn.addEventListener('click', function() {
                ann.classList.add('hidden');
                try { sessionStorage.setItem('nexora_ann_closed', '1'); } catch(e) {}
            });

            try {
                if (sessionStorage.getItem('nexora_ann_closed') === '1') {
                    ann.classList.add('hidden');
                }
            } catch(e) {}
        },

        throttle: function(fn, wait) {
            var last = 0;
            return function() {
                var now = Date.now();
                if (now - last >= wait) {
                    last = now;
                    fn.apply(this, arguments);
                }
            };
        }
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', header.init.bind(header));
    } else {
        header.init();
    }
})();
