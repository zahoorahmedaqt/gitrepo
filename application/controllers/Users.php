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

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!isset($this->session->admin)) {
            redirect('/login/');
        }
        $content = $this->load->view('dashboard/users', array(), true);
        $this->load->model(array('usersModel'));
        $config['upload_path']   = './uploads/images/users/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = 200;
        $config['max_width']     = 2050;
        $config['max_height']    = 2050;
        $this->load->library('upload', $config);
    }

    public function index()
    {
        $data['title'] = $this->lang->line('users');
        // Deleting a user
        $getIdUser = $this->input->get('del', true);
        if(isset($getIdUser) && !$this->config->item('demo')) {
            $this->usersModel->delUser($getIdUser);
        }
        // Viewing Users
        $data['getUsers'] = $this->usersModel->getUsers();
        $content = $this->load->view('dashboard/users', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }

    public function add()
    {
        $data['title'] = $this->lang->line('users');
        // Processing the Add Form
        $postUsername = $this->input->post('username', true);
        $postEmail = $this->input->post('email', true);
        $postPassword = $this->input->post('password', true);
        $postStatus = $this->input->post('status', true);
        $postRole = $this->input->post('role', true);
        if(($postUsername) != '' && !$this->config->item('demo')) {
            $postURL = url_title(convert_accented_characters($postUsername), $separator = '-', $lowercase = true);
            $data['msg'] = $this->usersModel->addUser($postUsername, $postURL, $postEmail, $postPassword, $postStatus, $postRole);
        }
        $data['status'] = '1';
        $data['role'] = '0';
        $content = $this->load->view('dashboard/user_edit', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }

    public function edit($idUser = '')
    {
        $data['title'] = $this->lang->line('users');
        // Processing the Change Form
        $postUsername = $this->input->post('username', true);
        $postEmail = $this->input->post('email', true);
        $postStatus = $this->input->post('status', true);
        $postRole = $this->input->post('role', true);
        $postNewPassword = $this->input->post('newPassword', true);
        if(($postUsername) != '' && !$this->config->item('demo')) {
            $postURL = url_title(convert_accented_characters($postUsername), $separator = '-', $lowercase = true);
            $data['msg'] = $this->usersModel->editUser($idUser, $postUsername, $postURL, $postEmail, $postStatus, $postRole);
        }
        if(($postNewPassword) != '' && !$this->config->item('demo')) {
            $data['msg'] = $this->usersModel->editNewPassword($idUser, $postNewPassword);
        }
        // Processing the form for sending the image
        if(null !== $this->input->post('hiddenImage', true) && !$this->config->item('demo')) {
            if(!$this->upload->do_upload('userImage')) {
                $data['error'] = $this->upload->display_errors();
            } else {
                $data['msg'] = alert('The file was successfully sent');
                $this->usersModel->updateImage($idUser, $this->upload->data('file_name'));
            }
        }
        // Retrieving User Data
        $data = array_merge($data, $this->usersModel->getUser($idUser));
        $content = $this->load->view('dashboard/user_edit', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }
}
