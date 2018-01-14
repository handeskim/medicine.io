<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
	<div class="pull-left image">
		<?php 
			$user_data = $this->session->userdata('data_users');
			if(isset($user_data)){
				if(isset($user_data['hinh_anh'])){
					if(!empty($user_data['hinh_anh'])){
						$img_awata = "assets/xcrud/upload/staff/".$user_data['hinh_anh'];
					}else{
						$img_awata = "public/images/avata/default.png";
					}
				}else{
					$img_awata = "public/images/avata/default.png";
				}
			}else{
				$img_awata = "public/images/avata/default.png";
			}
		?>
	  <img src="<?php echo base_url().$img_awata;?>" class="img-circle" alt="User Image">
	</div>
	<div class="pull-left info">
	  <p></p>
	  <a href="#"><?php echo $user_data["email"]; ?></a><br>
	</div>
	
  </div>
  <!-- search form -->
  
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  
  <ul class="sidebar-menu" data-widget="tree">
	
	<li class="header">Dashboard</li>
	<li class="treeview">
		<a href="#">
		<i class="fa fa-briefcase"></i> <span>Customer</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url();?>cms/Customer_Management"><i class="fa fa-user-secret"></i> Customer Management</a></li>
			<li><a href="<?php echo base_url();?>cms/Scheduling"><i class="fa fa-history"></i> Scheduling Callback</a></li>
		</ul>
	</li>
	<li class="treeview">
		<a href="#">
		<i class="fa fa-shopping-cart"></i> <span>Oders</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url();?>cms/Oders_Management"><i class="fa fa-shopping-cart"></i> Orders Management</a></li>

		</ul>
	</li>
	<li class="treeview">
		<a href="#">
		<i class="fa fa-cubes"></i> <span>Product</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url();?>cms/Product_Management"><i class="fa fa-cube"></i> Product Management</a></li>

		</ul>
	</li>
	
	<li class="treeview">
		<a href="#">
		<i class="fa fa-gears"></i> <span>General</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url();?>cms/staff"><i class="fa fa-users"></i> Staff / Accounts</a></li>
			<li><a href="<?php echo base_url();?>cms/PartnersPost"><i class="fa fa-ship"></i> Partners Post</a></li>
			<li><a href="<?php echo base_url();?>cms/TypesPharma"><i class="fa  fa-eyedropper"></i> Types Pharma</a></li>
			
		</ul>
	</li>
	
	<li><a  href="<?php echo base_url()?>exits"><i class="fa fa-sign-out"></i> <span>Log out</span></a></li>
	<li class="header">Catalog Manager navigation panel</li>
  </ul>
</section>
<!-- /.sidebar -->
</aside>
<script>
jQuery(document).ready(function(){
	jQuery.get( url_global+"apps/api/ClientScore", function( data_client_score ) {
		jQuery( "#pid_score" ).html( data_client_score.results );
	});
});
</script>