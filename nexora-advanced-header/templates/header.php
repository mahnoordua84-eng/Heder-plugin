<?php
/**
 * Main header template.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
?>
<div class="nexora-header-inner">
    <div class="nexora-header-left">
        <?php include __DIR__ . '/logo.php'; ?>
    </div>

    <div class="nexora-header-center">
        <?php $nav->render(); ?>
    </div>

    <div class="nexora-header-right">
        <?php $search->render(); ?>

        <?php if ( $s['account_enabled'] ) : ?>
        <div class="nexora-account">
            <a href="<?php echo esc_url( $woocommerce->account_url() ); ?>" class="nexora-account-link" aria-label="<?php esc_attr_e( 'My Account', 'nexora-advanced-header' ); ?>">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="8" r="4" stroke="currentColor" stroke-width="2"/>
                    <path d="M4 21c0-4 4-6 8-6s8 2 8 6" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                </svg>
            </a>
        </div>
        <?php endif; ?>

        <?php $cart->render_icon(); ?>

        <?php $social->render(); ?>

        <?php if ( $s['cta_enabled'] ) : ?>
        <a href="<?php echo esc_url( $s['cta_url'] ); ?>" class="nexora-cta nexora-cta-<?php echo esc_attr( $s['cta_animation'] ); ?>">
            <?php if ( ! empty( $s['cta_icon'] ) ) : ?>
                <span class="nexora-cta-icon"><?php echo wp_kses( $s['cta_icon'], array( 'svg' => array( 'width' => true, 'height' => true, 'viewBox' => true, 'fill' => true, 'aria-hidden' => true ), 'path' => array( 'd' => true, 'stroke' => true, 'stroke-width' => true, 'fill' => true ) ) ); ?></span>
            <?php endif; ?>
            <span><?php echo esc_html( $s['cta_text'] ); ?></span>
        </a>
        <?php endif; ?>

        <button class="nexora-hamburger" type="button" aria-label="<?php esc_attr_e( 'Open menu', 'nexora-advanced-header' ); ?>" aria-expanded="false" aria-controls="nexora-mobile-menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</div>
