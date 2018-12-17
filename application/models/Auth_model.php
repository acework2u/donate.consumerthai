<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends MY_Model
{
    // Declaration of a variables
    private $_userID;
    private $_userName;
    private $_firstName;
    private $_lastName;
    private $_email;
    private $_password;
    private $_contactNo;
    private $_companyName;
    private $_address;
    private $_systemID;
    private $_dob;
    private $_verificationCode;
    private $_timeStamp;
    private $_status;
    private $_token;
    private $_user_role_id;
    private $_cus_group_id;


    public function __construct()
    {
        parent::__construct();
//        $this->db = $this->load->database('auth_db', TRUE);
    }


    //Declaration of a methods
    public function setUserID($userID)
    {
        $this->_userID = $userID;
    }

    public function setUserName($userName)
    {
        $this->_userName = $userName;
    }

    public function setFirstname($firstName)
    {
        $this->_firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->_lastName = $lastName;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function setContactNo($contactNo)
    {
        $this->_contactNo = $contactNo;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function setAddress($address)
    {
        $this->_address = $address;
    }

    public function setDOB($dob)
    {
        $this->_dob = $dob;
    }

    public function setSystemId($system_id)
    {
        $this->_systemID = $system_id;
    }

    public function setVerificationCode($verificationCode)
    {
        $this->_verificationCode = $verificationCode;
    }

    public function setTimeStamp($timeStamp)
    {
        $this->_timeStamp = $timeStamp;
    }

    public function setStatus($status)
    {
        $this->_status = $status;
    }

    public function setToken($token)
    {
        $this->_token = $token;
    }

    public function setRole($roleId)
    {
        $this->_user_role_id = $roleId;
    }

    public function setGroup($groupId)
    {
        $this->_cus_group_id = $groupId;
    }

    public function setCompanyName($companyName)
    {
        $this->_companyName = $companyName;
    }

    //create new user
    public function create()
    {
        $hash = $this->hash($this->_password);
        $data = array(
//            'name' => $this->_userName,
            'first_name' => $this->_firstName,
            'last_name' => $this->_lastName,
            'email' => $this->_email,
            'user_name' => $this->_userName,
            'company_name' => $this->_companyName,
            'password' => $hash,
            'user_role_id' => $this->_user_role_id,
            'cus_group_id' => $this->_cus_group_id,
            'verification_code' => $this->_verificationCode,
            'created_date' => $this->_timeStamp,
            'modified_date' => $this->_timeStamp,
            'status' => $this->_status
        );
        $this->db->insert($this->tbl_users, $data);
        if (!empty($this->db->insert_id()) && $this->db->insert_id() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //update user
    public function update()
    {


        $data = array();
        if (!is_blank($this->_password)) {
            $hash = $this->hash($this->_password);
            $data['password'] = $hash;
        }
        $data['name'] = $this->_firstName;
        $data['lastname'] = $this->_lastName;
        $data['user_role_id'] = $this->_user_role_id;
        $data['cus_group_id'] = $this->_customer_group_id;
        $data['updated_at'] = $this->_timeStamp;
        /*
                $data = array(
                    'first_name' => $this->_firstName,
                    'last_name' => $this->_lastName,
                    'contact_no' => $this->_contactNo,
                    'user_role_id' => $this->_user_role_id,
                    'customer_group_id' => $this->_customer_group_id,
                    'update_at' => $this->_timeStamp,
                );
        */
        $this->db->where('id', $this->_userID);
        $msg = $this->db->update($this->tbl_users, $data);
        if ($msg == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function user_count()
    {
        return $this->db->count_all($this->tbl_users);
    }

    public function delete_user($data = '')
    {
        if (is_array($data)) {
            $user_id = get_array_value($data, 'id', '');
            $this->db->delete($this->tbl_cus_mstr, array('id' => $user_id));
            if ($this->db->affected_rows() > 0) {
                return true;
            }
        }
        return false;
    }

    function group_list()
    {
        $db_where = array('status' => 1);

        if (getUserRoleId() > 1) {
            $this->db->where($db_where);
        }
        $query = $this->db->get($this->tbl_cus_group);
        $result = array();
        $rows = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $rows = array(
                    'id' => get_array_value($row, 'id', ''),
                    'name' => get_array_value($row, 'name', ''),
                    'status' => get_array_value($row, 'status', '')
                );

                $result[] = $rows;
            }
            return $result;
        }

        return false;

    }

    function user_list($limit = 20, $start = 0)
    {
        $result = array();
        $rows = array();
        $this->db->reset_query();

        $this->db->select('cus_mstr.id,cus_mstr.email,cus_mstr.`password`,cus_mstr.`name`,cus_mstr.lastname,cus_mstr.telephone,cus_mstr.user_role_id,user_role.`name` AS role_name,cus_group.`name` AS group_name,cus_mstr.cus_group_id,cus_mstr.`status` AS user_status');
        $this->db->join($this->tbl_cus_group, 'cus_mstr.cus_group_id = cus_group.id', 'left');
        $this->db->join($this->tbl_user_role, 'cus_mstr.user_role_id = user_role.id ', 'left');


        switch (getUserRoleId()) {
            case 5:
                $group_id = getUserGroupId();
                $db_where = array('cus_mstr.cus_group_id' => $group_id, 'cus_mstr.status' => '1');
                $this->db->where($db_where);
                break;
            case 4:
                $group_id = getUserGroupId();
                $db_where = array('cus_mstr.cus_group_id' => $group_id);
                $this->db->where($db_where);
                break;
            case 3:
                $group_id = getUserGroupId();
                $db_where = array('cus_mstr.cus_group_id' => $group_id);
                $this->db->where($db_where);
                break;
            case 2:
                $group_id = getUserGroupId();
                $db_where = array('cus_mstr.cus_group_id' => $group_id);
                $this->db->where($db_where);

                break;
            case 1:
                $group_id = getUserGroupId();
                $db_where = array('cus_mstr.status' => '1'); //'cus_mstr.status'=>'1'
                $this->db->where($db_where);
                break;
        }


        $query = $this->db->order_by('id', 'desc')->limit($limit, $start)->get($this->tbl_cus_mstr);


        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $rows = array(
                    'id' => get_array_value($row, 'id', ''),
                    'email' => get_array_value($row, 'email', ''),
                    'name' => get_array_value($row, 'name', ''),
                    'last_name' => get_array_value($row, 'lastname', ''),
                    'user_role_id' => get_array_value($row, 'user_role_id', ''),
                    'role_name' => get_array_value($row, 'role_name', ''),
                    'customer_group_id' => get_array_value($row, 'cus_group_id'),
                    'group_name' => get_array_value($row, 'group_name', ''),
                    'status' => get_array_value($row, 'user_status', '')
                );
                $result[] = $rows;
            }
        }

        return $result;

    }


    // login method and password verify
    function login()
    {
        $this->db->select('*,id as user_id');
        $this->db->from($this->tbl_users);
        $this->db->where('email', $this->_userName);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $result = $query->result();
            foreach ($result as $row) {
                if ($this->verifyHash($this->_password, $row->password) == TRUE) {
                    return $result;
                } elseif ($this->verifyHash256($this->_password, $row->password) == TRUE) {
                    return $result;
                } else {
                    return FALSE;
                }
            }
        } else {
            return FALSE;
        }


    } //end of function login


    //change password
    public function changePassword()
    {
        $hash = $this->hash($this->_password);
        $data = array(
            'password' => $hash,
        );
        $this->db->where('id', $this->_userID);
        $msg = $this->db->update('users', $data);
        if ($msg == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // get User Detail
    public function getUserDetails()
    {
        $this->db->select(array('m.id as user_id', 'CONCAT(m.name, " ", m.lastname) as full_name', 'm.name', 'm.lastname', 'm.email', 'm.token'));
        $this->db->from('cus_mstr as m');
        $this->db->where('m.id', $this->_userID);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return FALSE;
        }
    }

    // update Forgot Password
    public function updateForgotPassword()
    {
        $hash = $this->hash($this->_password);
        $data = array(
            'password' => $hash,
        );
        $this->db->where('email', $this->_email);
        $msg = $this->db->update('users', $data);
        if ($msg > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // get Email Address
    public function activate()
    {
        $data = array(
            'status' => 1,
            'verification_code' => 1,
        );
        $this->db->where('verification_code', $this->_verificationCode);
        $msg = $this->db->update('users', $data);
        if ($msg == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // password hash
    public function hash($password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

    // password verify
    public function verifyHash($password, $vpassword)
    {
        if (password_verify($password, $vpassword)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function hash256($password)
    {
        $hash = hash("sha256", $password);
        return $hash;
    }

    public function verifyHash256($password, $vpassword)
    {
        $ch_pass = $this->hash256($password);
        if ($ch_pass == $vpassword) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function check_user($email = "")
    {

        if (!is_blank($email)) {
            $query = $this->db->where(array('email' => $email))->get($this->tbl_users);
            if ($query->num_rows() != 0) {
                return true;
            }
        }

        return false;
    }


}

?>
