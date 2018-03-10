<?php
class Notification extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->library('rest');
		$this->load->model('global_model', 'GlobalMD');	
		$this->login = $this->session->userdata('auth_sign');
		if($this->login){
			$this->user_data = $this->session->userdata('data_users');
			$this->authorities = $this->user_data['authorities'];
			$this->staff = $this->user_data['id'];
		}else{
			redirect(base_url('sign'));
		}
		
	}
	
	private function Notification(){
		$staff =  $this->staff ;
		$authorities =  $this->authorities;
		try{
			if($authorities == 1 || $authorities ==2){
				$sql = "SELECT * FROM notification WHERE `status` = 1 ";
				return $this->GlobalMD->query_global($sql);
			}
			if($authorities == 3 || $authorities == 5){
				$sql = "SELECT * FROM notification WHERE `status` = 1  AND authorities = '$authorities'";
				$result = $this->GlobalMD->query_global($sql);
				if(!empty($result)){
					return $result;
				}else{
					$sql2 = "SELECT * FROM notification WHERE  `status` = 3  AND authorities = '$authorities' AND staff_view = '$staff'";
					$result2 =  $this->GlobalMD->query_global($sql2);
					if(!empty($result2)){
						return $result2;
					}else{
						$sql3 = "SELECT * FROM notification WHERE  `status` = 4  AND authorities = '$authorities' AND staff_view = '$staff'";
						return $this->GlobalMD->query_global($sql3);
					}
				}
			}
			if($authorities == 4){
				$sql = "SELECT * FROM notification WHERE staff = '$staff' AND `status` = 1  AND authorities = '$authorities'";
				return $this->GlobalMD->query_global($sql);
			}
			
		}catch (Exception $e) {
			return false;
		}
	}
	public function index(){
		$this->temp_notifacation();
	}
	public function load_schedule(){
		$staff =  $this->staff;
		$date = date("Y-m-d",time());
		$sql = "SELECT * FROM scheduling_callback WHERE code_staff = '$staff' AND DATE_FORMAT(scheduling, '%Y-%m-%d') <  '$date' AND `status` =  1  ";
		return $this->GlobalMD->query_global($sql);
		
	}
	public function temp_notifacation(){
		$data = $this->Notification();
		$scheduling = $this->load_schedule();
		$total_notifications = 0;
		$totalx_notifications = count($data);
		$total_scheduling = count($scheduling);
		$total_notifications = $totalx_notifications + $total_scheduling;
		$temp = '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
		if($total_notifications==0){
			$temp .= '<i style="color: #00a65a;font-size: 18px;" class="fa fa-bell-o"></i>';
		}else{
			$temp .= '<i style="color: #ed3237;font-size: 18px;" class="fa fa-bell-o"></i><span class="label label-warning">'.$total_notifications.'</span>';
		}
		
        $temp .= '</a>
		<ul class="dropdown-menu"><li class="header">Bạn có '.$total_notifications.' Thông báo</li><li><ul class="menu">';
		if(!empty($data)){
			foreach($data as $value){
				$id_noti = core_encode($value['id']);
				$authorities = $value['authorities'];
				if($authorities==3){
					$fa_icon = "fa-shopping-cart";
				}else if($authorities==4){
					$fa_icon = "fa-file";
				}else if($authorities==5){
					$fa_icon = "fa-cube";
				}else{
					$fa_icon = "fa-bullhorn";
				}
				if($value['authorities']==3){
					$temp .= '<li><a href="'.base_url().'cms/oders_management/notification?query='.$value['links'].'&token='.$id_noti.'"><i class="fa '.$fa_icon.' text-aqua"></i> '.$value['title'].' </a></li>';
				}else if($value['authorities']==5){
					$temp .= '<li><a href="'.base_url().'cms/oders_management/notify?query='.$value['links'].'&token='.$id_noti.'"><i class="fa '.$fa_icon.' text-aqua"></i> '.$value['title'].' </a></li>';
				}else{
					$temp .= '<li><a href="'.base_url().'route/notify?query='.$value['links'].'"><i class="fa '.$fa_icon.' text-aqua"></i> '.$value['title'].' </a></li>';
				}
				
			}
		}
		
		if(!empty($scheduling)){
			foreach($scheduling as $value_scheduling){
				$staff = $value_scheduling['code_staff'];
				$fa_icon = "fa fa-history";
				if($this->authorities==4){
					$temp .= '<li><a href="'.base_url().'cms/scheduling/edit/'.$value_scheduling['id'].'"><i class="fa '.$fa_icon.' text-aqua"></i> Chưa gọi cho khách mã:'.$value_scheduling['code_customer'].' </a></li>';
				}
				
			}
		}
        $temp .= '</ul></li></ul>';
		
		echo $temp;
		}
	
}
?>