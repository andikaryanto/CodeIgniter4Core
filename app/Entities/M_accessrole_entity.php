<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Base_entity;

class M_accessrole_entity extends Base_entity {
    public $Id;
    public $M_Form_Id;
    public $M_Groupuser_Id;
    public $Read;
    public $Write;
    public $Delete;
    public $Print;

    protected static $entityclass  = 'M_accessrole_entity';
    protected static $entitymodel = 'M_accessroles_model';
    
    public function __construct(){
        parent::__construct();
    }

}