<div class="row">
	<div class="col-sm-12">

		<?php if(isset($msg)) echo $msg; ?>

		<div class="card-box">

			<div class="row">
				<div class="col-sm-8">
					<form method="post" action="<?php echo current_url().'/'; ?>" role="form">
						<div class="form-group m-b-20">
							<label for="title"><?php echo $this->lang->line('sidebarAdContent'); ?></label>
							<textarea class="form-control" name="sidebarcontent" rows="3"><?php echo $this->config->item('sidebarcontent'); ?></textarea>
						</div>
						<div class="form-group m-b-20">
							<label for="title"><?php echo $this->lang->line('sidebarAdTop'); ?></label>
							<textarea class="form-control" name="sidebartop" rows="3"><?php echo $this->config->item('sidebartop'); ?></textarea>
						</div>
						<div class="form-group m-b-20">
							<label for="title"><?php echo $this->lang->line('sidebarAdBottom'); ?></label>
							<textarea class="form-control" name="sidebarbottom" rows="3"><?php echo $this->config->item('sidebarbottom'); ?></textarea>
						</div>
						<div class="form-group text-right m-b-0">
							<button class="btn btn-inverse waves-effect waves-light" type="submit"><?php echo $this->lang->line('submit'); ?></button>
							<button type="reset" class="btn btn-default waves-effect waves-light m-l-5"><?php echo $this->lang->line('cancel'); ?></button>
						</div>
					</form>
				</div> <!-- End col -->
			</div> <!-- End row -->

		</div> <!-- End card-box -->

	</div> <!-- End col -->
</div> <!-- End row -->
