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

        $user = \App\Entities\M_user_entity::toList();
        // foreach($user as $data){
        //     echo json_encode($data->get_M_Groupuser());
        //     echo "<br>";
        // }
        // $user->M_Groupuser_Id = null;
        // $user->save();
        // $value = 'a';
        // // echo $value; 
        // $apend = empty($value) ? 'null' : $value;
        // // echo $apend;
        // $valstr =  "'data' = " . $apend;
        // echo $valstr ;
        // foreach($user as $data){
            // echo json_encode($user);
            // echo "<br>";
        // }
        try{
            $group = \App\Entities\M_groupuser_entity::one(1);
            $user->add($group);
        } catch (\CodeIgniter\Exceptions\ConfigException $e) {
            echo $e;
        }
    }
}