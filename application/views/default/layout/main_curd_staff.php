<section class="content">
<div class="row">
	<div class="col-md-12">
		<div class="col-md-1">
			<a href="<?php echo base_url('cms/staff/addnew');?>" >
			<span class="info-box-icon bg-red"><i class="fa fa-user-plus"> </i></span></a>
		</div>
		<div class="col-md-1">
		</div>
		<div class="col-md-1">
			<a target="_blank" href="<?php echo base_url()."excel_export?code=".$excel_command; ?>" >
				<span class="info-box-icon bg-yellow"><i class="fa fa-file-excel-o"></i></span>
			</a>
		</div>
	</div>
	<div class="col-lg-12 col-xs-12">
      <?php echo $content; ?>
	</div>
</div>
</section>