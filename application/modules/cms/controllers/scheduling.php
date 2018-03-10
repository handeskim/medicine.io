<?php
class Scheduling extends MY_Controller{
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
	
	private function scheduling_edit($id){
		if($this->permisson == 3 || $this->permisson == 5){
			return error_authorities();
		}else{
			$xcrud = Xcrud::get_instance();
			$xcrud->table('scheduling_callback');
			$xcrud->unset_add();
			$xcrud->unset_csv();
			$xcrud->where('id',$id);
			$xcrud->unset_csv();
			$xcrud->unset_print();
			$xcrud->unset_remove();
			$xcrud->unset_csv();
			$xcrud->unset_limitlist();
			$xcrud->unset_numbers();
			$xcrud->unset_pagination();
			$xcrud->unset_print();
			$xcrud->unset_search();
			$xcrud->unset_sortable();
			$xcrud->order_by('scheduling','desc');
			if($this->permisson == 2 || $this->permisson == 4){
				$xcrud->unset_remove();
			}
			if($this->permisson == 4){
				$xcrud->where('code_staff',$this->staff);
			}
			$xcrud->table_name('[Customer care] - Chỉnh sửa lịch gọi ID: '.$id);
			$xcrud->label('code_staff','Mã Nhân viên');
			$xcrud->label('code_customer','Mã Khách hàng');
			$xcrud->label('scheduling','Ngày lập lịch');
			$xcrud->label('note','Ghi chú');
			$xcrud->validation_required('code_staff');
			$xcrud->relation('status','status_callback','id','name_status');
			$xcrud->relation('code_staff','staff','id','code' ,'id='.$this->staff);
			$xcrud->relation('code_customer','customer','code','code','supervisor='.$this->staff);
			$xcrud->validation_required('code_customer');
			$xcrud->validation_required('scheduling');
			$xcrud->change_type('note', 'textarea');
			$xcrud->benchmark();
			$response = $xcrud->render('edit',$id);
			return $response;
			
		}
	}
	public function edit($id){
		
		if($this->permisson == 5 || $this->permisson == 3 ){
			redirect(base_url('apps'));
		}
		$msg ='';
		
		$data = array(
			'msg' => $msg,
			'content' => $this->scheduling_edit($id),
			'user_data' => $this->user_data,
			'title'=> 'chỉnh sửa  lịch gọi lại',
			'title_main' => 'chỉnh sửa   lịch gọi lại',
		);
		$this->parser->parse('default/header',$data);
		$this->parser->parse('default/sidebar',$data);
		$this->parser->parse('default/main',$data);
		$this->parser->parse('default/layout/main_curd_account',$data);
		$this->parser->parse('default/footer',$data);
	}
	public function index(){
		if($this->permisson == 5 || $this->permisson == 3 ){
			redirect(base_url('apps'));
		}
		$msg ='';
		$data = array(
			'msg' => $msg,
			'content' => $this->scheduling(),
			'user_data' => $this->user_data,
			'title'=> 'Lập lịch gọi lại',
			'title_main' => 'Lập lịch gọi lại',
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
			$xcrud->unset_csv();
			$xcrud->unset_print();
			$xcrud->order_by('scheduling','desc');
			if($this->permisson == 2 || $this->permisson == 4){
				$xcrud->unset_remove();
			}
			if($this->permisson == 4){
				$xcrud->where('code_staff',$this->staff);
			}
			$xcrud->table_name('[Customer care] - Lập lịch gọi lại');
			$xcrud->label('code_staff','Mã Nhân viên');
			$xcrud->label('code_customer','Mã Khách hàng');
			$xcrud->label('scheduling','Ngày lập lịch');
			$xcrud->label('note','Ghi chú');
			$xcrud->validation_required('code_staff');
			$xcrud->relation('status','status_callback','id','name_status');
			$xcrud->relation('code_staff','staff','id','code' ,'id='.$this->staff);
			$xcrud->relation('code_customer','customer','code','code','supervisor='.$this->staff);
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