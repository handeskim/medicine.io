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
			$this->db->where('code_orders', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url('cms/oders_management'));
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
			$this->db->where('code_orders', $query);
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
			$this->db->where('code_orders', $query);
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

	public function accountancy(){
		$query = $this->input->get('query');
		$data_notifation = array(
				'title' => 'Kế toán đã xác nhận: '.$query,
				'status' => 1,
				'authorities' => 5,
			);
		$this->db->where('links', $query);
	
		$UpdateNotifation = $this->db->update('notification', $data_notifation); 
		
		if($UpdateNotifation==true){
			$data_Orders = array(
				'type_orders' => 3,
				'date_confim' => date('Y-m-d H:i:s',time()),
			);
			$this->db->where('code_orders', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url('cms/oders_management'));
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
			$this->db->where('code_orders', $query);
			$UpdateOrderStatus = $this->db->update('orders', $data_Orders); 
			redirect(base_url('cms/oders_management'));
		}
	}
	
	

	
	
}
?>