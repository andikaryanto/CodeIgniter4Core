<?php

function encryptMd5($string){
    $hash = md5($string);
    $lastestString = substr($hash, strlen($hash) - 1,1);
    $asci = ord($lastestString);
    $asci++;
    $newChar = chr($asci++);
    $newString = substr($hash, 0,strlen($hash) - 1).$newChar;
    return $newString;
}

function formatDateString($date){
    return (string)date("d-m-Y",strtotime($date));
}

function getEnumName($enumName, $enumDetailId){
    $CI =& get_instance();
    //$CI->lang->load('form_ui', !empty($_SESSION['language']['language']) ? $_SESSION['language']['language'] : $CI->config->item('language'));

    $CI->db->select('b.*');
    $CI->db->from('m_enums a');
    $CI->db->join('m_enumdetails b','a.Id = b.M_Enum_Id','inner');
    $CI->db->where('a.Name', $enumName);
    $CI->db->where('b.Value', $enumDetailId);
    $data = $CI->db->get()->row();

    //return $data->Resource;
    if(isset($data)){
        if(isset($data->Resource)){
            //$newStr = str_replace("res","ui",$data->Resource);
            return lang($data->Resource);
        } else {
            return $data->EnumName;
        }
    }
    return "";

}

function replaceSession($name, $data){
    $session = \Config\Services::session();
    $session->set($name, $data);
}

function delete_status($msg = NULL, $status = TRUE, $isforbidden = FALSE){
    $delete['msg'] = $msg;
    $delete['status'] = $status;
    $delete['isforbidden'] = $isforbidden;
    return $delete;
}

function get_first_letter($word){
    $new_str = "";
    $str_arr = explode(" ", $word);
    foreach($str_arr as $str){
        $new_str = $new_str.ucfirst(substr($str, 0,1));
    }
    return $new_str;
}

function get_current_date($format = null){
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone('Asia/Jakarta'));
    if(isset($format))
        return $date->format($format);
    return $date->format('d-m-Y');
    
}

function get_date($strdate, $add = '30 days', $format = "Y-m-d H:i:s"){
    // $dateadd;
    // if(!empty($add));
    //     $dateadd = new DateInterval($add);

    $date = date_create($strdate);
    date_add($date,date_interval_create_from_date_string($add));
    return date_format($date, $format);
}

function getFormatedDate($strdate = null, $format = null){
    $date;
    if(!empty($strdate))
        $date = new DateTime($strdate);
    else 
        $date = new DateTime();

    $date->setTimezone(new DateTimeZone('Asia/Jakarta'));
    if(isset($format))
        return $date->format($format);
    return $date->format('Y-m-d H:i:s');
}

function isPermitted($groupid = null, $form = null, $role = null){
    
    $groupentity = "App\Entities\M_groupuser_entity";
    $mgroupuser = new $groupentity;
    $ispermitted = $mgroupuser->isPermitted($groupid, $form, $role);
    return $ispermitted;
}

function setIsNull($data){
    if(empty($data))
        return null;
    else 
        return $data;
}

function setIsDecimal($data){
    if(empty($data))
        return 0.00;
    else {
        $newvalue = str_replace(".","", $data);
        $newvalue = str_replace(",",".", $newvalue);
        return $newvalue;
    }
}

function setisnumber($data){
    if(empty($data))
        return 0;
    else 
        return $data;
}

function varName( $v ) {
    $trace = debug_backtrace();
    $vLine = file( __FILE__ );
    $fLine = $vLine[ $trace[0]['line'] - 1 ];
    preg_match( "#\\$(\w+)#", $fLine, $match );
    return $match;
}

function set_dropzone_response($message){
    return array(
        'message' => $message
    );
}

function queryErrorCode(){
    $code['datainrefenrence'] = 1451;
    return $code;
}

function getQueryErrorMessage($code){
    $msg = array();

    if($code == queryErrorCode()['datainrefenrence']){
        $msg = array_push($msg, lang('Form.datainreference'));
    }

    return $msg;
}



