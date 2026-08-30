<?php
/**
 * CTA section.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Call-to-Action Button Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-cta-enabled"><?php esc_html_e( 'Enable CTA Button', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-cta-enabled" name="nexora_settings[cta_enabled]" value="1" <?php checked( $s['cta_enabled'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-cta-text"><?php esc_html_e( 'Button Text', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-cta-text" name="nexora_settings[cta_text]" value="<?php echo esc_attr( $s['cta_text'] ); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="nexora-cta-url"><?php esc_html_e( 'Button URL', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="url" id="nexora-cta-url" name="nexora_settings[cta_url]" value="<?php echo esc_attr( $s['cta_url'] ); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="nexora-cta-bg"><?php esc_html_e( 'Background Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-cta-bg" name="nexora_settings[cta_bg]" value="<?php echo esc_attr( $s['cta_bg'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-cta-text-color"><?php esc_html_e( 'Text Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-cta-text-color" name="nexora_settings[cta_text_color]" value="<?php echo esc_attr( $s['cta_text_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-cta-hover-bg"><?php esc_html_e( 'Hover Background', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-cta-hover-bg" name="nexora_settings[cta_hover_bg]" value="<?php echo esc_attr( $s['cta_hover_bg'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-cta-radius"><?php esc_html_e( 'Border Radius (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-cta-radius" name="nexora_settings[cta_radius]" value="<?php echo esc_attr( $s['cta_radius'] ); ?>" min="0" /></td>
            </tr>
            <tr>
                <th><label for="nexora-cta-anim"><?php esc_html_e( 'Animation', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-cta-anim" name="nexora_settings[cta_animation]">
                        <option value="none" <?php selected( $s['cta_animation'], 'none' ); ?>><?php esc_html_e( 'None', 'nexora-advanced-header' ); ?></option>
                        <option value="pulse" <?php selected( $s['cta_animation'], 'pulse' ); ?>><?php esc_html_e( 'Pulse', 'nexora-advanced-header' ); ?></option>
                        <option value="slide" <?php selected( $s['cta_animation'], 'slide' ); ?>><?php esc_html_e( 'Slide', 'nexora-advanced-header' ); ?></option>
                        <option value="glow" <?php selected( $s['cta_animation'], 'glow' ); ?>><?php esc_html_e( 'Glow', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
        </table>

        <?php submit_button( __( 'Save CTA Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
