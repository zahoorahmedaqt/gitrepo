<?php

class CategoriesModel extends CI_Model
{
    public function getCategories() 
    {
        $getCategories = '';
        $sql = "SELECT id, title, url, id_relation FROM 2d_categories";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $sql = "SELECT title AS subcategory FROM 2d_categories WHERE id = ?";
            $query = $this->db->query($sql, $row->id_relation);
            if($result = $query->row()) {
                $subCategory = $result->subcategory;
            } else {
                $subCategory = 'None';

            }
            $getCategories .= 
             '<tr class="text-center">
					<td>'.$row->id.'</td>
					<td>'.$row->title.'</td>
					<td>'.$row->url.'</td>
					<td>'.$subCategory.'</td>
					<td>
						<a class="btn btn-icon waves-effect btn-primary waves-light btn-xs" href="'.site_url('category/'.$row->url.'/').'"> <i class="fa fa-search"></i> </a>
						<a class="btn btn-icon waves-effect btn-default waves-light btn-xs" href="'.site_url('dashboard/categories/edit/'.$row->id.'/').'"> <i class="fa fa-pencil"></i> </a>
						<a class="btn btn-icon waves-effect btn-danger waves-light btn-xs" href="'.site_url('dashboard/categories/?del='.$row->id.'').'"> <i class="fa fa-trash-o"></i> </a>
					</td>
				</tr>';
        }
        return $getCategories;
    }

    public function getCategorie($idCategory)
    {
        $sql = "SELECT title, url, id_relation FROM 2d_categories WHERE id = ?";
        $query = $this->db->query($sql, array($idCategory));
        if($result = $query->row()) {
            return array(
             'title_categorie' => $result->title,
             'url_categorie'   => $result->url,
             'id_relation'     => $result->id_relation
             );
        } else {
            return null;
        }
    }

    public function getListCats($idRelation = "", $idCategory = "")
    {
        $getListCats = '<option value="0">None</option>';
        if(!empty($idCategory)) {
            $sql = "SELECT id, title, id_relation FROM 2d_categories WHERE id != ?";
            $query = $this->db->query($sql, $idCategory);
        } else {
            $sql = "SELECT id, title, id_relation FROM 2d_categories";
            $query = $this->db->query($sql);
        }
        foreach ($query->result() as $row) {
            $select = ($idRelation == $row->id) ? 'selected' : '';
            $getListCats .= '<option value="'.$row->id.'" '.$select.'>'.$row->title.'</option>';
        }
        return $getListCats;
    }

    public function addCategorie($postTitle, $postURL, $postParentCat)
    {
        $sql = "SELECT title, url FROM 2d_categories WHERE title = ? OR url = ?";
        $query = $this->db->query($sql, array(ucfirst($postTitle), $postURL));
        if($query->num_rows() > 0) {
            $msg = alert('The category already exists', 'danger');
        } else {
            $sql = "INSERT INTO 2d_categories (title, url, id_relation) VALUES (?, ?, ?)";
            $this->db->query($sql, array(ucfirst($postTitle), $postURL, $postParentCat));
            $msg = alert('The category was created. <a href="/dashboard/categories/edit/'.$this->db->insert_id().'">Edit it</a> now !');
        }
        return $msg;
    }

    public function editCategorie($idCategory, $postTitle, $postURL, $postParentCat) 
    {
        $sql = "SELECT title, url FROM 2d_categories WHERE title = ? OR url = ?";
        $query = $this->db->query($sql, array($postTitle, $postURL));
        if($result = $query->row()) {
            if($result->title === $postTitle) {
                $sql = "UPDATE 2d_categories SET url = ?, id_relation = ? WHERE id = ?";
                $this->db->query($sql, array($postURL, $postParentCat, $idCategory));
                $msg = alert('Saved changes');
            } elseif($result->url === $postURL) {
                $sql = "UPDATE 2d_categories SET title = ?, id_relation = ? WHERE id = ?";
                $this->db->query($sql, array(ucfirst($postTitle), $postParentCat, $idCategory));
                $msg = alert('Saved changes');
            }
        } else {
            $sql = "UPDATE 2d_categories SET title = ?, url = ?, id_relation = ? WHERE id = ?";
            $this->db->query($sql, array(ucfirst($postTitle), $postURL, $postParentCat, $idCategory));
            $msg = alert('Saved changes');
        }
        return $msg;
    }

    public function delCategorie($idCategory) 
    {
        $sql = "SELECT ga.id AS id_games FROM 2d_categories ca, 2d_games ga  WHERE ((ca.id = ?) AND (ca.id = ga.id_category))";
        $query = $this->db->query($sql, array($idCategory));
        if($result = $query->row()) {
            return alert('Warning! This category still contains games. You must change the category of these games before deleting.', 'danger');
        } else {
            $sql = 'DELETE FROM 2d_categories WHERE id = ?';
            $this->db->query($sql, array($idCategory));
            return alert('Category deleted');
        }
    }
}
