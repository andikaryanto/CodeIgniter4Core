<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Base_entity;

class M_groupuser_entity extends Base_entity {
    public $Id;
    public $GroupName;
    public $Description;
    public $Deleted;
    public $CreatedBy;
    public $ModifiedBy;
    public $Created;
    public $Modified;

    public function __construct(){
        parent::__construct();
    }

}