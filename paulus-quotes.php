<?php

/**
 * @link              http://clearcode.eu
 * @since             1.0.0
 * @package           Paulus_Quotes
 *
 * @wordpress-plugin
 * Plugin Name:       Paulus Edycja.pl - czytania
 * Plugin URI:        paulus-czytania
 * Description:       Ta wtyczka pozwala na dodanie widgetu, który wyświetla cytat, czytania na dany dzień oraz sigla biblijne.
 * Version:           1.0.0
 * Author:            Michał Kruczek
 * Author URI:        http://clearcode.eu
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       paulus-quotes
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-paulus-quotes-activator.php
 */
function activate_paulus_quotes() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-paulus-quotes-activator.php';
	Paulus_Quotes_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-paulus-quotes-deactivator.php
 */
function deactivate_paulus_quotes() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-paulus-quotes-deactivator.php';
	Paulus_Quotes_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_paulus_quotes' );
register_deactivation_hook( __FILE__, 'deactivate_paulus_quotes' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-paulus-quotes.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_paulus_quotes() {

	$plugin = new Paulus_Quotes();
    $plugin->run();

}
run_paulus_quotes();
