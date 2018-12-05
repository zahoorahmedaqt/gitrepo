<?php
if($this->config->item('maintenance')) { redirect('maintenance/index/'); } ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="<?php if(NULL!==$this->config->item('keywords')) echo $this->config->item('keywords'); ?>" />
		<meta name="description" content="<?php if(NULL!==$this->config->item('description')) echo $this->config->item('description'); ?>">
		<meta name="author" content="<?php if(NULL!==$this->config->item('author')) echo $this->config->item('author'); ?>" />
		<meta http-equiv="default-style" content="text/css">

		<meta property="article:published_time" content="<?php echo date("Y-m-d H:i:s") ?>">
		<meta property="article:section" content="">
		<meta property="og:description" content="" />
		<meta property="og:title" content="<?php if(isset($title)) echo $title; ?>" />
		<meta property="og:url" content="<?php echo current_url(); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:image" content="<?php echo site_url(''); ?>" />

		<link rel="icon" href="<?php echo site_url('assets/images/favicon.ico'); ?>" type="image/x-icon">

		<title><?php if(isset($title)) echo $title; ?></title>

		<!-- Alert js -->
        <link href="<?php echo site_url('assets/css/sweet-alert.css'); ?>" rel="stylesheet" type="text/css">
		<!-- Slider -->
        <link href="<?php echo site_url('assets/css/bootstrap-slider.min.css'); ?>" rel="stylesheet" type="text/css"/>

		<link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo site_url('assets/css/core.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo site_url('assets/css/components.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo site_url('assets/css/icons.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo site_url('assets/css/pages.css'); ?>" rel="stylesheet" type="text/css" />
		<link href="<?php echo site_url('assets/css/responsive.css'); ?>" rel="stylesheet" type="text/css" />

		<?php if(isset($JaxonCSS)) echo $JaxonCSS; ?>

		<!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		<script src="<?php echo site_url('assets/js/modernizr.min.js'); ?>"></script>
	</head>

	<body class="fixed-left front">

		<!-- Begin page -->
		<div id="wrapper">

			<!-- Top Bar Start -->
			<div class="topbar">

				<!-- LOGO -->
				<div class="topbar-left">
					<div class="text-center">
						<a href="<?php echo site_url(''); ?>" class="logo"><?php if(NULL!==$this->config->item('logo')) echo $this->config->item('logo'); ?></a>
					</div>
				</div>

				<!-- Button mobile view to collapse sidebar menu -->
				<div class="navbar navbar-default" role="navigation">
					<div class="container">
						<div class="">
							<ul class="nav navbar-nav">
								<li><a href="<?php echo site_url(''); ?>" class="waves-effect waves-light"><?php echo $this->lang->line('home'); ?></a></li>
								<?php if(isset($getCategories)) echo $getCategories; ?>
								<li><a href="<?php echo site_url('members/'); ?>" class="waves-effect waves-light hidden-xs"><?php echo $this->lang->line('members'); ?></a></li>
							</ul>

							<form role="search" class="navbar-left app-search pull-left hidden-xs hidden-md">
								 <input type="text" id="search" name="q" placeholder="<?php echo $this->lang->line('searchForm'); ?>" class="form-control">
								 <a href="#" onclick="window.location.href='<?php echo site_url('search?q='); ?>'+document.getElementById('search').value;"><i class="fa fa-search"></i></a>
							</form>

							<ul class="nav navbar-nav navbar-right pull-right">
								<li class="dropdown top-menu-item-xs">
									<a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="<?php echo (isset($this->session->name_image)) ? (site_url('uploads/images/users/'.$this->session->name_image)) : (site_url('assets/images/default-user.png')); ?>" alt="<?php echo $this->session->username; ?>" class="img-circle"> </a>
									<ul class="dropdown-menu">

									<?php if($this->session->id) { ?>
										<li><a href="<?php echo site_url('user/'.$this->session->url.'/'); ?>"><i class="ti-user m-r-10 text-custom"></i> <?php echo $this->lang->line('profile'); ?></a></li>
										<li><a href="<?php echo site_url('myprofile/'); ?>"><i class="ti-agenda m-r-10 text-custom"></i> <?php echo $this->lang->line('settings'); ?></a></li>
									<?php } ?>

									<?php if($this->session->admin) { ?>
										<li><a href="<?php echo site_url('dashboard/'); ?>"><i class="ti-settings m-r-10 text-custom"></i> <?php echo $this->lang->line('dashboard'); ?></a></li>
									<?php } ?>

									<?php if(!$this->session->id) { ?>
										<li><a href="<?php echo site_url('login/register/'); ?>"><i class="ti-lock m-r-10 text-custom"></i><?php echo $this->lang->line('signup'); ?></a></li>
									<?php } ?>

										<li class="divider"></li>
										<li><a href="<?php echo site_url((isset($_SESSION['username'])) ? 'login/logout' : 'login/'); ?>"><i class="ti-power-off m-r-10 <?php echo (isset($_SESSION['username'])) ? 'text-danger' : 'text-success'; ?>"></i> <?php echo (isset($_SESSION['username'])) ? $this->lang->line('logout') : $this->lang->line('login'); ?></a></li>
									</ul>
								</li>
							</ul>
						</div>
						<!--/.nav-collapse -->
					</div>
				</div>
			</div>
			<!-- Top Bar End -->

			<!-- ============================================================== -->
			<!-- Start right Content here -->
			<!-- ============================================================== -->
			<div class="content-page">
				<!-- Start content -->
				<div class="content">
					<?php if(isset($content)) echo $content; ?>
				</div> <!-- End content -->
				<footer class="footer navbar-default">
					<div class="container">
						<div class="row">
							<div class="col-md-3 col-lg-offset-1">
								<a href="<?php echo site_url(''); ?>" class="logo"><?php if(NULL!==$this->config->item('logo')) echo $this->config->item('logo'); ?></a>
							</div>
							<div class="col-md-5 col-md-offset-1">
								<ul class="nav navbar-nav pull-right">
									<?php if(isset($getFooter)) echo $getFooter; ?>
								</ul>
							</div>
							<div class="col-lg-2 col-md-3">
								<ul class="social-icons">
									<?php if($this->config->item('demo')) { ?>
									<li><a href="http://www.coffeetheme.com"><i class="fa fa-coffee"></i></a></li>
									<?php } ?>
									<?php if($this->config->item('facebook')) { ?>
									<li><a href="<?php echo $this->config->item('facebook'); ?>"><i class="fa fa-facebook"></i></a></li>
									<?php } ?>
									<?php if($this->config->item('twitter')) { ?>
									<li><a href="<?php echo $this->config->item('twitter'); ?>"><i class="fa fa-twitter"></i></a></li>
									<?php } ?>
									<?php if($this->config->item('google')) { ?>
									<li><a href="<?php echo $this->config->item('google'); ?>"><i class="fa fa-google-plus"></i></a></li>
									<?php } ?>
								</ul>
							</div>
						</div> <!-- end row -->
					</div> <!-- end container -->
				</footer>
			</div>
			<!-- ============================================================== -->
			<!-- End Right content here -->
			<!-- ============================================================== -->

			<!-- Back to top -->
	        <a href="#" class="back-to-top" id="back-to-top"> <i class="fa fa-angle-up"></i> </a>
		</div>
		<div class="background"></div>
		<!-- END wrapper -->
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
		<!-- Rating js -->
        <script src="<?php echo site_url('assets/plugins/raty-fa/jquery.raty-fa.js'); ?>"></script>
        <script src="<?php echo site_url('assets/js/jquery.rating.js'); ?>"></script>
        <!-- Alert js -->
        <script src="<?php echo site_url('assets/js/sweet-alert.min.js'); ?>"></script>
        <script src="<?php echo site_url('assets/js/jquery.sweet-alert.init.js'); ?>"></script>
		<!-- Slider js -->
        <script src="<?php echo site_url('assets/js/bootstrap-slider.min.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/jquery.ui-sliders.js'); ?>"></script>
        <!-- jQuery Core -->
		<script src="<?php echo site_url('assets/js/jquery.core.js'); ?>"></script>
		<script src="<?php echo site_url('assets/js/jquery.app.js'); ?>"></script>
        <!-- Bootstrap Files  -->
		<script src="<?php echo site_url('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js');?>"></script>
		<!-- Google Analytic -->
		<?php echo $this->config->item('google_analytics'); ?>
	</body>
</html>
