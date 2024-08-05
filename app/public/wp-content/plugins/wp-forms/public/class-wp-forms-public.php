<?php
/**
 * Public site functionality of plugin
 */

class Wp_Forms_Public{
    public function __construct(){
        //constructor code
    }


    public function enqueue_styles(){
        wp_enqueue_style('wp-forms-public', plugin_dir_url(__FILE__) . 'public/css/public.css', array(), $this->version, 'all');
    }


    public function enqueue_scripts(){
        wp_enqueue_script('wp-forms-public', plugin_dir_url(__FILE__) . 'public/js/public.js', array('jquery'), $this->version, false);
    }
}