<?php
/**
 * Component abstract.
 *
 * @package   Advanced_Custom_Blocks
 * @copyright Copyright(c) 2018, Advanced Custom Blocks
 * @license http://opensource.org/licenses/GPL-2.0 GNU General Public License, version 2 (GPL-2.0)
 */

namespace Advanced_Custom_Blocks;

/**
 * Class ComponentAbstract
 */
abstract class Component_Abstract implements Component_Interface {

	/**
	 * Point to the $plugin instance.
	 *
	 * @var Plugin_Interface
	 */
	protected $plugin;

	/**
	 * Set the plugin so that it can be referenced later.
	 *
	 * @param Plugin_Interface $plugin The plugin.
	 *
	 * @return Component_Interface $this
	 */
	public function set_plugin( Plugin_Interface $plugin ) {
		$this->plugin = $plugin;
		return $this;
	}

	/**
	 * Register any hooks that this component needs.
	 *
	 * @return void
	 */
	abstract public function register_hooks();
}
