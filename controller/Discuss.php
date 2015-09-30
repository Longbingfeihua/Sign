<?php
define('MOD','Discuss');
class Discuss extends BaseCore{
	
	public function __construct()
	{
		parent::__construct();
		identify();
	}
	
	public function index()
	{
		$sql = 'select * from dev_discuss_list limit 0,'.COUNT;
		$res = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		if($res)
		{
			foreach($res as $key => $vo)
			{
				$re = $this->db->hget('user',$vo['uid']);
				$res[$key]['author'] = unse($re)['name'];
			}
		}
		$data['details'] = $res;
		//print_r($res);
		$this->load->view('head');
		$this->load->view('discuss',$data);
		$this->load->view('footer');
	}

	public function create()
	{
		$time = time();
		$params=array(
			'uid' => $_SESSION['uid'],
			'title' => '',
			'content' => '',
			'create_time' => $time,
			'update_time' => $time,
			'ip'=>$_SERVER["REMOTE_ADDR"],
		);
		$arr = array();
		foreach($params as  $vo)
		{
			if(is_string($vo))
			{
				$arr[] = '"'.$vo.'"';
			}
			if(is_int($vo))
			{
				$arr[] = $vo;
			}
		}
		//此处注意mysql表的数据类型。
		$sql = 'insert into dev_discuss_list (uid,title,content,create_time,update_time,ip) values ('.implode(',',$arr).')';
		$res = $this->pdo->exec($sql);
		if($res)
		{
			echo 1;
		}else{
			echo 0;
		}
	}

	public function detail()
	{
		$this->load->view('head');
		$this->load->view('discuss_detail');
		$this->load->view('footer');
	}

	public function replay(){}

	public function delete_list(){}

	public function delete_replay(){}

	public function collection(){}



}