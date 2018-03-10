<?php
class Customer_Management extends MY_Controller{
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
	private function InsertCustomer($params){
		$this->db->insert('customer', $params); 
		$id_customer = $this->db->insert_id();
		if(isset($id_customer)){
			$array_staff = array(
				'code' => 'KHPQA0'.$id_customer,
				'supervisor' => $this->staff,
			);
			$this->db->where('id', $id_customer);
			$Update = $this->db->update('customer', $array_staff); 
			if($Update==true){
				return '<div class="callout callout-success">
					<h4>Thành công!</h4>
					<p>Tạo mới khách hàng Thành công vui lòng về trang quản lý nhân sự <a href="'. base_url('cms/customer_management').'"> xem chi tiết </a></p>
				  </div>';
			}else{
				return '<div class="callout callout-danger">
					<h4>Thất bại!</h4>
					<p>Tạo mới  khách hàng thất bại vui lòng thử lại.</p>
				  </div>';
			}
		}else{
			return '<div class="callout callout-danger">
                <h4>Thất bại!</h4>
                <p>Tạo mới  khách hàng thất bại vui lòng thử lại.</p>
              </div>';
		}
	}
	public function addnew(){
		$msg ='';
		if($this->permisson == 3 || $this->permisson == 5 ){
			redirect(base_url('apps'));
		}
			$cmd = $this->input->post('cmd');
			if($cmd ==1000){
				$params = $_POST;
				$msg = $this->InsertCustomer($params);
			}
		$data = array(
			'msg' => $msg,
			'content' => $this->Customer(),
			'user_data' => $this->user_data,
			'excel_command' => $this->excel_command(),
			'staff' => $this->staff,
			'total_customer' => $this->total_customer(),
			'title'=> 'Quản lý khách hàng',
			'title_main' => 'Quản lý khách hàng',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_addcustomer',$data);
		$this->parser->parse('default/footer',$data);
	}
	
	public function edit(){
		$id_customer = $this->input->get('query');
		if($this->permisson == 3 || $this->permisson == 5 ){
			redirect(base_url('apps'));
		}
		$msg ='';
		$data = array(
			'msg' => $msg,
			'content' => $this->edit_customer($id_customer),
			'user_data' => $this->user_data,
			'excel_command' => $this->excel_command(),
			'total_customer' => $this->total_customer(),
			'title'=> 'Quản lý khách hàng',
			'title_main' => 'Quản lý khách hàng',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_Customers',$data);
		$this->parser->parse('default/footer',$data);
	}
	public function view(){
		$id_customer = $this->input->get('query');
		$msg ='';
		$data = array(
			'msg' => $msg,
			'content' => $this->view_customer($id_customer),
			'user_data' => $this->user_data,
			'excel_command' => $this->excel_command(),
			'total_customer' => $this->total_customer(),
			'title'=> 'Quản lý khách hàng',
			'title_main' => 'Quản lý khách hàng',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_Customers',$data);
		$this->parser->parse('default/footer',$data);
	}
	public function index(){
		if($this->permisson == 3 || $this->permisson == 5 ){
			redirect(base_url('apps'));
		}
		$msg ='';
		$data = array(
			'msg' => $msg,
			'content' => $this->Customer(),
			'user_data' => $this->user_data,
			'excel_command' => $this->excel_command(),
			'total_customer' => $this->total_customer(),
			'title'=> 'Quản lý khách hàng',
			'title_main' => 'Quản lý khách hàng',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_Customers',$data);
		$this->parser->parse('default/footer',$data);
	}
	private function excel_command(){
		$user = $this->staff;
		if($this->permisson == 1 || $this->permisson == 2 ){
			$sql = "SELECT 
			c.code,
			c.full_name,
			c.email,
			c.ngay_sinh,
			c.dia_chi,
			c.dien_thoai,
			c.dien_thoai_2,
			c.passport_id,
			c.note,
			s.full_name as name_staff, s.email as account_staff FROM customer c
			INNER JOIN staff s ON s.id = c.supervisor";
		}else{
			$sql = "SELECT 
			c.code,
			c.full_name,
			c.email,
			c.ngay_sinh,
			c.dia_chi,
			c.dien_thoai,
			c.dien_thoai_2,
			c.passport_id,
			c.note,
			s.full_name as name_staff, s.email as account_staff FROM customer c
			INNER JOIN staff s ON s.id = c.supervisor WHERE supervisor =  '$user' ";
		}
		return core_encode($sql);
	}
	private function total_customer(){
		$user = $this->staff;
		
		try { 
			if($this->permisson == 1 || $this->permisson == 2 || $this->permisson == 3 || $this->permisson == 5){
				$sql ="SELECT count(id) as total FROM customer";
			}else{
				$sql ="SELECT count(id) as total FROM customer WHERE supervisor =  '$user' ";
			}
			$reponse = $this->GlobalMD->query_global($sql);
			$result = $reponse[0]['total'];
		}catch (Exception $e) {
			$result = 0;
		}
		return $result;
	}
	private function edit_customer($id_customer){
		
		$user = $this->staff;
			$xcrud = Xcrud::get_instance();
			$xcrud->table('customer');
			$xcrud->unset_csv();
			$xcrud->where('id',$id_customer);
			$xcrud->order_by('id','desc');
			$xcrud->unset_add();
			
			if($this->permisson == 4){
				$xcrud->where('supervisor',$this->staff);
				$xcrud->unset_remove();
			}
			if($this->permisson == 2 || $this->permisson == 3 || $this->permisson == 5){
				$xcrud->unset_remove();
				$xcrud->unset_edit();
			}
			if($this->permisson == 3 || $this->permisson == 5){
				$xcrud->unset_print();
			}
			$xcrud->table_name('[Customer] - Quản lý khách hàng');
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
			
			if($this->permisson == 4){
				$xcrud->columns('code,full_name,email,dien_thoai');
				$xcrud->fields('dia_chi,full_name,dien_thoai,email,passport_id,dien_thoai_2,note,hinh_anh,ngay_sinh');
			}else{
				$xcrud->columns('code,full_name,email,dien_thoai,supervisor');
			}
			if($this->permisson == 1 || $this->permisson == 2){
				$xcrud->fields('dia_chi,full_name,dien_thoai,email,passport_id,dien_thoai_2,note,hinh_anh,ngay_sinh,supervisor');
			}
			
			if($this->permisson == 4 || $this->permisson == 5|| $this->permisson == 3){
				$xcrud->relation('supervisor','staff','id',array('code'),'authorities=4 and id='.$user);
			}else{
				$xcrud->relation('supervisor','staff','id',array('code'),'authorities=4');
			}
			$xcrud->change_type('hinh_anh', 'image', '', array('width' => 200, 'height' => 200,'path' => '/upload/Customer/',));
			$xcrud->button(base_url().'prints/customer_details?code={id}','Prints','fa fa-print','',array('target'=>'_blank'));
			$xcrud->benchmark();
			$response = $xcrud->render('edit',$id_customer);
			return $response;
	
	}
	private function view_customer($id_customer){
		
		$user = $this->staff;
			$xcrud = Xcrud::get_instance();
			$xcrud->table('customer');
			$xcrud->unset_csv();
			$xcrud->where('id',$id_customer);
			$xcrud->order_by('id','desc');
			$xcrud->unset_add();
			
			if($this->permisson == 4){
				$xcrud->where('supervisor',$this->staff);
				$xcrud->unset_remove();
			}
			if($this->permisson == 2 || $this->permisson == 3 || $this->permisson == 5){
				$xcrud->unset_remove();
				$xcrud->unset_edit();
			}
			if($this->permisson == 3 || $this->permisson == 5){
				$xcrud->unset_print();
			}
			$xcrud->table_name('[Customer] - Quản lý khách hàng');
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
			
			if($this->permisson == 4){
				$xcrud->columns('code,full_name,email,dien_thoai');
				$xcrud->fields('dia_chi,full_name,dien_thoai,email,passport_id,dien_thoai_2,note,hinh_anh,ngay_sinh');
			}else{
				$xcrud->columns('code,full_name,email,dien_thoai,supervisor');
			}
			if($this->permisson == 1 || $this->permisson == 2){
				$xcrud->fields('dia_chi,full_name,dien_thoai,email,passport_id,dien_thoai_2,note,hinh_anh,ngay_sinh,supervisor');
			}
			
			if($this->permisson == 4 || $this->permisson == 5|| $this->permisson == 3){
				$xcrud->relation('supervisor','staff','id',array('code'),'authorities=4 and id='.$user);
			}else{
				$xcrud->relation('supervisor','staff','id',array('code'),'authorities=4');
			}
			$xcrud->change_type('hinh_anh', 'image', '', array('width' => 200, 'height' => 200,'path' => '/upload/Customer/',));
			$xcrud->button(base_url().'prints/customer_details?code={id}','Prints','fa fa-print','',array('target'=>'_blank'));
			$xcrud->benchmark();
			$response = $xcrud->render('view',$id_customer);
			return $response;
	
	}
	private function Customer(){
		$user = $this->staff;
			$xcrud = Xcrud::get_instance();
			$xcrud->table('customer');
			$xcrud->unset_csv();
			$xcrud->order_by('id','desc');
			$xcrud->unset_add();
			
			if($this->permisson == 4){
				$xcrud->where('supervisor',$this->staff);
				$xcrud->unset_remove();
			}
			if($this->permisson == 2 || $this->permisson == 3 || $this->permisson == 5){
				$xcrud->unset_remove();
				$xcrud->unset_edit();
			}
			if($this->permisson == 3 || $this->permisson == 5){
				$xcrud->unset_print();
			}
			$xcrud->table_name('[Customer] - Quản lý khách hàng');
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
			
			if($this->permisson == 4){
				$xcrud->columns('code,full_name,email,dien_thoai');
				$xcrud->fields('dia_chi,full_name,dien_thoai,email,passport_id,dien_thoai_2,note,hinh_anh,ngay_sinh');
			}else{
				$xcrud->columns('code,full_name,email,dien_thoai,supervisor');
			}
			if($this->permisson == 1 || $this->permisson == 2){
				$xcrud->fields('dia_chi,full_name,dien_thoai,email,passport_id,dien_thoai_2,note,hinh_anh,ngay_sinh,supervisor');
			}
			
			if($this->permisson == 4 || $this->permisson == 5|| $this->permisson == 3){
				$xcrud->relation('supervisor','staff','id',array('code'),'authorities=4 and id='.$user);
			}else{
				$xcrud->relation('supervisor','staff','id',array('code'),'authorities=4');
			}
			$xcrud->change_type('hinh_anh', 'image', '', array('width' => 200, 'height' => 200,'path' => '/upload/Customer/',));
			$xcrud->button(base_url().'prints/customer_details?code={id}','Prints','fa fa-print','',array('target'=>'_blank'));
			$xcrud->benchmark();
			$response = $xcrud->render();
			return $response;
	
	}
}
?>