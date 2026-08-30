<?php
/**
 * Typography section.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Typography Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-menu-font"><?php esc_html_e( 'Menu Font Family', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-menu-font" name="nexora_settings[menu_typography]">
                        <option value="inherit" <?php selected( $s['menu_typography'], 'inherit' ); ?>><?php esc_html_e( 'Theme Default', 'nexora-advanced-header' ); ?></option>
                        <option value="'Inter', sans-serif" <?php selected( $s['menu_typography'], "'Inter', sans-serif" ); ?>><?php esc_html_e( 'Inter', 'nexora-advanced-header' ); ?></option>
                        <option value="'Poppins', sans-serif" <?php selected( $s['menu_typography'], "'Poppins', sans-serif" ); ?>><?php esc_html_e( 'Poppins', 'nexora-advanced-header' ); ?></option>
                        <option value="'Roboto', sans-serif" <?php selected( $s['menu_typography'], "'Roboto', sans-serif" ); ?>><?php esc_html_e( 'Roboto', 'nexora-advanced-header' ); ?></option>
                        <option value="Georgia, serif" <?php selected( $s['menu_typography'], 'Georgia, serif' ); ?>><?php esc_html_e( 'Georgia', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-menu-font-size"><?php esc_html_e( 'Menu Font Size (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-menu-font-size" name="nexora_settings[menu_font_size]" value="<?php echo esc_attr( $s['menu_font_size'] ); ?>" min="10" /></td>
            </tr>
            <tr>
                <th><label for="nexora-menu-font-weight"><?php esc_html_e( 'Font Weight', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-menu-font-weight" name="nexora_settings[menu_font_weight]">
                        <option value="400" <?php selected( $s['menu_font_weight'], '400' ); ?>><?php esc_html_e( 'Regular (400)', 'nexora-advanced-header' ); ?></option>
                        <option value="500" <?php selected( $s['menu_font_weight'], '500' ); ?>><?php esc_html_e( 'Medium (500)', 'nexora-advanced-header' ); ?></option>
                        <option value="600" <?php selected( $s['menu_font_weight'], '600' ); ?>><?php esc_html_e( 'Semibold (600)', 'nexora-advanced-header' ); ?></option>
                        <option value="700" <?php selected( $s['menu_font_weight'], '700' ); ?>><?php esc_html_e( 'Bold (700)', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-menu-letter-spacing"><?php esc_html_e( 'Letter Spacing (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" step="0.1" id="nexora-menu-letter-spacing" name="nexora_settings[menu_letter_spacing]" value="<?php echo esc_attr( $s['menu_letter_spacing'] ); ?>" /></td>
            </tr>
            <tr>
                <th><label for="nexora-ann-font-size"><?php esc_html_e( 'Announcement Font Size (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-ann-font-size" name="nexora_settings[announcement_font_size]" value="<?php echo esc_attr( $s['announcement_font_size'] ); ?>" min="10" /></td>
            </tr>
            <tr>
                <th><label for="nexora-ann-height"><?php esc_html_e( 'Announcement Bar Height (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-ann-height" name="nexora_settings[announcement_height]" value="<?php echo esc_attr( $s['announcement_height'] ); ?>" min="20" /></td>
            </tr>
        </table>

        <?php submit_button( __( 'Save Typography Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
