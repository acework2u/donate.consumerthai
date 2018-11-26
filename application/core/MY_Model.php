<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{

    public $db2;
    public $tbl_users;



    public function __construct()
    {
        $this->tbl_users = "users";



    }





} //End of Model


?>
