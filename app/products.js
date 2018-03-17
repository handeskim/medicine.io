$(document).ready(function(){
	$("#BtnSearchProducts").click(function(e){
		$("#reponse_products_search").empty();
		var product_inbox = $("#inboxSearchProducts").val();
		var name_pepr = $("#NameSearchProducts").val();
		var InfoItemProduct = '';
		if(product_inbox === '' || product_inbox === ''){
			$("#reponse_products_search").append(html_error_product);
		}else{
			search_product_item(product_inbox,name_pepr);
		}
	});
	function search_product_item(id,name_pepr){
		$.ajax({ 
			type: 'GET', 
			url: BASE_URL+'apps/api/search_product_item', 
			data: { code_products: id, name_pepr:name_pepr}, 
			dataType: 'json',
			success: function (ResponseProductSearch) { 
				if(ResponseProductSearch.result == null || ResponseProductSearch.result == '' ||  ResponseProductSearch.result == 'null'){
					$("#reponse_products_search").append('<div class="callout callout-warning"><h4>Tìm kiếm thất bại!</h4><p>sản phẩm không tìm thấy vui lòng tìm lại.</p></div>');
				}else{
					var list_temp = html_list_search_products(ResponseProductSearch.result);
					$("#reponse_products_search").append(list_temp);
					$.each(ResponseProductSearch.result, function(i, item) {
						$('#ItemProduct'+item.id).click(function() {
							var items = $("#ProductID"+item.id).val();
							$.get( BASE_URL+"cms/order_new/AddCart", { id: items,} ).done(function( newItemCart ) {
								$('#bodyAddCart').append(newItemCart);
								$("#addToCartFormPem"+item.id).empty();
								$("#DelItem"+item.id).click(function(){
									$("#CartItem"+item.id).empty();
									console.log(item.id);
								});
							});
						});
					});
					$("#resetFrom").click(function(){
						$("#ulFromCart").empty();
					});
				}
				
			}
		});
	}
	
});
function html_error_product(){
	var temp_html_error_product = '<div class="callout callout-warning"><h4>Lỗi xảy ra!</h4><p>Sản phẩm không tồn tại vui lòng thử lại.</p></div>';
	return temp_html_error_product;
}
function submitDetailsForm() {
	$("#error_codecode").empty();
	var CodeOrder = $("#CodeOrder").val();
	var NameCheckCustomer = $("#NameCheckCustomer").val();
	if(CodeOrder === '' || CodeOrder === null ){
		$("#error_codecode").append('<div class="callout callout-danger"><h4>Lỗi xảy ra!</h4><p>vui lòng không bỏ trống Mã Đơn hàng (Bưu Chính).</p></div>');
		return false;
	}else{
		if(NameCheckCustomer == 1){
			var CodeCustomer = $("#CodeCustomer").val();
			if(CodeCustomer === '' || CodeCustomer === null ){
				$("#error_codecode").append('<div class="callout callout-danger"><h4>Lỗi xảy ra!</h4><p>Vui lòng không bỏ trống Mã khách hàng.</p></div>');
				return false;
			}else{
				return true;
			}
		}else{
			return true;
		}
	}
}
function temp_old_customer(){
	$("#template_customer").empty();
	var temp ='<div id="Customer_old">';
		temp +='<div class="col-md-12" >';
		temp +='<label >Tìm kiếm theo số điện thoại </label> <div class="col-md-10" style="padding-left: 0px;margin-bottom: 24px;"><input class="form-control" type="text" id="IndexSearchItemCustomer" value="" placeholder="Số điện thoại"/> </div> <div class="col-md-2"><a class="btn btn-success"  id="ButtonIndexSearchItemCustomer"  onclick="FindPhoneCustomer()" >Tìm kiếm </a></div>';
		temp +='';
		temp +='</div><div id="ResponseSearchCustomer" class="col-md-12"> </div><br>';
		temp +='<div class="col-md-12">';
		temp +='<div id="msg_noti_customer"> </div>';
	
		temp +='<input id="CodeCustomer" type="hidden" class="form-control" name="CodeCustomer" value="" placeholder="Mã khách hàng - xxxxx" required readonly>';
		temp +=' </div></div>';
	$("#template_customer").append(temp);
}
function temp_new_customer(){
	$("#template_customer").empty();
	var temp ='<div id="Customer_New"> ';
		temp +='<label >Tên Khách hàng</label>';
		temp +='<input id="name_customer" type="text" class="form-control" name="name_customer" value="" placeholder="Mã khách hàng - xxxxx" required>';
		temp +='<label >Địa Chỉ Khách hàng</label>';
		temp +='<input id="addr_customer" type="text" class="form-control" name="addr_customer" value="" placeholder="Địa Chỉ Khách hàng- xxxxx" required>';
		temp +='<label >Email Khách hàng</label>';
		temp +='<input id="email_customer" type="text" class="form-control" name="email_customer" value="" placeholder="Email Khách hàng - xxxxx" >';
		temp +='<label >Số ĐT Khách hàng</label>';
		temp +='<input id="phone_customer" type="text" class="form-control" name="phone_customer" value="" placeholder="Số ĐT Khách hàng - xxxxx" required>';
		temp +='<div class="form-group">';
		temp +='<label for="exampleInputEmail1">Ghi chú Khách hàng</label>';
		temp +=' <textarea name="note_customer" rows="3" cols="50">Ghi chú</textarea>';
		temp +='</div>';
		temp +='</div>';
		
	$("#template_customer").append(temp);
}
function html_list_search_products(list){
	var temp = '<table class="table table-bordered" id="ulFromCart">';
		temp += '<tr>';
		temp += '<button style="float: right;" class="btn"id="resetFrom"><i class="fa fa-trash"></i></button></tr>';
	$.each(list, function(i, item) {
		temp += '<tr  id="addToCartFormPem'+item.id+'">';
		temp += '<td><span><input type="hidden" id="ProductID'+item.id+'" value="'+item.id+'"/></span></td>';
		temp += '<td><span>'+item.code_products+' </span></td>';
		temp += '<td><span>'+item.name_products+'</span></td>';
		temp += '<td><span>'+item.price+'</span></td>';
		temp += '<td><span class="btn btn-success btn-small" id="ItemProduct'+item.id+'"><i class="fa fa-cart-plus"> </i></span></td>';
		temp += '</tr>';
	});	
	temp += '</table>';
	return temp;
}
function html_list_search_phone(list){
	var temp = '<table class="table table-bordered" id="ulFromCartPhone">';
	$.each(list, function(i, item) {
		temp += '<tr>';
		temp += '<td><input type="hidden" id="phoneid'+item.id+'" value="'+item.code+'"/></td>';
		temp += '<td><span>'+item.full_name+'</span></td>';
		temp += '<td><span>'+item.email+'</span></td>';
		temp += '<td><span>'+item.dia_chi+'</span></td>';
		temp += '<td><span class="btn btn-success btn-small" id="submitbutton'+item.id+'">  <i id="addToPhone'+item.id+'" class="fa fa-user-plus"> </i></span></td>';
		temp += '</tr>';
	});	
	temp += '</table>';
	return temp;
}
function FindPhoneCustomer(){
	$("#ResponseSearchCustomer").empty();
	$("#msg_noti_customer").empty();
	var phone_customer = $("#IndexSearchItemCustomer").val();
	if(phone_customer === '' || phone_customer === null || phone_customer.length < 5 || phone_customer.length > 13 ){
		$("#ResponseSearchCustomer").append('<div class="callout callout-danger"><h4>Lỗi xảy ra!</h4><p>Vui lòng không bỏ trống Search.</p></div>');
		return false;
	}else{
		$.ajax({ 
			type: 'GET', 
			url: BASE_URL+'apps/api/search_phone', 
			data: { phones: phone_customer,}, 
			dataType: 'json',
			success: function (ResponsePhoneSearch) { 
				if(ResponsePhoneSearch.result == null || ResponsePhoneSearch.result == '' ||  ResponsePhoneSearch.result == 'null'){
					$("#ResponseSearchCustomer").append('<div class="callout callout-warning"><h4>Không tìm thấy!</h4><p>dữ liệu không tồn tại vui lòng thử lại.</p></div>');
				}else{
					var list_temp = html_list_search_phone(ResponsePhoneSearch.result);
					$("#ResponseSearchCustomer").append(list_temp);
					$.each(ResponsePhoneSearch.result, function(i, item) {
						$('#addToPhone'+item.id).click(function() {
							var itemsPhone = $("#phoneid"+item.id).val();
							$('#CodeCustomer').val(itemsPhone);
							var temp_noti_add = '<div class="callout callout-success"><h4> Đã chọn khách hàng!</h4><p> '+item.code+' | '+item.full_name+' | '+item.dien_thoai+' | '+item.dia_chi+'</p></div>';
							$('#msg_noti_customer').append((temp_noti_add));
							$("#ulFromCartPhone").empty();
						});
					});
				}
			}
		});
	} 
}

$(function() {
	temp_old_customer()
	$('#NameCheckCustomer').change(function(){
		if($('#NameCheckCustomer').val() == 2) {
			temp_new_customer();
		} else {
			temp_old_customer();
		} 
	});
});