<?php namespace App\Entities;

use CodeIgniter\Entity;
use App\Entities\Base_entity;

class M_user_entity extends Base_entity {
    public $Id;
    public $M_Groupuser_Id;
    public $Username;
    public $Password;
    public $IsLoggedIn;
    public $IsActive;
    public $Language;

    protected static $entityclass  = 'M_user_entity';
    protected static $entitymodel = 'M_users_model';

    public function __construct(){
        parent::__construct();
    }

    

    public function isDataExist($name){
        $params = array(
            'where' => array(
                'Username' => $name
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
            if($this->Username != $oldmodel->Username)
            {
                $nameexist = $this->isDataExist($this->Username);
            }
        }
        else{
            if(!empty($this->Username))
            {
                $nameexist = $this->isDataExist($this->Username);
            }
            else{
                $warning = array_merge($warning, array(0=>'Error.name_can_not_null'));
            }
        }
        if($nameexist)
        {
            $warning = array_merge($warning, array(0=>'Error.name_exist'));
        }
        
        return $warning;
    }

    public function isSuperadmin($username){
        if($username == "superadmin")
            return true;
        return false;
    }

    public function setPassword($password){
        $this->Password = encryptMd5(getStringPrefix_config().$this->Username.$password);
    }

    public function saveWitDetail(){
        $id = $this->save();
        $this->saveSetting($id);
        $this->saveProfile($id);
        return $id;
    }

    public function saveSetting($id){
        $ent = 'App\Entities\M_usersetting_entity';
        $user_settings = new $ent;
        $user_settings->M_User_Id = $id;
        $user_settings->G_Language_Id = 1;
        $user_settings->G_Color_Id = 1;
        $user_settings->RowPerpage = 5;
        //print_r($user_settings);
        $user_settings->save();
    }

    public function saveProfile($id){
        $ent = 'App\Entities\M_userprofile_entity';
        $user_profile = new $ent;
        $user_profile->M_User_Id = $id;
        $user_profile->PhotoPath = "./assets/user_profile/";
        $user_profile->PhotoName = "user_default.png";
        $user_profile->save();
    }

    public function saveNewPassword($data){

        $warning = array();
        if($data['newpassword'] != $data['confirmpassword']){
            $warning = array_merge($warning, array(0=>'Error.wrong_confirmed_password'));
        } else {
            if($this->Password != encryptMd5(getStringPrefix_config().$this->Username.$data['oldpassword'])){
                $warning = array_merge($warning, array(0=>'Error.wrong_password'));
            } else {
                $this->setPassword($data['newpassword']);
                $this->save();
            }
        } 
        return $warning;

    }

}