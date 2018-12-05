<div class="row">
	<div class="col-sm-12">
		<?php if(isset($msg)) echo $msg; ?>

        <div class="row">
            <div class="col-sm-6">
                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b>Spilgames</b></h4>
                    <p class="text-muted m-b-30 font-13"><?php echo $this->lang->line('importYourGames') ?> Spilgames.com</p>
        			<form method="post" action="<?php echo current_url().'/'; ?>" role="form">
                        <div class="form-group m-b-20">
                            <label for="type"><?php echo $this->lang->line('gameType') ?></label>
                            <select class="form-control selectpicker show-tick" data-style="btn-white" name="type">
                                <option value="1">HTML5</option>
                                <option value="0">HTML5 & Flash</option>
                            </select>
                        </div>
                        <div class="form-group m-b-20">
    						<label for="category"><?php echo $this->lang->line('parentCategory') ?></label> <small>(<?php echo $this->lang->line('usedNewCategory') ?>)</small>
    						<select class="form-control select2" name="category"> <?php if(isset($getCategories)) echo $getCategories; ?> </select>
    					</div>
    					<div class="form-group text-right m-b-0">
							<button class="btn btn-danger waves-effect waves-light" type="submit" name="del" value="1"><?php echo $this->lang->line('delete') ?></button>
    						<button class="btn btn-inverse waves-effect waves-light" type="submit" name="spilgames" value="1"><?php echo $this->lang->line('import') ?></button>
    					</div>
        			</form>
        		</div> <!-- End card-box -->
            </div> <!-- End col -->

            <div class="col-sm-6">
                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b>Gamepix</b></h4>
                    <p class="text-muted m-b-30 font-13"><?php echo $this->lang->line('importYourGames') ?> gamepix.com</p>
        			<form method="post" action="<?php echo current_url().'/'; ?>" role="form">
                    <div class="form-group m-b-20">
						<label for="category"><?php echo $this->lang->line('parentCategory') ?></label> <small>(<?php echo $this->lang->line('usedNewCategory') ?>)</small>
						<select class="form-control select2" name="category"> <?php if(isset($getCategories)) echo $getCategories; ?> </select>
					</div>
					<div class="form-group text-right m-b-0">
						<button class="btn btn-danger waves-effect waves-light" type="submit" name="del" value="2"><?php echo $this->lang->line('delete') ?></button>
						<button class="btn btn-inverse waves-effect waves-light" type="submit" name="gamepix" value="1"><?php echo $this->lang->line('import') ?></button>
					</div>
        			</form>
        		</div> <!-- End card-box -->
            </div> <!-- End col -->
        </div> <!-- End row -->

		<div class="row">
            <div class="col-sm-6">
                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b>4j</b></h4>
                    <p class="text-muted m-b-30 font-13"><?php echo $this->lang->line('importYourGames') ?> 4j.com</p>
        			<form method="post" action="<?php echo current_url().'/'; ?>" role="form">
                        <div class="form-group m-b-20">
    						<label for="category"><?php echo $this->lang->line('parentCategory') ?></label> <small>(<?php echo $this->lang->line('usedNewCategory') ?>)</small>
    						<select class="form-control select2" name="category"> <?php if(isset($getCategories)) echo $getCategories; ?> </select>
    					</div>
    					<div class="form-group text-right m-b-0">
							<button class="btn btn-danger waves-effect waves-light" type="submit" name="del" value="3"><?php echo $this->lang->line('delete') ?></button>
    						<button class="btn btn-inverse waves-effect waves-light" type="submit" name="4j" value="1"><?php echo $this->lang->line('import') ?></button>
    					</div>
        			</form>
        		</div> <!-- End card-box -->
            </div> <!-- End col -->

			<div class="col-sm-6">
                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b>Tresensa</b></h4>
                    <p class="text-muted m-b-30 font-13"><?php echo $this->lang->line('importYourGames') ?> tresensa.com</p>
        			<form method="post" action="<?php echo current_url().'/'; ?>" role="form">
                        <div class="form-group m-b-20">
    						<label for="category"><?php echo $this->lang->line('parentCategory') ?></label> <small>(<?php echo $this->lang->line('usedNewCategory') ?>)</small>
    						<select class="form-control select2" name="category"> <?php if(isset($getCategories)) echo $getCategories; ?> </select>
    					</div>
    					<div class="form-group text-right m-b-0">
							<button class="btn btn-danger waves-effect waves-light" type="submit" name="del" value="4"><?php echo $this->lang->line('delete') ?></button>
    						<button class="btn btn-inverse waves-effect waves-light" type="submit" name="tresensa" value="1"><?php echo $this->lang->line('import') ?></button>
    					</div>
        			</form>
        		</div> <!-- End card-box -->
            </div> <!-- End col -->
        </div> <!-- End row -->

	</div> <!-- End col -->
</div> <!-- End row -->

<?php
var_dump($json);
?>
