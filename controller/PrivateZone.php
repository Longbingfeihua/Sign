<?php
define('MOD','PrivateZone');
class PrivateZone extends BaseCore
{
    public function __construct()
    {
        parent::__construct();
        Identify();
    }

    public function index()
    {	
	    $uid = $_SESSION['uid'];
		$this->db->select(1);//name,用户头像存在1
		$users = $this->db->lrange('name',0,19);//最新20注册
		$iconpath = $this->db->hget('icon',$uid) ? $this->db->hget('icon',$uid) : '';
		$data['detail'] = $users;
		$this->db->select(0);//用户资料在0
		$re = $this->db->hget('user',$uid);//取自己
		$userdata = unse($re);
		$userdata['iconpath'] = $iconpath;//放入头像
		$data['userdata'] = $userdata;
		$data['friend'] = $this->getFriendInfo();//取friend
		$this->db->select(2);//取关系总数
		$data['friendNum'] = $this->db->zcard($uid);
		
        $this->load->view('head');
        $this->load->view('privatezone',$data);
        $this->load->view('footer');
    }
    
    public function LinkFriend()
    {
	    $uid = trim($_REQUEST['uid']) ? trim($_REQUEST['uid']) : '';
	    if($uid)
	    {
		  	$this->db->select(1);
		    $res = $this->db->hget('user',$uid);
		    if($res)
		    {
			    $this->db->select(2);
			    $re = $this->db->zadd($_SESSION['uid'],0,$uid);
			    echo $re;
		    }else{
			    echo 0;
		    }
	    }else{
		    return false;
	    }
    }
    
    public function getFriendInfo()
    {
	    $return = array();
	    $this->db->select(2);
	    $friend = $this->db->zrange($_SESSION['uid'],0,$_REQUEST['count'] ? 3 * $_REQUEST['count']:3);//取2库关系表值
	    if(!empty($friend))
	    {
		    $this->db->select(0);
		    foreach($friend as $vo)
		    {
			    $f = unse($this->db->hget('user',$vo));
			    $f['uid'] = $vo;
		    	$return[] = $f;//关联0库详情
		    }
	    }
		return $return;
    }
    
    //Array ( [icon] => Array ( [name] => 1.pic.jpg [type] => image/jpeg [tmp_name] => /private/var/tmp/phpFCDzMY [error] => 0 [size] => 131295 ) )
    public function changeIcon()
    {
	    if($_FILES['icon'])
	    {
		    $file = $_FILES['icon'];
		    if($file['error'] == 0)
		    {
				if($file['size'] > 0 && $file['size'] < 2000000)
				{
					$types = array('jpg','png','gif','jpeg');
					$type = end(explode('.',$file['name']));
					if(in_array($type,$types))
					{
						$tmpName = 	$file['tmp_name'];
						$createName = 'Sign_'.time().rand(1000,2000).'.'.$type;
						$path = 'upload/zone/'.$_SESSION['uid'].'/';
						$dirname = BASE_DIR.$path;
						if(!is_dir($dirname))
						{
							mkdir($dirname);
						}
						if(is_uploaded_file($tmpName))
						{
							move_uploaded_file($tmpName,$dirname.$createName);
						}
						if(file_exists($dirname.$createName))
						{
							$iconPath = BASE_URL.'/'.$path.$createName;
							$this->db->select(1);//入1库
							$this->db->hset('icon',$_SESSION['uid'],$iconPath);
							echo $iconPath;//返回url路径
						}else{
							echo 4;
						}
					}else{
						echo 3;
					}
				}else{
					echo 2;
				}
			}else{
				echo 1;
			}
	    }  
    }
}