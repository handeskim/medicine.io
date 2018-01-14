<?php
class Customer_Management extends MY_Controller{
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
			'content' => $this->Customer(),
			'user_data' => $this->user_data,
			'title'=> 'Customer Management',
			'title_main' => 'Customer Management',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_Product',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function Customer(){
		
			$xcrud = Xcrud::get_instance();
			$xcrud->table('customer');
			$xcrud->unset_csv();
			$xcrud->unset_print();
			$xcrud->where('supervisor',$this->users);
			if($this->permisson != 1){
				$xcrud->unset_remove();
			}
			$xcrud->table_name('[Customer] - Customer Management');
			$xcrud->label('code','Mã khách hàng');
			$xcrud->label('full_name','Họ Va Tên');
			$xcrud->label('email','email');
			$xcrud->label('ngay_sinh','Ngày Sinh');
			$xcrud->label('dia_chi','Địa Chỉ ');
			$xcrud->label('dien_thoai','Điện thoại');
			$xcrud->label('dien_thoai_2','Điện thoại 2');
			$xcrud->label('hinh_anh','Hình Ảnh');
			$xcrud->label('passport_id','CMTND');
			$xcrud->label('note','Ghi chú');
			$xcrud->label('supervisor','Nhân viên Tiếp Thị');
			$xcrud->validation_required('code');
			$xcrud->validation_required('full_name');
			$xcrud->validation_required('email');
			$xcrud->validation_required('ngay_sinh');
			$xcrud->validation_required('dia_chi');
			$xcrud->validation_required('dien_thoai');
			$xcrud->validation_required('supervisor');
			$xcrud->relation('supervisor','staff','id',array('code'),'authorities=4');
			$xcrud->change_type('hinh_anh', 'image', '', 
				array(
						'width' => 200, 
						'height' => 200,
						'path' => '/upload/Customer/',
					)
			);
			//$xcrud->relation('generic','generic_pharma','id','name_generic_pharma');
			// $xcrud->relation('authorities','authorities','id','name_auth');
			// $xcrud->columns('status,code,full_name,hinh_anh,email,passport_id,authorities,status,dien_thoai');
			//$xcrud->fields('code_products,name_products,label_products,types,generic,quantily,price,images,manuals,note');
			// $xcrud->change_type('password', 'password', 'md5', array('class'=>'xcrud-input form-control', 'maxlength'=>10,'placeholder'=>'Nhập mật khẩu'));
			//$xcrud->change_type('images', 'image', '', 
									//array(
									//		'width' => 200, 
									//		'height' => 200,
									//		'path' => '/upload/product',
									//	)
								//);
			$xcrud->benchmark();
			$response = $xcrud->render();
			return $response;
	
	}
}
?>