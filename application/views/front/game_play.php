<section>
	<div class="container fullscreen">

		<div class="row">
			<div class="col-sm-12">

				<div class="game-full-box text-center">
					<?php if($type != 2) { ?>
					<div class="row">
						<div class="col-sm-12">
							<div class="slider slider-inverse">
								<input id="slider" type="text" data-plugin="range-slider" value="" data-slider-orientation="horizontal" data-slider-min="200" data-slider-max="1300" data-slider-value="800" data-slider-tooltip="hide">
							</div>
						</div>
					</div>
					<?php } ?>
				<?php if($type == 1) { ?>
					<div id="gameBox">
						<object id="flash" type="application/x-shockwave-flash" data="<?php echo site_url('uploads/files/games/'.$file.''); ?>" title="<?php echo $title_game; ?>" width="800" height="666">
							<param name="movie" value="<?php echo site_url('uploads/files/games/'.$file); ?>">
							<param name="quality" value="high">
							<param name="wmode" value="transparent">
							<param name="bgcolor" value="#000000">
							<param name="allowFullScreen" value="true">
                            <p><a href="http://get.adobe.com/flashplayer"><?php echo $this->lang->line('installFlash'); ?></a></p>
						</object>
					</div>
				<?php } elseif($type == 2) { ?>
					<div id="gameBox" class="p-t-20 p-b-20">
						<object type="application/x-shockwave-flash" data="/assets/flash/emulator.swf" title="<?php echo $title_game; ?>" width="<?php echo emul($console, 'width'); ?>" height="<?php echo emul($console, 'height'); ?>">
							<param name="movie" value="/assets/flash/emulator.swf">
							<param name="bgcolor" value="#000000">
							<param name="allowscriptaccess" value="sameDomain">
							<param name="allowFullScreen" value="true">
							<param name="allowFullScreenInteractive" value="true">
							<param name="flashvars" value="system=<?php if(isset($console)) echo $console; ?>&amp;url=<?php echo site_url('uploads/files/games/'.$file.''); ?>">
                            <p><a href="http://get.adobe.com/flashplayer"><?php echo $this->lang->line('installFlash'); ?></a></p>
						</object>
					</div>
				<?php } else { ?>
					<div id="gameBox">
						<iframe id="object" src="<?php if(isset($embed)) echo $embed;  ?>" type="application/vnd.adobe.flash-movie" width="850" height="800" scrolling="no" frameborder="0"></iframe>
					</div>
				<?php } ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="game-panel-inverse clearfix">
					<div class="pull-left game-title-fullscreen">
						<div class="pull-left">
							<img class="thumb-md" src="<?php echo (!empty($image)) ? ($image) : (site_url('assets/images/default_swf.jpg')); ?>" alt="">
						</div>
						<h3 class="inline"><b><a href="<?php echo site_url('game/show/'.$url.'/'); ?>"><?php if(isset($title_game)) echo $title_game; ?></a></b></h3>
						<div><div id="<?php echo (isset($this->session->id)) ? 'rating' : 'nr-rating'; ?>" class="inline" data-score="<?php if(isset($getNote)) echo $getNote; ?>" data-game="<?php if(isset($id)) echo $id; ?>"></div> <small class="text-muted">(<?php if(isset($getNbNote)) echo $getNbNote; ?>)</small></div>
					</div>
					<div class="game-panel-btn">
					<?php if(isset($this->session->id)) { ?>
						<a href="<?php echo site_url('game/play/'.$url.'/?fav='.(($getFav === 1) ? 'del' : 'add')); ?>" class="btn btn-warning btn-yellow waves-effect waves-light"> <i class="<?php echo ($getFav === 1) ? 'fa fa-star' : 'fa fa-star-o'; ?>"></i>  </a>
					<?php } else { ?>
						<a class="btn btn-warning btn-yellow waves-effect waves-light sa-not-registed"><i class="fa fa-star-o"></i></a>
					<?php } ?>
					<?php if($type != 2) { ?>
						<button class="btn btn-primary waves-effect waves-light" id="fullscreen"> <i class="fa fa-arrows-alt"></i></button>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>

		<div class="row containerBox">
			<div class="col-sm-12">

				<div class="col-sm-12 col-lg-9 col-md-12">
					<div class="card-box">

						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-7">
									<h3 class="panel-title m-b-10"><?php echo $this->lang->line('gameInfo'); ?></h3>
									<h5 class="font-600"><?php echo $this->lang->line('category'); ?> : <a href="<?php echo site_url('category/'.$url_category.'/'); ?>"><?php if(isset($category)) echo $category; ?></a></h5>
									<h5 class="font-600"><?php echo $this->lang->line('description'); ?> :</h5>
									<p class="text-muted"><?php if(isset($description)) echo $description; ?></p>

								<?php if(!empty($getKeywords)) { ?>
									<h5 class="font-600"><?php echo $this->lang->line('keywords'); ?> :</h5>
									<p class="text-muted"><?php echo $getKeywords; ?></p>
								<?php } ?>

								<?php if(!empty($control)) { ?>
									<h5 class="font-600"><?php echo $this->lang->line('control'); ?> :</h5>
									<p class="text-muted"><?php echo $control; ?></p>
								<?php } ?>

								<?php if(!empty($tips)) { ?>
									<h5 class="font-600"><?php echo $this->lang->line('tips'); ?> :</h5>
									<p class="text-muted"><?php echo $tips; ?></p>
								<?php } ?>

								</div>
								<div class="col-sm-12">
									<h3 class="panel-title m-t-20 m-b-10"><?php echo $this->lang->line('shareThis'); ?></h3>
									<?php echo share(current_url(), (isset($title_game)) ? $title_game : ''); ?>

									<?php if(!empty($author)) { ?>
									<div class="pull-right">
										<h5 class="font-600"><?php echo $this->lang->line('author'); ?> : <span class="text-muted"><?php echo $author; ?></span></h5>
									</div>
									<?php } ?>
								</div>

							</div>
						</div>
					</div>

					<div class="card-box">
						<div class="row">
							<div class="col-sm-12">

							<?php if(isset($this->session->id)) { ?>
								<form method="post" class="well">
									<span class="input-icon icon-right">
										<textarea rows="2" class="form-control" placeholder="Post a new message" name="com_message" id="comments"></textarea>
									</span>
									<input id="related" type="hidden" name="related" value="">
									<div class="p-t-10 pull-right">
										<button type="submit" class="btn btn-sm btn-primary waves-effect waves-light"><?php echo $this->lang->line('send'); ?></button>
									</div>
									<ul class="nav nav-pills profile-pills m-t-10">
										<!-- <li>
											<a href="#"><i class="fa fa-user"></i></a>
										</li>
										<li>
											<a href="#"><i class="fa fa-location-arrow"></i></a>
										</li>
										<li>
											<a href="#"><i class=" fa fa-camera"></i></a>
										</li>
										<li>
											<a href="#"><i class="fa fa-smile-o"></i></a>
										</li> -->
									</ul>
								</form>

							<?php } else { ?>
								<div class="well">
									<span><?php echo $this->lang->line('loginForComment'); ?></span>
								</div>
							<?php } ?>

								<div id="comments-list">
								<?php if(!empty($getBestComs['getComs'])) { ?>
									<h3 class="header-title"><?php echo $this->lang->line('bestComments'); ?></h3>
									<?php echo $getBestComs['getComs']; ?>
								<?php } ?>
								<?php if(!empty($getComs)) { ?>
									<h3 class="header-title"><?php echo $this->lang->line('lastComments'); ?></h3>
									<?php echo $getComs; ?>
									<div class="text-center"><?php if(isset($getPagination)) echo $getPagination; ?></div>
								<?php } ?>
								</div>

							</div> <!-- end col -->
						</div> <!-- end row -->
					</div>	<!-- end card-box -->
				</div>

				<div class="col-sm-12 col-lg-3 col-md-12 mobiles">
					<div class="panel panel-color panel-inverse">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $this->lang->line('publicity'); ?></h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-12">
									<?php echo $this->config->item('sidebartop'); ?>
								</div>
							</div>
						</div>
					</div>


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
							<h3 class="panel-title"><?php echo $this->lang->line('publicity'); ?></h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-12">
									<?php echo $this->config->item('sidebarbottom'); ?>
								</div>
							</div>
						</div>
					</div>

				<?php if(!empty($getUsersFav)) { ?>
					<div class="panel panel-color panel-inverse">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $this->lang->line('theyLikeGame'); ?></h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-12">
									<?php echo $getUsersFav; ?>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>

				</div>

			</div> <!-- end col -->
		</div> <!-- end row -->
	</div> <!-- end container -->
</section>

<script>
window.onload = function() {
	$(".fullscreen .slider").hover(
	  function() {
	    $(this).toggleClass('slidershow');
	});
	$("a#reply").click(function() {
		var id = $(this).parent().data("id");
		$("input#related").val(id);
	});
	$("a.finger-up").click(function() {
		var id = $(this).parent().data("id");
		$.get("/game/likesComs/"+id+"/1");
		var pos = $(this);
		pos.children().toggleClass('text-primary');
		pos.next().children().removeClass('text-danger');
	});
	$("a.finger-down").click(function() {
		var id = $(this).parent().data("id");
		$.get("/game/likesComs/"+id+"/0");
		var pos = $(this);
		pos.children().toggleClass('text-danger');
		pos.prev().children().removeClass('text-primary');
	});
};
</script>
