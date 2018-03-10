$(function(){
	$("#advanced_search").hide();
	$("#normal_search").show();
	$("#index_search_option").change(function(){
		var OpSearch = $(this).val();
		if(OpSearch==1){
			$("#advanced_search").hide();
			$("#normal_search").show();
		}else{
			$("#advanced_search").show();
			$("#normal_search").hide();
		}
	});
	
	
	$("#btn_normal_search").click(function(){
		$("#ResponseResults").empty();
		$.ajax({ 
			type: 'GET', 
			url: BASE_URL+'apps/search', 
			data: $('form#frm_normal_search').serialize(), 
			dataType: 'json',
			success: function (reponse) { 
				$("#ResponseResults").empty();
				if(reponse.results == null || reponse.results == '' ||  reponse.results == 'null'){
					$("#ResponseResults").append('<div class="callout callout-warning"><h4>Tìm kiếm thất bại!</h4><p>sản phẩm không tìm thấy vui lòng tìm lại.</p></div>');
				}else{
					var temp_search = html_temp_search_results(reponse);
					$("#ResponseResults").append(temp_search);
				}
			}
		});
	});
	$("#btn_advanced_search").click(function(){
		$("#ResponseResults").empty();
		$.ajax({ 
			type: 'GET', 
			url: BASE_URL+'apps/search', 
			data: $('form#frm_advanced_search').serialize(), 
			dataType: 'json',
			success: function (reponse) { 
				
				$("#ResponseResults").empty();
				if(reponse.results == null || reponse.results == '' ||  reponse.results == 'null'){
					$("#ResponseResults").append('<div class="callout callout-warning"><h4>Tìm kiếm thất bại!</h4><p>sản phẩm không tìm thấy vui lòng tìm lại.</p></div>');
				}else{
					var temp_search = html_temp_search_advanced_results(reponse);
					$("#ResponseResults").append(temp_search);
				}
			}
		});
	});
	
	
	$("#inbox_normal_search").keyup(function(){
		$("#ResponseResults").empty();
		$.ajax({ 
			type: 'GET', 
			url: BASE_URL+'apps/search', 
			data: $('form#frm_normal_search').serialize(), 
			dataType: 'json',
			success: function (reponse) { 
				$("#ResponseResults").empty();
				
				if(reponse.results == null || reponse.results == '' ||  reponse.results == 'null'){
					$("#ResponseResults").append('<div class="callout callout-warning"><h4>Tìm kiếm thất bại!</h4><p>sản phẩm không tìm thấy vui lòng tìm lại.</p></div>');
				}else{
					var temp_search = html_temp_search_results(reponse);
					$("#ResponseResults").append(temp_search);
				}
			}
		});
	})
	
	function html_temp_search_advanced_results(reponse){
		var info = 'Từ khóa '+reponse.q;
		var temp = '<div class="box"><div class="box-header"><h3 class="box-title">Dữ liệu tìm kiếm '+info+'</h3></br><a href="'+BASE_URL+'excel_export/dowload?code='+reponse.code+'" target="_blank" class="btn btn-danger"><span> <i class="fa fa-cloud-download"> </i> Download dữ liệu tìm kiếm</span></a></div>'
		
		temp += '<div class="box-body"><table id="response_search" class="table table-bordered table-hover dataTable" >';
		temp += '<thead>';
		temp +=  '<tr>';
			temp += '<th>ID NV</th>';
			temp += '<th>ID KH</th>';
			temp += '<th>ID HĐ</th>';
			temp += '<th>Tên khách</th>';
			temp += '<th>Email</th>';
			temp += '<th>Phone</th>';
			temp += '<th>Addr</th>';
			temp += '<th>Trạng Thái</th>';
			if(authorities==3 || authorities==5){
				temp += '<th></th>';
				temp += '<th></th>';
			}
			temp += '<th></th>';
			temp += '<th></th>';
			temp += '<th></th>';
		temp +=  '</tr>';
		temp += '</thead>';
		temp += '<tbody>';;
		$.each(reponse.results, function(i, item) {
			temp +=  '<tr>';
			temp += '<td> '+item.staff_code+'</td>';
			temp += '<td> '+item.code_customner+'</td>';
			temp += '<td> '+item.code_orders+'</td>';
			temp += '<td> '+item.full_name+'</td>';
			temp += '<td> '+item.email+'</td>';
			temp += '<td> '+item.dien_thoai+'</td>';
			temp += '<td> '+item.dia_chi+'</td>';
			temp += '<td> '+item.orders_status+'</td>';
			if(authorities==4){
				if(item.type_orders <= 2 ){
					temp += '<td><a title="Reject" target="_blank" href="'+BASE_URL+'route/destroy_staff?query='+item.code_orders+'" class="btn btn-danger"><i class="glyphicon glyphicon-ban-circle"> </i></a></td>';
				}
			}
			if(authorities==3 && item.type_orders==2){
				temp += '<td><a title="Approved" target="_blank" href="'+BASE_URL+'route/accountancy?query='+item.code_orders+'" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"> </i></a></td>';
				temp += '<td><a title="Reject" target="_blank" href="'+BASE_URL+'route/destroy_accounts?query='+item.code_orders+'" class="btn btn-danger"><i class="glyphicon glyphicon-ban-circle"> </i></a></td>';
			}
			if(authorities==5 && item.type_orders==3){
				temp += '<td><a title="Approved" target="_blank" href="'+BASE_URL+'route/packer?query='+item.code_orders+'" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"> </i></a></td>';
				temp += '<td><a title="Reject" target="_blank" href="'+BASE_URL+'route/destroy_packer?query='+item.code_orders+'" class="btn btn-danger"><i class="glyphicon glyphicon-ban-circle"> </i></a></td>';
			}
			temp += '<td><a title="Details" target="_blank" href="'+BASE_URL+'prints/details?query='+item.code_orders+'" class="btn btn-info"><i class="fa fa-eye"> </i></a></td>';
			temp += '<td><a title="In PB" target="_blank" href="'+BASE_URL+'prints/letter?query='+item.code_orders+'" class="btn btn-success"><i class="fa fa-envelope-o"> </i></a></td>';
			temp += '<td><a title="In đơn" target="_blank" href="'+BASE_URL+'prints/orders?query='+item.code_orders+'" class="btn btn-warning"><i class="fa fa-print"></i></a></td>';
			temp += '<td><a title="In HD" target="_blank" href="'+BASE_URL+'prints/guide?query='+item.code_orders+'" class="btn btn-primary"><i class="fa fa-file"></i></a></td>';
			temp += '<td><a title="Tra vận đơn" target="_blank" href="'+BASE_URL+'route/tracking?key='+item.code_orders+'&posts='+item.type_post+'" class="btn btn-info"><i class="fa fa-ship"></i></a></td>';
				
				
			temp +=  '</tr>';
		});
		temp +='</tbody>';
		temp +='</table></div>';
		return temp;
	}
	
	
	function html_temp_search_results(reponse){
		if(reponse.finds == 1){
			var info = "khách hàng";
		}
		if(reponse.finds == 2){
			var info = "đơn hàng";
		}
		if(reponse.finds == 3){
			var info = "lập lịch gọi";
		}
		var temp = '<div class="box"><div class="box-header"><h3 class="box-title">Dữ liệu tìm kiếm '+info+'</h3></div>'
		temp += '<div class="box-body"><table id="response_search" class="table table-bordered table-hover dataTable" >';
		temp += '<thead>';
		temp +=  '<tr>';
			temp += '<th>Mã khách hàng</th>';
			if(reponse.finds == 2){
				temp += '<th>Mã hóa đơn</th>';
			}
			temp += '<th>Name</th>';
			temp += '<th>Email</th>';
			temp += '<th>Phone</th>';
			temp += '<th>Addr</th>';
			temp += '<th>Status</th>';
			if(reponse.finds == 2){
				if(authorities==3 || authorities==5){
					temp += '<th></th>';
					temp += '<th></th>';
				}
				temp += '<th></th>';
				temp += '<th></th>';
				temp += '<th></th>';
			}
			if(reponse.finds == 1){
				temp += '<th></th>';
			}
		temp +=  '</tr>';
		temp += '</thead>';
		temp += '<tbody>';
		$.each(reponse.results, function(i, item) {
			
			temp +=  '<tr>';
				if(reponse.finds == 1){
					temp += '<td> '+item.code+'</td>';
				}
				if(reponse.finds == 2){
					temp += '<td> '+item.code_customner+'</td>';
					temp += '<td> '+item.code_orders+'</td>';
				}
				temp += '<td> '+item.full_name+'</td>';
				temp += '<td> '+item.email+'</td>';
				temp += '<td> '+item.dien_thoai+'</td>';
				temp += '<td> '+item.dia_chi+'</td>';
				if(reponse.finds == 2){
					temp += '<td> '+item.orders_status+'</td>';
				}
				if(reponse.finds == 2){
					if(authorities==4 && item.type_orders <=2 ){
						temp += '<td><a title="Reject" target="_blank" href="'+BASE_URL+'route/destroy_staff?query='+item.code_orders+'" class="btn btn-danger"><i class="glyphicon glyphicon-ban-circle"> </i></a></td>';
					}
					if(authorities==3 && item.type_orders==2){
						temp += '<td><a title="Approved" target="_blank" href="'+BASE_URL+'route/accountancy?query='+item.code_orders+'" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"> </i></a></td>';
						temp += '<td><a title="Reject" target="_blank" href="'+BASE_URL+'route/destroy_accounts?query='+item.code_orders+'" class="btn btn-danger"><i class="glyphicon glyphicon-ban-circle"> </i></a></td>';
					}
					if(authorities==5 && item.type_orders==3){
						temp += '<td><a title="Approved" target="_blank" href="'+BASE_URL+'route/packer?query='+item.code_orders+'" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"> </i></a></td>';
						temp += '<td><a title="Reject" target="_blank" href="'+BASE_URL+'route/destroy_packer?query='+item.code_orders+'" class="btn btn-danger"><i class="glyphicon glyphicon-ban-circle"> </i></a></td>';
					}
					temp += '<td><a title="Chi tiết" target="_blank" href="'+BASE_URL+'prints/details?query='+item.code_orders+'" class="btn btn-info"><i class="fa fa-eye"> </i></a></td>';
					temp += '<td><a title="In PB" target="_blank" href="'+BASE_URL+'prints/letter?query='+item.code_orders+'" class="btn btn-success"><i class="fa fa-envelope-o"> </i></a></td>';
					
					temp += '<td><a title="In đơn" target="_blank" href="'+BASE_URL+'prints/orders?query='+item.code_orders+'" class="btn btn-warning"><i class="fa fa-print"></i></a></td>';
					temp += '<td><a title="In HD" target="_blank" href="'+BASE_URL+'prints/guide?query='+item.code_orders+'" class="btn btn-primary"><i class="fa fa-file"></i></a></td>';
					temp += '<td><a title="Tra vận đơn" target="_blank" href="'+BASE_URL+'route/tracking?key='+item.code_orders+'&posts='+item.type_post+'" class="btn btn-info"><i class="fa fa-ship"></i></a></td>';
				}
				if(reponse.finds == 1){
					if(authorities==3 || authorities==5){
						temp += '<td><a title="Chi tiết" target="_blank" href="'+BASE_URL+'cms/customer_management/view?query='+item.id+'" class="btn btn-info"><i class="fa fa-eye"> </i></a></td>';
					}else{
						temp += '<td><a title="Sửa" target="_blank" href="'+BASE_URL+'cms/customer_management/edit?query='+item.id+'" class="btn btn-danger"><i class="fa fa-edit"> </i></a></td>';
					}
					
				}
			temp +=  '</tr>';
		});
		temp +='</tbody>';
		temp +='</table></div>';
		return temp;
	}
});