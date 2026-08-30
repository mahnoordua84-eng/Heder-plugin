<?php
/**
 * Logo section.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Logo Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-logo-id"><?php esc_html_e( 'Desktop Logo', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <div class="nexora-media-upload">
                        <input type="hidden" id="nexora-logo-id" name="nexora_settings[logo_id]" value="<?php echo esc_attr( $s['logo_id'] ); ?>" />
                        <div class="nexora-media-preview" id="nexora-logo-preview">
                            <?php if ( $s['logo_id'] > 0 ) echo wp_get_attachment_image( $s['logo_id'], 'thumbnail' ); ?>
                        </div>
                        <button type="button" class="button nexora-media-btn" data-target="nexora-logo-id" data-preview="nexora-logo-preview"><?php esc_html_e( 'Upload Logo', 'nexora-advanced-header' ); ?></button>
                        <button type="button" class="button nexora-media-remove" data-target="nexora-logo-id" data-preview="nexora-logo-preview"><?php esc_html_e( 'Remove', 'nexora-advanced-header' ); ?></button>
                    </div>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-logo-mobile-id"><?php esc_html_e( 'Mobile Logo', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <div class="nexora-media-upload">
                        <input type="hidden" id="nexora-logo-mobile-id" name="nexora_settings[logo_mobile_id]" value="<?php echo esc_attr( $s['logo_mobile_id'] ); ?>" />
                        <div class="nexora-media-preview" id="nexora-logo-mobile-preview">
                            <?php if ( $s['logo_mobile_id'] > 0 ) echo wp_get_attachment_image( $s['logo_mobile_id'], 'thumbnail' ); ?>
                        </div>
                        <button type="button" class="button nexora-media-btn" data-target="nexora-logo-mobile-id" data-preview="nexora-logo-mobile-preview"><?php esc_html_e( 'Upload Mobile Logo', 'nexora-advanced-header' ); ?></button>
                        <button type="button" class="button nexora-media-remove" data-target="nexora-logo-mobile-id" data-preview="nexora-logo-mobile-preview"><?php esc_html_e( 'Remove', 'nexora-advanced-header' ); ?></button>
                    </div>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-logo-width"><?php esc_html_e( 'Logo Width (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-logo-width" name="nexora_settings[logo_width]" value="<?php echo esc_attr( $s['logo_width'] ); ?>" min="20" /></td>
            </tr>
            <tr>
                <th><label for="nexora-logo-height"><?php esc_html_e( 'Logo Height (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-logo-height" name="nexora_settings[logo_height]" value="<?php echo esc_attr( $s['logo_height'] ); ?>" min="20" /></td>
            </tr>
            <tr>
                <th><label for="nexora-logo-spacing"><?php esc_html_e( 'Logo Right Spacing (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-logo-spacing" name="nexora_settings[logo_spacing]" value="<?php echo esc_attr( $s['logo_spacing'] ); ?>" min="0" /></td>
            </tr>
            <tr>
                <th><label for="nexora-logo-anim"><?php esc_html_e( 'Logo Animation', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-logo-anim" name="nexora_settings[logo_animation]">
                        <option value="none" <?php selected( $s['logo_animation'], 'none' ); ?>><?php esc_html_e( 'None', 'nexora-advanced-header' ); ?></option>
                        <option value="fade" <?php selected( $s['logo_animation'], 'fade' ); ?>><?php esc_html_e( 'Fade In', 'nexora-advanced-header' ); ?></option>
                        <option value="slide" <?php selected( $s['logo_animation'], 'slide' ); ?>><?php esc_html_e( 'Slide In', 'nexora-advanced-header' ); ?></option>
                        <option value="zoom" <?php selected( $s['logo_animation'], 'zoom' ); ?>><?php esc_html_e( 'Zoom In', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
        </table>

        <?php submit_button( __( 'Save Logo Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
