<?php
/**
 * Plugin Name:       Careers Webflow Component
 * Plugin URI:        https://github.com/s92mike/wp-careers-wf
 * Description:       Careers component for Webflow integration - Greenhouse API integration without WordPress dependencies.
 * Version:           1.0.0
 * Requires at least: 6.0
 * Requires PHP:      7.3
 * Author:            Traffic Team
 * Author URI:        https://github.com/s92mike
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       fm-careers-webflow
 * Domain Path:       /languages
 *
 * @package FMCareersWebflow
 */

namespace Dream\FMCareersWebflow;

// Support for site-level autoloading.
if (file_exists(__DIR__ . '/lib/autoload.php') ) {
    include_once __DIR__ . '/lib/autoload.php';
}

define('FM_CAREERS_WEBFLOW_VERSION', '1.0.0');
define('FM_CAREERS_WEBFLOW_FILE', __FILE__);

/**
 * Class FMCareersWebflow.
 */
class FMCareersWebflow
{

    /**
     * Holds the class instance.
     *
     * @var FMCareersWebflow $instance
     */
    private static $instance = null;

    /**
     * Return an instance of the class
     *
     * @since 1.0.0
     *
     * @return FMCareersWebflow class instance.
     */
    public static function get_instance()
    {
        if (null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor.
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts' ));
        add_action('wp_footer', array( $this, 'render_component' ));
    }

    /**
     * Enqueue scripts and styles.
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script(
            'fm-careers-webflow',
            plugin_dir_url(__FILE__) . 'dist/fm-careers-webflow.js',
            array(),
            FM_CAREERS_WEBFLOW_VERSION,
            true
        );

        wp_enqueue_style(
            'fm-careers-webflow',
            plugin_dir_url(__FILE__) . 'dist/fm-careers-webflow.css',
            array(),
            FM_CAREERS_WEBFLOW_VERSION
        );

        // Localize script with API endpoints.
        wp_localize_script(
            'fm-careers-webflow',
            'fmCareersWebflow',
            array(
            'apiEndpoints' => array(
            'departments' => 'https://boards-api.greenhouse.io/v1/boards/boundlessimmigration/departments',
            ),
            'version' => FM_CAREERS_WEBFLOW_VERSION,
            )
        );
    }

    /**
     * Render the components in footer.
     */
    public function render_component()
    {
        echo '<div id="fm-careers-webflow-root"></div>';
        echo '<div id="fm-careers-webflow-featured"></div>';
        echo '<div id="fm-careers-webflow-apply"></div>';
    }
}

add_action(
    'plugins_loaded',
    function () {
        $fm_careers_webflow = FMCareersWebflow::get_instance();
    }
);
