<?php
/**
 * Customize Upgrade control class.
 *
 * @package zakra
 *
 * @since   1.4.6
 * @see     WP_Customize_Control
 */

/**
 * Class Zakra_Upgrade_Control
 */
class Zakra_Upgrade_Control extends Zakra_Customize_Base_Additional_Control {

	/**
	 * Customize control type.
	 *
	 * @var string
	 */
	public $type = 'zakra-upgrade';

	/**
	 * Custom links for this control.
	 *
	 * @var array
	 */
	public $url = '';

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {

		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}
		$this->json['url'] = esc_url( $this->url );

	}

	/**
	 * Renders the Underscore template for this control.
	 *
	 * @see    WP_Customize_Control::print_template()
	 * @return void
	 */
	protected function content_template() {
		?>
			<div class="zakra-upgrade">
				<div class="zakra-detail">
					<p class="description upgrade-description">{{{ data.description }}}</p>

					<span>
						<a href="{{{data.url}}}" class="button button-primary" target="_blank">
							{{ data.label }}
						</a>
					</span>
				</div>
			</div>
		<?php
	}

	/**
	 * Render content is still called, so be sure to override it with an empty function in your subclass as well.
	 */
	protected function render_content() {

	}

}
