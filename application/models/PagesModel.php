<?php

class PagesModel extends CI_Model
{

    public function getPages()
    {
        $getPages = '';
        $sql = "SELECT id, title, url, content, date_creation, date_modified FROM 2d_pages";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $date_creation = date_parse($row->date_creation);
            $date_creation = $date_creation['day'].'/'.$date_creation['month'].'/'.$date_creation['year'];
            $date_modified = date_parse($row->date_modified);
            $date_modified = $date_modified['day'].'/'.$date_modified['month'].'/'.$date_modified['year'];
            $getPages .= 
             '<tr class="text-center">
					<td>'.$row->id.'</td>
					<td>'.$row->title.'</td>
					<td>'.$row->url.'</td>
					<td>'.character_limiter($row->content, 30).'</td>
					<td>'.$date_creation.'</td>
					<td>'.$date_modified.'</td>
					<td>
						<a class="btn btn-icon waves-effect btn-primary waves-light btn-xs" href="'.site_url('page/'.$row->url.'/').'"> <i class="fa fa-search"></i> </a>
						<a class="btn btn-icon waves-effect btn-default waves-light btn-xs" href="'.site_url('dashboard/pages/edit/'.$row->id.'/').'"><i class="fa fa-pencil"></i></a>
						<a class="btn btn-icon waves-effect btn-danger waves-light btn-xs" href="'.site_url('dashboard/pages/?del='.$row->id.'').'"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>';
        }
        return $getPages;
    }

    public function getPage($idPage)
    {
        $sql = "SELECT title, url, content, display_footer FROM 2d_pages WHERE id = ?";
        $query = $this->db->query($sql, array($idPage));
        if($result = $query->row()) {
            return array(
             'title_page'     => $result->title,
             'url_page'       => $result->url,
             'content_page'   => $result->content,
             'display_footer' => $result->display_footer
             );
        } else {
            return null;
        }
    }

    public function addPage($postTitle, $postURL, $postContent, $postDisplayFooter)
    {
        $sql = "INSERT INTO 2d_pages (title, url, content, display_footer, date_creation, date_modified) VALUES (?, ?, ?, ?, ?, ?)";
        $query = $this->db->query($sql, array($postTitle, $postURL, $postContent, $postDisplayFooter, date("Y-m-d H:i:s"), date("Y-m-d H:i:s")));
        $msg = alert('Saved changes. <a href="/dashboard/pages/edit/'.$this->db->insert_id().'">Edit it</a> now !');
        return $msg;
    }

    public function editPage($idPage, $postTitle, $postURL, $postContent)
    {
        $sql = "SELECT title, url FROM 2d_pages WHERE title = ? OR url = ?";
        $query = $this->db->query($sql, array($postTitle, $postURL));
        if($result = $query->row()) {
            if($result->title === $postTitle) {
                $sql = "UPDATE 2d_pages SET url = ?, content = ?, date_modified = ? WHERE id = ?";
                $this->db->query($sql, array($postURL, $postContent, date("Y-m-d H:i:s"), $idPage));
                $msg = alert('Saved changes');
            } elseif($result->url === $postURL) {
                $sql = "UPDATE 2d_pages SET title = ?, content = ?, date_modified = ? WHERE id = ?";
                $this->db->query($sql, array($postTitle, $postContent, date("Y-m-d H:i:s"), $idPage));
                $msg = alert('Saved changes');
            }
        } else {
            $sql = "UPDATE 2d_pages SET title = ?, url = ?, content = ?, date_modified = ? WHERE id = ?";
            $this->db->query($sql, array($postTitle, $postURL, $postContent, date("Y-m-d H:i:s"), $idPage));
            $msg = alert('Saved changes');
        }
        return $msg;
    }

    public function updateForm2($idPage, $displayFooter)
    {
        $sql = 'UPDATE 2d_pages SET display_footer = ? WHERE id = ?';
        $this->db->query($sql, array($displayFooter, $idPage));
        return alert('Saved changes');
    }

    public function delPage($idPage)
    {
        $sql = 'DELETE FROM 2d_pages WHERE id = ?';
        $this->db->query($sql, array($idPage));
    }

}
