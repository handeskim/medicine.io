<section class="content">
<div class="row">
	<?php 
	$user_data = $this->session->userdata('data_users');
	$authorities = $user_data['authorities'];
	if($authorities ==1|| $authorities == 2 || $authorities == 4){
	?>
	<div class="col-md-12">
		<div class="col-md-1">
			<a href="<?php echo base_url('cms/customer_management/addnew');?>" >
			<span class="info-box-icon bg-red"><i class="fa fa-user-plus"> </i></span></a>
		</div>
		<div class="col-md-1">
		</div>
		<div class="col-md-4">
		  <div class="info-box">
			<span class="info-box-icon bg-red"><i class="fa fa-user-secret"></i></span>
			<div class="info-box-content">
			  <span class="info-box-text">Total customers</span>
			  <span class="info-box-number">{total_customer}</span>
			</div>
		  </div>
		</div>
		<div class="col-md-1 ">
			<a target="_blank" href="<?php echo base_url()."excel_export?code=".$excel_command; ?>" >
				<span class="info-box-icon bg-yellow"><i class="fa fa-file-excel-o"></i></span>
			</a>
		</div>
	</div>
	<?php } ?>
	<div class="col-md-12 col-sm-12 col-xs-12">
	  <?php echo $content; ?>
	</div>
</div>
</section>