<section>
	<div class="container">

		<div class="row m-t-20">

			<div class="col-sm-12 col-lg-9 col-md-12">
				<div class="card-box">
					<h3 class="m-t-0"><?php if(isset($title)) echo $title; ?></h3>
					<?php if(isset($content)) echo $content; ?>
				</div>
			</div>

			<div class="col-sm-12 col-lg-3 col-md-12">
				<div class="panel panel-color panel-inverse">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo $this->lang->line('publicity'); ?></h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12">
								<?php echo $this->config->item('sidebartop'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div> <!-- end row -->

	</div> <!-- end container -->
</section>
