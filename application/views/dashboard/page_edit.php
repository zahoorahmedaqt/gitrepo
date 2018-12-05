<div class="row">
	<div class="col-sm-12">

		<?php if(isset($msg)) echo $msg; ?>

		<div class="card-box">
			<div class="row">

				<div class="col-sm-9">
					<form method="post" action="<?php echo current_url().'/'; ?>" role="form">
						<div class="form-group m-b-20">
							<label for="title"><?php echo $this->lang->line('pageTitle'); ?></label>
							<input type="text" class="form-control" name="title" placeholder="Game title" value="<?php if(isset($title_page)) echo $title_page; ?>">
						</div>
						<div class="form-group m-b-20">
							<label for="url"><?php echo $this->lang->line('pageUrl'); ?></label> <span class="text-muted">(<?php echo $this->lang->line('optional'); ?>)</span>
							<input type="text" class="form-control" name="url" placeholder="Game URL" value="<?php if(isset($url_page)) echo $url_page; ?>">
						</div>
						<div class="form-group m-b-20">
							<label for="content"><?php echo $this->lang->line('pageContent'); ?></label>
							<textarea type="text" id="cnt1" class="form-control" name="content"><?php if(isset($content_page)) echo $content_page; ?></textarea>
						</div>

						<div class="form-group text-right m-b-0">
							<button class="btn btn-inverse waves-effect waves-light" type="submit"><?php echo $this->lang->line('submit'); ?></button>
							<button type="reset" class="btn btn-default waves-effect waves-light m-l-5"><?php echo $this->lang->line('cancel'); ?></button>
						</div>
					</form>
				</div> <!-- End col -->

				<?php if($this->uri->segment(3, 0) === 'edit') { ?>
				<div class="col-sm-3">
					<form method="post" action="<?php echo current_url().'/'; ?>" role="form" enctype="multipart/form-data" accept-charset="utf-8">
						<div class="form-group m-b-20">
							<label class="control-label"><?php echo $this->lang->line('displayFooter'); ?></label>
							<select class="form-control selectpicker show-tick" data-style="btn-white" name="displayFooter">
								<option value="1" <?php if($display_footer === '1') echo 'selected'; ?>><?php echo $this->lang->line('active'); ?></option>
								<option value="0" <?php if($display_footer === '0') echo 'selected'; ?>><?php echo $this->lang->line('inactive'); ?></option>
							</select>
						</div>
						<div class="form-group text-right m-b-0">
							<button class="btn btn-inverse waves-effect waves-light" type="submit"><?php echo $this->lang->line('submit'); ?></button>
						</div>
					</form>
				</div> <!-- End col -->
				<?php } ?>

			</div> <!-- End row -->
		</div> <!-- End card-box -->

	</div> <!-- End col -->
</div> <!-- End row -->
