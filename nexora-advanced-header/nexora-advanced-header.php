<?php
/**
 * Plugin Name:       Nexora Advanced Header
 * Plugin URI:        https://example.com/nexora-advanced-header
 * Description:       A high-end, colorful, professional website header system for WordPress and WooCommerce with mega menu, sticky header, animated bottom line, mini cart, and full customization.
 * Version:           1.0.0
 * Author:            Nexora
 * Author URI:        https://example.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       nexora-advanced-header
 * Domain Path:       /languages
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * WC requires at least: 6.0
 */

defined( 'ABSPATH' ) || exit;

define( 'NEXORA_HEADER_VERSION', '1.0.0' );
define( 'NEXORA_HEADER_FILE', __FILE__ );
define( 'NEXORA_HEADER_DIR', plugin_dir_path( __FILE__ ) );
define( 'NEXORA_HEADER_URL', plugin_dir_url( __FILE__ ) );
define( 'NEXORA_HEADER_BASENAME', plugin_basename( __FILE__ ) );
define( 'NEXORA_HEADER_OPTION', 'nexora_header_settings' );

require_once NEXORA_HEADER_DIR . 'includes/class-settings.php';
require_once NEXORA_HEADER_DIR . 'includes/class-security.php';
require_once NEXORA_HEADER_DIR . 'includes/class-plugin.php';
require_once NEXORA_HEADER_DIR . 'includes/class-admin.php';
require_once NEXORA_HEADER_DIR . 'includes/class-header.php';
require_once NEXORA_HEADER_DIR . 'includes/class-navigation.php';
require_once NEXORA_HEADER_DIR . 'includes/class-search.php';
require_once NEXORA_HEADER_DIR . 'includes/class-cart.php';
require_once NEXORA_HEADER_DIR . 'includes/class-social.php';
require_once NEXORA_HEADER_DIR . 'includes/class-woocommerce.php';
require_once NEXORA_HEADER_DIR . 'includes/class-elementor.php';

function nexora_header() {
    return Nexora_Header_Plugin::instance();
}

nexora_header();
