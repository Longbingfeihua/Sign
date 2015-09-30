<?php
	define('MOD','Message');
	class Message extends BaseCore{
		public function __construct()
		{
			parent::__construct();
			Identify();
		}
		
		public function index()
		{	
			$this->load->view('head');
			$this->load->view('message');
		}
		
		public function show()
		{
			$this->db->select(4);
			$re = $this->db->lrange('Message_'.$_SESSION['username'],0,3);
			$re = unse($re);
			echo json_encode($re);
		}
		
		public function create()
		{
			$message = trim($_POST['message']) ? trim($_POST['message']) : '';
			if(!$message)
			{
				return false;
			}
			$username = $_SESSION['username'];
			$messageBag = array(
				'name' => $username.'@'.Date('Y-m-d H:i',time()),
				'message' => $message,
				'createtime' => time(),
				'ip' =>'',
			);
			$this->db->select(4);
			$re = $this->db->lpush('Message_'.$_SESSION['username'],serialize($messageBag));
			if($re)
			{
				print_r($messageBag);
			}
		}
		
		public function clear()
		{
			if($_REQUEST['action'])
			{	
				$this->db->select(4);
				$res = $this->db->del('Message_'.$_SESSION['username']);
				echo $res;
			}
		}
		
		public function local()
		{
			
		}
	}