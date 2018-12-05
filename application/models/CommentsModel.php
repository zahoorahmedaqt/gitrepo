<?php

class CommentsModel extends CI_Model
{

    public function getComments() 
    {
        $getComments = '';
        $sql = "SELECT co.id AS id, co.comment AS comment, co.id_game AS id_game, co.date_creation AS date_creation, co.ip AS ip, us.id AS id_user, us.username AS username, ga.title AS title, ga.url AS url FROM 2d_comments co, 2d_users us, 2d_games ga WHERE co.id_user = us.id AND co.id_game = ga.id";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $uploaded = timespan(strtotime($row->date_creation), time(), 1);
            $getComments .= 
             '<tr class="text-center">
					<td>'.$row->id.'</td>
					<td>'.$row->username.'</td>
					<td>'.$row->comment.'</td>
					<td>'.$row->title.'</td>
					<td>'.$uploaded.'</td>
					<td>'.$row->ip.'</td>
					<td>
						<a class="btn btn-icon waves-effect btn-primary waves-light btn-xs" href="'.site_url('game/show/'.$row->url.'/').'"><i class="fa fa-search"></i> </a>
						<a class="btn btn-icon waves-effect btn-default waves-light btn-xs" href="'.site_url('dashboard/comments/edit/'.$row->id.'/').'"><i class="fa fa-pencil"></i></a>
						<a class="btn btn-icon waves-effect btn-danger waves-light btn-xs" href="'.site_url('dashboard/comments/?del='.$row->id.'&id='.$row->id_user).'"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>';
        }
        return $getComments;
    }

    public function getUsers($idUser = '') 
    {
        $getUsers = '';
        $sql = "SELECT id, username FROM 2d_users";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $select = ($idUser === $row->id) ? 'selected' : '';
            $getUsers .= '<option value="'.$row->id.'" '.$select.'>'.$row->username.'</option>';
        }
        return $getUsers;
    }

    public function getGames($idGame = '') 
    {
        $getGames = '';
        $sql = "SELECT id, title FROM 2d_games";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $select = ($idGame === $row->id) ? 'selected' : '';
            $getGames .= '<option value="'.$row->id.'" '.$select.'>'.$row->title.'</option>';
        }
        return $getGames;
    }

    public function getComment($idComment) 
    {
        $sql = "SELECT comment, id_user, id_game FROM 2d_comments WHERE id = ?";
        $query = $this->db->query($sql, array($idComment));
        if($result = $query->row()) {
            return array(
             'comment' => $result->comment,
             'id_game' => $result->id_game,
             'id_user' => $result->id_user
             );
        } else {
            return null;
        }
    }

    public function addComment($postAuthor, $postComment, $postGame) 
    {        
        $sql = "INSERT INTO 2d_comments (id_user, comment, id_game, date_creation, ip) VALUES (?, ?, ?, ?, ?)";
        $this->db->query($sql, array($postAuthor, $postComment, $postGame, date("Y-m-d H:i:s"), $this->input->ip_address()));
        $this->updateComs($postAuthor);
        $msg = alert('The comment was created. <a href="/dashboard/comments/edit/'.$this->db->insert_id().'">Edit it</a> now !');
        return $msg;
    }

    public function editComment($idComment, $postAuthor, $postComment, $postGame) 
    {
        $sql = "UPDATE 2d_comments SET id_user = ?, comment = ?, id_game = ? WHERE id = ?";
        $this->db->query($sql, array($postAuthor, $postComment, $postGame, $idComment));
        $msg = alert('Saved changes');
        return $msg;
    }

    public function delComment($idComment, $idUser)
    {
        $sql = 'DELETE FROM 2d_comments WHERE id = ?';
        $this->db->query($sql, array($idComment));
        $this->updateComs($idUser);
    }

    public function updateComs($idUser)
    {
        $sql = 'SELECT id FROM 2d_comments WHERE id_user = ?';
        $query = $this->db->query($sql, array($idUser));
        $sql = "UPDATE 2d_users SET nb_coms = ? WHERE id = ?";
        $this->db->query($sql, array($query->num_rows(), $idUser));
    }

}
