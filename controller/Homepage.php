<?php
define('MOD','HomePage');
class Homepage extends BaseCore {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
		$users = $this->db->hvals('user');
		$data['detail'] = unse($users);
		
        $this->load->view('head');
        $this->load->view('index',$data);
        $this->load->view('footer');
    }

    public function list_pic()
    {
        $this->load->view('list2.php');
    }

    public function testphp()
    {
        ShowError('SUCCESS!', BASE_URI . '/Homepage');
    }

    public function test()
    {
        $this->load->view('index');
    }

}