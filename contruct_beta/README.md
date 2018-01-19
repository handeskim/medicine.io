##### Cấu trúc dữ liệu của hệ thống quản lý
------------------------------------------------------------
==================Quản lý ngường dùng=======================
Table_name: users
    {
        'usercode'=> 'mã người dùng'
        'username'=>'Tên người dùng',
        'passwords'=> 'Mật khẩu',
        'role' => 'mức quyền hạn',
        'emails' => 'thư diện tử',
        'status' => 'trạng thái sử dụng',
    }

	
Tạo Order 
	==> Nhập mã khách hàng {
		If(Mã khách hàng ==true){
			Return == Panel Info Khách hàng
		}else{
			Return Panel Info Cart News Customer
		}
	}
	==> Khởi tạo khách hàng mới

<span id="result">
  <span id="note"></span>
</span>
function loadIt() {
  $.get('ajax/test.php', function(data) {
    var jdata = JSON.parse(data);
    $('#result #note').html(jdata.note);
    ...
  });
}
setInterval(loadIt, 1000);

