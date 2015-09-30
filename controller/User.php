<?php

/**
 * User: mac
 * Date: 15/7/16
 * Time: 上午11:21
 */
class User extends BaseCore {

    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function regist()
    {
        if (isset($_POST['checkName']) && trim($_POST['checkName']) != '') {
	        $res = $this->db->hget('user',trim($_POST['checkName']));
	        if($res)
	        {
		        echo 1;
		        die;
	        }
        } else {
            $params = array(
                'name'       => trim($_POST['name']),
                'password'   => md5(trim($_POST['password'])),
                'sex'        => $_POST['sex'],
                'birthday'   => strtotime($_POST['birthday']),
                'address'    => trim($_POST['address']),
                'registtime' => time(),
            );
            $id = md5($params['name'].'_Sign_'.$params['password']);
            $params['id'] = $id;
            $res = $this->db->hset('user',$id,serialize($params)); 
            if($res)
            {
	            echo $params['name'];
            }else{
	            return false;
            }
        }
    }

    public function login()
    {
        if (isset($_POST['name']) && isset($_POST['pwd'])) {
	        $uid = md5(trim($_POST['name']).'_Sign_'.md5(trim($_POST['pwd'])));
	        $res = $this->db->hget('user',$uid);
	        if($res)
	        {
		        $pwd = unserialize($res);
		        $pwd = $pwd['password'];
		        if(md5(trim($_POST['pwd'])) == $pwd)
		        {
			        echo 1;
		        }else{
			        echo 2;
		        }
	        }else{
		        echo 0;
	        }
        } else {
            $_SESSION['username'] = trim($_POST['username']);
            //$_SESSION['password'] = md5(trim($_POST['password']));
            $_SESSION['uid'] = md5(trim($_POST['username']).'_Sign_'.md5(trim($_POST['password'])));
            ShowError('LOGIN_SUCCESSFULLY', BASE_URL);
        }
    }
    
    public function logout()
    {
        if ($_POST['data'] && $_POST['data'] == 1) {
            session_unset();
            session_destroy();
            echo 1;
        }
    }
}