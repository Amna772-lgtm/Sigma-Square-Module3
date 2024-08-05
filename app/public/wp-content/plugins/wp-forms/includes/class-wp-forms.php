<?php
/*
 * Plugin Name:       WP Forms
 * Plugin URI:        https://http://module3.local/wp-admin/plugins/wp-forms.php
 * Description:       Custom plugin containing forms of login and registration functionalities 
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Amna
 * Author URI:        https://amna.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       wp-forms
 * Domain Path:       /languages
 */

 class Wp_Forms
 {

    protected $plugin_name;
    protected $version;

    public function __construct(){

        $this->plugin_name = 'wp-forms';
        $this->version = '1.0.0';

        //load dependencies
        $this->load_dependencies();

        //register admin and plugin hooks
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }


    private function load_dependencies(){
        //include all files
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-wp-forms-activator.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-wp-forms-deactivator.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-wp-forms-admin.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-wp-forms-public.php';
    }


    /**
     * Register all hooks related to admin area functionality 
     * of plugin
     */
    private function define_admin_hooks(){
        $plugin_admin = new Wp_Forms_Admin();
        add_action('admin_enqueue_scripts', array( $plugin_admin, 'enqueue_styles' ));
        add_action('admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts' ));
    }

    /**
     * Register all hooks related to public side functionality 
     * of plugin
     */
    private function define_public_hooks(){
        $plugin_public = new Wp_Forms_Public();
        add_action('wp_enqueue_scripts', array($plugin_public, 'enqueue_styles'));
        add_action('wp_enqueue_scripts', array($plugin_public, 'enqueue_scripts'));


        //add shortcodes of login and registration forms
        add_shortcode('wp_forms_registration', array($plugin_public, 'registration_form'));
        add_shortcode('wp_forms_login', array($plugin_public, 'login_form'));


        //handle registration and login functionality
        add_action('init', array($plugin_public, 'registration'));
        add_action('init', array($plugin_public, 'login'));
    }

    public run(){
        //run the plugin
    }
 }