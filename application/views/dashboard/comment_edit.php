<div class="row">
	<div class="col-sm-12">

		<?php if(isset($msg)) echo $msg; ?>

		<div class="card-box">
			<form method="post" action="<?php echo current_url().'/'; ?>" role="form">
				<div class="row">

					<div class="col-sm-6">
						<div class="form-group m-b-20">
							<label for="author"><?php echo $this->lang->line('author') ?></label>
							<select class="form-control select2" name="author">
								<?php if(isset($getUsers)) echo $getUsers; ?>
							</select>
						</div>
						<div class="form-group m-b-20">
							<label for="comment"><?php echo $this->lang->line('comment') ?></label>
							<textarea type="text" class="form-control" name="comment" placeholder="Comment"><?php if(isset($comment)) echo $comment; ?></textarea>
						</div>
						<div class="form-group m-b-20">
							<label for="game"><?php echo $this->lang->line('game') ?></label>
							<select class="form-control select2" name="game">
								<?php if(isset($getGames)) echo $getGames; ?>
							</select>
						</div>
						<div class="form-group text-right m-b-0">
							<button class="btn btn-inverse waves-effect waves-light" type="submit"><?php echo $this->lang->line('submit') ?></button>
							<button type="reset" class="btn btn-default waves-effect waves-light m-l-5"><?php echo $this->lang->line('cancel') ?></button>
						</div>
					</div> <!-- End col -->

				</div> <!-- End row -->
			</form>
		</div> <!-- End card-box -->

	</div> <!-- End col -->
</div> <!-- End row -->
