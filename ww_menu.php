<?php

/*
Plugin Name: Where's Weed Menu
Description: WheresWeed.com Business Menu Plugin
Version: 0.1
Author: WheresWeed.com
*/

/*
Copyright 2012  Francis Yaconiello  (email : francis@yaconiello.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*
code based on wordpress plugin template by
Francis Yaconiello  (email : francis@yaconiello.com)
*/

if(!class_exists('WW_Menu'))
{
	class WW_Menu
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// Initialize Settings
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$WW_Menu_Settings = new WW_Menu_Settings();

			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));
		
			require_once(sprintf("%s/shortcode.php",dirname(__FILE__)));
		}
		
		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			// Do nothing
		}
		
		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			// Do nothing
		}
		
		// Add the settings link to the plugins page
		function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=ww_menu">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}


	}
}
if(class_exists('WW_Menu'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('WW_Menu', 'activate'));
	register_deactivation_hook(__FILE__, array('WW_Menu', 'deactivate'));

	// instantiate the plugin class
	$ww_menu = new WW_Menu();

}
