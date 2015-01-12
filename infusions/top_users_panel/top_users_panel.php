<?
if (!defined("IN_FUSION")) { die("Access Denied"); }
if (file_exists(INFUSIONS."top_users_panel/locale/".$settings['locale'].".php")) {
include INFUSIONS."top_users_panel/locale/".$settings['locale'].".php";
} else {
include INFUSIONS."top_users_panel/locale/Polish.php";
}
include LOCALE.LOCALESET."user_fields.php";

$result = dbquery("SELECT user_level, user_id, user_name, points_normal,points_bonus, points_punishment from ".$db_prefix."users WHERE user_level='101' ORDER BY (points_normal+points_bonus-points_punishment) DESC LIMIT 1,5");
$result2 = dbquery("SELECT user_level, user_id, user_avatar, user_name, points_normal,points_bonus, points_punishment from ".$db_prefix."users WHERE user_level='101' ORDER BY (points_normal+points_bonus-points_punishment) DESC LIMIT 1");
$x=2;
$x2=1;
openside($locale['tp_000']);
while ($dane2 = dbarray($result2))
{
echo "<center>".$locale['tp_004']." <b>".$x2."</b> ".$locale['tp_005']."</center>";
echo "<FIELDSET><LEGEND><a href='".BASEDIR."profile.php?lookup=".$dane2['user_id']."'>".$dane2['user_name']."</a></LEGEND>";
echo "<table cellspacing='0' cellpadding='0' border='0' align='left'><tr>\n";
echo "<td><img src='".IMAGES."avatar_mod/gora_lewa.png'  height='12' width='12'></td>\n";
echo "<td><img src='".IMAGES."avatar_mod/gora_srodek.png'  height='12' width='100%'></td>\n";
echo "<td><img src='".IMAGES."avatar_mod/gora_prawa.png'  height='12' width='12'></td></tr>\n";
echo "<td align='left'><img src='".IMAGES."avatar_mod/srodek_lewa.png' width='12' height='100%'></td>\n";
echo "<td align='center' height='1%'>";
echo ($dane2['user_avatar'] ? "<img src='".IMAGES."avatars/".$dane2['user_avatar']."' alt='' height='50' width='50'>" : "<img src='".FORUM."images/brak.gif' alt='".$locale['u046']." height='50' width='50''>")."</td>";
echo "<td align='right'><img src='".IMAGES."avatar_mod/srodek_prawa.png' height='100%' width='12'></td></tr><tr>\n";
echo "<td><img src='".IMAGES."avatar_mod/dol_lewa.png' height='12' width='12'></td>\n";
echo "<td><img src='".IMAGES."avatar_mod/dol_srodek.png' height='12' width='100%'></td>\n";
echo "<td><img src='".IMAGES."avatar_mod/dol_prawa.png' height='12' width='12'></td></tr>\n";
echo "</tr></table>";

echo "<br><b>".$locale['tp_006']."</b><br>";

echo "".$locale['tp_001']." ".$dane2['points_normal']."<br>";
echo "".$locale['tp_002']." ".$dane2['points_bonus']."<br>";
echo "".$locale['tp_003']." ".$dane2['points_punishment']."";
echo "</FIELDSET>";
echo "<br>";
}

while ($dane = dbarray($result))
{
echo $x.") <a href='".BASEDIR."profile.php?lookup=".$dane['user_id']."'>".$dane['user_name']."</a> (".($dane['points_normal']+$dane['points_bonus']-$dane['points_punishment'])." pkt.)<br>";
$x++;
}
echo "<br>";

closeside();
?>
