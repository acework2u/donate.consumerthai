<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Mail', 'mail');
        $this->load->library('form_validation');
    }

    // user profile
    public function index()
    {

        if ($this->session->userdata('ci_session_key_generate') == FALSE) {
            redirect('signin');
        } else {

            $this->data['metaDescription'] = 'User Profile';
            $this->data['metaKeywords'] = 'User Profile';
            $this->data['title'] = "User Profile - Anon De.";
            $this->data['breadcrumbs'] = array('Profile' => '#');
            $sessionArray = $this->session->userdata('ci_seesion_key');
            $this->auth->setUserID($sessionArray['user_id']);
            $this->data['userInfo'] = $this->auth->getUserDetails();
            $this->page_construct('auth/index', $this->data);
        }

    }

    public function userList()
    {
        if ($this->is_login()) {

            $this->data['title'] = "User Management";

            $this->load->model('Auth_model', 'user');

            $userList = array();
            $userList = $this->user->user_list();
            $this->data['userlist'] = $userList;

            $this->page_construct('auth/user_list', $this->data);
        } else {
            redirect('signin');
        }
    }

    function users_list()
    {
        $this->data['title'] = "User Management";

        $this->load->model('Auth_model', 'user');

        $userList = array();
        $userList = $this->user->user_list();
        $this->data['userlist'] = $userList;

        $this->page_construct('auth/user_list', $this->data);
    }


    function get_user_list()
    {
        if ($this->is_login()) {
            $this->load->model('Auth_model', 'user');

            $limit = 20;
            $start = 0;
            $total = 0;

            if (!is_blank($this->input->get_post('limit'))) {
                if (is_number($this->input->get_post('limit'))) {
                    $limit = $this->input->get_post('limit');
                }
            }

            if (!is_blank($this->input->get_post('start'))) {
                if (is_number($this->input->get_post('start'))) {
                    $start = $this->input->get_post('start');
                }
            }


            $userList = $this->user->user_list($limit, $start);
//            $total = $this->user->user_count();
            $total = count($userList);

            $data = array();
            $data['userinfo'] = $userList;
            $data['total_list'] = $total;

            echo json_encode($data);


        }
    }

    function get_group_list()
    {
        if ($this->is_login()) {
            $this->load->model($this->auth_model, 'auth');
            $groupList = array();
            $groupList = $this->auth->group_list();


            echo json_encode($groupList);
        }
    }

    // registration method
    public function register()
    {
        $data = array();
        $data['metaDescription'] = 'New User Registration';
        $data['metaKeywords'] = 'New User Registration';
        $data['title'] = "Registration CC System";
        $data['breadcrumbs'] = array('Registration' => '#');
        $this->page_construct('auth/register', $data);
    }

    // edit method
    public function edit()
    {
        if ($this->session->userdata('ci_session_key_generate') == FALSE) {
            redirect('signin'); // the user is not logged in, redirect them!
        } else {
            $data = array();
            $data['metaDescription'] = 'Update Profile';
            $data['metaKeywords'] = 'Update Profile';
            $data['title'] = "Update Profile - Anon De.";
            $data['breadcrumbs'] = array('Update Profile' => '#');
            $sessionArray = $this->session->userdata('ci_seesion_key');
            $this->auth->setUserID($sessionArray['user_id']);
            $data['userInfo'] = $this->auth->getUserDetails();
            $this->page_construct('auth/edit', $data);
        }
    }

    // login method
    public function login()
    {
        if ($this->session->userdata('ci_session_key_generate') == FALSE) {

            if (!empty($this->input->get('usid'))) {
                $verificationCode = urldecode(base64_decode($this->input->get('usid')));
                $this->auth->setVerificationCode($verificationCode);
                $this->auth->activate();
            }

            $this->data['metaDescription'] = 'Login';
            $this->data['metaKeywords'] = 'Login';
            $this->data['title'] = "Login - Anon De.";
            $this->data['breadcrumbs'] = array('Login' => '#');
//            $this->page_construct('user/user_login_view', $this->data);
            $this->load->view('auth/login', $this->data);

        } else {

            redirect('admin');

        }

    }

    // edit method
    public function changepwd()
    {
        if ($this->session->userdata('ci_session_key_generate') == FALSE) {
            redirect('signin'); // the user is not logged in, redirect them!
        } else {
            $data = array();
            $data['metaDescription'] = 'New User Registration';
            $data['metaKeywords'] = 'Change Password';
            $data['title'] = "Change Password - Anon De.";
            $data['breadcrumbs'] = array('Change Password' => '#');
            $this->page_construct('auth/changepwd', $data);
        }
    }

    //forgot password method
    public function forgotpassword()
    {
        if ($this->session->userdata('ci_session_key_generate') == TRUE) {
            redirect('profile'); // the user is logged in, redirect them!
        } else {
            $data['metaDescription'] = 'Forgot Password';
            $data['metaKeywords'] = 'Member, forgot password';
            $data['title'] = "Forgot Password - SoOLEGAL";
            $data['breadcrumbs'] = array('Forgot Password' => '#');
            $this->page_construct('auth/forgotpwd', $data);
        }
    }

    // action create user method
    public function actionCreate()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('contact_no', 'Contact No', 'required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth(DD-MM-YYYY)', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->register();
        } else {
            $firstName = $this->input->post('first_name');
            $lastName = $this->input->post('last_name');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $contactNo = $this->input->post('contact_no');
            $dob = $this->input->post('dob');
            $address = $this->input->post('address');
            $timeStamp = time();
            $status = 0;
            $verificationCode = uniqid();
            $verificationLink = site_url() . 'signin?usid=' . urlencode(base64_encode($verificationCode));
            $userName = $this->mail->generateUnique('users', trim($firstName . $lastName), 'user_name', NULL, NULL);
            $this->auth->setUserName($userName);
            $this->auth->setFirstName(trim($firstName));
            $this->auth->setLastName(trim($lastName));
            $this->auth->setEmail($email);
            $this->auth->setPassword($password);
            $this->auth->setContactNo($contactNo);
            $this->auth->setAddress($address);
            $this->auth->setDOB($dob);
            $this->auth->setVerificationCode($verificationCode);
            $this->auth->setTimeStamp($timeStamp);
            $this->auth->setStatus($status);
            $chk = $this->auth->create();
            if ($chk === TRUE) {
                $this->load->library('encrypt');
                $mailData = array('topMsg' => 'Hi', 'bodyMsg' => 'Congratulations, Your registration has been successfully submitted.', 'thanksMsg' => SITE_DELIMETER_MSG, 'delimeter' => SITE_DELIMETER, 'verificationLink' => $verificationLink);
                $this->mail->setMailTo($email);
                $this->mail->setMailFrom(MAIL_FROM);
                $this->mail->setMailSubject('User Registeration!');
                $this->mail->setMailContent($mailData);
                $this->mail->setTemplateName('verification');
                $this->mail->setTemplatePath('mailTemplate/');
//                $chkStatus = $this->mail->sendMail(MAILING_SERVICE_PROVIDER);
                $chkStatus = $this->mail->send2Mail(MAILING_SERVICE_PROVIDER);
                if ($chkStatus === TRUE) {
                    redirect('signin');
                } else {
                    echo 'Error';
                }
            } else {

            }
        }
    }

    public function actionUserCreate()
    {
        $firstName = "";
        $lastName = "";
        $email = "";
        $userName = "";
        $password = "";
        $companyName = "";
        $userRuleId = 4;
        $userGroupId = 3;
        $timeStamp = time();
        $status = 0;

        $data = array();

        #Check data before Insert to database
        if (!is_blank($this->input->get_post('name'))) {
            $firstName = trim($this->input->get_post('name'));
        }
        if (!is_blank($this->input->get_post('lastname'))) {
            $lastName = trim($this->input->get_post('lastname'));
        }
        if (!is_blank($this->input->get_post('email'))) {
            $email = trim($this->input->get_post('email'));
        }
        if (!is_blank($this->input->get_post('company_name'))) {
            $companyName = trim($this->input->get_post('company_name'));
        }
        if (!is_blank($this->input->get_post('user_name'))) {
            $userName = trim($this->input->get_post('user_name'));
        }
        if (!is_blank($this->input->get_post('password'))) {
            $password = trim($this->input->get_post('password'));
        }


        $verificationCode = uniqid();
        $verificationLink = site_url() . 'signin?usid=' . urlencode(base64_encode($verificationCode));
        $userName = $this->mail->generateUnique('users', trim($firstName . $lastName), 'user_name', NULL, NULL);

        $this->auth->setFirstName(trim($firstName));
        $this->auth->setLastName(trim($lastName));
        $this->auth->setEmail($email);

        $this->auth->setUserName($userName);
        $this->auth->setPassword($password);

        $this->auth->setRole($userRuleId);
        $this->auth->setGroup($userGroupId);
        $this->auth->setCompanyName($companyName);

        $this->auth->setVerificationCode($verificationCode);
        $this->auth->setTimeStamp($timeStamp);
        $this->auth->setStatus($status);

        $chk = false;

        if (!$this->auth->check_user($email)) {
            $chk = $this->auth->create();
        }else{
            $data['error'] = true;
            $data['message'] = "this email is registered please choose another one";
            echo json_encode($data);
            exit();
        }


//        $chk = $this->auth->create();


        if ($chk === TRUE) {
            $this->load->library('encrypt');
            $mailData = array('topMsg' => 'Hi', 'bodyMsg' => 'Congratulations, Your registration has been successfully submitted.', 'thanksMsg' => SITE_DELIMETER_MSG, 'delimeter' => SITE_DELIMETER, 'verificationLink' => $verificationLink);
            $this->mail->setMailTo($email);
            $this->mail->setMailFrom(MAIL_FROM);
            $this->mail->setMailSubject('User Registration!');
            $this->mail->setMailContent($mailData);
            $this->mail->setTemplateName('userverification');
            $this->mail->setTemplatePath('mailtemplates/');
            $chkStatus = $this->mail->send2Mail(MAILING_SERVICE_PROVIDER);
            if ($chkStatus === TRUE) {
//                    redirect('signin');
                $data['message'] = "Create new user success. Please confirm your email address to finish your Registration";
            } else {
                $data['error'] = false;
                $data['message'] = "Create new user success.";
            }
        } else {
            $data['error'] = true;
            $data['message'] = "could not create this user";
        }

        echo json_encode($data);

    }

    public function actionUser()
    {
        if ($this->is_login()) {
            $action = "";
            if (!is_blank($this->input->get_post('action'))) {
                $action = $this->input->get_post('action');
            }

            if (!is_blank($action)) {

                $email = "";
                $password = "";
                $name = "";
                $lasname = "";
                $user_role_id = "";
                $customer_group_id = "";
                $status = 1;
                $timeStamp = time();
                $chk = false;


                if (!is_blank($this->input->get_post('email'))) {
                    $email = $this->input->get_post('email');

                }
                if (!is_blank($this->input->get_post('password'))) {
                    $password = $this->input->get_post('password');

                }
                if (!is_blank($this->input->get_post('name'))) {
                    $name = $this->input->get_post('name');
                }
                if (!is_blank($this->input->get_post('lastname'))) {
                    $lasname = $this->input->get_post('lastname');
                }
                if (!is_blank($this->input->get_post('role_id'))) {
                    $user_role_id = $this->input->get_post('role_id');
                }
                if (!is_blank($this->input->get_post('group_id'))) {
                    $customer_group_id = $this->input->get_post('group_id');
                }

                switch ($action) {
                    case "new":


                        if (!is_blank($email) && !is_blank($password) && !is_blank($name)) {

                            $this->auth->setEmail($email);
                            $this->auth->setPassword($password);
                            $this->auth->setFirstname($name);
                            $this->auth->setLastname($lasname);
                            $this->auth->setTimeStamp($timeStamp);
                            $this->auth->setStatus($status);
                            $this->auth->setRole($user_role_id);
                            $this->auth->setGroup($customer_group_id);

                            $chk = $this->auth->create();
                        }

                        if ($chk === TRUE) {

                            $data['error'] = false;
                            $data['message'] = "Create new user success";

                        } else {
                            $data['error'] = true;
                            $data['message'] = "Can not create User";

                            if (is_blank($name)) {
                                $data['message'] = "Name required.";

                            }
                            if (is_blank($email)) {
                                $data['message'] = "Email required.";

                            }
                            if (is_blank($password)) {
                                $data['message'] = "Password required.";

                            }
                        }


                        echo json_encode($data);

                        break;
                    case "update":

                        $user_role_id = $this->input->get_post('user_role_id');
                        $customer_group_id = $this->input->get_post('customer_group_id');
                        $lasname = $this->input->get_post('last_name');
                        $user_id = 0;
                        $user_id = $this->input->get_post('id');

                        $this->auth->setUserID($user_id);
                        $this->auth->setEmail($email);
                        $this->auth->setPassword($password);
                        $this->auth->setFirstname($name);
                        $this->auth->setLastname($lasname);
                        $this->auth->setTimeStamp($timeStamp);
                        $this->auth->setStatus($status);
                        $this->auth->setRole($user_role_id);
                        $this->auth->setGroup($customer_group_id);


                        $chk = $this->auth->update();
                        if ($chk === TRUE) {

                            $data['error'] = false;
                            $data['message'] = "Update user success";

                        } else {
                            $data['error'] = true;
                            $data['message'] = "Can not this user update.";
                        }

                        echo json_encode($data);

                        break;
                    case "delete":
                        if (!is_blank($this->input->get_post('id'))) {
                            $user_del_id = $this->input->get_post('id');
                            $data_where = array('id' => $user_del_id);

                            $chk = $this->auth->delete_user($data_where);
                            if ($chk) {
                                $data['error'] = false;
                                $data['message'] = "Delete Success";
                            } else {
                                $data['error'] = true;
                                $data['message'] = "Can't delete user";

                            }

                        }

                        echo json_encode($data);

                        break;
                    default:
                        break;
                }

            } // End if
        }// End if


    }

    // action update user
    public function editUser()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('contact_no', 'Contact No', 'required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('dob', 'Date of Birth(DD-MM-YYYY)', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->edit();
        } else {
            $firstName = $this->input->post('first_name');
            $lastName = $this->input->post('last_name');
            $contactNo = $this->input->post('contact_no');
            $dob = $this->input->post('dob');
            $address = $this->input->post('address');
            $timeStamp = time();
            $sessionArray = $this->session->userdata('ci_seesion_key');
            $this->auth->setUserID($sessionArray['user_id']);
            $this->auth->setFirstName(trim($firstName));
            $this->auth->setLastName(trim($lastName));
            $this->auth->setContactNo($contactNo);
            $this->auth->setAddress($address);
            $this->auth->setDOB($dob);
            $this->auth->setTimeStamp($timeStamp);
            $status = $this->auth->update();
            if ($status == TRUE) {
                redirect('profile');
            }
        }
    }

    // action login method
    function doLogin()
    {
        // Check form  validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'User Name/Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
            $this->login();
        } else {
            $sessArray = array();
            //Field validation succeeded.  Validate against database
            $username = $this->input->post('user_name');
            $password = $this->input->post('password');

            $this->auth->setUserName($username);
            $this->auth->setPassword($password);
            //query the database
            $result = $this->auth->login();

            if (!empty($result) && count($result) > 0) {
                foreach ($result as $row) {
                    $authArray = array(
                        'user_id' => $row->user_id,
                        'user_name' => $row->user_name,
                        'email' => $row->email,
                        'name' => $row->name,
                        'lastname' => $row->lastname,
                        'user_role_id' => $row->user_role_id,
                        'cus_group_id' => $row->cus_group_id,
                        'cus_token' => $row->token,
                        'status' => $row->status
                    );


                    $this->session->set_userdata('ci_session_key_generate', TRUE);
                    $this->session->set_userdata('ci_seesion_key', $authArray);
                    $this->session->set_userdata('userSession', $authArray);
                }
                redirect('admin/dashboard');
            } else {
                redirect('signin?msg=1');
            }
        }
    }

    function jsonLogin()
    {
//        $username = "anon_de@sai-jo.co.th";
//        $password = "1234567";
        $username = "";
        $password = "";
        $result = array();

        if (!is_blank($this->input->get_post('user_name'))) {
            $username = trim($this->input->get_post('user_name'));
        }
        if (!is_blank($this->input->get_post('password'))) {
            $password = trim($this->input->get_post('password'));
        }

        $this->auth->setUserName($username);
        $this->auth->setPassword($password);
        //query the database
        $result = $this->auth->login();


        $data = array();
        $authArray = array();

        if (!empty($result) && count($result) > 0) {
            foreach ($result as $row) {
                $authArray = array(
                    'user_id' => $row->user_id,
                    'user_name' => $row->user_name,
                    'email' => $row->email,
                    'name' => $row->first_name,
                    'lastname' => $row->last_name,
                    'user_role_id' => $row->user_role_id,
                    'cus_group_id' => $row->cus_group_id,
                    'cus_token' => $row->token,
                    'status' => $row->status
                );

                $this->session->set_userdata('ci_session_key_generate', TRUE);
                $this->session->set_userdata('ci_seesion_key', $authArray);
                $this->session->set_userdata('userSession', $authArray);
            }


            $data['msg'] = "Login Success";
            $data['isLogin'] = true;

        } else {
            $data['error'] = true;
            $data['isLogin'] = false;
            $data['msg'] = "Login Fail";
        }


        echo json_encode($data);

    }

    public function actionChangePwd()
    {
        $this->form_validation->set_rules('change_pwd_password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('change_pwd_confirm_password', 'Password Confirmation', 'trim|required|matches[change_pwd_password]');
        if ($this->form_validation->run() == FALSE) {
            $this->changepwd();
        } else {
            $change_pwd_password = $this->input->post('change_pwd_password');
            $sessionArray = $this->session->userdata('ci_seesion_key');
            $this->auth->setUserID($sessionArray['user_id']);
            $this->auth->setPassword($change_pwd_password);
            $status = $this->auth->changePassword();
            if ($status == TRUE) {
                redirect('profile');
            }
        }
    }

    //action forgot password method
    public function actionForgotPassword()
    {
        $this->form_validation->set_rules('forgot_email', 'Your Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to Forgot Password page
            $this->forgotpassword();
        } else {
            $login = site_url() . 'signin';
            $email = $this->input->post('forgot_email');
            $this->auth->setEmail($email);
            $pass = $this->generateRandomPassword(8);
            $this->auth->setPassword($pass);
            $status = $this->auth->updateForgotPassword();
            if ($status == TRUE) {
                $this->load->library('encrypt');
                $mailData = array('topMsg' => 'Hi', 'bodyMsg' => 'Your password has been reset successfully!.', 'thanksMsg' => SITE_DELIMETER_MSG, 'delimeter' => SITE_DELIMETER, 'loginLink' => $login, 'pwd' => $pass, 'username' => $email);
                $this->mail->setMailTo($email);
                $this->mail->setMailFrom(MAIL_FROM);
                $this->mail->setMailSubject('Forgot Password!');
                $this->mail->setMailContent($mailData);
                $this->mail->setTemplateName('sendpwd');
                $this->mail->setTemplatePath('mailTemplate/');
                $chkStatus = $this->mail->sendMail(MAILING_SERVICE_PROVIDER);
                if ($chkStatus === TRUE) {
                    redirect('forgotpwd?msg=2');
                } else {
                    redirect('forgotpwd?msg=1');
                }
            } else {
                redirect('forgotpwd?msg=1');
            }
        }
    }

    //generate random password
    public function generateRandomPassword($length = 10)
    {
        $alphabets = range('a', 'z');
        $numbers = range('0', '9');
        $final_array = array_merge($alphabets, $numbers);
        $password = '';
        while ($length--) {
            $key = array_rand($final_array);
            $password .= $final_array[$key];
        }
        return $password;
    }

    //logout method
    public function logout()
    {
        $this->session->unset_userdata('ci_seesion_key');
        $this->session->unset_userdata('ci_session_key_generate');
        $this->session->unset_userdata('userSession');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('signin');
    }

}
