<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Base_entity;

class M_usersetting_entity extends Base_entity {
    public $Id;
    public $M_User_Id;
    public $G_Language_Id;
    public $G_Color_Id;
    public $RowPerpage;

    public function __construct(){
        parent::__construct();
    }

}