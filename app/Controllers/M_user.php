<?php namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Entity;
use App\Entities\M_user_entity;

class M_user extends Controller{

    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        $user = new M_user_entity();
        // $params = array(
        //     'where' => array(
        //         'Id' => 3
        //     )
        // );
        $test = $user->findAll();
        $data['model'] = $test;
        echo view('template/header', $data);
        echo view('m_user/index', $data);
        echo view('template/footer', $data);
       

    }

    public function add(){
        $user = new M_user_entity();

    }

    public function addsave(){
        $user = new M_user_entity();
        $user->M_Groupuser_Id = 1;
        $user->Username = 'trolololol';
        $user->Password = 'test';
        $user->save();
        
    }

    public function editsave(){
        $user = new M_user_entity();
        $data = $user->find(2);
        $data->Username = 'AHAUHAUH';
        $data->save();
    }

    public function delete(){
        $user = new M_user_entity();
        $data = $user->find(5);
        $data->delete();
    }
}