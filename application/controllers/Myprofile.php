<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Coffee Theme
*
* PHP version >= 5.4
*
* @category  PHP
* @package   Flashgames - PHP Script
* @author    Nicolas Grimonpont <support@coffeetheme.com>
* @copyright 2010-2017 Nicolas Grimonpont
* @license   Standard License
* @link      http://coffeetheme.com/
*/

class Myprofile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!isset($this->session->id)) {
            redirect('/login/');
        }
        $data['title'] = 'Profile settings - '.$this->config->item('sitename');
        $data['getCategories'] = $this->autoloadModel->getCategories();
        $data['getFooter'] = $this->autoloadModel->getFooter();
        $content = $this->load->view('front/template', $data, true);
        $this->load->model(array('myprofileModel'));
    }

    public function index()
    {
        // Get user's datas
        $data = $this->myprofileModel->getUserData();
        // Processing the profile setting form
        $postUsername = $this->input->post('username', true);
        $postEmail = $this->input->post('email', true);
        $postEmail = filter_var($postEmail, FILTER_VALIDATE_EMAIL);
        $postLocation = $this->input->post('location', true);
        $postAbout = $this->input->post('about', true);
        $postFacebook = $this->input->post('facebook', true);
        $postTwitter = $this->input->post('twitter', true);
        $postGoogle = $this->input->post('google', true);
        $postLinkedin = $this->input->post('linkedin', true);
        $postAuthComs = $this->input->post('auth_coms', true);
        // Verification of urls
        $postFacebook = checkUrl($postFacebook, 'www.facebook.com');
        $postTwitter = checkUrl($postTwitter, 'www.twitter.com');
        $postGoogle = checkUrl($postGoogle, 'plus.google.com');
        $postLinkedin = checkUrl($postLinkedin, 'www.linkedin.com');
        if($postUsername && !$this->config->item('demo') || $postUsername && $data['role'] === '0') {
            $data['msg'] = $this->myprofileModel->updateProfile($postUsername, $postEmail, $postLocation, $postAbout, $postFacebook, $postTwitter, $postGoogle, $postLinkedin, $postAuthComs);
        }
        // Processing the form for sending the image
        if(null !== $this->input->post('submit', true) && !$this->config->item('demo') || null !== $this->input->post('submit', true) && $data['role'] === '0') {
            $config['upload_path']   = './uploads/images/users/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']      = 1000;
            $config['max_width']     = 2048;
            $config['max_height']    = 1536;
            $this->load->library('upload', $config);
            if(!$this->upload->do_upload('userImage')) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $data['msg'] = alert('The file was successfully sent');
                $this->myprofileModel->updateImage($data['id'], $this->upload->data('file_name'));
                // Deleting the old image
                if(!empty($data['image'])) {
                    $file = 'uploads/images/users/'.$data['image'];
                    if(is_readable($file)) {
                        unlink($file);
                    }
                }
            }
        }
        // Processing the form for deleting the image
        if(null !== $this->input->post('delete', true) && !$this->config->item('demo') || null !== $this->input->post('delete', true) && $data['role'] === '0') {
            if(!empty($data['image'])) {
                $this->myprofileModel->updateImage($data['id']);
                $this->session->unset_userdata('name_image');
                $file = 'uploads/images/users/'.$data['image'];
                if(is_readable($file) && unlink($file)) {
                    $data['msg'] = alert('The file has been deleted successfully.');
                }
            } else {
                $data['msg'] = alert('No files to delete.', 'danger');
            }
        }
        // Refresh user's datas with the new content
        $data = array_merge($data, $data = $this->myprofileModel->getUserData());
        $content = $this->load->view('front/myprofile', $data, true);
        $this->load->view('front/template', array('content' => $content));
    }
}
