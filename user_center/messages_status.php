<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: messages.php
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
include LOCALE.LOCALESET."messages.php";
include LOCALE.LOCALESET."messages_status.php";
include LOCALE.LOCALESET."user_center/main.php";

if (!iMEMBER) { redirect("index.php"); }

$status = 1; // 1 - status obrazek, 0 - status napis
$limit = 20; // - limit wy¶wietlonych wiadomo¶ci na jednej stronie
$rows = dbcount("(message_id)", DB_MESSAGES, "message_from='".$userdata['user_id']."'");

if (empty($_GET['rowstart'])) {
$result = dbquery("SELECT m.*, u.user_id, u.user_name FROM ".DB_MESSAGES." m
			LEFT JOIN ".DB_USERS." u ON m.message_to=u.user_id
			WHERE message_from='".$userdata['user_id']."' AND message_folder='0'
			ORDER BY message_datestamp DESC LIMIT $limit");
			
			} else {
			
			$result = dbquery("SELECT m.*, u.user_id, u.user_name FROM ".DB_MESSAGES." m
			LEFT JOIN ".DB_USERS." u ON m.message_to=u.user_id
			WHERE message_from='".$userdata['user_id']."' AND message_folder='0'
			ORDER BY message_datestamp DESC LIMIT ".$_GET['rowstart'].", $limit");
			}


opentable("Status wys³anych wiadomo¶ci PW - ".$userdata['user_name']."");
	echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
echo "<td align='center' width='25%' class='tbl1'><span class='small'>\n";
	echo "<a href='index.php'>".$locale['002']."</a> </span></td>\n";
echo "<td align='center' width='25%' class='tbl1'><span class='small'>\n";
	echo "<a href='edit_profile.php'>".$locale['003']."</a> </span></td>\n";
echo "<td align='center' width='25%' class='tbl2'><span class='small'>\n";
	echo  "<a href='messages.php'><strong>".$locale['004']."</strong></a> </span></td>\n";
echo "<td align='center' width='25%' class='tbl1'><span class='small'>\n";
	echo "<a href='vip_zone.php'>".$locale['005']."</a> </span></td>\n";
if (!isset($_GET['rowstart']) || !isnum($_GET['rowstart'])) { $_GET['rowstart'] = 0; }
echo "<div align='right' class='tbl2'>£±cznie: <b>$rows</b> wiadomo¶ci.</div>";
echo "<table cellpadding='0' cellspacing='0' width='100%'>\n";
	echo "<tr>\n<td align='left' width='100%' class='tbl'><a href='".BASEDIR."user_center/messages.php?msg_send=0'>".$locale['401']."</a></td>\n";
	echo "<td width='1%' class='tbl' style='white-space:nowrap'><a href='".BASEDIR."user_center/messages.php?folder=inbox'>".$locale['402']."</a></td>\n";
	echo "<td width='1%' class='tbl' style='white-space:nowrap'><a href='".BASEDIR."user_center/messages.php?folder=outbox'>".$locale['403']."</a></td>\n";
	echo "<td width='1%' class='tbl' style='white-space:nowrap'><a href='".BASEDIR."user_center/messages.php?folder=archive'>".$locale['404']."</a></td>\n";
	echo "<td width='1%' class='tbl' style='white-space:nowrap'><a href='".BASEDIR."user_center/messages_status.php?rowstart=0'>".$locale['stat_pw']."</a></td>\n";
	echo "<td width='1%' class='tbl' style='white-space:nowrap'><a href='".BASEDIR."user_center/messages.php?folder=options'>".$locale['425']."</a></td>\n";
	echo "</tr>\n</table><br>\n";

if ($rows != 0) {

echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n";
	echo "<tr>\n<td class='tbl2'>".$locale['405']."</td>\n";
	echo "<td width='1%' class='tbl2' style='white-space:nowrap'>".$locale['do']."</td>\n";
	echo "<td width='1%' class='tbl2' style='white-space:nowrap'>".$locale['407']."</td>\n";
	echo "<td class='tbl2' width='1%'>Status</td>\n</tr>";
		while ($data = dbarray($result)) {
			echo "<tr>\n<td class='tbl1'>\n";
			echo $data['message_subject'];
			echo "</td>\n";
			echo "<td width='1%' class='tbl1' style='white-space:nowrap'><a href='".BASEDIR."profile.php?lookup=".$data['user_id']."'>".$data['user_name']."</a></td>\n";
			echo "<td width='1%' class='tbl1' style='white-space:nowrap'>".showdate("shortdate", $data['message_datestamp'])."</td>\n";
			echo "<td width='1%' class='tbl1' align='center' style='white-space:nowrap'><b>";
			if ($data['message_read'] == "1") {
			if ($status == 1) {
			echo "<img src='".IMAGES."tick.png' title='".$locale['wzp']."'>";
			} else {
			echo "<b>Przeczytano</b>";
			}
			} else {
			if ($status == 1) {
			echo "<img src='".IMAGES."cross.png' title='".$locale['wnzp']."'>";
			} else {
			echo "".$locale['np']."";
			}
			}
			
			echo "</b></td></tr>\n";
		}
		if ($rows > $limit) echo "<div align='center' style='margin-top:5px;'>\n".makepagenav($_GET['rowstart'], $limit, $rows, 2, FUSION_SELF."?")."\n</div>\n";
		echo "</table>\n";
		
} else {
echo "<div align='center' class='tbl2'>".$locale['nwjzw']."";	
}
echo "<br><table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
echo "<td align='right' width='100%' class='tbl2'><span class='small'>\n";
	echo "<strong>Panel u¿ytkownika v1.0 by PHP-Fusion Revolution</strong></span></td>\n"; 
	echo "</table>"; 
closetable();

require_once THEMES."templates/footer.php";
?>
