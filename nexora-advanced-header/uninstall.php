<?php
/**
 * Uninstall Nexora Advanced Header.
 *
 * Removes plugin option on uninstall. Only runs when the user explicitly
 * deletes the plugin from the WordPress admin.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

delete_option( 'nexora_header_settings' );
delete_transient( 'nexora_header_wc_notice' );
