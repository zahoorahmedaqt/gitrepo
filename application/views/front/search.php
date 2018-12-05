<section>
	<div class="container">

		<div class="row m-t-20">
			<div class="col-md-8 col-md-offset-2">
				<form role="search" action="<?php echo site_url('search'); ?>" method="get">
					<div class="input-group m-t-10">
						<input type="text" name="q" class="form-control input-lg" placeholder="<?php echo $this->lang->line('search'); ?>...">
						<span class="input-group-btn">
							<button type="submit" class="btn waves-effect waves-light btn-default btn-lg"><i class="fa fa-search m-r-5"></i> <?php echo $this->lang->line('search'); ?></button>
						</span>
					</div>
				</form>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center m-t-30">
				<h3 class="h4"><b><?php echo $this->lang->line('searchResultsFor'); ?> "<?php if(isset($searchResult)) echo $searchResult; ?>"</b></h3>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-12">
				<div class="search-result-box m-t-40">

					<ul class="nav nav-tabs">
						<li class="<?php if(!isset($_GET['pu'])) echo 'active'; ?>">
							<a href="#home" data-toggle="tab" aria-expanded="true">
								<span class="visible-xs"><i class="fa fa-home"></i></span>
								<span class="hidden-xs"><b><?php echo $this->lang->line('games'); ?></b> <span class="badge badge-primary m-l-10"><?php if(isset($nbGames)) echo $nbGames; ?></span></span>
							</a>
						</li>
						<li class="<?php if(isset($_GET['pu'])) echo 'active'; ?>">
							<a href="#users" data-toggle="tab" aria-expanded="false">
								<span class="visible-xs"><i class="fa fa-user"></i></span>
								<span class="hidden-xs"><b><?php echo $this->lang->line('users'); ?></b> <span class="badge badge-pink m-l-10"><?php if(isset($nbUsers)) echo $nbUsers; ?></span> </span>
							</a>
						</li>
					</ul>

					<div class="tab-content">
						<div class="tab-pane <?php if(!isset($_GET['pu'])) echo 'active'; ?>" id="home">
							<div class="row">
								<div class="col-md-12">
									<?php if(isset($getSearchGames)) echo $getSearchGames; ?>
									<div class="text-right">
										<?php if(isset($paginationGames)) echo $paginationGames; ?>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<div class="tab-pane <?php if(isset($_GET['pu'])) echo 'active'; ?>" id="users">
							<?php if(isset($getSearchUsers)) echo $getSearchUsers; ?>
							<div class="text-right">
								<?php if(isset($paginationUsers)) echo $paginationUsers; ?>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div> <!-- end container -->
</section>
