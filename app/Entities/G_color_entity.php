<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Base_entity;

class G_color_entity extends Base_entity {
    public $Id;
    public $Name;
    public $Value;
    public $CssClass;
    public $CssPath;
    public $CssCustomPath;

    public function __construct(){
        parent::__construct();
    }

}