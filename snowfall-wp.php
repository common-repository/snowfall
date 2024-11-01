<?php

/*
 * Plugin Name: Snowfall
 * Description: Simple plugin to add snowfall effect on your site.
 * Version: 1.0
 * Author: Artyom Ilyin
 * Author URI: https://github.com/KupnoH/
 * Plugin URI: https://github.com/KupnoH/snowfall-wp
 */

/**
 * Defines if snow effect should be shown into admin area.
 */
define('SNOWFALL_SHOW_ADMIN', false);

/**
 * Enqueue styles and scripts.
 */
function snowfall_enqueue_scripts_and_styles() {
    wp_enqueue_style(
        'snowfall',
        plugins_url('snowfall.min.css', __FILE__)
    );

    if (!is_admin() || (is_admin() && SNOWFALL_SHOW_ADMIN)) {
        wp_enqueue_script(
            'snowfall',
            plugins_url('snowfall.min.js', __FILE__),
            [],
            '1.0',
            true
        );
    }
}
add_action('wp', 'snowfall_enqueue_scripts_and_styles');

/**
 * Performs snowfall_main_tag_action action.
 *
 * If there is a snowfall_main_tag_action we should add
 * our div and necessary script.
 * If there is no such action this would be ignored.
 */
function snowfall_main_tag() {
    ?>
    <div id="snow-wrapper"></div>
    <?php
    wp_add_inline_script('snowfall', 'new Snowfall("snow-wrapper");');
}
add_action('snowfall_main_tag_action', 'snowfall_main_tag');