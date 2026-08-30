<?php
/**
 * Announcement bar template.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
$dir = 'left' === $s['announcement_direction'] ? 'normal' : 'reverse';
?>
<div class="nexora-announcement" data-closeable="<?php echo esc_attr( $s['announcement_closeable'] ? '1' : '0' ); ?>">
    <div class="nexora-announcement-track" style="animation-duration:<?php echo esc_attr( $s['announcement_speed'] ); ?>s;animation-direction:<?php echo esc_attr( $dir ); ?>;">
        <div class="nexora-announcement-content">
            <?php if ( ! empty( $s['announcement_link'] ) ) : ?>
                <a href="<?php echo esc_url( $s['announcement_link'] ); ?>"><?php echo esc_html( $s['announcement_text'] ); ?></a>
            <?php else : ?>
                <span><?php echo esc_html( $s['announcement_text'] ); ?></span>
            <?php endif; ?>
        </div>
        <div class="nexora-announcement-content" aria-hidden="true">
            <?php if ( ! empty( $s['announcement_link'] ) ) : ?>
                <a href="<?php echo esc_url( $s['announcement_link'] ); ?>"><?php echo esc_html( $s['announcement_text'] ); ?></a>
            <?php else : ?>
                <span><?php echo esc_html( $s['announcement_text'] ); ?></span>
            <?php endif; ?>
        </div>
    </div>
    <?php if ( $s['announcement_closeable'] ) : ?>
    <button type="button" class="nexora-announcement-close" aria-label="<?php esc_attr_e( 'Close announcement', 'nexora-advanced-header' ); ?>">&times;</button>
    <?php endif; ?>
</div>
