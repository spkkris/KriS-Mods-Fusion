<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: nicks_mod_admin.php
| Author: bartek124
| E-Mail: bartek124@php-fusion.pl
| Web: http://bartek124.php-fusion.pl
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
require_once THEMES."templates/admin_header.php";
include LOCALE.LOCALESET."admin/nicks_mod.php";
include INCLUDES."nicks_mod/nicks_mod_func.php";

if (!checkrights("NMP") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../../index.php"); }
if(isset($_GET['nicks_id']) && (!isnum($_GET['nicks_id']) && $_GET['nicks_id'] != "l103" && $_GET['nicks_id'] != "l102")) {redirect(FUSION_SELF.$aidlink); }




if(isset($_GET['message'])) {
	if($_GET['message'] == "added") {
		echo "<div class='admin-message'>".$locale['nmp_mes1']."</div>";
	} elseif($_GET['message'] == "edited") {
		echo "<div class='admin-message'>".$locale['nmp_mes2']."</div>";
	} elseif($_GET['message'] == "deleted") {
		echo "<div class='admin-message'>".$locale['nmp_mes3']."</div>";
	} elseif($_GET['message'] == "error1") {
		echo "<div class='admin-message'>".$locale['nmp_mes4']."</div>";
	} else {
		echo "";
	}
}

if(isset($_POST['save_nicks_settings'])) {
	if(!empty($_POST['nicks_color']) && preg_check("/^[\#a-f0-9]+$/i", $_POST['nicks_color'])) {
		if(isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['nicks_id'])) {
			$nick_styles = ", nicks_styles='".(isset($_POST['nicks_bold']) ? $_POST['nicks_bold'] : "").(isset($_POST['nicks_italic']) ? $_POST['nicks_italic'] : "").(isset($_POST['nicks_underline']) ? $_POST['nicks_underline'] : "")."'";
				$result = dbquery("UPDATE ".DB_NICKS_MOD." SET nicks_color='".$_POST['nicks_color']."', nicks_prefix='".stripinput($_POST['nicks_prefix'])."'".$nick_styles." WHERE nicks_group_id='".$_POST['nicks_group_id']."'");
				generate_cache_file();
				redirect(FUSION_SELF.$aidlink."&message=edited");
		} else {
			if(dbrows(dbquery("SELECT nicks_group_id FROM ".DB_NICKS_MOD." WHERE nicks_group_id='".$_POST['nicks_group_id']."'")) == 0) {
				$nick_styles = (isset($_POST['nicks_bold']) ? $_POST['nicks_bold'] : "").(isset($_POST['nicks_italic']) ? $_POST['nicks_italic'] : "").(isset($_POST['nicks_underline']) ? $_POST['nicks_underline'] : "");
				$result = dbquery("INSERT INTO ".DB_NICKS_MOD." (nicks_group_id, nicks_color, nicks_prefix, nicks_styles) VALUES ('".$_POST['nicks_group_id']."', '".$_POST['nicks_color']."', '".(!empty($_POST['nicks_prefix']) ? stripinput($_POST['nicks_prefix']) : "")."', '".$nick_styles."')");
				generate_cache_file();
				redirect(FUSION_SELF.$aidlink."&message=added");
			} else {
				$nick_styles = (isset($_POST['nicks_bold']) || isset($_POST['nicks_italic']) || isset($_POST['nicks_underline']) ? ", nicks_styles='".(isset($_POST['nicks_bold']) ? $_POST['nicks_bold'] : "").(isset($_POST['nicks_italic']) ? $_POST['nicks_italic'] : "").(isset($_POST['nicks_underline']) ? $_POST['nicks_underline'] : "")."'" : "");
				$result = dbquery("UPDATE ".DB_NICKS_MOD." SET nicks_color='".$_POST['nicks_color']."'".(!empty($_POST['nicks_prefix']) ? ", nicks_prefix='".stripinput($_POST['nicks_prefix'])."'" : "").$nick_styles." WHERE nicks_group_id='".$_POST['nicks_group_id']."'");
				generate_cache_file();
				redirect(FUSION_SELF.$aidlink."&message=edited");
			}
		}
	} else {
		redirect(FUSION_SELF.$aidlink."&message=error1");
	}
} elseif (isset($_POST['delete_selected'])) {
	$groups_ids = "";
	foreach($_POST['group_ids'] as $group_id) {
		$groups_ids .= ($groups_ids  ? "," : "").$group_id;; 
	}
	$result = dbquery("DELETE FROM ".DB_NICKS_MOD." WHERE nicks_group_id IN (".$groups_ids.")");
	generate_cache_file();
	redirect(FUSION_SELF.$aidlink."&message=deleted");
}
if(isset($_GET['action']) && $_GET['action'] == "edit" && isset($_GET['nicks_id'])) {
	$result1 = dbquery("SELECT * FROM ".DB_NICKS_MOD." WHERE nicks_group_id='".$_GET['nicks_id']."'");
	$data1 = dbarray($result1);
	$nicks_color = $data1['nicks_color'];
	$nicks_prefix = $data1['nicks_prefix'];
	if (preg_match("/bold/i", $data1['nicks_styles'])) {
		$nicks_bold = " checked='checked'";
	} else {
		$nicks_bold = "";
	}
	if (preg_match("/italic/i", $data1['nicks_styles'])) {
		$nicks_italic = " checked='checked'";
	} else {
		$nicks_italic = "";
	}
	if (preg_match("/underline/i", $data1['nicks_styles'])) {
		$nicks_underline = " checked='checked'";
	} else {
		$nicks_underline = "";
	}
	$formaction = FUSION_SELF.$aidlink."&amp;action=edit&amp;nicks_id=".$data1['nicks_group_id'];
	$groups = "<input type='hidden' name='nicks_group_id' value='".$data1['nicks_group_id']."' />\n".getgroupname(str_replace("l", "", $data1['nicks_group_id']));
} else {
	$nicks_color = "";
	$nicks_prefix = "";
	$nicks_bold = "";
	$nicks_italic = "";
	$nicks_underline = "";
	$formaction = FUSION_SELF.$aidlink;
	$result = dbquery("SELECT group_id, group_name FROM ".DB_USER_GROUPS);
	$groups = "<select name='nicks_group_id' class='textbox' style='width:150px;'>\n";
	$groups .= "<option value='l103'>".$locale['user3']."</option>\n";
	$groups .= "<option value='l102'>".$locale['user2']."</option>\n";
	while($data = dbarray($result)) {
		$groups .= "<option value='".$data['group_id']."'>".$data['group_name']."</option>\n";
	}
	$groups .= "</select>\n";
}
opentable($locale['nmp_settings1']);
echo "<form name='settings_form' method='post' action='".$formaction."'>\n";
echo "<table align='center' width='250px' cellspacing='0' cellpadding='0'>\n<tr>\n";
echo "<td align='right' class='tbl'>".$locale['nmp_settings2']."</td>\n<td class='tbl'>\n";
echo $groups;
echo "</td>\n";
echo "</tr>\n<tr>\n";
echo "<td align='right' class='tbl'>".$locale['nmp_settings3']."</td>\n<td class='tbl'>\n<input type='text' name='nicks_color' class='textbox' value='".$nicks_color."' maxlength='7' style='width:70px;' />\n ".color_mapper("nicks_color", $nicks_color)."\n</td>\n";
echo "</tr>\n<tr>\n";
echo "<td align='right' class='tbl'>".$locale['nmp_settings4']."</td>\n<td class='tbl'>\n<input type='text' name='nicks_prefix' class='textbox' value='".$nicks_prefix."' maxlength='2' style='width:70px;' />\n</td>\n";
echo "</tr>\n<tr>\n";
echo "<td align='right' class='tbl'>".$locale['nmp_settings5']."</td>\n<td class='tbl' align='left'>\n<span style='font-weight:bold;'>B</span> <input type='checkbox' name='nicks_bold' class='textbox' value='font-weight:bold;' style='vertical-align:middle;'".$nicks_bold." />\n | <span style='font-style:italic;'>I</span> <input type='checkbox' name='nicks_italic' class='textbox' value='font-style:italic;' style='vertical-align:middle;'".$nicks_italic." />\n | <span style='text-decoration:underline;'>U</span> <input type='checkbox' name='nicks_underline' class='textbox' value='text-decoration:underline;' style='vertical-align:middle;'".$nicks_underline." />\n</td>\n";
echo "</tr>\n<tr>\n";
echo "<td colspan='2' align='center' class='tbl'>\n<br /><input type='submit' class='button' name='save_nicks_settings' value='".$locale['nmp_settings6']."' />\n</td>\n";
echo "</tr>\n</table>\n";
echo "</form>\n";
closetable();

$result = dbquery("SELECT nm.*, g.group_name,g.group_description FROM ".DB_NICKS_MOD." nm
					LEFT JOIN ".DB_USER_GROUPS." g ON g.group_id = nm.nicks_group_id
					ORDER BY g.group_id ASC");

opentable($locale['nmp_show1']);
echo "<form name='delete_form' method='post' action='".FUSION_SELF.$aidlink."'>\n";
echo "<table align='center' width='400px' cellspacing='1' cellpadding='0' class='tbl-border' border='0'>\n<tr>\n";
echo "<th width='50%' class='tbl1' colspan='2'>".$locale['nmp_show2']."</td>\n";
echo "<th width='25%' class='tbl1'>".$locale['nmp_show3']."</td>\n";
echo "<th width='25%' class='tbl1'>".$locale['nmp_show4']."</td>\n";
echo "</tr>\n";
$i = 0;
while($data = dbarray($result)) {
	$class = ($i % 2 == 0 ? "tbl1" : "tbl2");
	
	if($data['nicks_group_id'] == 'l103') {
		echo "<tr>\n";
		echo "<td class='tbl2'></td>\n";
		echo "<td class='tbl2'><a href='".FUSION_SELF.$aidlink."&amp;action=edit&amp;nicks_id=".$data['nicks_group_id']."'>".$locale['user3']."</a></td>\n";
		echo "<td class='tbl2' align='center'><div style='float:right;width:22px;height:12px;border:1px solid black;background-color:".$data['nicks_color'].";'>&nbsp;</div>".$data['nicks_color']."&nbsp;&nbsp;</td>\n";
		echo "<td class='tbl2' align='center'><a href='".BASEDIR."profile.php?lookup=".$userdata['user_id']."' style='color:".$data['nicks_color'].";".$data['nicks_styles']."'>".$data['nicks_prefix'].$userdata['user_name']."</a></td>\n";
		echo "</tr>\n";
	} elseif($data['nicks_group_id'] == 'l102') {
		echo "<tr>\n";
		echo "<td class='tbl1'></td>\n";
		echo "<td class='tbl1'><a href='".FUSION_SELF.$aidlink."&amp;action=edit&amp;nicks_id=".$data['nicks_group_id']."'>".$locale['user2']."</a></td>\n";
		echo "<td class='tbl1' align='center'><div style='float:right;width:22px;height:12px;border:1px solid black;background-color:".$data['nicks_color'].";'>&nbsp;</div>".$data['nicks_color']."&nbsp;&nbsp;</td>\n";
		echo "<td class='tbl1' align='center'><a href='".BASEDIR."profile.php?lookup=".$userdata['user_id']."' style='color:".$data['nicks_color'].";".$data['nicks_styles']."'>".$data['nicks_prefix'].$userdata['user_name']."</a></td>\n";
		echo "</tr>\n";
	} else {
		echo "<tr>\n";
		echo "<td class='".$class."' align='center'><input type='checkbox' name='group_ids[]' value='".$data['nicks_group_id']."' /></td>\n";
		echo "<td class='".$class."'><a href='".FUSION_SELF.$aidlink."&amp;action=edit&amp;nicks_id=".$data['nicks_group_id']."'>".$data['group_name']."</a></td>\n";
		echo "<td class='".$class."' align='center'><div style='float:right;width:22px;height:12px;border:1px solid black;background-color:".$data['nicks_color'].";'>&nbsp;</div>".$data['nicks_color']."&nbsp;&nbsp;</td>\n";
		echo "<td class='".$class."' align='center'><a href='".BASEDIR."profile.php?lookup=".$userdata['user_id']."' style='color:".$data['nicks_color'].";".$data['nicks_styles']."'>".$data['nicks_prefix'].$userdata['user_name']."</a></td>\n";
		echo "</tr>\n";
		$i++;
	}
}
if($i != 0) {
	echo "<tr>\n<td width='50%' class='tbl1' colspan='4' align='right'><input type='submit' name='delete_selected' value='".$locale['nmp_show5']."' class='button' onclick=\"return checkChecked('delete_form', 'group_ids[]');\" /></td>\n</tr>\n";
}
echo "</table>\n";
echo "</form>\n";
closetable();

echo "<script type='text/javascript'>\n";
echo "function checkChecked(frmName,chkName) {
		dml=document.forms[frmName];
		len=dml.elements.length;
		checked=0;
		for(i=0;i < len;i++) {
			if(dml.elements[i].name == chkName && dml.elements[i].checked!=0) {
				checked++;
			}
		}
		if(checked == 0) {
			alert('".$locale['nmp_show6']."');
			return false;
		} else {
			agree=confirm('".$locale['nmp_show7']."');
			if(!agree) {
				return false;
			}
		}
	}";
echo "</script>\n";

require_once THEMES."templates/footer.php";
?>
