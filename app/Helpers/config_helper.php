<?php
function getFormName_config(){
    $data = [
        'm_groupuser' => "m_groupusers",
        'm_user' => "m_users",
        'm_company' => "m_companies",
        'm_form' => "m_forms",
    ];
    return $data;
}

function getStringPrefix_config(){
    return "kospin";
}

function getSessionVariable_config(){
    $data = [
        'userdata' => getStringPrefix_config()."userdata",
        'usersettings' => getStringPrefix_config()."usersettings",
        'userprofile' => getStringPrefix_config()."userprofile",
        'languages' => getStringPrefix_config()."languages",
        'colors' => getStringPrefix_config()."colors",
    ];
    return $data;
}

function transactionMessage_config(){
    $data = [
        'add' => "add_warning_msg",
        'success' => "success_msg",
        'edit' => "edit_warning_msg"
    ];
    return $data;
}

function submissionUpload_config($filename = null){
    $config['upload_path']          = './uploads/submission_files/';
    $config['allowed_types']        = 'jpg|png|pdf|doc|docx';
    $config['max_size']             = 1000;
    $config['max_width']            = 10240;
    $config['max_height']           = 7680;
    $config['file_name']            = $filename;
    return $config;
}

function userProfileUpload_config($filename = null){
    $config['upload_path']          = './assets/user_profile/';
    $config['allowed_types']        = 'jpg|png';
    $config['max_size']             = 1000;
    $config['max_width']            = 10240;
    $config['max_height']           = 7680;
    $config['file_name']            = $filename;
    return $config;
}