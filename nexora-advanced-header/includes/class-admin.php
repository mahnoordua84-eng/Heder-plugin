<?php
/**
 * Admin interface controller.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registers the Nexora Header admin menu, enqueues admin assets, and handles settings save/import/export/reset.
 */
class Nexora_Header_Admin {

    private $settings;

    public function __construct( $settings ) {
        $this->settings = $settings;

        add_action( 'admin_menu', array( $this, 'register_menu' ) );
        add_action( 'admin_init', array( $this, 'handle_save' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_action( 'admin_notices', array( $this, 'wc_notice' ) );
        add_action( 'admin_notices', array( $this, 'settings_saved_notice' ) );
    }

    public function register_menu() {
        add_menu_page(
            __( 'Nexora Header', 'nexora-advanced-header' ),
            __( 'Nexora Header', 'nexora-advanced-header' ),
            'manage_options',
            'nexora-header',
            array( $this, 'render_page' ),
            'dashicons-schedule',
            58
        );

        $sections = array(
            'general'     => __( 'Dashboard', 'nexora-advanced-header' ),
            'logo'        => __( 'Logo', 'nexora-advanced-header' ),
            'menu'        => __( 'Menu', 'nexora-advanced-header' ),
            'search'      => __( 'Search', 'nexora-advanced-header' ),
            'cart'        => __( 'Cart', 'nexora-advanced-header' ),
            'account'     => __( 'Account', 'nexora-advanced-header' ),
            'social'      => __( 'Social', 'nexora-advanced-header' ),
            'cta'         => __( 'CTA', 'nexora-advanced-header' ),
            'animation'   => __( 'Animation', 'nexora-advanced-header' ),
            'colors'      => __( 'Colors', 'nexora-advanced-header' ),
            'typography'  => __( 'Typography', 'nexora-advanced-header' ),
            'responsive'  => __( 'Responsive', 'nexora-advanced-header' ),
            'advanced'    => __( 'Advanced', 'nexora-advanced-header' ),
            'import'      => __( 'Import/Export', 'nexora-advanced-header' ),
            'about'       => __( 'About', 'nexora-advanced-header' ),
        );

        foreach ( $sections as $slug => $title ) {
            add_submenu_page(
                'nexora-header',
                $title,
                $title,
                'manage_options',
                'nexora-header-' . $slug,
                array( $this, 'render_page' )
            );
        }
    }

    public function enqueue_assets( $hook ) {
        if ( false === strpos( $hook, 'nexora-header' ) ) {
            return;
        }
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_media();
        wp_enqueue_style(
            'nexora-admin',
            NEXORA_HEADER_URL . 'assets/css/admin.css',
            array( 'wp-color-picker' ),
            NEXORA_HEADER_VERSION
        );
        wp_enqueue_script(
            'nexora-admin',
            NEXORA_HEADER_URL . 'assets/js/admin.js',
            array( 'jquery', 'wp-color-picker', 'jquery-ui-sortable' ),
            NEXORA_HEADER_VERSION,
            true
        );
    }

    public function wc_notice() {
        if ( ! get_transient( 'nexora_header_wc_notice' ) ) {
            return;
        }
        delete_transient( 'nexora_header_wc_notice' );
        echo '<div class="notice notice-info is-dismissible"><p>' . esc_html__( 'WooCommerce is recommended for Cart and Shop features. The header will still work without it.', 'nexora-advanced-header' ) . '</p></div>';
    }

    public function settings_saved_notice() {
        if ( ! isset( $_GET['nexora_saved'] ) ) {
            return;
        }
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__( 'Settings saved.', 'nexora-advanced-header' ) . '</p></div>';
    }

    public function handle_save() {
        if ( ! isset( $_POST['nexora_header_action'] ) ) {
            return;
        }
        if ( ! Nexora_Header_Security::can_manage() ) {
            wp_die( esc_html__( 'You do not have permission to do this.', 'nexora-advanced-header' ) );
        }
        check_admin_referer( 'nexora_header_save', 'nexora_header_nonce' );

        $action = sanitize_text_field( wp_unslash( $_POST['nexora_header_action'] ) );

        if ( 'save' === $action ) {
            $data = isset( $_POST['nexora_settings'] ) ? (array) wp_unslash( $_POST['nexora_settings'] ) : array();
            $this->settings->update( $data );
        } elseif ( 'reset' === $action ) {
            $this->settings->reset();
        } elseif ( 'import' === $action ) {
            $json = isset( $_POST['nexora_import_json'] ) ? wp_unslash( $_POST['nexora_import_json'] ) : '';
            $result = $this->settings->import( $json );
            if ( is_wp_error( $result ) ) {
                add_settings_error( 'nexora_header', 'nexora_import', $result->get_error_message(), 'error' );
            }
        }

        wp_safe_redirect( add_query_arg( array( 'page' => isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : 'nexora-header', 'nexora_saved' => '1' ), admin_url( 'admin.php' ) ) );
        exit;
    }

    public function render_page() {
        if ( ! Nexora_Header_Security::can_manage() ) {
            wp_die( esc_html__( 'You do not have permission to access this page.', 'nexora-advanced-header' ) );
        }

        $page = isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : 'nexora-header';
        $section = str_replace( 'nexora-header-', '', $page );
        if ( 'nexora-header' === $section ) {
            $section = 'general';
        }

        $s = $this->settings->all();

        include NEXORA_HEADER_DIR . 'admin/admin-page.php';
    }
}
