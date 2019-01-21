<?php namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Entity;
use App\Entities\M_groupuser_entity;

class M_groupuser extends Controller{

    // public function __construct() {
    //     parent::__construct();
    // }
    
    public function index(){
        $groupuser = new M_groupuser_entity();
        // $params = array(
        //     'where' => array(
        //         'Id' => 1
        //     )
        // );
        echo json_encode($groupuser->findAll());
    }

    public function addsave(){
        $groupuser = new M_groupuser_entity();
        $groupuser->GroupName = 'hahaha';
        $groupuser->Description = 'test';
        $groupuser->save();
        
    }

    public function editsave(){
        $groupuser = new M_groupuser_entity();
        $data = $groupuser->find(2);
        $data->GroupName = 'AHAUHAUH';
        $data->save();
    }

    public function delete(){
        $groupuser = new M_groupuser_entity();
        $data = $groupuser->find(5);
        $data->delete();
    }
}