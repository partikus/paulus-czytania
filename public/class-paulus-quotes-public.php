<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @package    Paulus_Quotes
 * @subpackage Paulus_Quotes/public
 * @author     Michał Kruczek <michal@clearcode.eu>
 */
class Paulus_Quotes_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param      string $plugin_name The name of the plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version     = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url(__FILE__).'css/paulus-quotes-public.css',
            array(),
            $this->version,
            'all'
        );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url(__FILE__).'js/paulus-quotes-public.js',
            array('jquery'),
            $this->version,
            false
        );
    }

    public function register_widgets()
    {
        require __DIR__.'/class-paulus-quotes-widget.php';
        require __DIR__.'/class-paulus-quotes-widget-holiday.php';
        register_widget('Paulus_Quotes_Widget');
        register_widget('Paulus_Quotes_Widget_Holiday');
    }
}
