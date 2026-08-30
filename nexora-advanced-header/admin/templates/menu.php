<?php
/**
 * Menu section.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
$menus = get_registered_nav_menus();
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Navigation Menu Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-menu-location"><?php esc_html_e( 'Select Menu Location', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-menu-location" name="nexora_settings[menu_location]">
                        <?php foreach ( $menus as $slug => $label ) : ?>
                        <option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $s['menu_location'], $slug ); ?>><?php echo esc_html( $label ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-menu-align"><?php esc_html_e( 'Menu Alignment', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-menu-align" name="nexora_settings[menu_alignment]">
                        <option value="left" <?php selected( $s['menu_alignment'], 'left' ); ?>><?php esc_html_e( 'Left', 'nexora-advanced-header' ); ?></option>
                        <option value="center" <?php selected( $s['menu_alignment'], 'center' ); ?>><?php esc_html_e( 'Center', 'nexora-advanced-header' ); ?></option>
                        <option value="right" <?php selected( $s['menu_alignment'], 'right' ); ?>><?php esc_html_e( 'Right', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-menu-spacing"><?php esc_html_e( 'Menu Item Spacing (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-menu-spacing" name="nexora_settings[menu_spacing]" value="<?php echo esc_attr( $s['menu_spacing'] ); ?>" min="0" /></td>
            </tr>
            <tr>
                <th><label for="nexora-menu-radius"><?php esc_html_e( 'Menu Border Radius (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-menu-radius" name="nexora_settings[menu_radius]" value="<?php echo esc_attr( $s['menu_radius'] ); ?>" min="0" /></td>
            </tr>
            <tr>
                <th><label for="nexora-menu-hover-anim"><?php esc_html_e( 'Hover Animation', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-menu-hover-anim" name="nexora_settings[menu_hover_animation]">
                        <option value="none" <?php selected( $s['menu_hover_animation'], 'none' ); ?>><?php esc_html_e( 'None', 'nexora-advanced-header' ); ?></option>
                        <option value="underline" <?php selected( $s['menu_hover_animation'], 'underline' ); ?>><?php esc_html_e( 'Underline', 'nexora-advanced-header' ); ?></option>
                        <option value="background" <?php selected( $s['menu_hover_animation'], 'background' ); ?>><?php esc_html_e( 'Background', 'nexora-advanced-header' ); ?></option>
                        <option value="scale" <?php selected( $s['menu_hover_animation'], 'scale' ); ?>><?php esc_html_e( 'Scale', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-dropdown-radius"><?php esc_html_e( 'Dropdown Radius (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-dropdown-radius" name="nexora_settings[dropdown_radius]" value="<?php echo esc_attr( $s['dropdown_radius'] ); ?>" min="0" /></td>
            </tr>
            <tr>
                <th><label for="nexora-dropdown-anim"><?php esc_html_e( 'Dropdown Animation', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-dropdown-anim" name="nexora_settings[dropdown_animation]">
                        <option value="fade" <?php selected( $s['dropdown_animation'], 'fade' ); ?>><?php esc_html_e( 'Fade', 'nexora-advanced-header' ); ?></option>
                        <option value="slide" <?php selected( $s['dropdown_animation'], 'slide' ); ?>><?php esc_html_e( 'Slide', 'nexora-advanced-header' ); ?></option>
                        <option value="zoom" <?php selected( $s['dropdown_animation'], 'zoom' ); ?>><?php esc_html_e( 'Zoom', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-mega"><?php esc_html_e( 'Enable Mega Menu', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-mega" name="nexora_settings[mega_menu_enabled]" value="1" <?php checked( $s['mega_menu_enabled'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-mega-cols"><?php esc_html_e( 'Mega Menu Columns', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-mega-cols" name="nexora_settings[mega_menu_columns]">
                        <?php for ( $i = 2; $i <= 5; $i++ ) : ?>
                        <option value="<?php echo esc_attr( $i ); ?>" <?php selected( $s['mega_menu_columns'], $i ); ?>><?php echo esc_html( $i ); ?></option>
                        <?php endfor; ?>
                    </select>
                </td>
            </tr>
        </table>

        <?php submit_button( __( 'Save Menu Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
