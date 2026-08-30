<?php
/**
 * Animation section (announcement bar + bottom line).
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Animation Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <h3><?php esc_html_e( 'Announcement Bar', 'nexora-advanced-header' ); ?></h3>
        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-ann-text"><?php esc_html_e( 'Announcement Text', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-ann-text" name="nexora_settings[announcement_text]" value="<?php echo esc_attr( $s['announcement_text'] ); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="nexora-ann-link"><?php esc_html_e( 'Announcement Link', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="url" id="nexora-ann-link" name="nexora_settings[announcement_link]" value="<?php echo esc_attr( $s['announcement_link'] ); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="nexora-ann-speed"><?php esc_html_e( 'Animation Speed (seconds)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-ann-speed" name="nexora_settings[announcement_speed]" value="<?php echo esc_attr( $s['announcement_speed'] ); ?>" min="5" /></td>
            </tr>
            <tr>
                <th><label for="nexora-ann-dir"><?php esc_html_e( 'Direction', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-ann-dir" name="nexora_settings[announcement_direction]">
                        <option value="left" <?php selected( $s['announcement_direction'], 'left' ); ?>><?php esc_html_e( 'Left to Right', 'nexora-advanced-header' ); ?></option>
                        <option value="right" <?php selected( $s['announcement_direction'], 'right' ); ?>><?php esc_html_e( 'Right to Left', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-ann-closeable"><?php esc_html_e( 'Allow Close', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-ann-closeable" name="nexora_settings[announcement_closeable]" value="1" <?php checked( $s['announcement_closeable'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
        </table>

        <h3><?php esc_html_e( 'Animated Bottom Line', 'nexora-advanced-header' ); ?></h3>
        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-bottom-enabled"><?php esc_html_e( 'Enable Bottom Line', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-bottom-enabled" name="nexora_settings[bottom_enabled]" value="1" <?php checked( $s['bottom_enabled'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-bottom-text"><?php esc_html_e( 'Bottom Line Text (separate items with •)', 'nexora-advanced-header' ); ?></label></th>
                <td><textarea id="nexora-bottom-text" name="nexora_settings[bottom_text]" rows="3" cols="60"><?php echo esc_textarea( $s['bottom_text'] ); ?></textarea></td>
            </tr>
            <tr>
                <th><label for="nexora-bottom-speed"><?php esc_html_e( 'Speed (seconds)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-bottom-speed" name="nexora_settings[bottom_speed]" value="<?php echo esc_attr( $s['bottom_speed'] ); ?>" min="5" /></td>
            </tr>
            <tr>
                <th><label for="nexora-bottom-dir"><?php esc_html_e( 'Direction', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-bottom-dir" name="nexora_settings[bottom_direction]">
                        <option value="left" <?php selected( $s['bottom_direction'], 'left' ); ?>><?php esc_html_e( 'Left to Right', 'nexora-advanced-header' ); ?></option>
                        <option value="right" <?php selected( $s['bottom_direction'], 'right' ); ?>><?php esc_html_e( 'Right to Left', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-bottom-pause"><?php esc_html_e( 'Pause on Hover', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-bottom-pause" name="nexora_settings[bottom_pause_hover]" value="1" <?php checked( $s['bottom_pause_hover'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-bottom-glow"><?php esc_html_e( 'Glow Effect', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-bottom-glow" name="nexora_settings[bottom_glow]" value="1" <?php checked( $s['bottom_glow'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-bottom-grad1"><?php esc_html_e( 'Gradient Color 1', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-bottom-grad1" name="nexora_settings[bottom_gradient_1]" value="<?php echo esc_attr( $s['bottom_gradient_1'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-bottom-grad2"><?php esc_html_e( 'Gradient Color 2', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-bottom-grad2" name="nexora_settings[bottom_gradient_2]" value="<?php echo esc_attr( $s['bottom_gradient_2'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-bottom-text-color"><?php esc_html_e( 'Text Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-bottom-text-color" name="nexora_settings[bottom_text_color]" value="<?php echo esc_attr( $s['bottom_text_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
        </table>

        <?php submit_button( __( 'Save Animation Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
