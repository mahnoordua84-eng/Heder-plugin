<?php
/**
 * Cart section.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Cart Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-cart-enabled"><?php esc_html_e( 'Enable Cart', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-cart-enabled" name="nexora_settings[cart_enabled]" value="1" <?php checked( $s['cart_enabled'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-mini-cart"><?php esc_html_e( 'Enable Mini Cart', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-mini-cart" name="nexora_settings[mini_cart_enabled]" value="1" <?php checked( $s['mini_cart_enabled'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-cart-icon-color"><?php esc_html_e( 'Cart Icon Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-cart-icon-color" name="nexora_settings[cart_icon_color]" value="<?php echo esc_attr( $s['cart_icon_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-cart-counter-bg"><?php esc_html_e( 'Counter Background', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-cart-counter-bg" name="nexora_settings[cart_counter_bg]" value="<?php echo esc_attr( $s['cart_counter_bg'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-cart-counter-text"><?php esc_html_e( 'Counter Text Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-cart-counter-text" name="nexora_settings[cart_counter_text]" value="<?php echo esc_attr( $s['cart_counter_text'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
        </table>

        <?php submit_button( __( 'Save Cart Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
