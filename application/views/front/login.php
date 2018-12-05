<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
	<div class="landing-box">
		<div class="panel-heading account-logo-box">
			<h3 class="text-center"><a href="<?php echo site_url(); ?>" class="logo account"><?php if(NULL!==$this->config->item('logo')) echo $this->config->item('logo'); ?></a></h3>
		</div>

		<div class="panel-body">

			<div class="text-center"><?php if(isset($msg)) echo $msg; ?></div>

			<form class="form-horizontal m-t-20" action="<?php echo site_url('login/'); ?>" method="post">
				<div class="form-group ">
					<div class="col-xs-12">
						<input class="form-control" type="email" name="email" required="" placeholder="<?php echo $this->lang->line('email'); ?>" <?php if(isset($rememberMe)) echo 'value="'.$rememberMe.'"'; ?>>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12">
						<input class="form-control" type="password" name="password" required="" placeholder="<?php echo $this->lang->line('password'); ?>" value="<?php if($this->config->item('demo')) echo 'password'; ?>">
					</div>
				</div>

				<div class="form-group ">
					<div class="col-xs-12">
						<div class="checkbox checkbox-primary">
							<input id="checkbox-signup" type="checkbox" name="rememberme" value="true" <?php if(isset($rememberMe)) echo 'checked'; ?>>
							<label for="checkbox-signup">
								<?php echo $this->lang->line('rememberMe'); ?>
							</label>
						</div>

					</div>
				</div>

				<div class="form-group text-center m-t-40">
					<div class="col-xs-12">
						<button class="btn btn-primary w-lg text-uppercase waves-effect waves-light" type="submit"><?php echo $this->lang->line('login'); ?></button>
					</div>
				</div>

				<div class="form-group m-t-30 m-b-0">
					<div class="col-sm-12">
						<a href="<?php echo site_url('login/recovery/'); ?>" class="text-dark"><i class="fa fa-lock m-r-5"></i> <?php echo $this->lang->line('forgotPassword'); ?></a>
					</div>
				</div>
			</form>

		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 text-center">
			<p><?php echo $this->lang->line('dontHaveAccount'); ?> <a href="<?php echo site_url('login/register/'); ?>" class="text-primary m-l-5"><b><?php echo $this->lang->line('signup'); ?></b></a></p>
		</div>
	</div>

</div>
