<?php
class Staff extends MY_Controller{
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
	public function Update_Password(){
		$id_user = $_GET['key'];
		if(isset($id_user)){
			$msg ='';
			$data = array(
				'msg' => $msg,
				'content' => $this->chane_pass($id_user),
				'user_data' => $this->user_data,
				'title'=> 'Thay đổi mật khẩu',
				'title_main' => 'Thay đổi mật khẩu',
			);
			$this->parser->parse('default/header',$data);
			$this->parser->parse('default/sidebar',$data);
			$this->parser->parse('default/main',$data);
			$this->parser->parse('default/layout/main_curd_Password',$data);
			$this->parser->parse('default/footer',$data);
		}else{
			redirect(base_url('apps'));
		}
		
	}
	private function chane_pass($id_user){
		if($this->permisson == 1 || $this->permisson == 2){
			$xcrud = Xcrud::get_instance();
			$xcrud->table('staff');
			$xcrud->where('authorities !=','1');
			$xcrud->where('id =',$id_user);
			$xcrud->order_by('id','desc');
			$xcrud->unset_csv();
			$xcrud->unset_add();
			if($this->permisson == 2){
				$xcrud->unset_remove();
			}
			$xcrud->table_name('[HRM] - Thay đổi mật khẩu ID: '.$id_user);
			$xcrud->label('full_name','Họ Và Tên');
			$xcrud->label('email','email');
			$xcrud->label('ngay_sinh','Ngày Sinh');
			$xcrud->label('dia_chi','Địa Chỉ');
			$xcrud->label('Gửi email','Số Điện Thoại');
			$xcrud->label('dien_thoai','Số Điện Thoại');
			$xcrud->label('hinh_anh','Ảnh Đại Diện');
			$xcrud->label('passport_id','CMTND Hoặc Hộ Chiếu');
			$xcrud->label('code','Mã nhân viên');
			$xcrud->label('password','Mật khẩu');
			$xcrud->label('authorities','Quyền hạn');
			$xcrud->label('status','Trạng Thái');
			$xcrud->validation_required('status');
			$xcrud->validation_required('password',6);
			$xcrud->validation_required('email');
			$xcrud->validation_required('full_name');
			$xcrud->validation_required('authorities');
			$xcrud->relation('status','status','id','name_status');
			$xcrud->relation('authorities','authorities','id','name_auth');
			$xcrud->fields('password');
			$xcrud->change_type('password', 'password', 'md5', array('placeholder'=>'enter password'));
			$xcrud->columns('status,code,full_name,hinh_anh,email,passport_id,authorities,status,dien_thoai,sendmail');
			$xcrud->change_type('password', 'password', 'md5', array('class'=>'xcrud-input form-control', 'maxlength'=>10,'placeholder'=>'Nhập mật khẩu'));
			$xcrud->change_type('hinh_anh', 'image', '', 
				array(
						'width' => 200, 
						'height' => 200,
						'path' => '/upload/staff/',
					)
			);
			$response = $xcrud->render('edit',$id_user);
			return $response;
		}else{
			return error_authorities();
		}
	}
	public function addnew(){
		$msg ='';
		if($this->permisson == 1 || $this->permisson == 2 ){
			$cmd = $this->input->post('cmd');
			if($cmd ==1000){
				$params = $_POST;
				$msg = $this->InsertStaff($params);
			}
			
			$data = array(
				'msg' => $msg,
				'content' => $this->staffs(),
				'Addauthorities' => $this->Addauthorities(),
				'user_data' => $this->user_data,
				'excel_command' => $this->excel_command(),
				'title'=> 'Thêm mới nhân sự',
				'title_main' => 'Thêm mới nhân sự',
			);
			$this->parser->parse('default/header',$data);
			$this->parser->parse('default/sidebar',$data);
			$this->parser->parse('default/main',$data);
			$this->parser->parse('default/layout/main_add_staff',$data);
			$this->parser->parse('default/footer',$data);
		}else{
			redirect(base_url('cms/staff'));
		}
	}
	private function InsertStaff($params){
		$this->db->insert('staff', $params); 
		$id_staff = $this->db->insert_id();
		if(isset($id_staff)){
			$array_staff = array(
				'code' => 'PQA0'.$id_staff,
				'password' => md5($params['password']),
				'status' => 1,
				'hinh_anh' => null,
			);
			$this->db->where('id', $id_staff);
			$Update = $this->db->update('staff', $array_staff); 
			if($Update==true){
				return '<div class="callout callout-success">
					<h4>Thành công!</h4>
					<p>Tạo mới nhân sự Thành công vui lòng về trang quản lý nhân sự <a href="'. base_url('cms/staff').'"> xem chi tiết </a></p>
				  </div>';
			}else{
				return '<div class="callout callout-danger">
					<h4>Thất bại!</h4>
					<p>Tạo mới nhân sự thất bại vui lòng thử lại.</p>
				  </div>';
			}
		}else{
			return '<div class="callout callout-danger">
                <h4>Thất bại!</h4>
                <p>Tạo mới nhân sự thất bại vui lòng thử lại.</p>
              </div>';
		}
	}
	private function Addauthorities(){
		$sql = "SELECT * FROM authorities WHERE id != 1";
		return $this->GlobalMD->query_global($sql);
	}
	public function index(){
		if($this->permisson == 5 || $this->permisson == 3 || $this->permisson == 4){
			redirect(base_url('apps'));
		}
		$msg ='';
		$data = array(
			'msg' => $msg,
			'content' => $this->staffs(),
			'user_data' => $this->user_data,
			'excel_command' => $this->excel_command(),
			'title'=> 'Quản lý nhân sự',
			'title_main' => 'Quản lý nhân sự',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_staff',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function excel_command(){
		$user = $this->staff;
		$permisson = $this->permisson;
		if($this->permisson == 1 || $this->permisson == 2 ){
			$sql = "SELECT 
			s.full_name,
			s.`code`,
			s.dia_chi,
			s.dien_thoai,
			s.discount,
			s.email,
			s.ngay_sinh,
			s.passport_id,
			st.name_status,
			a.name_auth
			FROM staff s 
			INNER JOIN authorities a ON s.authorities = a.id 
			INNER JOIN `status` st ON s.`status` = st.id";
		}else{
			$sql = "
			SELECT 
			s.full_name,
			s.`code`,
			s.dia_chi,
			s.dien_thoai,
			s.discount,
			s.email,
			s.ngay_sinh,
			s.passport_id,
			st.name_status,
			a.name_auth
			FROM staff s 
			INNER JOIN authorities a ON s.authorities = a.id 
			INNER JOIN `status` st ON s.`status` = st.id
			WHERE s.authorities = $permisson
			AND s.id = $user";
		}
		return core_encode($sql);
	}
	private function staffs(){
		if($this->permisson == 1 || $this->permisson == 2){
			$xcrud = Xcrud::get_instance();
			$xcrud->table('staff');
			$xcrud->where('authorities !=','1');
			$xcrud->order_by('id','desc');
			$xcrud->unset_csv();
			$xcrud->unset_add();
			if($this->permisson == 2){
				$xcrud->unset_remove();
			}
			$xcrud->table_name('[HRM] - Quản lý nhân viên');
			$xcrud->label('full_name','Họ Và Tên');
			$xcrud->label('email','email');
			$xcrud->label('ngay_sinh','Ngày Sinh');
			$xcrud->label('dia_chi','Địa Chỉ');
			$xcrud->label('Gửi email','Số Điện Thoại');
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
			$xcrud->fields('status,full_name,hinh_anh,email,passport_id,authorities,status,dien_thoai,sendmail,discount');
			$xcrud->columns('status,code,full_name,hinh_anh,email,passport_id,authorities,status,dien_thoai,sendmail');
			$xcrud->button(base_url().'cms/staff/Update_Password?key={id}','Đổi mật khẩu','icon-link','',array('target'=>'_blank'));
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