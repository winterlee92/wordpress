<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once('class-ivole-admin.php');
require_once('class-ivole-sender.php');
require_once('class-ivole-reviews.php');
require_once('class-ivole-endpoint.php');
require_once('class-ivole-endpoint-replies.php');
require_once('class-ivole-reporter.php');
require_once('class-ivole-manual.php');
require_once('class-ivole-structured-data.php');
require_once('class-ivole-admin-import.php');
require_once('class-ivole-google-shopping-feed.php');
require_once('class-ivole-replies.php');
require_once('class-ivole-reviews-grid.php');

require_once('class-ivole-admin-menu-reviews.php');
require_once('class-ivole-admin-menu-reminders.php');
require_once('class-ivole-admin-menu-settings.php');
require_once('class-ivole-admin-menu-diagnostics.php');
require_once('class-ivole-admin-menu-import.php');
require_once('class-ivole-reviews-list-table.php');
require_once('class-ivole-reminders-list-table.php');

require_once('class-ivole-settings-review-reminder.php');
require_once('class-ivole-settings-review-extensions.php');
require_once('class-ivole-settings-review-discount.php');
require_once('class-ivole-settings-premium.php');
require_once('class-ivole-settings-trust-badges.php');
require_once('class-ivole-settings-google-shopping.php');

class Ivole {
	public function __construct() {
		if( function_exists( 'wc' ) ) {
			$ivole_admin = new Ivole_Admin();
			$ivole_sender = new Ivole_Sender();
			$ivole_reviews = new Ivole_Reviews();
			$ivole_endpoint = new Ivole_Endpoint();
			$ivole_endpoint_replies = new Ivole_Endpoint_Replies();
			$ivole_reporter = new Ivole_Reporter();
			$ivole_structured_data = new Ivole_StructuredData();
			$ivole_reviews_grid = new Ivole_Reviews_Grid();

			if ( is_admin() ) {
				$reviews_admin_menu = new Ivole_Reviews_Admin_Menu();
				$reminders_admin_menu = new Ivole_Reminders_Admin_Menu();
				$settings_admin_menu = new Ivole_Settings_Admin_Menu();
				$diagnostics_admin_menu = new Ivole_Diagnostics_Admin_Menu();
				$ivole_manual = new Ivole_Manual();
				$ivole_admin_import = new Ivole_Admin_Import();
				$import_admin_menu = new Ivole_Import_Admin_Menu();

				new Ivole_Review_Reminder_Settings( $settings_admin_menu );
				new Ivole_Review_Extensions_Settings( $settings_admin_menu );
				new Ivole_Review_Discount_Settings( $settings_admin_menu );
				new Ivole_Premium_Settings( $settings_admin_menu );
				new Ivole_Trust_Badges( $settings_admin_menu );
				new Ivole_Google_Shopping_Settings( $settings_admin_menu );
			}
		}
	}
}

?>
