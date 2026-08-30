<?php
/**
 * WooCommerce integration layer.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

/**
 * Detects WooCommerce, exposes cart data, and registers AJAX cart fragment endpoints.
 */
class Nexora_Header_WooCommerce {

    private $settings;
    private $active = false;

    public function __construct( $settings ) {
        $this->settings = $settings;
        $this->active    = class_exists( 'WooCommerce' );

        if ( $this->active ) {
            add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'cart_fragment' ) );
            add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_wc_fragments' ), 5 );
        }

        add_action( 'wp_ajax_nexora_refresh_cart', array( $this, 'ajax_refresh_cart' ) );
        add_action( 'wp_ajax_nopriv_nexora_refresh_cart', array( $this, 'ajax_refresh_cart' ) );
        add_action( 'wp_ajax_nexora_remove_cart_item', array( $this, 'ajax_remove_cart_item' ) );
        add_action( 'wp_ajax_nopriv_nexora_remove_cart_item', array( $this, 'ajax_remove_cart_item' ) );
    }

    public function is_active() {
        return $this->active;
    }

    public function cart_count() {
        if ( ! $this->active ) {
            return 0;
        }
        $cart = WC()->cart ?? null;
        if ( ! $cart ) {
            return 0;
        }
        return intval( $cart->get_cart_contents_count() );
    }

    public function cart_total() {
        if ( ! $this->active ) {
            return '';
        }
        $cart = WC()->cart ?? null;
        if ( ! $cart ) {
            return '';
        }
        return wp_strip_all_tags( html_entity_decode( $cart->get_cart_total() ) );
    }

    public function cart_url() {
        if ( $this->active && function_exists( 'wc_get_cart_url' ) ) {
            return esc_url( wc_get_cart_url() );
        }
        return '';
    }

    public function checkout_url() {
        if ( $this->active && function_exists( 'wc_get_checkout_url' ) ) {
            return esc_url( wc_get_checkout_url() );
        }
        return '';
    }

    public function account_url() {
        if ( $this->active && function_exists( 'wc_get_page_permalink' ) ) {
            return esc_url( wc_get_page_permalink( 'myaccount' ) );
        }
        return esc_url( wp_login_url() );
    }

    public function shop_url() {
        if ( $this->active && function_exists( 'wc_get_page_permalink' ) ) {
            return esc_url( wc_get_page_permalink( 'shop' ) );
        }
        return '';
    }

    public function mini_cart_items() {
        if ( ! $this->active ) {
            return array();
        }
        $cart = WC()->cart ?? null;
        if ( ! $cart || $cart->is_empty() ) {
            return array();
        }

        $items = array();
        foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) {
            $product = $cart_item['data'] ?? null;
            if ( ! $product ) {
                continue;
            }
            $items[] = array(
                'key'      => $cart_item_key,
                'name'     => wp_strip_all_tags( $product->get_name() ),
                'price'    => wp_strip_all_tags( html_entity_decode( wc_price( $product->get_price() ) ) ),
                'quantity' => intval( $cart_item['quantity'] ),
                'image'    => $product->get_image( array( 60, 60 ) ),
                'url'      => esc_url( $product->get_permalink() ),
            );
        }
        return $items;
    }

    public function cart_fragment( $fragments ) {
        $count = $this->cart_count();
        $fragments['span.nexora-cart-count'] = '<span class="nexora-cart-count" data-count="' . esc_attr( $count ) . '">' . esc_html( $count ) . '</span>';
        return $fragments;
    }

    public function dequeue_wc_fragments() {
        if ( ! $this->settings->get( 'cart_enabled' ) ) {
            wp_dequeue_script( 'wc-cart-fragments' );
        }
    }

    public function ajax_refresh_cart() {
        check_ajax_referer( 'nexora_header_nonce', 'nonce' );
        wp_send_json_success( array(
            'count' => $this->cart_count(),
            'total' => $this->cart_total(),
            'items' => $this->mini_cart_items(),
        ) );
    }

    public function ajax_remove_cart_item() {
        check_ajax_referer( 'nexora_header_nonce', 'nonce' );
        if ( ! $this->active ) {
            wp_send_json_error();
        }
        $key = isset( $_POST['key'] ) ? sanitize_text_field( wp_unslash( $_POST['key'] ) ) : '';
        if ( '' === $key ) {
            wp_send_json_error();
        }
        $cart = WC()->cart ?? null;
        if ( $cart ) {
            $cart->remove_cart_item( $key );
        }
        wp_send_json_success( array(
            'count' => $this->cart_count(),
            'total' => $this->cart_total(),
            'items' => $this->mini_cart_items(),
        ) );
    }
}
