<?php if(isset($msg)) echo $msg; ?>
<div class="card-box">
	<div class="row">
		<div class="col-sm-12">
			<div class="row">
				<div class="col-sm-12">
					<?php echo (!empty($getImages)) ? $getImages : $this->lang->line('noData'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 text-right">
					<?php if(isset($pagination)) echo $pagination; ?>
				</div>
			</div>
		</div>
	</div> <!-- End row -->
</div> <!-- End card-box -->
<div class="card-box">
	<div class="row">
		<div class="col-sm-12">
			<div class="card-box table-responsive">
				<table id="datatable-fixed-header" class="table table-striped table-bordered dataTable no-footer">
					<thead>
						<tr>
							<th class="text-center"><?php echo $this->lang->line('file') ?></th>
							<th class="text-center"><?php echo $this->lang->line('game') ?></th>
							<th class="text-center"><?php echo $this->lang->line('options') ?></th>
						</tr>
					</thead>
					<tbody>
						<?php if(isset($getFiles)) echo $getFiles; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div> <!-- End row -->
</div> <!-- End card-box -->
