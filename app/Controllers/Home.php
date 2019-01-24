<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Controllers\Base_controller;

class Home extends Base_controller
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        //echo json_encode($this->session->userdata('userdata'));
        if(empty($this->session->get(getSessionVariable_config()['userdata']))){
            return redirect('login');
        }
        else{
            //echo json_encode($this->session->get('languages'));
            $this->loadView('home/home');
        }
    }
}