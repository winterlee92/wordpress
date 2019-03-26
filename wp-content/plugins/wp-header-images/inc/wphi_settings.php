<?php defined( 'ABSPATH' ) or die( __('No script kiddies please!', 'wp-header-images') );
	if ( !current_user_can( 'administrator' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.', 'wp-header-images' ) );
	}
// Save the field values



	if ( isset( $_POST['wphi_styling'] )) {
		
		
			if ( 
				! isset( $_POST['wphi_styling_action_field'] ) 
				|| ! wp_verify_nonce( $_POST['wphi_styling_action_field'], 'wphi_styling_action' ) 
			) {
			
			   _e('Sorry, your nonce did not verify.');
			   exit;
			
			} else {
			
			   // process form data
			   update_option( 'wphi_styling', sanitize_wphi_data($_POST['wphi_styling']));
			}					
	}
	if ( isset( $_POST['hi_fields_submitted'] ) && $_POST['hi_fields_submitted'] == 'submitted' ) {
		/*foreach ( $_POST as $key => $value ) {		
			if ( get_option( $key ) != $value ) {
				update_option( $key, $value );
			} else {
				add_option( $key, $value, '', 'no' );
			}}*/
			
			if ( 
				! isset( $_POST['wphi_nonce_action_field'] ) 
				|| ! wp_verify_nonce( $_POST['wphi_nonce_action_field'], 'wphi_nonce_action' ) 
			) {
			
			   _e('Sorry, your nonce did not verify.');
			   exit;
			
			} else {
			
			   // process form data
			   update_option( 'wp_header_images', sanitize_wphi_data($_POST['header_images']));
			}			
			
			
		
		
		
	}
	$wphi_header_images = get_option( 'wp_header_images');
	//pree($wphi_header_images);
	
	$wphi_theme = wp_get_theme();
	$current_theme = $wphi_theme->get('TextDomain');
	
	
	//pree($wphi_get_templates);

?>	
<div class="wrap wphi">
	
<?php if(!$wphi_pro): ?>
<a title="<?php _e('Click here to download pro version','wp-header-images'); ?>" class="pro" href="http://shop.androidbubbles.com/download/" target="_blank"><?php _e('Already a Pro Member?','wp-header-images'); ?></a>
<?php endif; ?>
    
  <div class="head_area">
	<h2><span class="dashicons dashicons-welcome-widgets-menus"></span><?php echo $wphi_data['Name'].' '.'('.$wphi_data['Version'].($wphi_pro?') '.__('Pro','wp-header-images').'':')'); ?> - <?php _e('Settings','wp-header-images'); ?></h2>
    
    
    <h2 class="nav-tab-wrapper">
    <a class="nav-tab nav-tab-active"><?php _e("Header Images","wp-header-images"); ?></a>
    <a class="nav-tab"><?php _e("Styling","wp-header-images"); ?></a>
    <a class="nav-tab"><?php _e("Templates","wp-header-images"); ?></a>
    <a class="nav-tab"><?php _e("How it works?","wp-header-images"); ?></a>
    </h2>      
    
 
    
    
    
    </div>
    
    
<form class="nav-tab-content" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<?php wp_nonce_field( 'wphi_nonce_action', 'wphi_nonce_action_field' ); ?>
<input type="hidden" name="hi_fields_submitted" value="submitted" />

<div class="wphi_settings">



<?php
	$args = array( 'taxonomy'=>'nav_menu', 'hide_empty' => true );
	$menus = wp_get_nav_menus();//get_terms($args);
	$m = 0;
	
	if(!empty($menus)){
?>
<p class="submit"><input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Changes','wp-header-images'); ?>" /></p>
<?php		
	foreach ( $menus as $menu ):
	$menu_items = wp_get_nav_menu_items($menu->name);
	
?>
 
   <h3 data-id="<?php echo $menu->term_id; ?>"><span class="dashicons dashicons-format-aside"></span>Menu - <?php echo $menu->name; ?> (<?php echo count($menu_items); ?>)</h3>
<ul class="menu-class wphi_banners pages_<?php echo $menu->term_id; ?> <?php echo ($m==0?'hide':'hide'); $m++; ?>"> 
<?php 
	
	if(!empty($menu_items)){
		
		foreach($menu_items as $items){	
		
		$img_id = $wphi_header_images[$items->ID];
		$img_url = wp_get_attachment_url( $img_id );	
		
			
?>
	<li>
		<?php //pree($items); ?>
		<h4><a target="_blank" href="<?php echo ($items->type='custom'?$items->url:get_permalink($items->object_id)); ?>"><?php echo $items->title; ?></a></h4>
        <div title="<?php echo $wphi_set_str; ?>" class="banner_wrapper" style="background:url('<?php echo $img_url; ?>'); background-repeat:no-repeat;"><input type="number" value="<?php echo ($img_id>0?$img_id:0); ?>" class="hide hi_vals" name="header_images[<?php echo $items->ID; ?>]" /><?php if($img_id==0): ?><span class="dashicons dashicons-yes hide"></span><label><?php echo $wphi_set_str; ?></label><?php endif; ?></div>
        <a class="" title="<?php _e('Click here to remove this header image','wp-header-images'); ?>"><?php _e('Clear','wp-header-images'); ?></a>
    </li>
<?php			
		}
	}else{
?>
	
<?php		
	}
?>
</ul>
<?php endforeach; ?>
<p class="submit<?php echo ($wphi_pro?' hides':''); ?>"><input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Changes','wp-header-images' ); ?>" /></p>
<?php }else{ ?>
<ul class="menu-class wphi_cm"><li><?php _e('You need to','wp-header-images'); ?> <a class="" href="nav-menus.php" target="_blank"><?php _e('Create a Menu','wp-header-images'); ?></a> <?php _e('first','wp-header-images'); ?>.</li></ul>
<?php } ?>

<?php if(function_exists('wphi_posts_headers')){ wphi_posts_headers(); } ?>


</div>
</form>


<form class="nav-tab-content hide styling" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
<?php wp_nonce_field( 'wphi_styling_action', 'wphi_styling_action_field' ); ?>
<textarea name="wphi_styling"><?php echo get_option( 'wphi_styling', '/* Your CSS Styles */' ); ?></textarea>
<p class="submit"><input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Changes','wp-header-images' ); ?>" /></p>
</form>


<div class="hide nav-tab-content templates_wrapper">
<div class="templates_area">
	<?php 
	if(!$wphi_pro){
	?>
	<a class="button" style="float:right" href="<?php echo $wphi_premium_link; ?>" target="_blank"><?php _e('Click here to go premium','wp-header-images'); ?></a>
    <?php
	}
	?>
    <?php 
	if($wphi_pro){
	?>
    
    <div class="inner_area">
		    
            
    
    <?php 
	
	$wphi_get_templates = wphi_get_templates();
	if(!empty($wphi_get_templates)){ ?>

    
	<?php _e('Select any template','wp-header-images'); ?>: <br /><br />


    <form action="options-general.php?page=wp_hi" class="templates" method="post">
    <input type="submit" value="<?php _e('Save Changes'); ?>" class="button button-primary"  style="float:right"/>
        <div class="hides">
            <label for="wphi_template_text"><input id="wphi_template_text" type="checkbox" name="wphi_template_text" value="yes" /><?php _e('Display Page Title on Image'); ?></label>
        </div>        
    	<?php wp_nonce_field( 'wphi_template_action', 'wphi_template_field' ); ?>
    	<input style="display:none" type="text" name="wphi_template" value="<?php echo $wphi_template; ?>" />
    	<ul>
        <?php foreach($wphi_get_templates as $key=>$templates){ if(!in_array($key, array('selected'))){ 
		?>
	        <li data-id="<?php echo $key; ?>" <?php echo ($wphi_template==$key?'class="selected"':''); ?>><img src="<?php echo $templates['url']; ?>" alt="<?php echo $templates['title']; ?>" title="<?php echo $templates['title']; ?>" /><strong><?php echo $templates['title']; ?></strong>
            
            <?php if($key=='custom'){ ?>
            <div class="wphi_template_custom">
            	<label><?php _e('Template HTML','wp-header-images'); ?>:</label>
                <textarea class="template_str" name="wphi_template_custom[template_str]"><?php echo $templates['template_str']; ?></textarea><br />

                <label><?php _e('Template Styles and Scripts','wp-header-images'); ?>:</label>
                <textarea class="template_scripts" name="wphi_template_custom[template_scripts]"><?php echo $templates['template_scripts']; ?></textarea>
            </div>
            <?php }  ?>
            
            </li>
        <?php } } ?>
        </ul>

        
    </form>
    <?php } ?>
    </div>
    <?php }else{ ?>
    <b class="wphi_pro"><?php _e('Templates feature is a premium feature.','wp-header-images'); ?></b>
    <div class="inner_area">
    
	<form class="templates" action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post"> 
	
    <br /><br />
	<?php _e('Select any template','wp-header-images'); ?>: <br />

	<?php
	$wphi_get_templates = wphi_get_templates();
	if(!empty($wphi_get_templates)){ ?>    
    <ul>
    <?php foreach($wphi_get_templates as $key=>$templates){ if(!in_array($key, array('selected'))){ 
	?>
    <li data-id="<?php echo $key; ?>"><img src="<?php echo $templates['url']; ?>" alt="<?php echo $templates['title']; ?>" title="<?php echo $templates['title']; ?>" /><strong><?php echo $templates['title']; ?></strong>
    
    
            <?php if($key=='custom'){ ?>
            <div class="wphi_template_custom">
            	<label><?php _e('Template HTML','wp-header-images'); ?>:</label>
                <textarea class="template_str" name="wphi_template_custom[template_str]"><?php echo $templates['template_str']; ?></textarea><br />

                <label><?php _e('Template Styles and Scripts','wp-header-images'); ?>:</label>
                <textarea class="template_scripts" name="wphi_template_custom[template_scripts]"><?php echo $templates['template_scripts']; ?></textarea>
            </div>
            <?php }  ?>    
    </li>
    <?php } } ?>
    </ul>
    
    <?php } ?>
    </form>
    </div>
    <?php } ?>
    
    <b class="wphi_pro"><?php _e('For Developers','wp-header-images'); ?> (<?php echo ($wphi_pro?__('Advanced','wp-header-images'):__('Advanced/Premium','wp-header-images')); ?>)</b>
    <div class="inner_area">
    <?php _e('Use following action hook instead','wp-header-images'); ?>:<br />
    &lt;?php do_action('apply_header_images',
    '&lt;div class=&quot;header_image&quot;&gt;&lt;h2 style=&quot;background-image: url(%url%);&quot;&gt;%title%&lt;/h2&gt;&lt;/div&gt;'); ?&gt;<br /><br />
    Or the following shortcode instead:<br /><br />
	&lt;?php do_shortcode('[WP_HEADER_IMAGES
template_str=\'&lt;div class=&quot;header_image&quot;&gt;&lt;h2 style=&quot;background-image: url(%url%);&quot;&gt;%title%&lt;/h2&gt;&lt;/div&gt;\']'); ?&gt;<br /><br />
    <?php _e('Expected Output'); ?>:<br />
    <img src="<?php echo $wphi_link; ?>img/banner-style-c.jpg" />
    <br />
<br />

    <strong><?php _e('Sample CSS'); ?>:</strong><br /><br />


.header_image h2{<br />    background-repeat: no-repeat; <br />    background-attachment: scroll;<br />    background-size: cover;<br />    width: 100%; <br />    height: 250px; <br />    line-height: 250px;     <br />    text-align: center; <br />    text-transform: uppercase;<br />    color: #ffffff;<br />    font-weight: bold;<br />    font-size: 40px;<br />}
	</div>
    </div>
    

</div>
<div class="hide nav-tab-content pre">
    <div class="shortcode_area">
    <b><?php _e('Steps to follow','wp-header-images'); ?>: (<?php _e('Basic','wp-header-images'); ?>)</b>
    <ol>
    <li class="wphi_manual"><?php _e('Click here to open theme','wp-header-images'); ?> <a href="theme-editor.php?file=header.php&theme=<?php echo $current_theme; ?>" target="_blank">header.php</a><br />
<br />
<?php _e('Insert any of these code snippets inside &lt;body&gt; tag wherever you want these header images to appear.','wp-header-images'); ?>
    <span class="yellow">&lt;?php do_action('apply_header_images'); ?&gt;</span>
    OR
	<span class="light_blue">&lt;?php do_shortcode('[WP_HEADER_IMAGES]'); ?&gt;</span><br />

	<?php _e("That's it."); ?><br /><br /><br /><br /><br /><br />
    </li>   
    
    <li class="wphi_default">
    <?php _e("This plugin is compatible with WordPress default theme function"); ?> <a href="https://developer.wordpress.org/reference/functions/the_custom_header_markup/" target="_blank">the_custom_header_markup()</a>.<br /><br />
    &lt;?php the_custom_header_markup(); ?&gt;<br /><br />
    <small><?php _e('If your theme is using this function so no shortcode is required. You can simply use this plugin alternative of the default header image.'); ?></small><br /><br />
    <small><a href="customize.php?autofocus[control]=header_image" target="_blank"><?php _e('Click here'); ?> <?php _e('to check if this theme is using default header image functionality?'); ?></a></small>    
    </li>
    
	<li class="wphi_premium">
	
	<?php _e('Insert any of these code snippets inside &lt;body&gt; tag wherever you want these header images to appear.','wp-header-images'); ?>
   
	<span class="light_blue">&lt;?php echo do_shortcode('[WP_HEADER_IMAGES type="url"]'); ?&gt;</span>
    <span class="light_blue">&lt;?php do_shortcode('[WP_HEADER_IMAGES type="url" echo="true"]'); ?&gt;</span>
    <span class="light_blue">&lt;?php echo do_shortcode('[WP_HEADER_IMAGES type="url" echo="false"]'); ?&gt;</span>

	<?php if(!$wphi_pro): ?>
    <a href="<?php echo $wphi_premium_link; ?>" target="_blank"><?php _e('Click here to go premium','wp-header-images'); ?></a>
    <?php endif; ?>
    </li> 
    
    </ol>
    </div>
    
    
    
	</div>
    
    
    
    

</div>
<style type="text/css">
#message{
	display:none;
}
</style>