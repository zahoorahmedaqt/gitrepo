<?php

class UserModel extends CI_Model
{

    function getUserData($url)
    {
        $sql = "SELECT id, url, username, image, facebook, twitter, google, linkedin, location, about, nb_notes, nb_favs, nb_coms, auth_coms FROM 2d_users WHERE url = ?";
        $query = $this->db->query($sql, array($url));
        if($result = $query->row()) {
            return array(
             'id'        => $result->id,
             'url'       => $result->url,
             'username'  => $result->username,
             'image'     => $result->image,
             'facebook'  => $result->facebook,
             'twitter'   => $result->twitter,
             'google'    => $result->google,
             'linkedin'  => $result->linkedin,
             'location'  => $result->location,
             'about'     => $result->about,
             'nb_notes'  => $result->nb_notes,
             'nb_favs'   => $result->nb_favs,
             'nb_coms'   => $result->nb_coms,
             'auth_coms' => $result->auth_coms
             );
        } else {
            show_404($page = '', $log_error = false);
        }
    }

    public function getFavsGames($userId, $getPag = 0, $limit = 16)
    {
        $sql = "SELECT ga.id AS id FROM 2d_favorites fa, 2d_games ga WHERE ((fa.id_user = ?) AND (fa.id_game = ga.id))";
        $query = $this->db->query($sql, array($userId));
        $nbRows = $query->num_rows();
        $sql = "SELECT ga.title AS title, ga.image AS image, ga.url AS url FROM 2d_favorites fa, 2d_games ga WHERE ((fa.id_user = ?) AND (fa.id_game = ga.id)) LIMIT ?, ?";
        $query = $this->db->query($sql, array($userId, (int)$getPag, (int)$limit));
        $getFavsGames = '';
        foreach ($query->result() as $row) {
            $getFavsGames .= '<a href="'.site_url('game/show/'.$row->url.'/').'">
								<img src="'.(empty($row->image) ? site_url('assets/images/default_swf.jpg') : $row->image).'" class="thumb-xl img-thumbnail m-t-5 m-r-5">
							</a>';
        }
        return array(
         'getFavsGames' => $getFavsGames,
         'nbRows' => $nbRows
         );
    }

    public function getNotesGames($userId, $getPag = 0, $limit = 10)
    {

        $sql = "SELECT ga.id AS id FROM 2d_games ga, 2d_notes no WHERE ((no.id_user = ?) AND (no.id_game = ga.id))";
        $query = $this->db->query($sql, array($userId));
        $nbRows = $query->num_rows();
        $sql = "SELECT ga.title AS title, no.note AS note FROM 2d_games ga, 2d_notes no WHERE ((no.id_user = ?) AND (no.id_game = ga.id)) ORDER BY note DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($userId, (int)$getPag, (int)$limit));
        $getNotesGames = '';
        foreach ($query->result() as $row) {
            $getNotesGames .= '<tr>
								<td>'.$row->title.'</td>
								<td>'.rating($row->note, $class = '').'</td>
							</tr>';
        }
        return array(
         'getNotesGames' => $getNotesGames,
         'nbRows' => $nbRows
         );
    }

    public function getComsGames($userId, $getPag = 0, $limit = 5)
    {

        $sql = "SELECT us.id AS id FROM 2d_users us, 2d_comments co, 2d_games ga WHERE ((co.id_user = ?) AND (co.id_user = us.id) AND (co.id_game = ga.id))";
        $query = $this->db->query($sql, array($userId));
        $nbRows = $query->num_rows();
        $sql = "SELECT us.username AS username, us.image AS image, us.url AS userUrl, co.id AS id, co.comment AS comment, co.date_creation AS date_creation, ga.title AS title, ga.url AS gameUrl FROM 2d_users us, 2d_comments co, 2d_games ga WHERE ((co.id_user = ?) AND (co.id_user = us.id) AND (co.id_game = ga.id)) ORDER BY date_creation DESC LIMIT ?, ?";
        $query = $this->db->query($sql, array($userId, (int)$getPag, (int)$limit));
        $getComsGames = '';
        foreach ($query->result() as $row) {
            $time = timespan(strtotime($row->date_creation), time(), 1);
            $getComsGames .= '<div class="comment">
								<img src="'.(empty($row->image) ? site_url('assets/images/default-user.png') : site_url('uploads/images/users/'.$row->image)).'" alt="'.$row->username.'" class="comment-avatar">
								<div class="comment-body">
									<div class="comment-text">
										<div class="comment-header">
											<a href="'.site_url('user/'.$row->userUrl.'/').'" title="'.$row->username.'">'.$row->username.'</a><span>on</span> <a href="'.site_url('game/show/'.$row->gameUrl.'/').'" title="'.$row->title.'">'.$row->title.'</a><span>about '.$time.' ago</span>
										</div>
										'.$row->comment.'
									</div>
									'.(($userId === $this->session->id) ? '<a href="'.current_url().'/?del='.$row->id.'"><i class="fa fa-remove text-danger fl-right"></i></a>' : '').'
								</div>
							</div>';
        }
        return array(
         'getComsGames' => $getComsGames,
         'nbRows' => $nbRows
         );
    }

    public function addCom($userId, $postCom)
    {
        $sql = 'INSERT INTO 2d_profiles_comments (comment, id_user_page, id_user_member, date_creation, ip) VALUES (?, ?, ?, ?, ?)';
        $this->db->query($sql, array(strip_tags($postCom), $userId, $this->session->id, date("Y-m-d H:i:s"), $this->input->ip_address()));
    }

    public function delCom($idCom, $idUser)
    {
        $sql = 'SELECT id FROM 2d_comments WHERE id = ? AND id_user = ?';
        $query = $this->db->query($sql, array($idCom, $idUser));
        if($result = $query->row()) {
            $sql = 'DELETE FROM 2d_comments WHERE id = ?';
            $this->db->query($sql, array($result->id));
            $this->updateComs($idUser);
        }
    }

    public function updateComs($idUser)
    {
        $sql = 'SELECT id FROM 2d_comments WHERE id_user = ?';
        $query = $this->db->query($sql, array($idUser));
        $sql = "UPDATE 2d_users SET nb_coms = ? WHERE id = ?";
        $this->db->query($sql, array($query->num_rows(), $idUser));
    }

    public function getComsProfile($userId)
    {
        $sql = "SELECT co.comment AS comment, co.date_creation AS date_creation, us.username AS username, us.image AS image, us.url AS url FROM 2d_profiles_comments co, 2d_users us WHERE ((co.id_user_page = ?) AND (co.id_user_member = us.id)) ORDER BY date_creation DESC";
        $query = $this->db->query($sql, array($userId));
        $getComsProfile = '';
        foreach ($query->result() as $row) {
            $time = timespan(strtotime($row->date_creation), time(), 1);
            $getComsProfile .= '<div class="comment">
							<img src="'.(empty($row->image) ? site_url('assets/images/default-user.png') : site_url('uploads/images/users/'.$row->image)).'" alt="" class="comment-avatar">
							<div class="comment-body">
								<div class="comment-text">
									<div class="comment-header">
										<a href="'.site_url('user/'.$row->url.'/').'" title="">'.$row->username.'</a><span>about '.$time.' ago</span>
									</div>
									'.$row->comment.'
								</div>
							</div>
						</div>';
        }
        return $getComsProfile;
    }

}
