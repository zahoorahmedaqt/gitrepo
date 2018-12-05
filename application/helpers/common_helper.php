<?php

function alert($msg, $color = 'success') 
{
    return '<div class="alert alert-'.$color.'">
				<strong>'.$msg.'</strong>
			</div>';
}

function trim_max($text, $size = 50) 
{
    return substr($text, 0, $size) . ' ...';
}

function convertTexte($text) 
{
    if (get_magic_quotes_gpc()) {
        $text = stripslashes($text);
    }
    $text = str_replace("'", "\'", $text);
    return $text;
}

function checkUrl($url, $seg1) 
{
    $segUrl = explode('/', filter_var($url, FILTER_VALIDATE_URL));
    if(isset($segUrl[2]) && $segUrl[2] == $seg1) {
        return $url;
    } else {
        return null;
    }
}

function emul($console, $aspect)
{
    if($console === 'nes') {
        $size = (($aspect === 'width') ? '513' : '480');
    } elseif($console === 'snes') {
        $size = (($aspect === 'width') ? '512' : '448');
    } elseif($console === 'sega') {
        $size = (($aspect === 'width') ? '640' : '448');
    } elseif($console === 'gb') {
        $size = (($aspect === 'width') ? '320' : '288');
    } elseif($console === 'gba') {
        $size = (($aspect === 'width') ? '480' : '320');
    }
    return $size;
}

function rating($nb, $class = '')
{
    $is_int = (is_int($nb))?0:1;
    $i = $j = ceil($nb);
    $rating = '<div class="'.$class.' rating">
	            	<ul class="list-inline">';
    for ($i; $i > $is_int; $i--) {
        $rating .= '<li><a class="fa fa-star"></a></li>';
    }
    $rating .= (is_int($nb))?'':'<li><a class="fa fa-star-half-o"></a></li>';
    for ($j; $j < 5; $j++) {
        $rating .= '<li><a class="fa fa-star-o"></a></li>';
    }
    $rating .= '	</ul>
				</div>';                   
    return $rating;
}

function random($car) 
{
    $string = "";
    $chaine = "abcdefghijklmnpqrstuvwxy0123456789";
    srand((double)microtime()*1000000);
    for($i=0; $i<$car; $i++) {
        $string .= $chaine[rand()%strlen($chaine)];
    }
    return $string;
}

function share($url = '', $title = '', $description = '')
{
    $share = '<a class="btn btn-facebook waves-effect waves-light m-r-5" href="http://www.facebook.com/sharer.php?u='.$url.'&t='.$title.'" target="_blank"> <span class="btn-label"><i class="fa fa-facebook"></i> </span>Facebook</a>';
    $share .= '<a class="btn btn-twitter waves-effect waves-light m-r-5" href="https://twitter.com/share?url='.$url.'&text='.$description.'" target="_blank"> <span class="btn-label"><i class="fa fa-twitter"></i> </span>Twitter</a>';
    $share .= '<a class="btn btn-googleplus waves-effect waves-light m-r-5" href="https://plus.google.com/share?url='.$url.'" target="_blank"> <span class="btn-label"><i class="fa fa-google"></i> </span>Google</a>';
    $share .= '<a class="btn btn-tumblr waves-effect waves-light m-r-5" href="http://www.tumblr.com/share?v=3&u='.$url.'&t='.$title.'&s=" target="_blank"> <span class="btn-label"><i class="fa fa-tumblr"></i> </span>Tumblr</a>';
    $share .= '<a class="btn btn-pinterest waves-effect waves-light m-r-5" href="http://pinterest.com/pin/create/button/?url='.$url.'&description='.$description.'" target="_blank"> <span class="btn-label"><i class="fa fa-pinterest"></i> </span>Pinterest</a>';
    $share .= '<a class="btn btn-reddit waves-effect waves-light m-r-5" href="http://reddit.com/submit?url='.$url.';title='.$title.'" target="_blank"> <span class="btn-label"><i class="fa fa-reddit-alien"></i> </span>Reddit</a>';
    $share .= '<a class="btn btn-linkedin waves-effect waves-light" href="mailto:?subject='.$title.'&body='.$title.':'.$url.'" target="_blank"> <span class="btn-label"> <i class="fa fa-send"></i> </span>Email</a>';
    return $share;
}
