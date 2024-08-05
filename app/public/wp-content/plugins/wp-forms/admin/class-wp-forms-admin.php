<?php
/**
 * Admin specific functionality of plugin
 */

class Wp_Forms_Admin{
    public function __construct(){
        //constructor code
    }

    public function enqueue_styles(){
        wp_enqueue_style('wp-forms-admin', plugin_dir_url(__FILE__) . 'css/wp-forms-admin.css', array(), $this->version, 'all');
    }

    public function enqueue_scripts(){
        wp_enqueue_script('wp-forms-admin', plugin_dir_url(__FILE__) . 'js/wp-forms-admin.js', array('jquery'), $this->version, false);
    }
}