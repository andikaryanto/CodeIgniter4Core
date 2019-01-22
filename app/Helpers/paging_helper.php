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

    $msg = array_push($msg, lang('Form.datadeleted'));
    return $msg;
}