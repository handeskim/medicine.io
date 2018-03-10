<script src="<?php echo base_url();?>public/bower_components/ckeditor/ckeditor.js"> </script>
<script src="<?php echo base_url();?>app/products.js"> </script>
<script src="<?php echo base_url();?>public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<script>
  $('#date_allBack').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
 $( "#date_allBack" ).datepicker({
	dateFormat: 'dd-mm-yy'
 });
</script>
<section class="content">
	<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<a class="btn btn-primary" href="<?php echo base_url('cms/oders_management');?>" ><i class="fa fa-shopping-cart"> </i> Quay lại quản lý đơn hàng</span></a>
		</div>	
		<hr>
	</div>
		<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Tạo mới đơn hàng</h3>
			</div>
			<div class="box-body">
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-6">
							<label for="ProductLabel">Nhập mã sản phẩm </label>
							<input id="inboxSearchProducts" type="text" class="form-control" id="ProductLabel" value="" placeholder="Mã sản phẩm ">
						 </div>  
						 <div class="col-md-6">
							<label for="ProductLabel">(Lựa chọn Tìm theo)</label>
							<select id="NameSearchProducts" name="NameSearchProducts" class="form-control"> 
									<option value="1"> Mã sản phẩm</option>
									<option value="2"> Tên sản phẩm</option>
									<option value="3"> Nhãn sản phẩm</option>
							</select>
							<button style="margin-top: 10px;" id="BtnSearchProducts" class="btn btn-default" >Tìm kiếm</button>
						 </div>  
					 </div>     
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-12">
							<div id="reponse_products_search"></div>
						</div>
					</div>     
				</div>
				<div class="col-md-12">
					<form id="formId" role="form" action="#" method="POST" onsubmit="return submitDetailsForm()">
						<hr>
						<div class="form-group col-md-12">
							<div id="item_cart">
								<div class="col-md-6">
									<label >Mã đơn hàng</label>
									<input id="CodeOrder" type="text" class="form-control" name="CodeOrder" value="" placeholder="Mã đơn hàng - mã vận đơn" required>
								</div>
								<div class="col-md-6">
									<label for="exampleInputEmail1">Nhà cung cấp dịch vụ</label>
									<select name="NamePost" class="form-control"> 
										<option value="1"> VNPost</option>
										<option value="2"> Viettel Post</option>
									</select>
								</div>
								
							</div>
							
						</div>
						<div class="form-group col-md-12" style="margin-top: 10px;float:  left;width: 100%;">
							<h3 class="header_info_cart">Thông tin giỏ hàng</h3>
							<label>Thông tin Giỏ hàng</label>
							<div id="item_cart">
								<table style="text-align: center;"  class="table table-bordered"> 
									<thead>
									  <tr>
										 <th style="text-align: center;" >Mã sản phẩm</th>
										 <th style="text-align: center;" >Tên sản phẩm</th>
										 <th style="text-align: center;" >Nhãn sản phẩm</th>
										 <th style="text-align: center;" >Số lượng </th>
										 <th style="text-align: center;" >Giá </th>
									  </tr>
									</thead>
									<tbody id="bodyAddCart">
									
									</tbody>
								</table>
							</div>
						</div>
						<div class="form-group col-md-4">
							<div class="col-md-12">
								<label >COD Thu Hộ </label>
								<br>
								<label><input name="cod" type="checkbox" value="yes" checked> Đồng ý thu hộ bằng COD</label>
							</div>
						</div>
						<div class="form-group col-md-4">
						<?php if($discounts==1){ ?>
						<div class="col-md-12">
							<div id="discounts"> 
								<label >% Giảm Giá</label>
								<input id="discounts" type="number" class="form-control" name="discounts" value="0" placeholder="% Giảm Giá exp: 15 là 15%" required>
							</div>
						</div>
						<?php } ?>
						</div>
						<div class="form-group col-md-4">
						
							<div class="col-md-12">
								<div id="fee_cod"> 
									<label >Phí Chuyển Phát Nhanh</label>
									<input id="fee_cod_inp" type="number" class="form-control" name="fee_cod" value="0" placeholder="Phí chuyển phát: 100000" required>
								</div>
							</div>
						
						</div>
						<div class="form-group col-md-12" style="">
							<h3 class="header_info_cart">Thông tin khách hàng</h3>
							<div id="item_customer">
								<div class="col-md-2">
									<label for="exampleInputEmail1">Loại Khách hàng</label>
									<select id="NameCheckCustomer" name="NameCheckCustomer" class="form-control" > 
										<option value="1"> Cũ</option>
										<option value="2"> Mới</option>
									</select>
								</div>
								<div class="col-md-10">
									<div class="col-md-12">
										<div id="template_customer"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group col-md-12" style="">
						<hr>
							
							<div id="item_customer">
								<div class="col-md-2">
									<label for="exampleInputEmail1">Lịch gọi lại</label>
									<select id="NameCheckCallBack" name="NameCheckCallBack" class="form-control" > 
										<option value="2"> Không</option>
										<option value="1"> Có</option>
									</select>
								</div>
								<div class="col-md-8">
									<div class="col-md-12">
										<div id="CallBack"> 
											<label>Ngày gọi lại</label>
											<input id="date_allBack" type="text" class="form-control" name="date_allBack" value=""  >
											<label for="exampleInputEmail1">Ghi chú gọi lại</label>
											<textarea id="note_callback" name="note_callback" rows="3" cols="50"></textarea>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="form-group col-md-12">
						<hr>
							  <label for="exampleInputEmail1">Hướng dẫn sử dụng đơn hàng</label>
							  <textarea id="use_guide" name="manuals" rows="10" cols="80">Nội dung Hướng dẫn sử dụng</textarea>
						</div>
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Ghi chú đơn hàng</label>
							 <textarea id="note" name="note" rows="3" cols="50"></textarea>
						</div>
						
						<div class="form-group col-md-12">
							<input type="hidden" name="cmd" value="1000"/>
							<input type="submit" class="btn btn-danger btn-small" value="Thêm Đơn Hàng"/>
							
						</div>
						<div class="form-group col-md-12">
							<div id="error_codecode"> </div>
						</div>
					</form>
				</div>
			</div>
		</div>
		</div>
	</div>
</section>

<script>
  $(function () {
     CKEDITOR.replace('use_guide')
     CKEDITOR.replace('note')
     CKEDITOR.replace('note_callback')
    $('.textarea').wysihtml5()
  });
$('#date_allBack').datepicker({
  autoclose: true
});
</script>
<style>
#error_codecode {
	color:red;
}
.header_info_cart{
	margin: 10px;
    background: #ecf0f5;
    height: 45px;
    padding: 15px;
    text-align: left;
    text-transform: uppercase;
    color: #333;
    border-bottom: 2px solid #fff212;
    font-size: 16px;
}
</style>