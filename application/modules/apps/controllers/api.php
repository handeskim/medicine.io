<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Api extends REST_Controller {
	function __construct(){
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
		$this->staff = 0;
		$this->login = $this->session->userdata('auth_sign');
		if($this->login){
			$this->user_data = $this->session->userdata('data_users');
			$this->permisson = $this->user_data['authorities'];
			$this->staff = $this->user_data['id'];
		}
		
	}
	public function scheduling_get(){
		$response = array('results' => null);
		$authorities = $this->permisson;
		$staff = $this->staff;
		if($authorities==4){
			$sql = "SELECT 
			stc.name_status as scheduling_name, 
			sc.code_customer as scheduling_customer,
			sc.id as scheduling_id,
			sc.scheduling as scheduling_date,
			sc.note as scheduling_note,
			c.dia_chi as scheduling_addr,
			c.dien_thoai as scheduling_phone,
			c.full_name as scheduling_fullname,
			c.email as scheduling_email
			FROM scheduling_callback sc
			INNER JOIN status_callback stc ON stc.id = sc.`status`
			INNER JOIN customer c ON sc.code_customer = c.`code`
			WHERE code_staff = '$staff'
			AND sc.`status` = 1
			OR sc.`status` = 3
			ORDER BY sc.scheduling ASC";
			$resuls = $this->QueryCoreAll($sql);
			$response = array('results' => $resuls);
		}
		$this->response($response);
	}
	public function info_get(){
		$response = array('results' => null);
		$authorities = $this->permisson;
		if($authorities==3){
			$sql = "SELECT
			o.id as orders_id,
			o.manuals as orders_manuals,
			o.note as order_note,
			o.code_orders as orders_code,
			o.price as orders_price,
			o.total_price as orders_total_price,
			o.discounts as orders_discounts,
			o.code_staff as orders_staff_id,
			o.date_order as orders_date_buy,
			o.date_confim as orders_date_comfim,
			o.date_send as orders_date_send,
			o.quantily as orders_quantily,
			o.email as orders_email,
			o.full_name as orders_fullname,
			o.dia_chi as orders_addr,
			o.dien_thoai as orders_phone,
			o.code_customner as orders_code_customner,
			o.type_post as orders_posts,
			o.type_orders as type_ordersx,
			
			p.manuals as products_manuals,
			p.name_products as products_name,
			p.label_products as products_label,
			p.note as products_note,
			p.id as products_id,
			p.code_products as products_code,
			s.id as staff_id,
			s.full_name as staff_fullname, 
			s.`code` as staff_code,
			s.email as staff_email, 
			s.dien_thoai as staff_phone,
			c.`code` as customer_code,
			c.email as customer_email,
			c.full_name as customer_fullname,
			c.dien_thoai as customer_phone_mobile, 
			c.dien_thoai_2 as customer_phone_home,
			c.dia_chi as customer_addr,
			c.note as customer_note,
			odr.name_oders as name_type_orders,
			ppm.name_types_pharma as name_pharma,
			pgm.name_generic_pharma as generic_pharma
			FROM orders o
			INNER JOIN products p ON o.code_products = p.id
			INNER JOIN types_pharma ppm ON p.types = ppm.id
			INNER JOIN generic_pharma pgm ON p.generic = pgm.id
			INNER JOIN type_post tpt ON o.type_post = tpt.id
			INNER JOIN staff s ON o.code_staff = s.id
			INNER JOIN customer c ON o.code_customner = c.`code`
			INNER JOIN type_oders odr ON o.type_orders = odr.id
			WHERE o.type_orders = 2
			GROUP BY orders_code
			ORDER BY o.date_order DESC
			";
			$resuls = $this->QueryCoreAll($sql);
			$response = array('results' => $resuls);
		}
		if($authorities==5){
			$sql = "SELECT
			o.id as orders_id,
			o.manuals as orders_manuals,
			o.note as order_note,
			o.code_orders as orders_code,
			o.price as orders_price,
			o.total_price as orders_total_price,
			o.discounts as orders_discounts,
			o.code_staff as orders_staff_id,
			o.date_order as orders_date_buy,
			o.date_confim as orders_date_comfim,
			o.date_send as orders_date_send,
			o.quantily as orders_quantily,
			o.email as orders_email,
			o.type_post as orders_posts,
			o.full_name as orders_fullname,
			o.dia_chi as orders_addr,
			o.dien_thoai as orders_phone,
			o.code_customner as orders_code_customner,
			o.type_orders as type_ordersx,
			p.manuals as products_manuals,
			p.name_products as products_name,
			p.label_products as products_label,
			p.note as products_note,
			p.id as products_id,
			p.code_products as products_code,
			s.id as staff_id,
			s.full_name as staff_fullname, 
			s.`code` as staff_code,
			s.email as staff_email, 
			s.dien_thoai as staff_phone,
			c.`code` as customer_code,
			c.email as customer_email,
			c.full_name as customer_fullname,
			c.dien_thoai as customer_phone_mobile, 
			c.dien_thoai_2 as customer_phone_home,
			c.dia_chi as customer_addr,
			c.note as customer_note,
			odr.name_oders as name_type_orders,
			ppm.name_types_pharma as name_pharma,
			pgm.name_generic_pharma as generic_pharma
			FROM orders o
			INNER JOIN products p ON o.code_products = p.id
			INNER JOIN types_pharma ppm ON p.types = ppm.id
			INNER JOIN generic_pharma pgm ON p.generic = pgm.id
			INNER JOIN type_post tpt ON o.type_post = tpt.id
			INNER JOIN staff s ON o.code_staff = s.id
			INNER JOIN customer c ON o.code_customner = c.`code`
			INNER JOIN type_oders odr ON o.type_orders = odr.id
			WHERE o.type_orders = 3
			
			ORDER BY o.date_confim DESC
			";
			$resuls = $this->QueryCoreAll($sql);
			$response = array('results' => $resuls);
		}
		$this->response($response);
	}
	public function search_product_item_get(){
		$response = array('result' => null);
		$resuls = null;
		$code_products = $this->input->get_post('code_products');
		$pepments = $this->input->get_post('name_pepr');
		if(isset($code_products) || !empty($code_products)){
			if($pepments==1){
				$sql = "SELECT id,code_products,name_products,label_products,quantily,price,images  FROM products WHERE `code_products` LIKE '%$code_products%'";
				$resuls = $this->QueryCoreAll($sql);
				if(!empty($resuls)){
					$response = array('result' => $resuls);
				}else{
					$response = array('result' => null);
				}
			}
			if($pepments==2){
				$sql = "SELECT id,code_products,name_products,label_products,quantily,price,images  FROM products WHERE `name_products` LIKE '%$code_products%'";	
				$resuls = $this->QueryCoreAll($sql);
				if(!empty($resuls)){
					$response = array('result' => $resuls);
				}else{
					$response = array('result' => null);
				}
				
			}
			if($pepments==3){
				$sql = "SELECT id,code_products,name_products,label_products,quantily,price,images  FROM products WHERE `label_products` LIKE '%$code_products%'";
				$resuls = $this->QueryCoreAll($sql);
				if(!empty($resuls)){
					$response = array('result' => $resuls);
				}else{
					$response = array('result' => null);
				}
			}
		}
		$this->response($response);
	}
	public function search_phone_get(){
		$staff = $this->staff;
		$response = array('result' => null);
		$resuls = null;
		$phones = $this->input->get_post('phones');
		if(isset($phones) || !empty($phones)){
			$sql = "SELECT * FROM customer WHERE supervisor = '$staff' AND dien_thoai LIKE '%$phones%' OR dien_thoai_2 LIKE '%$phones%'  limit 1000";
			$resuls = $this->QueryCoreAll($sql);
			if(!empty($resuls)){
				$response = array('result' => $resuls);
			}else{
				$response = array('result' => null);
			}
		}
		$this->response($response);
	}
	private function QueryCoreAll($sql){
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
		
	}
	public function notification_get(){
		$response = array('staff' => $this->staff);
		$this->response($response);
	}
}

class Appscore extends MY_Controller{
	
	function __construct(){
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}
	public function QueryCoreClientScore($userid){
		
		$sql = "SELECT `score` FROM `users` WHERE `id` = $userid and `level` = 1 limit 1";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
		
		
	}
	public function QueryCoreAll(){
		
		$sql = "SELECT `uid`,`phone` FROM `vnphone` LIMIT 100";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		return $result;
		
	}

	private function update_status_user($userid){
		
		$dataUpdate = array('status' => 2,);
		$this->db->where('id', $userid);
		$this->db->update('users', $dataUpdate); 
	}
	
	
	
	
///---End Class Apps---///
}	

?>