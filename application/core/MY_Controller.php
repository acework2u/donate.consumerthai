<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{


    public $view_page;




    function __construct()
    {
        parent::__construct();

        $this->view_page="";


    }

    //create custom Controller
    function page_construct($page, $meta = array(), $data = array())
    {
        $meta['message'] = isset($data['message']) ? $data['message'] : $this->session->flashdata('message');
        $meta['error'] = isset($data['error']) ? $data['error'] : $this->session->flashdata('error');
        $meta['warning'] = isset($data['warning']) ? $data['warning'] : $this->session->flashdata('warning');
        $meta['info'] = $this->site->getNotifications();
        $this->load->view('include_header', $meta);
        $this->load->view($page, $data);
        $this->load->view('include_footer', $data);
    }

    public function getUserSession()
    {
        $userSession = $this->session->userdata('userSession');
        return $userSession;
    }

    public function getSessionUserAid()
    {
        $obj = $this->getUserSession();
        return get_array_value($obj, "user_id", "");
    }

    function getSessionUserRoleAid()
    {
        $obj = $this->getUserSession();
        return get_array_value($obj, "user_role_id", "");
    }

    public function is_login()
    {
        $user_aid = $this->getSessionUserAid();
        if ($user_aid != "") {
            return true;
        } else {
            return false;
        }

    }



    public function resizeImage($filename)
    {
        $source_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $filename;
        $target_path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/thumbnail/';
        $config_manip = array(
            'image_library' => 'gd2',
            'source_image' => $source_path,
            'new_image' => $target_path,
            'maintain_ratio' => TRUE,
            'create_thumb' => TRUE,
            'thumb_marker' => '',
            'width' => 1100,
            'height' => 617
        );


        $this->load->library('image_lib', $config_manip);
        if (!$this->image_lib->resize()) {
            return $this->image_lib->display_errors();
        } else {

        }

        $this->image_lib->clear();
    }

    public function do_upload_file()
    {

        $config['upload_path'] = 'uploads';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1024';
        $config['overwrite'] = TRUE;
//        $config['max_width'] = '1024';
//        $config['max_height'] = '574';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $data = array();

        if (!$this->upload->do_upload('userfile')) {

            $data = array('upload_data' => $this->upload->data(), 'error' => $this->upload->display_errors());
//            $this->load->view('test', $data);

            return $data;

        } else {

            $uploadedImage = $this->upload->data();
            $this->resizeImage($uploadedImage['file_name']);

            $data = array('upload_data' => $this->upload->data(), 'error' => $this->upload->display_errors());
            return $data;
        }


    }


}
