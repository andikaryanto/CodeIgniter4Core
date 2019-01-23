<?php namespace App\Controllers;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Message;
class Base_controller extends Controller {
    // protected $request;
    protected $helpers = ['helpers', 'form', 'paging', 'config'];
    protected $session;
    protected $negotiator;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->negotiator = \Config\Services::negotiator();
        // $request = \Config\Services::request();
        
        // $supported = [
        //     $_SESSION['kospinlanguages']['Locale']
        // ];

        // $lang = $this->negotiator->language($supported);
        // $this->negotiateLanguage($supported);
        // echo json_encode($lang);
        // echo (string)$_SESSION['kospinlanguages']['Locale'];
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