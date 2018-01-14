<?php
class Prints extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('global_model', 'GlobalMD');	
	}
	
	public function index(){
		
	}
	
	public function customer_details(){
		if(isset($_GET['code'])){
			$id_sql = $_GET['code'];
			$sql = "SELECT c.code,c.full_name,c.email,c.ngay_sinh,c.dia_chi,c.dien_thoai,c.dien_thoai_2,c.passport_id,c.note,
			s.full_name as name_staff, s.email as account_staff FROM customer c
			INNER JOIN staff s ON s.id = c.supervisor
			WHERE c.id = '$id_sql' ";
			$data_field = $this->GlobalMD->query_global($sql);
			// $Array_name_field = array();
			// $query = $this->db->query($sql); 
			// foreach($query->list_fields() as $field)
			// {
			//    $Array_name_field[] = $field;
			// }
			// $dataexport = array();
			// $dataexport[] = $Array_name_field;
			// $x = 0;
			// $filed = array();
			// foreach($data_field as $value){
			// 	foreach($Array_name_field as $fields)
			// 	{
			// 		$filed[$x][] = $value[$fields];
			// 	}
			// 	$dataexport[] = $filed[$x];
			// 	$x++;
			// }
			$data = array(
				'response' => $data_field,
			);
			$this->parser->parse('default/print',$data);
		}
	}
}
?>