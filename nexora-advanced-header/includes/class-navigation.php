<?php
/**
 * Navigation and mega menu renderer.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

/**
 * Walks the selected WordPress nav menu and renders accessible dropdowns and mega menus.
 */
class Nexora_Header_Navigation {

    private $settings;

    public function __construct( $settings ) {
        $this->settings = $settings;
    }

    public function render() {
        $location = $this->settings->get( 'menu_location', 'nexora_primary' );
        $locations = get_nav_menu_locations();

        if ( empty( $locations[ $location ] ) ) {
            echo '<nav class="nexora-nav" aria-label="' . esc_attr__( 'Primary', 'nexora-advanced-header' ) . '">';
            echo '<span class="nexora-nav-empty">' . esc_html__( 'Select a menu in Nexora Header settings.', 'nexora-advanced-header' ) . '</span>';
            echo '</nav>';
            return;
        }

        $menu_id = $locations[ $location ];

        echo '<nav class="nexora-nav" role="navigation" aria-label="' . esc_attr__( 'Primary Menu', 'nexora-advanced-header' ) . '">';
        echo '<ul class="nexora-menu">';

        $menu_items = wp_get_nav_menu_items( $menu_id );
        if ( ! empty( $menu_items ) ) {
            $this->render_items( $menu_items );
        }

        echo '</ul>';
        echo '</nav>';
    }

    private function render_items( $menu_items, $parent_id = 0, $level = 0 ) {
        foreach ( $menu_items as $key => $item ) {
            if ( (int) $item->menu_item_parent !== (int) $parent_id ) {
                continue;
            }

            $has_children = $this->has_children( $menu_items, $item->ID );
            $is_mega     = false;
            $mega_cols  = 0;

            if ( $level === 0 && $this->settings->get( 'mega_menu_enabled' ) && $has_children ) {
                $mega_cols = $this->count_children( $menu_items, $item->ID );
                if ( $mega_cols >= 2 ) {
                    $is_mega = true;
                }
            }

            $classes = array( 'nexora-menu-item' );
            if ( $has_children ) {
                $classes[] = 'menu-item-has-children';
            }
            if ( $is_mega ) {
                $classes[] = 'nexora-mega-parent';
            }
            if ( in_array( 'current-menu-item', (array) $item->classes, true ) ) {
                $classes[] = 'nexora-active';
            }

            echo '<li class="' . esc_attr( implode( ' ', $classes ) ) . '">';

            echo '<a href="' . esc_url( $item->url ) . '" class="nexora-menu-link"';
            if ( $has_children ) {
                echo ' aria-haspopup="true" aria-expanded="false"';
            }
            echo '>';
            echo '<span>' . esc_html( $item->title ) . '</span>';
            if ( $has_children ) {
                echo '<svg class="nexora-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
            }
            echo '</a>';

            if ( $has_children ) {
                $sub_class = 'nexora-submenu';
                if ( $is_mega ) {
                    $max_cols = 5;
                    $cols = min( $mega_cols, $max_cols );
                    $sub_class .= ' nexora-mega nexora-mega-' . $cols . '-col';
                }
                echo '<ul class="' . esc_attr( $sub_class ) . '" role="menu">';
                $this->render_items( $menu_items, $item->ID, $level + 1 );
                echo '</ul>';
            }

            echo '</li>';
        }
    }

    private function has_children( $items, $parent_id ) {
        foreach ( $items as $item ) {
            if ( (int) $item->menu_item_parent === (int) $parent_id ) {
                return true;
            }
        }
        return false;
    }

    private function count_children( $items, $parent_id ) {
        $count = 0;
        foreach ( $items as $item ) {
            if ( (int) $item->menu_item_parent === (int) $parent_id ) {
                $count++;
            }
        }
        return $count;
    }
}
