<?php
/**
 * Logo template.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
$logo_url = '';
$logo_id = intval( $s['logo_id'] );

if ( $logo_id > 0 ) {
    $logo_src = wp_get_attachment_image_src( $logo_id, 'full' );
    if ( $logo_src ) {
        $logo_url = $logo_src[0];
    }
}
?>
<div class="nexora-logo nexora-logo-anim-<?php echo esc_attr( $s['logo_animation'] ); ?>">
    <?php if ( ! empty( $logo_url ) ) : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nexora-logo-link">
            <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" style="width:<?php echo esc_attr( $s['logo_width'] ); ?>px;height:<?php echo esc_attr( $s['logo_height'] ); ?>px;margin-right:<?php echo esc_attr( $s['logo_spacing'] ); ?>px;" />
        </a>
    <?php else : ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nexora-logo-text">
            <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
        </a>
    <?php endif; ?>
</div>
