<?php namespace App\Controllers;
use CodeIgniter\Controller;
class Base_controller extends Controller {
    // protected $request;
    protected $helpers = ['helpers', 'form', 'paging', 'config'];
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function loadView($page, $data = array()){
        echo view('template/header', $this->getDataHeader());
        echo view($page, $data);
        echo view('template/footer');
    }

    private function getDataHeader(){
        //$CI->load->model(array("M_forms")); $CI =& get_instance();
        $companyinstance = 'App\Entities\M_company_entity';
        $companyname = lang('Form.instancename');
        $mcompany = new $companyinstance;
        $company = $mcompany->findAll();
        if($company){
            $companyname = $company[0]->CompanyName;
        }
        
        $forminstance = 'App\Entities\M_form_entity';
        $mform = new $forminstance;

        $setupmenu = $mform->getDataByClassname("Setup");
        $mastermenu = $mform->getDataByClassname("Master");
        $generalmenu = $mform->getDataByClassname("General");
        $transactionmenu = $mform->getDataByClassname("Transaction");

        
        $data['companyname'] = $companyname;
        $data['setupmenu'] = $setupmenu;
        $data['mastermenu'] = $mastermenu;
        $data['generalmenu'] = $generalmenu;
        $data['transactionmenu'] = $transactionmenu;

        return $data;
    }
}