<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    WP_FB_Reviews
 * @subpackage WP_FB_Reviews/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    WP_FB_Reviews
 * @subpackage WP_FB_Reviews/admin
 * @author     Your Name <email@example.com>
 */
class WP_FB_Reviews_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugintoken    The ID of this plugin.
	 */
	private $plugintoken;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugintoken       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugintoken, $version ) {

		$this->_token = $plugintoken;
		//$this->version = $version;
		//for testing==============
		$this->version = time();
		//===================

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_FB_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_FB_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		//only load for this plugin
		if(isset($_GET['page'])){
			if($_GET['page']=="wp_fb-facebook" || $_GET['page']=="wp_fb-settings" || $_GET['page']=="wp_fb-reviews" || $_GET['page']=="wp_fb-templates_posts" || $_GET['page']=="wp_fb-get_pro"){
			wp_enqueue_style( $this->_token, plugin_dir_url( __FILE__ ) . 'css/wprev_admin.css', array(), $this->version, 'all' );
			wp_enqueue_style( $this->_token."_wprev_w3", plugin_dir_url( __FILE__ ) . 'css/wprev_w3.css', array(), $this->version, 'all' );
			
			}
			
			//load template styles for wp_pro-templates_posts page
			if($_GET['page']=="wp_fb-templates_posts" || $_GET['page']=="wp_fb-get_pro"){
				//enque template styles for preview
				wp_enqueue_style( $this->_token."_style1", plugin_dir_url(dirname(__FILE__)) . 'public/css/wprev-public_template1.css', array(), $this->version, 'all' );

			}
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in WP_FB_Reviews_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The WP_FB_Reviews_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		

		//scripts for all pages in this plugin
		if(isset($_GET['page'])){
			if($_GET['page']=="wp_fb-facebook" || $_GET['page']=="wp_fb-settings" || $_GET['page']=="wp_fb-reviews" || $_GET['page']=="wp_fb-templates_posts" || $_GET['page']=="wp_fb-get_pro"){
				//pop-up script
				wp_register_script( 'simple-popup-js',  plugin_dir_url( __FILE__ ) . 'js/wprev_simple-popup.min.js' , '', $this->version, false );
				wp_enqueue_script( 'simple-popup-js' );
			}
		}
		
		//scripts for get fb reviews page
		if(isset($_GET['page'])){
			if($_GET['page']=="wp_fb-facebook"){
				//facebook js
				wp_enqueue_script( $this->_token, plugin_dir_url( __FILE__ ) . 'js/wprev_facebook.js', array( 'jquery' ), $this->version, false );
				//used for ajax
				wp_localize_script($this->_token, 'adminjs_script_vars', 
					array(
					'wpfb_nonce'=> wp_create_nonce('randomnoncestring')
					)
				);
			}
			/*
			if($_GET['page']=="wp_fb-facebook" || $_GET['page']=="wp_fb-settings"){
				//admin js
				wp_enqueue_script( $this->_token, plugin_dir_url( __FILE__ ) . 'js/wprev_admin.js', array( 'jquery' ), $this->version, false );
				//used for ajax
				wp_localize_script($this->_token, 'adminjs_script_vars', 
					array(
					'wpfb_nonce'=> wp_create_nonce('randomnoncestring')
					)
				);
			
			}
			*/
		}
		
		
		//scripts for review list page
		if(isset($_GET['page'])){
			if($_GET['page']=="wp_fb-reviews"){
				//admin js
				wp_enqueue_script('review_list_page-js', plugin_dir_url( __FILE__ ) . 'js/review_list_page.js', array( 'jquery' ), $this->version, false );
			}
			
			//scripts for templates posts page
			if($_GET['page']=="wp_fb-templates_posts"){
				//admin js
				wp_enqueue_script('templates_posts_page-js', plugin_dir_url( __FILE__ ) . 'js/templates_posts_page.js', array( 'jquery' ), $this->version, false );
				wp_localize_script('templates_posts_page-js', 'adminjs_script_vars', 
					array(
					'wpfb_nonce'=> wp_create_nonce('randomnoncestring'),
					'pluginsUrl' => wpfbrev_plugin_url
					)
				);
				//add color picker here
				wp_enqueue_style( 'wp-color-picker' );
				//enque alpha color add-on wprevpro-wp-color-picker-alpha.js
				wp_enqueue_script( 'wp-color-picker-alpha', plugin_dir_url( __FILE__ ) . 'js/wprevpro-wp-color-picker-alpha.js', array( 'wp-color-picker' ), '2.1.2', false );
			}
		}
		
	}
	
	public function add_menu_pages() {

		/**
		 * adds the menu pages to wordpress
		 */

		$page_title = 'WP FB Reviews : Get Facebook Reviews';
		$menu_title = 'WP FB Reviews';
		$capability = 'manage_options';
		$menu_slug = 'wp_fb-facebook';
		
		add_menu_page($page_title, $menu_title, $capability, $menu_slug, array($this,'wp_fb_facebook'),'dashicons-star-half');
		// We add this submenu page with the same slug as the parent to ensure we don't get duplicates
		$sub_menu_title = 'Facebook';
		add_submenu_page($menu_slug, $page_title, $sub_menu_title, $capability, $menu_slug, array($this,'wp_fb_facebook'));

		// We add this submenu page with the same slug as the parent to ensure we don't get duplicates
		//$menu_slug = 'wp_fb-settings';
		//$sub_menu_title = 'Get FB Reviews';
		//add_submenu_page($menu_slug, $page_title, $sub_menu_title, $capability, $menu_slug, array($this,'wp_fb_settings'));
		
		// Now add the submenu page for the actual reviews list
		$submenu_page_title = 'WP FB Reviews : Reviews List';
		$submenu_title = 'Reviews List';
		$submenu_slug = 'wp_fb-reviews';
		add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, array($this,'wp_fb_reviews'));
		
		// Now add the submenu page for the reviews templates
		$submenu_page_title = 'WP FB Reviews : Templates';
		$submenu_title = 'Templates';
		$submenu_slug = 'wp_fb-templates_posts';
		add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, array($this,'wp_fb_templates_posts'));
		
		// Now add the submenu page for the reviews templates
		$submenu_page_title = 'WP FB Reviews : Upgrade';
		$submenu_title = 'Get Pro';
		$submenu_slug = 'wp_fb-get_pro';
		add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, array($this,'wp_fb_getpro'));
	}
	
	
	public function wp_fb_facebook() {
		require_once plugin_dir_path( __FILE__ ) . '/partials/facebook.php';
	}
	
	//public function wp_fb_settings() {
	//	require_once plugin_dir_path( __FILE__ ) . '/partials/settings.php';
	//}

	public function wp_fb_reviews() {
		require_once plugin_dir_path( __FILE__ ) . '/partials/review_list.php';
	}
	
	public function wp_fb_templates_posts() {
		require_once plugin_dir_path( __FILE__ ) . '/partials/templates_posts.php';
	}
	public function wp_fb_getpro() {
		require_once plugin_dir_path( __FILE__ ) . '/partials/get_pro.php';
	}

	/**
	 * custom option and settings on new facebook settings page
	 */
	public function wpfbr_facebook_init()
	{
		// register a new setting for "wp_fb-settings" page
		register_setting('wp_fb-facebook', 'wpfbr_facebook');
		
		// register a new section in the "wp_fb-settings" page
		add_settings_section(
			'wpfbr_facebook_code',
			'',
			array($this,'wpfbr_facebook_code_cb'),
			'wp_fb-facebook'
		);
		//register fb app id input field
		add_settings_field(
			'fb_app_code', // as of WP 4.6 this value is used only internally
			'Secret Access Code',
			array($this,'wpfbr_field_fb_code_cb'),
			'wp_fb-facebook',
			'wpfbr_facebook_code',
			[
				'label_for'         => 'fb_app_code',
				'class'             => 'wpfbr_row',
				'wpfbr_custom_data' => 'custom',
			]
		);
		
	}	
	//==== developers section cb ====
	// section callbacks can accept an $args parameter, which is an array.
	// $args have the following keys defined: title, id, callback.
	// the values are defined at the add_settings_section() function.
	public function wpfbr_facebook_code_cb($args)
	{
		//echos out at top of section
	}	
	//==== field cb =====
	// field callbacks can accept an $args parameter, which is an array.
	// $args is defined at the add_settings_field() function.
	// wordpress has magic interaction with the following keys: label_for, class.
	// the "label_for" key value is used for the "for" attribute of the <label>.
	// the "class" key value is used for the "class" attribute of the <tr> containing the field.
	// you can add custom key value pairs to be used inside your callbacks.
	public function wpfbr_field_fb_code_cb($args)
	{
		// get the value of the setting we've registered with register_setting()
		$options = get_option('wpfbr_facebook');
		if(!isset($options[$args['label_for']])){
			$options[$args['label_for']] = "";
		}
		// output the field
		?>
		<input id="<?= esc_attr($args['label_for']); ?>" data-custom="<?= esc_attr($args['wpfbr_custom_data']); ?>" type="text" name="wpfbr_facebook[<?= esc_attr($args['label_for']); ?>]" placeholder="" value="<?php echo $options[$args['label_for']]; ?>">
		
		<p class="description">
			<?= esc_html__('Enter the Access Code that you copied from the link above. Do not share this code.', 'wp_fb-settings'); ?>
		</p>
		<?php
	}
	
	
	/**
	 * custom option and settings on settings page
	 
	public function wpfbr_settings_init()
	{
		// register a new setting for "wp_fb-settings" page
		register_setting('wp_fb-settings', 'wpfbr_options');
	 
		// register a new section in the "wp_fb-settings" page
		add_settings_section(
			'wpfbr_section_developers',
			'',
			array($this,'wpfbr_section_developers_cb'),
			'wp_fb-settings'
		);
	 
		//register fb app id input field
		add_settings_field(
			'fb_app_ID', // as of WP 4.6 this value is used only internally
			'Facebook App ID',
			array($this,'wpfbr_field_fb_app_id_cb'),
			'wp_fb-settings',
			'wpfbr_section_developers',
			[
				'label_for'         => 'fb_app_ID',
				'class'             => 'wpfbr_row',
				'wpfbr_custom_data' => 'custom',
			]
		);
		//register get access token btn field
		add_settings_field(
			'fb_user_token_btn', // as of WP 4.6 this value is used only internally
			'Get Access Token',
			array($this,'wpfbr_gettoken_cb'),
			'wp_fb-settings',
			'wpfbr_section_developers',
			[
				'label_for'         => 'fb_user_token_btn',
				'class'             => 'wpfbr_row'
			]
		);
		//register fb Access Token input field
		add_settings_field(
			'fb_user_token_field_display', // as of WP 4.6 this value is used only internally
			'FB Access Token',
			array($this,'wpfbr_field_fb_access_cb'),
			'wp_fb-settings',
			'wpfbr_section_developers',
			[
				'label_for'         => 'fb_user_token_field_display',
				'class'             => 'wpfbr_row hide'
			]
		);
		
	}
	*/
	/**
	 * custom option and settings:
	 * callback functions
	 */
	 
	//==== developers section cb ====
	// section callbacks can accept an $args parameter, which is an array.
	// $args have the following keys defined: title, id, callback.
	// the values are defined at the add_settings_section() function.
	//public function wpfbr_section_developers_cb($args)
	//{
		//echos out at top of section
	//}
	
	//==== field cb =====
	// field callbacks can accept an $args parameter, which is an array.
	// $args is defined at the add_settings_field() function.
	// wordpress has magic interaction with the following keys: label_for, class.
	// the "label_for" key value is used for the "for" attribute of the <label>.
	// the "class" key value is used for the "class" attribute of the <tr> containing the field.
	// you can add custom key value pairs to be used inside your callbacks.
	/*
	public function wpfbr_field_fb_app_id_cb($args)
	{
		// get the value of the setting we've registered with register_setting()
		$options = get_option('wpfbr_options');

		// output the field
		?>
		<input id="<?= esc_attr($args['label_for']); ?>" data-custom="<?= esc_attr($args['wpfbr_custom_data']); ?>" type="text" name="wpfbr_options[<?= esc_attr($args['label_for']); ?>]" placeholder="" value="<?php echo $options[$args['label_for']]; ?>">
		
		<p class="description">
			<?= esc_html__('Enter the Facebook App ID of your newly created app and click Save Settings. Look for the Facebook window that pops up, make sure it is not being blocked.', 'wp_fb-settings'); ?>
		</p>
		<?php
	}
	public function wpfbr_gettoken_cb($args)
	{
		?>
		<button id="<?= esc_attr($args['label_for']); ?>" type="button" class="btn_green">Get Authorization &amp; Pages</button>
		<p class="description">
			<?= esc_html__('Click to allow your newly created Facebook app to pull reviews from your Facebook Pages.', 'wp_fb-settings'); ?>
		</p>
		<?php
	}
	public function wpfbr_field_fb_access_cb($args)
	{
		// get the value of the setting we've registered with register_setting()
		$options = get_option('wpfbr_options');

		// output the field
		?>
		<input id="<?= esc_attr($args['label_for']); ?>" type="text" name="wpfbr_options[<?= esc_attr($args['label_for']); ?>]" placeholder="" value="<?php echo $options[$args['label_for']]; ?>">
		
		<p class="description">
			<?= esc_html__('This gives the plugin authorization to pull your reviews from a Facebook page.', 'wp_fb-settings'); ?>
		</p>
		<?php
	}
	*/
	/**
	 * Store reviews in table, called from javascript file admin.js
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function wpfb_process_ajax(){
	//ini_set('display_errors',1);  
	//error_reporting(E_ALL);
		
		check_ajax_referer('randomnoncestring', 'wpfb_nonce');
		
		$postreviewarray = $_POST['postreviewarray'];
		
		//var_dump($postreviewarray);

		//loop through each one and insert in to db
		global $wpdb;
		$table_name = $wpdb->prefix . 'wpfb_reviews';
		
		$stats = array();
		
		foreach($postreviewarray as $item) { //foreach element in $arr
			$pageid = $item['pageid'];
			$pagename = $item['pagename'];
			$created_time = $item['created_time'];
			$created_time_stamp = strtotime($created_time);
			$reviewer_name = $item['reviewer_name'];
			$reviewer_id = $item['reviewer_id'];
			$reviewer_imgurl = $item['reviewer_imgurl'];
			if($item['rating']){
				$rating = $item['rating'];
			} else {
				$rating ="";
			}
			if($item['recommendation_type']){
				$recommendation_type = $item['recommendation_type'];
			} else {
				$recommendation_type ="";
			}
			$review_text = $item['review_text'];
			$review_length = str_word_count($review_text);
			if($review_length <1 && $review_text !=""){		//fix for other language error
				$review_length = substr_count($review_text, ' ');
			}
			$rtype = $item['type'];
			
			//check to see if row is in db already
			$checkrow = $wpdb->get_row( "SELECT id FROM ".$table_name." WHERE created_time = '$created_time'" );
			if ( null === $checkrow ) {
				$stats[] =array( 
						'pageid' => $pageid, 
						'pagename' => $pagename, 
						'created_time' => $created_time,
						'created_time_stamp' => strtotime($created_time),
						'reviewer_name' => $reviewer_name,
						'reviewer_id' => $reviewer_id,
						'rating' => $rating,
						'recommendation_type' => $recommendation_type,
						'review_text' => $review_text,
						'hide' => '',
						'review_length' => $review_length,
						'type' => $rtype,
						'userpic' => $reviewer_imgurl
					);
			}
		}
		$i = 0;
		$insertnum = 0;
		foreach ( $stats as $stat ){
			$insertnum = $wpdb->insert( $table_name, $stat );
			$i=$i + 1;
		}
	
		$insertid = $wpdb->insert_id;

		//header('Content-Type: application/json');
		echo $insertnum."-".$insertid."-".$i;

		die();
	}
	
	 /**
	 * download a copy of the avatars to local server and serve from there, update these
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */		
	private function wppro_resizeimage($source,$size){
		$image = wp_get_image_editor( $source );
		if ( ! is_wp_error( $image ) ) {
			$imagesize = $image->get_size();
			if($imagesize['width']>$size){
				$image->resize( $size, $size, true );
				$image->save( $source );
			}
		} else {
			$error_string = $result->get_error_message();
			echo '<div id="message" class="error"><p>' . $error_string . '</p></div>';
		}
	}

	public function wprevpro_download_avatar_tolocal() {
		
		//being called from js file after all reviews are downloaded.
		check_ajax_referer('randomnoncestring', 'wpfb_nonce');
		
		$imagecachedir = plugin_dir_path( __DIR__ ).'/public/partials/avatars/';
		
		//get array of all reviews, check to see if the image exists
		global $wpdb;
		$table_name = $wpdb->prefix . 'wpfb_reviews';
		$currentreviews = $wpdb->get_results("SELECT id, reviewer_id, created_time_stamp, reviewer_name, type, userpic FROM $table_name");

		foreach ( $currentreviews as $review ) 
		{
			//$review->id
			$id= $review->id;
			$revid = $review->reviewer_id;
			$newfilename = $review->created_time_stamp.'_'.$revid;
			$newfile = $imagecachedir . $newfilename.'.jpg';
			$newfileurl = esc_url( plugins_url( 'public/partials/avatars/',  dirname(__FILE__)  ) ). $newfilename.'.jpg';
			//$userpic = $review->userpic;
			$userpic = htmlspecialchars_decode($review->userpic);
			//check for avatar
			if(@filesize($newfile)<200){
				if($userpic!=''){
					if ( @copy($userpic, $newfile) ) {
						//echo "Copy success!";
						$this->wppro_resizeimage($newfile,60);
						//update db with new image location, userpiclocal
						$wpdb->query( $wpdb->prepare("UPDATE $table_name SET userpiclocal = '$newfileurl' WHERE id = %d AND reviewer_id = %s",$id, $revid) );
					} else {
						//echo "Copy failed.";
					}
				}
			}
			//--------------------------

		}
		
	}

	/**
	 * adds drop down menu of templates on post edit screen
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */	
	public function add_sc_select(){
		//get id's and names of templates that are post type 
		global $wpdb;
		$table_name = $wpdb->prefix . 'wpfb_post_templates';
		$currentforms = $wpdb->get_results("SELECT id, title, template_type FROM $table_name WHERE template_type = 'post'");
		if(count($currentforms)>0){
		echo '&nbsp;<select id="wprs_sc_select"><option value="select">Review Template</option>';
		foreach ( $currentforms as $currentform ){
			echo '<option value="[wprevpro_usetemplate tid=\''.$currentform->id.'\']">'.$currentform->title.'</option>';
		}
		 echo '</select>';
		}
	}
	//add_action('admin_head', 'button_js');
	public function button_js() {
			echo '<script type="text/javascript">
			jQuery(document).ready(function(){
			   jQuery("#wprs_sc_select").change(function() {
							if(jQuery("#wprs_sc_select :selected").val()!="select"){
							  send_to_editor(jQuery("#wprs_sc_select :selected").val());
							}
							  return false;
					});
			});
			</script>';
	}
	
	
	
//==========================================================================================	
	/**
	 * download fb backup method, only used if we get an error from the fb API reviews
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 
	 
	//for ajax call to fb backup master
	public function wprevpro_ajax_download_fb_backup() {
		
		check_ajax_referer('randomnoncestring', 'wpfb_nonce');
		$thisurlpageid = $_POST['pid'];
		$thisurlpagename = $_POST['pname'];
		$getresponse = $this->wprevpro_download_fb_backup($thisurlpageid,$thisurlpagename);
		//echo $getresponse;
		die();
	}
	 
	 
	public function wprevpro_download_fb_backup($downloadurlpageid = 'all',$pagename) {
			$options = get_option('wprevpro_yelp_settings');
			
			//check to see if only downloading one here, if not that skip and continue
			if($downloadurlnum!='all'){
					//build url with pageid  https://www.facebook.com/pg/102152479925798/reviews/
					$currenturlmore = "https://www.facebook.com/".$downloadurlpageid."/reviews/";
					$this->wprevpro_download_fb_backup_perurl($currenturlmore,$downloadurlpageid,$pagename);

			} else {
				//get all pageids that are checked
			}

	}
	
 
	public function wprevpro_download_fb_backup_perurl($currenturl,$pageid,$pagename) {
		ini_set('memory_limit','256M');
			global $wpdb;
			$table_name = $wpdb->prefix . 'wpfb_reviews';
			
				$reviews = [];
				$n=1;
				$urlvalue = $currenturl;
				//$urlvalue ='https://www.facebook.com/pg/Mutinytattoos/reviews/';

									
				$response = wp_remote_get( $urlvalue );
				if ( is_array( $response ) ) {
				  $header = $response['headers']; // array of http header lines
				  $fileurlcontents = $response['body']; // use the content
				}
				//need to trim the string down by removing all script tags
					$dom = new DOMDocument();
					$dom->loadHTML('<?xml encoding="utf-8" ?>' . $fileurlcontents);
					$script = $dom->getElementsByTagName('script');
					$remove = [];
					foreach($script as $item)
					{
					  $remove[] = $item;
					}
					foreach ($remove as $item)
					{
					  $item->parentNode->removeChild($item); 
					}
					$htmlstripped = $dom->saveHTML();

					//save file to see what we're getting
					//$tempurlvalue = plugin_dir_path( __FILE__ ).'fbbackup'.$pageid.'.html';
					//$savefile = file_put_contents($tempurlvalue,$htmlstripped );
				
				$html = wpfbrev_str_get_html($htmlstripped);


				$pagename = $pagename;
				$pageid = $pageid;

				//find total and average number here and end break loop early if total number less than 50. review-count
				
				if($html->find('meta[itemprop=ratingValue]',0)){
					$avgrating = $html->find('meta[itemprop=ratingValue]',0)->content;
					$avgrating = (float)$avgrating;
				}
				if($html->find('meta[itemprop=ratingCount]',0)){
					$totalreviews = $html->find('meta[itemprop=ratingCount]',0)->content;
					$totalreviews = intval($totalreviews);
				}
					
				
				//print_r($allreviewsarray);
				//foreach ($html->find('div._1dwg') as $review) {
				for ($x = 0; $x <= 10; $x++) {
					
					if($html->find('div.userContentWrapper',$x)){
					$review = $html->find('div.userContentWrapper',$x);
					
					
						$user_name='';
						$userimage='';
						$rating='';
						$datesubmitted='';
						$rtext='';
						// Find user_name
						if($review->find('span.profileLink', 0)){
							$user_name = $review->find('span.profileLink', 0)->plaintext;
							$user_name = sanitize_text_field($user_name);
							$user_name = addslashes($user_name);
						}
						if($user_name==''){
						if($review->find('a.profileLink', 0)){
							$user_name = $review->find('a.profileLink', 0)->plaintext;
							$user_name = sanitize_text_field($user_name);
							$user_name = $user_name;
							$user_name_slash = addslashes($user_name);
						}
						}
						if(mb_detect_encoding($user_name) != 'UTF-8') {$user_name = utf8_encode($user_name);}
											

						// Find userimage
						if($review->find('img', 0)){
							$userimage = $review->find('img', 0)->src;
						}
						
						// find rating
						if($review->find('i._51mq', 0)){
							$rating = $review->find('i._51mq', 0)->plaintext;
							$rating = intval($rating);
						}
						
						//first method find the uttimstamp $results->getAttribute("data-name");
						$uttimstamp='';
						if($review->find('abbr._5ptz', 0)->getAttribute("data-utime")){
							$uttimstamp = $review->find('abbr._5ptz', 0)->getAttribute("data-utime");
						}

						// find date
						if($review->find('span.timestampContent', 0)){
							$datesubmitted = $review->find('span.timestampContent', 0)->plaintext;
							$datesubmitted = strstr($datesubmitted, ' at ', true) ?: $datesubmitted;
							//fix for hrs ago hrs
							if (strpos($datesubmitted, 'hrs') !== false) {
								$datesubmitted = date('Y-m-d');
							}
						}
						//backup date method
						$utdate='';
						if($review->find('abbr._5ptz', 0)){
							$utdate = $review->find('abbr._5ptz', 0)->title;
						}

						// find text
						$rtext ='';
						if($review->find('div.userContent', 0)){
							$rtext = $review->find('div.userContent', 0)->plaintext;
							$rtext = sanitize_text_field($rtext);
							$rtext = addslashes($rtext);
							//remove See More
							$rtext =str_replace("See More","",$rtext);
							$rtext =str_replace("&#65533;","",$rtext);
							
						}
						if(mb_detect_encoding($rtext) != 'UTF-8') {$rtext = utf8_encode($rtext);}
						
						if($rating>0){
							//$review_length = str_word_count($rtext);
							//if($review_length <2 && $rtext !=""){		//fix for other language error
								$review_length = substr_count($rtext, ' ');
							//}
							$pos = strpos($userimage, 'default_avatars');
							if (is_numeric($uttimstamp)) {
								$timestamput = $uttimstamp;
							} else {
								if($datesubmitted!=''){
									$timestamput = strtotime($datesubmitted);
								} else {
									$timestamput = strtotime($utdate);
								}
							}
							$timestamp = date("Y-m-d H:i:s", $timestamput);
							
							//check to see if in database already
										//check to see if row is in db already
							$reviewindb = 'no';

							$checkrow = $wpdb->get_var( "SELECT id FROM ".$table_name." WHERE reviewer_name = '".trim($user_name)."' " );
								if( empty( $checkrow ) )
								{
									$reviewindb = 'no';
								} else {
									$reviewindb = 'yes';
								}
							//check again for ' in name
							$checkrow2 = $wpdb->get_var( "SELECT id FROM ".$table_name." WHERE reviewer_name = '".trim($user_name_slash)."' " );
								if( empty( $checkrow2 ) )
								{
									$reviewindb2 = 'no';
								} else {
									$reviewindb2 = 'yes';
								}

							if( $reviewindb == 'no' && $reviewindb2 == 'no')
							{
								$reviews[] = [
										'reviewer_name' => trim($user_name),
										'reviewer_id' => '',
										'pageid' => trim($pageid),
										'pagename' => trim($pagename),
										'userpic' => $userimage,
										'rating' => $rating,
										'created_time' => $timestamp,
										'created_time_stamp' => $timestamput,
										'review_text' => trim($rtext),
										'hide' => '',
										'review_length' => $review_length,
										'type' => 'Facebook'
								];
							}
							$review_length ='';
						}
				 
						$i++;
					}
				}
				
				//print_r($reviews);

				//sleep for random 2 seconds
				sleep(rand(0,1));
				$n++;
				
				//var_dump($reviews);
				// clean up memory
				if (!empty($html)) {
					$html->clear();
					unset($html);
				}


				//go ahead and delete first, only if we have new ones and turned on.
				if(count($reviews)>0){
					//add all new yelp reviews to db
					foreach ( $reviews as $stat ){
						$insertnum = $wpdb->insert( $table_name, $stat );
					}
					//reviews added to db
					if(isset($insertnum)){
						$errormsg = ' ------'.count($reviews).' Most Helpful FB reviews downloaded.';
						$this->errormsg = $errormsg;
			
					}
				} else {
					$errormsg = 'No new reviews found.';
					$this->errormsg = $errormsg;
				}
				echo $errormsg;

	}
//--======================= end fb tempmethod =======================--//	
	*/	

}