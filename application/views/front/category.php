<section>
	<div class="container">

		<div class="row m-t-20">
			<div class="col-sm-12 m-l-10">
				<a href="<?php echo site_url('category/'.$cat_url.'/news/'); ?>" class="btn btn-inverse btn-custom btn-rounded waves-effect waves-light"><?php echo $this->lang->line('news'); ?></a>
				<a href="<?php echo site_url('category/'.$cat_url.'/popular/'); ?>" class="btn btn-inverse btn-custom btn-rounded waves-effect waves-light"><?php echo $this->lang->line('popular'); ?></a>
				<a href="<?php echo site_url('category/'.$cat_url.'/rated/'); ?>" class="btn btn-inverse btn-custom btn-rounded waves-effect waves-light"><?php echo $this->lang->line('topRated'); ?></a>
				<a href="<?php echo site_url('category/'.$cat_url.'/'); ?>" class="btn btn-inverse btn-custom btn-rounded waves-effect waves-light"><?php echo $this->lang->line('alphabetic'); ?></a>
			</div> <!-- end col -->
		</div> <!-- end row -->

		<div class="row m-t-20">
			<div class="col-sm-12 col-lg-9 col-md-12">
				<?php if(isset($getBlocGame)) echo $getBlocGame; ?>

				<div class="row">
					<div class="col-sm-12">
						<div class="text-right">
							<?php if(isset($pagination)) echo $pagination; ?>
						</div>
					</div> <!-- end col -->
				</div> <!-- end row -->
			</div>

			<div class="col-sm-12 col-lg-3 col-md-12">
				<ul class="nav nav-tabs navtab-bg nav-justified">
					<li class="active">
						<a href="#home1" data-toggle="tab" aria-expanded="false">
							<span class="visible-xs"><i class="fa fa-home"></i></span>
							<span class="hidden-xs"><?php echo $this->lang->line('topRated'); ?></span>
						</a>
					</li>
					<li class="">
						<a href="#profile1" data-toggle="tab" aria-expanded="true">
							<span class="visible-xs"><i class="fa fa-user"></i></span>
							<span class="hidden-xs"><?php echo $this->lang->line('mostPlayed'); ?></span>
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="home1">
						<?php if(isset($getBestGamesNote)) echo $getBestGamesNote; ?>
					</div>
					<div class="tab-pane" id="profile1">
						<?php if(isset($getBestGamesClic)) echo $getBestGamesClic; ?>
					</div>
				</div>

				<div class="panel panel-color panel-inverse">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $this->lang->line('latestComments'); ?></h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12">
								<?php if(isset($getComs)) echo $getComs; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div> <!-- end row -->

	</div> <!-- end container -->
</section>


<script>
window.onload = function() {
	var cw = $('.thumb-img').width()/1.3;
	$('.thumb-img').css({'height':cw+'px'});
	$(".game-list-box img").hover(function() {
	  $(this).parent().next().slideToggle();
	});
};
</script>
