 <div class="row">
            <div class="col-sm-6">
                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b>Add Header Image</b></h4>
                    <p class="text-muted m-b-30 font-13"><?php echo $this->lang->line('header_logo') ?> </p>
                <?php echo $error; ?>
                    <form method="post" action="<?php echo base_url('pages/add_image'); ?>" role="form" enctype="multipart/form-data">
                        <div class="form-group mb-5">
                            <label for="file">Upload Header Image <?php //echo $this->lang->line('gameType') ?></label>           
                            <input type="file" name="header_file" required>
                        </div>
                            <div class="form-group text-right m-b-0">                          
                            <button class="btn btn-inverse waves-effect waves-light" type="submit" name="header_img" value="1"><?php echo $this->lang->line('submit') ?></button>
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