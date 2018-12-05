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

class User extends CI_Controller
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
        $data['title'] = ' - '.$this->config->item('sitename');
        $data['getCategories'] = $this->autoloadModel->getCategories();
        $data['getFooter'] = $this->autoloadModel->getFooter();
        $content = $this->load->view('front/template', $data, true);
        $this->load->model(array('userModel'));
    }

    public function index($getUrl = '') 
    {
        // Deleting comment
        $postDelCom = $this->input->get('del', true);
        if(isset($this->session->id) && (!empty($postDelCom)) && !$this->config->item('demo')) {
            $this->userModel->delCom($postDelCom, $this->session->id);
        }
        // View user's profile
        $data = $this->userModel->getUserData($getUrl);
        $data['title'] = $data['username'].' - '.$this->config->item('sitename');
        // Comment form processing
        $postCom = $this->input->post('com_message', true);
        if(isset($this->session->id) && ($postCom) != '') {
            $this->userModel->addCom($data['id'], $postCom);
        }
        // Viewing favorite games
        $data = array_merge($data, $this->userModel->getFavsGames($data['id']));
        // Viewing User Game Notes
        $data = array_merge($data, $this->userModel->getNotesGames($data['id']));
        // Viewing user's game comments
        $data = array_merge($data, $this->userModel->getComsGames($data['id']));
        // Retrieving User Profile Comments
        $data['getComsProfile'] = $this->userModel->getComsProfile($data['id']);
        $content = $this->load->view('front/user', $data, true);
        $this->load->view('front/template', array('content' => $content));
    }

    public function favorites($getUrl = '', $getPag = '')
    {
        // View user's profile
        $data = $this->userModel->getUserData($getUrl);
        $data['title'] = 'All the favorites of '.$data['username'].' - '.$this->config->item('sitename');
        // Viewing favorite games
        $data = array_merge($data, $this->userModel->getFavsGames($data['id'], $getPag, $this->config->item('more_pag')));
        $this->load->library('pagination');
        $config["base_url"] = site_url('/user/favorites/'.$data['url'].'/');
        $config['total_rows'] = $data['nbRows'];
        $config['per_page'] = $this->config->item('more_pag');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $content = $this->load->view('front/user_detail', $data, true);
        $this->load->view('front/template', array('content' => $content));
    }

    public function notes($getUrl = '', $getPag = '')
    {
        // View user's profile
        $data = $this->userModel->getUserData($getUrl);
        $data['title'] = 'All the notes of '.$data['username'].' - '.$this->config->item('sitename');
        // Viewing User Game Notes
        $data = array_merge($data, $this->userModel->getNotesGames($data['id'], $getPag, $this->config->item('more_pag')));
        $this->load->library('pagination');
        $config["base_url"] = site_url('/user/notes/'.$data['url'].'/');
        $config['total_rows'] = $data['nbRows'];
        $config['per_page'] = $this->config->item('more_pag');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $content = $this->load->view('front/user_detail', $data, true);
        $this->load->view('front/template', array('content' => $content));
    }

    public function comments($getUrl = '', $getPag = '')
    {
        // Deleting comment
        $postDelCom = $this->input->get('del', true);
        if(isset($this->session->id) && (!empty($postDelCom)) && !$this->config->item('demo')) {
            $this->userModel->delCom($postDelCom, $this->session->id);
        }
        // View user's profile
        $data = $this->userModel->getUserData($getUrl);
        $data['title'] = 'All the comments of '.$data['username'].' - '.$this->config->item('sitename');
        // Viewing user's game comments
        $data = array_merge($data, $this->userModel->getComsGames($data['id'], $getPag, $this->config->item('more_pag')));
        $this->load->library('pagination');
        $config["base_url"] = site_url('/user/comments/'.$data['url'].'/');
        $config['total_rows'] = $data['nbRows'];
        $config['per_page'] = $this->config->item('more_pag');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $content = $this->load->view('front/user_detail', $data, true);
        $this->load->view('front/template', array('content' => $content));
    }
}
