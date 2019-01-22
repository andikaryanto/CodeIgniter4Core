<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Base_entity;

class M_company_entity extends Base_entity {
    public $Id;
    public $M_Form_Id;
    public $M_Groupuser_Id;
    public $Read;
    public $Write;
    public $Delete;
    public $Print;
    
    public function __construct(){
        parent::__construct();
    }

}