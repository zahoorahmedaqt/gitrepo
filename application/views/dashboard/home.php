<div class="row">

	<div class="col-lg-4">
		<div class="card-box">
			<div class="bar-widget">
				<div class="table-box">

					<div class="table-detail">
						<h4 class="m-t-0 m-b-5"><b><?php if(isset($nbMembers)) echo $nbMembers; ?></b></h4>
						<p class="text-muted m-b-0 m-t-0"><?php echo $this->lang->line('totalMembers'); ?></p>
					</div>
					<div class="table-detail text-right">
						<span data-plugin="peity-bar" data-colors="#34d3eb,#ebeff2" data-width="120" data-height="45"><?php if(isset($statsMembers)) echo $statsMembers; ?></span>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="card-box">
			<div class="bar-widget">
				<div class="table-box">

					<div class="table-detail">
						<h4 class="m-t-0 m-b-5"><b><?php if(isset($nbComments)) echo $nbComments; ?></b></h4>
						<p class="text-muted m-b-0 m-t-0"><?php echo $this->lang->line('totalComments'); ?></p>
					</div>
					<div class="table-detail text-right">
						<span data-plugin="peity-bar" data-colors="#34d3eb,#ebeff2" data-width="120" data-height="45"><?php if(isset($statsComments)) echo $statsComments; ?></span>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="card-box">
			<div class="bar-widget">
				<div class="table-box">

					<div class="table-detail">
						<h4 class="m-t-0 m-b-5"><b><?php if(isset($nbPlayed)) echo $nbPlayed; ?></b></h4>
						<p class="text-muted m-b-0 m-t-0"><?php echo $this->lang->line('totalPlayedGames'); ?></p>
					</div>
					<div class="table-detail text-right">
						<span data-plugin="peity-bar" data-colors="#34d3eb,#ebeff2" data-width="120" data-height="45"><?php if(isset($statsPlayed)) echo $statsPlayed; ?></span>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="card-box">

			<div class="row">
				<div class="col-md-8">

					<h4 class="text-dark header-title m-t-0"><?php echo $this->lang->line('playedGames'); ?></h4>

					<div class="text-center">
						<ul class="list-inline chart-detail-list">
							<li>
								<h5><i class="fa fa-circle m-r-5" style="color: #36404a;"></i><?php echo $this->lang->line('thisPeriod'); ?></h5>
							</li>
							<li>
								<h5><i class="fa fa-circle m-r-5" style="color: #5d9cec;"></i><?php echo $this->lang->line('prevPeriod'); ?></h5>
							</li>
						</ul>
					</div>

					<div id="morris-area-with-dotted" style="height: 300px;" data-played="<?php if(isset($statsPlayed)) echo $statsPlayed; ?>" data-last="<?php if(isset($lastMonthPlayed)) echo $lastMonthPlayed; ?>"></div>
				</div>


				<div class="col-md-4">
					<?php if(isset($getBestPlayedGames)) echo $getBestPlayedGames; ?>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<div class="card-box">

			<a href="<?php echo site_url('dashboard/comments/'); ?>" class="pull-right btn btn-default btn-sm waves-effect waves-light"><?php echo $this->lang->line('viewAll'); ?></a>
			<h4 class="text-dark header-title m-t-0"><?php echo $this->lang->line('latestComments'); ?></h4>
			<div class="table-responsive">
				<table class="table table-actions-bar m-b-0">
					<thead>
						<tr>
							<th><?php echo $this->lang->line('comments'); ?></th>
							<th><?php echo $this->lang->line('games'); ?></th>
							<th style="min-width: 80px;"><?php echo $this->lang->line('manage'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($getLastcomments)) echo $getLastcomments; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>	<!-- end col -->

	<div class="col-lg-6">
		<div class="card-box">

			<a href="<?php echo site_url('dashboard/games/'); ?>" class="pull-right btn btn-default btn-sm waves-effect waves-light"><?php echo $this->lang->line('viewAll'); ?></a>
			<h4 class="text-dark header-title m-t-0"><?php echo $this->lang->line('latestGamesAdd'); ?></h4>
			<div class="table-responsive">
				<table class="table table-actions-bar m-b-0">
					<thead>
						<tr>
							<th><?php echo $this->lang->line('games'); ?></th>
							<th><?php echo $this->lang->line('categories'); ?></th>
							<th style="min-width: 80px;"><?php echo $this->lang->line('manage'); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($getLastGamesAdded)) echo $getLastGamesAdded; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>	<!-- end col -->
</div>
