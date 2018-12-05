<div class="row">
	<div class="col-sm-12">

		<?php if(isset($msg)) echo $msg; ?>

		<div class="card-box">

			<div class="row">
				<div class="col-sm-6">
					<form method="post" action="<?php echo current_url().'/'; ?>" role="form">
						<div class="form-group m-b-20">
							<label for="title"><?php echo $this->lang->line('categoryTitle'); ?></label>
							<input type="text" class="form-control" id="" name="title" placeholder="Category title" value="<?php if(isset($title_categorie)) echo $title_categorie; ?>">
						</div>
						<div class="form-group m-b-20">
							<label for="url"><?php echo $this->lang->line('categoryUrl'); ?></label> <span class="text-muted">(<?php echo $this->lang->line('optional'); ?>)</span>
							<input type="text" class="form-control" id="" name="url" placeholder="Category URL" value="<?php if(isset($url_categorie)) echo $url_categorie; ?>">
						</div>
						<div class="form-group m-b-20">
							<label for="parent_cat"><?php echo $this->lang->line('parentCategory'); ?></label>
							<select class="form-control select2" name="parent_cat">
								<?php if(isset($getListCats)) echo $getListCats; ?>
							</select>
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
