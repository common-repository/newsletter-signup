<?php
function newsletter_menu()
{
	add_menu_page ( 'Newsletter', 'Newsletter', 'manage_options', 'newsletter', 'newsletter_plugins' );
	//add_submenu_page( 'edit.php?post_type=floorplans', 'Settings', 'Settings', 'manage_options', 'settings', 'floorplans_settings');
}
add_action ( 'admin_menu', 'newsletter_menu' );


function newsletter_plugins() {
	global $wpdb;

	$list = $wpdb->get_results("SELECT * FROM wp_newsletter;");

	echo "<table>";
	foreach($list as $list){
		echo "<tr>";
		echo "<td>".$list->email."</td>";
		echo "<td>".$list->IP."</td>";
		echo "<td>".$list->date."</td>";

		echo "</tr>";
	}
	echo "</table>";
}