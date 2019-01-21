<?php namespace App\Models;
use CodeIgniter\Model;
use App\Models\Base_model;

class M_userprofiles_model extends Base_Model{

    // protected $returnType = 'App\Entities\M_groupuser_entity';
    protected $returnType = 'array';
    public function __contruct(){
        parent::__construct();
    } 

}