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

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!isset($this->session->admin)) {
            redirect('/login/');
        }
        $content = $this->load->view('dashboard/home', array(), true);
        $this->load->model(array('dashboardModel'));
    }

    public function index()
    {
        $data['title'] = $this->lang->line('dashboard');
        $data['nbMembers'] = $this->dashboardModel->getNbMembers();
        $data['statsMembers'] = $this->dashboardModel->getStatsMembers();
        $data['nbComments'] = $this->dashboardModel->getNbComments();
        $data['statsComments'] = $this->dashboardModel->getStatsComments();
        $data['nbPlayed'] = $this->dashboardModel->getNbPlayed();
        $data['statsPlayed'] = $this->dashboardModel->getStatsPlayed();
        $data['lastMonthPlayed'] = $this->dashboardModel->getStatsPlayed(false);
        $data['getBestPlayedGames'] = $this->dashboardModel->getBestPlayedGames($data['nbPlayed']);
        $data['getLastGamesAdded'] = $this->dashboardModel->getLastGamesAdded();
        $data['getLastcomments'] = $this->dashboardModel->getLastcomments();
        $content = $this->load->view('dashboard/home', $data, true);       
        $this->load->view('dashboard/template', array('content' => $content));
    }
     
}
