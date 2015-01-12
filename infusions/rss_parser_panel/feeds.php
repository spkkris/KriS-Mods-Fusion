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
   
   Developer: SoBeNoFear (ianunruh@gmail.com)
*/
require_once "../../maincore.php";
require_once THEMES."templates/header.php";
require_once(INFUSIONS.'/rss_parser_panel/parser.php');
require_once(INFUSIONS.'/rss_parser_panel/toiso2.php');

if (file_exists(INFUSIONS."rss_parser_panel/locale/".$settings['locale'].".php")) {
   include INFUSIONS."rss_parser_panel/locale/".$settings['locale'].".php";
} else {
   include INFUSIONS."rss_parser_panel/locale/Polish.php";
}

error_reporting(E_ALL ^ E_NOTICE);

if(isset($_GET['feed'])) {
   $id = stripinput($_GET['feed']);
   $SQL = 'SELECT * FROM '.$db_prefix.'rss_feeds WHERE id="'.$id.'"';
   $RES = dbquery($SQL);
   if($RES) {
      $ROW = dbarray($RES);
      opentable($ROW['name']);
      if(!$rss_parser =& new rss_parser) {
         die('couldn\'t create object');
      } elseif(!$news = $rss_parser->parse($ROW['file'], '', $ROW['cache_limit'])) {
         print $locale['LAN_RSS_103'];
      } else {
         foreach($news['news'] as $data) {
            $new_window = ($ROW['new_window'] == 1 ? '" target="_blank' : "");

            print '<b><a href="'.$data['link'].$new_window.'"><a href="'.$data['pubDate'].':"> '.toiso2($data['title']).'</a></a></b><br />'.nl2br(toiso2($data['description'])).'<br /><br />';
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
            $next_update = $ROW['cacle_limit'].' '.$locale['LAN_RSS_193'];
         } else {
            $hours = floor(($news['info']['cache_next_update']/60)/60);
            $mins = ceil($news['info']['cache_next_update']/60)-(60*$hours);
            $next_update = $hours.' '.$locale['LAN_RSS_193'].' '.$mins.' '.$locale['LAN_RSS_192'];
         }
         print '</td></tr><tr><td class="news-footer">'.$locale['LAN_RSS_190'].$last_update.'<br />'.
                  $locale['LAN_RSS_191'].$next_update;
      }
      closetable();
   } else {
      header("Location: feeds_page.php");
   }
} else {
   $SQL = 'SELECT * FROM '.$db_prefix.'rss_feeds WHERE in_feeds_page="1" ORDER BY page_order ASC';
   $RES = dbquery($SQL);
   $NUM_ROWS = dbrows($RES);
   if($NUM_ROWS > 0) {
      while($ROW = dbarray($RES)) {
         $name = '<a href="feeds.php?feed='.$ROW['id'].'">'.$ROW['name'].'</a>';
         opentable($name);
            if(!$rss_parser =& new rss_parser) {
               die('couldn\'t create object');
            } elseif(!$news = $rss_parser->parse($ROW['file'], $ROW['num_items_feeds_page'], $ROW['cache_limit'])) {
               print $locale['LAN_RSS_103'];
            } else {
               foreach($news['news'] as $data) {
				    $newdate = strtotime($data['pubDate']);
					$datum = date ("d.m.Y  H:i" ,$newdate);
                  if(!isset($data['link'])){
                     $data['link'] = "";
					
					 
                  }
                  $new_window = ($ROW['new_window'] == 1 ? '" target="_blank' : "");
				  echo '<a href="'.$data['title'].'"></a>';
                  print '<b><a href="'.$data['link'].$new_window.'">'.$datum.': '.toiso2($data['title']).'</a></b><br />'.nl2br(toiso2($data['description'])).'<br /><br />';
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
                  $next_update = $ROW['cacle_limit'].' '.$locale['LAN_RSS_193'];
               } else {
                  $hours = floor(($news['info']['cache_next_update']/60)/60);
                  $mins = ceil($news['info']['cache_next_update']/60)-(60*$hours);
                  $next_update = $hours.' '.$locale['LAN_RSS_193'].' '.$mins.' '.$locale['LAN_RSS_192'];
               }
               print '<table width="100%"><tr><td class="news-footer">'.$locale['LAN_RSS_190'].$last_update.'<br />'.
                        $locale['LAN_RSS_191'].$next_update.'</td></tr></table>';
            }
         closetable();
         tablebreak();
      }
   } else {
      opentable($locale['LAN_RSS_120']);
      print '<div align="center">'.$locale['LAN_RSS_121'].'<div>';
      closetable();
   }
}

require_once THEMES."templates/footer.php";
?>