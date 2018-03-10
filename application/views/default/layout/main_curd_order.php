
<section class="content">
<div class="row">
	<?php 
	$user_data = $this->session->userdata('data_users');
	$authorities = $user_data['authorities'];

		if($authorities ==1 || $authorities == 2 || $authorities ==4){
	?>
	<div class="col-md-12">
		<div class="col-md-1">
			<a href="<?php echo base_url('cms/order_new');?>" >
			<span class="info-box-icon bg-blue"><i class="fa fa-cart-plus"> </i></span></a>
		</div>
		<div class="col-md-1">
		</div>
		
	</div>
	<?php } ?>
  <div class="col-md-12">
      <?php echo $content; ?>
  </div>
</div>
</section>
