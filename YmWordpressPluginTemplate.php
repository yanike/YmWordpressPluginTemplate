<?php
/**
 *
 * @package plugin-template
 * @author Yanike Mann
 * @copyright Yanike Mann
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin Template
 * Description:       Plugin Template for WordPress
 * Version:           1.0.0
 * Requires at least: 5.2.0
 * Requires PHP:      7.3
 * Author:            Yanike Mann
 * Text Domain:       plugin-template
 */
if (! defined('ABSPATH')) {
	die();
}

if (! defined('PLUGIN_DIR')) {
	define('PLUGIN_DIR', '/wp-content/plugins/YmWordpressPluginTemplate/'));
}

if (! defined('PLUGINTEMPLATE_DIR')) {
	define('PLUGINTEMPLATE_DIR', plugin_dir_path(__FILE__));
}

require_once PLUGINTEMPLATE_DIR . 'includes/Core.php';

class YmWordpressPluginTemplate
{

	public function __construct()
	{
		add_action('init', array(
			$this,
			'action_init'
		));
	}

	/**
	 * Activation of WordPress Plugin
	 */
	function activate()
	{
		// generated a Custom Post Type (CPT)
		$this->action_init();
		// flush rewrite rules
		flush_rewrite_rules(true);
	}

	/**
	 * Deactivation of WordPress Plugin
	 */
	function deactivate()
	{
		// flush rewrite rules
		flush_rewrite_rules(true);
	}

	/**
	 * Register custom post type
	 */
	public function action_init()
	{
		register_post_type('test_section', [
			'label' => __('Test Section', 'txtdomain'),
			'public' => true,
			'show_in_menu' => true,
			'menu_position' => 25,
			'menu_icon' => 'dashicons-book',
			'supports' => [
				'title',
				'thumbnail',
				'author',
				'revisions'
			],
			'show_in_rest' => true,
			'taxonomies' => [
				'test_section_item'
			],
			'labels' => [
				'singular_name' => __('Test Section', 'txtdomain'),
				'add_new_item' => __('Add new Test Section', 'txtdomain'),
				'new_item' => __('New Test Section', 'txtdomain'),
				'view_item' => __('View Test Section', 'txtdomain'),
				'not_found' => __('No Test Sections found', 'txtdomain'),
				'not_found_in_trash' => __('No Test Sections found in trash', 'txtdomain'),
				'all_items' => __('All Test Sections', 'txtdomain'),
				'insert_into_item' => __('Insert into test_section', 'txtdomain')
			]
		]);

		register_taxonomy('test_section_item', [
			'test_section'
		], [
			'label' => __('Item', 'txtdomain'),
			'hierarchical' => true,
			'show_admin_column' => true,
			'show_in_rest' => true,
			'labels' => [
				'singular_name' => __('Item', 'txtdomain'),
				'all_items' => __('All Item', 'txtdomain'),
				'edit_item' => __('Edit Item', 'txtdomain'),
				'view_item' => __('View Item', 'txtdomain'),
				'update_item' => __('Update Item', 'txtdomain'),
				'add_new_item' => __('Add New Item', 'txtdomain'),
				'new_item_name' => __('New Item Name', 'txtdomain'),
				'search_items' => __('Search Items', 'txtdomain'),
				'not_found' => __('No Items found', 'txtdomain')
			]
		]);
		register_taxonomy_for_object_type('test_section_item', 'test_section');
	}
}

// If class exists, create a new instance of the class
if (class_exists('YmWordpressPluginTemplate')) {
	$ymWordpressPluginTemplate = new YmWordpressPluginTemplate();
}

// activation
register_activation_hook(__FILE__, 'active');

// activation
register_deactivation_hook(__FILE__, 'deactivate');

/**
 * Uninstallation of WordPress Plugin
 */
function plugintemplate_uninstallation()
{
	// Access the database via SQL
	global $wpdb;
	// Delete all posts of articles
	//$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'test_section'");
	// Delete all post_id data not found in wp_posts id
	// $wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT ID FROM wp_posts)");
	// Delete all object_id data not found in wp_posts id
	// $wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN(SELECT ID FROM wp_posts)");
}

// uninstall
register_uninstall_hook(__FILE__, 'plugintemplate_uninstallation');

function add_plugintemplate_stylesheet()
{
	wp_register_style('plugintemplate_style', PLUGIN_DIR . 'assets/styles/style.css');
	wp_enqueue_style('plugintemplate_style');
}

function add_plugintemplate_scripts()
{
	if (! is_admin()) {
		wp_register_script('plugintemplate_script', PLUGIN_DIR . 'assets/scripts/script.js');
		wp_enqueue_script('plugintemplate_script');
	}
}

function testSec($atts)
{
	$core = new \Core;
	$core->testSection($atts, PLUGINTEMPLATE_DIR);
}

function add_plugintemplate_shortcodes()
{
	add_shortcode("plugintemplate_testsection", "testSec");
}

add_action('wp_print_styles', 'add_plugintemplate_stylesheet');
add_action('wp_print_scripts', 'add_plugintemplate_scripts');
add_action('init', 'add_plugintemplate_shortcodes');

// Add AJAX Calls to WP
$core = new Core;
$core->ajaxCalls();
