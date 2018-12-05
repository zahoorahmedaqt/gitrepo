<section>
	<div class="container ">
		<div class="row m-t-20">
			<div class="col-sm-12">

				<div class="col-sm-12 col-lg-9 col-md-12 mobiles">

					<div class="card-box">
						<div class="row">
							<div class="col-sm-3">
								<a href="<?php echo site_url('game/play/'.$url.'/'); ?>"><img class="thumb-img" src="<?php echo (!empty($image)) ? ($image) : (site_url('assets/images/default_swf.jpg')); ?>" alt=""></a>
							</div>

							<div class="col-sm-9">
								<div class="product-right-info">
									<h3><b><?php if(isset($title_game)) echo $title_game; ?></b></h3>

									<div class="row">
										<div class="col-sm-12">
											<h5 class="font-600 inline"><?php echo $this->lang->line('category'); ?> : </h5>
											<span class="text-muted"><a href="<?php echo site_url('category/'.$url_category.'/'); ?>"><?php if(isset($category)) echo $category; ?></a></span>
											<h5 class="font-600 inline m-l-10"><?php echo $this->lang->line('note'); ?> : </h5>

											<div id="<?php echo (isset($this->session->id)) ? 'rating' : 'nr-rating'; ?>" class="inline" data-score="<?php if(isset($getNote)) echo $getNote; ?>" data-game="<?php if(isset($id)) echo $id; ?>"></div> <small class="text-muted">(<?php if(isset($getNbNote)) echo $getNbNote; ?>)</small>

										</div>
									</div>

									<hr/>

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

								<?php if(!empty($author)) { ?>
									<h5 class="font-600"><?php echo $this->lang->line('author'); ?> :</h5>
									<p class="text-muted"><?php echo $author; ?></p>
								<?php } ?>

									<div class="m-t-30">
										<a href="<?php echo site_url('game/play/'.$url.'/'); ?>" class="btn btn-lg btn-larger btn-danger waves-effect waves-light"> <?php echo $this->lang->line('playNow'); ?> </a>
									</div>

									<hr/>

								<?php if(isset($this->session->id)) { ?>
									<a href="<?php echo site_url('game/show/'.$url.'/?fav='.(($getFav === 1) ? 'del' : 'add')); ?>" class="btn btn-inverse waves-effect waves-light"> <i class="<?php echo ($getFav === 1) ? 'fa fa-star' : 'fa fa-star-o'; ?> m-r-5"></i><span> <?php echo ($getFav === 1) ? $this->lang->line('removeFromFav')  : $this->lang->line('addToFav') ?></span></a>
								<?php } else { ?>
									<button class="btn btn-inverse waves-effect waves-light sa-not-registed"><i class="fa fa-star-o m-r-5"></i><span> <?php echo $this->lang->line('addToFav'); ?></span></button>
								<?php } ?>

									<button type="button" id="share" class="btn btn-inverse waves-effect waves-light"> <i class="fa fa-share-alt m-r-5"></i> <span><?php echo $this->lang->line('share'); ?></span> </button>
								</div>
							</div>
						</div> <!-- end row -->
					</div> <!-- end card-box -->

					<div id="shareBox" class="card-box" style="display:none;">
						<div class="row">
							<div class="col-sm-12">
								<?php echo share(current_url(), (isset($title_game)) ? $title_game : '', (isset($description)) ? $description : ''); ?>
							</div>
						</div>
					</div>

					<div class="card-box">
						<div class="row">
							<div class="col-sm-12">
								<?php echo $this->config->item('sidebarcontent'); ?>
							</div>
						</div>
					</div>

					<div class="card-box">
						<div class="row">
							<div class="col-sm-12">

								<h2 class="header-title m-t-0 m-b-20"><?php echo $this->lang->line('comments'); ?></h2>
							<?php if(isset($this->session->id)) { ?>
								<form method="post" class="well">
									<span class="input-icon icon-right">
										<textarea rows="2" class="form-control" placeholder="Post a new message" name="com_message" id="comments"></textarea>
									</span>
									<input id="related" type="hidden" name="related" value="">
									<div class="p-t-10 pull-right">
										<button type="submit" class="btn btn-sm btn-primary waves-effect waves-light"><?php echo $this->lang->line('send'); ?></button>
									</div>
									<div class="m-t-30"></div>
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
					</div>
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
	$("#share").click(
	  function() {
	    $('#shareBox').toggle();
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
