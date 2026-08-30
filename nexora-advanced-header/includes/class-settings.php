<?php
/**
 * Settings management for Nexora Advanced Header.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

/**
 * Handles defaults, retrieval, sanitization, import/export, and reset for the single plugin option.
 */
class Nexora_Header_Settings {

    private $settings = null;

    public static function get_defaults() {
        return array(
            'enabled'              => true,
            'preset'               => 'modern_ecommerce',
            'sticky_enabled'       => true,
            'sticky_behavior'      => 'after_scroll',
            'sticky_scroll_offset' => 200,
            'sticky_shrink'        => true,
            'sticky_shadow'        => true,

            'announcement_enabled' => true,
            'announcement_text'    => 'Premium Quality Products • Fast Delivery • Secure Shopping • Trusted Service',
            'announcement_link'    => '',
            'announcement_text_color' => '#ffffff',
            'announcement_bg_color'   => '#111827',
            'announcement_font_size'  => 13,
            'announcement_height'     => 38,
            'announcement_speed'      => 30,
            'announcement_direction'  => 'left',
            'announcement_closeable'  => true,

            'logo_id'            => 0,
            'logo_mobile_id'     => 0,
            'logo_url'           => '',
            'logo_width'         => 180,
            'logo_height'        => 48,
            'logo_spacing'       => 0,
            'logo_animation'     => 'none',

            'menu_location'      => 'nexora_primary',
            'menu_alignment'     => 'center',
            'menu_typography'    => 'inherit',
            'menu_font_size'     => 15,
            'menu_font_weight'   => '500',
            'menu_letter_spacing' => 0,
            'menu_text_color'    => '#1f2937',
            'menu_hover_color'   => '#6d28d9',
            'menu_active_color'  => '#6d28d9',
            'menu_bg'            => 'transparent',
            'menu_spacing'       => 24,
            'menu_radius'        => 8,
            'menu_hover_animation' => 'underline',
            'dropdown_radius'    => 12,
            'dropdown_shadow'    => true,
            'dropdown_animation' => 'fade',
            'mega_menu_enabled'  => true,
            'mega_menu_columns'  => 4,

            'search_enabled'    => true,
            'search_placeholder' => 'Search products...',
            'search_type'       => 'product',
            'search_icon_color' => '#1f2937',

            'cart_enabled'      => true,
            'cart_icon_color'   => '#1f2937',
            'cart_counter_bg'   => '#ef4444',
            'cart_counter_text' => '#ffffff',
            'mini_cart_enabled'  => true,

            'account_enabled'    => true,
            'account_icon_color' => '#1f2937',

            'social_enabled'    => true,
            'social_facebook'   => '',
            'social_instagram'  => '',
            'social_whatsapp'   => '',
            'social_youtube'    => '',
            'social_tiktok'     => '',
            'social_twitter'    => '',
            'social_linkedin'   => '',
            'social_pinterest'  => '',
            'social_icon_color' => '#1f2937',
            'social_hover_color' => '#6d28d9',
            'social_new_tab'    => true,

            'cta_enabled'   => true,
            'cta_text'      => 'Shop Now',
            'cta_url'       => '#',
            'cta_icon'      => '',
            'cta_bg'        => '#6d28d9',
            'cta_text_color' => '#ffffff',
            'cta_hover_bg'  => '#5b21b6',
            'cta_radius'    => 10,
            'cta_padding_y' => 10,
            'cta_padding_x' => 22,
            'cta_animation' => 'pulse',

            'header_bg_type'   => 'gradient',
            'header_bg_color'  => '#ffffff',
            'header_gradient_1' => '#ffffff',
            'header_gradient_2' => '#f3f4f6',
            'header_gradient_dir' => 'to right',
            'header_shadow'    => 'sm',
            'header_radius'    => 0,
            'header_height'    => 80,
            'header_glass'     => false,

            'bottom_enabled'    => true,
            'bottom_text'       => 'Free Delivery Above Rs. 2500 • Premium Quality • Fresh Products • Secure Shopping',
            'bottom_speed'      => 25,
            'bottom_direction'  => 'left',
            'bottom_pause_hover' => true,
            'bottom_glow'      => true,
            'bottom_gradient_1' => '#6d28d9',
            'bottom_gradient_2' => '#2563eb',
            'bottom_text_color' => '#ffffff',

            'mobile_show_search' => true,
            'mobile_show_cart'   => true,
            'mobile_show_social' => true,
            'mobile_show_cta'    => true,
            'mobile_menu_side'   => 'left',
            'mobile_menu_width'  => 320,

            'display_locations' => array( 'entire_site' ),
            'exclude_pages'      => array(),
            'exclude_urls'       => '',

            'custom_css' => '',
            'custom_js'  => '',
        );
    }

    public function all() {
        if ( null === $this->settings ) {
            $saved  = get_option( NEXORA_HEADER_OPTION, array() );
            $defaults = self::get_defaults();
            if ( ! is_array( $saved ) ) {
                $saved = array();
            }
            $this->settings = wp_parse_args( $saved, $defaults );
        }
        return $this->settings;
    }

    public function get( $key, $fallback = null ) {
        $all = $this->all();
        if ( isset( $all[ $key ] ) ) {
            return $all[ $key ];
        }
        return $fallback;
    }

    public function update( $new_values ) {
        $sanitized = $this->sanitize( $new_values );
        update_option( NEXORA_HEADER_OPTION, $sanitized );
        $this->settings = $sanitized;
        return $sanitized;
    }

    public function reset() {
        $defaults = self::get_defaults();
        update_option( NEXORA_HEADER_OPTION, $defaults );
        $this->settings = $defaults;
        return $defaults;
    }

    public function export() {
        return wp_json_encode( $this->all() );
    }

    public function import( $json ) {
        $data = json_decode( wp_unslash( $json ), true );
        if ( ! is_array( $data ) ) {
            return new WP_Error( 'nexora_import_invalid', __( 'Invalid settings file.', 'nexora-advanced-header' ) );
        }
        $defaults = self::get_defaults();
        $merged   = wp_parse_args( $data, $defaults );
        return $this->update( $merged );
    }

    public function sanitize( $input ) {
        $defaults = self::get_defaults();
        $out      = array();

        foreach ( $defaults as $key => $default ) {
            $value = isset( $input[ $key ] ) ? $input[ $key ] : $default;

            if ( in_array( $key, array(
                'enabled', 'sticky_enabled', 'sticky_shrink', 'sticky_shadow',
                'announcement_enabled', 'announcement_closeable',
                'mega_menu_enabled', 'search_enabled', 'cart_enabled', 'mini_cart_enabled',
                'account_enabled', 'social_enabled', 'social_new_tab',
                'cta_enabled', 'bottom_enabled', 'bottom_pause_hover', 'bottom_glow',
                'header_glass', 'mobile_show_search', 'mobile_show_cart',
                'mobile_show_social', 'mobile_show_cta',
            ), true ) ) {
                $out[ $key ] = (bool) $value;
            } elseif ( in_array( $key, array(
                'logo_id', 'logo_mobile_id', 'announcement_font_size', 'announcement_height',
                'announcement_speed', 'logo_width', 'logo_height', 'logo_spacing',
                'menu_font_size', 'menu_spacing', 'menu_radius', 'dropdown_radius',
                'mega_menu_columns', 'sticky_scroll_offset', 'header_height', 'header_radius',
                'bottom_speed', 'mobile_menu_width', 'cta_radius', 'cta_padding_x', 'cta_padding_y',
            ), true ) ) {
                $out[ $key ] = absint( $value );
            } elseif ( in_array( $key, array(
                'announcement_text_color', 'announcement_bg_color', 'menu_text_color',
                'menu_hover_color', 'menu_active_color', 'menu_bg', 'search_icon_color',
                'cart_icon_color', 'cart_counter_bg', 'cart_counter_text',
                'account_icon_color', 'social_icon_color', 'social_hover_color',
                'cta_bg', 'cta_text_color', 'cta_hover_bg',
                'header_bg_color', 'header_gradient_1', 'header_gradient_2',
                'bottom_gradient_1', 'bottom_gradient_2', 'bottom_text_color',
            ), true ) ) {
                $out[ $key ] = sanitize_hex_color( $value ) ? sanitize_hex_color( $value ) : $default;
            } elseif ( in_array( $key, array( 'custom_css', 'custom_js', 'exclude_urls' ), true ) ) {
                $out[ $key ] = $value;
            } elseif ( in_array( $key, array( 'display_locations', 'exclude_pages' ), true ) ) {
                $out[ $key ] = is_array( $value ) ? array_map( 'sanitize_text_field', $value ) : array();
            } elseif ( in_array( $key, array( 'menu_letter_spacing' ), true ) ) {
                $out[ $key ] = floatval( $value );
            } else {
                $out[ $key ] = sanitize_text_field( wp_unslash( $value ) );
            }
        }

        $out['custom_css'] = isset( $input['custom_css'] ) ? wp_unslash( $input['custom_css'] ) : '';
        $out['custom_js']  = isset( $input['custom_js'] ) ? wp_unslash( $input['custom_js'] ) : '';

        return $out;
    }
}
