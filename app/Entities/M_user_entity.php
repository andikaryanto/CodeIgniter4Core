<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Base_entity;

class M_user_entity extends Base_entity {
    public $Id;
    public $M_Groupuser_Id;
    public $Username;
    public $Password;
    public $IsLoggedIn;
    public $IsActive;
    public $Language;
    public $CreatedBy;
    public $ModifiedBy;
    public $Created;
    public $Modified;

    public function __construct(){
        parent::__construct();
    }

}