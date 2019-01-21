<?php
function getUsersSession()
{
    $ci =& get_instance();
    $ci->load->library('session');
    $userSession = $ci->session->userdata('userSession');
    return $userSession;
}

function getUserAid()
{
    $user_id = "";
    $userSession = getUsersSession();
    if (is_array($userSession)) {
        $user_id = get_array_value($userSession, 'user_id', '');
    }
    return $user_id;

}
function getUserFullName(){

    return getUserFirstName()." ".getUserLastName();
}

function getUserFirstName(){
    $first_name = "";

    $userSession = getUsersSession();
    if (is_array($userSession)) {
        $first_name = get_array_value($userSession, 'firstname', '');
    }

    return $first_name;

}
function getUserLastName(){
    $lastname = "";
    $userSession = getUsersSession();
    if (is_array($userSession)) {
        $lastname = get_array_value($userSession, 'lastname', '');
    }
    return $lastname;
}

function getUserGroupId()
{
    $user_groupId = "";
    $userSession = getUsersSession();
    if (is_array($userSession)) {
        $user_groupId = get_array_value($userSession, 'cus_group_id', '');
    }
    return $user_groupId;

}

function getUserToken(){
    $user_token = "";
    $userSession = getUsersSession();
    if (is_array($userSession)) {
        $user_token = get_array_value($userSession, 'cus_token', '');
    }
    return $user_token;

}
function getUserRoleId(){
    $user_role_id = "";
    $userSession = getUsersSession();
    if (is_array($userSession)) {
        $user_role_id = get_array_value($userSession, 'user_role_id', '');
    }
    return $user_role_id;
}

function isSuperAdmin(){
    if(getUserRoleId()==1){
        return true;
    }
    return false;
}

function isAdmin(){
    if(getUserRoleId()==3){
        return true;
    }
    return false;
}
function isStaff(){
    if(getUserRoleId()==5 || getUserRoleId()== 4){
        return true;
    }
    return false;
}



?>
