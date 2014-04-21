<?php
/**
 * Plugin Name: WP Foo Plugin
 * Plugin URI: 
 * Description: A Dummy Wordpress Plugin for testing
 * Version: 0.2
 * Author: Link7
 * Author URI: https://github.com/Link7
 * License: GPL3
 * License URI: http://www.gnu.org/licenses/gpl.html
 * Credits:
 * Hello Dolly Plugin
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 */

require 'plugin-updates/plugin-update-checker.php';
$MyUpdateChecker = PucFactory::buildUpdateChecker(
    'https://raw.githubusercontent.com/ramalveyra/wp-foo-plugin/master/metadata.json',
    __FILE__,
    'wp-foo-plugin'
);

class L7_WP_Foo 
{
	public function __construct() {	
		add_action('admin_init', array($this, 'admin_init'));
	}

	public function admin_init() {
		add_action( 'admin_head', array($this,'wp_foo_plugin_css'));
		add_action( 'admin_notices', array($this,'show_something' ));

	}

	public function show_something(){
		$plugin_details = get_plugin_data(__FILE__);
		$show = 'WP Foo Plugin Current Version is '. $plugin_details['Version'] . ' auto update is awesome!';
		echo "<p id='wp-foo-plugin-msg'>$show</p>";
	}

	public function wp_foo_plugin_css(){
		// This makes sure that the positioning is also good for right-to-left languages
		$x = is_rtl() ? 'left' : 'right';

		echo "
		<style type='text/css'>
		#wp-foo-plugin-msg {
			float: $x;
			padding-$x: 15px;
			padding-top: 5px;		
			margin: 0;
			font-size: 11px;
		}
		</style>
		";
	}
}

new L7_WP_Foo;
