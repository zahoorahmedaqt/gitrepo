<?php

class HomeModel extends CI_Model
{

    public function getBlocsGame($getOrder, $getPag)
    {
        if($getOrder === 'rated') {
            $sql = "SELECT id, title, url, id_category, played, note, image, date_upload FROM 2d_games WHERE status = 1 ORDER BY note DESC LIMIT ?,?";
        } elseif($getOrder === 'news') {
            $sql = "SELECT id, title, url, id_category, played, note, image, date_upload FROM 2d_games WHERE status = 1 ORDER BY date_publish DESC LIMIT ?,?";
        } elseif($getOrder === 'popular') {
            $sql = "SELECT id, title, url, id_category, played, note, image, date_upload FROM 2d_games WHERE status = 1 ORDER BY played DESC LIMIT ?,?";
        } else {
            $sql = "SELECT id, title, url, id_category, played, note, image, date_upload FROM 2d_games WHERE status = 1 ORDER BY title LIMIT ?,?";
        }
        $query = $this->db->query($sql, array((int)$getPag, (int)$this->config->item('home_pag')));
        $nbRows = $this->db->count_all('2d_games');
        $getBlocGame = '';
        foreach ($query->result() as $row) {
            // Comparison of dates for displaying the new tab on the game
            $date_upload = date_parse($row->date_upload);
            $datetime1 = date_create($date_upload['year'].'-'.$date_upload['month'].'-'.$date_upload['day']);
            $datetime2 = date_create(date("Y-m-d"));
            $interval = date_diff($datetime1, $datetime2);
            $time = $interval->format('%a');
            $classShow = ($time<=90)?'show':'';
            $getBlocGame .= '<div class="col-sm-12  col-md-2 col-lg-game-'.$this->config->item('home_nb').' p-b-20">
                                <div class="game-list-box">
    								<a href="'.site_url('game/show/'.$row->url).'/" class="image-popup" title="'.$row->title.'">
    									<img src="'.(empty($row->image) ? site_url('assets/images/default_swf.jpg') : $row->image).'" class="thumb-img" alt="work-thumbnail">
    								</a>

    								<!--<div class="game-action '.$classShow.'">
    									<a href="'.site_url('news/').'" class="btn btn-warning btn-sm">New</a>
    								</div>-->

    								'.rating($this->getNote($row->id), 'game-rating').'

    								<div class="game-title">
    									<h2 class="h5"><a href="'.site_url('game/show/'.$row->url).'" title="'.$row->title.'">'.mb_strimwidth($row->title, 0, 17, '...').'</a> </h2>
    								</div>
                                </div>
							</div>';
        }
        return array(
         'getBlocGame' => $getBlocGame,
         'nbRows'      => $nbRows
         );
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

}
