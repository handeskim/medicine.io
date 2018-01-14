<?php
class Dashboard extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
		$this->load->model('global_model', 'GlobalMD');	
		// $this->login = $this->session->userdata('auth_sign');
		
		// if($this->login){
			// $this->user_data = $this->session->userdata('data_users');
			// $this->permisson = $this->user_data['role'];
			// $id_clients = $this->user_data['id'];
			// $this->level = $this->user_data['level'];
			// if($this->level == 2){
				// $param_Expired = array('uid_private' => $id_clients,);
				// $response = $this->rest->get('apps/api/Expired',$param_Expired);
				// if((int)$response->results == 0){
					// redirect(base_url('exits'));
				// }	
			// }
		// }else{
			// redirect(base_url('sign'));
		// }
		
	}
	
	private function load_temp_client(){
		$temp = '';
		
			$temp .='<div class="col-md-12"><ul>';
			// $temp .='<li> Ngày Hết Hạn: '.$this->user_data['expired'].'</li>';
			// $temp .='<li> Điểm hoạt động còn : '.$this->user_data['score'].'</li>';
			$temp .='</ul></div>';
		
		return $temp;
	}
	public function index(){
		
		
	}

	
}
?>