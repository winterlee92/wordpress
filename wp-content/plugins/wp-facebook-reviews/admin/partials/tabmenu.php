<?php
$urltrimmedtab = remove_query_arg( array('page', '_wpnonce', 'taction', 'tid', 'sortby', 'sortdir', 'opt') );

$urlfacebook = esc_url( add_query_arg( 'page', 'wp_fb-facebook',$urltrimmedtab ) );
$urlreviewlist = esc_url( add_query_arg( 'page', 'wp_fb-reviews',$urltrimmedtab ) );
$urltemplateposts = esc_url( add_query_arg( 'page', 'wp_fb-templates_posts',$urltrimmedtab ) );
$urlgetpro = esc_url( add_query_arg( 'page', 'wp_fb-get_pro',$urltrimmedtab ) );
?>	
	<h2 class="nav-tab-wrapper">
	<a href="<?php echo $urlfacebook; ?>" class="nav-tab <?php if($_GET['page']=='wp_fb-facebook'){echo 'nav-tab-active';} ?>"><?php _e(' Facebook', 'wp-fb-reviews'); ?></a>
	<a href="<?php echo $urlreviewlist; ?>" class="nav-tab <?php if($_GET['page']=='wp_fb-reviews'){echo 'nav-tab-active';} ?>"><?php _e('Reviews List', 'wp-fb-reviews'); ?></a>
	<a href="<?php echo $urltemplateposts; ?>" class="nav-tab <?php if($_GET['page']=='wp_fb-templates_posts'){echo 'nav-tab-active';} ?>"><?php _e('Templates', 'wp-fb-reviews'); ?></a>
	<a href="<?php echo $urlgetpro; ?>" class="nav-tab <?php if($_GET['page']=='wp_fb-get_pro'){echo 'nav-tab-active';} ?>"><?php _e('Get Pro Version', 'wp-fb-reviews'); ?></a>
	</h2>