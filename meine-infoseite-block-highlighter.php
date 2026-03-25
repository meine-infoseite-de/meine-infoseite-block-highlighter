<?php

/*
 * Plugin Name: Meine Infoseite: Block Highlighter
 * Plugin URI: https://wordpress.org/plugins/meine-infoseite-block-highlighter/
 * Description: Helper plugin for highlighting blocks within the block editor.
 * Version: 2.0.0
 * Requires at least: 6.9
 * Requires PHP: 8.0
 * Author: Adrian Mörchen / Meine Infoseite
 * Author URI: https://www.meine-infoseite.de/
 * Text Domain: meine-infoseite-block-highlighter
 * License: GPLv3
 */

if (!defined('ABSPATH')) exit;

add_action('enqueue_block_editor_assets', 'meine_infoseite_highlighter_enqueue_block_editor_assets');
add_action('admin_enqueue_scripts', 'meine_infoseite_highlighter_update_block_style_dependencies', 20);

function meine_infoseite_highlighter_enqueue_block_editor_assets(): void
{
    wp_enqueue_style('meine-infoseite-block-highlighter', plugins_url('/meine-infoseite-block-highlighter.css', __FILE__), [], '2.0.0');
}

/** Needed for WooCommerce: add the script as dependency for WooCommerce  */
function meine_infoseite_highlighter_update_block_style_dependencies(): void
{
    $wp_styles = wp_styles();
    $style = $wp_styles->query('wc-blocks-style');

    if (!$style) {
        return;
    }

    $style->deps[] = 'meine-infoseite-block-highlighter';
}
