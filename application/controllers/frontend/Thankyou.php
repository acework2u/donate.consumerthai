<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Thankyou extends MY_Controller{


    public function __construct()
    {
        parent::__construct();

        $this->load->library('SocialMedia');
        $socmed = new SocialMedia();
        $image = base_url('assets/img/fb-icon.png');
        $social_media_name = $socmed->GetSocialMediaSites_WithShareLinks_OrderedByPopularity();
        $myScial = array('url' => 'https://donate.consumerthai.org/', 'title' => 'Foundation for Consumers','image'=>$image);
        $social_media_urls = $socmed->GetSocialMediaSiteLinks_WithShareLinks($myScial);

        $this->data['media_name'] = $social_media_name;
        $this->data['media_urls'] = $social_media_urls;
    }


    public function index(){
        $this->load->view('tpl_thankyou',$this->data);

    }

} //end of Class
