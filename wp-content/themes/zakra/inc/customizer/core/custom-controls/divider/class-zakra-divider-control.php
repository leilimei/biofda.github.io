<?php
/**
 * Extend WP_Customize_Control to add the divider control.
 *
 * Class Zakra_Divider_Control
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
 * Class to extend WP_Customize_Control to add the divider customize control.
 *
 * Class Zakra_Divider_Control
 */
class Zakra_Divider_Control extends Zakra_Customize_Base_Additional_Control {

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'zakra-divider';

	/**
	 * Divider placement
	 *
	 * @var string
	 */
	public $placement = 'above';

	/**
	 * Divider style
	 *
	 * @var string
	 */
	public $style = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {

		parent::to_json();

		$this->json['label']       = esc_html( $this->label );
		$this->json['description'] = $this->description;

		$this->json['placement'] = $this->placement;

		$this->json['style'] = $this->style;

	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 */
	protected function content_template() {
		?>

		<div class="divider-placement-{{ data.placement }} zakra-divider-{{data.style}}">
			<# if ( data.placement == 'above' ) { #>
			<hr />
			<# } #>

			<div class="customizer-text">
				<# if ( data.label ) { #>
				<span class="customize-control-label">{{{ data.label }}}</span>
				<# } #>

				<# if ( data.description ) { #>
				<span class="description customize-control-description">{{{ data.description }}}</span>
				<# } #>
			</div>

			<# if ( data.placement == 'below' ) { #>
			<hr />
			<# } #>
		</div>

		<?php
	}

}
