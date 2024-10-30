<?php
if(!class_exists('WW_Menu_Settings'))
{
	class WW_Menu_Settings
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// register actions
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		} // END public function __construct
		
        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
        	// register your plugin's settings
        	register_setting('ww_menu-group', 'ww_menu_business_url');
			register_setting('ww_menu-group','ww_menu_show_link');

        	// add your settings section
        	add_settings_section(
        	    'ww_menu-section', 
        	    'Wheres Weed Menu Settings', 
        	    array(&$this, 'settings_section_ww_menu'), 
        	    'ww_menu'
        	);
        	
        	// add your setting's fields
            add_settings_field(
                'ww_menu-business_url', 
                'Business Url', 
                array(&$this, 'settings_field_input_text'), 
                'ww_menu', 
                'ww_menu-section',
                array(
                    'field' => 'ww_menu_business_url'
                )
            );
			
			// add your setting's fields
            add_settings_field(
                'ww_menu-load_show_link', 
                'Show WheresWeed Link', 
                array(&$this, 'settings_field_input_checkbox'), 
                'ww_menu', 
                'ww_menu-section',
                array(
                    'field' => 'ww_menu_show_link'
                )
            );
			
            // Possibly do additional admin_init tasks
        } // END public static function activate
        
        public function settings_section_ww_menu()
        {
            // Think of this as help text for the section.
            echo 'Enter your Where\'s Weed profile URL to integrate your product menu on your Wordpress site';
        }
        
        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
        } // END public function settings_field_input_text($args)
		
		
		public function settings_field_input_checkbox($args)
        {
            // Get the field name from the $args array
            $field = $args['field'];
            // Get the value of this setting
            $value = get_option($field);
            // echo a proper input type="text"
            echo sprintf('<input name="%s" id="%s" type="checkbox" value="checked" class="code" %s />', $field, $field, checked( 'checked', $value, false ));
        } // END public function settings_field_input_text($args)
		
        /**
         * add a menu
         */		
        public function add_menu()
        {
            // Add a page to manage this plugin's settings
        	add_options_page(
        	    'Wheres Weed Menu Settings', 
        	    'Wheres Weed Menu', 
        	    'manage_options', 
        	    'ww_menu', 
        	    array(&$this, 'plugin_settings_page')
        	);
        } // END public function add_menu()
    
        /**
         * Menu Callback
         */		
        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
	
        	// Render the settings template
        	include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        } // END public function plugin_settings_page()
    } // END class WW_Menu_Settings
} // END if(!class_exists('WW_Menu_Settings'))
