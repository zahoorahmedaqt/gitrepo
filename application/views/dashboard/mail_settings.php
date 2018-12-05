<div class="row">
	<div class="col-sm-12">

		<?php if(isset($msg)) echo $msg; ?>

		<div class="card-box">

			<div class="row">
				<div class="col-sm-6">
					<form class="form" role="form" method="post" action="/settings/mail/">
						<div class="form-group">
						    <label for="titleMailConfirmation"><?php echo $this->lang->line('titleConfirmInscription'); ?></label>
						    <input type="text" class="form-control" id="titleMailConfirmation" name="titleMailConfirmation" placeholder="Title" value="<?php echo $this->config->item('titleMailConfirmation'); ?>">
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('titleConfirmInscription'); ?></label> <small>(<?php echo $this->lang->line('use'); ?> %url% <?php echo $this->lang->line('tagInc'); ?>)</small>
							<textarea class="form-control" rows="5" name="mailConfirmation"><?php echo $this->config->item('mailConfirmation'); ?></textarea>
						</div>
						<div class="form-group">
						    <label for="titleMailWelcome"><?php echo $this->lang->line('titleMailWelcome'); ?></label>
						    <input type="text" class="form-control" id="titleMailWelcome"  name="titleMailWelcome" placeholder="<?php echo $this->lang->line('titleMailWelcome'); ?>" value="<?php echo $this->config->item('titleMailWelcome'); ?>">
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('mailWelcome'); ?></label>
							<textarea class="form-control" rows="5" name="mailWelcome"><?php echo $this->config->item('mailWelcome'); ?></textarea>
						</div>
						<div class="form-group">
						    <label for="titleMailRecovery"><?php echo $this->lang->line('titleMailPassword'); ?></label>
						    <input type="text" class="form-control" id="titleMailRecovery" name="titleMailRecovery" placeholder="<?php echo $this->lang->line('titleMailPassword'); ?>" value="<?php echo $this->config->item('titleMailRecovery'); ?>">
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('mailPassword'); ?></label> <small>(<?php echo $this->lang->line('use'); ?> %url% <?php echo $this->lang->line('tagInc'); ?>)</small>
							<textarea class="form-control" rows="5" name="mailRecovery"><?php echo $this->config->item('mailRecovery'); ?></textarea>
						</div>
						<div class="form-group">
						    <label for="titleMailPasswordChanged"><?php echo $this->lang->line('titleMailPasswordChanged'); ?></label>
						    <input type="text" class="form-control" id="titleMailPasswordChanged" name="titleMailPasswordChanged" placeholder="<?php echo $this->lang->line('titleMailPasswordChanged'); ?>" value="<?php echo $this->config->item('titleMailPasswordChanged'); ?>">
						</div>
						<div class="form-group">
							<label><?php echo $this->lang->line('mailPasswordChanged'); ?></label> <small>(<?php echo $this->lang->line('use'); ?> %url% <?php echo $this->lang->line('tagInc'); ?>)</small>
							<textarea class="form-control" rows="5" name="mailPasswordChanged"><?php echo $this->config->item('mailPasswordChanged'); ?></textarea>
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
