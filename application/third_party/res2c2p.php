<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . "/third_party/2c2p/pkcs7.php";

class Res2c2p extends pkcs7
{
    private $response ="";
    private $_prk;
    private $_pub;

    public function __construct()
    {
        if($_SERVER["SERVER_NAME"] == "donate-consumer.local"){
            /*** Demo **/
        $this->_prk = APPPATH . "/third_party/2c2p/keys/demo2.pem";
        $this->_pub = APPPATH . "/third_party/2c2p/keys/demo2.crt";
        }else{
            /**** Production **/
            $this->_prk = APPPATH . "/third_party/2c2p/keys/private.pem";
            $this->_pub = APPPATH . "/third_party/2c2p/keys/cert.crt";
        }





    }
    public function setResponse($response){
        $this->response = $response;
    }

    public function getResult(){
        $result = "";
        if($_SERVER["SERVER_NAME"] == "donate-consumer.local"){
            $result = $this->decrypt($this->response, $this->_pub,$this->_prk,"2c2p"); // Demo
        }else{
            $result = $this->decrypt($this->response, $this->_pub,$this->_prk,"Joe2262527"); // Pro
        }
        return $result;
    }



}



