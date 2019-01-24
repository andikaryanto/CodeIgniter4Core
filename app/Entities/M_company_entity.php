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

    protected static $entityclass  = 'M_company_entity';
    protected static $entitymodel = 'M_companies_model';

    public function __construct(){
        parent::__construct();
    }

    public function validate($oldmodel = null){
        return null;
    }

}