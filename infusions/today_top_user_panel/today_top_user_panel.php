<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: latest_articles_panel.php
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
if (!defined("IN_FUSION")) { die("Access Denied"); }
if (file_exists(INFUSIONS."today_top_user_panel/locale/".$settings['locale'].".php")) {
include INFUSIONS."today_top_user_panel/locale/".$settings['locale'].".php";
}
openside($locale['TO01']);
$rok = date('Y');
$miech = date('n');
$dzien = date('j');
$time = mktime(0, 0, 0, $miech, $dzien, $rok);
$result = dbquery("SELECT post_author, post_datestamp, user_id, user_name, user_avatar, COUNT(post_author) AS ile FROM ".DB_POSTS." LEFT JOIN ".DB_USERS." ON post_author=user_id WHERE post_datestamp > '$time' GROUP BY post_author ORDER BY ile DESC, post_datestamp DESC LIMIT 10");
if (dbrows($result) > 0) {
$counter = 0; $columns = 2;  
echo "<table cellpadding='0' cellspacing='10' width='100%' class='center'><tr>";
while ($data = dbarray($result)) {
if ($counter != 0 && ($counter % $columns == 0)) { echo "</tr>\n<tr>\n"; }
echo "<td align='center'width='50%'>".($data['user_avatar'] !== "" ? "<img src='".IMAGES."avatars/".$data['user_avatar']."' width='60' height='60'>" : "<img src='".IMAGES."avatars/noav.png' width='60' height='60'>")."<br>
<span class='small2'><a href='".BASEDIR."profile.php?lookup=".$data['user_id']."'>".$data['user_name']."</a><br> ".THEME_BULLET." (".number_format($data['ile']).")</span></td>";
$counter++;
}
echo "</tr>\n</table>\n";
} else {
echo "<div style='text-align:center'><br />".$locale['TO02']."</div><br />\n";  
}
closeside();
?>
