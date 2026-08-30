<?php
/**
 * General/Dashboard section.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
$presets = array(
    'modern_ecommerce' => __( 'Modern eCommerce', 'nexora-advanced-header' ),
    'luxury'           => __( 'Luxury', 'nexora-advanced-header' ),
    'colorful'         => __( 'Colorful', 'nexora-advanced-header' ),
    'minimal'          => __( 'Minimal', 'nexora-advanced-header' ),
    'organic_store'    => __( 'Organic Store', 'nexora-advanced-header' ),
    'business'         => __( 'Business', 'nexora-advanced-header' ),
    'technology'       => __( 'Technology', 'nexora-advanced-header' ),
);
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'General Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-enabled"><?php esc_html_e( 'Enable Header', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-enabled" name="nexora_settings[enabled]" value="1" <?php checked( $s['enabled'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-sticky"><?php esc_html_e( 'Enable Sticky Header', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-sticky" name="nexora_settings[sticky_enabled]" value="1" <?php checked( $s['sticky_enabled'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-sticky-behavior"><?php esc_html_e( 'Sticky Behavior', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-sticky-behavior" name="nexora_settings[sticky_behavior]">
                        <option value="immediate" <?php selected( $s['sticky_behavior'], 'immediate' ); ?>><?php esc_html_e( 'Sticky Immediately', 'nexora-advanced-header' ); ?></option>
                        <option value="after_scroll" <?php selected( $s['sticky_behavior'], 'after_scroll' ); ?>><?php esc_html_e( 'Sticky After Scroll', 'nexora-advanced-header' ); ?></option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-sticky-offset"><?php esc_html_e( 'Sticky Scroll Offset (px)', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="number" id="nexora-sticky-offset" name="nexora_settings[sticky_scroll_offset]" value="<?php echo esc_attr( $s['sticky_scroll_offset'] ); ?>" min="0" /></td>
            </tr>
            <tr>
                <th><label for="nexora-sticky-shrink"><?php esc_html_e( 'Shrink on Scroll', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-sticky-shrink" name="nexora_settings[sticky_shrink]" value="1" <?php checked( $s['sticky_shrink'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-sticky-shadow"><?php esc_html_e( 'Shadow on Scroll', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-sticky-shadow" name="nexora_settings[sticky_shadow]" value="1" <?php checked( $s['sticky_shadow'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-announcement"><?php esc_html_e( 'Enable Announcement Bar', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-announcement" name="nexora_settings[announcement_enabled]" value="1" <?php checked( $s['announcement_enabled'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <tr>
                <th><label for="nexora-preset"><?php esc_html_e( 'Header Preset', 'nexora-advanced-header' ); ?></label></th>
                <td>
                    <select id="nexora-preset" name="nexora_settings[preset]">
                        <?php foreach ( $presets as $value => $label ) : ?>
                        <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $s['preset'], $value ); ?>><?php echo esc_html( $label ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>

        <h3><?php esc_html_e( 'Page Display Control', 'nexora-advanced-header' ); ?></h3>
        <table class="form-table" role="presentation">
            <tr>
                <th><?php esc_html_e( 'Show Header On', 'nexora-advanced-header' ); ?></th>
                <td>
                    <?php
                    $loc_options = array(
                        'entire_site' => __( 'Entire Website', 'nexora-advanced-header' ),
                        'homepage'    => __( 'Homepage', 'nexora-advanced-header' ),
                        'shop'        => __( 'Shop', 'nexora-advanced-header' ),
                        'product'     => __( 'Product Pages', 'nexora-advanced-header' ),
                        'cart'        => __( 'Cart', 'nexora-advanced-header' ),
                        'checkout'    => __( 'Checkout', 'nexora-advanced-header' ),
                        'account'     => __( 'My Account', 'nexora-advanced-header' ),
                        'blog'        => __( 'Blog/Posts', 'nexora-advanced-header' ),
                        'pages'       => __( 'Pages', 'nexora-advanced-header' ),
                        'archives'    => __( 'Archives', 'nexora-advanced-header' ),
                    );
                    $current_locs = (array) $s['display_locations'];
                    foreach ( $loc_options as $val => $label ) :
                    ?>
                    <label class="nexora-checkbox-row"><input type="checkbox" name="nexora_settings[display_locations][]" value="<?php echo esc_attr( $val ); ?>" <?php checked( in_array( $val, $current_locs, true ) ); ?> /> <?php echo esc_html( $label ); ?></label>
                    <?php endforeach; ?>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-exclude-urls"><?php esc_html_e( 'Exclude URLs (one per line)', 'nexora-advanced-header' ); ?></label></th>
                <td><textarea id="nexora-exclude-urls" name="nexora_settings[exclude_urls]" rows="4" cols="50"><?php echo esc_textarea( $s['exclude_urls'] ); ?></textarea></td>
            </tr>
        </table>

        <?php submit_button( __( 'Save Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
