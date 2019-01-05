<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Donor_model extends MY_Model
{

    private $_titleName;
    private $_firstName;
    private $_lastName;
    private $_email;
    private $_donorId;
    private $_tel;
    private $_address;
    private $_createdDate;
    private $_updatedDate;
    private $_status;


    public function __construct()
    {
        parent::__construct();
    }


    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function setDonorId($donorId)
    {
        $this->_donorId = $donorId;
    }

    public function getDonorId()
    {
        return $this->_donorId;
    }

    public function setTel($tel)
    {
        $this->_tel = $tel;
    }

    public function setAddress($address)
    {
        $this->_address = $address;
    }

    public function setStatus($status)
    {
        $this->_status = $status;
    }

    public function setCreatedDate($createDate)
    {
        $this->_createdDate = $createDate;
    }

    public function setUpdatedDate($updateDate)
    {
        $this->_updatedDate = $updateDate;
    }

    public function setFirstName($first_name)
    {
        $this->_firstName = $first_name;
    }

    public function setLastName($last_name)
    {
        $this->_lastName = $last_name;
    }
    public function setTitleName($title_name){
        $this->_titleName = $title_name;
    }


    public function create()
    {
        $data = array(
            'title_name' => $this->_titleName,
            'first_name' => $this->_firstName,
            'last_name' => $this->_lastName,
            'email' => $this->_email,
            'tel' => $this->_tel,
            'status' => $this->_status,
            'created_date' => $this->_createdDate,
            'updated_date' => $this->_updatedDate
        );
        $this->db->insert($this->tbl_donor, $data);
        if (!is_blank($this->db->insert_id() && $this->db->insert_id() > 0)) {
            $this->setDonorId($this->db->insert_id());
            return true;
        } else {
            return false;
        }

    }

    public function update($data)
    {
        if (is_array($data)) {

        }

    }

    public function delete()
    {

    }

    public function donorList()
    {

    }

    public function getDonor()
    {

    }

    public function checkDonor()
    {
        $this->db->where('email', $this->_email);
        $this->db->limit(1);
        $query = $this->db->get($this->tbl_donor);

        $result = "";
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $result = $row;
            }
        }

        if (!is_blank($result)) {
            $donerID = get_array_value($result, 'aid', '');
            $this->setDonorId($donerID);

            return true;
        } else {
            return false;
        }


//        return $result;


    }


}// end of class
