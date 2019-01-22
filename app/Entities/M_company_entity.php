<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Base_entity;

class M_company_entity extends Base_entity {
    public $Id;
    public $CompanyName;
    public $Address;
    public $PostCode;
    public $Email;
    public $Phone;
    public $Fax;
    public $CreatedBy;
    public $ModifiedBy;
    public $Created;
    public $Modified;

    public function __construct(){
        parent::__construct();
    }

    public function validate($oldmodel = null){
        return null;
    }

}