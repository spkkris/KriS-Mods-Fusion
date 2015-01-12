<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: index.php
| Author: Nick Jones (Digitanium)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../maincore.php";
require_once THEMES."templates/header.php";
include LOCALE.LOCALESET."forum/main.php";
include INCLUDES."na_skroty/forum/index.php";


if (!isset($lastvisited) || !isnum($lastvisited)) { $lastvisited = time(); }

add_to_title($locale['global_200'].$locale['400']);

opentable($locale['400']);


$forum_list = ""; $current_cat = "";
$result = dbquery(
	"SELECT f.*, f2.forum_name AS forum_cat_name, u.user_id, u.user_name
	FROM ".DB_FORUMS." f
	LEFT JOIN ".DB_FORUMS." f2 ON f.forum_cat = f2.forum_id
	LEFT JOIN ".DB_FORUMS." f3 ON f3.forum_id=f.forum_id
	LEFT JOIN ".DB_USERS." u ON f.forum_lastuser = u.user_id
	WHERE ".groupaccess('f.forum_access')." AND f.forum_cat!='0' AND f3.forum_parent='0' GROUP BY forum_id ORDER BY f2.forum_order ASC, f.forum_order ASC"
);
if (dbrows($result) != 0) {
	while ($data = dbarray($result)) {
    if ($data['forum_cat_name'] != $current_cat) {
         $current_cat = $data['forum_cat_name'];
         echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border' style='margin-bottom:10px;'><tr>\n";
echo "<td colspan='2' class='forum-caption'><center><strong>".$data['forum_cat_name']."</strong></center></td>\n";
echo "<td align='center' width='1%' class='forum-caption' style='white-space:nowrap'>".$locale['402']."</td>\n";
echo "<td align='center' width='1%' class='forum-caption' style='white-space:nowrap'>".$locale['403']."</td>\n";
echo "<td width='20%' class='forum-caption' style='white-space:nowrap' align='center'>".$locale['404']."</td>\n";
echo "</tr>\n";
      }
		$moderators = "";
		if ($data['forum_moderators']) {
			$mod_groups = explode(".", $data['forum_moderators']);
			foreach ($mod_groups as $mod_group) {
				if ($moderators) $moderators .= ", ";
				$moderators .= $mod_group<101 ? "<a href='".BASEDIR."profile.php?group_id=".$mod_group."'>".getgroupname($mod_group)."</a>" : getgroupname($mod_group);
			}
		}
		$forum_match = "\|".$data['forum_lastpost']."\|".$data['forum_id'];
		if ($data['forum_lastpost'] > $lastvisited) {
			if (iMEMBER && preg_match("({$forum_match}\.|{$forum_match}$)", $userdata['user_threads'])) {
				$fim = "<img src='".get_image("folder")."' alt='".$locale['561']."' />";
			} else {
				$fim = "<img src='".get_image("foldernew")."' alt='".$locale['560']."' />";
			}
		} else {
			$fim = "<img src='".get_image("folder")."' alt='".$locale['561']."' />";
		}
 echo "<tr>\n";
      echo "<td align='center' width='1%' class='tbl2' style='white-space:nowrap'>$fim</td>\n";
      echo "<td class='tbl1 forum_name_cell'><!--forum_name_cell--><a href='viewforum.php?forum_id=".$data['forum_id']."' style='font-weight:bold;font-size:13px;'>".$data['forum_name']."</a><br />\n";
      if ($data['forum_description'] || $moderators) {
         echo $data['forum_description'].($data['forum_description'] && $moderators ? "<br />\n" : "");
       		echo ($moderators ? "<strong>".$locale['411']."</strong>".$moderators."</span>\n" : "</span>\n")."<br />\n";
      }
      
      		$p_result = dbquery("SELECT * FROM ".DB_FORUMS." WHERE ".groupaccess("forum_access")." AND forum_parent='".$data['forum_id']."'");
		if (dbrows($p_result) != 0) {
		echo "<img src='".IMAGES."folder_open.png' alt='' style='vertical-align: middle;' /><span class='small'><strong>".$locale['412']."</strong>";
		echo "<br />";	
			$i = dbrows($p_result);
				while($p_data = dbarray($p_result)){
					$i--;
					echo "&nbsp;&nbsp;<img src='".IMAGES."subforum.png' alt='' style='vertical-align: middle;' /> <a href='".FORUM."viewforum.php?forum_id=".$p_data['forum_id']."'>".$p_data['forum_name']."</a>";
					if($i > 0) echo "<br />";
				}
				echo "</span>";
		}
      
      echo "</td>\n";
      echo "<td align='center' width='1%' class='tbl2' style='white-space:nowrap'>".$data['forum_threadcount']."</td>\n";
      echo "<td align='center' width='1%' class='tbl1' style='white-space:nowrap'>".$data['forum_postcount']."</td>\n";
      echo "<td width='20%' class='tbl2' style='white-space:nowrap'>";
      if ($data['forum_lastpost'] == 0) {
         echo $locale['405']."</td>\n</tr>\n";
      } else {
         echo showdate("forumdate", $data['forum_lastpost'])."<br />\n";
         echo "<span class='small'>".$locale['406']."<a href='".BASEDIR."profile.php?lookup=".$data['forum_lastuser']."'>".trimlink($data['user_name'],15)."</a></span></td>\n";
         echo "</tr>\n";
      if ($data['forum_cat_name'] != $current_cat) {
         echo "</table>";
      }   
      }
   }
} else {
   echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border' style='margin-bottom:10px;'><tr>\n<td colspan='5' class='tbl1'>".$locale['407']."</td>\n</tr></table>\n";
}
echo "<!--sub_forum_idx_table-->\n<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";


echo "<td class='forum'><br />\n";
echo "<img src='".get_image("foldernew")."' alt='".$locale['560']."' style='vertical-align:middle;' /> - ".$locale['409']."<br />\n";
echo "<img src='".get_image("folder")."' alt='".$locale['561']."' style='vertical-align:middle;' /> - ".$locale['410']."\n";
echo "</td><td align='right' valign='bottom' class='forum'>\n";
echo "<form name='searchform' method='get' action='".BASEDIR."search.php?stype=forums'>\n";
echo "<input type='hidden' name='stype' value='forums' />\n";
echo "<input type='text' name='stext' class='textbox' style='width:150px' />\n";
echo "<input type='submit' name='search' value='".$locale['550']."' class='button' />\n";
echo "</form>\n</td>\n</tr>\n</table><!--sub_forum_idx-->\n";
closetable();

require_once "statistics.php";
require_once THEMES."templates/footer.php";
?>
