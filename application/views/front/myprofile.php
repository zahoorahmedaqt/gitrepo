<section>
	<div class="container">

		<div class="row m-t-20">
			<div class="col-md-4 col-lg-3">

				<div class="profile-detail card-box">
					<div>
						<img src="<?php echo ($image) ? site_url('uploads/images/users/'.$image) : site_url('assets/images/default-user.png'); ?>" class="img-circle" alt="<?php if(isset($username)) echo $username; ?>">

						<h4 class="text-uppercase font-600 m-t-30"><?php echo $this->lang->line('aboutMe'); ?></h4>
						<p class="text-muted font-13 m-b-30">
							<?php if(isset($about)) echo $about; ?>
						</p>

						<div class="text-left">
							<p class="text-muted font-13"><strong><?php echo $this->lang->line('username'); ?> :</strong> <span class="m-l-15"><?php if(isset($username)) echo $username; ?></span></p>
							<?php if($location) echo '<p class="text-muted font-13"><strong>'.$this->lang->line('location').' :</strong> <span class="m-l-15">'.$location.'</span></p>'; ?>
						</div>

						<div class="button-list m-t-20">
							<?php if(isset($facebook)) { ?>
							<a href="<?php echo $facebook; ?>" class="btn btn-facebook waves-effect waves-light"><i class="fa fa-facebook"></i></a>
							<?php } ?>
							<?php if(isset($twitter)) { ?>
							<a href="<?php echo $twitter; ?>" class="btn btn-twitter waves-effect waves-light"><i class="fa fa-twitter"></i></a>
							<?php } ?>
							<?php if(isset($google)) { ?>
							<a href="<?php echo $google; ?>" class="btn btn-googleplus waves-effect waves-light"><i class="fa fa-google"></i></a>
							<?php } ?>
							<?php if(isset($linkedin)) { ?>
							<a href="<?php echo $linkedin; ?>" class="btn btn-linkedin waves-effect waves-light"><i class="fa fa-linkedin"></i></a>
							<?php } ?>
						</div>
					</div>

				</div>

			</div>

			<div class="col-lg-9 col-md-8">

				<?php
				if(isset($msg)) echo $msg;
				if(isset($error)) echo alert($error, 'danger');
				?>

				<div class="card-box">
					<div class="row">
						<div class="col-sm-12 col-lg-8">
							<form class="form" role="form" method="post" action="<?php echo current_url(); ?>">
								<div class="form-group">
									<label for="author"><?php echo $this->lang->line('username'); ?></label>
									<input type="text" class="form-control" name="username" value="<?php if(isset($username)) echo $username; ?>" placeholder="Username" />
								</div>
								<div class="form-group">
									<label for="author"><?php echo $this->lang->line('email'); ?></label> <small>(<?php echo $this->lang->line('private'); ?>)</small>
									<input type="text" class="form-control" name="email" value="<?php if(isset($email)) echo $email; ?>" placeholder="Email" />
								</div>
								<div class="form-group">
									<label for="author"><?php echo $this->lang->line('location'); ?></label>
									<input type="text" class="form-control" name="location" value="<?php if(isset($location)) echo $location; ?>" placeholder="Country" />
								</div>
								<div class="form-group">
									<label for="description"><?php echo $this->lang->line('aboutMe'); ?></label>
									<textarea class="form-control" rows="5" name="about"><?php if(isset($about)) echo $about; ?></textarea>
								</div>
								<div class="form-group">
									<label for="keywords"><?php echo $this->lang->line('facebook'); ?></label>
									<input type="url" class="form-control" name="facebook" value="<?php if(isset($facebook)) echo $facebook; ?>" placeholder="https://www.facebook.com/myprofile" />
								</div>
								<div class="form-group">
									<label for="keywords"><?php echo $this->lang->line('twitter'); ?></label>
									<input type="url" class="form-control" name="twitter" value="<?php if(isset($twitter)) echo $twitter; ?>" placeholder="https://www.twitter.com/myprofile" />
								</div>
								<div class="form-group">
									<label for="keywords"><?php echo $this->lang->line('google'); ?></label>
									<input type="url" class="form-control" name="google" value="<?php if(isset($google)) echo $google; ?>" placeholder="https://plus.google.com/myprofile" />
								</div>
								<div class="form-group">
									<label for="keywords"><?php echo $this->lang->line('linkedin'); ?></label>
									<input type="url" class="form-control" name="linkedin" value="<?php if(isset($linkedin)) echo $linkedin; ?>" placeholder="https://www.linkedin.com/in/myprofile" />
								</div>
								<div class="form-group">
									<label for="auth_coms"><?php echo $this->lang->line('commentsOnYourProfile'); ?></label>
									<select class="form-control" name="auth_coms">
										<option value="1" <?php if($auth_coms == 1) echo 'selected="selected"'; ?>><?php echo $this->lang->line('yes'); ?></option>
										<option value="0" <?php if($auth_coms == 0) echo 'selected="selected"'; ?>><?php echo $this->lang->line('no'); ?></option>
									</select>
								</div>
								<div class="form-group text-right m-b-0">
									<button class="btn btn-inverse waves-effect waves-light" type="submit"><?php echo $this->lang->line('submit'); ?></button>
									<button type="reset" class="btn btn-default waves-effect waves-light m-l-5"><?php echo $this->lang->line('cancel'); ?></button>
								</div>
							</form>
						</div> <!-- End col -->
						<div class="col-sm-12 col-lg-4">
							<form method="post" action="<?php echo current_url().'/'; ?>" role="form" enctype="multipart/form-data" accept-charset="utf-8">
								<div class="form-group m-b-20">
									<label class="control-label"><?php echo $this->lang->line('imageProfile'); ?></label> <span class="text-muted">(.gif, .jpg, .png)</span>
									<input type="file" name="userImage" class="filestyle" data-buttontext="Select file" data-buttonname="btn-inverse" data-placeholder="<?php if(isset($image)) echo $image; ?>">
								</div>
								<div class="form-group text-right m-b-0">
									<button class="btn btn-inverse waves-effect waves-light" type="submit" name="submit"><?php echo $this->lang->line('submit'); ?></button>
									<button class="btn btn-danger waves-effect waves-light" type="submit" name="delete"><?php echo $this->lang->line('cancel'); ?></button>
								</div>
							</form>
						</div> <!-- End col -->
					</div> <!-- End row -->
				</div>

			</div> <!-- end container -->
		</section>
