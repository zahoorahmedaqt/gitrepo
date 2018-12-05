<div class="row">
	<div class="col-sm-12">
		<div class="card-box table-responsive">
			<a href="<?php echo site_url('dashboard/games/add/'); ?>" class="btn btn-sm btn-primary waves-effect waves-light pull-right"><?php echo $this->lang->line('newGame'); ?></a>
			<table id="datatable-colvid" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="text-center"><?php echo $this->lang->line('id'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('game'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('category'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('played'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('status'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('uploaded'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('options'); ?></th>
					</tr>
				</thead>

				<tbody>
					<?php if(isset($getGames)) echo $getGames; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
