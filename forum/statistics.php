<?php
/*-----------------------------------------------------+
| PHP-Fusion 6 Forum Statystyki
+------------------------------------------------------+
| Copyright © 2005 Za³oga FusionMC
| Email: support@fusion-mc.be
| http://www.fusion-mc.be/
+------------------------------------------------------+
| Released under the terms & conditions of v2 of the
| GNU General Public License. For details refer to
| the included gpl.txt file or visit http://gnu.org
+------------------------------------------------------*/
if (!defined("IN_FUSION")) { header("Location: index.php"); exit; }
include LOCALE.LOCALESET."forum/statistics.php";

opentable($locale['fs001']);
echo "<table border='0' width='100%' cellpadding='0' cellspacing='1' class='tbl-border'>
	<tr>
		<td width='100%' align='left' class='forum-caption' colspan='2'><b>".$locale['fs001']."</b></td>
	</tr>
	<tr>
		<td width='100%' align='left' class='tbl2' colspan='2'><b>".$locale['fs002']."</b></td>
	</tr>
	<tr>";
	$result = dbquery("SELECT * FROM ".$db_prefix."online");
	$online = dbrows($result);
		echo "<td width='100%' align='left' class='tbl1'>
	".$locale['fs004']."<b>".($online ? $online : "0")."</b>".$locale['fs005']."";
	$result = dbquery("SELECT * FROM ".$db_prefix."online WHERE online_user!='0'");
	$online = dbrows($result);
		echo "<b>".($online ? $online : "0")."</b>".$locale['fs006']."";
	$result = dbquery("SELECT * FROM ".$db_prefix."online WHERE online_user='0'");
	$online = dbrows($result);
		echo "<b>".($online ? $online : "0")."</b>".$locale['fs007']."<br><hr>";
	echo $locale['fs020'];

$result = dbquery(
		"SELECT ton.*, user_id,user_name FROM ".$db_prefix."online ton
		LEFT JOIN ".$db_prefix."users tu ON ton.online_user=tu.user_id
		WHERE online_user!='0'"
	);
$result_members = dbquery("SELECT * FROM ".$db_prefix."online WHERE online_user>'0'");
$members = dbrows($result_members);
if ($members != 0)
{
$i = 1;
while($om = dbarray($result_members))
{
$result_member = dbquery("SELECT * FROM ".$db_prefix."users WHERE `user_id`='".$om['online_user']."'");
$data = dbarray($result_member);

if($data['user_level']==103){
echo "<a style='color:#F75013;' href='".BASEDIR."profile.php?lookup=".$data['user_id']."' class='side'><B>".$data['user_name']."</B></a>";
}
else if($data['user_level']==102){
echo "<a style='color:#B5DE21;' href='".BASEDIR."profile.php?lookup=".$data['user_id']."' class='side'><B>".$data['user_name']."</B></a>";
} else {

echo "
<a style='color:#38394B;' href='".BASEDIR."profile.php?lookup=".$data['user_id']."' class='side'><B>".$data['user_name']."</B></a>";
}
if ($i != $members) echo ", ";
$i++;
}
}

echo "<hr><font color='#F75013'>".$locale['fs008']."</font>|<font color='#B5DE21'>".$locale['fs009']."</font>|<font color='#38394B'>".$locale['fs010']."</font></span></td>";
		echo "
	</tr>
	<tr>
		<td width='100%' align='left' class='tbl2' colspan='2'><b>".$locale['fs003']."</b></td>
	</tr>
	<tr>";
	$cond = ($userdata['user_level'] != 0 ? "'".$userdata['user_id']."'" : "'0' AND online_ip='".USER_IP."'");
	$result = dbquery("SELECT * FROM ".$db_prefix."online WHERE online_user=".$cond."");
	if (dbrows($result) != 0) {
		$result = dbquery("UPDATE ".$db_prefix."online SET online_lastactive='".time()."' WHERE online_user=".$cond."");
	} else {
		$name = ($userdata['user_level'] != 0 ? $userdata['user_id'] : "0");
		$result = dbquery("INSERT INTO ".$db_prefix."online VALUES('$name', '".USER_IP."', '".time()."')");
	}
	if (isset($_POST['login'])) {
		$result = dbquery("DELETE FROM ".$db_prefix."online WHERE online_user='0' AND online_ip='".USER_IP."'");
	} else if (isset($logout)) {
		$result = dbquery("DELETE FROM ".$db_prefix."online WHERE online_ip='".USER_IP."'");
	}
	$result = dbquery("DELETE FROM ".$db_prefix."online WHERE online_lastactive<".(time()-60)."");
	$facount = dbquery("SELECT count(post_id) FROM ".$db_prefix."posts");
	$topics = dbquery("SELECT count(thread_id) FROM ".$db_prefix."threads");
	$result = dbquery("SELECT user_id,user_name FROM ".$db_prefix."users ORDER BY user_joined DESC");
	$total = dbrows($result);
	$data = dbarray($result);
		echo "
		<td width='100%' align='left' class='tbl1'>".$locale['fs011']."<b>".dbresult($facount, 0)."</b>".$locale['fs012']."<br>
		".$locale['fs013']."<b>".dbresult($topics, 0)."</b>".$locale['fs014']."<br>
		".$locale['fs015']."<b>".$total."</b>".$locale['fs016']."<br>
		".$locale['fs017']."<b><a href='".BASEDIR."profile.php?lookup=".$data['user_id']."' class='side'><b>".$data['user_name']."</b></a></b></td>
	</tr>
	<tr>
		<td width='90%' align='left' class='tbl1' colspan='2'><div align='right'><form name='search' method='post' action='".BASEDIR."search.php?stype=f'><span class='small'>".$locale['fs018']."</span>
	<input type='textbox' name='stext' class='textbox' style='width:150px'>
	<input type='submit' name='search' value='".$locale['fs019']."' class='button'>
	</form></div></td></tr></table>\n";
	closetable();
?>
