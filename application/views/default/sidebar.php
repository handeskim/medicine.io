 <?php 
	$user_data = $this->session->userdata('data_users');
	$authorities = $user_data['authorities'];
	$sendmail = $user_data['sendmail'];
  ?>
<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
	<div class="pull-left image">
		<?php 
			
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
		<a href="<?php echo base_url('cms/profile');?>"><?php echo $user_data["full_name"]; ?></a>
		</br>
		<p style="padding-top:10px">  
		   <small><?php 
		   if(!empty($user_data['authorities'])){
			   if($user_data['authorities']==1){
				   echo "Quản trị viên";
			   }else if($user_data['authorities']==2){
				   echo "Quản trị viên";
			   }else if($user_data['authorities']==3){
				   echo "Nhân viên kế toán";
			   }else if($user_data['authorities']==4){
				   echo "Nhân viên bán hàng";
			   }else if($user_data['authorities']==5){
				   echo "Nhân viên kho";
			   }
		   }
		   ?> </small>
                 
       </p>
	 
	</div>
	
  </div>

  <ul class="sidebar-menu" data-widget="tree">
	
	<li class="header">.</li>
	<li ><a href="<?php echo base_url('apps');?>">
			<i class="fa fa-dashboard"></i> <span>Trang Chủ</span>
		</a>
	</li>
	<?php 
		if($authorities ==1 || $authorities == 2 || $authorities ==4){
	?>
	<li class="treeview">
		<a href="#">
		<i class="fa fa-briefcase"></i> <span>Khách hàng</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url();?>cms/customer_management"><i class="fa fa-user-secret"></i> Quản lý khách hàng</a></li>
			<?php 
				if($authorities ==1 || $authorities == 2 || $authorities ==4){
			?>
			<li><a href="<?php echo base_url();?>cms/scheduling"><i class="fa fa-history"></i> Lập lịch gọi lại</a></li>
			<?php } ?>
		</ul>
	</li>
	<?php } ?>
	<li class="treeview">
		<a href="#">
		<i class="fa fa-shopping-cart"></i> <span>Đơn hàng</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<?php 
			if($authorities ==1 || $authorities == 2 || $authorities ==4){
			?>
			<li><a href="<?php echo base_url();?>cms/order_new"><i class="fa  fa-cart-plus"></i> Thêm mới đơn hàng</a></li>
			<?php } ?>
			<li><a href="<?php echo base_url();?>cms/oders_management"><i class="fa fa-shopping-cart"></i> Quản lý đơn hàng</a></li>
			
		</ul>
	</li>
	<?php 
		if($authorities !=3 || $authorities != 5){
	?>
	<li class="treeview">
		<a href="#">
		<i class="fa fa-bullhorn"></i> <span>Marketing</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url();?>cms/marketing/email"><i class="fa fa-envelope-square"></i> Tạo Marketing Email </a></li>
			<li><a href="<?php echo base_url();?>cms/marketing/email_manager"><i class="fa fa-envelope"></i> Quản lý gửi email </a></li>
			<li><a href="<?php echo base_url();?>cms/marketing/sms"><i class="fa fa-cube"></i> Tạo Marketing SMS </a></li>
			<li><a href="<?php echo base_url();?>cms/marketing/sms_manager"><i class="fa fa-tablet"></i> Quản lý gửi SMS </a></li>
		</ul>
	</li>
	<?php } ?>
	<li class="treeview">
		<a href="#">
		<i class="fa fa-cubes"></i> <span>Sản phẩm</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url();?>cms/product_management"><i class="fa fa-cube"></i> Quản lý sản phẩm </a></li>

		</ul>
	</li>
	<?php 
		if($authorities ==1 || $authorities == 2){
	?>
	<li class="treeview">
		<a href="#">
		<i class="fa fa-gears"></i> <span>Hệ thống</span>
			<span class="pull-right-container">
			<i class="fa fa-angle-left pull-right"></i>
			</span>
		</a>
		<ul class="treeview-menu">
			<li><a href="<?php echo base_url();?>cms/staff"><i class="fa fa-users"></i> Nhân viên </a></li>
			<li><a href="<?php echo base_url();?>cms/partnerspost"><i class="fa fa-ship"></i> Dịch vụ bưu chính</a></li>
			<li><a href="<?php echo base_url();?>cms/generic"><i class="fa fa-gears"></i> Cấu hình Chung</a></li>
			<li><a href="<?php echo base_url();?>cms/typespharma"><i class="fa  fa-eyedropper"></i> Loại thuốc</a></li>
			
		</ul>
	</li>
	<?php 
		}
	?>
	
	<li class="header">Copyright © PQA Software</li>
	<li><a  href="<?php echo base_url()?>exits"><i class="fa fa-sign-out"></i> <span>Đăng xuất tài khoản</span></a></li>
  </ul>
</section>
<!-- /.sidebar -->
</aside>
