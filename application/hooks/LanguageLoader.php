<?php
class LanguageLoader

{

    function initialize() {

        $ci =& get_instance();

        $ci->load->helper('language');

        $siteLang = $ci->session->userdata('site_lang');

        if ($siteLang) {

            $ci->lang->load('information',$siteLang);
            $ci->lang->load('menu',$siteLang);

        } else {

            $ci->lang->load('information','english');
            $ci->lang->load('menu','english');

        }

    }

}
