<?php

/**
 * Plugin Name: WordCamp Asia Event Submissions
 * Description: Accept community event submissions from a frontend form.
 * Version:     1.0.0
 * Author:      WordCamp Asia 2026 Workshop
 * License:     MIT
 * Text Domain: wcasia-events
 *
 * @package WCasia_Event_Submissions
 */

defined('ABSPATH') || exit;

define('WCASIA_EVENTS_VERSION', '1.0.0');
define('WCASIA_EVENTS_PATH', plugin_dir_path(__FILE__));

require_once WCASIA_EVENTS_PATH . 'includes/class-submission-handler.php';

/**
 * Register the wcasia_event custom post type.
 */
function wcasia_register_event_post_type()
{
	$labels = array(
		'name'               => 'Events',
		'singular_name'      => 'Event',
		'add_new_item'       => 'Add New Event',
		'edit_item'          => 'Edit Event',
		'view_item'          => 'View Event',
		'all_items'          => 'All Events',
		'search_items'       => 'Search Events',
		'not_found'          => 'No events found.',
		'not_found_in_trash' => 'No events found in Trash.',
	);

	$args = array(
		'labels'       => $labels,
		'public'       => true,
		'has_archive'  => true,
		'menu_icon'    => 'dashicons-calendar-alt',
		'supports'     => array('title', 'editor'),
		'rewrite'      => array('slug' => 'events'),
		'show_in_rest' => true,
	);

	register_post_type('wcasia_event', $args);
}
add_action('init', 'wcasia_register_event_post_type');

/**
 * Register the [event_submission_form] shortcode.
 */
function wcasia_register_shortcode()
{
	add_shortcode('event_submission_form', 'wcasia_render_submission_form');
}
add_action('init', 'wcasia_register_shortcode');

/**
 * Render the frontend submission form via shortcode.
 *
 * @return string Form HTML.
 */
function wcasia_render_submission_form()
{
	ob_start();
	include WCASIA_EVENTS_PATH . 'templates/submission-form.php';
	return ob_get_clean();
}
