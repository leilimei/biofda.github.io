<?php
/**
 * Extend WP_Customize_Control to add the sortable control.
 *
 * Class Zakra_Sortable_Control
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
 * Class to extend WP_Customize_Control to add the sortable customize control.
 *
 * Class Zakra_Sortable_Control
 */
class Zakra_Sortable_Control extends Zakra_Customize_Base_Additional_Control
{

	/**
	 * Control's Type.
	 *
	 * @var string
	 */
	public $type = 'zakra-sortable';
	public $unsortable = array();

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json()
	{
		parent::to_json();

		$this->json[ 'default' ] = $this->setting->default;

		if ( isset( $this->default ) ) {
			$this->json[ 'default' ] = $this->default;
		}
		$this->json[ 'value' ]       = $this->value();
		$this->json[ 'link' ]        = $this->get_link();
		$this->json[ 'id' ]          = $this->id;
		$this->json[ 'label' ]       = esc_html( $this->label );
		$this->json[ 'description' ] = $this->description;
		$this->json[ 'choices' ]     = array();
		$this->json[ 'unsortable' ]  = array();
		$this->json[ 'inputAttrs' ]  = '';

		foreach ( $this->choices as $key => $value ) {
			if ( in_array( $key, $this->unsortable, true ) ) {
				continue;
			}

			$this->json[ 'choices' ][ $key ] = $value;
		}

		foreach ( $this->unsortable as $item ) {
			if ( in_array( $item, array_keys( $this->choices ), true ) ) {
				$this->json[ 'unsortable' ][ $item ] = $this->choices[ $item ];
			}
		}

		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json[ 'inputAttrs' ] .= $attr . '="' . esc_attr( $value ) . '" ';
		}
	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see    WP_Customize_Control::print_template()
	 */
	protected function content_template()
	{
		?>

        <div class="customizer-text">
            <# if ( data.label ) { #>
            <span class="customize-control-label">{{{ data.label }}}</span>
            <# } #>

            <# if ( data.description ) { #>
            <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>
        </div>

        <ul class="unsortable">
            <# _.each( data.unsortable, function( choiceLabel, choiceID ) { #>
            <# if( _.contains( data.value, choiceID) ){ #>
            <li {{{ data.inputAttrs }}} class='zakra-sortable-item' data-value='{{ choiceID }}'>
                <span class="zakra-label">{{{ choiceLabel }}}</span>
                <span class="switch-wrap">
                    <span class="switch"></span>
                </span>
            </li>
            <# }else { #>
            <li {{{ data.inputAttrs }}} class='zakra-sortable-item invisible' data-value='{{ choiceID }}'>
                <span class="zakra-label">{{{ choiceLabel }}}</span>
                <span class="switch-wrap">
                    <span class="switch"></span>
                </span>
            </li>
            <# } #>

            <# } ); #>
        </ul>

        <ul class="sortable">
            <# _.each( data.value, function( choiceID ) { #>
            <# if ( data.choices[ choiceID ] ) { #>
            <li {{{ data.inputAttrs }}} class='zakra-sortable-item' data-value='{{ choiceID }}'>
                <span class="zakra-choice">
                    <i class='dashicons dashicons-menu'></i>
                    <span class="zakra-label">
                        {{{ data.choices[ choiceID ] }}}
                    </span>
                </span>
                <span class="switch-wrap">
                    <span class="switch"></span>
                </span>
            </li>
            <# } #>
            <# } ); #>

            <# _.each( data.choices, function( choiceLabel, choiceID ) { #>
            <# if ( Array.isArray(data.value) && -1 === data.value.indexOf( choiceID ) ) { #>
            <li {{{ data.inputAttrs }}} class='zakra-sortable-item invisible' data-value='{{ choiceID }}'>
                 <span class="zakra-choice">
                    <i class='dashicons dashicons-menu'></i>
                 <span class="zakra-label">
                        {{{ data.choices[ choiceID ] }}}
                    </span>
                </span>

                <span class="switch-wrap">
                    <span class="switch"></span>
                </span>
            </li>
            <# } #>
            <# } ); #>
        </ul>

		<?php
	}

	/**
	 * Don't render the control content from PHP, as it's rendered via JS on load.
	 */
	public function render_content()
	{
	}

}
