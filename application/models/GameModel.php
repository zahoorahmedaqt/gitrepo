<?php

class GameModel extends CI_Model
{

    public function getGame($getUrl)
    {
        $sql = "SELECT ga.id AS id, ga.title AS title, ga.url AS url, ga.description AS description, ga.control AS control, ga.tips AS tips, ga.id_category AS id_category, ga.ids_keywords AS ids_keywords, ga.note AS note, ga.played AS played, ga.status AS status, ga.type AS type, ga.console AS console, ga.embed AS embed, ga.image AS image,  ga.file AS file, ga.author AS author, ga.date_upload AS date_upload, ca.title AS category, ca.url AS url_category FROM 2d_games ga, 2d_categories ca WHERE ((ga.url = '$getUrl') AND (ca.id = ga.id_category))";
        $query = $this->db->query($sql);
        if($result = $query->row()) {
            return array(
             'id'           => $result->id,
             'title_game'   => $result->title,
             'url'          => $result->url,
             'id_category'  => $result->id_category,
             'ids_keywords' => $result->ids_keywords,
             'category'     => $result->category,
             'url_category' => $result->url_category,
             'description'  => $result->description,
             'control'      => $result->control,
             'tips'         => $result->tips,
             'note'         => $result->note,
             'played'       => $result->played,
             'type'         => $result->type,
             'console'      => $result->console,
             'embed'        => $result->embed,
             'status'       => $result->status,
             'image'        => $result->image,
             'file'         => $result->file,
             'author'       => $result->author,
             'date_upload'  => $result->date_upload,
             );
        } else {
            show_404($page = '', $log_error = false);
        }
    }

    public function updateGameStat($idGame)
    {
        $sql = "SELECT played FROM 2d_games WHERE id = ?";
        $query = $this->db->query($sql, array($idGame));
        $result = $query->row();
        $newStat = $result->played+1;
        $sql = "UPDATE 2d_games SET played = ? WHERE id = ?";
        $this->db->query($sql, array($newStat, $idGame));
        $sql = "SELECT attribut, value FROM 2d_stats WHERE date_creation = ? AND attribut = 'played'";
        $query = $this->db->query($sql, array(date('Y-m-d')));
        if($result = $query->row()) {
            $newStat = $result->value+1;
            $sql = "UPDATE 2d_stats SET value = ? WHERE date_creation = ? AND attribut = 0";
            $this->db->query($sql, array($newStat, date('Y-m-d')));
        } else {
            $sql = "INSERT INTO 2d_stats (attribut, value, date_creation) VALUES (?, ?, ?)";
            $this->db->query($sql, array(0, 1, date('Y-m-d')));
        }
    }

    public function getBestGamesNote($idCategory)
    {
        $sql = "SELECT DISTINCT ga.id AS id, ga.title AS title, ga.url AS url, ga.note AS note FROM 2d_games ga, 2d_notes no WHERE ((ga.id_category = ?) AND (ga.id = no.id_game) AND (status = 1)) ORDER BY note DESC LIMIT 0,10";
        $query = $this->db->query($sql, array($idCategory));
        $getBestGamesNote = '';
        foreach ($query->result() as $row) {
            $note = 0;
            $i =0;
            $sql = "SELECT note FROM 2d_notes WHERE (id_game = ?)";
            $query = $this->db->query($sql, array($row->id));
            foreach ($query->result() as $row1) {
                $note = $note + $row1->note;
                $i++;
            }
            $note = $note / $i;
            $getBestGamesNote .= '<div class="row">
									<div class="col-sm-12 m-b-10">
										<span><a href="'.site_url('game/show/'.$row->url.'/').'">'.$row->title.'</a></span>
										<span class="pull-right">'.rating($note).'</span>
									</div>
                                </div>';
        }
        return $getBestGamesNote;
    }

    public function getBestGamesClic($idCategory)
    {
        $sql = "SELECT DISTINCT title, played, url FROM 2d_games WHERE id_category = ? AND status = 1 ORDER BY played DESC LIMIT 0,10";
        $query = $this->db->query($sql, array($idCategory));
        $getBestGamesClic = ''; $i = 0;
        foreach ($query->result() as $row) {
            $i++;
            $class = ($i === $query->num_rows()) ? '':'m-b-10';
            $getBestGamesClic .= '<div class="row">
									<div class="col-sm-12 '.$class.'">
										<span><a href="'.site_url('game/show/'.$row->url.'/').'">'.$row->title.'</a></span>
										<span class="pull-right text-danger"><span class="text-muted m-r-15">clicks</span>'.$row->played.'</span>
									</div>
	                            </div>';
        }
        return $getBestGamesClic;
    }

    public function getUsersFav($idGame)
    {
        $sql = "SELECT us.url AS url, us.username AS username, us.image AS image FROM 2d_favorites fa, 2d_users us WHERE ((fa.id_game = ?) AND (fa.id_user = us.id)) LIMIT 16";
        $query = $this->db->query($sql, array($idGame));
        $getUsersFav = '';
        foreach ($query->result() as $row) {
            $getUsersFav .= '<a href="'.site_url('user/'.$row->url.'/').'">
								<img src="'.(empty($row->image) ? site_url('assets/images/default-user.png') : site_url('uploads/images/users/'.$row->image)).'" class="thumb-lg img-thumbnail m-r-5" alt="'.$row->username.'">
							</a>';
        }
        return $getUsersFav;
    }

    public function getFav($idGame)
    {
        $sql = "SELECT id FROM 2d_favorites WHERE id_game = ? AND id_user = ?";
        $query = $this->db->query($sql, array($idGame, $this->session->id));
        if($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getNote($idGame)
    {
        $sql = "SELECT note FROM 2d_notes WHERE id_game = ?";
        $query = $this->db->query($sql, array($idGame));
        if($query->num_rows() > 0) {
            $getNote = 0;
            $i = 0;
            foreach ($query->result() as $row) {
                $getNote = $getNote + $row->note;
                $i++;
            }
            $getNote = $getNote / $i;
        } else {
            $getNote = 0;
            $i = 0;
        }
        return array(
         'getNote' => $getNote,
         'getNbNote' => $i
         );
    }

    public function getKeywords($idsKeywords)
    {
        $idsKeywords = explode(',', $idsKeywords);
        $getKeywords = '';
        $i = 0;
        foreach ($idsKeywords as $id) {
            $i++;
            $sql = "SELECT title FROM 2d_keywords WHERE id = ?";
            $query = $this->db->query($sql, array($id));
            if($result = $query->row()) {
                $getKeywords .= $result->title.(($i !== count($idsKeywords)) ? ', ' : '');
            }
        }
        return $getKeywords;
    }

    public function updateNote($idGame, $score)
    {
        $sql = "SELECT id FROM 2d_notes WHERE id_user = ? AND id_game = ?";
        $query = $this->db->query($sql, array($this->session->id, $idGame));
        if($query->num_rows() > 0) {
            $sql = "UPDATE 2d_notes SET note = ?, date_creation = ? WHERE id_user = ? AND id_game = ?";
            $this->db->query($sql, array($score, date("Y-m-d H:i:s"), $this->session->id, $idGame));
        } else {
            $sql = "INSERT INTO 2d_notes (id_user, id_game, note, date_creation) VALUES (?, ?, ?, ?)";
            $this->db->query($sql, array($this->session->id, $idGame, $score, date("Y-m-d H:i:s")));
        }
        $getNote = $this->getNote($idGame);
        $sql = "UPDATE 2d_games SET note = ? WHERE id = ?";
        $this->db->query($sql, array($getNote['getNote'], $idGame));
        $this->updateNotes($this->session->id);
    }

    public function updateNotes($idUser)
    {
        $sql = 'SELECT id FROM 2d_notes WHERE id_user = ?';
        $query = $this->db->query($sql, array($idUser));
        $sql = "UPDATE 2d_users SET nb_notes = ? WHERE id = ?";
        $this->db->query($sql, array($query->num_rows(), $idUser));
    }

    public function addFav($idGame)
    {
        $sql = "SELECT id FROM 2d_favorites WHERE id_user = ? AND id_game = ?";
        $query = $this->db->query($sql, array($this->session->id, $idGame));
        if($query->num_rows() <= 0) {
            $sql = "INSERT INTO 2d_favorites (id_user, id_game, date_creation) VALUES (?, ?, ?)";
            $this->db->query($sql, array($this->session->id, $idGame, date("Y-m-d H:i:s")));
        }
        $this->updateFavs($this->session->id);
    }

    public function delFav($idGame)
    {
        $sql = 'DELETE FROM 2d_favorites WHERE id_game = ? AND id_user = ?';
        $this->db->query($sql, array($idGame, $this->session->id));
        $this->updateFavs($this->session->id);
    }

    public function updateFavs($idUser)
    {
        $sql = 'SELECT id FROM 2d_favorites WHERE id_user = ?';
        $query = $this->db->query($sql, array($idUser));
        $sql = "UPDATE 2d_users SET nb_favs = ? WHERE id = ?";
        $this->db->query($sql, array($query->num_rows(), $idUser));
    }

    public function addCom($idGame, $postCom, $postRelated)
    {
        $sql = 'INSERT INTO 2d_comments (comment, id_game, id_user, id_relation, date_creation, ip) VALUES (?, ?, ?, ?, ?, ?)';
        $this->db->query($sql, array(strip_tags($postCom), $idGame, $this->session->id, (int)$postRelated, date("Y-m-d H:i:s"), $this->input->ip_address()));
        $this->updateComs($this->session->id);
    }

    public function updateComs($idUser)
    {
        $sql = 'SELECT id FROM 2d_comments WHERE id_user = ?';
        $query = $this->db->query($sql, array($idUser));
        $sql = "UPDATE 2d_users SET nb_coms = ? WHERE id = ?";
        $this->db->query($sql, array($query->num_rows(), $idUser));
    }

    public function likesComs($idCom, $likeType)
    {
        if($likeType == 1) {
            $sql = 'SELECT nb_like FROM 2d_likes WHERE id_com = ? AND id_user = ?';
            $query = $this->db->query($sql, array($idCom, $this->session->id));
            if($result = $query->row()) {
                if($result->nb_like == 0) {
                    $sql = "UPDATE 2d_likes SET nb_like = ?, nb_unlike = ? WHERE id_com = ? AND id_user = ?";
                    $this->db->query($sql, array(1, 0, $idCom, $this->session->id));
                } else {
                    $sql = "UPDATE 2d_likes SET nb_like = ? WHERE id_com = ? AND id_user = ?";
                    $this->db->query($sql, array(0, $idCom, $this->session->id));
                }
            } else {
                $sql = "INSERT INTO 2d_likes (id_user, id_com, nb_like, date_creation) VALUES (?, ?, ?, ?)";
                $this->db->query($sql, array($this->session->id, $idCom, 1, date('Y-m-d H:i:s')));
            }
        } elseif ($likeType == 0) {
            $sql = 'SELECT nb_unlike FROM 2d_likes WHERE id_com = ? AND id_user = ?';
            $query = $this->db->query($sql, array($idCom, $this->session->id));
            if($result = $query->row()) {
                if($result->nb_unlike == 0) {
                    $sql = "UPDATE 2d_likes SET nb_unlike = ?, nb_like = ? WHERE id_com = ? AND id_user = ?";
                    $this->db->query($sql, array(1, 0, $idCom, $this->session->id));
                } else {
                    $sql = "UPDATE 2d_likes SET nb_unlike = ? WHERE id_com = ? AND id_user = ?";
                    $this->db->query($sql, array(0, $idCom, $this->session->id));
                }
            } else {
                $sql = "INSERT INTO 2d_likes (id_user, id_com, nb_unlike, date_creation) VALUES (?, ?, ?, ?)";
                $this->db->query($sql, array($this->session->id, $idCom, 1, date('Y-m-d H:i:s')));
            }
        } else {
        }
        $sql = 'SELECT nb_like, nb_unlike FROM 2d_likes WHERE id_com = ?';
        $query = $this->db->query($sql, array($idCom));
        $score = 0;
        foreach ($query->result() as $row) {
            $score += $row->nb_like-$row->nb_unlike;
        }
        $sql = "UPDATE 2d_comments SET score = ? WHERE id = ?";
        $this->db->query($sql, array($score, $idCom));
    }

    public function checkLikesComs($idCom, $idUser)
    {
        $sql = "SELECT nb_like, nb_unlike FROM 2d_likes WHERE ((id_com = ?) AND (id_user = ?))";
        $query = $this->db->query($sql, array($idCom, $idUser));
        if($result = $query->row()) {
            return array (
             'nbLike' => $result->nb_like,
             'nbUnlike' => $result->nb_unlike
             );
        } else {
            return array (
             'nbLike' => 0,
             'nbUnlike' => 0
             );
        }
    }

    public function getComs($idGame, $getPag, $getOrder = false)
    {
        $sql = "SELECT id FROM 2d_comments WHERE ((id_game = ?) AND (id_relation = 0))";
        $query = $this->db->query($sql, array($idGame));
        $nbRows = $query->num_rows();
        if($getOrder == true) {
            $sql = "SELECT co.id AS id, co.comment AS comment, co.date_creation AS date_creation, us.username AS username, us.url AS url, us.image AS image FROM 2d_comments co, 2d_users us WHERE ((co.id_game = ?) AND (co.id_user = us.id) AND (id_relation = 0) AND (score > 0)) ORDER BY score DESC LIMIT 3";
            $query1 = $this->db->query($sql, array($idGame));
        } else {
            $sql = "SELECT co.id AS id, co.comment AS comment, co.date_creation AS date_creation, us.username AS username, us.url AS url, us.image AS image FROM 2d_comments co, 2d_users us WHERE ((co.id_game = ?) AND (co.id_user = us.id) AND (id_relation = 0)) ORDER BY date_creation DESC LIMIT ?,?";
            $query1 = $this->db->query($sql, array($idGame, (int)$getPag, (int)$this->config->item('coms_pag')));
        }
        $getComs = '';
        foreach ($query1->result() as $row1) {
            $sql = "SELECT co.id AS id, co.comment AS comment, co.date_creation AS date_creation, us.username AS username, us.url AS url, us.image AS image FROM 2d_comments co, 2d_users us WHERE ((id_relation = ?) AND (co.id_user = us.id))";
            $query2 = $this->db->query($sql, array($row1->id));
            $related1 = '';
            foreach ($query2->result() as $row2) {
                $sql = "SELECT co.id AS id, co.comment AS comment, co.date_creation AS date_creation, us.username AS username, us.url AS url, us.image AS image FROM 2d_comments co, 2d_users us WHERE ((id_relation = ?) AND (co.id_user = us.id))";
                $query3 = $this->db->query($sql, array($row2->id));
                $related2 = '';
                foreach ($query3->result() as $row3) {
                    $time = timespan(strtotime($row3->date_creation), time(), 1);
                    if($this->session->id) {
                        $data = $this->checkLikesComs($row3->id, $this->session->id);
                    }
                    $related2 .= '<div class="comment">
		                            <img src="'.(empty($row3->image) ? site_url('assets/images/default-user.png') : site_url('uploads/images/users/'.$row3->image)).'" alt="'.$row3->username.'" class="comment-avatar">
		                            <div class="comment-body">
		                                <div class="comment-text">
		                                    <div class="comment-header">
		                                        <a href="'.site_url('user/'.$row3->url.'/').'">'.$row3->username.'</a><span>about '.$time.' ago</span>
		                                    </div>
		                                    '.$row3->comment.'
		                                </div>
		                                <div class="comment-footer" data-id="'.$row3->id.'">
		                                    <a href="#comments" class="finger-up"><i class="fa fa-thumbs-o-up '.(($this->session->id) && ($data['nbLike'] == 1) ? 'text-primary' : '').'"></i></a>
											<a href="#comments" class="finger-down"><i class="fa fa-thumbs-o-down '.(($this->session->id) && ($data['nbUnlike'] == 1) ? 'text-danger' : '').'"></i></a>
		                                </div>
		                            </div>
		                        </div>';
                }
                $time = timespan(strtotime($row2->date_creation), time(), 1);
                if($this->session->id) {
                    $data = $this->checkLikesComs($row2->id, $this->session->id);
                }
                $related1 .= '<div class="comment">
	                            <img src="'.(empty($row2->image) ? site_url('assets/images/default-user.png') : site_url('uploads/images/users/'.$row2->image)).'" alt="'.$row2->username.'" class="comment-avatar">
	                            <div class="comment-body">
	                                <div class="comment-text">
	                                    <div class="comment-header">
	                                        <a href="'.site_url('user/'.$row2->url.'/').'">'.$row2->username.'</a><span>about '.$time.' ago</span>
	                                    </div>
	                                    '.$row2->comment.'
	                                </div>
	                                <div class="comment-footer" data-id="'.$row2->id.'">
	                                    <a href="#comments" class="finger-up"><i class="fa fa-thumbs-o-up '.(($this->session->id) && ($data['nbLike'] == 1) ? 'text-primary' : '').'"></i></a>
										<a href="#comments" class="finger-down"><i class="fa fa-thumbs-o-down '.(($this->session->id) && ($data['nbUnlike'] == 1) ? 'text-danger' : '').'"></i></a>
	                                    <a href="#comments" id="reply" >Reply</a>
	                                </div>
	                            </div>
	                           	'.$related2.'
	                        </div>';
            }
            $time = timespan(strtotime($row1->date_creation), time(), 1);
            if($this->session->id) {
                $data = $this->checkLikesComs($row1->id, $this->session->id);
            }
            $getComs .= '<div class="comment">
							<img src="'.(empty($row1->image) ? site_url('assets/images/default-user.png') : site_url('uploads/images/users/'.$row1->image)).'" alt="'.$row1->username.'" class="comment-avatar">
							<div class="comment-body">
								<div class="comment-text">
									<div class="comment-header">
										<a href="'.site_url('user/'.$row1->url.'/').'">'.$row1->username.'</a><span>about '.$time.' ago</span>
									</div>
									'.$row1->comment.'
								</div>

								<div class="comment-footer" data-id="'.$row1->id.'">
									<a href="#comments" class="finger-up"><i class="fa fa-thumbs-o-up '.(($this->session->id) && ($data['nbLike'] == 1) ? 'text-primary' : '').'"></i></a>
									<a href="#comments" class="finger-down"><i class="fa fa-thumbs-o-down '.(($this->session->id) && ($data['nbUnlike'] == 1) ? 'text-danger' : '').'"></i></a>
									<a href="#comments" id="reply">Reply</a>
								</div>
							</div>
							'.$related1.'
						</div>';
        }
        return array(
         'nbRows' => $nbRows,
         'getComs' => $getComs
         );
    }

}
