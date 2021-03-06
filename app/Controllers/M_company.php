<?php namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\Entity;
use App\Entities\M_company_entity;
use App\Controllers\Base_controller;

class M_company extends Base_controller{

    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
        if($this->checkSession())
            return $this->checkSession();

        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_company'],'Read'))
        {
            $model = \App\Entities\M_company_entity::listFirst();
            // echo json_encode($model);
            $data = getDataPage_paging($model);
            $this->loadView('m_company/add',$data);
        }
    }

    public function addsave(){
        if($this->checkSession())
            return $this->checkSession();
            
        if(isPermitted($_SESSION[getSessionVariable_config()['userdata']]['M_Groupuser_Id'],getFormName_config()['m_company'],'Write'))
        {

            $id = $this->request->getPost('companyid');
            $name = $this->request->getPost('named');
            $address = $this->request->getPost('address');
            $postcode = $this->request->getPost('postcode');
            $email = $this->request->getPost('email');
            $phone = $this->request->getPost('phone');
            $fax = $this->request->getPost('fax');

            $model = \App\Entities\M_company_entity::one($id);
            // echo json_encode($model);
            $model->CompanyName = setisnull($name);
            $model->Address = setisnull($address);
            $model->PostCode = setisnull($postcode);
            $model->Email = setisnull($email);
            $model->Phone = setisnull($phone);
            $model->Fax = setisnull($fax);
            //print_r($model);
            $validate = $model->validate();
    
            if($validate)
            {
                $this->session->setFlashdata(transactionMessage_config()['add'],$validate);
                $data = getDataPage_paging($model);
                $this->loadView('m_company/add', $data);   
            }
            else{
        
                $model->save();
                $successmsg = getSuccessMessage_paging();
                $this->session->setFlashdata('success_msg', $successmsg);
                // echo json_encode($this->session->getFlashdata('success_msg'));
                return redirect()->route('mcompany');
            }
        } else {   
            echo view('forbidden/forbidden');
        }
        
    }

   
}