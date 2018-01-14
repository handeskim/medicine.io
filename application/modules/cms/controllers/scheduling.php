<?php
class Scheduling extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
		$this->load->model('global_model', 'GlobalMD');	
		$this->login = $this->session->userdata('auth_sign');
		$this->user_data = $this->session->userdata('data_users');
		$this->permisson = $this->user_data['authorities'];
		$this->users = $this->user_data['id'];
		if(isset($this->login)==false){
			redirect(base_url('sign'));
		}
		
	}
	public function index(){
		
		$msg ='';
		$data = array(
			'msg' => $msg,
			'content' => $this->scheduling(),
			'user_data' => $this->user_data,
			'title'=> 'Customer care',
			'title_main' => 'Customer care',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_account',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function scheduling(){
		if($this->permisson == 3 || $this->permisson == 5){
			return error_authorities();
		}else{
			$xcrud = Xcrud::get_instance();
			$xcrud->table('scheduling_callback');
			$xcrud->unset_csv();
			$xcrud->unset_print();
			if($this->permisson == 2 || $this->permisson == 4){
				$xcrud->unset_remove();
			}
			if($this->permisson == 4){
				$xcrud->where('code_staff',$this->users);
			}
			$xcrud->table_name('[Customer care] - Scheduling Callback');
			$xcrud->label('code_staff','Mã Nhân viên');
			$xcrud->label('code_customer','Mã Khách hàng');
			$xcrud->label('scheduling','Ngày lập lịch');
			$xcrud->label('note','Ghi chú');
			$xcrud->validation_required('code_staff');
			$xcrud->validation_required('code_customer');
			$xcrud->validation_required('scheduling');
			$xcrud->change_type('note', 'textarea');
			$xcrud->benchmark();
			$response = $xcrud->render();
			return $response;
			
		}
	}
}
?>