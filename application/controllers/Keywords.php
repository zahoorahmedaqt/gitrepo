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

class Keywords extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!isset($this->session->admin)) {
            redirect('/login/');
        }
        $content = $this->load->view('dashboard/keywords', array(), true);
        $this->load->model(array('keywordsModel'));
    }

    public function index()
    {
        $data['title'] = $this->lang->line('keywords');
        // Removing a keyword
        $idKeyword = $this->input->get('del', true);
        if(isset($idKeyword) && !$this->config->item('demo')) {
            $data['msg'] = $this->keywordsModel->delKeyword($idKeyword);
        }
        // View keywords
        $data['getKeywords'] = $this->keywordsModel->getKeywords();
        $content = $this->load->view('dashboard/keywords', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }

    public function add()
    {
        $data['title'] = $this->lang->line('keywords');
        // Processing the Add Form
        $postTitle = $this->input->post('title', true);
        $postURL = $this->input->post('url', true);
        if(isset($postTitle) && ($postTitle) != '' && !$this->config->item('demo')) {
            if($postURL == '') {
                $postURL = url_title(convert_accented_characters($postTitle), $separator = '-', $lowercase = true);
            } else {
                $postURL = url_title(convert_accented_characters($postURL), $separator = '-', $lowercase = true);
            }
            $data['msg'] = $this->keywordsModel->addKeyword($postTitle, $postURL);
        }
        $content = $this->load->view('dashboard/keyword_edit', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }

    public function edit($idKeyword = '')
    {
        $data['title'] = $this->lang->line('keywords');
        // Processing the Change Form
        $postTitle = $this->input->post('title', true);
        $postURL = $this->input->post('url', true);
        if(isset($postTitle) && ($postTitle) != '' && !$this->config->item('demo')) {
            if($postURL == '') {
                $postURL = url_title(convert_accented_characters($postTitle), $separator = '-', $lowercase = true);
            } else {
                $postURL = url_title(convert_accented_characters($postURL), $separator = '-', $lowercase = true);
            }
            $data['msg'] = $this->keywordsModel->editKeyword($idKeyword, $postTitle, $postURL);
        }
        // Retrieving keyword data
        $data = $this->keywordsModel->getKeyword($idKeyword);
        $content = $this->load->view('dashboard/keyword_edit', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }
}
