<?php
/**
 * Preview retrieves sanitized HTML to send to the Gutenberg preview.
 *
 * @package Advanced_Custom_Blocks
 */

namespace Advanced_Custom_Blocks\Endpoints;

use Advanced_Custom_Blocks\Blocks\Loader;
use Advanced_Custom_Blocks\Component_Abstract;

/**
 * Class Preview
 */
class Preview extends Component_Abstract {

	const BASE = 'acb/v1';

	/**
	 * Array of available blocks.
	 *
	 * @var array
	 */
	public $blocks = [];

	/**
	 * Used to load blocks.
	 *
	 * @var Loader
	 */
	public $block_loader;

	/**
	 * Init the block loader to get blocks.
	 *
	 * @return $this
	 */
	public function init() {
		$this->block_loader = new Loader();
		$this->block_loader->set_plugin( $this->plugin );
		$this->block_loader->init();
		$this->blocks = json_decode( $this->block_loader->blocks, true );

		return $this;
	}

	/**
	 * Populate fields with dummy data.
	 *
	 * @param array $block An array containing block data.
	 *
	 * @return mixed
	 */
	public function mock_attributes( $block ) {
		$attributes = [];

		foreach ( $block['fields'] as $field_name => $field ) {

			switch ( $field['control'] ) {
				case 'text':
					$value = '[' . wp_json_encode( $field['name'] ) . ']';
					break;
				case 'textarea':
					$value = '[' . wp_json_encode( $field['name'] ) . ']';
					break;
				default:
					$value = '[' . wp_json_encode( $field['name'] ) . ']';
					break;
			}

			$attributes[ $field_name ] = $value;
		}

		return $attributes;
	}

	/**
	 * Register all the hooks.
	 */
	public function register_hooks() {
		add_action( 'rest_api_init', array( $this, 'rest_api_init' ) );
	}

	/**
	 * Register endpoint.
	 */
	public function rest_api_init() {
		register_rest_route(
			static::BASE, 'block-preview', array(
				'methods'             => 'GET',
				'callback'            => [ $this, 'handle_preview_request' ],
				'args'                => [],
				'permission_callback' => '__return_true',
			)
		);
	}

	/**
	 * Return a block preview.
	 *
	 * @param \WP_REST_Request $r REST request object.
	 *
	 * @return mixed|\WP_REST_Response
	 */
	public function handle_preview_request( \WP_REST_Request $r ) {
		$content = '';

		$slug = $r->get_param( 'slug' );
		if ( ! empty( $slug ) && array_key_exists( 'advanced-custom-blocks/' . $slug, $this->blocks ) ) {
			$block   = $this->blocks[ 'advanced-custom-blocks/' . $slug ];
			$content = $this->block_loader->render_block_template( $block, $this->mock_attributes( $block ), [ 'preview', 'block' ] );
		}

		return rest_ensure_response( $content );
	}

}
