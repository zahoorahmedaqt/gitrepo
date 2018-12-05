<?php

class AutoloadModel extends CI_Model
{
    public function getCategories() 
    {
        $sql = "SELECT id, title FROM 2d_categories WHERE id_relation = ?";
        $query = $this->db->query($sql, 0);
        $getCategories = '';
        foreach ($query->result() as $row) {
            $sql = "SELECT title, url FROM 2d_categories WHERE id_relation = ? ORDER BY title";
            $query1 = $this->db->query($sql, $row->id);
            $getSubCategories = '';
            foreach ($query1->result() as $row1) {
                $getSubCategories .= '<li><a href="'.site_url('category/'.$row1->url.'/').'">'.$row1->title.'</a></li>';
            }
            $getCategories .= '<li class="dropdown">
									<a href="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$row->title.' <span class="caret"></span></a>
									<ul class="dropdown-menu">
										'.$getSubCategories.'
									</ul>
								</li>';
        }
        return $getCategories;
    }

    public function getFooter() 
    {
        $sql = "SELECT title, url FROM 2d_pages WHERE display_footer = 1 ORDER BY title";
        $query = $this->db->query($sql);
        $getFooter = '';
        foreach ($query->result() as $row) {
            $getFooter .= '<li><a href="'.site_url('page/'.$row->url.'/').'">'.$row->title.'</a></li>';
        }
        return $getFooter;
    }
}
