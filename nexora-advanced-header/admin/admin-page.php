<?php
/**
 * Admin page shell with sidebar navigation and section rendering.
 *
 * @package NexoraAdvancedHeader
 */

defined( 'ABSPATH' ) || exit;

$s = $settings;
$sections = array(
    'general'    => __( 'Dashboard', 'nexora-advanced-header' ),
    'logo'       => __( 'Logo', 'nexora-advanced-header' ),
    'menu'       => __( 'Menu', 'nexora-advanced-header' ),
    'search'     => __( 'Search', 'nexora-advanced-header' ),
    'cart'       => __( 'Cart', 'nexora-advanced-header' ),
    'account'    => __( 'Account', 'nexora-advanced-header' ),
    'social'     => __( 'Social', 'nexora-advanced-header' ),
    'cta'        => __( 'CTA', 'nexora-advanced-header' ),
    'animation'  => __( 'Animation', 'nexora-advanced-header' ),
    'colors'     => __( 'Colors', 'nexora-advanced-header' ),
    'typography' => __( 'Typography', 'nexora-advanced-header' ),
    'responsive' => __( 'Responsive', 'nexora-advanced-header' ),
    'advanced'   => __( 'Advanced', 'nexora-advanced-header' ),
    'import'     => __( 'Import/Export', 'nexora-advanced-header' ),
    'about'      => __( 'About', 'nexora-advanced-header' ),
);
?>
<div class="wrap nexora-admin-wrap">
    <h1 class="nexora-admin-title"><?php esc_html_e( 'Nexora Advanced Header', 'nexora-advanced-header' ); ?></h1>

    <div class="nexora-admin-layout">
        <nav class="nexora-admin-sidebar">
            <ul>
                <?php foreach ( $sections as $slug => $label ) : ?>
                <li>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=nexora-header-' . $slug ) ); ?>" class="<?php echo $section === $slug ? 'active' : ''; ?>">
                        <?php echo esc_html( $label ); ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <div class="nexora-admin-content">
            <?php
            $template_file = NEXORA_HEADER_DIR . 'admin/templates/' . $section . '.php';
            if ( file_exists( $template_file ) ) {
                include $template_file;
            } else {
                echo '<p>' . esc_html__( 'Section not found.', 'nexora-advanced-header' ) . '</p>';
            }
            ?>
        </div>
    </div>
</div>
