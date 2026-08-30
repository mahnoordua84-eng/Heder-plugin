<?php
/**
 * Core plugin bootstrap class.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class. Wires up activation, asset registration, and header rendering.
 */
final class Nexora_Header_Plugin {

    private static $instance = null;
    private $settings;
    private $header;
    private $woocommerce;

    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->settings    = new Nexora_Header_Settings();
        $this->woocommerce = new Nexora_Header_WooCommerce( $this->settings );

        new Nexora_Header_Admin( $this->settings );
        new Nexora_Header_Elementor( $this->settings );

        $this->header = new Nexora_Header_Header( $this->settings, $this->woocommerce );

        register_activation_hook( NEXORA_HEADER_FILE, array( $this, 'activate' ) );
        register_deactivation_hook( NEXORA_HEADER_FILE, array( $this, 'deactivate' ) );

        add_action( 'init', array( $this, 'load_textdomain' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'maybe_enqueue_assets' ), 20 );
        add_action( 'wp_body_open', array( $this, 'render_header' ), 5 );
        add_filter( 'theme_mod_custom_logo', '__return_null' );
    }

    public function activate() {
        if ( ! current_user_can( 'activate_plugins' ) ) {
            return;
        }

        if ( false === get_option( NEXORA_HEADER_OPTION ) ) {
            $defaults = Nexora_Header_Settings::get_defaults();
            update_option( NEXORA_HEADER_OPTION, $defaults );
        }

        $this->register_nav_menus();

        if ( ! $this->woocommerce->is_active() ) {
            set_transient( 'nexora_header_wc_notice', true, 5 * MINUTE_IN_SECONDS );
        }

        flush_rewrite_rules();
    }

    public function deactivate() {
        flush_rewrite_rules();
    }

    public function load_textdomain() {
        load_plugin_textdomain( 'nexora-advanced-header', false, dirname( NEXORA_HEADER_BASENAME ) . '/languages' );
    }

    private function register_nav_menus() {
        $menus = get_registered_nav_menus();
        if ( ! isset( $menus['nexora_primary'] ) ) {
            register_nav_menu( 'nexora_primary', __( 'Nexora Primary Header Menu', 'nexora-advanced-header' ) );
        }
        if ( ! isset( $menus['nexora_mobile'] ) ) {
            register_nav_menu( 'nexora_mobile', __( 'Nexora Mobile Header Menu', 'nexora-advanced-header' ) );
        }
    }

    public function register_assets() {
        wp_register_style(
            'nexora-header',
            NEXORA_HEADER_URL . 'assets/css/header.css',
            array(),
            NEXORA_HEADER_VERSION
        );

        wp_register_style(
            'nexora-header-responsive',
            NEXORA_HEADER_URL . 'assets/css/responsive.css',
            array( 'nexora-header' ),
            NEXORA_HEADER_VERSION
        );

        wp_register_style(
            'nexora-header-rtl',
            NEXORA_HEADER_URL . 'assets/css/rtl.css',
            array( 'nexora-header' ),
            NEXORA_HEADER_VERSION
        );

        wp_register_script(
            'nexora-header',
            NEXORA_HEADER_URL . 'assets/js/header.js',
            array(),
            NEXORA_HEADER_VERSION,
            true
        );

        wp_register_script(
            'nexora-mobile-menu',
            NEXORA_HEADER_URL . 'assets/js/mobile-menu.js',
            array( 'nexora-header' ),
            NEXORA_HEADER_VERSION,
            true
        );
    }

    public function maybe_enqueue_assets() {
        if ( ! $this->header->should_display() ) {
            return;
        }

        wp_enqueue_style( 'nexora-header' );
        wp_enqueue_style( 'nexora-header-responsive' );

        if ( is_rtl() ) {
            wp_enqueue_style( 'nexora-header-rtl' );
        }

        wp_enqueue_script( 'nexora-header' );
        wp_enqueue_script( 'nexora-mobile-menu' );

        $settings = $this->settings->all();
        $custom_css = isset( $settings['custom_css'] ) ? trim( $settings['custom_css'] ) : '';
        if ( '' !== $custom_css ) {
            wp_add_inline_style( 'nexora-header', $custom_css );
        }

        $custom_js = isset( $settings['custom_js'] ) ? trim( $settings['custom_js'] ) : '';
        if ( '' !== $custom_js ) {
            wp_add_inline_script( 'nexora-header', $custom_js );
        }

        wp_localize_script( 'nexora-header', 'nexoraHeader', array(
            'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
            'nonce'     => wp_create_nonce( 'nexora_header_nonce' ),
            'isRtl'     => is_rtl(),
            'sticky'    => (bool) ( $settings['sticky_enabled'] ?? true ),
            'searchUrl' => home_url( '/' ),
            'emptyText' => __( 'Your cart is empty.', 'nexora-advanced-header' ),
        ) );
    }

    public function render_header() {
        if ( ! $this->header->should_display() ) {
            return;
        }
        $this->header->render();
    }
}
