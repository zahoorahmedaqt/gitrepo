<?php

class PageModel extends CI_Model
{

    public function getPage($getUrl) 
    {
        $sql = "SELECT title, url, content FROM 2d_pages WHERE url = ?";
        $query = $this->db->query($sql, array($getUrl));
        $result = $query->row();
        if($result = $query->row()) {
            return array(
             'title'   => $result->title,
             'url'     => $result->url,
             'content' => $result->content
             );
        } else {
            show_404($page = '', $log_error = false);
        }
    }

}
