<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
/*
	Converted to v7.0 by:
	
	php-Invent Team
	http://www.php-invent.com
	korrektur py piffpoff01
	Fehler Korrektur und Pubdate und Author eingefügt
	betatest@phpfusion-betatest.de
	Developer: SoBeNoFear (ianunruh@gmail.com)
*/
require_once(INFUSIONS.'/rss_parser_panel/toiso2.php');

if (!defined("IN_FUSION")) { die("Access Denied"); }

if (file_exists(INFUSIONS."rss_parser_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."rss_parser_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."rss_parser_panel/locale/Polish.php";
}
error_reporting(E_ALL ^ E_NOTICE);
global $p_data;
$SQL = 'SELECT * FROM '.$db_prefix.'rss_feeds WHERE name = "'.$p_data['panel_name'].'"';
$RES = dbquery($SQL);
$ROW = dbarray($RES);
if($ROW) {
	if($ROW['type'] == 2) {
		$file = BASEDIR.$ROW['file'];
	} else {
		$file = $ROW['file'];
	}
	$name = $ROW['name'];
	$cacheLimit = $ROW['cache_limit'];
	$numCenterItems = $ROW['num_items_center_panel'];
	$numSideItems = $ROW['num_items_side_panel'];
	$new_window = ($ROW['new_window'] == 1 ? '" target="_blank' : "");
} else {
	$file = '';
	$name = $locale['LAN_RSS_100'];
	$cacheLimit = 1;
}

if ($settings['maintenance'] != "1") {
	if($p_data['panel_side'] == 2) {
		opentable("");
		$titel=$name;
		echo ' <center><b>'.$titel.'</b></center><hr>';
			if(!include_once(INFUSIONS.'rss_parser_panel/parser.php')) {
				print $locale['LAN_RSS_101'];
			} elseif(empty($file)) {
				print $locale['LAN_RSS_102'];
			} elseif(!$rss_parser =& new rss_parser) {
				die('couldn\'t create object');
			} elseif(!$news = $rss_parser->parse($file, $numCenterItems, $cacheLimit)) {
				print $locale['LAN_RSS_103'];
			} else {
				$count_items = 0;
				foreach($news['news'] as $data) {

			
 					$newdate = strtotime($data['pubDate']);
					$datum = date ("d.m.Y  H:i" ,$newdate);
 					
					 print '<br /><br><b><a href="'.$data['link'].$new_window.'">'.$datum.' : '.toiso2($data['title']).'</a></b><br />'.toiso2($data['description']).'<br /><br>
					 '.$locale['LAN_RSS_105'].'  <b>'.$data['author'].'</b>  '.$data['copyright'].'<hr>';
					$count_items++;
				}
				if ($count_items == 0) {
					echo $locale['LAN_RSS_194'];
				}

				if($news['info']['cache_last_update'] < 3601) {
					$last_update = floor($news['info']['cache_last_update']/60).' '.$locale['LAN_RSS_192'];
				} elseif($news['info']['cache_last_update'] == 0) {
					$last_update = '0 '.$locale['LAN_RSS_192'];
				} else {
					$hours = floor(($news['info']['cache_last_update']/60)/60);
					$mins = floor($news['info']['cache_last_update']/60)-(60*$hours);
					$last_update = $hours.' '.$locale['LAN_RSS_193'].' '.$mins.' '.$locale['LAN_RSS_192'];
				}
				if($news['info']['cache_next_update'] < 3601) {
					$next_update = ceil($news['info']['cache_next_update']/60).' '.$locale['LAN_RSS_192'];
				} elseif($news['info']['cache_next_update'] == 0) {
					$next_update = $ROW['cache_limit'].' '.$locale['LAN_RSS_193'];
				} else {
					$hours = floor(($news['info']['cache_next_update']/60)/60);
					$mins = ceil($news['info']['cache_next_update']/60)-(60*$hours);
					$next_update = $hours.' '.$locale['LAN_RSS_193'].' '.$mins.' '.$locale['LAN_RSS_192'];
				}

				print '<table width="100%"><tr><td class="news-footer">'.$locale['LAN_RSS_190'].$last_update.'<br />'.
							$locale['LAN_RSS_191'].$next_update.'</td></tr></table>';
			}
		closetable();
	} else {
		openside($name);
			if(!include_once(INFUSIONS.'rss_parser_panel/parser.php')) {
				print $locale['LAN_RSS_101'];
			} elseif(empty($file)) {
				print $locale['LAN_RSS_102'];
			} elseif(!$rss_parser =& new rss_parser) {
				print $locale['LAN_RSS_104'];
			} elseif(!$news = $rss_parser->parse($file, $numSideItems, $cacheLimit)) {
				print $locale['LAN_RSS_103'];
			} else {
				print '<span class="small2">'; 
				foreach($news['news'] as $data) {
					$newdate = strtotime($data['pubDate']);
					$datum = date ("d.m.Y  H:i" ,$newdate);
					
			 print '<b><a href="'.$data['link'].$new_window.'">'.$datum.'<br /> '.toiso2($data['title']).'</a></b><br />'.nl2br(toiso2($data['description'])).'<br /><br />';
			}
				print '</span>';
			}
		closeside();
	}
}
?>