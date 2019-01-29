<?php namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Entity;
use App\Entities\M_user_entity;
use App\Entities\M_userprofile_entity;
use App\Controllers\Base_controller;

class M_user extends Base_controller{

    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        if($this->checkSession())
            return $this->checkSession();
    
        $supported = [
            $_SESSION[getSessionVariable_config()['languages']]['Locale']
        ];

        $lang = $this->negotiator->language($supported);


        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_user'],'Read'))
        {
            $model = \App\Entities\M_user_entity::toList()->whereNot('Id', 1)->getAll();
            $data = getDataPage_paging($model);
            // echo json_encode($model);
            $this->loadView('m_user/index', $data);
        }
        else
        {   
            echo view('forbidden/forbidden');
        }
        // 
        //echo json_encode($_SESSION['kospinuserdata']);
    }

    public function add(){
        if($this->checkSession())
            return $this->checkSession();

        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_user'],'Write'))
        {
            $model = \App\Entities\M_user_entity::newObject();
            $data = getDataPage_paging($model);
            $this->loadView('m_user/add', $data);
        }
        else
        {   
            echo view('forbidden/forbidden');
        }
    }

    public function addsave(){
        // if($this->checkSession())
        //     return $this->checkSession();

        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_user'],'Write'))
        {
            $groupid    = $this->request->getPost('groupid');
            $username   = $this->request->getPost('named');
            $password   = $this->request->getPost('password');
            
            $model = \App\Entities\M_user_entity::newObject();
            $model->M_Groupuser_Id = setIsNull($groupid);
            $model->Username = setIsNull($username);
            $model->setPassword($password);
            $model->IsLoggedIn = 0;
            $model->IsActive = 1;
            $model->Language = 'indonesia';

            $validate = $model->validate();

            if($validate)
            {
                $this->session->setFlashdata(transactionMessage_config()['add'],$validate);
                $data = getDataPage_paging($model);
                $this->loadView('m_user/add', $data);   
            }
            else{

                $db = $model->db();
                $db->transBegin();
                try{

                    $id = $model->saveWitDetail();
                    $db->transCommit();
                    $successmsg = getSuccessMessage_paging();
                    $this->session->setFlashdata(transactionMessage_config()['success'], $successmsg);
                    return redirect('muser/add');
                } catch (\Exception $e){
                    $db->transRollback();
                }
            }
        } else {   
            echo view('forbidden/forbidden');
        }
        
    }

    public function edit($id){
        if($this->checkSession())
            return $this->checkSession();

        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_user'],'Write'))
        {
            $model =\App\Entities\M_user_entity::one($id);
            $data = getDataPage_paging($model);
            $this->loadView('m_user/edit', $data);
        }
        else
        {   
            echo view('forbidden/forbidden');
        }
    }

    public function editsave(){
        if($this->checkSession())
            return $this->checkSession();
        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_user'],'Write'))
        {
            $id = $this->request->getPost('userid');
            $groupid = $this->request->getPost('groupid');
            $username = $this->request->getPost('named');
            
            $model = \App\Entities\M_user_entity::one($id);
            $oldmodel = clone $model;

            $model->M_Groupuser_Id = setIsNull($groupid);
            $model->Username = setIsNull($username);

            $validate = $model->validate($oldmodel);
            //echo json_encode($validate);
            if($validate)
            {
                $this->session->setFlashdata(transactionMessage_config()['edit'],$validate);
                // echo json_encode( $this->session->getFlashdata(transactionMessage_config()['edit']));
                $data = getDataPage_paging($model);
                $this->loadView('m_user/edit', $data); 
                //return redirect()->back();  
            }
            else{

                $id = $model->save();
                $successmsg = getSuccessMessage_paging();
                $this->session->setFlashdata(transactionMessage_config()['success'], $successmsg);
                return redirect('muser');
            }
        } else {   
            echo view('forbidden/forbidden');
        }
    }


    public function delete(){
        if($this->checkSession())
            return $this->checkSession();

        $id = $this->request->getPost("id");
        // $id = $this->request->getGet("id");
        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_user'],'Delete'))
        {   
            $entity = new M_user_entity();
            $model = $entity->find($id);
            $delete = $model->delete();
        } else {
            echo json_encode(delete_status("", FALSE, TRUE));
        }
    }

    public function setting(){
        if($this->checkSession())
            return $this->checkSession();

        $this->loadView('m_user/settings');
    }

    public function profile(){
        if($this->checkSession())
            return $this->checkSession();
        
        $model =\App\Entities\M_user_entity::one($_SESSION[getSessionVariable_config()['userdata']]['Id']);
        
        $profile = $model->get_first_M_Userprofile();
        $data['model'] = $profile;
        $this->loadView('m_user/profile', $data);
    }

    public function activate($id)
    {
        if($this->checkSession())
            return $this->checkSession();

        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_user'],'Write'))
        {
            $muser = \App\Entities\M_user_entity::one($id);
            if($muser){
                $muser->IsActive = $muser->IsActive ? 0 : 1;
                if(!$muser->IsActive)
                    $muser->M_Groupuser_Id = null;
                $muser->save();
            }
            return redirect('muser');
        }
        else
        {   
            $this->load->view('forbidden/forbidden');
        }   
    }

    public function changePassword(){
        if($this->checkSession())
            return $this->checkSession();

        $model = array(
            'oldpassword' => "",
            'newpassword' => "",
            'confirmpassword' => ""
        );
        $data['model'] = $model;
        $this->loadView('m_user/changePassword', $data);    
    }

    public function saveNewPassword(){
        if($this->checkSession())
            return $this->checkSession();

        $oldpassword = $this->request->getPost('oldpassword');
        $newpassword = $this->request->getPost('newpassword');
        $confirmpassword = $this->request->getPost('confirmpassword');
        $model = array(
            'oldpassword' => $oldpassword,
            'newpassword' => $newpassword,
            'confirmpassword' =>  $confirmpassword
        );
        
        // $entity = new M_user_entity();
        $muser = \App\Entities\M_user_entity::one($_SESSION[getSessionVariable_config()['userdata']]['Id']);
        $validate = $muser->saveNewPassword($model);
        // echo json_encode($validate);
        if(empty($validate)){
            $successmsg = getSuccessMessage_paging();
            $this->session->setFlashdata(transactionMessage_config()['success'], $successmsg);
            return redirect('changePassword');
        } else {
            $this->session->setFlashdata(transactionMessage_config()['edit'],$validate);
            $data['model'] = $model;
            $this->loadView('m_user/changePassword', $data);    
        }
    }

    public function savesetting(){
        if($this->checkSession())
            return $this->checkSession();

        $language = $this->request->getPost('languageid');
        $radiocolor = $this->request->getPost('radiocolor');
        $rowperpage = $this->request->getPost('rowperpage');
        //$usersetting = $this->M_users->create_usersetting_object($_SESSION['usersettings']['Id'], $_SESSION[getSessionVariable_config()['userdata']]['id'],$language, explode("~",$radiocolor)[1],  $rowperpage);
        $usersetting = \App\Entities\M_usersetting_entity::one($_SESSION[getSessionVariable_config()['usersettings']]['Id']);
        $usersetting->G_Language_Id = $language;
        $usersetting->G_Color_Id = explode("~",$radiocolor)[1];
        $usersetting->RowPerpage = $rowperpage;
        echo json_encode($usersetting);
        $usersetting->save();

        $languages = \App\Entities\G_language_entity::one($language);
        $colors = \App\Entities\G_color_entity::one(explode("~",$radiocolor)[1]);
        replaceSession(getSessionVariable_config()['usersettings'], get_object_vars($usersetting));
        replaceSession(getSessionVariable_config()['languages'], get_object_vars($languages));
        replaceSession(getSessionVariable_config()['colors'], get_object_vars($colors));
        return redirect('settings');
    }

    public function saveprofile(){
        
        if($this->checkSession())
            return $this->checkSession();
            
        $user = \App\Entities\M_user_entity::one($_SESSION[getSessionVariable_config()['userdata']]['Id']);
        $profile = $user->get_first_M_Userprofile();


        $completename = $this->request->getPost('completename');
        $address = $this->request->getPost('address');
        $phone = $this->request->getPost('phone');
        $email = $this->request->getPost('email');
        $aboutme = $this->request->getPost('aboutme');
        $newphotoname="";
        // echo json_encode($_FILES['file']['name']);
        $imagefile = $this->request->getFiles('file');
        echo json_encode($this->request->getFiles());
        // if(!empty($_FILES['file']['name'])){
        //     $newphotoname = $this->upload_profile_pic($_FILES['file']);
        //     if($profile->PhotoName != 'user_default.png')
        //         unlink($profile->PhotoPath.$profile->PhotoName);
        // }

        // $profile->CompleteName = $completename;
        // $profile->Address = $address;
        // $profile->Phone = $phone;
        // $profile->Email = $email;
        // $profile->AboutMe = $aboutme;
        // if(!empty($_FILES['file']['name']))
        //     $profile->PhotoName = $newphotoname;
        // $profile->save();
        // // echo json_encode($_FILES);

        // replaceSession(getSessionVariable_config()['userprofile'], get_object_vars($profile));
        // return redirect('profile');
    }

    private function upload_profile_pic($files){
        $config = userProfileUpload_config();
        $this->load->library('upload', $config);
        $date = date("YmdHis");

        //$newName = $date."_".str_replace(".","_",preg_replace('/\s+/', '', $files['name']));
        $newName = $date."_". $files['name'];
        
        // $_FILES['file']['name']= $newName;
        // $_FILES['file']['type']= $files['type'];
        // $_FILES['file']['tmp_name']= $files['tmp_name'];
        // $_FILES['file']['error']= $files['error'];
        // $_FILES['file']['size']= $files['size'];

        // $config['file_name'] = $newName;
        // $this->upload->initialize($config);
        // if (!$this->upload->do_upload('file'))
        // {
        //         $error = array('error' => $this->upload->display_errors());

        // }
        // else
        // {
        //         // $this->upload->data();
        //         // $submissionfiles = $this->T_submissionfiles->new_object();
        //         // $submissionfiles->T_Submission_Id = $submissionid;
        //         // $submissionfiles->FileName = $newName;
        //         // $submissionfiles->FileType = $files['type'];
        //         // $submissionfiles->Path = $config['upload_path'];
        //         // $submissionfiles->CreatedBy = $_SESSION[getSessionVariable_config()['userdata']]['Username'];
        //         // $submissionfiles->save();
                
        // }
        return $newName;
    }
}