<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="shortcut icon" href="<?php echo site_url('assets/images/favicon_1.ico'); ?>">

	<title><?php if(isset($title)) echo $title; ?></title>

	<link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo site_url('assets/css/core.css'); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo site_url('assets/css/components.css'); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo site_url('assets/css/icons.css'); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo site_url('assets/css/pages.css'); ?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo site_url('assets/css/responsive.css'); ?>" rel="stylesheet" type="text/css" />

	<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

	<script src="<?php echo site_url('assets/js/modernizr.min.js'); ?>"></script>

</head>
<body>

	<?php if(isset($content)) echo $content; ?>

	<script>
		var resizefunc = [];
	</script>

	<!-- jQuery  -->
	<script src="<?php echo site_url('assets/js/jquery.min.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/detect.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/fastclick.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/jquery.slimscroll.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/jquery.blockUI.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/waves.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/wow.min.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/jquery.nicescroll.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/jquery.scrollTo.min.js'); ?>"></script>

	<script src="<?php echo site_url('assets/js/jquery.core.js'); ?>"></script>
	<script src="<?php echo site_url('assets/js/jquery.app.js'); ?>"></script>

</body>
</html>