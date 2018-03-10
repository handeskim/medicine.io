<script src="<?php echo base_url();?>public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<section class="content">
	<div class="row">
		<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Thêm mới nhân viên</h3>
			</div>
			<form class="form-horizontal" method="POST" action="#" >
				<div class="box-body">
					<div class="form-group">
						<label for="inputEmail3" class="col-md-2 control-label">Quyền hạn</label>
						  <div class="col-md-10">
							  <select class="form-control" name="authorities"  required>
								<?php foreach($Addauthorities as $authorities){?>
									<option class="form-control"  value="<?php echo $authorities['id'];?>"> <?php echo $authorities['name_auth'];?> </option>
								<?php } ?>
							  </select>
						  </div>
					</div>
					<div class="form-group">
					
						<label for="inputEmail3" class="col-md-2 control-label">Họ và Tên</label>
						<div class="col-md-10">
							<input type="text" name="full_name" class="form-control" id="inputEmail3" value="" placeholder="họ và tên" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-md-2 control-label">email</label>
						<div class="col-md-10">
							<input type="email"  name="email" class="form-control" id="inputPassword3" placeholder="email" required>
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputPassword3" class="col-md-2 control-label">password</label>
						<div class="col-md-10">
							<input type="password"  name="password" class="form-control" id="inputPassword3" placeholder="password" required>
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputPassword3" class="col-md-2 control-label">Ngày sinh</label>
						<div class="col-md-10">
							<input type="text" id="ngay_sinh"  name="ngay_sinh" class="form-control" id="inputPassword3" placeholder="Ngày sinh" required>
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputPassword3" class="col-md-2 control-label">Địa chỉ</label>
						<div class="col-md-10">
							<input type="text"  name="dia_chi" class="form-control" id="inputPassword3" placeholder="Địa chỉ" required>
						</div>
					</div>	
					
					<div class="form-group">
						<label for="inputPassword3" class="col-md-2 control-label">Điện Thoại</label>
						<div class="col-md-10">
							<input type="text"  name="dien_thoai" class="form-control" id="inputPassword3" placeholder="Điện Thoại" required>
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputPassword3" class="col-md-2 control-label">Chứng Minh Thư Nhân Dân</label>
						<div class="col-md-10">
							<input type="text"  name="passport_id" class="form-control" id="inputPassword3" placeholder="Chứng Minh Thư Nhân Dân" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-md-2 control-label">Giảm giá</label>
						  <div class="col-md-10">
							  <select class="form-control" name="discount"  required>
									<option class="form-control"  value="1">  Có </option>
									<option class="form-control"  value="0">  Không </option>
							  </select>
						  </div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-md-2 control-label">Marketing</label>
						  <div class="col-md-10">
							  <select class="form-control" name="sendmail"  required>
									<option class="form-control"  value="1">  Có </option>
									<option class="form-control"  value="0">  Không </option>
							  </select>
						  </div>
					</div>
				</div>
				<div class="box-footer">
					<input type="hidden" name="cmd" value="1000">
					<button type="submit" class="btn btn-success pull-left">Thêm nhân sự</button>
				</div>
			</form>
		</div>
		</div>
	</div>
</section>
<script>

$('#ngay_sinh').datepicker({
  autoclose: true
});
</script>