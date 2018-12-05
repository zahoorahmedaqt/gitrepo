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

class Game extends CI_Controller
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
        $this->load->model(array('gameModel'));
    }

    public function show($getUrl = '', $getPag = '')
    {
        // Get game data
        $data = $this->gameModel->getGame($getUrl);
        $data['title'] = $data['title_game'].' - '.$data['category'].' - '.$this->config->item('description');
        // Get best games of the category (note)
        $data['getBestGamesNote'] = $this->gameModel->getBestGamesNote($data['id_category']);
        // Get best games in the category (click)
        $data['getBestGamesClic'] = $this->gameModel->getBestGamesClic($data['id_category']);
        // Get users who have the game in favorite
        $data['getUsersFav'] = $this->gameModel->getUsersFav($data['id']);
        // Comment form processing
        $postCom = $this->input->post('com_message', true);
        $postRelated = $this->input->post('related', true);
        if(isset($this->session->id) && ($postCom) != '') {
            $this->gameModel->addCom($data['id'], $postCom, $postRelated);
        }
        // Add / remove site to favorites
        $postFav = $this->input->get('fav', true);
        if($postFav != '' && isset($this->session->id)) {
            if($postFav === 'add') {
                $this->gameModel->addFav($data['id']);
            }
            if($postFav === 'del') {
                $this->gameModel->delFav($data['id']);
            }
        }
        // Get average score
        $data = array_merge($data, $this->gameModel->getNote($data['id']));
        // Get keywords
        $data['getKeywords'] = $this->gameModel->getKeywords($data['ids_keywords']);
        // Get user data (game as favorites)
        if(isset($this->session->id)) {
            $data['getFav'] = $this->gameModel->getFav($data['id']);
        } else {
            $data['getFav'] = 0;
        }
        // Get comments with pagination
        $data['getBestComs'] = $this->gameModel->getComs($data['id'], $getPag, true);
        $data = array_merge($data, $this->gameModel->getComs($data['id'], $getPag));
        $data['getPagination'] = $this->createPagination(site_url('game/show/'.$data['url'].'/'), $data['nbRows'], $this->config->item('coms_pag'));
        $content = $this->load->view('front/game', $data, true);
        $this->load->view('front/template', array('content' => $content));
    }

    public function play($getUrl = '', $getPag = '')
    {
        // Get game data
        $data = $this->gameModel->getGame($getUrl);
        $data['title'] = $data['title_game'].' - '.$data['category'].' - '.$this->config->item('description');
        // Added game statistics (nb of * played)
        $this->gameModel->updateGameStat($data['id']);
        // Get games of the category (note)
        $data['getBestGamesNote'] = $this->gameModel->getBestGamesNote($data['id_category']);
        // Get games in the category (click)
        $data['getBestGamesClic'] = $this->gameModel->getBestGamesClic($data['id_category']);
        // Get users who have the game in favorite
        $data['getUsersFav'] = $this->gameModel->getUsersFav($data['id']);
        // Comment form processing
        $postCom = $this->input->post('com_message', true);
        $postRelated = $this->input->post('related', true);
        if(isset($postCom) && ($postCom != '')) {
            $this->gameModel->addCom($data['id'], $postCom, $postRelated);
        }
        // Add / remove site to favorites
        $postFav = $this->input->get('fav', true);
        if($postFav != '' && isset($this->session->id)) {
            if($postFav === 'add') {
                $this->gameModel->addFav($data['id']);
            }
            if($postFav === 'del') {
                $this->gameModel->delFav($data['id']);
            }
        }
        // Get average score
        $data = array_merge($data, $this->gameModel->getNote($data['id']));
        // Get keywords
        $data['getKeywords'] = $this->gameModel->getKeywords($data['ids_keywords']);
        // Get user data (game as favorites)
        if(isset($this->session->id)) {
            $data['getFav'] = $this->gameModel->getFav($data['id']);
        } else {
            $data['getFav'] = 0;
        }
        // Get comments with pagination
        $data['getBestComs'] = $this->gameModel->getComs($data['id'], $getPag, true);
        $data = array_merge($data, $this->gameModel->getComs($data['id'], $getPag));
        $data['getPagination'] = $this->createPagination(site_url('game/show/'.$data['url'].'/'), $data['nbRows'], $this->config->item('coms_pag'));
        $content = $this->load->view('front/game_play', $data, true);
        $this->load->view('front/template', array('content' => $content));
    }

    public function createPagination($baseUrl, $totalRows, $perPage)
    {
        $this->load->library('pagination');
        $config["base_url"] = $baseUrl;
        $config['total_rows'] = $totalRows;
        $config['per_page'] = $perPage;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    // Update of the note via Jquery
    public function updateNote($idGame, $score)
    {
        if(isset($this->session->id)) {
            $this->gameModel->updateNote($idGame, $score);
        }
    }

    // Update likes in comments via Jquery
    public function likesComs($idCom, $likeType)
    {
        if(isset($this->session->id)) {
            $this->gameModel->likesComs($idCom, $likeType);
        }
    }
}
