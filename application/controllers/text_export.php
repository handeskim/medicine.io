<?php
class Text_export extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
	
	}
	
	public function dowload(){
		$txtfile = $_SERVER["DOCUMENT_ROOT"].'/public/email/filemau.txt';
		header("Cache-Control: public");     
		header("Content-Description: File Transfer");     
		header("Content-Disposition: attachment; filename=filemau.txt");     
		header("Content-Transfer-Encoding: binary");     
		header("Content-Type: binary/octet-stream");     
		readfile($txtfile);
	}	
	
	public function dowload_sms(){
		$txtfile = $_SERVER["DOCUMENT_ROOT"].'/public/email/filemau_sms.txt';
		header("Cache-Control: public");     
		header("Content-Description: File Transfer");     
		header("Content-Disposition: attachment; filename=filemau_sms.txt");     
		header("Content-Transfer-Encoding: binary");     
		header("Content-Type: binary/octet-stream");     
		readfile($txtfile);
	}
	
}
?>