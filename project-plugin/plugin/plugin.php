<?php

// TODO: Rename the namespace
namespace AcmeInc\WordPress;

use FilippoToso\WordPress\BaseProjectPlugin;

// TODO: Rename the class
class MyPlugin extends BaseProjectPlugin {

    /**
     * Example implementation of the [hello-world] shortcode
     * @method helloWorld
     * @param  array   $attributes  The parameters of the shortcode
     * @param  string  $content     The content of the shortcode
     * @return string
     */
    public function helloWorld($attributes, $content = '') {

        // Default keys and values expected as input attributes
        $defaults = [
            'name' => null,
        ];

        // Normalized attributes
        $attributes = $this->normalize($attributes, $defaults);

        // Build the payload array for the render function
        // Each key will be available as a variable within the shortcode view
        $payload = [
            'attributes' => $attributes,
            'content' => $content,
        ];

        // The shortcodes are re-parsed using do_shortcode() to enable nesting
        return do_shortcode($this->render('hello-world', $payload));

    }

}
