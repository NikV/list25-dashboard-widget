<?php
/**
 * Plugin Name: List25 Dashboard Widget
 * Description: Get latest Top 25s from List25.com in a Dashboard Widget
 * Author: Nikhil Vimal
 * Author URI: http://nik.techvoltz.com
 * Version: 1.0
 * Plugin URI:
 * License: GNU GPLv2+
 */

Class List_25_Dashboard_Widget {

	public function __construct() {
		add_action( 'wp_dashboard_setup', array( $this, 'list25_add_dashboard_widgets' ));

	}



	/**
	 * Add a widget to the dashboard.
	 *
	 * This function is hooked into the 'wp_dashboard_setup' action below.
	 */
	public function list25_add_dashboard_widgets() {

		wp_add_dashboard_widget(
			'list25_dashboard_widget',         // Widget slug.
			'List25 Dashboard Widget',         // Title.
			array( $this, 'list25_dashboard_widget_function' ) // Display function.
		);
	}


	public function list25_dashboard_widget_function() {

		$feed = fetch_feed( 'http://list25.com/feed/' );



				if ( ! is_wp_error( $feed ) ) {

					$maxitems = $feed->get_item_quantity( 5 );
					$items    = $feed->get_items( 0, $maxitems );

				}

				foreach ( $items as $item ) {
					echo '<p class="rss-widget"><a href=" ' . $item->get_permalink() . ' ">' . $item->get_title() . '</a></p>';

				}


			}
}
new List_25_Dashboard_Widget();
