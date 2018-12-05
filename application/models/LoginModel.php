<?php

class LoginModel extends CI_Model
{

    public function checkConnect($email, $password, $rememberme)
    {
        $sql = "SELECT id, url, username, image, role, status, passkey FROM 2d_users WHERE email = ? AND password = ?";
        $query = $this->db->query($sql, array($email, $password));
        if($row = $query->row()) {
            if($row->status) {
                $this->session->set_userdata('id', $row->id);
                $this->session->set_userdata('username', $row->username);
                $this->session->set_userdata('url', $row->url);
                if($row->image) {
                    $this->session->set_userdata('name_image', $row->image);
                }
                if($rememberme == true) {
                             $cookie = array(
                      'name'     => 'remember_me',
                      'value'    => "$email",
                      'expire'   => '99999999',
                      'httponly' => true
                                     );
                             $this->input->set_cookie($cookie);
                } else {
                    $cookie = array(
                      'name'     => 'remember_me',
                      'value'    => ''
                            );
                             $this->input->set_cookie($cookie);
                }
                if($row->role == 1) {
                    $this->session->set_userdata('admin', $row->role);
                    redirect(site_url('dashboard/'));
                } else {
                    redirect(site_url());
                }
            } else {
                return alert('Your account is awaiting validation. Please check your mailbox or <a href="/login/?send='.$email.'&key='.$row->passkey.'">click here</a> to receive it again.', 'warning');
            }
        } else {
            return alert('This email or password is not correct.', 'danger');
        }
    }

    public function addUser($email, $username, $password, $passkey)
    {
        $sql = "SELECT id FROM 2d_users WHERE email = ?";
        $query = $this->db->query($sql, array($email));
        if($row = $query->row()) {
            return alert('This email address is already used.', 'danger');
        } else {
            $sql = "SELECT id FROM 2d_users WHERE username = ?";
            $query = $this->db->query($sql, array($username));
            if($row = $query->row()) {
                return alert('This username is already used.', 'danger');
            } else {
                $sql = 'INSERT INTO 2d_users (url, username, email, password, passkey, role, status, date_inscription, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
                $this->db->query($sql, array(url_title(convert_accented_characters($username), $separator = '-', $lowercase = true), ucfirst($username), strtolower($email), $password, $passkey, 0, 0, date("Y-m-d H:i:s"), $this->input->ip_address()));
                return $this->sendConfirmation($email, $passkey);
            }
        }
    }

    public function sendConfirmation($email, $passkey)
    {
        $this->load->library('email');
        $this->email->from($this->config->item('emailsite'), $this->config->item('author'));
        $this->email->to($email);
        $this->email->subject($this->config->item('titleMailConfirmation'));
        $this->email->message(preg_replace("/%url%/", site_url('login/confirm/?mail='.$email.'&key='.$passkey), $this->config->item('mailConfirmation')));
        if($this->email->send()) {
            return alert('Please check your mailbox to activate your account.');
        } else {
            return alert('The email could not be sent. Please contact support.', 'danger');
        }
    }

    public function checkRecovery($email)
    {
        $sql = "SELECT passkey FROM 2d_users WHERE email = ?";
        $query = $this->db->query($sql, array($email));
        if($row = $query->row()) {
            $this->load->library('email');
            $this->email->from($this->config->item('emailsite'), $this->config->item('author'));
            $this->email->to($email);
            $this->email->subject($this->config->item('titleMailRecovery'));
            $this->email->message(preg_replace("/%url%/", site_url('login/changepass/?mail='.$email.'&key='.$row->passkey), $this->config->item('mailRecovery')));
            if($this->email->send()) {
                return alert('Your account recovery information has been sent by email.');
            } else {
                return alert('The email could not be sent. Please contact support.', 'danger');
            }
        } else {
            return alert('Your email address is not registered..', 'danger');
        }
    }

    public function changePassword($email, $passkey, $password)
    {
        $sql = "SELECT id FROM 2d_users WHERE email = ? AND passkey = ?";
        $query = $this->db->query($sql, array($email, $passkey));
        if($row = $query->row()) {
            $sql = "UPDATE 2d_users SET passkey = ?, password = ? WHERE id = ?";
            $this->db->query($sql, array(random(20), $password, $row->id));
            $this->load->library('email');
            $this->email->from($this->config->item('emailsite'), $this->config->item('author'));
            $this->email->to($email);
            $this->email->subject($this->config->item('titleMailPasswordChanged'));
            $this->email->message($this->config->item('mailPasswordChanged'));
            if($this->email->send()) {
                return alert('Your password has been changed.');
            } else {
                return alert('The email could not be sent. Please contact support.', 'danger');
            }
        } else {
            return alert('The operation did not work. The link is probably no longer valid. Thank you for making a new request.', 'danger');
        }
    }

    public function checkPasskey($email, $passkey)
    {
        $sql = "SELECT id FROM 2d_users WHERE email = ? AND passkey = ?";
        $query = $this->db->query($sql, array($email, $passkey));
        if($row = $query->row()) {
            $sql = "UPDATE 2d_users SET status = ?, passkey = ? WHERE id = ?";
            $this->db->query($sql, array(1, random(20), $row->id));
            $this->load->library('email');
            $this->email->from($this->config->item('emailsite'), $this->config->item('author'));
            $this->email->to($email);
            $this->email->subject($this->config->item('titleMailWelcome'));
            $this->email->message($this->config->item('mailWelcome'));
            if($this->email->send()) {
                return alert('Your account has been validated.');
            } else {
                return alert('The email could not be sent. Please contact support.', 'danger');
            }
        } else {
            return alert('Your account could not be validated.', 'danger');
        }
    }

}
