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