<?php
/**
 * Social icons renderer.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

/**
 * Renders configured social icons with inline SVGs and safe external links.
 */
class Nexora_Header_Social {

    private $settings;

    public function __construct( $settings ) {
        $this->settings = $settings;
    }

    public function render() {
        if ( ! $this->settings->get( 'social_enabled' ) ) {
            return;
        }

        $links = array(
            'facebook'  => $this->settings->get( 'social_facebook' ),
            'instagram' => $this->settings->get( 'social_instagram' ),
            'whatsapp'  => $this->settings->get( 'social_whatsapp' ),
            'youtube'   => $this->settings->get( 'social_youtube' ),
            'tiktok'    => $this->settings->get( 'social_tiktok' ),
            'twitter'   => $this->settings->get( 'social_twitter' ),
            'linkedin'  => $this->settings->get( 'social_linkedin' ),
            'pinterest' => $this->settings->get( 'social_pinterest' ),
        );

        $has_any = false;
        foreach ( $links as $url ) {
            if ( ! empty( $url ) ) {
                $has_any = true;
                break;
            }
        }

        if ( ! $has_any ) {
            return;
        }

        $new_tab = $this->settings->get( 'social_new_tab' );
        $target = $new_tab ? ' target="_blank" rel="noopener noreferrer nofollow"' : '';

        echo '<div class="nexora-social">';
        foreach ( $links as $platform => $url ) {
            if ( empty( $url ) ) {
                continue;
            }
            echo '<a href="' . esc_url( $url ) . '" class="nexora-social-icon nexora-social-' . esc_attr( $platform ) . '" aria-label="' . esc_attr( ucfirst( $platform ) ) . '"' . $target . '>';
            echo $this->icon( $platform );
            echo '</a>';
        }
        echo '</div>';
    }

    private function icon( $platform ) {
        $icons = array(
            'facebook'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.3c-1.2 0-1.6.8-1.6 1.6V12h2.8l-.4 2.9h-2.4v7A10 10 0 0 0 22 12z"/></svg>',
            'instagram' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2"/><circle cx="17.5" cy="6.5" r="1.2" fill="currentColor"/></svg>',
            'whatsapp'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.5 15.2L2 22l4.9-1.5A10 10 0 1 0 12 2zm0 18a8 8 0 0 1-4.1-1.1l-.3-.2-2.9.9.9-2.8-.2-.3A8 8 0 1 1 12 20zm4.6-6c-.3-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1-.2.3-.6.8-.8 1-.1.1-.3.2-.5.1-.3-.1-1.1-.4-2.1-1.3-.8-.7-1.3-1.6-1.5-1.8-.2-.3 0-.4.1-.6.1-.1.3-.3.4-.5.1-.2.1-.3.2-.5.1-.2 0-.4 0-.5-.1-.1-.6-1.4-.8-1.9-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3-.2.3-.9.9-.9 2.2s.9 2.5 1 2.7c.1.0 1.8 2.7 4.3 3.8.6.3 1.1.4 1.5.5.6.2 1.2.2 1.6.1.5-.1 1.5-.6 1.7-1.2.2-.6.2-1.1.1-1.2-.1-.1-.2-.1-.5-.3z"/></svg>',
            'youtube'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23 12s0-3.2-.4-4.7c-.2-.8-.9-1.5-1.7-1.7C19.4 5.2 12 5.2 12 5.2s-7.4 0-8.9.4c-.8.2-1.5.9-1.7 1.7C1 8.8 1 12 1 12s0 3.2.4 4.7c.2.8.9 1.5 1.7 1.7 1.5.4 8.9.4 8.9.4s7.4 0 8.9-.4c.8-.2 1.5-.9 1.7-1.7.4-1.5.4-4.7.4-4.7zM9.8 15.3V8.7l5.7 3.3-5.7 3.3z"/></svg>',
            'tiktok'    => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16 2v3.5a5 5 0 0 0 5 5v3a8 8 0 0 1-5-1.7V16a6 6 0 1 1-6-6v3a3 3 0 1 0 3 3V2h3z"/></svg>',
            'twitter'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.9 6.2c.8-.5 1.4-1.2 1.7-2.1-.8.4-1.6.7-2.5.9-.7-.8-1.7-1.3-2.8-1.3-2.2 0-3.9 1.8-3.9 3.9 0 .3 0 .6.1.9-3.2-.2-6.1-1.7-8-4-.3.6-.5 1.2-.5 2 0 1.4.7 2.6 1.8 3.3-.6 0-1.2-.2-1.8-.5 0 1.9 1.4 3.5 3.2 3.9-.3.1-.7.1-1 .1-.3 0-.5 0-.8-.1.5 1.6 2 2.8 3.8 2.8-1.4 1.1-3.1 1.7-5 1.7H2c1.8 1.2 4 1.9 6.3 1.9 7.5 0 11.6-6.2 11.6-11.6v-.5c.8-.6 1.5-1.3 2-2.2-.7.3-1.5.5-2.3.6z"/></svg>',
            'linkedin'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zM8.3 18.3H5.7v-8h2.6v8zM7 9.1a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm11.3 9.2h-2.6v-3.9c0-.9 0-2.1-1.3-2.1s-1.5 1-1.5 2v4h-2.6v-8h2.5v1.1h.1c.4-.7 1.2-1.3 2.5-1.3 2.6 0 3.1 1.7 3.1 4v4.2z"/></svg>',
            'pinterest' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-3.6 19.3c-.1-.8-.2-2 0-2.9l1.2-5s-.3-.6-.3-1.5c0-1.4.8-2.4 1.8-2.4.9 0 1.3.6 1.3 1.4 0 .9-.6 2.2-.9 3.4-.2 1 .5 1.8 1.5 1.8 1.9 0 3.2-2.4 3.2-5.2 0-2.1-1.4-3.7-4-3.7a4.6 4.6 0 0 0-4.8 4.6c0 .9.3 1.5.6 2 .2.2.2.3.1.5l-.2.8c-.1.3-.2.3-.5.2-1.5-.7-2.3-2.7-2.3-4.4 0-3.6 2.6-6.9 7.5-6.9 3.9 0 7 2.8 7 6.5 0 3.9-2.5 7.1-5.9 7.1-1.2 0-2.3-.6-2.6-1.3l-.7 2.7c-.3 1-.8 1.9-1.3 2.7A10 10 0 1 0 12 2z"/></svg>',
        );

        return isset( $icons[ $platform ] ) ? $icons[ $platform ] : '';
    }
}
