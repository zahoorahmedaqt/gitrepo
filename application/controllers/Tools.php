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

class Tools extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!isset($this->session->admin)) {
            redirect('/login/');
        }
        $content = $this->load->view('dashboard/tools', array(), true);
        $this->load->model(array('toolsModel'));
        set_time_limit(0);
    }

    public function index()
    {
        $data['title'] = $this->lang->line('tools');
        $postCategory = $this->input->post('category', true);
        $postType = $this->input->post('type', true);
        $postSpilgames = $this->input->post('spilgames', true);
        $postGamepix = $this->input->post('gamepix', true);
        $post4j = $this->input->post('4j', true);
        $postTresensa = $this->input->post('tresensa', true);
        $postDel = (int)$this->input->post('del', true);

//        http://m.softgames.de/categories/latest-games.json
//        http://www.grabgamer.com/en/rss/feed.json
//        http://tgs.tresensa.com/server/0.3.9/feeds/?template=json
//        http://games.gamepix.com/games?pid=10010&sid=20010&order=d
//        https://publishing-api.poki.com/game/feed?f=thebestarcadescript
//        http://www.htmlgames.com/rss/games.php?json
//        TO SEE -> http://playdot.co/api?format=json&order=creation_desc&limit=800
//        TO SEE -> http://flashgamedistribution.com/feed.php?feed=json&gpp=5000&start=0
//        FLASH -> http://gamefeed.talkarcades.com/feed?format=json&feed_key=423f1293-585b-4854-8629-4a3c6b4c2708&order_by=released_on&order_type=desc&limit=1000&offset=0
//        FLASH -> http://arcadegamefeed.com/feed.php
//        FLASH -> http://www.freegamesforyourwebsite.com/feeds/games/?category=all&limit=900
//        FLASH -> http://www.freegamesforyourwebsite.com/feeds/games/?category=all&format=json&limit=all&language=en

        if($postSpilgames && !$this->config->item('demo')) {
            if ($postType == 1) {
                $url = 'http://publishers.spilgames.com/en/rss-3?format=json&platform=Crossplatform&limit=100&page=';
            } else {
                $url = 'http://publishers.spilgames.com/en/rss-3?format=json&limit=100&page=';
            }
            $getFeed = file_get_contents($url.'1');
            $json = json_decode($getFeed);
            $totalPage = $json->totalPages;
            for ($i = 1; $i <= (int)$totalPage; $i++) {
                $getFeed = file_get_contents($url.(string)$i);
                $json = json_decode($getFeed);
                foreach ($json->entries AS $value) {
                    $URL = url_title(convert_accented_characters($value->title), $separator = '-', $lowercase = true);
                    $URLCategorie = url_title(convert_accented_characters($value->category), $separator = '-', $lowercase = true);
                    if (!empty($value->category)) {
                        $idCategory = $this->toolsModel->checkCategory($value->category, $URLCategorie, $postCategory);
                    }
                    if ($value->thumbnails->medium != 'http://images.cdn.spilcloud.com/NULL') {
                        $this->toolsModel->addGame($value->title, $URL, $value->description, NULL, NULL, $value->thumbnails->medium, $idCategory, NULL, 1, $value->gameUrl, NULL, date("Y-m-d"), 'spilgames.com');
                    }
                }
                $data['msg'] = alert('Update finish');
            }
        }

        if($postGamepix && !$this->config->item('demo')) {
            $getFeed = file_get_contents('http://games.gamepix.com/games?pid=10010&sid=20010&order=d');
            $json = json_decode($getFeed);
            foreach ($json->data AS $value) {
                $URL = url_title(convert_accented_characters($value->title), $separator = '-', $lowercase = true);
                $URLCategorie = url_title(convert_accented_characters($value->category), $separator = '-', $lowercase = true);
                if (!empty($value->category)) {
                    $idCategory = $this->toolsModel->checkCategory($value->category, $URLCategorie, $postCategory);
                }
                $this->toolsModel->addGame($value->title, $URL, $value->description, NULL, NULL, $value->thumbnailUrl, $idCategory, NULL, 2, $value->url, $value->creation, $value->author);
            }
            $data['msg'] = alert('Update finish');
        }

        if($post4j && !$this->config->item('demo')) {
            for ($i = 1; $i < 20; $i++) {
                $getFeed = file_get_contents('http://w.4j.com/games.php?user=42&token=14wc4r0o8mcbr8nkq23vk71y1kc7gt6z&type=3&num=200&page='.$i);
                if($getFeed !== 'there is nothing') {
                    $json = json_decode($getFeed);
                    foreach ($json AS $value) {
                        $URL = url_title(convert_accented_characters($value->name), $separator = '-', $lowercase = true);
                        $URLCategorie = url_title(convert_accented_characters($value->category), $separator = '-', $lowercase = true);
                        if (!empty($value->category)) {
                            $idCategory = $this->toolsModel->checkCategory($value->category, $URLCategorie, $postCategory);
                        }
                        if (!empty($value->tags)) {
                            $idsKeywords = $this->toolsModel->checkTags($value->tags);
                        }
                        $this->toolsModel->addGame($value->name, $URL, $value->description, $value->control, NULL, $value->thumb, $idCategory, $idsKeywords, 3, $value->file, $value->publishDate, $value->site);
                    }
                } else {
                    break;
                }
            }
            $data['msg'] = alert('Update finish');
        }

        if($postTresensa && !$this->config->item('demo')) {
            $getFeed = file_get_contents('http://tgs.tresensa.com/server/0.3.9/feeds/?template=json');
            $json = json_decode($getFeed);
            foreach ($json->games AS $value) {
                $URLCategorie = url_title(convert_accented_characters($value->primary_category), $separator = '-', $lowercase = true);
                if (!empty($value->primary_category)) {
                    $idCategory = $this->toolsModel->checkCategory($value->primary_category, $URLCategorie, $postCategory);
                }
                if (!empty($value->keywords)) {
                    $idsKeywords = $this->toolsModel->checkTags($value->keywords);
                } else {
                    $idsKeywords = '';
                }
                $image = 'http://'.$value->slug.'.tresensa.com/screenshots/1_640x832.jpg';
                $this->toolsModel->addGame($value->title, $value->slug, $value->description, $value->instructions, $value->tips, $image, $idCategory, $idsKeywords, 4, $value->url, $value->release_date, 'tresensa.com');
            }
            $data['msg'] = alert('Update finish');
        }

        if($postDel === 1 || $postDel === 2 || $postDel === 3 || $postDel === 4 && !$this->config->item('demo')) {
            $this->toolsModel->delGame($postDel);
        }

        $getFeed = file_get_contents('');
        $data['json'] = json_decode($getFeed);

        $data['getCategories'] = $this->toolsModel->getCategories();

        $content = $this->load->view('dashboard/tools', $data, true);
        $this->load->view('dashboard/template', array('content' => $content));
    }
}
