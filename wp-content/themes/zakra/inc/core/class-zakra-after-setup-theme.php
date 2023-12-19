<?php
/**
 * Additional setup After theme setup.
 *
 * @package zakra
 *
 * TODO: @since.
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Zakra_After_Setup_Theme' ) ) {

	/**
	 * After setup theme.
	 */
	class Zakra_After_Setup_Theme {

		/**
		 * Instance.
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Initiator.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor.
		 */
		private function __construct() {

			$this->setup_hooks();
		}

		/**
		 * Define hooks.
		 *
		 * @return void
		 */
		public function setup_hooks(  ) {

			add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );
		}

		/**
		 * Set up theme defaults and registers support for various WordPress features.
		 *
		 * @return void
		 */
		public function setup_theme() {

			// Make theme available for translation.
			load_theme_textdomain( 'zakra', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head.
			add_theme_support( 'automatic-feed-links' );

			// Let WordPress manage the document title.
			add_theme_support( 'title-tag' );

			// Enable support for Post Thumbnails on posts and pages.
			add_theme_support( 'post-thumbnails' );

			// Register menu.
			register_nav_menus(
				array(
					'menu-primary' => esc_html__( 'Primary', 'zakra' ),
				)
			);

			/*
			 * Switch default core markup for search form, comment form, and comments
			 * to output valid HTML5.
			 */
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				)
			);

			// Add theme support for selective refresh for widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );

			/**
			 * Add support for core custom logo.
			 *
			 * @link https://codex.wordpress.org/Theme_Logo
			 */
			add_theme_support(
				'custom-logo',
				array(
					'width'       => 170,
					'height'      => 60,
					'flex-width'  => true,
					'flex-height' => true,
				)
			);

			// Custom background support.
			add_theme_support( 'custom-background' );

			// Gutenberg Wide/fullwidth support.
			add_theme_support( 'align-wide' );

			// Add support for Block Styles.
			add_theme_support( 'wp-block-styles' );

			// AMP support.
			if ( defined( 'AMP__VERSION' ) && ( ! version_compare( AMP__VERSION, '1.0.0', '<' ) ) ) {

				add_theme_support(
					'amp',
					apply_filters(
						'zakra_amp_support_filter',
						array(
							'paired' => true,
						)
					)
				);
			}
		}
	}
}

Zakra_After_Setup_Theme::get_instance();
