<?php defined( 'ABSPATH' ) or die( __('No script kiddies please!', 'wp-header-images') );


	function sanitize_wphi_data( $input ) {

		if(is_array($input)){
		
			$new_input = array();
	
			foreach ( $input as $key => $val ) {
				$new_input[ $key ] = (is_array($val)?sanitize_wphi_data($val):sanitize_text_field( $val ));
			}
			
		}else{
			$new_input = sanitize_text_field($input);
		}
		
		return $new_input;
	}


	if(!function_exists('pre')){
		function pre($data){
			if(isset($_GET['debug'])){
				pree($data);
			}
		}	 
	} 
		
	if(!function_exists('pree')){
	function pree($data){
				echo '<pre>';
				print_r($data);
				echo '</pre>';	
		
		}	 
	} 




	function wphi_menu()
	{

		global $wphi_data;

		 add_options_page($wphi_data['Name'], $wphi_data['Name'], 'activate_plugins', 'wp_hi', 'wp_hi');



	}

	function wp_hi(){ 



		if ( !current_user_can( 'administrator' ) )  {



			wp_die( __( 'You do not have sufficient permissions to access this page.','wp-header-images' ) );



		}



		global $wpdb, $wphi_dir, $wphi_pro, $wphi_data, $wphi_link, $wphi_template, $wphi_premium_link, $wphi_header_images, $wphi_set_str; 


		include($wphi_dir.'inc/wphi_settings.php');
		

	}	



	
	

	function wphi_plugin_links($links) { 
		global $wphi_premium_link, $wphi_pro;
		
		$settings_link = '<a href="options-general.php?page=wp_hi">'.__('Settings','wp-header-images').'</a>';
		
		if($wphi_pro){
			array_unshift($links, $settings_link); 
		}else{
			 
			$wphi_premium_link = '<a href="'.$wphi_premium_link.'" title="'.__('Go Premium','wp-header-images').'" target=_blank>'.__('Go Premium','wp-header-images').'</a>'; 
			array_unshift($links, $settings_link, $wphi_premium_link); 
		
		}
		
		
		return $links; 
	}
	
	function register_hi_scripts() {
		
			
		if (is_admin ()){
		
			wp_enqueue_media();
		
			
			 
			wp_enqueue_script(
				'wphi-scripts',
				plugins_url('js/scripts.js', dirname(__FILE__)),
				array('jquery')
			);	
			
			
		
			wp_register_style('wphi-style', plugins_url('css/admin-styles.css', dirname(__FILE__)));	
			
			wp_enqueue_style( 'wphi-style' );
		
		}else{
					
			wp_register_style('wphi-style', plugins_url('css/front-styles.css', dirname(__FILE__)));	
			
			wp_enqueue_style( 'wphi-style' );
		}
		
	
	} 
		
	if(!function_exists('wp_header_images')){
	function wp_header_images(){

		
		}
	}
	
	
		
		
	function get_parent_hmenu_id($id, $arr){
		if($arr[$id]==0)
		return $id;
		else
		return get_parent_hmenu_id($arr[$id], $arr);
	}
	

	function get_header_images_inner(){
		
		global $wphi_dir, $wphi_pro;
		$args = array( 'taxonomy'=>'nav_menu', 'hide_empty' => true );
		$menus = wp_get_nav_menus();//get_terms($args);
		$wp_header_images = get_option( 'wp_header_images');		
		//pree($wp_header_images);
		
		
		$arr = array();
		$arr_obj = array();
		$arr_urls = array();
		
		//pre(is_front_page());
		//pre(is_home());
		//pre(is_single());
		
		if(is_front_page() || is_home() || is_single())
		$page_id = 0;
		elseif(function_exists('is_product_category') && is_product_category()){
			$cate = get_queried_object();
			$page_id = $cate->term_id;
			//pre($cate);
		}
		elseif(is_archive())
		$page_id = get_cat_id( single_cat_title("",false) ); 		
		else
		$page_id = get_the_ID();
		
		//pre(is_product_category());
		//pree($page_id);
		
		foreach ( $menus as $menu ):
		$menu_items = wp_get_nav_menu_items($menu->name);
		//pree($menu_items);
		if(!empty($menu_items)){
			foreach($menu_items as $items){
				$parent = $items->menu_item_parent;
				
				$arr[$items->ID] = $parent;
				//pre($arr_obj);
				$key = $items->object_id;
				$arr_obj[$key][$items->ID] = $items->ID;
				$arr_urls[$key][$items->ID] = $items->url;
				
			}
		}
		endforeach;
		
//		pre($arr_obj);
//		pre(get_the_ID());
//		pre($page_id);
//		pre($cur_cat_id);
//		pre(is_single());
//		pre(is_page());
//		pre(is_archive());
//		pre(is_shop());
//		pre($_SERVER);
		$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		if(array_key_exists('HTTPS', $_SERVER) && $_SERVER['HTTPS']=='on'){
			$actual_link = str_replace('http://', 'https://', $actual_link);			
		}
		$actual_link = str_replace('?debug', '', $actual_link);
		//pre($arr_urls);
		$obj_ids = array();
		if($page_id!=0 && array_key_exists($page_id, $arr_urls)){
			//pre($arr_urls);
			if(count($arr_urls[$page_id])>0){
				//pre($actual_link);
				//pre($arr_urls[$page_id]);
				foreach($arr_urls[$page_id] as $pkey => $purl){
					$obj_id = ($actual_link==$purl?$pkey:0);
					if($obj_id){
						//pre($obj_id);
						$obj_ids[] = $obj_id;					
					}
				}
				//pre($obj_id);
				//$arr_obj[$page_id] = array($arr_obj[$page_id][$obj_id]);
			}else{
			}
		}
			
		if($page_id==0 && is_array($arr_urls)){
			foreach($arr_urls as $expected_page_id => $arr_url){
				
				if($page_id==0 && empty($obj_ids)){
					//pre($actual_link);
					//pre($arr_url);
					
					$for_obj_id = array_search($actual_link, $arr_url);
					
					if(!$for_obj_id)
					$for_obj_id = array_search('/', $arr_url);
					//pre($obj_id);
					//pee($expected_page_id);
					if($for_obj_id>0){
						$obj_ids[] = $for_obj_id;
						//pre($arr_url);
						//pre($expected_page_id);
						$page_id = $expected_page_id;
					}
				}
				
				
			}
		}
		
		if($page_id==0){
			$page_id = current(array_keys($arr_obj));
		}

		//pree($page_id);
		//pre($obj_ids);
		$img_id = 0;
		foreach($obj_ids as $obj_id){
			$parent_id = $arr_obj[$page_id][$obj_id];	
			//pre($parent_id);
			if($img_id==0)
			$img_id = $wp_header_images[$parent_id];
		}

		//pre($arr_obj);
		//pree($img_id);
		//pree($page_id);
		//pree($parent_id);

		if($img_id==0 && $wphi_pro){
			$post_type = get_post_type();
			
			if($post_type && array_key_exists($post_type, $wp_header_images) && array_key_exists($page_id, $wp_header_images[$post_type])){
				$img_id = $wp_header_images[$post_type][$page_id];
			}
		}
		//pree($img_id);
		
		
		$ret = array('title'=>'', 'url'=>'');

		if($img_id>0){
			$img_url = wp_get_attachment_url( $img_id );			
			//pre($img_url);
			if($img_url!=''){	
				$post = get_post($page_id);
				//$post_meta = get_post_meta($img_id);
				$ret['title'] = (isset($post->post_title)?$post->post_title:'');
				$ret['url'] = $img_url;
			}
		}
		//pre($ret);
		return $ret;
	}
	
	if(!function_exists('get_header_images')){
	
		function get_header_images($template_str='', $plain=false){
			global $wphi_dir;
			$is_header_image = get_header_image();
			$img_data = get_header_images_inner();
			//pre($img_data);
			extract($img_data);
			
			$url = ($url?$url:$is_header_image);
			//pre($url);
			//pre($plain);
			
			if($plain){
				$template_str = ($url?'<img src="'.$url.'" alt="'.$title.'" />':'');
				//pre($template_str);
				return $template_str;
			}else{
				$template_str = '<div class="header_image"><img src="'.$url.'" alt="'.$title.'" /></div>';
				echo $template_str;
			}
		}
	
	}
		
		
	function get_storefront_header_styles() {
		
		global $wphi_dir;
		$is_header_image = get_header_image();
		$img_data = get_header_images_inner();
		
		extract($img_data);
		$url = ($url?$url:$is_header_image);
		
	
		if ( $url ) {
			$header_bg_image = 'url(' . esc_url( $url ) . ')';
		}

		$styles = array();
	
		if ( '' !== $header_bg_image ) {
			$styles['background-image'] = $header_bg_image;
		}

		$styles = apply_filters( 'get_storefront_header_styles', $styles );
		
		return $styles;
				

		
	}
	
	
	
	if(!function_exists('wphi_header_scripts')){
		function wphi_header_scripts(){
			$wphi_get_templates = wphi_get_templates();
			$wphi_get_template = isset($wphi_get_templates['selected'])?$wphi_get_templates['selected']:'';
			if(is_array($wphi_get_template)){		
					extract($wphi_get_template);
					echo $template_scripts;
			
			}
		}
		add_action('wp_head', 'wphi_header_scripts');
	}
	
	if(!function_exists('wphi_get_templates')){
	
		function wphi_get_templates(){
			global $wphi_link, $wphi_template;
			
			$wphi_template_custom = get_option('wphi_template_custom', array('template_str'=>'<div class="header_image"><h2 style="background-image: url(%url%);">%title%</h2></div>', 'template_scripts'=>'	<style type="text/css">
						
			@media only screen and (max-device-width: 480px) {
				
				
			}			
		</style>
		<script type="text/javascript" language="javascript">
			jQuery(document).ready(function($){
			});
		</script>'));
			extract($wphi_template_custom);
			
			$wphi_templates = array(
				'reset' => array(
				
					'url' => $wphi_link.'img/banner-style-0.png',
					'title' => 'Default',
					'template_str' => '',
					'template_scripts' => ''
				
				),			
				'centered' => array(
				
					'url' => $wphi_link.'img/banner-style-c.jpg',
					'title' => 'Centered',
					'template_str' => '',
					'template_scripts' => ''
				
				),			
				'classic' => array(
				
					'url' => $wphi_link.'img/banner-style-l.jpg',
					'title' => 'Classic',
					'template_str' => '',
					'template_scripts' => ''
				
				),			
				'custom' => array(
				
					'url' => $wphi_link.'img/banner-style-3.png',
					'title' => 'Custom',
					'template_str' => stripslashes($template_str),
					'template_scripts' => stripslashes($template_scripts)
				
				)			
			);
			
			$wphi_templates['selected'] = $wphi_templates[$wphi_template];
			$wphi_templates['selected']['template_scripts'] .= '<style type="text/css">'.get_option( 'wphi_styling' ).'</style>';
			return $wphi_templates;
		}
		
	}
	if(!function_exists('wphi_get_header_image_tag')){
		function wphi_get_header_image_tag($default = array()){
			$defined = get_header_images('', true);
			echo ($defined!=''?$defined:$default);
			
			//echo $attr;
		}
	}
	if(!function_exists('wphi_init')){
		function wphi_init(){
			add_filter('get_header_image_tag', 'wphi_get_header_image_tag', 20);
			add_action('storefront_header_styles', 'get_storefront_header_styles', 10, 1);	
		}
		
	}
	add_action('init', 'wphi_init');
	
	if(!function_exists('wphi_posts_headers')){
		function wphi_posts_headers(){
			global $wphi_premium_link;
			$post_types = get_post_types();
?>
<ul class="menu-class wphi_cmm"><li><?php _e('Do you want to set header images for more post types like','wp-header-images'); ?> <a><?php echo implode('</a>, <a>', $post_types) ?></a>? <br />
<a class="" href="<?php echo $wphi_premium_link; ?>" target="_blank"><?php _e('Go Premium','wp-header-images'); ?></a></li></ul>
<?php			
		}
	}