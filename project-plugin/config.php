<?php

return [

     // Key / value pairs of shortcode tags and shortcode callback functions.
    'shortcodes' => [

        // [hello-world] will call the helloWorld() method in the plugin class.
        'hello-world' => 'helloWorld',

        // Add here as many shortcode as you want.

        // You can also create aliases simply pointing
        // different shortcodes to the same callback.
        'helloworld' => 'helloWorld',

    ],

];
