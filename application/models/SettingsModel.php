<?php

class SettingsModel extends CI_Model
{
    public function getPages() 
    {
        $getPages = '';
        $sql = "SELECT url, title FROM 2d_pages";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $select = ($this->config->item('post_terms') === $row->url) ? 'selected' : '';
            $getPages .= '<option value="'.$row->url.'" '.$select.'>'.$row->title.'</option>';
        }
        return $getPages;
    }
}
