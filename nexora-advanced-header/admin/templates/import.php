<?php
/**
 * Import/Export section.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
$export_json = $this->settings->export();
?>
<div class="nexora-card">
    <h2><?php esc_html_e( 'Import / Export Settings', 'nexora-advanced-header' ); ?></h2>

    <div class="nexora-subsection">
        <h3><?php esc_html_e( 'Export Settings', 'nexora-advanced-header' ); ?></h3>
        <p><?php esc_html_e( 'Copy the JSON below or download it to back up your header configuration.', 'nexora-advanced-header' ); ?></p>
        <textarea readonly rows="10" cols="80" style="font-family:monospace;" onclick="this.select();"><?php echo esc_textarea( $export_json ); ?></textarea>
    </div>

    <div class="nexora-subsection">
        <h3><?php esc_html_e( 'Import Settings', 'nexora-advanced-header' ); ?></h3>
        <form method="post" action="">
            <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
            <input type="hidden" name="nexora_header_action" value="import" />
            <p><?php esc_html_e( 'Paste exported JSON below and submit.', 'nexora-advanced-header' ); ?></p>
            <textarea name="nexora_import_json" rows="10" cols="80" style="font-family:monospace;" placeholder='<?php esc_attr_e( "Paste JSON here...", "nexora-advanced-header" ); ?>'></textarea>
            <?php submit_button( __( 'Import Settings', 'nexora-advanced-header' ), 'secondary' ); ?>
        </form>
    </div>

    <div class="nexora-subsection">
        <h3><?php esc_html_e( 'Reset to Defaults', 'nexora-advanced-header' ); ?></h3>
        <form method="post" action="" onsubmit="return confirm('<?php esc_attr_e( 'Are you sure you want to reset all settings to defaults?', 'nexora-advanced-header' ); ?>');">
            <?php wp_nonce_field( 'nexora_header_save', 'nexora_header_nonce' ); ?>
            <input type="hidden" name="nexora_header_action" value="reset" />
            <p class="description"><?php esc_html_e( 'This will erase all your custom settings and restore the default configuration.', 'nexora-advanced-header' ); ?></p>
            <?php submit_button( __( 'Reset All Settings', 'nexora-advanced-header' ), 'delete' ); ?>
        </form>
    </div>
</div>
