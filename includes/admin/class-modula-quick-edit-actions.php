<?php

/**
 * Class Modula_Quick_Edit_Actions used for the Quick Edit Actions of Modula's CPT
 */
class Modula_Quick_Edit_Actions {

	/**
	 * Holds the class object.
	 *
	 * @since 2.4.2
	 *
	 * @var object
	 */
	public static $instance;

	/**
	 * Primary class constructor.
	 *
	 * @since 2.4.2
	 */
	public function __construct() {

		add_action( 'quick_edit_custom_box', array( $this, 'display_quick_edit_custom' ), 10, 2 );            //output form elements for quickedit interface

	}

	/**
	 * Display our custom content on the quick-edit interface, no values can be pre-populated (all done in JS)
	 *
	 * @param $column
	 * @param $post_type
	 *
	 * @since 2.4.2
	 */
	public function display_quick_edit_custom( $column, $post_type ) {

		if ( 'modula-gallery' != $post_type ) {
			return;
		}

		$html = '';

		$grid_type_options = apply_filters( 'modula_quick_edit_grid_type', array(
			'creative-gallery' => esc_html__( 'Creative gallery', 'modula-best-grid-gallery' ),
			'custom-grid'      => esc_html__( 'Custom grid', 'modula-best-grid-gallery' )
		) );

		$lightbox_options = apply_filters( 'modula_quick_edit_lightbox', array(
			'no-link'         => esc_html__( 'No link', 'modula-best-grid-gallery' ),
			'direct'          => esc_html__( 'Direct link to image', 'modula-best-grid-gallery' ),
			'attachment-page' => esc_html__( 'Attachment page', 'modula-best-grid-gallery' ),
			'fancybox'        => esc_html__( 'Lightbox', 'modula-best-grid-gallery' )
		) );

		// Grid type selection
		$html .= '<fieldset class="inline-edit-col-left clear">';
		$html .= '<div class="inline-edit-group wp-clearfix">';
		$html .= '<label class="alignleft" for="post_featured_no">';
		$html .= '<span class="title">' . esc_html__( 'Gallery type', 'modula-best-grid-gallery' ) . '</span>';
		$html .= '<select name="modula-settings[\'type\']">';

		foreach ( $grid_type_options as $key => $value ) {
			$html .= '<option value="' . esc_attr( $key ) . '">' . esc_html( $value ) . '</option>';
		}

		$html .= '</select>';
		$html .= '</label>';
		$html .= '</div>';
		$html .= '</fieldset>';

		// Lightbox selection
		$html .= '<fieldset class="inline-edit-col-left clear">';
		$html .= '<div class="inline-edit-group wp-clearfix">';
		$html .= '<label class="alignleft" for="post_featured_no">';
		$html .= '<span class="title">' . esc_html__( 'Gallery type', 'modula-best-grid-gallery' ) . '</span>';
		$html .= '<select name="modula-settings[\'lightbox\']">';

		foreach ( $lightbox_options as $key => $value ) {
			$html .= '<option value="' . esc_attr( $key ) . '">' . esc_html( $value ) . '</option>';
		}

		$html .= '</select>';
		$html .= '</label>';
		$html .= '</div>';
		$html .= '</fieldset>';

		// lazy loading
		$html .= '<fieldset class="inline-edit-col-left clear">';
		$html .= '<div class="inline-edit-group wp-clearfix">';
		$html .= '<label class="alignleft" for="modula_lazy_load"><span class="title">' . esc_html__( 'Lazy load', 'modula-best-grid-gallery' ) . '</span>';
		$html .= '<input type="radio" name="modula-settings[\'lazy_load\']" id="modula_lazy_load" value=""/>';
		$html .= '</label>';
		$html .= '</div>';
		$html .= '</fieldset>';

		$addons_html = apply_filters( 'modula_quick_edit', '', $column, $post_type );

		echo $html . $addons_html;

	}

	/**
	 * Return instance
	 *
	 * @return Modula_Quick_Edit_Actions|object
	 * @since 2.4.2
	 */
	public static function getInstance() {

		if ( !isset( self::$instance ) && !( self::$instance instanceof Modula_Quick_Edit_Actions ) ) {
			self::$instance = new Modula_Quick_Edit_Actions();
		}

		return self::$instance;
	}
}

$modula_quick_edit = Modula_Quick_Edit_Actions::getInstance();
