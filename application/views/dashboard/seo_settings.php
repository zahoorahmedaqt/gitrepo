<div class="row">
	<div class="col-sm-12">

		<?php if(isset($msg)) echo $msg; ?>

		<div class="card-box">

			<div class="row">
				<div class="col-sm-6">
					<form class="form" role="form" method="post" action="/settings/seo/">
						<div class="form-group">
							<label for="author"><?php echo $this->lang->line('author'); ?></label>
							<input type="text" class="form-control" name="author" value="<?php echo $this->config->item('author'); ?>" />
						</div>
						<div class="form-group">
							<label for="keywords"><?php echo $this->lang->line('keywords'); ?></label>
							<input type="text" class="form-control" name="keywords" value="<?php echo $this->config->item('keywords'); ?>" />
						</div>
						<div class="form-group">
							<label for="description"><?php echo $this->lang->line('description'); ?></label>
							<textarea class="form-control" rows="5" name="description"><?php echo $this->config->item('description'); ?></textarea>
						</div>
						<div class="form-group">
							<label for="home_nb"><?php echo $this->lang->line('numberColHome'); ?></label>
							<select class="form-control  selectpicker show-tick" data-style="btn-white" name="home_nb">
								<option value="10" <?php if($this->config->item('home_nb') == 10) echo 'selected="selected"'; ?>>10</option>
								<option value="9" <?php if($this->config->item('home_nb') == 9) echo 'selected="selected"'; ?>>9</option>
								<option value="8" <?php if($this->config->item('home_nb') == 8) echo 'selected="selected"'; ?>>8</option>
								<option value="7" <?php if($this->config->item('home_nb') == 7) echo 'selected="selected"'; ?>>7</option>
								<option value="6" <?php if($this->config->item('home_nb') == 6) echo 'selected="selected"'; ?>>6</option>
								<option value="5" <?php if($this->config->item('home_nb') == 5) echo 'selected="selected"'; ?>>5</option>
							</select>
						</div>
						<div class="form-group">
							<label for="cat_nb"><?php echo $this->lang->line('numberColCat'); ?></label>
							<select class="form-control  selectpicker show-tick" data-style="btn-white" name="cat_nb">
								<option value="12" <?php if($this->config->item('cat_nb') == 12) echo 'selected="selected"'; ?>>1</option>
								<option value="6" <?php if($this->config->item('cat_nb') == 6) echo 'selected="selected"'; ?>>2</option>
								<option value="4" <?php if($this->config->item('cat_nb') == 4) echo 'selected="selected"'; ?>>3</option>
								<option value="3" <?php if($this->config->item('cat_nb') == 3) echo 'selected="selected"'; ?>>4</option>
								<option value="2" <?php if($this->config->item('cat_nb') == 2) echo 'selected="selected"'; ?>>6</option>
								<option value="1" <?php if($this->config->item('cat_nb') == 1) echo 'selected="selected"'; ?>>12</option>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label"><?php echo $this->lang->line('homePagination'); ?></label>
							<input class="vertical-spin" type="text" value="<?php echo $this->config->item('home_pag'); ?>" name="home_pag">
						</div>
						<div class="form-group">
							<label class="control-label"><?php echo $this->lang->line('categoryPagination'); ?></label>
							<input class="vertical-spin" type="text" value="<?php echo $this->config->item('cat_pag'); ?>" name="cat_pag">
						</div>
						<div class="form-group">
							<label class="control-label"><?php echo $this->lang->line('commentsPagination'); ?></label>
							<input class="vertical-spin" type="text" value="<?php echo $this->config->item('coms_pag'); ?>" name="coms_pag">
						</div>
						<div class="form-group">
							<label class="control-label"><?php echo $this->lang->line('profilePagination'); ?></label> <small>(<?php echo $this->lang->line('seeMore'); ?>)</small>
							<input class="vertical-spin" type="text" value="<?php echo $this->config->item('more_pag'); ?>" name="more_pag">
						</div>
						<div class="form-group">
							<label for="google_analytics">Google analytics</label>
							<textarea class="form-control" rows="10" name="google_analytics" placeholder="Google analytics code"><?php echo $this->config->item('google_analytics'); ?></textarea>
						</div>
						<div class="form-group">
							<label for="maintenance">Cache</label>
							<select class="form-control  selectpicker show-tick" data-style="btn-white" name="cache_activation">
								<option value="1" <?php if($this->config->item('cache_activation') == 1) echo 'selected="selected"'; ?>><?php echo $this->lang->line('active'); ?></option>
								<option value="0" <?php if($this->config->item('cache_activation') == 0) echo 'selected="selected"'; ?>><?php echo $this->lang->line('inactive'); ?></option>
								<option value="2" <?php if($this->config->item('cache_activation') == 2) echo 'selected="selected"'; ?>><?php echo $this->lang->line('dlete'); ?></option>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label"><?php echo $this->lang->line('cacheExpiration'); ?></label> <small>(<?php echo $this->lang->line('numberOfMinutes'); ?>)</small>
							<input class="vertical-spin" type="text" value="<?php echo $this->config->item('cache_expire'); ?>" name="cache_expire">
						</div>
						<div class="form-group text-right m-b-0">
							<button class="btn btn-inverse waves-effect waves-light" type="submit"><?php echo $this->lang->line('submit'); ?></button>
							<button type="reset" class="btn btn-default waves-effect waves-light m-l-5"><?php echo $this->lang->line('cancel'); ?></button>
						</div>
					</form>
				</div> <!-- End col -->
			</div> <!-- End row -->

		</div> <!-- End card-box -->

		<div class="card-box">

			<div class="row">
				<div class="col-sm-6">
					<form class="form-horizontal" role="form" method="post" action="/settings/seo/">
						<h2 class="m-t-0 header-title"><b>Sitemap</b></h2>
						<p class="text-muted font-13"><?php echo $this->lang->line('generateSitemap'); ?></p>
						<?php if(isset($msg2)) echo $msg2; ?>
						<input type="hidden" name="sitemap" />
						<button type="submit" id="sa-basic" class="btn btn-inverse w-md waves-effect waves-light m-b-5"> <i class="fa fa-rocket m-r-5"></i> <span><?php echo $this->lang->line('sitemapGeneration'); ?></span> </button>
						<a href="/sitemap.xml" target="_blank"><button type="button" id="sa-basic" class="btn btn-inverse w-md waves-effect waves-light m-b-5"><span><?php echo $this->lang->line('viewSitemap'); ?></span></button></a>
					</form>
				</div> <!-- End col -->
			</div> <!-- End row -->

		</div> <!-- End card-box -->

	</div> <!-- End col -->
</div> <!-- End row -->
