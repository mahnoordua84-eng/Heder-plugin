<?php
/**
 * Account section.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Account Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-account-enabled"><?php esc_html_e( 'Enable Account Icon', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-account-enabled" name="nexora_settings[account_enabled]" value="1" <?php checked( $s['account_enabled'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-account-icon-color"><?php esc_html_e( 'Account Icon Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-account-icon-color" name="nexora_settings[account_icon_color]" value="<?php echo esc_attr( $s['account_icon_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
        </table>

        <?php submit_button( __( 'Save Account Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
