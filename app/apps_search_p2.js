$(function(){
	$("#ResponseResultsInfo").empty();
	$.ajax({ 
		type: 'GET', 
		url: BASE_URL+'apps/api/info', 
		dataType: 'json',
		success: function (reponse) { 
			$("#ResponseResultsInfo").empty();
			if(reponse.results == null || reponse.results == '' ||  reponse.results == 'null'){
				$("#ResponseResultsInfo").append('không có đơn hàng cần phê duyệt');
			}else{
				var html_response = temp_response(reponse.results);
				$("#ResponseResultsInfo").append(html_response);
			}
		}
	});
	
	function temp_response(reponse){
		var temp = '';
		var temp = '<div class="box"><div class="box-header"><h3 class="box-title">Danh sách đơn hàng cần xác nhận</h3></div>'
		temp += '<div class="box-body"><table id="response_search" class="table table-bordered table-hover dataTable" >';
		temp += '<thead>';
		temp +=  '<tr>';
			temp += '<th style="text-algin:center;">Tên khách hàng</th>';
			temp += '<th style="text-algin:center;">Mã vận đơn</th>';
			temp += '<th style="text-algin:center;">Người bán</th>';
			temp += '<th style="text-algin:center;">Dịch vụ vận chuyển</th>';
			temp += '<th style="text-algin:center;">Số điện thoại</th>';
			temp += '<th style="text-algin:center;">Địa chỉ</th>';
			temp += '<th style="text-algin:center;">Ngày mua</th>';
			temp += '<th></th>';
			temp += '<th></th>';
		temp +=  '</tr>';
		temp += '</thead>';
		temp += '<tbody>';
		$.each(reponse, function(i, item) {
			temp +=  '<tr>';
			temp += '<td style="text-transform: capitalize;"> '+item.orders_fullname+'</td>';
			temp += '<td> '+item.orders_code+'</td>';
			temp += '<td style="text-transform: capitalize;"> '+item.staff_fullname+'</td>';
			temp += '<td> '+item.posts_name+'</td>';
			temp += '<td> '+item.orders_phone+'</td>';
			temp += '<td style="text-transform: capitalize;"> '+item.orders_addr+'</td>';
			temp += '<td> '+item.orders_date_buy+'</td>';
			if(authorities==3 && item.type_ordersx==2){
				temp += '<td><a title="Approved" href="'+BASE_URL+'route/accountancy?query='+item.bill_code+'" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"> </i></a></td>';
				temp += '<td><a title="Reject"  href="'+BASE_URL+'route/destroy_accounts?query='+item.bill_code+'" class="btn btn-danger"><i class="glyphicon glyphicon-ban-circle"> </i></a></td>';
			}
			if(authorities==5 && item.type_ordersx==3){
				temp += '<td><a title="Approved"  href="'+BASE_URL+'route/packer?query='+item.bill_code+'" class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"> </i></a></td>';
				temp += '<td><a title="Reject"  href="'+BASE_URL+'route/destroy_packer?query='+item.bill_code+'" class="btn btn-danger"><i class="glyphicon glyphicon-ban-circle"> </i></a></td>';
			}
			temp += '<td><a title="In đơn" target="_blank" href="'+BASE_URL+'prints/orders?query='+item.bill_code+'" class="btn btn-warning"><i class="fa fa-print"></i></a></td>';
			temp += '<td><a title="In PB" target="_blank" href="'+BASE_URL+'prints/letter?query='+item.bill_code+'" class="btn btn-primary"><i class="fa fa-envelope-o"></i></a></td>';
			temp += '<td><a title="In HD" target="_blank" href="'+BASE_URL+'prints/guide?query='+item.bill_code+'" class="btn btn-primary"><i class="fa fa-file"></i></a></td>';
			if(item.orders_code != null){
				temp += '<td><a title="Tra vận đơn" target="_blank" href="'+BASE_URL+'route/tracking?key='+item.orders_code+'&posts='+item.orders_posts+'" class="btn btn-info"><i class="fa fa-ship"></i></a></td>';
			}
			
			temp +=  '</tr>';
		});
		temp +='</tbody>';
		temp +='</table></div>';
		return temp;
	}
});