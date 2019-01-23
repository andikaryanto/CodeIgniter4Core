<?php namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Entity;
use App\Entities\M_groupuser_entity;
use App\Entities\M_accessrole_entity;
use App\Controllers\Base_controller;

class M_groupuser extends Base_controller{

    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_groupuser'],'Read'))
        {
            $entity = new M_groupuser_entity();
            $model = $entity->findAll();
            $data = getDataPage_paging($model);
            // echo json_encode($_SESSION['kospinlanguages']['Locale']);
            $this->loadView('m_groupuser/index', $data);
        }
        else
        {   
            echo view('forbidden/forbidden');
        }
    }

    public function add(){

        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_groupuser'],'Write'))
        {
            $model = new M_groupuser_entity();
            $data = getDataPage_paging($model);
            $this->loadView('m_groupuser/add', $data);
        }
        else
        {   
            echo view('forbidden/forbidden');
        }
    }

    public function addsave(){
        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_groupuser'],'Write'))
        {
            $name = $this->request->getPost('named');
            $description = $this->request->getPost('description');
            
            $model = new M_groupuser_entity();
            $model->GroupName = $name;
            $model->Description = $description;

            $validate = $model->validate();

            if($validate)
            {
                $this->session->setFlashdata(transactionMessage_config()['add'],$validate);
                $data = getDataPage_paging($model);
                $this->loadView('m_groupuser/add', $data);   
            }
            else{

                $id = $model->save();
                // echo $id;
                $successmsg = getSuccessMessage_paging();
                $this->session->setFlashdata(transactionMessage_config()['success'], $successmsg);
                return redirect('mgroupuser/add');
            }
        } else {   
            echo view('forbidden/forbidden');
        }
        
    }

    public function edit($id){

        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_groupuser'],'Write'))
        {
            $entity = new M_groupuser_entity();
            $model = $entity->find($id);
            $data = getDataPage_paging($model);
            $this->loadView('m_groupuser/edit', $data);
        }
        else
        {   
            echo view('forbidden/forbidden');
        }
    }

    public function editsave(){
        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_groupuser'],'Write'))
        {
            $id = $this->request->getPost('idgroupuser');
            $name = $this->request->getPost('named');
            $description = $this->request->getPost('description');
            
            $entity = new M_groupuser_entity();
            $model = $entity->find($id);
            $oldmodel = clone $model;

            $model->GroupName = $name;
            $model->Description = $description;

            
            $validate = $model->validate($oldmodel);
            //echo json_encode($validate);
            if($validate)
            {
                $this->session->setFlashdata('edit_warning_msg',$validate);
                // echo json_encode( $this->session->getFlashdata('edit_warning_msg'));
                $data = getDataPage_paging($model);
                $this->loadView('m_groupuser/edit', $data); 
            }
            else{

                $id = $model->save();
                $successmsg = getSuccessMessage_paging();
                $this->session->setFlashdata(transactionMessage_config()['success'], $successmsg);
                return redirect('mgroupuser');
            }
        } else {   
            echo view('forbidden/forbidden');
        }
    }

    public function roles($groupid){
        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_groupuser'],'Write'))
        { 

            $entity = new M_groupuser_entity();
            $model = $entity->find($groupid); 
            $data['model'] = $model;
            $this->loadView('m_groupuser/roles', $data); 

        } else {
            echo json_encode(delete_status("", FALSE, TRUE));
        }
    }

    public function saverole()
    {
        $formid = $this->request->getPost("formid");
        $groupid = $this->request->getPost("groupid");
        $read = $this->request->getPost("read");
        $write = $this->request->getPost("write");
        $delete = $this->request->getPost("delete");
        $print = $this->request->getPost("print");

        $params = array(
            'where' => array(
                'M_Form_Id' => $formid,
                'M_Groupuser_Id' => $groupid
            )
        );

        $roleentity = new M_accessrole_entity();

        $roles = $roleentity->first($params);
        if($roles){
            //$update_roles = $roleentity->find($roles->Id);
            $roles->Read = $read;
            $roles->Write = $write;
            $roles->Delete = $delete;
            $roles->Print = $print;
            $roles->save();
            echo json_encode($roles);
        } else {
            $roleentity->M_Form_Id = $formid;
            $roleentity->M_Groupuser_Id = $groupid;
            $roleentity->Read = $read;
            $roleentity->Write = $write;
            $roleentity->Delete = $delete;
            $roleentity->Print = $print;
            $roleentity->save();
            echo json_encode($roleentity);
        }
    }

    public function delete(){
        $id = $this->request->getPost("id");
        // $id = $this->request->getGet("id");
        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_groupuser'],'Delete'))
        {   
            $entity = new M_groupuser_entity();
            $model = $entity->find($id);
            $delete = $model->delete();
            // echo json_encode($response->getStatusCode());
            // if(isset($delete)){
            //     $deletemsg = getQueryErrorMessage($delete['code']);
            //     //$this->session->set_flashdata('warning_msg', $deletemsg);
            //     echo json_encode(delete_status($deletemsg, FALSE));
            // } else {
                $deletemsg = getDeleteMessage_paging();
                $this->session->setFlashdata('delete_msg', $deletemsg);
                echo json_encode(delete_status($deletemsg));
            // }
        } else {
            echo json_encode(delete_status("", FALSE, TRUE));
        }
    }
}