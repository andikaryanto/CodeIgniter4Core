<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Controllers\Base_controller;
use App\Globals\ListEntity;
use App\Entities\M_user_entity;
use App\Entities\M_groupuser_entity;

class Test extends Base_controller {

    public function __construct()
    {
        // parent::__construct();
        $this->session = \Config\Services::session();
    }

    public function index(){

        $user = \App\Entities\M_user_entity::toList()->whereNot('Id', 1);
        // foreach($user as $data){
        //     echo json_encode($data->get_M_Groupuser());
        //     echo "<br>";
        // }

        foreach($user->getAll() as $data){
            echo json_encode($data);
            echo "<br>";
        }
    }
}