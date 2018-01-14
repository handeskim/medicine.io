<?php
class Oders_Management extends MY_Controller{
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
			'content' => $this->Order(),
			'user_data' => $this->user_data,
			'title'=> 'Orders Management',
			'title_main' => 'Orders Management',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_Product',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function Order(){
	
			$xcrud = Xcrud::get_instance();
			$xcrud->table('orders');
			$xcrud->unset_csv();
			$xcrud->unset_print();
			$xcrud->where('code_staff',$this->users);
			$xcrud->unset_add();
			if($this->permisson == 2){
				$xcrud->unset_remove();
			}
			$xcrud->table_name('[Orders] - Orders Management');
		
			$xcrud->label('code_products','Mã Sản Phẩm');
			$xcrud->label('code_orders','Mã Đơn hàng');
			$xcrud->label('type_post','Nhà Bưu Chính');
			$xcrud->label('type_orders','Trạng Thái');
			$xcrud->label('code_staff','Mã Nhân viên');
			$xcrud->label('code_customner','Mã Mã khách hàng');
			$xcrud->label('quantily','Số lượng');
			$xcrud->label('price','Giá');
			$xcrud->label('manuals','Hướng Dẫn');
			$xcrud->label('note','Ghi chú');
			$xcrud->relation('code_products','products','id','code_products');
			$xcrud->relation('type_orders','type_oders','id','name_oders');
			$xcrud->relation('type_post','type_post','id','name_type_orders');
			$xcrud->relation('code_staff','staff','id','code');
			
			$products_list = $xcrud->nested_table('code_products','products','id','code_products');
			$products_list->unset_add(); 
			$products_list->unset_edit(); 
			$products_list->unset_remove(); 
			$Staff_list = $xcrud->nested_table('code_staff','staff','id','code');
			$Staff_list->unset_add(); 
			$Staff_list->unset_edit(); 
			$Staff_list->unset_remove(); 
			$xcrud->benchmark();
			$response = $xcrud->render();
			return $response;
		
	}
}
?>