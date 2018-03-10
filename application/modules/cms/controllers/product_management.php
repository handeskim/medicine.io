<?php
class Product_Management extends MY_Controller{
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
		$msg ='';
		$data = array(
			'msg' => $msg,
			'content' => $this->Product(),
			'user_data' => $this->user_data,
			'title'=> 'Quản lý sản phẩm',
			'title_main' => 'Quản lý sản phẩm',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_Product',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function Product(){
		
			$xcrud = Xcrud::get_instance();
			$xcrud->table('products');
			$xcrud->unset_csv();
			$xcrud->unset_print();
			if($this->permisson == 4 ||  $this->permisson == 5){
				$xcrud->unset_remove();
				$xcrud->unset_add();
				$xcrud->unset_edit();
				$xcrud->table_name('[Product] - Danh Sách sản phẩm');
			}
			if($this->permisson == 3){
				$xcrud->unset_remove();
				$xcrud->table_name('[Product] - Quản lý sản phẩm');
				$xcrud->fields('quantily,price');
			}
			if($this->permisson == 2){
				$xcrud->unset_remove();
				$xcrud->table_name('[Product] - Quản lý sản phẩm');
				$xcrud->fields('code_products,name_products,label_products,types,generic,quantily,price,images,manuals,note');
			}
			if($this->permisson == 1){
				$xcrud->table_name('[Product] - Quản lý sản phẩm');
				$xcrud->fields('code_products,name_products,label_products,types,generic,quantily,price,images,manuals,note');
			}
			$xcrud->label('code_products','Mã Sản Phẩm');
			$xcrud->label('name_products','Tên Sản Phẩm');
			$xcrud->label('label_products','Nhãn sản phẩm');
			$xcrud->label('quantily','Số Lượng');
			$xcrud->label('images','Hình Ảnh');
			$xcrud->label('price','Giá');
			$xcrud->label('manuals','Hướng Dẫn Sử Dụng');
			$xcrud->label('note','Ghi Chú');
			$xcrud->label('types','Loại');
			$xcrud->label('generic','Kiểu');
			// $xcrud->change_type('price', 'price', '5', array('prefix'=>''));
			$xcrud->validation_required('code_products');
			$xcrud->validation_required('name_products');
			$xcrud->validation_required('label_products');
			$xcrud->validation_required('quantily');
			$xcrud->validation_required('price');
			$xcrud->validation_required('types');
			$xcrud->validation_required('generic');
			$xcrud->relation('types','types_pharma','id','name_types_pharma');
			$xcrud->relation('generic','generic_pharma','id','name_generic_pharma');
		
			$xcrud->change_type('images', 'image', '', array('width' => 200, 'height' => 200,'path' => '/upload/product',));
			$xcrud->benchmark();
			$response = $xcrud->render();
			return $response;
		
	}
}
?>