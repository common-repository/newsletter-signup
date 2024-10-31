<?php
/*
  Plugin Name: Newsletter Signup
  Plugin URI: http://www.hemmes.it/wordpress-plugin-development/newsletter-signup
  Description: Simple plugin to add a newsletter sign-up form to your website
  Version: 0.2.1
  Author: Hemmes.IT
  Author URI: http://www.hemmes.it
  License: GPLv2 or later
 */

include('functions.php');


function newsletter_signup()
{
			 if ($_POST['email_newsletter'] != '')
					{?>
					<script type="text/javascript">
					jQuery(document).ready(function ($) {
					    // Handler for .ready() called.
					    jQuery('html, body').animate({
					        scrollTop: jQuery('#newsletter').offset().top
					    }, 'slow');
					});
					</script>
					
					<?php						
					global $wpdb;				
					$wpdb->insert('wp_newsletter',array( 'email' => $_POST['email_newsletter'], 'IP' => $_SERVER['REMOTE_ADDR'], 'USER_AGENT' => $_SERVER['HTTP_USER_AGENT'], 'USER_REFERER' => $_SERVER['HTTP_REFERER']));	
					}	
	}
add_action('wp_footer', 'newsletter_signup');

function newsletter_html()
{?>
	<div id="newsletter">
	<div id="color_heading">Keep you posted?</div>
	<div style="text-transform: uppercase; color: #747474;">Signup for the newsletter and we'll keep you posted</div>
	<div id="banner_form">
				
				<?php if ($_POST['email_newsletter'] != '')
					{
				?>
				<div id="thanks-for-signing-up">Thanks for signing up!</div>
				
				<?php }?>
				<input type="email" id="email_newsletter" name="email_newsletter" style="border: 1px solid; border-bottom-right-radius: 4px;border-top-right-radius: 4px;" id="form_input_left" placeholder="Your email address">
				<input type="submit" id="submit_newsletter" name="submit_newsletter" style="height:54px;margin-left: 1px;border-bottom-left-radius: 4px;border-top-left-radius: 4px;" id="form_submit_button">
			</div>
	</div>
	<?php
}
add_shortcode( 'newsletter', 'newsletter_html' );


global $jal_db_version;
$jal_db_version = "1.0";

function jal_install() {
	global $wpdb;
	global $jal_db_version;

	$table_name = $wpdb->prefix . "newsletter";

	$sql = "CREATE TABLE `$table_name` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IP` varchar(255) NOT NULL,
  `USER_AGENT` varchar(255) NOT NULL,
  `USER_REFERER` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`ID`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30;
	);";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );

   add_option( "jal_db_version", $jal_db_version );
}
register_activation_hook( __FILE__, 'jal_install' );

