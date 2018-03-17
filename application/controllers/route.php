<?php
class Route extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
		$this->load->model('global_model', 'GlobalMD');	
		$this->login = $this->session->userdata('auth_sign');
		if($this->login){
			$this->user_data = $this->session->userdata('data_users');
			$this->authorities = $this->user_data['authorities'];
			$this->staff = $this->user_data['id'];
		}else{
			redirect(base_url('sign'));
		}
	
		
	}
	public function destroy_email_success(){
		$sql = "SELECT * FROM `email_sending` WHERE `status` = 3";
		$data = $this->GlobalMD->query_global($sql);
		foreach($data as $value){
			$data = array(
               'status' => 5,
            );
			$this->db->where('id', $value['id']);
			$this->db->update('email_sending', $data); 
		}
		redirect(base_url('cms/marketing/email_manager'));
		
	}
	public function destroy_email_error(){
		$sql = "SELECT * FROM `email_sending` WHERE `status` = 2";
		$data = $this->GlobalMD->query_global($sql);
		foreach($data as $value){
			$data = array(
               'status' => 6,
            );
			$this->db->where('id', $value['id']);
			$this->db->update('email_sending', $data); 
		}
		redirect(base_url('cms/marketing/email_manager'));
	}
	public function dowload_email_error(){
		$staff = $this->staff;
		if($this->authorities==4){
			$sql = "SELECT * FROM `email_sending` INNER JOIN status_email ON email_sending.`status` = status_email.id WHERE `status` = 2 AND `staff` = '$staff'";
		}else{
			$sql = "SELECT * FROM `email_sending` INNER JOIN status_email ON email_sending.`status` = status_email.id WHERE `status` = 2";
		}
		$encrypt = core_encode($sql);
		redirect(base_url('excel_export/dowload?code='.$encrypt));
	}
	public function dowload_email_success(){
		$staff = $this->staff;
		if($this->authorities==4){
			$sql = "SELECT * FROM `email_sending` INNER JOIN status_email ON email_sending.`status` = status_email.id WHERE `status` = 3 AND `staff` = '$staff'";
		}else{
			$sql = "SELECT * FROM `email_sending` INNER JOIN status_email ON email_sending.`status` = status_email.id WHERE `status` = 3";
		}
		
		$encrypt = core_encode($sql);
		redirect(base_url('excel_export/dowload?code='.$encrypt));
	}
	
	
	public function destroy_sms_success(){
		$sql = "SELECT * FROM `sms_sending` WHERE `status` = 3";
		$data = $this->GlobalMD->query_global($sql);
		foreach($data as $value){
			$data = array(
               'status' => 5,
            );
			$this->db->where('id', $value['id']);
			$this->db->update('sms_sending', $data); 
		}
		redirect(base_url('cms/marketing/sms_manager'));
		
	}
	public function destroy_sms_error(){
		$sql = "SELECT * FROM `sms_sending` WHERE `status` = 2";
		$data = $this->GlobalMD->query_global($sql);
		foreach($data as $value){
			$data = array(
               'status' => 6,
            );
			$this->db->where('id', $value['id']);
			$this->db->update('sms_sending', $data); 
		}
		redirect(base_url('cms/marketing/sms_manager'));
	}
	public function dowload_sms_error(){
		$staff = $this->staff;
		if($this->authorities==4){
			$sql = "SELECT * FROM `sms_sending` INNER JOIN status_email ON sms_sending.`status` = status_email.id WHERE `status` = 2  AND `staff` = '$staff'";
		}else{
			$sql = "SELECT * FROM `sms_sending` INNER JOIN status_email ON sms_sending.`status` = status_email.id WHERE `status` = 2";
		}
		$encrypt = core_encode($sql);
		redirect(base_url('excel_export/dowload?code='.$encrypt));
	}
	public function dowload_sms_success(){
		$staff = $this->staff;
		if($this->authorities==4){
			$sql = "SELECT * FROM `sms_sending` INNER JOIN status_email ON sms_sending.`status` = status_email.id WHERE `status` = 3  AND `staff` = '$staff'";
		}else{
			$sql = "SELECT * FROM `sms_sending` INNER JOIN status_email ON sms_sending.`status` = status_email.id WHERE `status` = 3";
		}
		$encrypt = core_encode($sql);
		redirect(base_url('excel_export/dowload?code='.$encrypt));
	}
	public function tracking(){
		$key = $this->input->get('key');
		$cmd = $this->input->get('posts');
		$links ='';
		if($cmd==1){
			$links =  'http://www.vnpost.vn/en-us/dinh-vi/buu-pham?key='.$key;
			 
		}
		if($cmd==2){
			$links = "https://www.viettelpost.com.vn/Tracking?KEY=".$key;
			
		}
		header('Location: '.$links);
		
	}
	public function destroy_scheduling(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'status' => 2,
			);
		$this->db->where('id', $query);
		$UpdateNotifation = $this->db->update('scheduling_callback', $data_notifation); 
			redirect(base_url('apps'));
		
	}
	public function packer(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'title' => 'Kho đã xác nhận: '.$query,
				'status' => 1,
				'authorities' => 4,
			);
		$this->db->where('links', $query);
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
		
		if($UpdateNotifation==true){
			$data_Orders = array(
				'type_orders' => 4,
				'date_send' => date('Y-m-d H:i:s',time()),
			);
			$this->db->where('bill_code', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			$token = core_encode($query);
			redirect(base_url('cms/details?token='.$token));
		}
	}
	public function destroy_packer(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'title' => 'Kho đã hủy: '.$query,
				'status' => 1,
				'authorities' => 4,
			);
		$this->db->where('links', $query);
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
		
		if($UpdateNotifation==true){
			$data_Orders = array(
				'type_orders' => 8,
				'date_send' => date('Y-m-d H:i:s',time()),
			);
			$this->db->where('bill_code', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url('cms/oders_management'));
		}
	}	

	public function destroy_staff(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'title' => 'Tư vấn đã hủy: '.$query,
				'status' => 2,
				'authorities' => 4,
			);
		$this->db->where('links', $query);
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
		if($UpdateNotifation==true){
			$data_Orders = array(
				'type_orders' => 6,
				'date_send' => date('Y-m-d H:i:s',time()),
				'date_confim' => date('Y-m-d H:i:s',time()),
			);
			$this->db->where('bill_code', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url('cms/oders_management'));
		}
	}	
	
	public function notify(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'title' => 'Kho đã gửi đơn hàng: '.$query,
				'status' => 2,
				'authorities' => 4,
			);
		$this->db->where('links', $query);
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
			redirect(base_url('cms/oders_management'));
	}
	private function load_info_bill($bill_code){
		$sql = "SELECT o.*, p.*,s.full_name as name_nhanvien, o.price as o_price, o.quantily as o_quantily
		FROM orders o
		INNER JOIN staff s ON o.code_staff = s.id
		INNER JOIN products p ON o.code_products = p.id
		WHERE o.bill_code = '$bill_code' AND o.type_orders = 2
		";
		try{
			$response = $this->GlobalMD->query_global($sql);
			if(isset($response)){
				if(!empty($response)){
					$this->temp_comfim_oder_accouting($response);
				}else{redirect(base_url());}
			}else{redirect(base_url());}
		} catch (Exception $e) {
			redirect(base_url());
		}	
		
	}
	protected function temp_comfim_oder_accouting($response){
		header('Content-type: text/html; charset=utf-8');
		$temp = '<a href="'.base_url().'"> Thoát ra </a> <div style="margin: 0px;text-align: center;width: 100%;max-width: 1000px;margin: auto;padding: 30px;border: 1px solid #eee;box-shadow: 0 0 10px rgba(0, 0, 0, .15);font-size: 16px;line-height: 24px;font-family: Arial, sans-serif;color: #555;" ><table><h4 style="text-transform: uppercase;">Mẫu kế toán xác nhận đơn hàng Mã #'.$response[0]['bill_code'].'</h4>';
		$temp .='<form action="active_bill" method="GET">';
				$temp .='<h5> Thêm mã vận đơn (mã vận chuyển bưu chính) cho đơn hàng</h5>';
				$temp .='<lable>Mã vận đơn: </lable><input style="width:400px; height: 30px;" name="code_orders" type="text" value="" placeholder="Mã VNPT Posts hoặc Viettel Posts" required>';
				$temp .='<input type="hidden" value="'.$response[0]['bill_code'].'" name="bill_code" required>';
				$temp .='</br><button name="comfim" style="text-transform: uppercase;height: 30px;background:#fff212;margin-top: 10px;border: none;cursor: pointer;" > ĐỒNG Ý XÁC NHẬN </button>';
				
		$temp .='</form>';
		$temp .="<hr> <h4> CHI TIẾT ĐƠN HÀNG CẦN XÁC XẬN BỞI KẾ TOÁN</h4>";
		$temp .='<tr> <td>NHÂN VIÊN: </td> <td>'.$response[0]['name_nhanvien'].' </td></tr>';
		$temp .='<tr> <td>MÃ CỘNG TÁC VIÊN:</td> <td>'.$response[0]['ctv'].' </td> </tr>';
		$temp .='<tr> <td>KHÁCH HÀNG: </td> <td>'.$response[0]['full_name'].' </td></tr>';
		$temp .='<tr> <td>ĐỊA CHỈ KHÁCH HÀNG:</td> <td>'.$response[0]['dia_chi'].' </td></tr>';
		$temp .='<tr> <td>SỐ ĐIỆN THOẠI KHÁCH HÀNG:</td><td>'.$response[0]['dien_thoai'].' </td> </tr>';
		$temp .='<tr> <td>ĐỊA CHỈ GIAO HÀNG: </td></tr></table> <hr>';
		$temp .='<table style="text-align: center;width: 100%;"><tr><td>MÃ SẢN PHẨM</td>';
		$temp .='<td>TÊN SẢN PHẨM</td>';
		$temp .='<td>SỐ LƯỢNG</td>';
		$temp .='<td>ĐƠN GIÁ</td>';
		$temp .='<td>THÀNH TIỀN</td></tr>';
		$tongtien = array();
		foreach($response as $value){
			$temp .= '<tr>';
				$temp .= '<td>'.$value['label_products'].'</td>';	
				$temp .= '<td> '.$value['name_products'].'</td>';	
				$temp .= '<td>'.$value['o_quantily'].' </td>';	
				$temp .= '<td> '.number_format($value['o_price']).'</td>';	
				$thanhtien = (int)$value['o_price'] * (int)$value['o_quantily'];
				$temp .= '<td> '. number_format($thanhtien).'</td>';	
			$temp .= '</tr>';
			$tongtien[] = $thanhtien;
		}
		$total_price_bill = array_sum($tongtien);
		$discount = $response[0]['discounts'];
		if($discount > 0){
			$discounts_bill = ((int)$discount * $total_price_bill)/100;
		}else{
			$discounts_bill = 0;
		}
		$fee_cod = $response[0]['fee_cod'];
		$total_discounts_bill = ($total_price_bill - $discounts_bill) + $fee_cod;
		$temp .= '<tr> <td> </td> <td> </td> <td> </td> <td> Tổng cộng: </td> <td> '. number_format($total_price_bill).'</td></tr>';
		$temp .= '<tr> <td> </td> <td> </td> <td> </td> <td> Giảm giá: '.$discount.'%</td> <td>'. number_format($discounts_bill).' </td></tr>';
		$temp .= '<tr> <td> </td> <td> </td> <td> </td> <td> Phí vận chuyển: </td> <td> '. number_format($fee_cod).'  </td></tr>';
		$temp .= '<tr> <td> </td> <td> </td> <td> </td> <td> Tổng thanh toán: </td> <td> '. number_format($total_discounts_bill).'  </td></tr>';
		$temp .= '</table>';
		$temp .= '</div>';
		echo $temp;
	}
	public function accountancy(){
		$bill_code = $this->input->get('query');
		$this->load_info_bill($bill_code);
	}	
	public function active_bill(){
		$bill_code = $this->input->get('bill_code');
		$code_orders = $this->input->get('code_orders');
		$data_notifation = array(
				'title' => 'Kế toán đã xác nhận: '.$bill_code,
				'status' => 1,
				'authorities' => 5,
			);
		$this->db->where('links', $bill_code);
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
		if($UpdateNotifation==true){
			$data_Orders = array(
				'code_orders' => $code_orders,
				'type_orders' => 3,
				'date_confim' => date('Y-m-d H:i:s',time()),
			);
			$this->db->where('bill_code', $bill_code);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url());
		}
	}
	public function destroy_accounts(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'title' => 'Tài chính đã hủy: '.$query,
				'status' => 1,
				'authorities' => 4,
			);
		$this->db->where('links', $query);
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
		if($UpdateNotifation==true){
			$data_Orders = array(
				'type_orders' => 7,
				'date_confim' => date('Y-m-d H:i:s',time()),
			);
			$this->db->where('bill_code', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url('cms/oders_management'));
		}
	}
	
	

	
	
}
?>