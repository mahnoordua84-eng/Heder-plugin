<?php
/**
 * Cart icon and mini cart renderer.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

/**
 * Renders the cart icon with live counter and the mini cart drawer populated from WooCommerce.
 */
class Nexora_Header_Cart {

    private $settings;
    private $woocommerce;

    public function __construct( $settings, $woocommerce ) {
        $this->settings    = $settings;
        $this->woocommerce = $woocommerce;
    }

    public function render_icon() {
        if ( ! $this->settings->get( 'cart_enabled' ) ) {
            return;
        }

        $count = $this->woocommerce->cart_count();
        $url = $this->woocommerce->cart_url();
        if ( '' === $url ) {
            $url = '#';
        }

        $mini = $this->settings->get( 'mini_cart_enabled' );

        echo '<div class="nexora-cart">';
        echo '<a href="' . esc_url( $url ) . '" class="nexora-cart-toggle" aria-label="' . esc_attr__( 'View cart', 'nexora-advanced-header' ) . '" data-mini="' . esc_attr( $mini ? '1' : '0' ) . '">';
        echo '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="9" cy="21" r="1" fill="currentColor"/><circle cx="20" cy="21" r="1" fill="currentColor"/><path d="M1 1h4l2.7 13.4a2 2 0 0 0 2 1.6h9.7a2 2 0 0 0 2-1.6L23 6H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        echo '<span class="nexora-cart-count" data-count="' . esc_attr( $count ) . '">' . esc_html( $count ) . '</span>';
        echo '</a>';
        echo '</div>';
    }

    public function render_mini_cart() {
        if ( ! $this->settings->get( 'cart_enabled' ) || ! $this->settings->get( 'mini_cart_enabled' ) ) {
            return;
        }
        if ( ! $this->woocommerce->is_active() ) {
            return;
        }

        $items = $this->woocommerce->mini_cart_items();
        $total = $this->woocommerce->cart_total();
        $cart_url = $this->woocommerce->cart_url();
        $checkout_url = $this->woocommerce->checkout_url();

        echo '<div class="nexora-mini-cart" role="dialog" aria-label="' . esc_attr__( 'Shopping cart', 'nexora-advanced-header' ) . '">';
        echo '<div class="nexora-mini-cart-header">';
        echo '<h3>' . esc_html__( 'Cart', 'nexora-advanced-header' ) . '</h3>';
        echo '<button type="button" class="nexora-mini-cart-close" aria-label="' . esc_attr__( 'Close cart', 'nexora-advanced-header' ) . '">&times;</button>';
        echo '</div>';

        echo '<div class="nexora-mini-cart-items">';
        if ( empty( $items ) ) {
            echo '<p class="nexora-mini-cart-empty">' . esc_html__( 'Your cart is empty.', 'nexora-advanced-header' ) . '</p>';
        } else {
            foreach ( $items as $item ) {
                echo '<div class="nexora-mini-cart-item" data-key="' . esc_attr( $item['key'] ) . '">';
                echo '<div class="nexora-mci-image">' . wp_kses_post( $item['image'] ) . '</div>';
                echo '<div class="nexora-mci-info">';
                echo '<a href="' . esc_url( $item['url'] ) . '" class="nexora-mci-name">' . esc_html( $item['name'] ) . '</a>';
                echo '<span class="nexora-mci-qty">' . esc_html( sprintf( __( 'Qty: %d', 'nexora-advanced-header' ), $item['quantity'] ) ) . '</span>';
                echo '<span class="nexora-mci-price">' . wp_kses_post( $item['price'] ) . '</span>';
                echo '</div>';
                echo '<a href="#" class="nexora-mci-remove" data-key="' . esc_attr( $item['key'] ) . '" aria-label="' . esc_attr__( 'Remove item', 'nexora-advanced-header' ) . '">&times;</a>';
                echo '</div>';
            }
        }
        echo '</div>';

        if ( ! empty( $items ) ) {
            echo '<div class="nexora-mini-cart-footer">';
            echo '<div class="nexora-mini-cart-total"><span>' . esc_html__( 'Subtotal:', 'nexora-advanced-header' ) . '</span> <span>' . wp_kses_post( $total ) . '</span></div>';
            echo '<div class="nexora-mini-cart-actions">';
            echo '<a href="' . esc_url( $cart_url ) . '" class="nexora-btn nexora-btn-secondary">' . esc_html__( 'View Cart', 'nexora-advanced-header' ) . '</a>';
            echo '<a href="' . esc_url( $checkout_url ) . '" class="nexora-btn nexora-btn-primary">' . esc_html__( 'Checkout', 'nexora-advanced-header' ) . '</a>';
            echo '</div>';
            echo '</div>';
        }

        echo '</div>';
        echo '<div class="nexora-mini-cart-overlay"></div>';
    }
}
