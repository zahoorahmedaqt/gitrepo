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

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $data['title'] = 'Login - '.$this->config->item('sitename');
        $this->input->cookie('remember_me', true);
        $content = $this->load->view('front/login', $data, true);
        $this->load->model(array('loginModel'));
    }

    public function index()
    {
        $data = '';
        $email = $this->input->post('email', true);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $password = $this->input->post('password', true);
        $rememberme = $this->input->post('rememberme', true);
        if(isset($email) && isset($password)) {
            $data['msg'] = $this->loginModel->checkConnect($email, $password, $rememberme);
        }
        $send = $this->input->get('send', true);
        $key = $this->input->get('key', true);
        if(isset($send) && isset($key)) {
            $data['msg'] = $this->loginModel->sendConfirmation($send, $key);
        }
        $data['rememberMe'] = $this->input->cookie('remember_me', true);
        $content = $this->load->view('front/login', $data, true);
        $this->load->view('landing', array('content' => $content));
    }

    public function register()
    {
        $data['title'] = 'Registration - '.$this->config->item('sitename');
        $email = $this->input->post('email', true);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);
        $conditions = $this->input->post('conditions', true);

        if(isset($email) && isset($username) && isset($password)) {
            if(isset($conditions)) {
                $data['msg'] = $this->loginModel->addUser($email, $username, $password, random(20));
            } else {
                $data['msg'] = alert('You must accept the terms of use.', 'danger');
            }
        }

        $content = $this->load->view('front/register', $data, true);
        $this->load->view('landing', array('content' => $content));
    }

    public function recovery()
    {
        $data['msg'] = 'Password recovery - '.$this->config->item('sitename');
        $email = $this->input->post('email', true);
        if(isset($email)) {
            $data['msg'] = $this->loginModel->checkRecovery($email);
        } else {
            $data['msg'] = $this->lang->line('msgEnterYourEmail');
        }
        $content = $this->load->view('front/recovery', $data, true);
        $this->load->view('landing', array('content' => $content));
    }

    public function changepass()
    {
        $email = $this->input->get('mail', true);
        $passkey = $this->input->get('key', true);
        $password = $this->input->post('password', true);
        $confirm = $this->input->post('confirm', true);
        if($password === $confirm) {
            if(isset($email) && isset($passkey) && isset($password)) {
                $data['msg'] = $this->loginModel->changePassword($email, $passkey, $password);
            }
        } else {
            $data['msg'] = alert('Please enter the same password for both fields.', 'danger');
        }
        $data['email'] = $email;
        $data['passkey'] = $passkey;
        $content = $this->load->view('front/newpassword', $data, true);
        $this->load->view('landing', array('content' => $content));
    }

    public function confirm()
    {
        $email = $this->input->get('mail', true);
        $passkey = $this->input->get('key', true);
        if(isset($email) && isset($passkey)) {
            $data['msg'] = $this->loginModel->checkPasskey($email, $passkey);
        } else {
            $data['msg'] = '';
        }
        $content = $this->load->view('front/login', $data, true);
        $this->load->view('landing', array('content' => $content));
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->load->library('user_agent');
        redirect($this->agent->referrer(), 'refresh');
    }
}
