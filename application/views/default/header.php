<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{title}</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/pqa_global.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/morris.js/morris.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo base_url();?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
 	<!-- jQuery 3 -->
<script src="<?php echo base_url();?>public/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url();?>public/bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script> 
		var url_global = "<?php echo base_url();?>";
	</script>
	<script type="text/javascript">
  		var BASE_URL = "<?php echo base_url(); ?>";
  	</script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip 
	<script src="public/dist/js/angular/1.2.1/angular.min.js"></script>
	
	<script src="public/plugins/bootpag/jquery.bootpag.min.js"></script>
	-->
  <script src="<?php echo base_url();?>app/notification.js"></script>
   <?php 
	$user_data = $this->session->userdata('data_users');
	$authorities = $user_data['authorities'];
	if($authorities ==3 || $authorities == 5){
	?>
	
	<meta http-equiv="refresh" content="1200" > 
	<?php } ?>
	<script type="text/javascript">
  		var authorities = "<?php echo $authorities; ?>";
  	</script>
</head>
<body ng-app="rilaApps" class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
  <header   class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('cms/dashboard');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img style="height: 24px;margin-top: 12px;" src="<?php echo base_url();?>public/logo/logopqa.png"" ></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
		<img style="height: 50px;" src="<?php echo base_url();?>public/logo/logopqa.png"" >
	  </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="" class="sidebar-toggle" data-toggle="push-menu" role="button">
       <i class="fa fa-bars fa-hand-o-left"></i>
        <span class="sr-only fa fa-minus-square-o">Toggle navigation</span>
      </a>
		
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
	  	<li class="dropdown notifications-menu" id="notifications_response">

      </li>
          <li class="dropdown user user-menu">
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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url().$img_awata;?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $user_data["full_name"]; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              
              <img src="<?php echo base_url().$img_awata;?>" class="img-circle" alt="User Image">

                <p>
                 <?php echo "Mã Nhân viên: " .$user_data['code']; ?> <br>
                   <small>Chức vụ: <?php 
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
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo base_url()?>cms/profile" class="btn btn-warning btn-flat">Thông Tin Tài Khoản</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url()?>exits" class="btn btn-default btn-flat">Thoát ra</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
           
          </li>
        </ul>
      </div>
    </nav>
  </header>