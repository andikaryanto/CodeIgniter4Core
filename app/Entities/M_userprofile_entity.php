<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Base_entity;

class M_userprofile_entity extends Base_entity {
    public $Id;
    public $M_User_Id;
    public $CompleteName;
    public $Address;
    public $Phone;
    public $Email;
    public $PhotoPath;
    public $PhotoName;
    public $AboutMe;

    protected static $entityclass  = 'M_userprofile_entity';
    protected static $entitymodel = 'M_userprofiles_model';

    public function __construct(){
        parent::__construct();
    }

}