<?php
/**
 * Mobile menu drawer template.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'nexora_render_mobile_items' ) ) {
    function nexora_render_mobile_items( $items, $parent = 0 ) {
        foreach ( $items as $item ) {
            if ( (int) $item->menu_item_parent !== (int) $parent ) {
                continue;
            }
            $has_children = false;
            foreach ( $items as $child ) {
                if ( (int) $child->menu_item_parent === (int) $item->ID ) {
                    $has_children = true;
                    break;
                }
            }
            echo '<li class="nexora-mobile-item' . ( $has_children ? ' has-children' : '' ) . '">';
            echo '<a href="' . esc_url( $item->url ) . '">' . esc_html( $item->title ) . '</a>';
            if ( $has_children ) {
                echo '<button class="nexora-mobile-arrow" type="button" aria-expanded="false" aria-label="' . esc_attr__( 'Toggle submenu', 'nexora-advanced-header' ) . '"><svg width="12" height="12" viewBox="0 0 24 24" fill="none"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></button>';
                echo '<ul class="nexora-mobile-submenu">';
                nexora_render_mobile_items( $items, $item->ID );
                echo '</ul>';
            }
            echo '</li>';
        }
    }
}

$s = $settings;
$side = $s['mobile_menu_side'];

$menu_items = array();
$location = $s['menu_location'];
$locations = get_nav_menu_locations();
if ( ! empty( $locations[ $location ] ) ) {
    $menu_items = wp_get_nav_menu_items( $locations[ $location ] );
}
?>
<div class="nexora-mobile-overlay" aria-hidden="true"></div>
<aside id="nexora-mobile-menu" class="nexora-mobile-menu nexora-mobile-<?php echo esc_attr( $side ); ?>" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'Mobile Menu', 'nexora-advanced-header' ); ?>">
    <div class="nexora-mobile-header">
        <span class="nexora-mobile-title"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
        <button type="button" class="nexora-mobile-close" aria-label="<?php esc_attr_e( 'Close menu', 'nexora-advanced-header' ); ?>">&times;</button>
    </div>

    <?php if ( $s['mobile_show_search'] ) : ?>
    <div class="nexora-mobile-search">
        <?php $search->render(); ?>
    </div>
    <?php endif; ?>

    <nav class="nexora-mobile-nav" aria-label="<?php esc_attr_e( 'Mobile Navigation', 'nexora-advanced-header' ); ?>">
        <?php if ( ! empty( $menu_items ) ) : ?>
        <ul class="nexora-mobile-menu-list">
            <?php nexora_render_mobile_items( $menu_items ); ?>
        </ul>
        <?php else : ?>
        <p class="nexora-mobile-empty"><?php esc_html_e( 'No menu assigned.', 'nexora-advanced-header' ); ?></p>
        <?php endif; ?>
    </nav>

    <div class="nexora-mobile-footer">
        <?php if ( $s['mobile_show_cart'] ) $cart->render_icon(); ?>
        <?php if ( $s['account_enabled'] ) : ?>
        <a href="<?php echo esc_url( $woocommerce->account_url() ); ?>" class="nexora-mobile-account"><?php esc_html_e( 'My Account', 'nexora-advanced-header' ); ?></a>
        <?php endif; ?>
        <?php if ( $s['mobile_show_social'] ) $social->render(); ?>
        <?php if ( $s['mobile_show_cta'] && $s['cta_enabled'] ) : ?>
        <a href="<?php echo esc_url( $s['cta_url'] ); ?>" class="nexora-cta nexora-cta-mobile"><?php echo esc_html( $s['cta_text'] ); ?></a>
        <?php endif; ?>
    </div>
</aside>
