<?php 
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: team.php
| Author:  php-fusion.pl team
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "maincore.php";
require_once THEMES."templates/header.php";
include LOCALE.LOCALESET."ekipa.php";
function MakeTeamTable($tablename, $where="", $group="")
{
	global $locale, $userdata;
	
	if(!$group)
		$result = dbquery("SELECT * FROM ".DB_USERS." WHERE ".$where." ORDER BY user_name ASC");
	else
		$result = dbquery("SELECT * FROM ".DB_USERS." WHERE user_groups REGEXP('^\\\.{$group}$|\\\.{$group}\\\.|\\\.{$group}$') ".($where ? $where : "")." ORDER BY user_name ASC");

	if (dbrows($result)) {
		$i = 0;
		echo "\n<!-- ".$tablename." -->\n";
		echo "<center><b>".$tablename."</b></center>\n<br>\n";
		while ($data = dbarray($result)) {
			$cell_color = ($i % 2 == 0 ? "tbl1" : "tbl2"); $i++;
			echo "<table align='center' cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n";		
			echo "<tr>\n<td width='50%' align='center' class='tbl2'><a href='profile.php?lookup=".$data['user_id']."'>".$data['user_name']."</a></td>\n";
			echo "<td align='center'  rowspan='5' class='tbl2'>";
			echo ($data['user_avatar'] ? "<div id='imgb'><img src='".IMAGES."avatars/".$data['user_avatar']."' alt=''>" : "<img src='".IMAGES."avatars/noav.png' />")."</div></td>\n";
			//echo ($data['user_avatar'] ? "<img src='".IMAGES."avatars/".$data['user_avatar']."' alt=''>" : "Brak avatara")."</td>\n";
			echo "<td align='center' width='50%' class='tbl2' style='white-space:nowrap'>Do³±czy³: ".showdate("longdate", $data['user_joined'])."</td>\n";
			echo "</tr>\n<tr>\n";
			echo "<td align='center' class='tbl1'>".$locale['skad']." ".($data['user_location'] ? $data['user_location'] : "")."</td>\n";
			echo "<td align='center' class='tbl1'>".$locale['shout']." <b>".number_format(dbcount("(shout_id)", DB_SHOUTBOX, "shout_name='".$data['user_id']."'"))."</b></td>\n";
			echo "</tr>\n<tr>\n";
			echo "<td align='center' class='tbl2'>".$locale['dat_ur']." ";
			if ($data['user_birthdate'] != "0000-00-00") {
				$months = explode("|", $locale['months']);
				$user_birthdate = explode("-", $data['user_birthdate']);
				echo number_format($user_birthdate['2'])." ".$months[number_format($user_birthdate['1'])]." ".$user_birthdate['0'];
			} else {
				
			}
			echo "</td>\n";
			echo "<td align='center' class='tbl2'>".$locale['komentarze']." <b>".number_format(dbcount("(comment_id)", DB_COMMENTS, "comment_name='".$data['user_id']."'"))."</b></td>\n";
			echo "</tr>\n<tr>\n";
			echo "<td align='center' class='tbl1'>".$locale['last']." ".($data['user_lastvisit'] != 0 ? showdate("longdate", $data['user_lastvisit']) : "")."</td>\n";
			echo "<td align='center' class='tbl1'>".$locale['forum_post']." <b>".number_format($data['user_posts'])."</b></td>\n";
			echo "</tr>\n</table>\n";
			echo "<table align='center' cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n";
			if (iMEMBER) { 
				echo "<tr>\n<td align='center' class='tbl2'>";
				if ($data['user_hide_email'] != "1" || iADMIN)
					echo "| <a href='mailto:".str_replace("@","&#64;",$data['user_email'])."' title='".str_replace("@","&#64;",$data['user_email'])."'>".$data['user_email']."</a> ";

				if ($data['user_web']) {
					$urlprefix = !strstr($data['user_web'], "http://") ? "http://" : "";
					echo "| <a href='".$urlprefix.$data['user_web']."' title='".$urlprefix.$data['user_web']."' target='_blank'>".$data['user_web']."</a> ";
				}
				if (iMEMBER && $data['user_id'] != $userdata['user_id'])
					echo "| <a href='messages.php?msg_send=".$data['user_id']."' >".$locale['pw']."</a> ";

				echo "|<br>\n";
					echo (isset($data['user_aim']) && $data['user_aim']) ? "<a href='gg:".$data['user_aim']."'><img src='http://gadu-gadu.pl/users/status.asp?id=".$data['user_aim']."&amp;styl=0' alt='GG' style='vertical-align:middle;border:0;'></a> " : "";
					echo (isset($data['user_msn']) && $data['user_msn']) ? "<a href='tlen://chat|".$data['user_msn']."|/'><img src='http://status.tlen.pl/?u=".$data['user_msn']."&amp;t=1' alt='Tlen' style='vertical-align:middle;border:0;'></a> " : "";
					echo (isset($data['user_icq']) && $data['user_icq']) ? "<a target='_blank' href='http://web.icq.com/wwp?Uin=".$data['user_icq']."'><img border='0' src='http://web.icq.com/whitepages/online?icq=".$data['user_icq']."&amp;img=5' alt='ICQ' style='vertical-align:middle;border:0;'></a> " : "";
					echo (isset($data['user_yahoo']) && $data['user_yahoo']) ? "<a href='callto://".$data['user_yahoo']."/'><img src='http://mystatus.skype.com/smallicon/".$data['user_yahoo']."' alt='Skype' style='vertical-align:middle;border:0;'></a> " : "";
					echo (isset($data['user_gizmo']) && $data['user_gizmo']) ? "<a href='sip://call?id=".$data['user_gizmo']."'><img src='".IMAGES."gizmo_18x18.gif' alt='Gizmo' style='vertical-align:middle;border:0;'></a> " : "";
				echo "</td>\n</tr>\n";
			}else{
				echo "<tr><td align='center' class='tbl2'>";
				echo "<center>".$locale['kontakt']."</center></td></tr>\n";
			}
			echo "</table>\n<br>\n"; 
		}
	}
}//end MakeTeamTable()

//tworzenie listy moderatorow
	$moderators = array(); $quer = "";
	$result = dbquery("SELECT forum_moderators from ".DB_FORUMS."");
	if (dbrows($result) > 0){
		while ($data = dbarray($result)){ 
			if ($data['forum_moderators'] != ""){
				if (strpos($data['forum_moderators'], ".") !== FALSE){
					$modd = explode(".", $data['forum_moderators']);
					for ($i=0;$i<count($modd);$i++)
						if($modd[$i]!="")
							$moderators[] = trim($modd[$i]);
				} else 
					$moderators[] = trim($data['forum_moderators']); 
			}
		}
	}
	foreach (array_unique($moderators) as $groupid)
		$quer .= (!$quer ? "" : " OR ")."user_groups REGEXP('^\\\.{$groupid}$|\\\.{$groupid}\\\.|\\\.{$groupid}$')";

opentable("Administracja");
MakeTeamTable('Super Administratorzy', "user_level = 103");
MakeTeamTable('Administratorzy', "user_level = 102");
if($quer != "") MakeTeamTable('Moderatorzy', "(".$quer.") AND user_level = 101");
closetable();

require_once THEMES."templates/footer.php";
?>
