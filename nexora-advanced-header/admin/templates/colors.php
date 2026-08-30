<?php
/**
 * Colors section.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Color Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <h3><?php esc_html_e( 'Header Background', 'nexora-advanced-header' ); ?></h3>
        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-bg-type"><?php esc_html_e( 'Background Type', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-bg-type" name="nexora_settings[header_bg_type]">
                        <option value="solid" <?php selected( $s['header_bg_type'], 'solid' ); ?>><?php esc_html_e( 'Solid Color', 'nexora-advanced-header' ); ?></option>
                        <option value="gradient" <?php selected( $s['header_bg_type'], 'gradient' ); ?>><?php esc_html_e( 'Gradient', 'nexora-advanced-header' ); ?></option>
                        <option value="transparent" <?php selected( $s['header_bg_type'], 'transparent' ); ?>><?php esc_html_e( 'Transparent', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-bg-color"><?php esc_html_e( 'Solid Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-bg-color" name="nexora_settings[header_bg_color]" value="<?php echo esc_attr( $s['header_bg_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-grad1"><?php esc_html_e( 'Gradient Color 1', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-grad1" name="nexora_settings[header_gradient_1]" value="<?php echo esc_attr( $s['header_gradient_1'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-grad2"><?php esc_html_e( 'Gradient Color 2', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-grad2" name="nexora_settings[header_gradient_2]" value="<?php echo esc_attr( $s['header_gradient_2'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-grad-dir"><?php esc_html_e( 'Gradient Direction', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-grad-dir" name="nexora_settings[header_gradient_dir]">
                        <option value="to right" <?php selected( $s['header_gradient_dir'], 'to right' ); ?>><?php esc_html_e( 'Left to Right', 'nexora-advanced-header' ); ?></option>
                        <option value="to left" <?php selected( $s['header_gradient_dir'], 'to left' ); ?>><?php esc_html_e( 'Right to Left', 'nexora-advanced-header' ); ?></option>
                        <option value="to bottom" <?php selected( $s['header_gradient_dir'], 'to bottom' ); ?>><?php esc_html_e( 'Top to Bottom', 'nexora-advanced-header' ); ?></option>
                        <option value="135deg" <?php selected( $s['header_gradient_dir'], '135deg' ); ?>><?php esc_html_e( 'Diagonal', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-glass"><?php esc_html_e( 'Glassmorphism', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-glass" name="nexora_settings[header_glass]" value="1" <?php checked( $s['header_glass'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-shadow"><?php esc_html_e( 'Shadow', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-shadow" name="nexora_settings[header_shadow]">
                        <option value="none" <?php selected( $s['header_shadow'], 'none' ); ?>><?php esc_html_e( 'None', 'nexora-advanced-header' ); ?></option>
                        <option value="sm" <?php selected( $s['header_shadow'], 'sm' ); ?>><?php esc_html_e( 'Small', 'nexora-advanced-header' ); ?></option>
                        <option value="md" <?php selected( $s['header_shadow'], 'md' ); ?>><?php esc_html_e( 'Medium', 'nexora-advanced-header' ); ?></option>
                        <option value="lg" <?php selected( $s['header_shadow'], 'lg' ); ?>><?php esc_html_e( 'Large', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-header-height"><?php esc_html_e( 'Header Height (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-header-height" name="nexora_settings[header_height]" value="<?php echo esc_attr( $s['header_height'] ); ?>" min="40" /></td>
            </tr>
        </table>

        <h3><?php esc_html_e( 'Menu Colors', 'nexora-advanced-header' ); ?></h3>
        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-menu-color"><?php esc_html_e( 'Menu Text Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-menu-color" name="nexora_settings[menu_text_color]" value="<?php echo esc_attr( $s['menu_text_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-menu-hover"><?php esc_html_e( 'Hover Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-menu-hover" name="nexora_settings[menu_hover_color]" value="<?php echo esc_attr( $s['menu_hover_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-menu-active"><?php esc_html_e( 'Active Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-menu-active" name="nexora_settings[menu_active_color]" value="<?php echo esc_attr( $s['menu_active_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-menu-bg"><?php esc_html_e( 'Menu Background', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-menu-bg" name="nexora_settings[menu_bg]" value="<?php echo esc_attr( $s['menu_bg'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
        </table>

        <h3><?php esc_html_e( 'Announcement Bar Colors', 'nexora-advanced-header' ); ?></h3>
        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-ann-bg"><?php esc_html_e( 'Background Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-ann-bg" name="nexora_settings[announcement_bg_color]" value="<?php echo esc_attr( $s['announcement_bg_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-ann-text-color"><?php esc_html_e( 'Text Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-ann-text-color" name="nexora_settings[announcement_text_color]" value="<?php echo esc_attr( $s['announcement_text_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
        </table>

        <?php submit_button( __( 'Save Color Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
