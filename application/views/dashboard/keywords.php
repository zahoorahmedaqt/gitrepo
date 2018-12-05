<div class="row">
	<div class="col-sm-12">
		<?php if(isset($msg)) echo $msg; ?>
		<div class="card-box table-responsive">
			<a href="<?php echo site_url('dashboard/keywords/add/'); ?>" class="btn btn-sm btn-primary waves-effect waves-light pull-right"><?php echo $this->lang->line('newKeyword'); ?></a>
			<table id="datatable-colvid" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th class="text-center"><?php echo $this->lang->line('id'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('keyword'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('url'); ?></th>
						<th class="text-center"><?php echo $this->lang->line('options'); ?></th>
					</tr>
				</thead>

				<tbody>
					<?php if(isset($getKeywords)) echo $getKeywords; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
