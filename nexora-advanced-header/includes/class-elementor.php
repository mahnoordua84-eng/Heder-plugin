<?php
/**
 * Elementor compatibility handler.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

/**
 * Prevents duplicate headers when Elementor Pro Theme Builder or an Elementor header template is active.
 */
class Nexora_Header_Elementor {

    private $settings;

    public function __construct( $settings ) {
        $this->settings = $settings;
        add_filter( 'nexora_header_should_render', array( $this, 'check_conflict' ), 10, 1 );
    }

    public function is_elementor_active() {
        return did_action( 'elementor/loaded' ) || class_exists( '\Elementor\Plugin' );
    }

    public function has_elementor_header() {
        if ( ! $this->is_elementor_active() ) {
            return false;
        }
        if ( ! class_exists( '\ElementorPro\Modules\ThemeBuilder\Module' ) ) {
            return false;
        }
        $module = \ElementorPro\Modules\ThemeBuilder\Module::instance();
        if ( ! $module || ! method_exists( $module, 'get_conditions_manager' ) ) {
            return false;
        }
        $manager = $module->get_conditions_manager();
        if ( ! $manager || ! method_exists( $manager, 'get_documents_for_location' ) ) {
            return false;
        }
        $docs = $manager->get_documents_for_location( 'header' );
        return ! empty( $docs );
    }

    public function check_conflict( $should_render ) {
        if ( ! $should_render ) {
            return $should_render;
        }
        if ( $this->has_elementor_header() ) {
            return false;
        }
        return $should_render;
    }
}
