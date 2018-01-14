<?php
class PartnersPost extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
		$this->load->model('global_model', 'GlobalMD');	
		$this->login = $this->session->userdata('auth_sign');
		$this->user_data = $this->session->userdata('data_users');
		$this->permisson = $this->user_data['authorities'];
		$id_clients = $this->user_data['id'];
		if(isset($this->login)==false){
			redirect(base_url('sign'));
		}
		
	}
	public function index(){
		
		$msg ='';
		$data = array(
			'msg' => $msg,
			'content' => $this->PartnersPost(),
			'user_data' => $this->user_data,
			'title'=> 'Partners Post',
			'title_main' => 'Partners Post',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_account',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function PartnersPost(){
		if($this->permisson == 1 || $this->permisson == 2){
			$xcrud = Xcrud::get_instance();
			$xcrud->table('type_post');
			$xcrud->unset_csv();
			if($this->permisson == 2){
				$xcrud->unset_remove();
			}
			$xcrud->table_name('[MPP] - Management Partners Post');
			$xcrud->label('name_type_orders','Tên Nhà Cung Cấp Bưu Chính');
			$xcrud->label('url_check_orders','URL Kiểm Tra Bưu Chính ');
			$xcrud->validation_required('name_type_orders');
			$xcrud->validation_required('url_check_orders');
			$xcrud->columns('name_type_orders,url_check_orders');
			$xcrud->fields('name_type_orders,url_check_orders');
			$xcrud->benchmark();
			$response = $xcrud->render();
			return $response;
		}else{
			return error_authorities();
		}
	}
}
?>