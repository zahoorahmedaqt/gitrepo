<?php

class Header_Image_Model extends CI_Model
{
public function index(){

}
public function insert_image($image =''){
$this->load->database();
$query = $this->db->query('SELECT * FROM header_image');
var_dump($query);
}
}
