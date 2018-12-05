<?php

class DashboardModel extends CI_Model
{

    public function getNbMembers()
    {
        $sql = "SELECT id FROM 2d_users";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getStatsMembers()
    {
        $sql = "SELECT date_inscription FROM 2d_users";
        $query = $this->db->query($sql);
        $nbsDay = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29);
        foreach ($query->result() as $row) {
            // Comparaison des dates
            $dateInscription = date_parse($row->date_inscription);
            $dateTime1 = date_create($dateInscription['year'].'-'.$dateInscription['month'].'-'.$dateInscription['day']);
            $dateTime2 = date_create(date("Y-m-d"));
            $interval = date_diff($dateTime1, $dateTime2);
            $nbDay = $interval->format('%a');
            if($nbDay <= 29) {
                $nbsDay[] = $nbDay;
            }
        }
        $nbsDay = array_count_values($nbsDay);
        $statsMembers = ""; $i=0;
        foreach ($nbsDay as $key) {
            if($i == 29) {
                $seg = '';
            } else {
                $seg = ',';
            }
            $key -= 1; $i++;
            $statsMembers .= $key.$seg;
        }
        return $statsMembers;
    }

    public function getNbComments()
    {
        $sql = "SELECT id FROM 2d_comments";
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    public function getStatsComments()
    {
        $sql = "SELECT date_creation FROM 2d_comments";
        $query = $this->db->query($sql);
        $nbsDay = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29);
        foreach ($query->result() as $row) {
            // Comparaison des dates
            $dateCreation = date_parse($row->date_creation);
            $dateTime1 = date_create($dateCreation['year'].'-'.$dateCreation['month'].'-'.$dateCreation['day']);
            $dateTime2 = date_create(date("Y-m-d"));
            $interval = date_diff($dateTime1, $dateTime2);
            $nbDay = $interval->format('%a');
            if($nbDay <= 29) {
                $nbsDay[] = $nbDay;
            }
        }
        $nbsDay = array_count_values($nbsDay);
        $statsComments = ""; $i=0;
        foreach ($nbsDay as $key) {
            if($i == 29) {
                $seg = '';
            } else {
                $seg = ',';
            }
            $key -= 1; $i++;
            $statsComments .= $key.$seg;
        }
        return $statsComments;
    }

    public function getNbPlayed()
    {
        $sql = "SELECT played FROM 2d_games";
        $query = $this->db->query($sql);
        $played = 0;
        foreach ($query->result() as $row) {
            $played += $row->played;
        }
        return $played;
    }

    public function getStatsPlayed($thisMonth = true)
    {
        $date = new DateTime();
        $arrayPlayed = array();
        if($thisMonth != true) {
            $newDate = $date->modify('-1 month');
        }
        for ($i = 0; $i <= 29; $i++) {
            ($i != 0 ) ? $newDate = $date->modify('-1 day') : $newDate = $date;
            $newDate = $date->format('Y-m-d');
            $sql = "SELECT value FROM 2d_stats WHERE date_creation = ? AND attribut = ?";
            $query = $this->db->query($sql, array($newDate,0));
            if($result = $query->row()) {
                $arrayPlayed[] = $result->value;
            } else {
                $arrayPlayed[] = 0;
            }
        }
        $statsPlayed = ""; $i=0;
        foreach ($arrayPlayed as $key) {
            if($i == 29) {
                $seg = '';
            } else {
                $seg = ',';
            }
            $i++;
            $statsPlayed .= $key.$seg;
        }
        return $statsPlayed;
    }

    public function getBestPlayedGames($nbPlayed)
    {
        $getBestPlayedGames = '';
        $sql = "SELECT title, played FROM 2d_games ORDER BY played DESC LIMIT 0,5";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $round = ($nbPlayed !== 0) ? $row->played/$nbPlayed*100 : 0;
            $getBestPlayedGames .=
             '<p>'.$row->title.' <span class="pull-right"><span class="text-inverse font-600">'.$row->played.'</span> times</span></p>
					<div class="progress m-b-30">
						<div class="progress-bar progress-bar-primary progress-animated wow animated" role="progressbar" aria-valuenow="'.$round.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$round.'%">
						</div><!-- /.progress-bar .progress-bar-danger -->
					</div><!-- /.progress .no-rounded -->';
        }
        return $getBestPlayedGames;
    }

    public function getLastGamesAdded()
    {
        $getLastGamesAdded = '';
        $sql = "SELECT ga.id AS id, ga.title AS gameTitle, ga.url AS url, ga.image AS image, ca.title AS catTitle FROM 2d_games ga, 2d_categories ca WHERE ga.id_category = ca.id ORDER BY date_upload DESC LIMIT 0,5";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $getLastGamesAdded .=
             '<tr>
				<td><img src="'.(empty($row->image) ? site_url('assets/images/default_swf.jpg') : $row->image).'" class="thumb-sm pull-left m-r-10 img-circle" alt=""> '.$row->gameTitle.' </td>
				<td>'.$row->catTitle.'</td>
				<td>
					<a href="'.site_url('dashboard/games/edit/'.$row->id).'" class="table-action-btn"><i class="md md-edit"></i></a>
				</td>
			</tr>';
        }
        return $getLastGamesAdded;
    }

    public function getLastcomments()
    {
        $getLastcomments = '';
        $sql = "SELECT co.id AS id, co.comment AS comment, ga.title AS title, us.image AS image FROM 2d_comments co, 2d_games ga, 2d_users us WHERE co.id_user = us.id AND co.id_game = ga.id ORDER BY date_upload DESC LIMIT 0,5";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $getLastcomments .=
             '<tr>
				<td><img src="'.(empty($row->image) ? site_url('assets/images/default-user.png') : site_url('uploads/images/users/'.$row->image)).'" class="thumb-sm pull-left m-r-10 img-circle" alt=""> '.character_limiter($row->comment, 30).' </td>
				<td>'.$row->title.'</td>
				<td>
					<a href="'.site_url('dashboard/comments/edit/'.$row->id).'" class="table-action-btn"><i class="md md-edit"></i></a>
				</td>
			</tr>';
        }
        return $getLastcomments;
    }
}
