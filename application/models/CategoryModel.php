<?php

class CategoryModel extends CI_Model
{

    public function getBlocsGame($getUrl, $getOrder, $getPag)
    {
        // Total of results in this category (pagination)
        $sql = "SELECT ca.id FROM 2d_games ga, 2d_categories ca WHERE ((ca.url = ?) AND (ca.id = ga.id_category) AND (ga.status = 1))";
        $query = $this->db->query($sql, array($getUrl));
        $nbRows = $query->num_rows();
        // Query requests for each filter (rated, news, popular, name)
        if($getOrder === 'rated') {
            $sql = "SELECT ga.id AS id, ga.title AS title, ga.url AS url, ga.id_category AS id_category, ga.played AS played, ga.image AS image, ga.note AS note, ga.date_upload AS date_upload, ca.title AS cat_title, ca.url AS cat_url
				FROM 2d_games ga, 2d_categories ca
				WHERE ((ca.url = ?) AND (ca.id = ga.id_category) AND (ga.status = 1))
				ORDER BY note DESC
				LIMIT ?,?";
        } elseif($getOrder === 'news') {
            $sql = "SELECT ga.id AS id, ga.title AS title, ga.url AS url, ga.id_category AS id_category, ga.played AS played, ga.image AS image, ga.note AS note, ga.date_upload AS date_upload, ca.title AS cat_title, ca.url AS cat_url
				FROM 2d_games ga, 2d_categories ca
				WHERE ((ca.url = ?) AND (ca.id = ga.id_category) AND (ga.status = 1))
				ORDER BY date_upload DESC
				LIMIT ?,?";
        } elseif($getOrder === 'popular') {
            $sql = "SELECT ga.id AS id, ga.title AS title, ga.url AS url, ga.id_category AS id_category, ga.played AS played, ga.image AS image, ga.note AS note, ga.date_upload AS date_upload, ca.title AS cat_title, ca.url AS cat_url
				FROM 2d_games ga, 2d_categories ca
				WHERE ((ca.url = ?) AND (ca.id = ga.id_category) AND (ga.status = 1))
				ORDER BY played DESC
				LIMIT ?,?";
        } else {
            $sql = "SELECT ga.id AS id, ga.title AS title, ga.url AS url, ga.id_category AS id_category, ga.played AS played, ga.image AS image, ga.note AS note, ga.date_upload AS date_upload, ca.title AS cat_title, ca.url AS cat_url
				FROM 2d_games ga, 2d_categories ca
				WHERE ((ca.url = ?) AND (ca.id = ga.id_category) AND (ga.status = 1))
				ORDER BY title
				LIMIT ?,?";
        }
        $query = $this->db->query($sql, array($getUrl, (int)$getPag, (int)$this->config->item('cat_pag')));
        if($query->num_rows() > 0) {
            $getBlocGame = '';
            foreach ($query->result() as $row) {
                // Comparison of dates for displaying the new tab on the game
                $date_upload = date_parse($row->date_upload);
                $datetime1 = date_create($date_upload['year'].'-'.$date_upload['month'].'-'.$date_upload['day']);
                $datetime2 = date_create(date("Y-m-d"));
                $interval = date_diff($datetime1, $datetime2);
                $time = $interval->format('%a');
                $classShow = ($time <= 90) ? 'show' : '';
                $getBlocGame .= '<div class=" col-sm-2 p-b-20">
                                    <div class="game-list-box">
    									<a href="'.site_url('game/show/'.$row->url).'/" class="image-popup" title="'.$row->title.'">
    										<img src="'.(empty($row->image) ? site_url('assets/images/default_swf.jpg') : $row->image).'" class="thumb-img" alt="">
    									</a>

    									<!-- <div class="game-action '.$classShow.'">
    										<a href="'.site_url('category/'.$row->cat_url.'/news/').'" class="btn btn-warning btn-sm">New</a>
    									</div> -->

    									'.rating($this->getNote($row->id), 'game-rating').'

    									<div class="game-title">
    										<h2 class="h5"><a href="'.site_url('game/show/'.$row->url).'" title="'.$row->title.'">'.mb_strimwidth($row->title, 0, 17, '...').'</a> </h2>
    									</div>
                                    </div>
								</div>';
            }
            return array(
             'getBlocGame' => $getBlocGame,
             'cat_title'   => $row->cat_title,
             'cat_url'     => $row->cat_url,
             'id_category' => $row->id_category,
             'nbRows'      => $nbRows
             );
        } else {
            return array(
             'getBlocGame' => null,
             'cat_title'   => null,
             'cat_url'     => null,
             'id_category' => null,
             'nbRows'      => null
             );
        }
    }

    public function getNote($idGame)
    {
        $sql = "SELECT note FROM 2d_notes WHERE id_game = ?";
        $query = $this->db->query($sql, array($idGame));
        if($query->num_rows() > 0) {
            $note = 0;
            $i = 0;
            foreach ($query->result() as $row) {
                $note = $note + $row->note;
                $i++;
            }
            $note = $note / $i;
        } else {
            $note = 0;
        }
        return $note;
    }

    public function getBestGamesNote($idCategory)
    {
        $sql = "SELECT DISTINCT ga.id AS id, ga.title AS title, ga.url AS url, ga.note AS note FROM 2d_games ga, 2d_notes no WHERE ((ga.id_category = ?) AND (ga.id = no.id_game) AND (ga.status = 1)) ORDER BY note DESC LIMIT 0,10";
        $query = $this->db->query($sql, array($idCategory));
        $getBestGamesNote = '';
        foreach ($query->result() as $row) {
            $note = 0;
            $i = 0;
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
        $getBestGamesClic = '';
        $i = 0;
        foreach ($query->result() as $row) {
            $i++; $class = ($i === $query->num_rows()) ? '':'m-b-10';
            $getBestGamesClic .= '<div class="row">
									<div class="col-sm-12 '.$class.'">
										<span><a href="'.site_url('game/show/'.$row->url.'/').'">'.$row->title.'</a></span>
										<span class="pull-right text-danger"><span class="text-muted m-r-15">clicks</span>'.$row->played.'</span>
									</div>
	                            </div>';
        }
        return $getBestGamesClic;
    }

    public function getComs()
    {
        $sql = "SELECT co.comment AS comment, us.username AS username, us.image AS image, us.url AS url FROM 2d_comments co, 2d_users us WHERE co.id_user = us.id ORDER BY co.date_creation DESC LIMIT 0,7";
        $query = $this->db->query($sql);

        $getComs = ''; $i = 0;
        foreach ($query->result() as $row) {
            $i++;
            $hr = ($i === $query->num_rows()) ? '':'<hr>';
            $getComs .= '<div class="comment p-t-0">
							<a href="'.site_url('user/'.$row->url.'/').'"><img src="'.(empty($row->image) ? site_url('assets/images/default-user.png') : site_url('uploads/images/users/'.$row->image)).'" alt="'.$row->username.'" class="comment-avatar"></a>
							<div class="comment-body">
								<div class="comment-widget">
									'.$row->comment.'
								</div>
							</div>
							'.$hr.'
						</div>';
        }
        return $getComs;
    }

}
