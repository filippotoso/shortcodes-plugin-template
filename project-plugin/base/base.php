<?php

namespace FilippoToso\WordPress;

use RuntimeException;

if (class_exists(BaseProjectPlugin::class)) {
    return;
}

class BaseProjectPlugin {

    // The instance of the class (to avoid global variables)
    protected static $instance = NULL;

    // The name of the shortcode view
    protected $shortcodeFile = NULL;

    // Configuration variable
    protected $config = [];

    /**
     * The static method that initialize the plugin
     * @method start
     */
    static public function start() {
        add_action('init', [static::instance(), 'init']);
    }

    /**
     * The static method that returns the current instance of the plugin
     * @method instance
     */
    static public function instance() {
        if (is_null(self::$instance)) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    /**
     * Public constructor
     * @method __construct
     */
    public function __construct() {
        $this->config = include(dirname(__DIR__) . '/config.php');
    }

    /**
     * Here the plugin is initialized.
     * Include in this method all the required registrations
     * for actions, filters and so on.
     * @method load
     * @return void
     */
    public function init() {

        foreach ($this->config['shortcodes'] as $shortcode => $callback) {

            add_shortcode($shortcode , function($atts, $content = '') use ($shortcode, $callback) {

                if (!method_exists($this, $callback)) {
                    throw new RuntimeException(sprintf('Missing %s method in  %s class (%s)!', $callback, __CLASS__, __FILE__));
                }

                return $this->$callback($atts, $content);

            });

        }

	}

    /**
     * Render the specified template
     * @method render
     * @param  String  $shortcode The name of the shortcode to be rendered
     * @param  array   $payload   An associative array of variables to be used in the template
     * @return String            The rendered template
     */
    public function render() {

        // Using func_num_args() and func_get_arg() to avoid
        // injectiong external variables in the shortcode inclusion.

        if (func_num_args() == 0) {
            throw new RuntimeException(sprintf('Missing parameters to %s::%s', __CLASS__, __METHOD__));
        }

        // Using an object property to avoid injectiong external
        // variables in the shortcode inclusion.
        $this->shortcodeFile = sprintf('%s/shortcodes/%s.php', dirname(__DIR__), func_get_arg(0));

        if (!is_readable($this->shortcodeFile)) {
            throw new RuntimeException(sprintf('Missing shortcode view %s', $this->shortcodeFile));
        }

        ob_start();

        if (func_num_args() >= 2) {
            extract(func_get_arg(1));
        }

        include($this->shortcodeFile);

        // Resetting the $shortcodeFile variable,
        // not needed outside of this method
        $this->shortcodeFile = null;

        return ob_get_clean();

    }

    /**
     * Normalize the $atts array using the $default values
     * @method normalize
     * @param  array   $attributes  Input attributes
     * @param  array   $defaults    Defaults attributes values
     * @return array   The result will be always an array with all the
     *                 $default keys and values overwritten by the relative
     *                 $atts values
     */
    protected function normalize($attributes, $defaults = []) {
        $attributes = (is_array($attributes)) ? $attributes : [];
        return array_intersect_key(array_merge($defaults, $attributes), $defaults);
    }


}
