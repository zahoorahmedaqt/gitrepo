<?php

class MyprofileModel extends CI_Model
{
    public function getUserData()
    {
        $sql = "SELECT id, username, email, role, image, facebook, twitter, google, linkedin, location, about, auth_coms FROM 2d_users WHERE id = ?";
        $query = $this->db->query($sql, array($this->session->id));
        if($result = $query->row()) {
            return array(
             'id'        => $result->id,
             'username'  => $result->username,
             'email'     => $result->email,
             'role'      => $result->role,
             'image'     => $result->image,
             'facebook'  => $result->facebook,
             'twitter'   => $result->twitter,
             'google'    => $result->google,
             'linkedin'  => $result->linkedin,
             'location'  => $result->location,
             'about'     => $result->about,
             'auth_coms' => $result->auth_coms
             );
        } else {
            show_404($page = '', $log_error = false);
        }
    }

    public function updateProfile($postUsername, $postEmail, $postLocation, $postAbout, $postFacebook, $postTwitter, $postGoogle, $postLinkedin, $postAuthComs)
    {
        $postUrl = url_title(convert_accented_characters($postUsername), $separator = '-', $lowercase = true);
        $sql = "SELECT id FROM 2d_users WHERE username = ?";
        $query = $this->db->query($sql, array($postUsername));
        if($result = $query->row()) {
            if($result->id === $this->session->id) {
                $sql = "SELECT id FROM 2d_users WHERE email = ?";
                $query = $this->db->query($sql, array($postEmail));
                if($result = $query->row()) {
                    if($result->id === $this->session->id) {
                        $sql = "UPDATE 2d_users SET location = ?, about = ?, facebook = ?, twitter = ?, google = ?, linkedin = ?, auth_coms = ? WHERE id = ?";
                        $this->db->query($sql, array(strip_tags(ucfirst($postLocation)), strip_tags($postAbout), $postFacebook, $postTwitter, $postGoogle, $postLinkedin, $postAuthComs, $this->session->id));
                        return alert('Saved changes');
                    } else {
                        return alert('This email is not available.', 'danger');
                    }
                } else {
                    $sql = "UPDATE 2d_users SET email = ?, location = ?, about = ?, facebook = ?, twitter = ?, google = ?, linkedin = ?, auth_coms = ? WHERE id = ?";
                    $this->db->query($sql, array(strip_tags(strtolower($postEmail)), strip_tags(ucfirst($postLocation)), strip_tags($postAbout), $postFacebook, $postTwitter, $postGoogle, $postLinkedin, $postAuthComs, $this->session->id));
                    return alert('Saved changes');
                }
            } else {
                return alert('This username is not available.', 'danger');
            }
        } else {
            $sql = "SELECT id FROM 2d_users WHERE email = ?";
            $query = $this->db->query($sql, array($postEmail));
            if($result = $query->row()) {
                if($result->id === $this->session->id) {
                    $sql = "UPDATE 2d_users SET username = ?, url = ?, location = ?, about = ?, facebook = ?, twitter = ?, google = ?, linkedin = ?, auth_coms = ? WHERE id = ?";
                    $this->db->query($sql, array(strip_tags(ucfirst($postUsername)), strip_tags($postUrl), strip_tags(ucfirst($postLocation)), strip_tags($postAbout), $postFacebook, $postTwitter, $postGoogle, $postLinkedin, $postAuthComs, $this->session->id));
                    return alert('Saved changes');
                } else {
                    return alert('This email is not available.', 'danger');
                }
            } else {
                $sql = "UPDATE 2d_users SET username = ?, url = ?, email = ?, location = ?, about = ?, facebook = ?, twitter = ?, google = ?, linkedin = ?, auth_coms = ? WHERE id = ?";
                $this->db->query($sql, array(strip_tags(ucfirst($postUsername)), strip_tags($postUrl), strip_tags(strtolower($postEmail)), strip_tags(ucfirst($postLocation)), strip_tags($postAbout), $postFacebook, $postTwitter, $postGoogle, $postLinkedin, $postAuthComs, $this->session->id));
                return alert('Saved changes');
            }
        }
    }

    public function updateImage($iduser, $imgUser = '')
    {
        $sql = "UPDATE 2d_users SET image = ? WHERE id = ?";
        $this->db->query($sql, array($imgUser, $iduser));
        $this->session->set_userdata('name_image', $imgUser);
    }
}
