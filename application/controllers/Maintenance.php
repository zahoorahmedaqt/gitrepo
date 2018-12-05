<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Coffee Theme
*
* PHP version >= 5.4
*
* @category  PHP
* @package   Flashgames - PHP Script
* @author    Nicolas Grimonpont <support@coffeetheme.com>
* @copyright 2010-2017 Nicolas Grimonpont
* @license   Standard License
* @link      http://coffeetheme.com/
*/

class Maintenance extends CI_Controller
{

    public function index() 
    {
        $data['title'] = $this->config->item('sitename').' - Maintenance';
        $data['message'] = $this->config->item('maintenance_message');
        $content = $this->load->view('front/maintenance', $data, true);
        $this->load->view('landing', array('content' => $content));
    }
}
