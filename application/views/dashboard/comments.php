<div class="row">
	<div class="col-sm-12">
		<div class="card-box table-responsive">
			<a href="<?php echo site_url('dashboard/comments/add/'); ?>" class="btn btn-sm btn-primary waves-effect waves-light pull-right"><?php echo $this->lang->line('newComment') ?></a>
			<table id="datatable-colvid" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="text-center"><?php echo $this->lang->line('id') ?></th>
						<th class="text-center"><?php echo $this->lang->line('author') ?></th>
						<th class="text-center"><?php echo $this->lang->line('comments') ?></th>
						<th class="text-center"><?php echo $this->lang->line('game') ?></th>
						<th class="text-center"><?php echo $this->lang->line('dateCreation') ?></th>
						<th class="text-center"><?php echo $this->lang->line('ip') ?></th>
						<th class="text-center"><?php echo $this->lang->line('options') ?></th>
					</tr>
				</thead>

				<tbody>
					<?php if(isset($getComments)) echo $getComments; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
