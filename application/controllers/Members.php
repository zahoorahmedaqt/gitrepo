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

class Members extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        if($this->config->item('cache_activation') === 1) {
            $this->output->cache($this->config->item('cache_expire'));
        }
        if($this->config->item('cache_activation') === 2) {
            $this->output->delete_cache();
        }
        $data['title'] = 'Members - '.$this->config->item('sitename');
        $data['getCategories'] = $this->autoloadModel->getCategories();
        $data['getFooter'] = $this->autoloadModel->getFooter();
        $content = $this->load->view('front/template', $data, true);
        $this->load->model(array('membersModel'));
    }

    public function index() 
    {
        // Displaying all the games with pagination
        $data['getMembersNotes'] = $this->membersModel->getMembersNotes();
        $data['getMembersFavs'] = $this->membersModel->getMembersFavs();
        $data['getMembersComs'] = $this->membersModel->getMembersComs();
        $content = $this->load->view('front/members', $data, true);
        $this->load->view('front/template', array('content' => $content));
    }
}
