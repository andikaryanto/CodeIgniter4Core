<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Base_entity;

class G_language_entity extends Base_entity {
    public $Id;
    public $Name;

    public function __construct(){
        parent::__construct();
    }

}