<?php
/**
 * Search bar renderer.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

/**
 * Renders desktop expandable and mobile full-width search with AJAX-ready attributes.
 */
class Nexora_Header_Search {

    private $settings;
    private $woocommerce;

    public function __construct( $settings, $woocommerce ) {
        $this->settings    = $settings;
        $this->woocommerce = $woocommerce;
    }

    public function render() {
        if ( ! $this->settings->get( 'search_enabled' ) ) {
            return;
        }

        $type = $this->settings->get( 'search_type', 'product' );
        $placeholder = $this->settings->get( 'search_placeholder', __( 'Search...', 'nexora-advanced-header' ) );

        $action = home_url( '/' );
        $name = 's';
        $hidden = '';
        if ( 'product' === $type && $this->woocommerce->is_active() ) {
            $hidden = '<input type="hidden" name="post_type" value="product" />';
        }

        echo '<div class="nexora-search">';
        echo '<button class="nexora-search-toggle" type="button" aria-label="' . esc_attr__( 'Open search', 'nexora-advanced-header' ) . '">';
        echo '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/><path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>';
        echo '</button>';

        echo '<form role="search" method="get" class="nexora-search-form" action="' . esc_url( $action ) . '">';
        echo '<label class="screen-reader-text" for="nexora-search-field">' . esc_html__( 'Search for:', 'nexora-advanced-header' ) . '</label>';
        echo '<input type="search" id="nexora-search-field" class="nexora-search-field" name="' . esc_attr( $name ) . '" placeholder="' . esc_attr( $placeholder ) . '" autocomplete="off" />';
        echo $hidden;
        echo '<button type="submit" class="nexora-search-btn" aria-label="' . esc_attr__( 'Submit search', 'nexora-advanced-header' ) . '">';
        echo '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2"/><path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>';
        echo '</button>';
        echo '<button type="button" class="nexora-search-close" aria-label="' . esc_attr__( 'Close search', 'nexora-advanced-header' ) . '">&times;</button>';
        echo '</form>';
        echo '</div>';
    }
}
