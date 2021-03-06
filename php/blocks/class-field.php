<?php
/**
 * Block Field.
 *
 * @package   Advanced_Custom_Blocks
 * @copyright Copyright(c) 2018, Advanced Custom Blocks
 * @license http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 */

namespace Advanced_Custom_Blocks\Blocks;

/**
 * Class Field
 */
class Field {

	/**
	 * Field name (slug).
	 *
	 * @var string
	 */
	public $name = '';

	/**
	 * Field label.
	 *
	 * @var string
	 */
	public $label = '';

	/**
	 * Field control type.
	 *
	 * @var string
	 */
	public $control = 'text';

	/**
	 * Field location.
	 *
	 * @var string
	 */
	public $location = 'editor';

	/**
	 * Field order.
	 *
	 * @var int
	 */
	public $order = 0;

	/**
	 * Field settings.
	 *
	 * @var array
	 */
	public $settings = array();

	/**
	 * Field constructor.
	 *
	 * @param array $args An associative array with keys corresponding to the Field's properties.
	 */
	public function __construct( $args = array() ) {
		if ( isset( $args['name'] ) ) {
			$this->name = $args['name'];
		}
		if ( isset( $args['label'] ) ) {
			$this->label = $args['label'];
		}
		if ( isset( $args['control'] ) ) {
			$this->control = $args['control'];
		}
		if ( isset( $args['location'] ) ) {
			$this->location = $args['location'];
		}
		if ( isset( $args['order'] ) ) {
			$this->order = $args['order'];
		}
		if ( isset( $args['settings'] ) ) {
			$this->settings = $args['settings'];
		}
	}
}
