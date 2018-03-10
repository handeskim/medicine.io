<?php
class Generic extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
		$this->load->model('global_model', 'GlobalMD');	
		$this->login = $this->session->userdata('auth_sign');
		
		if($this->login){
			$this->user_data = $this->session->userdata('data_users');
			$this->permisson = $this->user_data['authorities'];
			$this->staff = $this->user_data['id'];
		}else{
			redirect(base_url('sign'));
		}
		
	}
	public function index(){
		if($this->permisson == 5 || $this->permisson == 3 || $this->permisson == 4){
			redirect(base_url('apps'));
		}
		$msg ='';
		$data = array(
			'msg' => $msg,
			'content' => $this->Generics(),
			'user_data' => $this->user_data,
			'title'=> 'Cấu Hình Chung ',
			'title_main' => 'Cấu Hình Chung ',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_account',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function Generics(){
		if($this->permisson == 1 || $this->permisson == 2){
			$xcrud = Xcrud::get_instance();
			$xcrud->table('generic');
			$xcrud->unset_remove();
			$xcrud->unset_print();
			$xcrud->unset_add();
			$xcrud->unset_csv();
			 $xcrud->unset_add();
			$xcrud->unset_csv();
			$xcrud->unset_limitlist();
			$xcrud->unset_numbers();
			$xcrud->unset_pagination();
			$xcrud->unset_print();
			$xcrud->unset_search();
			$xcrud->unset_sortable();
			$xcrud->table_name('[MPP] - Cấu Hình Chung');
			$xcrud->label('company_invoice','Thông tin công ty ở hóa đơn');
			$xcrud->validation_required('name_type_orders');
			$response = $xcrud->render();
			return $response;
		}else{
			return error_authorities();
		}
	}
}
?>