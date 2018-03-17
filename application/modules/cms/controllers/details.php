<?php
class Details extends MY_Controller{
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
		if(isset($_GET['token'])){
			$query = core_decode($_GET['token']);
			if(!empty($query)){
				$msg ='';
				$data = array(
					'msg' => '',
					'content' => $this->Order($query),
					'user_data' => $this->user_data,
					'title'=> 'Quản lý Đơn hàng',
					'title_main' => 'Quản lý Đơn hàng',
				);
				$this->parser->parse('default/header',$data);
				$this->parser->parse('default/sidebar',$data);
				$this->parser->parse('default/main',$data);
				$this->parser->parse('default/layout/main_curd_order',$data);
				$this->parser->parse('default/footer',$data);
			}
		}
	}
	
	
	private function Order($query){
	
			$xcrud = Xcrud::get_instance();
			$xcrud->table('orders');
			$xcrud->unset_view();
			$xcrud->where('bill_code',$query);
			$xcrud->unset_csv();
			$xcrud->unset_print();
			$xcrud->unset_add();
			
			$xcrud->button(base_url().'prints/letter?query={bill_code}','In PB','fa fa-envelope-o','',array('target'=>'_blank','class'=>'btn btn-primary'));
			$xcrud->button(base_url().'prints/guide?query={bill_code}','In HD','fa fa-file','',array('target'=>'_blank'));
			$xcrud->button(base_url().'prints/orders?query={bill_code}','In đơn','fa fa-file','',array('target'=>'_blank','class'=>'btn btn-primary'));
			$xcrud->button(base_url().'route/tracking?key={bill_code}&posts={type_post}','Tra vận đơn','fa fa-ship','',array('target'=>'_blank'));
			
			if($this->permisson == 3 ){
				$xcrud->table_name('[Orders] - Chi tiết Mã vận đơn số <b style="color:red;">#'.$query.'</b>');
				$xcrud->unset_remove();
				$xcrud->where('type_orders',2);
				$xcrud->or_where('type_orders',7);
				$xcrud->unset_edit();
			}
			
			if($this->permisson == 5 ){
				$xcrud->table_name('[Orders] - Chi tiết Mã vận đơn số <b style="color:red;">#'.$query.'</b>');
				$xcrud->unset_edit();
				$xcrud->unset_remove();
				$xcrud->fields('type_orders');
			}
			if($this->permisson == 4){
				$xcrud->table_name('[Orders] - Chi tiết Mã vận đơn số <b style="color:red;">#'.$query.'</b>');
				$xcrud->unset_remove();
				$xcrud->unset_remove();
				$xcrud->where('code_staff',$this->staff);
				$xcrud->fields('type_post,manuals,note');
				$xcrud->where('type_orders !=',6);
				$xcrud->button(base_url().'prints/guide?query={bill_code}','In HD','fa fa-file','',array('target'=>'_blank'));
				$xcrud->columns('code_products,code_orders,price,quantily,total_price,code_customner,type_post,type_orders');
				
			}
			
			if($this->permisson == 2){
				$xcrud->unset_edit();
				$xcrud->unset_remove();
				$xcrud->table_name('[Orders] - Chi tiết Mã vận đơn số <b style="color:red;">#'.$query.'</b>');
			}
			
			$xcrud->label('discounts','Giảm Giá');
			$xcrud->label('code_products','Mã SP');
			$xcrud->label('code_orders','Mã vận đơn');
			$xcrud->label('type_post','Dịch vụ vận chuyển');
			$xcrud->label('type_orders','Trạng Thái');
			$xcrud->label('code_staff','Nhân viên bán');
			$xcrud->label('code_customner','Tên khách hàng');
			$xcrud->label('quantily','Số lượng');
			$xcrud->label('price','Giá');
			$xcrud->label('total_price','Tổng Giá');
			$xcrud->label('date_order','Ngày mua');

			$xcrud->relation('code_customner','customer','code','full_name');
			$xcrud->relation('code_products','products','id','code_products');
			$xcrud->relation('type_orders','type_oders','id','name_oders');
			$xcrud->relation('type_post','type_post','id','name_type_orders');
			$xcrud->relation('code_staff','staff','id','full_name');
			$xcrud->columns('code_staff,code_products,code_customner,code_orders,type_orders,type_post,quantily,price,discounts,total_price,date_order');
			
			
			
			$xcrud->benchmark();
			$response = $xcrud->render();
			return $response;
		
	}
}
?>