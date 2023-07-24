<?php

if( !class_exists('Enqueue') ) :

class Enqueue {

    public $styles;
    public $scripts;
    public $libcss;
    public $libjs;

    public function __construct()
    {
        // Paths
        $this->styles = get_template_directory_uri() . "/assets/css/";
        $this->scripts = get_template_directory_uri() . "/assets/js/";
        $this->libcss = get_template_directory_uri() . "/assets/css/libs/";
        $this->libjs = get_template_directory_uri() . "/assets/js/libs/";

        add_action('wp_enqueue_scripts', array($this, 'styles'));
        add_action('wp_enqueue_scripts', array($this, 'scripts'));
    }

    public function styles(){
        // Reset e grid
        wp_enqueue_style('style-reboot', $this->libcss . 'bootstrap/bootstrap-reboot.min.css', '', '4.6');
        wp_enqueue_style('style-grid', $this->libcss . 'bootstrap/bootstrap-grid.min.css', '', '4.6');

        // Slick
        wp_enqueue_style('style-slick', $this->libcss . 'slick/slick.css', '', '1.8.1');
        wp_enqueue_style('style-theme', $this->libcss . 'slick/slick-theme.css', '', '1.8.1');

        // Default Files
        wp_enqueue_style('styles', get_template_directory_uri() . '/style.css', '', '1.0');
        wp_enqueue_style('style-all', $this->styles . 'style-all.min.css', '', '1.0');
    }

    public function scripts(){

        // jQuery
        wp_enqueue_script('jquery');

        // Slick
        wp_enqueue_script('script-slick', $this->libjs . 'slick/slick.min.js', '', '1.8.1', true);

        // Default
        wp_enqueue_script('script-common', $this->scripts . 'script-all.min.js', '', '1.0', true);

    } 

}

$Enqueue = new Enqueue();

endif;