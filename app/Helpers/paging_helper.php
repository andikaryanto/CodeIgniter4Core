<?php

function getDataPage_paging($model = null, $enums = array(), $data_modal = array()){
    $data = [
        'model' => $model,
        'enums' => $enums,
        'datamodal' => $data_modal,
    ];
    return $data;
}

function getSuccessMessage_paging(){
    $msg = array();
    $msg = array_merge($msg, array(0=>'Form.datasaved'));
    return $msg;
}

function getDeleteMessage_paging(){
    $msg = array();

    $msg = array_merge($msg, array(0=>lang('Form.datadeleted')));
    return $msg;
}

function baseurl_paging($url){
    return base_url($_SESSION[getSessionVariable_config()['languages']]['Locale']."/".$url);
}

function redirect_paging($url){
    return $_SESSION[getSessionVariable_config()['languages']]['Locale']."/".$url;
}