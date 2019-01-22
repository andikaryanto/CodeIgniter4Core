<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Base_entity;

class M_form_entity extends Base_entity {
    public $Id;
    public $FormName;
    public $AliasName;
    public $LocalName;
    public $ClassName;
    public $Resource;
    public $IndexRoute;

    public function __construct(){
        parent::__construct();
    }

    public function getDataByClassname($classname){
        $params = array(
            'where' => array(
                'ClassName' => $classname
            ),
            'where_not_in' => array(
                'Id !=' => array(1, 2)
            )
        );

        return $this->findAll($params);
    }

    public function getDataByFormName($form){
        $params = array(
            'where' => array(
                'FormName' => $form,
            )
        );
        $result = $this->findAll($params);
        if($result){
            return $result[0];
        }
        return null;
    }

}