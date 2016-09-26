<?php

/**
 * @since      1.0.0
 * @package    Paulus_Quotes
 * @subpackage Paulus_Quotes/includes
 * @author     Michał Kruczek <michal@clearcode.eu>
 */
class Paulus_Quotes_Activator
{
    /**
     * @since    1.0.0
     */
    public static function activate()
    {
        global $wpdb;
        $sql = $wpdb->prepare(
            'CREATE TABLE IF NOT EXISTS `wp_paulus_quotes` ( `id` INT NOT NULL AUTO_INCREMENT , `publishedAt` DATE NOT NULL , `json` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;'
            ,
            []
        );
        $wpdb->query($sql);
    }
}
