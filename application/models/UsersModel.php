<?php

class UsersModel extends CI_Model
{

    public function getUsers() 
    {
        $getUsers = '';
        $sql = "SELECT id, username, url, email, role, status, date_inscription, ip FROM 2d_users";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $status = ($row->status === '1') ? '<span class="label label-table label-success">Active</span>' : '<span class="label label-table label-inverse">Inactive</span>';
            $role = ($row->role === '1') ? '<span class="label label-table label-default">Administrator</span>' : '<span class="label label-table label-success">Member</span>';
            $date_inscription = date_parse($row->date_inscription);
            $date_inscription = $date_inscription['day'].'/'.$date_inscription['month'].'/'.$date_inscription['year'];
            $getUsers .= 
             '<tr class="text-center">
					<td>'.$row->id.'</td>
					<td>'.$row->username.'</td>
					<td>'.$row->email.'</td>
					<td>'.$role.'</td>
					<td>'.$status.'</td>
					<td>'.$date_inscription.'</td>
					<td>'.$row->ip.'</td>
					<td>
						<a class="btn btn-icon waves-effect btn-primary waves-light btn-xs" href="'.site_url('user/'.$row->url.'/').'""> <i class="fa fa-search"></i> </a>
						<a class="btn btn-icon waves-effect btn-default waves-light btn-xs" href="'.site_url('dashboard/users/edit/'.$row->id.'/').'"><i class="fa fa-pencil"></i></a>
						<a class="btn btn-icon waves-effect btn-danger waves-light btn-xs" href="'.site_url('dashboard/users/?del='.$row->id.'').'"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>';
        }
        return $getUsers;
    }

    public function getUser($idGame) 
    {
        $sql = "SELECT username, email, role, status, image FROM 2d_users WHERE id = ?";
        $query = $this->db->query($sql, array($idGame));
        if($result = $query->row()) {
            return array(
             'username'   => $result->username,
             'email'      => $result->email,
             'role'       => $result->role,
             'status'     => $result->status,
             'name_image' => $result->image
             );
        } else {
            return null;
        }
    }

    public function addUser($postUsername, $postURL, $postEmail, $postPassword, $postStatus, $postRole) 
    {
        $sql = "SELECT id FROM 2d_users WHERE username = ?";
        $query = $this->db->query($sql, array($postUsername));
        if($row = $query->row()) {
            return alert('This username is already used.', 'danger');
        } else {
            $sql = "SELECT id FROM 2d_users WHERE email = ?";
            $query = $this->db->query($sql, array($postEmail));
            if($row = $query->row()) {
                return alert('This email address is already used.', 'danger');
            } else {
                $sql = "INSERT INTO 2d_users (username, url, email, password, passkey, status, role, date_inscription, ip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $this->db->query($sql, array($postUsername, $postURL, $postEmail, $postPassword, random(20), $postStatus, $postRole, date("Y-m-d H:i:s"), $this->input->ip_address()));
                return alert('The user was created. <a href="/dashboard/users/edit/'.$this->db->insert_id().'">Edit it</a> now !');
            }
        }
    }

    public function editUser($idUser, $postUsername, $postURL, $postEmail, $postStatus, $postRole) 
    {
        $sql = "SELECT username, email FROM 2d_users WHERE username = ? OR email = ?";
        $query = $this->db->query($sql, array($postUsername, $postEmail));
        if($result = $query->row()) {
            if($result->username === $postUsername && $result->email !== $postEmail) {
                $sql = "SELECT id FROM 2d_users WHERE email = ?";
                $query = $this->db->query($sql, array($postEmail));
                if($result = $query->row()) {
                    $msg = alert('This email is not available.', 'danger');
                } else {
                    $sql = "UPDATE 2d_users SET email = ?, status = ?, role = ? WHERE id = ?";
                    $this->db->query($sql, array($postEmail, $postStatus, $postRole, $idUser));
                    $msg = alert('Saved changes');
                }
            } elseif($result->email === $postEmail && $result->username !== $postUsername) {
                $sql = "SELECT id FROM 2d_users WHERE username = ?";
                $query = $this->db->query($sql, array($postUsername));
                if($result = $query->row()) {
                    $msg = alert('This username is not available.', 'danger');
                } else {
                    $sql = "UPDATE 2d_users SET username = ?, url = ?, status = ?, role = ? WHERE id = ?";
                    $this->db->query($sql, array($postUsername, $postURL, $postStatus, $postRole, $idUser));
                    $msg = alert('Saved changes');
                }
            } else {
                $sql = "UPDATE 2d_users SET status = ?, role = ? WHERE id = ?";
                $this->db->query($sql, array($postStatus, $postRole, $idUser));
                $msg = alert('Saved changes');
            }
        } else {
            $sql = "UPDATE 2d_users SET username = ?, url = ?, email = ?, status = ?, role = ? WHERE id = ?";
            $this->db->query($sql, array($postUsername, $postURL, $postEmail, $postStatus, $postRole, $idUser));
            $msg = alert('Saved changes');
        }
        return $msg;
    }

    public function editNewPassword($idUser, $postNewPassword) 
    {
        $sql = "UPDATE 2d_users SET password = ? WHERE id = ?";
        $this->db->query($sql, array($postNewPassword, $idUser));
        $msg = alert('Saved changes');
        return $msg;
    }

    public function updateImage($idUser, $imgUser) 
    {
        $sql = "UPDATE 2d_users SET image = ? WHERE id = ?";
        $this->db->query($sql, array($imgUser, $idUser));
    }

    public function delUser($IdUser) 
    {
        // Removing image's profile related to the user
        $sql = "SELECT image FROM 2d_users WHERE id = ?";
        $query = $this->db->query($sql, array($IdUser));
        if(!empty($result->image)) {
            $file = 'uploads/images/users/'.$result->image;
            if(is_readable($file)) {
                unlink($file);
            }
        }
        // Removing comments related to the user
        $sql = 'DELETE FROM 2d_comments WHERE id_user = ?';
        $this->db->query($sql, array($IdUser));
        // Removing profile's comments related to the user
        $sql = 'DELETE FROM 2d_profiles_comments WHERE id_user_member = ?';
        $this->db->query($sql, array($IdUser));
        // Removing favorites related to the user
        $sql = 'DELETE FROM 2d_favorites WHERE id_user = ?';
        $this->db->query($sql, array($IdUser));
        // Removing notes related to the user
        $sql = 'DELETE FROM 2d_notes WHERE id_user = ?';
        $this->db->query($sql, array($IdUser));
        // Removing the user
        $sql = 'DELETE FROM 2d_users WHERE id = ?';
        $this->db->query($sql, array($IdUser));
    }

}
