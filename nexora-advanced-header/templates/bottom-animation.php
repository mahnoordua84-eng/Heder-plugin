<?php
/**
 * Bottom animated line template.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
$dir = 'left' === $s['bottom_direction'] ? 'normal' : 'reverse';
$items = array_filter( array_map( 'trim', explode( '•', $s['bottom_text'] ) ) );
?>
<div class="nexora-bottom-line" data-pause="<?php echo esc_attr( $s['bottom_pause_hover'] ? '1' : '0' ); ?>" data-glow="<?php echo esc_attr( $s['bottom_glow'] ? '1' : '0' ); ?>">
    <div class="nexora-bottom-track" style="animation-duration:<?php echo esc_attr( $s['bottom_speed'] ); ?>s;animation-direction:<?php echo esc_attr( $dir ); ?>;">
        <div class="nexora-bottom-content">
            <?php foreach ( $items as $item ) : ?>
                <span class="nexora-bottom-item"><?php echo esc_html( trim( $item ) ); ?></span>
                <span class="nexora-bottom-sep" aria-hidden="true">→</span>
            <?php endforeach; ?>
        </div>
        <div class="nexora-bottom-content" aria-hidden="true">
            <?php foreach ( $items as $item ) : ?>
                <span class="nexora-bottom-item"><?php echo esc_html( trim( $item ) ); ?></span>
                <span class="nexora-bottom-sep" aria-hidden="true">→</span>
            <?php endforeach; ?>
        </div>
    </div>
</div>
