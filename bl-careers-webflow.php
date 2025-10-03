<?php
/**
 * Plugin Name:       Boundless Careers Webflow Component
 * Plugin URI:        https://www.boundless.com
 * Description:       Careers component for Webflow integration - Greenhouse API integration without WordPress dependencies.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.3
 * Author:            Traffic Team
 * Author URI:        https://www.boundless.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       bl-careers-webflow
 * Domain Path:       /languages
 *
 * @package BLCareersWebflow
 */

namespace Boundless\BLCareersWebflow;

// Support for site-level autoloading.
if ( file_exists( __DIR__ . '/lib/autoload.php' ) ) {
	require_once __DIR__ . '/lib/autoload.php';
}

define( 'BL_CAREERS_WEBFLOW_VERSION', '1.0.0' );
define( 'BL_CAREERS_WEBFLOW_FILE', __FILE__ );

/**
 * Class BLCareersWebflow.
 */
class BLCareersWebflow {

	/**
	 * Holds the class instance.
	 *
	 * @var BLCareersWebflow $instance
	 */
	private static $instance = null;

	/**
	 * Return an instance of the class
	 *
	 * @since 1.0.0
	 *
	 * @return BLCareersWebflow class instance.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_footer', array( $this, 'render_component' ) );
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			'bl-careers-webflow',
			plugin_dir_url( __FILE__ ) . 'dist/bl-careers-webflow.js',
			array(),
			BL_CAREERS_WEBFLOW_VERSION,
			true
		);

		wp_enqueue_style(
			'bl-careers-webflow',
			plugin_dir_url( __FILE__ ) . 'dist/bl-careers-webflow.css',
			array(),
			BL_CAREERS_WEBFLOW_VERSION
		);

		// Localize script with API endpoints.
		wp_localize_script(
			'bl-careers-webflow',
			'blCareersWebflow',
			array(
				'apiEndpoints' => array(
					'departments' => 'https://boards-api.greenhouse.io/v1/boards/boundlessimmigration/departments',
				),
				'version' => BL_CAREERS_WEBFLOW_VERSION,
			)
		);
	}

	/**
	 * Render the components in footer.
	 */
	public function render_component() {
		echo '<div id="bl-careers-webflow-root"></div>';
		echo '<div id="bl-careers-webflow-featured"></div>';
		echo '<div id="bl-careers-webflow-apply"></div>';
	}
}

add_action(
	'plugins_loaded',
	function () {
		$bl_careers_webflow = BLCareersWebflow::get_instance();
	}
);
