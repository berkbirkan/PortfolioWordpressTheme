<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php bloginfo('name'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php bloginfo('description'); ?>" />
	<meta name="keywords" content="<?php bloginfo('keywords'); ?>" />
	<meta name="author" content="<?php bloginfo('author'); ?>" />

	<!-- 
	//////////////////////////////////////////////////////

	portfolio5 Portfolio Wordpress Theme
		
	Website: 		http://berkbirkan.com
	Email: 			info@berkbirkan.com
	Twitter: 		http://twitter.com/berkbirkan
	Github: 		https://www.github.com/berkbirkan

	//////////////////////////////////////////////////////

	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />



	<?php wp_head(); ?>

	</head>
	<body>
		
	<div class="portfolio5-loader"></div>
	
	<div id="page">	
	<header id="portfolio5-header" class="portfolio5-cover js-fullheight" role="banner" style="background-image:url(<?php bloginfo('template_url'); ?>/images/cover_bg_4.jpg);" data-stellar-background-ratio="2.0">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t js-fullheight">
						<div class="display-tc js-fullheight animate-box" data-animate-effect="fadeIn">
							<div class="profile-thumb" style="background: url(<?php if(unserialize(get_option("header_settings"))["header_image_upload"] == ""){ echo bloginfo('template_url')."/images/author.jpg"; }else{ echo wp_get_attachment_image_src(unserialize(get_option("header_settings"))["header_image_upload"],"full")[0]; } ?>);"></div>
							

							<h1><span><?php echo unserialize(get_option("header_settings"))["header_fullname"];  ?></span></h1>
							<h2><span><?php echo unserialize(get_option("header_settings"))["header_title"];  ?></span></h2>
							<p>
								
								
								<ul class="portfolio5-social-icons">
									<?php
									if(unserialize(get_option("header_settings"))["header_twitter"] != ""){
										
										echo '<li><a href="https://';
										echo unserialize(get_option("header_settings"))["header_twitter"];
										echo '"><i class="icon-twitter2"></i></a></li>';
	                                    
									}
									if(unserialize(get_option("header_settings"))["header_facebook"] != ""){
										
										echo '<li><a href="https://';
										echo unserialize(get_option("header_settings"))["header_facebook"];
										echo '"><i class="icon-facebook2"></i></a></li>';
										
									}
									if(unserialize(get_option("header_settings"))["header_linkedin"] != ""){
										
										echo '<li><a href="https://';
										echo unserialize(get_option("header_settings"))["header_linkedin"];
										echo '"><i class="icon-linkedin2"></i></a></li>';
										
									}
									if(unserialize(get_option("header_settings"))["header_youtube"] != ""){
										
										echo '<li><a href="https://';
										echo unserialize(get_option("header_settings"))["header_youtube"];
										echo '"><i class="icon-youtube"></i></a></li>';
										
									}
									if(unserialize(get_option("header_settings"))["header_github"] != ""){
										
										echo '<li><a href="https://';
										echo unserialize(get_option("header_settings"))["header_github"];
										echo '"><i class="icon-github"></i></a></li>';
										
									}
									
									?>
								</ul>
								
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>