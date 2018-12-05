<div class="row">
	<div class="col-sm-12">

		<?php
		if(isset($msg)) echo $msg;
		if(isset($error)) echo alert($error, 'danger');
		?>

		<div class="card-box">
			<form method="post" action="<?php echo current_url().'/'; ?>" role="form">
				<div class="row">

					<div class="col-sm-9">
						<div class="form-group m-b-20">
							<label for="username"><?php echo $this->lang->line('username'); ?></label>
							<input type="text" class="form-control" name="username" placeholder="<?php echo $this->lang->line('username'); ?>" value="<?php if(isset($username)) echo $username; ?>">
						</div>
						<div class="form-group m-b-20">
							<label for="email"><?php echo $this->lang->line('email'); ?></label>
							<input type="email" class="form-control" name="email" placeholder="<?php echo $this->lang->line('email'); ?>" value="<?php if(isset($email)) echo $email; ?>">
						</div>

						<?php if($this->uri->segment(3) === 'edit') { ?>

							<form method="post" action="<?php echo current_url().'/'; ?>" role="form">
								<div class="form-group m-b-20">
									<label for="password"><?php echo $this->lang->line('password'); ?></label> <span class="text-muted">(<?php echo $this->lang->line('password'); ?>)</span>
									<div class="input-group">
										<input name="newPassword" class="form-control" placeholder="<?php echo $this->lang->line('password'); ?>" type="password">
										<span class="input-group-btn">
										<button type="submit" class="btn waves-effect waves-light btn-inverse"><?php echo $this->lang->line('submit'); ?></button>
										</span>
									</div>
								</div> <!-- form-group -->
							</form>

						<?php } else { ?>

							<div class="form-group m-b-20">
								<label for="password"><?php echo $this->lang->line('password'); ?></label>
								<input type="password" class="form-control" name="password" placeholder="<?php echo $this->lang->line('password'); ?>" value="<?php if(isset($password)) echo $password; ?>">
							</div>

						<?php } ?>

						<div class="form-group m-b-20">
							<label for="status"><?php echo $this->lang->line('userStatus'); ?></label>
							<select class="form-control selectpicker show-tick" data-style="btn-white" name="status">
								<option value="1" <?php if($status === '1') echo 'selected'; ?>><?php echo $this->lang->line('active'); ?></option>
								<option value="0" <?php if($status === '0') echo 'selected'; ?>><?php echo $this->lang->line('inactive'); ?></option>
							</select>
						</div>
						<div class="form-group m-b-20">
							<label for="role"><?php echo $this->lang->line('userRole'); ?></label>
							<select class="form-control selectpicker show-tick" data-style="btn-white" name="role">
								<option value="0" <?php if($role === '0') echo 'selected';?>><?php echo $this->lang->line('member'); ?></option>
								<option value="1" <?php if($role === '1') echo 'selected';?>><?php echo $this->lang->line('administrator'); ?></option>
							</select>
						</div>
						<div class="form-group text-right m-b-0">
							<button class="btn btn-inverse waves-effect waves-light" type="submit"><?php echo $this->lang->line('submit'); ?></button>
							<button type="reset" class="btn btn-default waves-effect waves-light m-l-5"><?php echo $this->lang->line('cancel'); ?></button>
						</div>
					</div> <!-- End col -->

					<?php if($this->uri->segment(3, 0) === 'edit') { ?>
					<div class="col-sm-3">
						<form method="post" action="<?php echo current_url().'/'; ?>" role="form" enctype="multipart/form-data" accept-charset="utf-8">
							<div class="form-group m-b-20">
								<label class="control-label"><?php echo $this->lang->line('userImageProfil'); ?></label>
								<input type="file" name="userImage" class="filestyle" data-buttontext="Select file" data-buttonname="btn-inverse" data-placeholder="<?php if(isset($name_image)) echo $name_image; ?>">
								<input type="hidden" name="hiddenImage">
							</div>
							<div class="form-group text-right m-b-0">
								<button class="btn btn-inverse waves-effect waves-light" type="submit"><?php echo $this->lang->line('submit'); ?></button>
							</div>
						</form>
					</div> <!-- End col -->
					<?php } ?>

				</div> <!-- End row -->
			</form>
		</div> <!-- End card-box -->

	</div> <!-- End col -->
</div> <!-- End row -->
