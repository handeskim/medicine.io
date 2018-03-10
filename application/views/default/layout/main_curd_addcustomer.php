<script src="<?php echo base_url();?>public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script src="<?php echo base_url();?>public/bower_components/ckeditor/ckeditor.js"> </script>
<section class="content">
	<div class="row">
		<div class="col-md-12">
		<div class="box box-success">
			<div class="box-header with-border">
				<h3 class="box-title">Thêm mới khách hàng</h3>
			</div>
			<form class="form-horizontal" method="POST" action="#" >
				<div class="box-body">
					
					<div class="form-group">
					
						<label for="inputEmail3" class="col-md-2 control-label">Họ và Tên (*)</label>
						<div class="col-md-10">
							<input type="text" name="full_name" class="form-control" id="inputEmail3" value="" placeholder="họ và tên" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-md-2 control-label">email</label>
						<div class="col-md-10">
							<input type="email"  name="email" class="form-control" id="inputPassword3" placeholder="email" >
						</div>
					</div>
				
					
					<div class="form-group">
						<label for="inputPassword3" class="col-md-2 control-label">Ngày sinh</label>
						<div class="col-md-10">
							<input type="text" id="ngay_sinh"  name="ngay_sinh" class="form-control" id="inputPassword3" placeholder="Ngày sinh" >
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputPassword3" class="col-md-2 control-label">Địa chỉ (*)</label>
						<div class="col-md-10">
							<input type="text"  name="dia_chi" class="form-control" id="inputPassword3" placeholder="Địa chỉ" required>
						</div>
					</div>	
					
					<div class="form-group">
						<label for="inputPassword3" class="col-md-2 control-label">Điện Thoại Di Động (*)</label>
						<div class="col-md-10">
							<input type="text"  name="dien_thoai" class="form-control" id="inputPassword3" placeholder="Điện Thoại" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputPassword3" class="col-md-2 control-label">Điện Thoại Nhà </label>
						<div class="col-md-10">
							<input type="text"  name="dien_thoai_2" class="form-control" id="inputPassword3" placeholder="Điện Thoại Nhà" >
						</div>
					</div>
					
					<div class="form-group">
						<label for="inputPassword3" class="col-md-2 control-label">Chứng Minh Thư Nhân Dân </label>
						<div class="col-md-10">
							<input type="text"  name="passport_id" class="form-control" id="inputPassword3" placeholder="Chứng Minh Thư Nhân Dân" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2" >Ghi chú </label>
						<div class="col-md-10">
							<textarea id="note" name="note" rows="3" cols="50">Ghi chú</textarea>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<input type="hidden" name="supervisor" value="{staff}">
					<input type="hidden" name="cmd" value="1000">
					<button type="submit" class="btn btn-success pull-left">Thêm khách hàng</button>
					<a href="<?php echo base_url('cms/customer_management');?>" class="btn btn-default pull-right">Trở về</a>
				</div>
			</form>
		</div>
		</div>
	</div>
</section>
<script>
 $(function () {
     CKEDITOR.replace('note')
    $('.textarea').wysihtml5()
  });
$('#ngay_sinh').datepicker({
 
  autoclose: true,
  format: 'yyyy-mm-dd' 
  
});
</script>