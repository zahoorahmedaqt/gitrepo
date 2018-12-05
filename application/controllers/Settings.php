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

class Settings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if(!isset($this->session->admin)) {
            redirect('/login/');
        }
        $this->load->model(array('settingsModel'));
    }

    public function index()
    {
        $data['title'] = $this->lang->line('generalSettings');
        $postTerms = $this->input->post('termsOfUse', true);
        $this->load->helper('file');
        if(array_key_exists('sitename', $_POST) && !$this->config->item('demo')) {
            $file = '<'.'?php'."\n";
            $file .= 'defined("BASEPATH") OR exit("No direct script access allowed");'."\n";
            $file .= '$config["sitename"] = \''.convertTexte($_POST['sitename']).'\';'."\n";
            $file .= '$config["logo"] = \''.convertTexte($_POST['logo']).'\';'."\n";
            $file .= '$config["emailsite"] = "'.$_POST['emailsite'].'";'."\n";
            $file .= '$config["valide_inscrit"] = "'.$_POST['valide_inscrit'].'";'."\n";
            $file .= '$config["maintenance"] = '.($_POST['maintenance']?'TRUE':'FALSE').';'."\n";
            $file .= '$config["maintenance_message"] = "'.convertTexte($_POST['maintenance_message']).'";'."\n";
            $file .= '$config["facebook"] = "'.$_POST['facebook'].'";'."\n";
            $file .= '$config["twitter"] = "'.$_POST['twitter'].'";'."\n";
            $file .= '$config["google"] = "'.$_POST['google'].'";'."\n";
            $file .= '$config["roms"] = '.($_POST['roms']?'TRUE':'FALSE').';'."\n";
            $file .= '$config["terms"] = "'.$postTerms.'";'."\n";
            $file .= '?'.'>';
            if(!write_file('./application/config/general_settings.php', $file)) {
                $msg = '<div class="alert alert-danger" role="alert">
							<strong>Ooops !</strong> Unable to write the file
						</div>';
            } else {
                redirect(current_url().'/', 'location');
            }
        }
        $data['getPages'] = $this->settingsModel->getPages();
        $content = $this->load->view('dashboard/general_settings', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }

    public function mail()
    {
        $data['title'] = $this->lang->line('mailSettings');
        $this->load->helper('file');
        if(array_key_exists('titleMailConfirmation', $_POST) && !$this->config->item('demo')) {
            $file = '<'.'?php'."\n";
            $file .= 'defined("BASEPATH") OR exit("No direct script access allowed");'."\n";
            $file .= '$config["titleMailConfirmation"] = \''.convertTexte($_POST['titleMailConfirmation']).'\';'."\n";
            $file .= '$config["mailConfirmation"] = \''.convertTexte($_POST['mailConfirmation']).'\';'."\n";
            $file .= '$config["titleMailWelcome"] = \''.convertTexte($_POST['titleMailWelcome']).'\';'."\n";
            $file .= '$config["mailWelcome"] = \''.convertTexte($_POST['mailWelcome']).'\';'."\n";
            $file .= '$config["titleMailRecovery"] = \''.convertTexte($_POST['titleMailRecovery']).'\';'."\n";
            $file .= '$config["mailRecovery"] = \''.convertTexte($_POST['mailRecovery']).'\';'."\n";
            $file .= '$config["titleMailPasswordChanged"] = \''.convertTexte($_POST['titleMailPasswordChanged']).'\';'."\n";
            $file .= '$config["mailPasswordChanged"] = \''.convertTexte($_POST['mailPasswordChanged']).'\';'."\n";
            $file .= '?'.'>';
            if(!write_file('./application/config/mail_settings.php', $file)) {
                $msg = '<div class="alert alert-danger" role="alert">
							<strong>Ooops !</strong> Unable to write the file
						</div>';
            } else {
                redirect(current_url().'/', 'location');
            }
        }
        $content = $this->load->view('dashboard/mail_settings', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }

    public function seo()
    {
        $data['title'] = $this->lang->line('seoSettings');
        $this->load->helper('file');
        if(array_key_exists('author', $_POST) && !$this->config->item('demo')) {
            $file = '<'.'?php'."\n";
            $file .= 'defined("BASEPATH") OR exit("No direct script access allowed");'."\n";
            $file .= '$config["author"] = \''.convertTexte($_POST['author']).'\';'."\n";
            $file .= '$config["keywords"] = \''.convertTexte($_POST['keywords']).'\';'."\n";
            $file .= '$config["description"] = \''.convertTexte($_POST['description']).'\';'."\n";
            $file .= '$config["home_nb"] = "'.$_POST['home_nb'].'";'."\n";
            $file .= '$config["cat_nb"] = "'.$_POST['cat_nb'].'";'."\n";
            $file .= '$config["home_pag"] = "'.$_POST['home_pag'].'";'."\n";
            $file .= '$config["cat_pag"] = "'.$_POST['cat_pag'].'";'."\n";
            $file .= '$config["coms_pag"] = "'.$_POST['coms_pag'].'";'."\n";
            $file .= '$config["more_pag"] = "'.$_POST['more_pag'].'";'."\n";
            $file .= '$config["google_analytics"] = \''.convertTexte($_POST['google_analytics']).'\';'."\n";
            $file .= '$config["cache_activation"] = '.$_POST['cache_activation'].';'."\n";
            $file .= '$config["cache_expire"] = "'.$_POST['cache_expire'].'";'."\n";
            $file .= '?'.'>';
            if(!write_file('./application/config/seo_settings.php', $file)) {
                $msg = '<div class="alert alert-danger" role="alert">
							<strong>Ooops !</strong> Unable to write the file
						</div>';
            } else {
                redirect(current_url('').'/', 'location');
            }
        }
        // Creating the Sitemap
        if(isset($_POST["sitemap"]) && !$this->config->item('demo')) {
             $entete = '<?xml version="1.0" encoding="UTF-8"?'.'>'."\n".'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
              $corps = '';
            $corps .= '<url><loc>'.site_url().'</loc></url>';
            $corps .= '<url><loc>'.site_url('login/').'</loc></url>';
            $corps .= '<url><loc>'.site_url('login/register/').'</loc></url>';
            $corps .= '<url><loc>'.site_url('login/recovery/').'</loc></url>';
            $corps .= '<url><loc>'.site_url('members/').'</loc></url>';
            // List of pages
            $sql = "SELECT url FROM 2d_pages";
            $query = $this->db->query($sql);
            foreach ($query->result() as $row) {
                $corps .= '<url><loc>'.site_url('page/'.$row->url.'/').'</loc></url>';
            }
            // List of categories
            $sql = "SELECT url FROM 2d_categories";
            $query = $this->db->query($sql);
            foreach ($query->result() as $row) {
                $corps .= '<url><loc>'.site_url('category/'.$row->url.'/').'</loc></url>';
            }
            // List of games
            $sql = "SELECT url FROM 2d_games";
            $query = $this->db->query($sql);
            foreach ($query->result() as $row) {
                $corps .= '<url><loc>'.site_url('game/show/'.$row->url.'/').'</loc></url>';
                $corps .= '<url><loc>'.site_url('game/play/'.$row->url.'/').'</loc></url>';
            }
            // List of members
            $sql = "SELECT url FROM 2d_users";
            $query = $this->db->query($sql);
            foreach ($query->result() as $row) {
                $corps .= '<url><loc>'.site_url('user/'.$row->url.'/').'</loc></url>';
            }
              $flux = $entete.$corps.'</urlset>';
            if(!write_file('./sitemap.xml', $flux)) {
                $msg2 = '<div class="alert alert-danger" role="alert">
							<strong>Ooops !</strong> Unable to write the file
						</div>';
            } else {
                $msg2 = '<div class="alert alert-icon alert-success alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="TRUE">×</span>
							</button>
							<i class="mdi mdi-check-all"></i>
							<strong>Congratulations !</strong> Your Sitemap has been successfully generated.
					  	</div>';
            }
        }
        $content = $this->load->view('dashboard/seo_settings', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }

    public function advertisements()
    {
        $data['title'] = $this->lang->line('adsSettings');
        $this->load->helper('file');
        if(array_key_exists('sidebartop', $_POST) && !$this->config->item('demo')) {
            $file = '<'.'?php'."\n";
            $file .= 'defined("BASEPATH") OR exit("No direct script access allowed");'."\n";
            $file .= '$config["sidebartop"] = \''.convertTexte($_POST['sidebartop']).'\';'."\n";
            $file .= '$config["sidebarbottom"] = \''.convertTexte($_POST['sidebarbottom']).'\';'."\n";
            $file .= '$config["sidebarcontent"] = \''.convertTexte($_POST['sidebarcontent']).'\';'."\n";
            $file .= '?'.'>';
            if(!write_file('./application/config/ads_settings.php', $file)) {
                $msg = '<div class="alert alert-danger" role="alert">
							<strong>Ooops !</strong> Unable to write the file
						</div>';
            } else {
                redirect(current_url().'/', 'location');
            }
        }
        $content = $this->load->view('dashboard/ads_settings', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }

}
