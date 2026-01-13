<?php
	/**
	* Plugin Name: HELLO WORLD
	* Plugin URI: https://rahul.com
	* Description: I am testing a Plugin Development
	* Version: 1.0.0
	* Author: Rahul Kumar
	*/

	function hello_world_admin_menu_testing() {
		add_menu_page( 'Hello Plugin Page', 'Hello Plugin', 'manage_options', 'hello-plugin', 'hello_plugin_page', 'dasshicons-smiley', 25 ); 
	}

	function hello_plugin_page() {
		echo '<p>Hello Plugin Admin Page</p>';

		?>
    			<div class="wrap">
      				<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
      				<form action="options.php" method="post">
        				<?php
        					// output security fields for the registered setting "wporg_options"
        					settings_fields( 'wporg_options' );
        					// output setting sections and their fields
        					// (sections are registered for "wporg", each field is registered to a specific section)
        					do_settings_sections( 'wporg' );
        					// output save settings button
        					submit_button( __( 'Save Settings', 'textdomain' ) );
        				?>
      				</form>
    			</div>
    		<?php
	} 

	add_action ( 'admin_menu', 'hello_world_admin_menu_testing' );  
