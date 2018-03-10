$(function(){
	$("#ResponseResultsInfo").empty();
	$.ajax({ 
		type: 'GET', 
		url: BASE_URL+'apps/api/scheduling', 
		dataType: 'json',
		success: function (reponse) { 
			$("#ResponseResultsInfo").empty();
			if(reponse.results == null || reponse.results == '' ||  reponse.results == 'null'){
				$("#ResponseResultsInfo").append('không có khách hàng cần tư vấn');
			}else{
			
				$("#ResponseResultsInfo").css({
				  "overflow": "scroll",
				  "width": "100%",
				  "height": "500px",
				});
				var html_response = temp_response(reponse.results);
				$("#ResponseResultsInfo").append(html_response);
			}
		}
	});
	
	function temp_response(reponse){
		var temp = '';
		var temp = '<div class="box"><div class="box-header"><h3 class="box-title">Danh sách khách hàng cần gọi lại</h3></div>'
		temp += '<div class="box-body"><table id="response_search" class="table table-bordered table-hover dataTable" >';
		temp += '<thead>';
		temp +=  '<tr>';
			temp += '<th>Mã khách hàng</th>';
			temp += '<th>Tên khách hàng</th>';
			temp += '<th>Ngày nhắc nhở</th>';
			temp += '<th>Thư điện tử</th>';
			temp += '<th>Số điện thoại</th>';
			temp += '<th>Địa chỉ</th>';
			temp += '<th>Ghi chú</th>'; 
			temp += '<th>Trạng Thái</th>';
			temp += '<th></th>';
			temp += '<th></th>';
		temp +=  '</tr>';
		temp += '</thead>';
		temp += '<tbody>';
		$.each(reponse, function(i, item) {
			var date= item.scheduling_date;
			var d=new Date(date.split("/").reverse().join("-"));
			var dd=d.getDate();
			var mm=d.getMonth()+1;
			var yy=d.getFullYear();
			var newdate=dd+"-"+mm+"-"+yy;
			temp +=  '<tr>';
				temp +=  '<td>'+item.scheduling_customer+'</td>';
				temp +=  '<td>'+item.scheduling_fullname+'</td>';
				temp +=  '<td>'+newdate+'</td>';
				temp +=  '<td>'+item.scheduling_email+'</td>';
				temp +=  '<td>'+item.scheduling_phone+'</td>';
				temp +=  '<td>'+item.scheduling_addr+'</td>';
				temp +=  '<td>'+item.scheduling_note+'</td>';
				temp +=  '<td>'+item.scheduling_name+'</td>';
				temp +=  '<td><a title="Reject" href="'+BASE_URL+'route/destroy_scheduling?query='+item.scheduling_id+'"class="btn btn-danger"><i class="fa fa-ban"> </i></a></td>';
				temp +=  '<td><a target="_blank" href="'+BASE_URL+'cms/scheduling/edit/'+item.scheduling_id+'"  title="edit" class="btn btn-warning"><i class="fa fa-edit"> </i></a></td>';
			temp +=  '</tr>';
		});
		temp +='</tbody>';
		temp +='</table></div>';
		return temp;
	}
});