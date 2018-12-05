<?php

class ToolsModel extends CI_Model
{
    public function checkCategory($title, $URL, $postCategory)
    {
        $sql = "SELECT id FROM 2d_categories WHERE url = ?";
        $query = $this->db->query($sql, array($URL));
        if($result = $query->row()) {
            $sql = "UPDATE 2d_categories SET id_relation = ? WHERE id = ?";
            $this->db->query($sql, array($postCategory, $result->id));
            $idCategory = $result->id;
        } else {
            $sql = "INSERT INTO 2d_categories (title, url, id_relation) VALUES (?, ?, ?)";
            $this->db->query($sql, array($title, $URL, $postCategory));
            $idCategory = $this->db->affected_rows();
        }
        return $idCategory;
    }

    public function checkTags($tags)
    {
        $tags = explode(',', $tags);
        $idsKeywords = '';
        $i = 0;
        foreach ($tags as $tag) {
            $i++;
            $URLTag = url_title(convert_accented_characters($tag), $separator = '-', $lowercase = true);
            $sql = "SELECT id FROM 2d_keywords WHERE url = ?";
            $query = $this->db->query($sql, array($URLTag));
            if($result = $query->row()) {
                $idsKeywords .= $result->id.(($i !== count($tags)) ? ', ' : '');
            } else {
                $sql = "INSERT INTO 2d_keywords (title, url) VALUES (?, ?)";
                $this->db->query($sql, array($tag, $URLTag));
                $idsKeywords .= $this->db->affected_rows().(($i !== count($tags)) ? ', ' : '');
            }
        }
        return $idsKeywords;
    }

    public function addGame($title, $URL, $description, $control, $tips, $image, $idCategory, $idsKeywords, $import, $embed, $datePublish, $author)
    {
        $datePublish = ($datePublish) ? $datePublish : date("Y-m-d H:i:s");
        $sql = "SELECT id, title, url FROM 2d_games WHERE title = ? OR url = ?";
        $query = $this->db->query($sql, array($title, $URL));
        if($result = $query->row()) {
            $sql = "UPDATE 2d_games SET description = ?, control = ?, tips = ?, image = ?, type = ?, import = ?, embed = ?, id_category = ?, ids_keywords = ?, author = ? WHERE id = ?";
            $this->db->query($sql, array($description, $control, $tips, $image, 0, $import, $embed, $idCategory, $idsKeywords, $author, $result->id));
        } else {
            $sql = "INSERT INTO 2d_games (title, url, description, control, tips, image, type, import, embed, id_category, author, date_upload, date_publish) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $this->db->query($sql, array($title, $URL, $description, $control, $tips, $image, 0, $import, $embed, $idCategory, $author, date("Y-m-d H:i:s"), $datePublish));
        }
    }

    public function getCategories()
    {
        $getCategories = '';
        $sql = "SELECT id, title FROM 2d_categories";
        $query = $this->db->query($sql);
        foreach ($query->result() as $row) {
            $getCategories .= '<option value="'.$row->id.'">'.$row->title.'</option>';
        }
        return $getCategories;
    }

    public function delGame($import)
    {
        $sql = "SELECT id FROM 2d_games WHERE import = ?";
        $query = $this->db->query($sql, array($import));
        foreach ($query->result() as $row) {
            // Removing comments related to the game
            $sql = 'DELETE FROM 2d_comments WHERE id_game = ?';
            $this->db->query($sql, array($row->id));
            // Removing favorites related to the game
            $sql = 'DELETE FROM 2d_favorites WHERE id_game = ?';
            $this->db->query($sql, array($row->id));
            // Removing notes related to the game
            $sql = 'DELETE FROM 2d_notes WHERE id_game = ?';
            $this->db->query($sql, array($row->id));
            // Removing the game
            $sql = 'DELETE FROM 2d_games WHERE id = ?';
            $this->db->query($sql, array($row->id));
        }
    }
}
