<?php
/**
 * Responsive section.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Responsive & Mobile Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-mobile-search"><?php esc_html_e( 'Show Search on Mobile', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-mobile-search" name="nexora_settings[mobile_show_search]" value="1" <?php checked( $s['mobile_show_search'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-mobile-cart"><?php esc_html_e( 'Show Cart on Mobile', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-mobile-cart" name="nexora_settings[mobile_show_cart]" value="1" <?php checked( $s['mobile_show_cart'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-mobile-social"><?php esc_html_e( 'Show Social on Mobile', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-mobile-social" name="nexora_settings[mobile_show_social]" value="1" <?php checked( $s['mobile_show_social'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-mobile-cta"><?php esc_html_e( 'Show CTA on Mobile', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-mobile-cta" name="nexora_settings[mobile_show_cta]" value="1" <?php checked( $s['mobile_show_cta'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-mobile-side"><?php esc_html_e( 'Mobile Menu Side', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-mobile-side" name="nexora_settings[mobile_menu_side]">
                        <option value="left" <?php selected( $s['mobile_menu_side'], 'left' ); ?>><?php esc_html_e( 'Slide from Left', 'nexora-advanced-header' ); ?></option>
                        <option value="right" <?php selected( $s['mobile_menu_side'], 'right' ); ?>><?php esc_html_e( 'Slide from Right', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-mobile-width"><?php esc_html_e( 'Mobile Menu Width (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-mobile-width" name="nexora_settings[mobile_menu_width]" value="<?php echo esc_attr( $s['mobile_menu_width'] ); ?>" min="200" max="500" /></td>
            </tr>
        </table>

        <?php submit_button( __( 'Save Responsive Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
