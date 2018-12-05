<section>
	<div class="container">

		<div class="row m-t-20">
			<div class="col-sm-12 m-l-10">
				<a href="<?php echo site_url('news/'); ?>" class="btn btn-inverse btn-custom btn-rounded waves-effect waves-light"><?php echo $this->lang->line('news'); ?></a>
				<a href="<?php echo site_url('popular/'); ?>" class="btn btn-inverse btn-custom btn-rounded waves-effect waves-light"><?php echo $this->lang->line('popular'); ?></a>
				<a href="<?php echo site_url('rated/'); ?>" class="btn btn-inverse btn-custom btn-rounded waves-effect waves-light"><?php echo $this->lang->line('topRated'); ?></a>
				<a href="<?php echo site_url(); ?>" class="btn btn-inverse btn-custom btn-rounded waves-effect waves-light"><?php echo $this->lang->line('alphabetic'); ?></a>
			</div> <!-- end col -->
		</div> <!-- end row -->

		<div class="row m-t-20">
			<div class="col-sm-12 col-lg-12 col-md-12">
				<?php if(isset($getBlocGame)) echo $getBlocGame; ?>

				<div class="row">
					<div class="col-sm-12">
						<div class="text-right">
							<?php if(isset($pagination)) echo $pagination; ?>
						</div>
					</div> <!-- end col -->
				</div> <!-- end row -->
			</div> <!-- end col -->
		</div> <!-- end row -->

	</div> <!-- end container -->
</section>

<script>
window.onload = function() {
	var cw = $('.thumb-img').width()/1.3;
	$('.thumb-img').css({'height':cw+'px'});
	$(".game-list-box img").hover(function() {
	//   $(this).parent().next().next().slideToggle();
	  $(this).parent().next().slideToggle();
	});
};
</script>
