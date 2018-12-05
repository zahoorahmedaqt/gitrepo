<div class="row">
	<div class="col-sm-12">

		<?php if(isset($msg)) echo $msg; ?>

		<div class="card-box">

			<div class="row">
				<div class="col-sm-6">
					<form class="form" role="form" method="post" action="<?php echo current_url(); ?>">
						<div class="form-group">
							<label for="sitename"><?php echo $this->lang->line('sitename'); ?></label>
							<input type="text" class="form-control" name="sitename" value="<?php echo html_escape($this->config->item('sitename')); ?>" placeholder="Nom du site" />
						</div>
						<div class="form-group">
							<label for="logo"><?php echo $this->lang->line('logo'); ?></label> <small>(<a href="http://www.coffeetheme.com/forums/topic/how-to-change-the-logo/" target="_blank">How to change the logo ?</a>)</small>
							<input type="text" class="form-control" name="logo" value="<?php echo html_escape($this->config->item('logo')); ?>" placeholder="" />
						</div>
						<div class="form-group">
							<label for="emailsite"><?php echo $this->lang->line('email'); ?></label>
							<input type="email" id="emailsite" class="form-control" name="emailsite" value="<?php echo html_escape($this->config->item('emailsite')); ?>" placeholder="Email du site">
						</div>
						<div class="form-group">
							<label for="valide_inscrit"><?php echo $this->lang->line('inscriptions'); ?></label>
							<select class="form-control  selectpicker show-tick" data-style="btn-white" name="valide_inscrit">
								<option value="1" <?php if($this->config->item('valide_inscrit') == 1) echo 'selected="selected"'; ?>>Validation by email</option>
								<option value="0" <?php if($this->config->item('valide_inscrit') == 0) echo 'selected="selected"'; ?>>Automatic Validation</option>
							</select>
						</div>

						<div class="form-group">
							<label for="maintenance"><?php echo $this->lang->line('maintenance'); ?></label>
							<select class="form-control  selectpicker show-tick" data-style="btn-white" name="maintenance">
								<option value="1" <?php if($this->config->item('maintenance') == 1) echo 'selected="selected"'; ?>>Active</option>
								<option value="0" <?php if($this->config->item('maintenance') == 0) echo 'selected="selected"'; ?>>Inactive</option>
							</select>
						</div>
						<div class="form-group">
							<label for="maintenance_message"><?php echo $this->lang->line('maintenanceMessage'); ?></label>
							<textarea class="form-control" rows="5" name="maintenance_message" placeholder="<?php echo $this->lang->line('maintenanceMessage'); ?>"><?php echo html_escape($this->config->item('maintenance_message')); ?></textarea>
						</div>
						<div class="form-group">
							<label for="facebook">Facebook</label>
							<input type="url" class="form-control" name="facebook" value="<?php echo html_escape($this->config->item('facebook')); ?>" placeholder="https://www.facebook.com/your_page/" />
						</div>
						<div class="form-group">
							<label for="twitter">Twitter</label>
							<input type="url" class="form-control" name="twitter" value="<?php echo html_escape($this->config->item('twitter')); ?>" placeholder="https://twitter.com/your_account/" />
						</div>
						<div class="form-group">
							<label for="google">Google</label>
							<input type="url" class="form-control" name="google" value="<?php echo html_escape($this->config->item('google')); ?>" placeholder="https://plus.google.com/your_page/" />
						</div>
						<div class="form-group">
							<label for="roms"><?php echo $this->lang->line('acceptRoms'); ?></label>
							<select class="form-control  selectpicker show-tick" data-style="btn-white" name="roms">
								<option value="1" <?php if($this->config->item('roms') == 1) echo 'selected="selected"'; ?>>Yes</option>
								<option value="0" <?php if($this->config->item('roms') == 0) echo 'selected="selected"'; ?>>No</option>
							</select>
						</div>
						<div class="form-group m-b-20">
							<label for="termsOfUse"><?php echo $this->lang->line('termOfUse'); ?></label>
							<select class="form-control select2" name="termsOfUse"> <?php if(isset($getPages)) echo $getPages; ?> </select>
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
