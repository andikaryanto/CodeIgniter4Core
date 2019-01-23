<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Entities\M_user_entity;
use App\Controllers\Base_controller;

class Login extends Controller
{
    protected $helpers = ['helpers', 'form', 'paging', 'config'];
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        // echo json_encode($_SESSION['userdata']);
        if(!empty($this->session->get(getSessionVariable_config()['userdata']))){
            return redirect()->route('home');
            //echo json_encode($this->session->get('userdata'));
        }
        else{
            echo view('login/login');
        }
    }
    public function dologin()
    {
        // echo json_encode($_POST['loginUsername']);
        $username = $this->request->getPost('loginUsername');
        $password = $this->request->getPost('loginPassword');
        
        $user = new M_user_entity();
        $params = array(
            'where' => array(
                'Username' => $username,
                'Password' => encryptMD5(getStringPrefix_config().$username.$password)
            )   
        );
        $query = $user->first($params);
        //echo json_encode($query);
        if ($query)
        {
            // echo json_encode($query->get_list_M_Usersetting()[0]->get_G_Color());
            //$query = $result[0];
            if($query->IsActive == 1){
                $this->session->set(getSessionVariable_config()['userdata'],get_object_vars($query));
                $this->session->set(getSessionVariable_config()['usersettings'],get_object_vars($query->get_list_M_Usersetting()[0]));
                $this->session->set(getSessionVariable_config()['userprofile'],get_object_vars($query->get_list_M_Userprofile()[0]));
                $this->session->set(getSessionVariable_config()['languages'],get_object_vars($query->get_list_M_Usersetting()[0]->get_G_Language()));
                $this->session->set(getSessionVariable_config()['colors'],get_object_vars($query->get_list_M_Usersetting()[0]->get_G_Color()));
                // echo redirect_paging('home');
                return redirect('home');
            } else {
                return redirect('login');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function dologout()
    {
        //$username = $_SESSION['userdata']['Username'];
        $this->session->destroy();
        return redirect('login');
    }
    
}