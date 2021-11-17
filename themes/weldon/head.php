<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Add manifest to add option to install on home screen -->
<!--	<link rel="manifest" href="--><?php //echo get_template_directory_uri(); ?><!--/manifest.json">-->

	<!-- ios -->
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

	<!-- icon in the highest resolution we need it for -->
	<link rel="icon" sizes="192x192"
		  href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/favicon-192x192.png"/>

	<!-- Favicon 32x32px -->
	<link rel="shortcut icon" sizes="32x32"
		  href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/favicon-32x32.png">

	<!--  Multiple icons for Safari -->
	<link rel="apple-touch-icon" sizes="76x76"
		  href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/favicon-76x76.png"/>
	<link rel="apple-touch-icon" sizes="120x120"
		  href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/favicon-120x120.png"/>
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/favicon-192x192.png"/>

	<!--  Browser theme colour schema -->
	<meta name="theme-color" content="#231F20">

	<?php
	wp_head();
	?>

</head>