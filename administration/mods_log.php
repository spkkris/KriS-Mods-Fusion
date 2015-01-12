<?php
require_once "../maincore.php";
require_once THEMES."templates/admin_header.php";
include LOCALE.LOCALESET."admin/mods_log.php";

if (!checkrights("LG") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

$limit="50"; //rowstar limit
$r = dbquery("SELECT * FROM ".DB_FORUMLOG);	
$rows = dbrows($r);
if (!isset($_GET['rowstart']) || !isnum($_GET['rowstart'])) { $_GET['rowstart'] = "0"; }
$result = dbquery(
"SELECT tm.*,tf.*, tu.user_id,user_name FROM ".DB_FORUMLOG." tm
INNER JOIN ".DB_USERS." tu ON tm.u_id=tu.user_id
INNER JOIN ".DB_FORUMS." tf ON tm.forum_id=tf.forum_id
ORDER BY datestamp DESC LIMIT ".$_GET['rowstart'].",".$limit);
opentable($locale['log1']);
if(isset($_POST['cleanup'])){
$ctime = isset($_POST['ctime']) ? $_POST['ctime'] : '';
$cctime = isset($_POST['cctime']) && isnum($_POST['cctime']) ? $_POST['cctime'] : 0;
if($ctime==="w"){ $ctime=$cctime*604800; } //week
if($ctime==="m"){ $ctime=$cctime*2592000; } //month
if($ctime==="y"){ $ctime=$cctime*31536000; } //year
$result = dbquery("DELETE FROM ".DB_FORUMLOG." WHERE datestamp < '".$cctime."'");
if ($result) redirect(FUSION_SELF);
}
echo "<form name='cleanup' method='post' action='".FUSION_SELF."'>\n";
echo $locale['log10']." \n";
echo "<select name='ctime' class='textbox'>\n";
echo "<option value=''>&nbsp;</option>\n";
echo "<option value='w'>".$locale['log18']."</option>\n"; 
echo "<option value='m'>".$locale['log19']."</option>\n"; 
echo "<option value='y'>".$locale['log20']."</option>\n"; 
echo "</select>\n";
echo "<input type='submit' name='cleanup' value='".$locale['log16']."' class='button' onclick=\"return confirm('".$locale['log21']."');\">";
echo "</form><br />\n";
echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
echo "<td>".$locale['log3']."</td>\n";
echo "<td>".$locale['log4']."</td>\n";
echo "<td>".$locale['log5']."</td>\n";
echo "<td>".$locale['log6']."</td>\n";
echo "<td>".$locale['log7']."</td>\n";
echo "<td>".$locale['log8']."</td>\n";
echo "</tr>\n";	
while ($data = dbarray($result)) {
echo "<td><a href='".BASEDIR."profile.php?lookup=".$data['u_id']."'>".$data['user_name']."</a></td>\n";
echo "<td>"; 
if($data['action'] == "delete") { 
echo $locale['log10']; }
elseif($data['action'] == "renew") { 
echo $locale['log17']; }
elseif($data['action'] == "lock") { 
echo $locale['log11']; }
elseif($data['action'] == "unlock") {
echo $locale['log12']; }
elseif($data['action'] == "sticky") { 
echo $locale['log13']; }
elseif($data['action'] == "nonsticky") { 
echo $locale['log14']; }
if($data['action'] == "move") { //for moded fusion
echo $locale['log15']; 
} 
echo "</td>\n";
echo "<td><a href='".FORUM."viewforum.php?forum_id=".$data['forum_id']."'>".$data['forum_name']."</a></td>\n";
echo "<td>";
if($data['action'] == "delete") { 
echo "Forum ID {$data['forum_id']}<br /> Thread ID was {$data['forum_id']}\n";
}else{
echo "<a href='".FORUM."viewthread.php?thread_id=".$data['thread_id']."'>".$data['thread_subject']."</a></td>\n";
}
echo "<td>".$data['log_ip']."</td>\n";
echo "<td>".showdate("forumdate", $data['datestamp'])."</td>\n";
echo "<tr>\n</tr>\n";
}
echo "</table>\n";
if ($rows > $limit) {
echo "\n<div align=center>".makepagenav($_GET['rowstart'],$limit, $rows,3,FUSION_SELF."?")."</div>\n";
}
if (dbrows($result) == '0') { echo $locale['log9']; }
closetable();
require_once THEMES."templates/footer.php";
?>
