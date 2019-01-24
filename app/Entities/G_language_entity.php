<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Base_entity;

class G_language_entity extends Base_entity {
    public $Id;
    public $Name;

    protected static $entityclass  = 'G_language_entity';
    protected static $entitymodel = 'G_languages_model';

    public function __construct(){
        parent::__construct();
    }

}