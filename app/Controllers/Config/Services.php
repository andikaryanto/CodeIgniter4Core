<?php namespace Controllers\Config;
use CodeIgniter\Config\BaseService;

class Services extends BaseService {
    public static function checkSesion(){
        return redirect('login');
    }
}