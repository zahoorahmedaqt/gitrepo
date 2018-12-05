<section>
	<div class="container">
		<div class="row m-t-20">

			<div class="col-lg-9 col-md-8">
				<div class="row">
					<div class="col-sm-12">
						<div class="card-box">
							<h2 class="header-title m-t-0"><?php echo $this->lang->line('usersMoreNotes'); ?></h2>
							<?php if(isset($getMembersNotes)) echo $getMembersNotes; ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="card-box">
							<h2 class="header-title m-t-0"><?php echo $this->lang->line('usersMoreFavorites'); ?></h2>
							<?php if(isset($getMembersFavs)) echo $getMembersFavs; ?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="card-box">
							<h2 class="header-title m-t-0"><?php echo $this->lang->line('usersMoreComments'); ?></h2>
							<?php if(isset($getMembersComs)) echo $getMembersComs; ?>
						</div>
					</div>
				</div>
			</div> <!-- End col -->

			<div class="col-md-4 col-lg-3">
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
			</div> <!-- End col -->

		</div> <!-- End row -->
	</div>
</section>
