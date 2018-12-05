<?php

class MediasModel extends CI_Model
{

    public function deleteDbImg($file) 
    {
        $sql = "SELECT id FROM 2d_games WHERE image = ?";
        $query = $this->db->query($sql, array($file));
        if($result = $query->row()) {
            $sql = "UPDATE 2d_games SET image = '' WHERE id = ?";
            $this->db->query($sql, array($result->id));
        }
    }

    public function deleteDbFile($file) 
    {
        $sql = "SELECT id FROM 2d_games WHERE file = ?";
        $query = $this->db->query($sql, array($file));
        if($result = $query->row()) {
            $sql = "UPDATE 2d_games SET file = '' WHERE id = ?";
            $this->db->query($sql, array($result->id));
        }
    }

    public function getSwfGame($file) 
    {
        $sql = "SELECT title FROM 2d_games WHERE file = ?";
        $query = $this->db->query($sql, array($file));
        if($result = $query->row()) {
            return array(
             'title' => $result->title
             );
        } else{
            return array(
             'title' => 'Unattached'
             );
        }
    }

}
