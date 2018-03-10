<?php
class Task extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('global_model', 'GlobalMD');	
	}
	
	public function sender_email(){
		$conf_email = $this->load_conf_email();
		$this->load->library('email');
		$config['protocol']    = 'smtp';
		$config['smtp_host']    =  $conf_email['smtp_host'];
		$config['smtp_port']    =  $conf_email['smtp_port'];
		$config['smtp_crypto'] = $conf_email['smtp_crypto'];
		$config['smtp_timeout'] = '7';
		$config['smtp_user']    = $conf_email['smtp_user'];
		$config['smtp_pass']    = $conf_email['smtp_pass'];
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'html';
		$config['validation'] = TRUE; 
		$this->email->initialize($config);
		$datasend = $this->load_data_email();
		if(!empty($datasend)){
			foreach($datasend as $value_send){
				$body = $value_send['content'];
				$email_from = $conf_email['mail_from'];
				$email_clients = $value_send['email'];
				$subject = $value_send['title'];
				$id = $value_send['id'];
				$this->email->from($email_from);
				$this->email->to($email_clients);
				$this->email->subject($subject);
				$this->email->message($body);
				if($this->email->send()){
					$status = 3;
					$this->update_sendmail($id,$status);
				}else{
					$status = 2;
					$this->update_sendmail($id,$status);
				}
			}
		}
	}
	
	public function sender_sms(){
		$datasend = $this->load_data_sms();
		$conf = $this->load_conf_email();
		foreach($datasend as $value_sms){
			$phone = $value_sms['phone'];
			$content = $value_sms['title'];
			$id = $value_sms['id'];
			$result = $this->running_sms($content,$phone);
			if($result==true){
				$status = 3;
				$this->update_sendsms($id,$status);
			}else{
				$status = 2;
				$this->update_sendsms($id,$status);
			}
		}
		
	}
	private function running_sms($content,$phone){
		$SendContent=urlencode($content);
		$conf = $this->load_conf_email();
		$APIKey=$conf['sms_key'];
		$SecretKey=$conf['sms_secret'];
		$data="http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$phone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&SmsType=4";
		$curl = curl_init($data); 
		curl_setopt($curl, CURLOPT_FAILONERROR, true); 
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		$result = curl_exec($curl); 
		$obj = json_decode($result,true);
		if($obj['CodeResult']==100){
			return true;
		}else{
			return false;
		}
	}
	private function load_conf_email(){
		$sql = "SELECT * FROM generic";
		$result = $this->GlobalMD->query_global($sql);
		return $result[0];
	}
	private function load_data_sms(){
		$sql = "SELECT * FROM `sms_sending` WHERE `status` = 1 LIMIT 0, 500 ";
		$result = $this->GlobalMD->query_global($sql);
		return $result;
	}
	private function update_sendsms($id,$status){
		$data = array(
               'status' => $status,
            );

		$this->db->where('id', $id);
		$this->db->update('sms_sending', $data); 
	}
	private function load_data_email(){
		$sql = "SELECT * FROM `email_sending` WHERE `status` = 1 LIMIT 0, 500 ";
		$result = $this->GlobalMD->query_global($sql);
		return $result;
	}
	private function update_sendmail($id,$status){
		$data = array(
               'status' => $status,
            );

		$this->db->where('id', $id);
		$this->db->update('email_sending', $data); 
	}
	
}
?>