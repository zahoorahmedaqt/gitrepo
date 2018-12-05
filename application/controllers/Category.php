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

class Category extends CI_Controller
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
        $data['getCategories'] = $this->autoloadModel->getCategories();
        $data['getFooter'] = $this->autoloadModel->getFooter();
        $content = $this->load->view('front/template', $data, true);
        $this->load->model(array('categoryModel'));
    }

    public function index($getUrl = '', $getOrder = '', $getPag = '')
    {
        // Displaying all the games of this category
        $data = $this->categoryModel->getBlocsGame($getUrl, $getOrder, $getPag);
        // Displaying pagination
        $this->load->library('pagination');
        $segment3 = $this->uri->segment(3, 0);
        if($segment3 === 'news' || $segment3 === 'popular' || $segment3 === 'rated') {
            $segment3 = $segment3;
        } else {
            $segment3 = '';
        }
        $config["base_url"] = site_url('category/'.$data['cat_url'].'/'.$segment3);
        $config['total_rows'] = $data['nbRows'];
        $config['per_page'] = $this->config->item('cat_pag');
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        // Displaying title
        $data['title'] = $data['cat_title'].' Games - '.$this->config->item('sitename');
        // Recovery of the best games in the category by notes
        $data['getBestGamesNote'] = $this->categoryModel->getBestGamesNote($data['id_category']);
        // Recovery of the best games in the category by clicks
        $data['getBestGamesClic'] = $this->categoryModel->getBestGamesClic($data['id_category']);
        // Retrieving the latest comments
        $data['getComs'] = $this->categoryModel->getComs();
        $content = $this->load->view('front/category', $data, true);
        $this->load->view('front/template', array('content' => $content));
    }
}
