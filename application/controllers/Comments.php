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

class Comments extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!isset($this->session->admin)) {
            redirect('/login/');
        }
        $content = $this->load->view('dashboard/comments', array(), true);
        $this->load->model(array('commentsModel'));
    }

    public function index()
    {
        $data['title'] = $this->lang->line('comments');
        // Removing a comments
        $idComment = $this->input->get('del', true);
        $idUser = $this->input->get('id', true);
        if(isset($idComment) && !$this->config->item('demo')) {
            $this->commentsModel->delComment($idComment, $idUser);
        }
        // Show comments
        $data['getComments'] = $this->commentsModel->getComments();
        $content = $this->load->view('dashboard/comments', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }

    public function add()
    {
        $data['title'] = $this->lang->line('comments');
        // Processing the Add Form
        $postAuthor = $this->input->post('author', true);
        $postComment = $this->input->post('comment', true);
        $postGame = $this->input->post('game', true);
        if(isset($postAuthor) && isset($postComment) && isset($postGame) && !$this->config->item('demo')) {
            $data['msg'] = $this->commentsModel->addComment($postAuthor, $postComment, $postGame);
        }
        // Retrieving the list of users for the relations with the comments
        $data['getUsers'] = $this->commentsModel->getUsers();
        // Retrieving the list of games for the relations with the comments
        $data['getGames'] = $this->commentsModel->getGames();
        $content = $this->load->view('dashboard/comment_edit', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }

    public function edit($idComment = '')
    {
        $data['title'] = $this->lang->line('comments');
        // Processing the Change Form
        $postAuthor = $this->input->post('author', true);
        $postComment = $this->input->post('comment', true);
        $postGame = $this->input->post('game', true);
        if(isset($postAuthor) && isset($postComment) && isset($postGame) && !$this->config->item('demo')) {
            $data['msg'] = $this->commentsModel->editComment($idComment, $postAuthor, $postComment, $postGame);
        }
        // Retrieving comment data to display
        $data = array_merge($data, $this->commentsModel->getComment($idComment));
        // Retrieving the list of users for the relations with the comments
        $data['getUsers'] = $this->commentsModel->getUsers($data['id_user']);
        // Retrieving the list of games for the relationship with the comment
        $data['getGames'] = $this->commentsModel->getGames($data['id_game']);
        $content = $this->load->view('dashboard/comment_edit', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }
}
