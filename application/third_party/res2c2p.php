<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . "/third_party/2c2p/pkcs7.php";

class res2c2p extends pkcs7
{
    private $response ="";
    private $_prk;
    private $_pub;

    public function __construct()
    {
        $this->_prk = APPPATH . "/third_party/2c2p/keys/demo2.pem";
        $this->_pub = APPPATH . "/third_party/2c2p/keys/demo2.crt";

    }
    public function setResponse($response){
        $this->response = $response;
    }

    public function getResult(){
        $result = "";
        $result = $this->decrypt($this->response, $this->_pub,$this->_prk,"2c2p");

        return $result;
    }



}


