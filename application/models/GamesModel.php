<?php

class GamesModel extends CI_Model
{

    public function getGames() 
    {
        $getGames = '';
        $sql = "SELECT ga.id AS id, ga.title AS title, ga.url AS url, ga.played AS played, ga.status AS status, ga.date_upload AS date_upload, ca.title AS title_category FROM 2d_games ga, 2d_categories ca WHERE ga.id_category = ca.id";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $status = ($row->status === '1') ? '<span class="label label-table label-success">Active</span>' : '<span class="label label-table label-inverse">Inactive</span>';
            $date_upload = date_parse($row->date_upload);
            $date_upload = $date_upload['day'].'/'.$date_upload['month'].'/'.$date_upload['year'];
            $getGames .= 
             '<tr class="text-center">
					<td>'.$row->id.'</td>
					<td>'.$row->title.'</td>
					<td>'.$row->title_category.'</td>
					<td>'.$row->played.'</td>
					<td>'.$status.'</td>
					<td>'.$date_upload.'</td>
					<td>
						<a class="btn btn-icon waves-effect btn-primary waves-light btn-xs" href="'.site_url('game/show/'.$row->url.'/').'"> <i class="fa fa-search"></i> </a>
						<a class="btn btn-icon waves-effect btn-default waves-light btn-xs" href="'.site_url('dashboard/games/edit/'.$row->id.'/').'"><i class="fa fa-pencil"></i></a>
						<a class="btn btn-icon waves-effect btn-danger waves-light btn-xs" href="'.site_url('dashboard/games/?del='.$row->id.'').'"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>';
        }
        return $getGames;
    }

    public function getCategories($idCategory = '') 
    {
        $getCategories = '';
        $sql = "SELECT id, title FROM 2d_categories";
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $select = ($idCategory === $row->id) ? 'selected' : '';
                $getCategories .= '<option value="'.$row->id.'" '.$select.'>'.$row->title.'</option>';
            }
        } else {
            redirect('/dashboard/categories/add/?cat=FALSE');
        }
        return $getCategories;
    }

    public function getKeywords($idGame)
    {
        $sql = "SELECT ids_keywords FROM 2d_games WHERE id = ?";
        $query = $this->db->query($sql, array($idGame));
        if($result = $query->row()) {
            $ids_keywords = explode(',', $result->ids_keywords);
        } else {
            $ids_keywords = array();
        }
        $sql = "SELECT id, title FROM 2d_keywords";
        $query = $this->db->query($sql);
        $getKeywords = '';
        foreach ($query->result() as $row) {
            $select = (in_array($row->id, $ids_keywords)) ? 'selected' : '';
            $getKeywords .= '<option value="'.$row->id.'" '.$select.'>'.$row->title.'</option>';
        }
        return $getKeywords;
    }

    public function getGame($idGame) 
    {
        $sql = "SELECT ga.title AS title, ga.url AS url, ga.description AS description, ga.type AS type, ga.console AS console, ga.embed AS embed, ga.status AS status, ga.image AS image, ga.file AS file, ca.title AS category, ca.id AS id_category FROM 2d_games ga, 2d_categories ca WHERE ((ga.id = ?) AND (ga.id_category = ca.id))";
        $query = $this->db->query($sql, array($idGame));
        if($result = $query->row()) {
            return array(
             'title_game'       => $result->title,
             'url_game'         => $result->url,
             'description_game' => $result->description,
             'id_category'      => $result->id_category,
             'category_game'    => $result->category,
             'type_game'        => $result->type,
             'console'          => $result->console,
             'embed_url'        => $result->embed,
             'status_game'      => $result->status,
             'image'            => $result->image,
             'file'             => $result->file
             );
        } else {
            return null;
        }
    }

    public function addGame($postTitle, $postURL, $postDescription, $postIdCategory, $postStatus) 
    {
        $sql = "SELECT title, url FROM 2d_games WHERE title = ? OR url = ?";
        $query = $this->db->query($sql, array($postTitle, $postURL));
        if($query->num_rows() > 0) {
            $msg = alert('The game already exists', 'danger');
        } else {
            $sql = "INSERT INTO 2d_games (title, url, description, id_category, status, date_upload) VALUES (?, ?, ?, ?, ?, ?)";
            $this->db->query($sql, array($postTitle, $postURL, $postDescription, $postIdCategory, $postStatus, date("Y-m-d H:i:s")));
            $msg = alert('The game was created. <a href="/dashboard/games/edit/'.$this->db->insert_id().'">Edit it</a> now !');
        }
        return $msg;
    }

    public function editGame($idGame, $postTitle, $postURL, $postDescription, $postIdCategory, $postKeywords, $postType, $postEmbed, $postConsole, $postStatus) 
    {
        $sql = "SELECT title, url FROM 2d_games WHERE title = ? OR url = ?";
        $query = $this->db->query($sql, array($postTitle, $postURL));
        if($result = $query->row()) {
            if($result->title === $postTitle) {
                $sql = "UPDATE 2d_games SET url = ?, description = ?, id_category = ?, ids_keywords = ?, type = ?, embed = ?, console = ?, status = ? WHERE id = ?";
                $this->db->query($sql, array($postURL, $postDescription, $postIdCategory, $postKeywords, $postType, $postEmbed, $postConsole, $postStatus, $idGame));
                $msg = alert('Saved changes');
            } elseif($result->url === $postURL) {
                $sql = "UPDATE 2d_games SET title = ?, description = ?, id_category = ?, ids_keywords = ?, type = ?, embed = ?, console = ?, status = ? WHERE id = ?";
                $this->db->query($sql, array($postTitle, $postDescription, $postIdCategory, $postKeywords, $postType, $postEmbed, $postConsole, $postStatus, $idGame));
                $msg = alert('Saved changes');
            }
        } else {
            $sql = "UPDATE 2d_games SET title = ?, url = ?, description = ?, id_category = ?, ids_keywords = ?, type = ?, embed = ?, console = ?, status = ? WHERE id = ?";
            $this->db->query($sql, array($postTitle, $postURL, $postDescription, $postIdCategory, $postKeywords, $postType, $postEmbed, $postConsole, $postStatus, $idGame));
            $msg = alert('Saved changes');
        }
        return $msg;
    }

    public function updateImage($idGame, $imgGame) 
    {
        $sql = "UPDATE 2d_games SET image = ? WHERE id = ?";
        $this->db->query($sql, array($imgGame, $idGame));
    }

    public function updateFile($idGame, $fileGame) 
    {
        $sql = "UPDATE 2d_games SET file = ? WHERE id = ?";
        $this->db->query($sql, array($fileGame, $idGame));
    }

    public function delGame($idGame) 
    {
        // Removing image and swf related to the game
        $sql = "SELECT image, file FROM 2d_games WHERE id = ?";
        $query = $this->db->query($sql, array($idGame));
        if($result = $query->row()) {
            if(!empty($result->image)) {
                $file = 'uploads/images/games/'.$result->image;
                if(is_readable($file)) {
                    unlink($file);
                }
            }
            if(!empty($result->file)) {
                $file = 'uploads/files/games/'.$result->file;
                if(is_readable($file)) {
                    unlink($file);
                }
            }
        }
        // Removing comments related to the game
        $sql = 'DELETE FROM 2d_comments WHERE id_game = ?';
        $this->db->query($sql, array($idGame));
        // Removing favorites related to the game
        $sql = 'DELETE FROM 2d_favorites WHERE id_game = ?';
        $this->db->query($sql, array($idGame));
        // Removing notes related to the game
        $sql = 'DELETE FROM 2d_notes WHERE id_game = ?';
        $this->db->query($sql, array($idGame));
        // Removing the game
        $sql = 'DELETE FROM 2d_games WHERE id = ?';
        $this->db->query($sql, array($idGame));
    }

}
