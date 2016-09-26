<?php

/**
 * @since      1.0.0
 * @package    Paulus_Quotes
 * @subpackage Paulus_Quotes/includes
 * @author     Michał Kruczek <michal@clearcode.eu>
 */
class Paulus_Quotes_i18n
{
    /**
     * @since    1.0.0
     */
    public function load_plugin_textdomain()
    {

        load_plugin_textdomain(
            'paulus-quotes',
            false,
            dirname(dirname(plugin_basename(__FILE__))).'/languages/'
        );
    }
}
