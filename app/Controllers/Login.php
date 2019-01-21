<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Entities\M_user_entity;
use App\Controllers\Base_controller;

class Login extends Base_controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     //$this->load->model('M_users');

    // }

    public function index()
    {
        if(isset($_SESSION['userdata'])){
            redirect('home');
        }
        else{
            echo view('login/login');
        }
    }
    public function dologin()
    {
        // echo json_encode($_POST['loginUsername']);
        $username = $_POST['loginUsername'];
        $password = $_POST['loginPassword'];
        
        $user = new M_user_entity();
        $params = array(
            'where' => array(
                'Username' => $username,
                'Password' => encryptMD5('school'.$username.$password)
            )   
        );
        $query = $user->findAll($params)[0];
        
        echo json_encode($query->get_list_M_Userprofile()[0]);
        // if ($query)
        // {
        //     if($query->IsActive == 1){
        //         //print_r($query->get_list_M_User()); 
        //         $this->session->set_userdata('userdata',get_object_vars($query));
        //         $this->session->set_userdata('usersettings',get_object_vars($query->get_list_M_Usersetting()[0]));
        //         $this->session->set_userdata('userprofile',get_object_vars($query->get_list_M_Userprofile()[0]));
        //         $this->session->set_userdata('languages',get_object_vars($query->get_list_M_Usersetting()[0]->get_G_Language()));
        //         $this->session->set_userdata('colors',get_object_vars($query->get_list_M_Usersetting()[0]->get_G_Color()));
        //         // echo json_encode($this->session->userdata('colors'));
        //         redirect('home');
        //     } else {
        //         redirect('login');
        //     }
        // }
        // else{
        //     redirect('login');
        // }
    }

    public function dologout()
    {
        //$username = $_SESSION['userdata']['Username'];
        unset(
            $_SESSION['userdata']
        );
        //$this->M_users->set_logout($username);
        redirect('login');
    }

    private function loadview($viewName)
	{
		$this->load->view('template/header');
		$this->load->view($viewName);
		$this->load->view('template/footer');
    }
    
}