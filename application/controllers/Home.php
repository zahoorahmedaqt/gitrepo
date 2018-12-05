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

class Home extends CI_Controller
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
        $data['title'] = $this->config->item('sitename').' - '.$this->config->item('description');
        $data['getCategories'] = $this->autoloadModel->getCategories();
        $data['getFooter'] = $this->autoloadModel->getFooter();
        $content = $this->load->view('front/template', $data, true);
        $this->load->model(array('homeModel'));
    }

    public function index($getOrder = '', $getPag = '')
    {
        // Displaying all the games with pagination
        $data = $this->homeModel->getBlocsGame($getOrder, $getPag);
        // Displaying pagination
        $this->load->library('pagination');
        $segment2 = $this->uri->segment(1, 0);
        if($segment2 === 'news' || $segment2 === 'popular' || $segment2 === 'rated') {
            $segment2 = $segment2;
        } else {
            $segment2 = '';
        }
        $config["base_url"] = site_url($segment2);
        $config['total_rows'] = $data['nbRows'];
        $config['per_page'] = $this->config->item('home_pag');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $content = $this->load->view('front/home', $data, true);
        $this->load->view('front/template', array('content' => $content));
    }
}
