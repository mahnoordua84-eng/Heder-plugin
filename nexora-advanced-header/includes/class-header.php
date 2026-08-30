<?php
/**
 * Header renderer and display controller.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

/**
 * Decides whether to render the header, applies preset colors, and loads template parts.
 */
class Nexora_Header_Header {

    private $settings;
    private $woocommerce;
    private $nav;
    private $search;
    private $cart;
    private $social;

    public function __construct( $settings, $woocommerce ) {
        $this->settings    = $settings;
        $this->woocommerce = $woocommerce;
        $this->nav         = new Nexora_Header_Navigation( $settings );
        $this->search      = new Nexora_Header_Search( $settings, $woocommerce );
        $this->cart        = new Nexora_Header_Cart( $settings, $woocommerce );
        $this->social      = new Nexora_Header_Social( $settings );

        add_action( 'wp_head', array( $this, 'inject_dynamic_css' ), 99 );
    }

    public function should_display() {
        $settings = $this->settings->all();
        if ( empty( $settings['enabled'] ) ) {
            return false;
        }

        $locations = isset( $settings['display_locations'] ) ? $settings['display_locations'] : array( 'entire_site' );
        if ( in_array( 'entire_site', $locations, true ) ) {
            return $this->check_exclusions();
        }

        $match = false;
        if ( in_array( 'homepage', $locations, true ) && ( is_front_page() || is_home() ) ) {
            $match = true;
        }
        if ( in_array( 'shop', $locations, true ) && function_exists( 'is_shop' ) && is_shop() ) {
            $match = true;
        }
        if ( in_array( 'product', $locations, true ) && function_exists( 'is_product' ) && is_product() ) {
            $match = true;
        }
        if ( in_array( 'cart', $locations, true ) && function_exists( 'is_cart' ) && is_cart() ) {
            $match = true;
        }
        if ( in_array( 'checkout', $locations, true ) && function_exists( 'is_checkout' ) && is_checkout() ) {
            $match = true;
        }
        if ( in_array( 'account', $locations, true ) && function_exists( 'is_account_page' ) && is_account_page() ) {
            $match = true;
        }
        if ( in_array( 'blog', $locations, true ) && ( is_single() || is_category() || is_tag() || is_date() ) ) {
            $match = true;
        }
        if ( in_array( 'pages', $locations, true ) && is_page() ) {
            $match = true;
        }
        if ( in_array( 'archives', $locations, true ) && is_archive() ) {
            $match = true;
        }

        return $match && $this->check_exclusions();
    }

    private function check_exclusions() {
        $settings = $this->settings->all();

        $exclude_pages = isset( $settings['exclude_pages'] ) ? (array) $settings['exclude_pages'] : array();
        if ( is_page() && in_array( get_the_ID(), $exclude_pages, true ) ) {
            return false;
        }

        $exclude_urls = isset( $settings['exclude_urls'] ) ? trim( $settings['exclude_urls'] ) : '';
        if ( '' !== $exclude_urls ) {
            $urls = array_filter( array_map( 'trim', explode( "\n", $exclude_urls ) ) );
            $current = esc_url_raw( home_url( add_query_arg( array(), $_SERVER['REQUEST_URI'] ?? '' ) ) );
            foreach ( $urls as $url ) {
                if ( '' !== $url && false !== strpos( $current, trim( $url ) ) ) {
                    return false;
                }
            }
        }

        return true;
    }

    public function inject_dynamic_css() {
        if ( ! $this->should_display() ) {
            return;
        }
        $s = $this->settings->all();

        $bg = '';
        if ( 'gradient' === $s['header_bg_type'] ) {
            $bg = "linear-gradient({$s['header_gradient_dir']}, {$s['header_gradient_1']}, {$s['header_gradient_2']})";
        } elseif ( 'transparent' === $s['header_bg_type'] ) {
            $bg = 'transparent';
        } else {
            $bg = $s['header_bg_color'];
        }

        $shadow = 'none';
        $shadows = array(
            'none' => 'none',
            'sm'   => '0 1px 3px rgba(0,0,0,0.08)',
            'md'   => '0 4px 12px rgba(0,0,0,0.1)',
            'lg'   => '0 10px 30px rgba(0,0,0,0.14)',
        );
        if ( isset( $shadows[ $s['header_shadow'] ] ) ) {
            $shadow = $shadows[ $s['header_shadow'] ];
        }

        $glass = '';
        if ( $s['header_glass'] ) {
            $glass = 'backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); background: rgba(255,255,255,0.7);';
        }

        $css = ":root{--nexora-header-bg:{$bg};--nexora-header-height:{$s['header_height']}px;--nexora-header-radius:{$s['header_radius']}px;--nexora-header-shadow:{$shadow};--nexora-menu-color:{$s['menu_text_color']};--nexora-menu-hover:{$s['menu_hover_color']};--nexora-menu-active:{$s['menu_active_color']};--nexora-menu-bg:{$s['menu_bg']};--nexora-menu-spacing:{$s['menu_spacing']}px;--nexora-menu-radius:{$s['menu_radius']}px;--nexora-menu-font:{$s['menu_font_size']}px;--nexora-cart-counter-bg:{$s['cart_counter_bg']};--nexora-cart-counter-text:{$s['cart_counter_text']};--nexora-cta-bg:{$s['cta_bg']};--nexora-cta-text:{$s['cta_text_color']};--nexora-cta-hover:{$s['cta_hover_bg']};--nexora-cta-radius:{$s['cta_radius']}px;--nexora-bottom-grad:linear-gradient({$s['header_gradient_dir']},{$s['bottom_gradient_1']},{$s['bottom_gradient_2']});--nexora-bottom-text:{$s['bottom_text_color']};--nexora-ann-bg:{$s['announcement_bg_color']};--nexora-ann-text:{$s['announcement_text_color']};--nexora-ann-height:{$s['announcement_height']}px;--nexora-ann-font:{$s['announcement_font_size']}px;--nexora-social-color:{$s['social_icon_color']};--nexora-social-hover:{$s['social_hover_color']};--nexora-glass:{$glass};}";

        echo '<style id="nexora-dynamic-css">' . wp_strip_all_tags( $css ) . '</style>' . "\n";
    }

    public function render() {
        $s = $this->settings->all();

        $sticky_class = '';
        if ( $s['sticky_enabled'] ) {
            $sticky_class = ' nexora-sticky nexora-sticky-' . esc_attr( $s['sticky_behavior'] );
            if ( $s['sticky_shrink'] ) {
                $sticky_class .= ' nexora-sticky-shrink';
            }
            if ( $s['sticky_shadow'] ) {
                $sticky_class .= ' nexora-sticky-shadow';
            }
        }

        echo '<div class="nexora-header-wrap' . esc_attr( $sticky_class ) . '" data-offset="' . esc_attr( $s['sticky_scroll_offset'] ) . '">';

        if ( $s['announcement_enabled'] ) {
            $this->render_template( 'announcement' );
        }

        echo '<header class="nexora-header" role="banner">';

        $this->render_template( 'header' );

        echo '</header>';

        if ( $s['bottom_enabled'] ) {
            $this->render_template( 'bottom-animation' );
        }

        echo '</div>';

        $this->render_template( 'mobile-menu' );

        if ( $s['cart_enabled'] && $s['mini_cart_enabled'] ) {
            $this->render_template( 'cart' );
        }
    }

    public function render_template( $name ) {
        $s    = $this->settings->all();
        $path = NEXORA_HEADER_DIR . 'templates/' . $name . '.php';
        if ( ! file_exists( $path ) ) {
            return;
        }

        $settings    = $s;
        $woocommerce = $this->woocommerce;
        $nav         = $this->nav;
        $search      = $this->search;
        $cart        = $this->cart;
        $social      = $this->social;

        include $path;
    }
}
