<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Paulus_Quotes
 * @subpackage Paulus_Quotes/admin
 * @author     Michał Kruczek <michal@clearcode.eu>
 */
class Paulus_Quotes_Options
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
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version     = $version;
    }

    public function setup_plugin_options_menu()
    {
        add_plugins_page(
            __('Edycja.pl Cytaty'),
            __('Edycja.pl Cytaty'),
            'manage_options',
            'paulus_quotes_options',
            array(
                $this,
                'render_settings_page_content',
            )
        );
    }

    public function initialize_options()
    {
        $options = get_option('paulus_quotes_options');
        if (false === $options) {
            $default_array = $this->default_quotes_options();
            add_option('paulus_quotes_options', $default_array);
        }

        add_settings_section(
            'general_settings_section',
            __('Options'),
            array($this, 'input_options_callback'),
            'paulus_quotes_options'
        );

        add_settings_field(
            'api_url',
            'Api Url',
            array($this, 'api_url'),
            'paulus_quotes_options',
            'general_settings_section'
        );

        register_setting(
            'paulus_quotes_options',
            'paulus_quotes_options'
        );

    }

    public function render_settings_page_content()
    {

        require __DIR__.'/partials/paulus-quotes-admin-display.php';
    }

    public function api_url()
    {
        $options = get_option('paulus_quotes_options');
        $url     = '';
        if (isset($options['api_url'])) {
            $url = esc_url($options['api_url']);
        }

        // Render the output
        echo '<input type="text" id="api_url" name="paulus_quotes_options[api_url]" value="'.$url.'" class="regular-text"/>';

    }

    public function input_options_callback()
    {
        return get_option('paulus_quotes_options');
    }

    public function default_quotes_options()
    {
        return array('api_url' => 'http://www.edycja.pl/ext/dzien_json.php');
    }
}
