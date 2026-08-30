<?php
/**
 * Social section.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
$socials = array(
    'social_facebook'  => __( 'Facebook URL', 'nexora-advanced-header' ),
    'social_instagram' => __( 'Instagram URL', 'nexora-advanced-header' ),
    'social_whatsapp'  => __( 'WhatsApp URL', 'nexora-advanced-header' ),
    'social_youtube'   => __( 'YouTube URL', 'nexora-advanced-header' ),
    'social_tiktok'    => __( 'TikTok URL', 'nexora-advanced-header' ),
    'social_twitter'   => __( 'X/Twitter URL', 'nexora-advanced-header' ),
    'social_linkedin'  => __( 'LinkedIn URL', 'nexora-advanced-header' ),
    'social_pinterest' => __( 'Pinterest URL', 'nexora-advanced-header' ),
);
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Social Media Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <table class="form-table" role="presentation">
            <tr>
                <th><label for="nexora-social-enabled"><?php esc_html_e( 'Enable Social Icons', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-social-enabled" name="nexora_settings[social_enabled]" value="1" <?php checked( $s['social_enabled'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
            <?php foreach ( $socials as $key => $label ) : ?>
            <tr>
                <th><label for="nexora-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label></th>
                <td><input type="url" id="nexora-<?php echo esc_attr( $key ); ?>" name="nexora_settings[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $s[ $key ] ); ?>" class="regular-text" placeholder="https://" /></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <th><label for="nexora-social-icon-color"><?php esc_html_e( 'Icon Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-social-icon-color" name="nexora_settings[social_icon_color]" value="<?php echo esc_attr( $s['social_icon_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-social-hover-color"><?php esc_html_e( 'Hover Color', 'nexora-advanced-header' ); ?></label></th>
                <td><input type="text" id="nexora-social-hover-color" name="nexora_settings[social_hover_color]" value="<?php echo esc_attr( $s['social_hover_color'] ); ?>" class="nexora-color-picker" /></td>
            </tr>
            <tr>
                <th><label for="nexora-social-new-tab"><?php esc_html_e( 'Open in New Tab', 'nexora-advanced-header' ); ?></label></th>
                <td><label class="nexora-switch"><input type="checkbox" id="nexora-social-new-tab" name="nexora_settings[social_new_tab]" value="1" <?php checked( $s['social_new_tab'], true ); ?> /><span class="nexora-slider"></span></label></td>
            </tr>
        </table>

        <?php submit_button( __( 'Save Social Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
