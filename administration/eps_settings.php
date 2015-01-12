<?php
/*-----------------------------------------------------------------------------------------------------+
| INF: eXtreme Point System dla PHP-Fusion v6
|---------------------------------------------
| author: eXtreme-fusion crew - (c) 2005
| web: http://extreme-fusion.pl
|---------------------------------------------
| Wszystkie b³êdy s¹ zmierzone :]
+-----------------------------------------------------------------------------------------------------*/
require_once "../maincore.php";
require_once THEMES."templates/admin_header.php";
include LOCALE.LOCALESET."admin/eps_settings.php";
if (!checkrights("EP") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }




opentable($locale['EPS_001']);

function builduseroptionlist($selected_user_id=1){
      global $locale, $userdata;
      $user_option_list="";

      if ($userdata['user_level'] == '103')
      {  $levels = array(
             0 => array($locale['user3'], "103"),
             1 => array($locale['user2'], "102"),
             2 => array($locale['user1'], "101")
          );
      } else
      {
         $levels = array(
             1 => array($locale['user2'], "102"),
             2 => array($locale['user1'], "101")
         );
      }
      while(list($key, $user_level) = each($levels)) {
              $uresult = dbquery("SELECT * FROM ".DB_USERS." WHERE user_level='".$user_level['1']."' ORDER BY user_name");
             if (dbrows($uresult) > 0) {
                    $user_option_list .= "<optgroup label='".$user_level['0']."'>\n";
                    while($udata=dbarray($uresult)) {
                           $sel = ($udata['user_id'] == $selected_user_id ? " selected" : "");
                           $user_option_list.="<option ".$sel." value='".$udata['user_id']."'>".$udata['user_name']."</option>\n";
                    }
                    $user_option_list.="</optgroup>\n";
             }
      }

      return $user_option_list;
}


	if (isset($_POST['points_edit'])) {
                if (isNum($_POST['forum'])) $forum=$_POST['forum']; else $forum=0;
		if (isNum($_POST['shout'])) $shout=$_POST['shout']; else $shout=0;
		if (isNum($_POST['link'])) $link=$_POST['link']; else $link=0;
		if (isNum($_POST['article'])) $article=$_POST['article']; else $article=0;
		if (isNum($_POST['news'])) $news=$_POST['news']; else $news=0;
		$result = dbquery("UPDATE ".DB_EPS_POINTS." SET point_ammount='$forum' WHERE point_id='1'");
		$result = dbquery("UPDATE ".DB_EPS_POINTS." SET point_ammount='$shout' WHERE point_id='2'");
		$result = dbquery("UPDATE ".DB_EPS_POINTS." SET point_ammount='$link' WHERE point_id='3'");
		$result = dbquery("UPDATE ".DB_EPS_POINTS." SET point_ammount='$article' WHERE point_id='4'");
		$result = dbquery("UPDATE ".DB_EPS_POINTS." SET point_ammount='$news' WHERE point_id='5'");
        }

        $row1 = dbquery("SELECT point_ammount FROM ".DB_EPS_POINTS." WHERE point_id='1'");
        $points1=dbarray($row1);
        $forum = $points1['point_ammount'];  
      
        $row2 = dbquery("SELECT point_ammount FROM ".DB_EPS_POINTS." WHERE point_id='2'");
        $points2=dbarray($row2);
        $shout = $points2['point_ammount'];  
   
        $row3 = dbquery("SELECT point_ammount FROM ".DB_EPS_POINTS." WHERE point_id='3'");
        $points3=dbarray($row3);
        $link = $points3['point_ammount']; 
      
        $row4 = dbquery("SELECT point_ammount FROM ".DB_EPS_POINTS." WHERE point_id='4'");
        $points4=dbarray($row4);
        $article = $points4['point_ammount'];    
    
        $row5 = dbquery("SELECT * FROM ".DB_EPS_POINTS." WHERE point_id='5'");
        $points5=dbarray($row5);
        $news = $points5['point_ammount']; 
            		
		
echo "<form name='editpoints' method='post' action='".FUSION_SELF.$aidlink."'>
<table align='center' width='408' cellspacing='0' cellpadding='0' class='tbl'>
<tr>
<td width=250>".$locale['EPS_002']."</td><td><input type='text' name='forum' value='".$forum."' maxlenght='5' class='textbox' style='width:50px;'>
</tr>
<tr>
<td width='250'>".$locale['EPS_003']."</td><td><input type='text' name='shout' value='".$shout."' class='textbox' style='width:50px;'></td>
</tr>
<tr>
<td width='250'>".$locale['EPS_004']."</td><td><input type='text' name='link' value='".$link."' class='textbox' style='width:50px;'></td>
</tr>
<tr>
<td width='250'>".$locale['EPS_005']."</td><td><input type='text' name='article' value='".$article."' class='textbox' style='width:50px;'></td>
</tr>
<tr>
<td width='250'>".$locale['EPS_006']."</td><td><input type='text' name='news' value='".$news."' class='textbox' style='width:50px;'></td>
</tr>
<tr>
<td align='center' colspan='2'>
<input type='submit' name='points_edit' value='".$locale['EPS_007']."' class='button'></td>
</tr>
</table>
</form>
";
	closetable();
echo"<br>";


if(isset($_POST['edit'])) {

$ile = count($_POST['nazwa']);
for ($i = 0; $i < $ile; $i++) {
$result = dbquery("UPDATE ".DB_EPS_RANGS." SET rang_name='".$_POST['nazwa'][$i]."', rang_points='".$_POST['points'][$i]."' WHERE id='".$_POST['id'][$i]."'");  
}

}

opentable ($locale['EPS_008']);
$result = dbquery("SELECT * from ".DB_EPS_RANGS."");

echo "<form name='rangi' method='post' action=".FUSION_SELF.$aidlink.">
<table align='center' width='408' cellspacing='0' cellpadding='0' class='tbl'>
<tr>
<td class='tbl2' align='center'>".$locale['EPS_009']."</td><td class='tbl2' align='center'>".$locale['EPS_010']."</td></tr>";

while ($dane = dbarray($result))
{
echo "<tr>
<td align='center'><input type='texbox' name='nazwa[]' class='textbox' value='".$dane['rang_name']."'></td>
<td align='center'><input type='texbox' name='points[]' class='textbox' value='".$dane['rang_points']."'>
<input type='hidden' name='id[]' value='".$dane['id']."'></td>
</tr>";
}
echo "
<tr>
<td align='center' colspan='2'><input type='submit' name='edit' value='".$locale['EPS_007']."' class='button'></td>
</tr>
</table>
</form>";

closetable();

	echo"<br>";


opentable($locale['EPS_011']);
if (isset($_POST['new_rang'])) {
$result = dbquery("INSERT INTO ".DB_EPS_RANGS." (rang_name, rang_points) VALUES ('".$_POST['name']."', '".$_POST['rang_points']."')");								
}
       		
echo "<form name='creat_rangs' method='post' action='".FUSION_SELF.$aidlink."'>
<table align='center' width='408' cellspacing='0' cellpadding='0' class='tbl'>
<tr>
<td width=250>".$locale['EPS_012']."</td><td><input type='text' name='name' value='' maxlenght='5' class='textbox' style='width:50px;'>
</tr>
<tr>
<td width='250'>".$locale['EPS_013']."</td><td><input type='text' name='rang_points' value='' class='textbox' style='width:50px;'></td>
</tr>
<tr>
<td align='center' colspan='2'>
<input type='submit' name='new_rang' value='".$locale['EPS_007']."' class='button'></td>
</tr>
</table>
</form>
";

if (isset($_POST['delete_rang'])) {
$result = dbquery("DELETE FROM ".DB_EPS_RANGS." WHERE rang_name='".$_POST['rang_name']."' LIMIT 1");
}
echo "
<form name='delete_rangs' method='post' action='".FUSION_SELF.$aidlink."'>
<table align='center' width='408' cellspacing='0' cellpadding='0' class='tbl'>
<tr>
<td width='250'>".$locale['EPS_014']."</td><td><input type='text' name='rang_name' value='' class='textbox' style='width:50px;'></td>
</tr>
<tr>
<td align='center' colspan='2'>
<input type='submit' name='delete_rang' value='".$locale['EPS_007']."' class='button'></td>
</tr>
</table>
</form>
";
	closetable();

echo"<br>";


opentable($locale['EPS_015']);
if (isset($_POST['add'])) {
$result = dbquery("UPDATE ".DB_USERS." SET points_bonus=points_bonus+".$_POST['bonus']." WHERE user_id='".$_POST['userid']."'");
}
       		
echo "<form name='creat_rangs' method='post' action='".FUSION_SELF.$aidlink."'>
<table align='center' width='408' cellspacing='0' cellpadding='0' class='tbl'>
<tr>
<td width=250 height=30 valign=top>".$locale['EPS_016']."</td><td><select name='userid' class='textbox'>\n".builduseroptionlist()."</select></tr>
<tr>
<td width='250'>".$locale['EPS_017']."</td><td><input type='text' name='bonus' value='' class='textbox' style='width:157px;'></td>
</tr>
<tr>
<td align='center' colspan='2'>
<input type='submit' name='add' value='".$locale['EPS_007']."' class='button'></td>
</tr>
</table>
</form>
";


if (isset($_POST['punish'])) {
$result = dbquery("UPDATE ".DB_USERS." SET points_punishment=points_punishment+".$_POST['punishment']." WHERE user_id='".$_POST['userid2']."'");
}

echo "
<form name='punish' method='post' action='".FUSION_SELF.$aidlink."'>
<table align='center' width='408' cellspacing='0' cellpadding='0' class='tbl'>
<tr>
<td width=250 height=30 valign=top>".$locale['EPS_016']."</td><td><select name='userid2' class='textbox'>\n".builduseroptionlist()."</select></tr>
</tr>
<tr>
<td width='250'>".$locale['EPS_018']."</td><td><input type='text' name='punishment' value='' class='textbox' style='width:157px;' aligh=right></td>
</tr
<tr>
<td align='center' colspan='2'>
<input type='submit' name='punish' value='".$locale['EPS_007']."' class='button'></td>
</tr>
</table>
</form>
";

if (isset($_POST['rang'])) {
$result = dbquery("UPDATE ".$db_prefix."users SET user_rang='".$_POST['set_rang']."' WHERE user_id='".$_POST['userid3']."'");
}

echo "
<form name='punish' method='post' action='".FUSION_SELF.$aidlink."'>
<table align='center' width='408' cellspacing='0' cellpadding='0' class='tbl'>
<tr>
<td width=250 height=30 valign=top>".$locale['EPS_016']."</td><td><select name='userid3' class='textbox'>\n".builduseroptionlist()."</select></tr>
<tr>
<td width='250'>".$locale['EPS_019']."</td><td><input type='text' name='set_rang' value='' class='textbox' style='width:157px;'></td>
</tr
<tr>
<td align='center' colspan='2'>
<input type='submit' name='rang' value='".$locale['EPS_007']."' class='button'></td>
</tr>
</table>
</form>
";

if (isset($_POST['sp'])) {
$result = dbquery("UPDATE ".$db_prefix."users SET user_points='".$_POST['set_sp']."' WHERE user_id='".$_POST['userid4']."'");
}

echo "
<form name='sp' method='post' action='".FUSION_SELF.$aidlink."'>
<table align='center' width='408' cellspacing='0' cellpadding='0' class='tbl'>
<tr>
<td width=250 height=30 valign=top>".$locale['EPS_016']."</td><td><select name='userid4' class='textbox'>\n".builduseroptionlist()."</select></tr>
<tr>
<td width='250'>".$locale['EPS_020']."</td><td><input type='text' name='set_sp' value='' class='textbox' style='width:157px;'></td>
</tr
<tr>
<td align='center' colspan='2'>
<input type='submit' name='sp' value='".$locale['EPS_007']."' class='button'></td>
</tr>
</table>
</form>
";



closetable();
require_once THEMES."templates/footer.php";
?>
