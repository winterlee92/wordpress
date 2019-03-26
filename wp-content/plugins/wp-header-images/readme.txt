﻿=== WP Header Images ===
Contributors: fahadmahmood
Tags: header images, images, header, custom header, custom images, page header, head image, slideshow, dynamic header, dynamic images
Requires at least: 3.0.1
Tested up to: 5.0
Stable tag: 1.6.7
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
A great WordPress plugin which helps you to choose a unique image for each menu page.

== Description ==
* Author: [Fahad Mahmood](http://www.androidbubbles.com/contact)
* Project URI: <http://androidbubble.com/blog/wordpress/plugins/wp-header-images>

WP Header Images is a great plugin to implement custom header images for each page. You can set images easily and later can manage CSS from your theme.
WP Header Images is a WordPress plugin which helps you to choose a unique image for each menu page. Normally a menu item can be either page, post, category, product or even just a link. These menu items can be managed from WordPress Admin > Appearance > Menus. 
WooCommerce categories can have unique header images by using this plugin. It was a difficult thing to manage different slideshow before, most of the times you have to be restricted for banner area for only home page. And that home banners cannot be used for all pages. By this plugin you can use unique header images for each WooCommerce category and product pages too.

Video Tutorial:
https://www.youtube.com/watch?v=T-cHoMPLBDw

[WDWD Blog][Wordpress][]: http://androidbubble.com/blog/category/website-development/php-frameworks/wordpress/
[TutorsLoop][WordPress Mechanic][]: http://www.tutorsloop.net/app/live.php?id=3694705

Compatibility List:

* Guava Pattern
* Genesis
* Thesis
* WooThemes
* Gantry
* Carrington Core
* Hybrid Core
* Options Framework
* Redux Framework
* SMOF
* UPThemes
* Vafpress
* Codestar

   
== Installation ==

How to install the plugin and get it working:


Method-A:

1. Go to your wordpress admin "yoursite.com/wp-admin"

2. Login and then access "yoursite.com/wp-admin/plugin-install.php?tab=upload

3. Upload and activate this plugin

4. Now go to admin menu -> settings -> WP Header Images

5- Choose your menu > page

6- Select image from your media library

7- Implementation

    <span class="yellow">&lt;?php do_action('apply_header_images'); ?&gt;</span>
    OR
	<span class="light_blue">&lt;?php do_shortcode('[WP_HEADER_IMAGES]'); ?&gt;</span>

	
Method-B:

1.	Download the WP Header Images installation package and extract the files on

	your computer. 
2.	Create a new directory named `WP Header Images` in the `wp-content/plugins`

	directory of your WordPress installation. Use an FTP or SFTP client to

	upload the contents of your WP Header Images archive to the new directory

	that you just created on your web host.
3.	Log in to the WordPress Dashboard and activate the WP Header Images plugin.
4.	Once the plugin is activated, a new **WP Header Images** sub-menu will appear in your Wordpress admin -> settings menu.

[WP Header Images Quick Start]: http://androidbubble.com/blog/wordpress/plugins/wp-header-images



== Frequently Asked Questions ==

= Is this compatible with all WordPress themes? =

Yes, it is compatible with all WordPress themes which are developed according to the WordPress theme development standards. 

= Is everything ready in this plugin for final deployment? =

Every theme will have different header area and required header images place so a few stylesheet properties will be required to be added and/or modified.

= How can i report an issue to the plugin author? =

It's better to post on support forum but if you need it be fixed on urgent basis then you can reach me through my blog too. You can find my blog link above.

== Screenshots ==

1. WP Header Images > Settings Page > Custom or Auto Implementation
2. WP Header Images > Settings Page > Menu B
3. How it works? > Shortcode & PHP Impementation
4. By clicking on any image section, media upload option comes up
5. Existing media library images can be used too
6. WP Header Images can be used with multiple menus - 1
7. WP Header Images can be used with multiple menus - 2
8. It can be used with WooCommerce Categories & WooCommerce Products as well
9. WP Header Images > How to clear/remove header images?
10. WP Header Images > Settings Page > Menu A

== Changelog ==
= 1.6.7 =
* Languages added. [Thanks to Abu Usman]
= 1.6.6 =
* Pro version refined. [Thanks to Salman Qureshi]
= 1.6.5 =
* Breadcrumbs added through templates. [Thanks to Solojoomla]
= 1.6.4 =
* An important warning has been handled.
= 1.6.3 =
* New shortcodes added so images can be used in overlay. [Thanks to David Garofalo]
= 1.6.2 =
* uninstall.php added. [Thanks to veltsu]
= 1.6.1 =
* More post types enabled and added in premium version. [Thanks to albclr76]
= 1.6.0 =
* Default template string issue fixed. [Thanks to Solojoomla]
= 1.5.9 =
* New tabs added in settings area.
= 1.5.8 =
* Storefront theme header image compatibility added.
= 1.5.7 =
* the_custom_header_markup() compatibility added for default WordPress themes.
= 1.5.5 =
* Improved implementation. [Thanks to Cary Virtue]
= 1.5.4 =
* Sanitized input and fixed direct file access issues.
= 1.5.3 =
* Metadata work in progress for slider.
= 1.5.2 =
* Template selection refined. [Thanks to Ulysse Media]
= 1.5.1 =
* Fatal error fixed. [Thanks to Ulysse Media]
= 1.5.0 =
* Plugin is now translatable.
* Premium shortcodes and templates added. [Thanks to Guillaume Tremblay]
= 1.4.9 =
* get_terms updated to wp_get_nav_menus [Thanks to Deborah Bellony]
= 1.4.8 =
* HTTP and HTTPS related issue resolved for WooCommerce shop page. [Thanks to Ricardo Heikamp]
* Mobile responsive height auto settings. [Thanks to delcour]
= 1.4.7 =
* Single post can have default home banner. [Thanks to Lucia Hsieh]
= 1.4.4 =
* An important fix. [Thanks to chania06]
= 1.4.3 =
* An important fix. [Thanks to Dirk Schneider]
= 1.4.2 =
* Fatal error: Call to undefined function is_product_category() removed.
= 1.4.1 =
* A few tweaks and improved usability. [Thanks to Magalli Mendoza]
= 1.4.0 =
* A few tweaks and improved usability.
= 1.3.1 =
* An important update for WordPress user capabilities 4.5.2.
= 1.3.0 =
* An important update for WordPress version 4.5.0.
= 0.2.0 =
* An important feature is added.
= 1.1.0 =
* A few important fixes are done.
= 1.0.1 =
* A minor fix.
= 1.0 =
* Initial Commit

== Upgrade Notice ==
= 1.6.7 =
Languages added.
= 1.6.6 =
Pro version refined.
= 1.6.5 =
Breadcrumbs added through templates.
= 1.6.4 =
An important warning has been handled.
= 1.6.3 =
New shortcodes added so images can be used in overlay.
= 1.6.2 =
uninstall.php added.
= 1.6.1 =
More post types enabled and added in premium version.
= 1.6.0 =
Default template string issue fixed.
= 1.5.9 =
Styling and a couple of other settings tabs added.
= 1.5.8 =
Storefront theme header image compatibility added.
= 1.5.7 =
the_custom_header_markup() compatibility added for default WordPress themes.
= 1.5.5 =
Improved implementation.
= 1.5.4 =
Sanitized input and fixed direct file access issues.
= 1.5.3 =
No need to update.
= 1.5.2 =
Template selection refined.
= 1.5.1 =
Fatal error fixed.
= 1.5.0 =
Plugin is now translatable.
Premium shortcodes and templates added.
= 1.4.9 =
get_terms updated to wp_get_nav_menus
= 1.4.8 =
HTTP and HTTPS related issue resolved for WooCommerce shop page.
= 1.4.7 =
Single post can have default home image.
= 1.4.4 =
An important fix.
= 1.4.3 =
An important fix.
= 1.4.2 =
An important bug fixed.
= 1.4.1 =
A few tweaks and improved usability.
= 1.4.0 =
A few tweaks and improved usability.
= 1.3.1 =
An important update for WordPress user capabilities 4.5.2.
= 1.3.0 =
An important update for WordPress version 4.5.0.
= 1.2.0 =
An important feature is added.
= 1.1.0 =
A few important fixes are done.
= 1.0.1 =
Must update if you are using my other plugin alphabetic pagination at the same time.
= 1.0 =
Initial Commit

== Arbitrary section ==

I would appreciate the suggestions related to new features. Please don't forget to support this free plugin by giving your awesome reviews.

== A brief Markdown Example ==

Ordered list:

1. Can be used with WooCommerce
2. Exceptional support is available
3. Developed according to the WordPress plugin development standards

Unordered list:

* It can be used with menu pages
* It can be used with menu posts
* It can be used with menu links
* It can be used with menu categories
* It can be used with menu products




== License ==
This WordPress Plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
This free software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with this software. If not, see http://www.gnu.org/licenses/gpl-2.0.html.