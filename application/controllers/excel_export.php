<?php
class Excel_export extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
		$this->load->model('global_model', 'GlobalMD');	
		$this->login = $this->session->userdata('auth_sign');
		$this->user_data = $this->session->userdata('data_users');
		$this->permisson = $this->user_data['authorities'];
		$this->users = $this->user_data['id'];
		$this->staff = $this->user_data['id'];
		if(isset($this->login)==false){
			redirect(base_url('sign'));
		}
	}
	public function dowload(){
		if(isset($_GET['code'])){		
			$filename = random_name_text();
			$this->load->library('excel');
			try { 
				$sql = core_decode($_GET['code']);
				$data_field = $this->GlobalMD->query_global($sql);
				$Array_name_field = array();
				$query = $this->db->query($sql); 
				foreach($query->list_fields() as $field)
				{
				   $Array_name_field[] = $field;
				}
				$this->excel->setActiveSheetIndex(0);
				try { 
					
					$dataexport = array();
					$dataexport[] = $Array_name_field;
					$x = 0;
					$filed = array();
					foreach($data_field as $value){
						foreach($Array_name_field as $fields)
						{
						   $filed[$x][] = $value[$fields];
						}
						$dataexport[] = $filed[$x];
						$x++;
					}
					$this->excel->getActiveSheet()->fromArray($dataexport,NULL, 'A1');
					$filename= $filename.date("Y-m-d H-i-s",time()).'.xlsx';
					header('Content-Type:  application/vnd.ms-excel'); 
					header('Content-Disposition: attachment;filename="'.$filename.'"'); 
					$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
					ob_end_clean();
					$objWriter->save('php://output');
				}catch (Exception $e) {
					echo "No query data exists please turn back and try again";
				}
			}catch (Exception $e) {
				echo "No data exist Please come out and try again";
			}
			
		}
	}
	public function index(){
		if(isset($_GET['code'])){
			if($this->permisson==5){
				echo "No data exist Please come out and try again";
			}else{
				
				$filename = random_name_text();
				$this->load->library('excel');
				try { 
					$sql = core_decode($_GET['code']);
					$data_field = $this->GlobalMD->query_global($sql);
					$Array_name_field = array();
					$query = $this->db->query($sql); 
					foreach($query->list_fields() as $field)
					{
					   $Array_name_field[] = $field;
					}
					$this->excel->setActiveSheetIndex(0);
					try { 
						
						$dataexport = array();
						$dataexport[] = $Array_name_field;
						$x = 0;
						$filed = array();
						foreach($data_field as $value){
							foreach($Array_name_field as $fields)
							{
							   $filed[$x][] = $value[$fields];
							}
							$dataexport[] = $filed[$x];
							$x++;
						}
						$this->excel->getActiveSheet()->fromArray($dataexport,NULL, 'A1');
						$filename= $filename.date("Y-m-d H-i-s",time()).'.xlsx';
						header('Content-Type:  application/vnd.ms-excel'); 
						header('Content-Disposition: attachment;filename="'.$filename.'"'); 
						$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');  
						ob_end_clean();
						$objWriter->save('php://output');
					}catch (Exception $e) {
						echo "No query data exists please turn back and try again";
					}
				}catch (Exception $e) {
					echo "No data exist Please come out and try again";
				}
			}
		}
	}
	
}
?>