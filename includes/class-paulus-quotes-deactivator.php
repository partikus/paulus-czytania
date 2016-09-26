<?php

/**
 * @since      1.0.0
 * @package    Paulus_Quotes
 * @subpackage Paulus_Quotes/includes
 * @author     Michał Kruczek <michal@clearcode.eu>
 */
class Paulus_Quotes_Deactivator
{
    public static function deactivate()
    {
        global $wpdb;
        $sql = $wpdb->prepare('DROP TABLE `wp_paulus_quotes`', []);
        $wpdb->query($sql);
    }
}
