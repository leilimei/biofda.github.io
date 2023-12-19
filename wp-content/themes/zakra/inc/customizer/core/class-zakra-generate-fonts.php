<?php
/**
 * Helper class to enqueue fonts.
 *
 * Class Zakra_Fonts
 *
 * @package    ThemeGrill
 * @subpackage Zakra
 * @since      Zakra 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper class to enqueue fonts.
 *
 * Class Zakra_Generate_Fonts
 */
class Zakra_Generate_Fonts {

	/**
	 * Get fonts to generate.
	 *
	 * @var array
	 */
	private static $fonts = array();

	/**
	 * Adds data to the $fonts array for a font to be rendered.
	 *
	 * @param string $name        The name key of the font to add.
	 * @param array  $font_weight An array of weight variants.
	 *
	 * @return void
	 */
	public static function add_font( $name, $font_weight = array() ) {

		if ( ! is_array( $font_weight ) ) {
			// For multiple variant selectons for fonts.
			$font_weight = explode( ',', $font_weight );
		}

		if ( ! empty( $font_weight ) && isset( self::$fonts[ $name ] ) ) {
			foreach ( (array) $font_weight as $variant ) {
				if ( ! in_array( $variant, self::$fonts[ $name ]['font-weight'], true ) ) {
					self::$fonts[ $name ]['font-weight'][] = $variant;
				}
			}
		} else {
			self::$fonts[ $name ] = array(
				'font-weight' => (array) $font_weight,
			);
		}

	}

	/**
	 * Get Fonts
	 */
	public static function get_fonts() {

		/**
		 * Action for content width.
		 *
		 * @since   1.0.0
		 */
		do_action( 'zakra_get_fonts' );

		/**
		 * Filter for add fonts.
		 *
		 * @since   1.0.0
		 */
		return apply_filters( 'zakra_add_fonts', self::$fonts );

	}

	/**
	 * Renders the <link> tag for all fonts in the $fonts array.
	 *
	 * @return void
	 */
	public static function render_fonts() {

		/**
		 * Filter for render fonts.
		 *
		 * @since   1.0.0
		 */
		$font_list = apply_filters( 'zakra_render_fonts', self::get_fonts() );

		$google_fonts = array();
		$font_subset  = array();

		$system_fonts = Zakra_Fonts::get_system_fonts();

		$fonts = 'Open Sans';

		foreach ( $font_list as $name => $font ) {

			if ( ! empty( $name ) && ! isset( $system_fonts[ $name ] ) ) {
				if ( $fonts == $name ) {
					continue;
				}

				// Add font variants.
				$google_fonts[ $name ] = $font['font-weight'];

				/**
				 * Filter to add subset.
				 *
				 * @since   1.0.0
				 */
				$subset = apply_filters( 'zakra_font_subset', '', $name );
				if ( ! empty( $subset ) ) {
					$font_subset = array_unique( $subset );
				}
			}
		}

		if ( empty( $google_fonts ) ) {
			return;
		}

		$google_font_url = self::google_fonts_url( $google_fonts, $font_subset );

		$host_fonts_locally = get_theme_mod( 'zakra_load_google_fonts_locally', 0 );

		if ( 1 == $host_fonts_locally ) {
			wp_enqueue_style( 'zakra_googlefonts', zakra_get_webfont_url( 'https:' . $google_font_url ), array(), ZAKRA_THEME_VERSION, 'all' );
		} else {
			wp_enqueue_style( 'zakra_googlefonts', $google_font_url, array(), ZAKRA_THEME_VERSION, 'all' );
		}

	}

	/**
	 * Google Font URL.
	 * Combine multiple google font in one URL.
	 *
	 * @param array $fonts   Google Fonts array.
	 * @param array $subsets Font's Subsets array.
	 *
	 * @return string
	 */
	public static function google_fonts_url( $fonts, $subsets = array() ) {

		$base_url  = '//fonts.googleapis.com/css';
		$font_args = array();
		$family    = array();

		/**
		 * Filter for google fonts selected.
		 *
		 * @since   1.0.0
		 */
		$fonts = apply_filters( 'zakra_google_fonts_selected', $fonts );

		/* Format Each Font Family in Array */
		foreach ( $fonts as $font_name => $font_weight ) {
			$font_name = str_replace( ' ', '+', $font_name );

			if ( ! empty( $font_weight ) ) {
				if ( is_array( $font_weight ) ) {
					$font_weight = implode( ',', $font_weight );
				}

				$font_family = explode( ',', $font_name );
				$font_family = str_replace( "'", '', $font_family[0] );
				$family[]    = trim( $font_family . ':' . rawurlencode( trim( $font_weight ) ) );
			} else {
				$family[] = trim( $font_name );
			}
		}

		/* Only return URL if font family defined. */
		if ( ! empty( $family ) ) {

			/* Make Font Family a String */
			$family = implode( '|', $family );

			/* Add font family in args */
			$font_args['family'] = $family;

			/* Add font subsets in args */
			if ( ! empty( $subsets ) ) {

				/* format subsets to string */
				if ( is_array( $subsets ) ) {
					$subsets = implode( ',', $subsets );
				}

				$font_args['subset'] = rawurlencode( trim( $subsets ) );
			}

			return add_query_arg( array( $font_args, '&display=swap' ), $base_url );
		}

		return '';
	}

}
