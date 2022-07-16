<?php
namespace ElementorExtras\Modules\DisplayConditions\Conditions;

// Extras for Elementor Classes
use ElementorExtras\Utils;
use ElementorExtras\Base\Condition;

// Elementor Classes
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * \Modules\DisplayConditions\Conditions\Taxonomy_Archive
 *
 * @since  2.2.0
 */
class Taxonomy_Archive extends Condition {

	/**
	 * Get Group
	 * 
	 * Get the group of the condition
	 *
	 * @since  2.2.0
	 * @return string
	 */
	public function get_group() {
		return 'archive';
	}

	/**
	 * Get Name
	 * 
	 * Get the name of the module
	 *
	 * @since  2.2.0
	 * @return string
	 */
	public function get_name() {
		return 'taxonomy_archive';
	}

	/**
	 * Get Title
	 * 
	 * Get the title of the module
	 *
	 * @since  2.2.0
	 * @return string
	 */
	public function get_title() {
		return __( 'Taxonomy', 'elementor-extras' );
	}

	/**
	 * Get Value Control
	 * 
	 * Get the settings for the value control
	 *
	 * @since  2.2.0
	 * @return string
	 */
	public function get_value_control() {
		return [
			'type' 			=> Controls_Manager::SELECT2,
			'default' 		=> '',
			'placeholder'	=> __( 'Any', 'elementor-extras' ),
			'description'	=> __( 'Leave blank or select all for any taxonomy archive.', 'elementor-extras' ),
			'multiple'		=> true,
			'label_block' 	=> true,
			'options' 		=> Utils::get_taxonomies_options(),
		];
	}

	/**
	 * Checks a given taxonomy against the current page template
	 *
	 * @since 2.2.0
	 *
	 * @access protected
	 *
	 * @param string  $taxonomy  The taxonomy to check against
	 */
	protected function check_taxonomy_archive_type( $taxonomy ) {
		if ( 'category' === $taxonomy ) {
			return is_category();
		} else if ( 'post_tag' === $taxonomy ) {
			return is_tag();
		} else if ( '' === $taxonomy || empty( $taxonomy ) ) {
			return is_tax() || is_category() || is_tag();
		} else {
			return is_tax( $taxonomy );
		}

		return false;
	}

	/**
	 * Check condition
	 *
	 * @since 2.2.0
	 *
	 * @access public
	 *
	 * @param string  	$name  		The control name to check
	 * @param string 	$operator  	Comparison operator
	 * @param mixed  	$value  	The control value to check
	 */
	public function check( $name = null, $operator, $value ) {
		$show = false;

		if ( is_array( $value ) && ! empty( $value ) ) {
			foreach ( $value as $_key => $_value ) {
				$show = $this->check_taxonomy_archive_type( $_value );
				if ( $show ) break;
			}
		} else { $show = $this->check_taxonomy_archive_type( $value ); }

		return $this->compare( $show, true, $operator );
	}
}
