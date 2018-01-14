<?php
class Staff extends MY_Controller{
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
			'content' => $this->staff(),
			'user_data' => $this->user_data,
			'title'=> 'Staff Management',
			'title_main' => 'Staff Management',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_account',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function staff(){
		if($this->permisson == 1 || $this->permisson == 2){
			$xcrud = Xcrud::get_instance();
			$xcrud->table('staff');
			$xcrud->where('authorities !=','1');
			$xcrud->unset_csv();
			$xcrud->unset_csv();
			if($this->permisson == 2){
				$xcrud->unset_remove();
			}
			$xcrud->table_name('[HRM] - Staff Management');
			$xcrud->label('full_name','Họ Và Tên');
			$xcrud->label('email','email');
			$xcrud->label('ngay_sinh','Ngày Sinh');
			$xcrud->label('dia_chi','Địa Chỉ');
			$xcrud->label('dien_thoai','Số Điện Thoại');
			$xcrud->label('hinh_anh','Ảnh Đại Diện');
			$xcrud->label('passport_id','CMTND Hoặc Hộ Chiếu');
			$xcrud->label('code','Mã nhân viên');
			$xcrud->label('password','Mật khẩu');
			$xcrud->label('authorities','Quyền hạn');
			$xcrud->label('status','Trạng Thái');
			$xcrud->validation_required('status');
			$xcrud->validation_required('password',8);
			$xcrud->validation_required('email');
			$xcrud->validation_required('full_name');
			$xcrud->validation_required('authorities');
			$xcrud->relation('status','status','id','name_status');
			$xcrud->relation('authorities','authorities','id','name_auth');
			$xcrud->columns('status,code,full_name,hinh_anh,email,passport_id,authorities,status,dien_thoai');
			// $xcrud->fields('full_name,email,password,authorities,');
			$xcrud->change_type('password', 'password', 'md5', array('class'=>'xcrud-input form-control', 'maxlength'=>10,'placeholder'=>'Nhập mật khẩu'));
			$xcrud->change_type('hinh_anh', 'image', '', 
				array(
						'width' => 200, 
						'height' => 200,
						'path' => '/upload/staff/',
					)
			);
			$response = $xcrud->render();
			return $response;
		}else{
			return error_authorities();
		}
	}
}
?>