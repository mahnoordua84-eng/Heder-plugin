<?php
/**
 * Security helpers for Nexora Advanced Header.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

/**
 * Centralizes nonce verification, capability checks, and safe AJAX guards.
 */
class Nexora_Header_Security {

    public static function verify_nonce( $action = 'nexora_header_nonce' ) {
        $nonce = '';
        if ( isset( $_REQUEST['nonce'] ) ) {
            $nonce = sanitize_text_field( wp_unslash( $_REQUEST['nonce'] ) );
        } elseif ( isset( $_REQUEST['_wpnonce'] ) ) {
            $nonce = sanitize_text_field( wp_unslash( $_REQUEST['_wpnonce'] ) );
        }
        return boolval( wp_verify_nonce( $nonce, $action ) );
    }

    public static function can_manage() {
        return current_user_can( 'manage_options' );
    }

    public static function can_edit_posts() {
        return current_user_can( 'edit_posts' );
    }

    public static function safe_url( $url, $fallback = '' ) {
        $url = esc_url_raw( wp_unslash( $url ) );
        if ( '' === $url ) {
            return $fallback;
        }
        return $url;
    }
}
