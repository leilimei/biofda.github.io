<?php
/**
 * Zakra functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package zakra
 *
 * @since 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Define constants.
 */
require get_template_directory() . '/inc/base/class-zakra-constants.php';

/**
 * Helpers functions.
 */
require ZAKRA_PARENT_INC_DIR . '/helper/utils.php';

/**
 * Base.
 */
// Generate WordPress filter hook dynamically.
require ZAKRA_PARENT_INC_DIR . '/base/class-zakra-dynamic-filter.php';

// Adds classes to appropriate places.
require ZAKRA_PARENT_INC_DIR . '/base/class-zakra-css-classes.php';

// Generate dynamic CSS from styling options.
require ZAKRA_PARENT_INC_DIR . '/base/class-zakra-dynamic-css.php';

/**
 * Core.
 */
// After setup theme.
require ZAKRA_PARENT_INC_DIR . '/core/class-zakra-after-setup-theme.php';

// Load scripts.
require ZAKRA_PARENT_INC_DIR . '/core/class-zakra-enqueue-scripts.php';

// Widget-related functionalities.
require ZAKRA_PARENT_INC_DIR . '/core/class-zakra-widgets.php';

// Header Media.
require ZAKRA_PARENT_INC_DIR . '/core/custom-header.php';

/**
 * Update migrations.
 */
require ZAKRA_PARENT_INC_DIR . '/migration/class-zakra-migration.php';

/**
 * Customizer.
 */
require ZAKRA_PARENT_INC_DIR . '/customizer/class-zakra-customizer.php';

/**
 * Deprecated.
 */
require ZAKRA_PARENT_INC_DIR . '/deprecated/deprecated-filters.php';
require ZAKRA_PARENT_INC_DIR . '/deprecated/deprecated-functions.php';
require ZAKRA_PARENT_INC_DIR . '/deprecated/deprecated-hooks.php';

/**
 * Templates.
 */
require ZAKRA_PARENT_INC_DIR . '/template-tags.php';
require ZAKRA_PARENT_INC_DIR . '/template-functions.php';

// Template hooks.
require ZAKRA_PARENT_DIR . '/template-parts/hooks/hook-functions.php';

require ZAKRA_PARENT_DIR . '/template-parts/hooks/header/header.php';
require ZAKRA_PARENT_DIR . '/template-parts/hooks/header/top-bar.php';
require ZAKRA_PARENT_DIR . '/template-parts/hooks/header/header-main.php';
require ZAKRA_PARENT_DIR . '/template-parts/hooks/header/primary-menu.php';
require ZAKRA_PARENT_DIR . '/template-parts/hooks/header/header-actions.php';
require ZAKRA_PARENT_DIR . '/template-parts/hooks/header/header-buttons.php';
require ZAKRA_PARENT_DIR . '/template-parts/hooks/header/transparent-header.php';
require ZAKRA_PARENT_DIR . '/template-parts/hooks/header/header-media.php';

require ZAKRA_PARENT_DIR . '/template-parts/hooks/page-header/page-header.php';

require ZAKRA_PARENT_DIR . '/template-parts/hooks/content/content.php';
require ZAKRA_PARENT_DIR . '/template-parts/hooks/blog/blog.php';

require ZAKRA_PARENT_DIR . '/template-parts/hooks/footer/footer.php';
require ZAKRA_PARENT_DIR . '/template-parts/hooks/footer/footer-widgets.php';
require ZAKRA_PARENT_DIR . '/template-parts/hooks/footer/footer-bar.php';
require ZAKRA_PARENT_DIR . '/template-parts/hooks/footer/scroll-to-top.php';

require ZAKRA_PARENT_INC_DIR . '/hooks/hooks.php';
require ZAKRA_PARENT_INC_DIR . '/hooks/content.php';
require ZAKRA_PARENT_INC_DIR . '/hooks/customize.php';

/**
 * Plugins compatibility.
 */
// AMP.
if ( defined( 'AMP__VERSION' ) && ( ! version_compare( AMP__VERSION, '1.0.0', '<' ) ) ) {

	require_once ZAKRA_PARENT_INC_DIR . '/compatibility/amp/class-zakra-amp.php';
}

// Jetpack.
if ( defined( 'JETPACK__VERSION' ) ) {

	require ZAKRA_PARENT_INC_DIR . '/compatibility/jetpack/class-zakra-jetpack.php';
}

// WooCommerce.
if ( class_exists( 'WooCommerce' ) ) {

	require ZAKRA_PARENT_INC_DIR . '/compatibility/woocommerce/class-zakra-woocommerce.php';
}

// Elementor Pro.
require_once ZAKRA_PARENT_INC_DIR . '/compatibility/elementor/class-zakra-elementor-pro.php';

// Breadcrumbs class.
require_once ZAKRA_PARENT_INC_DIR . '/class-breadcrumb-trail.php';

// Svg icon class.
require_once ZAKRA_PARENT_INC_DIR . '/class-zakra-svg-icons.php';


// Admin screen.
if ( is_admin() ) {

	// Meta boxes.
	require ZAKRA_PARENT_INC_DIR . '/meta-boxes/class-zakra-meta-box-page-settings.php';
	require ZAKRA_PARENT_INC_DIR . '/meta-boxes/class-zakra-meta-box.php';

	// Theme options page.
	require ZAKRA_PARENT_INC_DIR . '/admin/class-zakra-admin.php';
	require ZAKRA_PARENT_INC_DIR . '/admin/class-zakra-notice.php';
	require ZAKRA_PARENT_INC_DIR . '/admin/class-zakra-welcome-notice.php';
	require ZAKRA_PARENT_INC_DIR . '/admin/class-zakra-upgrade-notice.php';
	require ZAKRA_PARENT_INC_DIR . '/admin/class-zakra-dashboard.php';
	require ZAKRA_PARENT_INC_DIR . '/admin/class-zakra-theme-review-notice.php';
	require ZAKRA_PARENT_INC_DIR . '/admin/class-zakra-demo-import-migration-notice.php';
	require ZAKRA_PARENT_INC_DIR . '/admin/class-zakra-pro-minimum-version-notice.php';
}

// Set default content width.
if ( ! isset( $content_width ) ) {

	$content_width = 812;
}

// Calculate $content_width value according to layout options from Customizer and meta boxes.
function zakra_content_width_rdr() {

	global $content_width;

	// Get layout type.
	$layout_type     = zakra_get_layout_type();
	$layouts_sidebar = array( 'left', 'right' );

	/**
	 * Calculate content width.
	 */

	// Get required values from Customizer.
	$container_width = get_theme_mod( 'zakra_container_width', array( 'size' => 1170, 'unit' => 'px', ) );
	$sidebar_width   = get_theme_mod( 'zakra_sidebar_width', array( 'size' => 30, 'unit' => '%' ) );

	$container_width = isset( $container_width[ 'size' ] ) ? (int) $container_width[ 'size' ] : 1160;
	$content_width   = isset( $sidebar_width[ 'size' ] ) ? ( 100 - (float) $sidebar_width[ 'size' ] ) : 70;

	// Calculate Padding to reduce.
	$container_style = get_theme_mod( 'zakra_content_area_layout', 'bordered' );
	$content_padding = ( 'boxed' === $container_style ) ? 120 : 60;

	if ( in_array( $layout_type, $layouts_sidebar, true ) ) {

		$content_width = ( ( $container_width * $content_width ) / 100 ) - $content_padding;
	} else {

		$content_width = $container_width - $content_padding;
	}

}

add_action( 'template_redirect', 'zakra_content_width_rdr' );
