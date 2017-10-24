<?php global $woocommerce; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	
	<?php if (get_field('favicon', 'options')): ?>
	<link rel="icon" href="<?php the_field('favicon', 'options'); ?>" sizes="32x32">
	<?php endif; ?>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	 <script type="text/javascript">
		//<![CDATA[
		optionalZipCountries = ["MG"];
		//]]>
	 </script>
	 <?php wp_head(); ?>
  </head>
  <body <?php body_class('cms-index-index cms-home'); ?>>
	 <div class="page">
		<div class="head-wrap" style="background-image: url(<?php the_field('header_bg_img', 'options') ?>)">
		   <div class="header-wrap">
			  <div class="container">
				 <header role="banner" class="row row-no-padding">
					<div class="col-lg-3 visible-lg">
					   <h1 class="logo">
						  <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <?php $logo = get_field('logo', 'options'); if($logo) : ?>
                                    <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
                                <?php else: ?>
                                    <img src="<?php echo get_template_directory_uri(); ?>/img/flextone-logo.png" alt="">
                                <?php endif; ?>
                            </a>
						</h1>
					</div>
					<div class="col-lg-6 col-md-12">
					   <nav class="navbar navbar-default navbar-main" role="navigation">
						  <div class="mobile-nav-wrap">
							 <div class="mobile-nav">
								<div>
								   <a class="nav-logo-mobile" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		                                <?php $logo = get_field('logo', 'options'); if($logo) : ?>
		                                    <img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
		                                <?php else: ?>
		                                    <img src="<?php echo get_template_directory_uri(); ?>/img/flextone-logo.png"  style="max-width: 240px;" alt="">
		                                <?php endif; ?>
		                            </a>
								</div>
								<div class="clearfix"></div>
								<div class="navbar-header">
								   <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
								   <span class="sr-only">Toggle Navigation</span>
								   <span class="icon-bar"></span>
								   <span class="icon-bar"></span>
								   <span class="icon-bar"></span>
								   </button>
								   <a class="navbar-brand" href="#" data-toggle="collapse" data-target=".navbar-main-collapse">
								   Menu                       </a>
								</div>
							 </div>
						  </div>
						  <div class="collapse navbar-collapse navbar-main-collapse">
						   <?php wp_nav_menu( 
								  array(
								  'menu'               => 'Primary Menu',
								  'theme_location'     => 'menu-1',
								  'depth'              => 2,
								  'container'          => 'false',
								  'menu_class'         => 'nav navbar-nav',
								  'menu_id'            => '',
								  //'fallback_cb'        => 'wp_bootstrap_navwalker::fallback',
								  'walker'             => new wp_bootstrap_navwalker()
								  ) 
							  ); 
						  ?>
						  </div>
					   </nav>
					</div>
					<div class="col-lg-3 visible-lg">
					   <div class="quick-access">
						  <div class="clearfix">
							 <nav class="navbar-account menu-shrink-hide">
								<ul class="nav navbar-nav">
								   <li class="level0 first level-top parent my-account">
									  <a class="level-top" href="http://www.flextonegamecalls.com/customer/account/" data-toggle="dropdown"><i class="fa fa-user"></i> <span class="menu-text">My Account</span> <b class="caret"></b></a>
									  <ul class="dropdown-menu" role="menu">
										 <li class="first last" ><a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="My Account" >My Account</a></li>
									  </ul>
								   </li>
								   <li class="level0 level-top parent cart_toggler mnu-cart">
									  <a class="level-top" href="<?php echo wc_get_cart_url(); ?>" data-toggle="dropdown"><i class="fa fa-shopping-cart"></i><span class="menu-text"> Cart</span>  <b class="caret"></b></a>
									  <ul class="dropdown-menu dropdown-cart" role="menu">
										 <li class="">
											<div class="block block-cart">
											   <div class="block-title">
												  <strong><span>My Cart</span></strong>
											   </div>
											   <div class="header_shopping_cart_content block-content">
												  
											   </div>
											</div>
										 </li>
									  </ul>
								   </li>
								</ul>
							 </nav>
						  </div>
						  <div class="tablet-hide">
						  	<?php get_product_search_form($echo = true); ?>
						  </div>
					   </div>
					</div>
				 </header>
			  </div>
		   </div>
		</div>