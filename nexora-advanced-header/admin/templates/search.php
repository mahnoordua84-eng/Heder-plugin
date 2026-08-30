<?php
/**
 * Search section.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Search Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-search-enabled"><?php esc_html_e( 'Enable Search', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-search-enabled" name="nexora_settings[search_enabled]" value="1" <?php checked( $s['search_enabled'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-search-placeholder"><?php esc_html_e( 'Placeholder Text', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-search-placeholder" name="nexora_settings[search_placeholder]" value="<?php echo esc_attr( $s['search_placeholder'] ); ?>" class="regular-text" /></td>
            </tr>
            <tr>
                <th><label for="nexora-search-type"><?php esc_html_e( 'Search Type', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-search-type" name="nexora_settings[search_type]">
                        <option value="product" <?php selected( $s['search_type'], 'product' ); ?>><?php esc_html_e( 'Products (WooCommerce)', 'nexora-advanced-header' ); ?></option>
                        <option value="post" <?php selected( $s['search_type'], 'post' ); ?>><?php esc_html_e( 'Posts/Pages', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-search-icon-color"><?php esc_html_e( 'Search Icon Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-search-icon-color" name="nexora_settings[search_icon_color]" value="<?php echo esc_attr( $s['search_icon_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
        </table>

        <?php submit_button( __( 'Save Search Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
