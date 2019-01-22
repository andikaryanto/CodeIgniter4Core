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

    public function isDataExist($groupname){
        $params = array(
            'where' => array(
                'GroupName' => $groupname
            )
        );

        $result = $this->first($params);
        if($result)
            return true;
        return false;
    }

    public function validate($oldmodel = null){

        $nameexist = false;
        $warning = array();
        if(!empty($oldmodel))
        {
            if($this->GroupName != $oldmodel->GroupName)
            {
                $nameexist = $this->isDataExist($this->GroupName);
            }
        }
        else{
            if(!empty($this->GroupName))
            {
                $nameexist = $this->isDataExist($this->GroupName);
            }
            else{
                $warning = array_merge($warning, array(0=>'Error.group_name_can_not_null'));
            }
        }
        if($nameexist)
        {
            $warning = array_merge($warning, array(0=>'Error.name_exist'));
        }
        
        return $warning;
    }

    public function isPermitted($groupid = null, $form = null, $role = null){
        $permitted = false;

        $formentity = 'App\Entities\M_form_entity';
        $mform = new $formentity;

        $formid = $form;
        if(isset($form)){
            $forms = $mform->getDataByFormName($form);
            $formid = $forms->Id;
        }
        
        $userentity = 'App\Entities\M_user_entity';
        $muser = new $userentity;
        if($muser->isSuperadmin($_SESSION[getSessionVariable_config()['userdata']]['Username'])
            ||  $this->hasRole($groupid,$formid,$role)
        )
        {
            $permitted = true;
        }
        return $permitted;
    }

    public function hasRole($groupid, $formid, $role)
    {
        $hasrole = false;
        $accessentity = 'App\Entities\M_accessrole_entity';
        $maccess = new $accessentity;

        $params = array(
            'where' => array(
                'M_Groupuser_Id' => $groupid,
                'M_Form_Id' => $formid,
                $role => 1
            )
        );

        $result = $maccess->findAll($params);
        if($result)
        {
            $hasrole = true;
        }

        return $hasrole;
    }

}