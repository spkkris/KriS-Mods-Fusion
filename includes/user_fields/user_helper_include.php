<?php
if (!defined("IN_FUSION")) { die("Access Denied"); }

/*if (!isset($_GET['user_id']) || !isNum($_GET['user_id'])) redirect("index.php");
$result2 = dbquery("SELECT * FROM ".DB_USERS." WHERE user_id=".$_GET['user_id']."");
$result = dbquery("SELECT * FROM ".DB_POSTS." p
LEFT JOIN ".DB_THREADS." t ON (p.thread_id=t.thread_id)
WHERE post_help='".$_GET['user_id']."' ORDER BY post_help AND post_datestamp");
$udata = dbarray($result);*/

if ($profile_method == "input") {
	//Nothing here
} elseif ($profile_method == "display") {
	echo "<tr>\n";
	echo "<td width='1%' class='tbl1' style='white-space:nowrap'>Pomóg³</td>\n";
	echo "<td align='right' class='tbl1'>".$user_data['user_help_point']."</td>\n";
	echo "</tr>\n";
} elseif ($profile_method == "validate_insert") {
	//Nothing here
} elseif ($profile_method == "validate_update") {
	//Nothing here
}
?>
