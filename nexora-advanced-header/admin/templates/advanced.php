<?php
/**
 * Advanced section (custom CSS/JS, exclude pages).
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
$pages = get_pages( array( 'number' => 100 ) );
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Advanced Settings', 'nexora-advanced-header' ); ?></h2>
    <form method="post" action="">
        <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
        <input type="hidden" name="nexora_header_action" value="save" />

        <table class="form-table" role="presentation">
            <tr>
                <th><?php esc_html_e( 'Exclude Pages', 'nexora-advanced-header' ); ?></th>
                <td>
                    <?php if ( ! empty( $pages ) ) : ?>
                    <select name="nexora_settings[exclude_pages][]" multiple size="8" style="min-width:300px;">
                        <?php
                        $excluded = (array) $s['exclude_pages'];
                        foreach ( $pages as $page ) :
                        ?>
                        <option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( in_array( (string) $page->ID, $excluded, true ) ); ?>><?php echo esc_html( $page->post_title ); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php else : ?>
                    <p><?php esc_html_e( 'No pages found.', 'nexora-advanced-header' ); ?></p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th><label for="nexora-custom-css"><?php esc_html_e( 'Custom CSS', 'nexora-advanced-header' ); ?></label></th>
                <td><textarea id="nexora-custom-css" name="nexora_settings[custom_css]" rows="10" cols="80" style="font-family:monospace;"><?php echo esc_textarea( $s['custom_css'] ); ?></textarea></td>
            </tr>
            <tr>
                <th><label for="nexora-custom-js"><?php esc_html_e( 'Custom JavaScript', 'nexora-advanced-header' ); ?></label></th>
                <td><textarea id="nexora-custom-js" name="nexora_settings[custom_js]" rows="10" cols="80" style="font-family:monospace;" placeholder="<?php esc_attr_e( 'Only for administrators. Executed on frontend.', 'nexora-advanced-header' ); ?>"><?php echo esc_textarea( $s['custom_js'] ); ?></textarea></td>
            </tr>
        </table>

        <?php submit_button( __( 'Save Advanced Settings', 'nexora-advanced-header' ) ); ?>
    </form>
</div>
