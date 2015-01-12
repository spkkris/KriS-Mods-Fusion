<?php
//	|---------------------------------------------------------------------------|
//	|	PHP-Fusion 7 Content Management System									|
//	|	Copyright © 2002 - 2005 Nick Jones										|
//	|	http://www.php-fusion.co.uk/											|
//	|---------------------------------------------------------------------------|
//	| 	This program is released as free software under the						|
//	| 	Affero GPL license. You can redistribute it and/or						|
//	| 	modify it under the terms of this license which you						|
//	| 	can read by viewing the included agpl.txt or online						|
//	| 	at www.gnu.org/licenses/agpl.html. Removal of this						|
//	| 	copyright header is strictly prohibited without							|
//	| 	written permission from the original author(s).							|
//	|---------------------------------------------------------------------------|
//	|	xShoutBox Panel															|
//	|	Copyright © 2008 Rizald 'Elyn' Maxwell									|
//	|	www.NubsPixel.com														|
//	|	Filename : functions.php												|
//	|	Read the source easier via Notepad++ 									|
//	|		comment fonts changed - Courrier New, 10pt							|
//	|---------------------------------------------------------------------------|
//	|	For more informations, please refer to README.TXT						|
//	|---------------------------------------------------------------------------|

$len = strlen(strstr(substr($_SERVER['PHP_SELF'],1,(strlen($_SERVER['PHP_SELF'])-1)),"/"));
$url = substr($_SERVER['PHP_SELF'], 0, strlen($_SERVER['PHP_SELF']) - $len +1);
if (eregi("infusions", $url)) {
   $url = "/";
}
$base = "http://".$_SERVER['HTTP_HOST'].$url;

function dump($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

function make_clickable($text){
	$ret = ' ' . $text;
	$ret = preg_replace("#(^|[\n ])\[(url|URL)=http://(.*?)\](.*?)\[\/(url|URL)\]#ise", "'\\1[<a href=\"http://\\3\" target=\"_blank\">\\4</a> ]'", $ret);
	$ret = preg_replace("#(^|[\n ])\[(url|URL)=(.*?)\](.*?)\[\/(url|URL)\]#ise", "'\\1[<a href=\"http://\\3\" target=\"_blank\">\\4</a> ]'", $ret);
	$ret = preg_replace("#(^|[\n ])\[(url|URL)\]http://(.*?)\[\/(url|URL)\]#ise", "'\\1[<a href=\"http://\\3\" target=\"_blank\">Click Here</a> ]'", $ret);
	$ret = preg_replace("#(^|[\n ])\[(url|URL)\](.*?)\[\/(url|URL)\]#ise", "'\\1[<a href=\"http://\\3\" target=\"_blank\">Click Here</a> ]'", $ret);
	$ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t<]*)#ise", "'\\1[<a href=\"\\2\" target=\"_blank\">Click Here</a> ]'", $ret);
	$ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r<]*)#ise", "'\\1[<a href=\"http://\\2\" target=\"_blank\">Click Here</a> ]'", $ret);
	$ret = preg_replace("#(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "\\1[<a href=\"mailto:\\2@\\3\">Mail to \\2</a> ]", $ret);
	$ret = substr($ret, 1);
	return($ret);
}


// Parse smiley bbcode
function parsesmileys2($message) {
	global $smiley_cache;
	if (!preg_match("#(\[code\](.*?)\[/code\]|\[geshi=(.*?)\](.*?)\[/geshi\]|\[php\](.*?)\[/php\])#si", $message)) {
		if (!$smiley_cache) { cache_smileys(); }
		if (is_array($smiley_cache) && count($smiley_cache)) {
			foreach ($smiley_cache as $smiley) {
				$smiley_code = preg_quote($smiley['smiley_code']);
				$smiley_image = "<img src='".get_image2("smiley_".$smiley['smiley_text'])."' alt='".$smiley['smiley_text']."' style='vertical-align:middle;' />";
				$message = preg_replace("#{$smiley_code}#si", $smiley_image, $message);
			}
		}
	}
	return $message;
}

cache_smileys();
$smiley_images2 = array();
foreach ($smiley_cache as $smiley) {
	$smiley_images2["smiley_".$smiley['smiley_text']] = $base."images/smiley/".$smiley['smiley_image'];
}

function get_image2($image, $alt = "", $style = "", $title = "", $atts = "") {
	global $smiley_images2;
	if (isset($smiley_images2[$image])) {
		$url = $smiley_images2[$image];
	} else {
		$url = $base."images/not_found.gif";
	}
	if (!$alt && !$style && !$title) {
		return $url;
	} else {
		return "<img src='".$url."' alt='".$alt."'".($style ? " style='$style'" : "").($title ? " title='".$title."'" : "")." ".$atts." />";
	}
}

function sbwrap($text) {
	
	$i = 0; $tags = 0; $chars = 0; $res = "";
	
	$str_len = strlen($text);
	
	for ($i = 0; $i < $str_len; $i++) {
		$chr = substr($text, $i, 1);
		if ($chr == "<") {
			if (substr($text, ($i + 1), 6) == "a href" || substr($text, ($i + 1), 3) == "img") {
				$chr = " ".$chr;
				$chars = 0;
			}
			$tags++;
		} elseif ($chr == "&") {
			if (substr($text, ($i + 1), 5) == "quot;") {
				$chars = $chars - 5;
			} elseif (substr($text, ($i + 1), 4) == "amp;" || substr($text, ($i + 1), 4) == "#39;" || substr($text, ($i + 1), 4) == "#92;") {
				$chars = $chars - 4;
			} elseif (substr($text, ($i + 1), 3) == "lt;" || substr($text, ($i + 1), 3) == "gt;") {
				$chars = $chars - 3;
			}
		} elseif ($chr == ">") {
			$tags--;
		} elseif ($chr == " ") {
			$chars = 0;
		} elseif (!$tags) {
			$chars++;
		}
		
		if (!$tags && $chars == 18) {
			$chr .= "<br />";
			$chars = 0;
		}
		$res .= $chr;
	}
	
	return $res;
}


function sbawrap($text) {
	
	$i = 0; $tags = 0; $chars = 0; $res = "";
	
	$str_len = strlen($text);
	
	for ($i = 0; $i < $str_len; $i++) {
		$chr = substr($text, $i, 1);
		if ($chr == "<") {
			if (substr($text, ($i + 1), 6) == "a href" || substr($text, ($i + 1), 3) == "img") {
				$chr = " ".$chr;
				$chars = 0;
			}
			$tags++;
		} elseif ($chr == "&") {
			if (substr($text, ($i + 1), 5) == "quot;") {
				$chars = $chars - 5;
			} elseif (substr($text, ($i + 1), 4) == "amp;" || substr($text, ($i + 1), 4) == "#39;" || substr($text, ($i + 1), 4) == "#92;") {
				$chars = $chars - 4;
			} elseif (substr($text, ($i + 1), 3) == "lt;" || substr($text, ($i + 1), 3) == "gt;") {
				$chars = $chars - 3;
			}
		} elseif ($chr == ">") {
			$tags--;
		} elseif ($chr == " ") {
			$chars = 0;
		} elseif (!$tags) {
			$chars++;
		}
		
		if (!$tags && $chars == 40) {
			$chr .= " ";
			$chars = 0;
		}
		$res .= $chr;
	}
	
	return $res;
}
?>