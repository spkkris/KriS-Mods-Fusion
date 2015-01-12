<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: user_primarygroup_include.php
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
if (!defined("IN_FUSION")) { die("Access Denied"); }

if ($profile_method == "input") {
		if(iMEMBER) {
			include INCLUDES.'nicks_mod/nicks_mod_cache.php';
			$usergroups = (strpos($user_data['user_groups'], ".") == 0 ? explode(".", substr($user_data['user_groups'], 1)) : explode(".", $user_data['user_groups']));
			if($user_data['user_level'] == "102" || $user_data['user_level'] == "103") {
					$usergroups[] = "l".$user_data['user_level'];
					$usergroups = array_reverse($usergroups);
			}
		
			$groups=""; $i=0;
			foreach($usergroups as $usergroup) {
				if(array_key_exists($usergroup, $nicks_mod_cache)) {
						$groups .= "<option value='".$usergroup."'".($usergroup == $user_data['user_primarygroup'] ? " selected='selected'" : "")." style='color:".$nicks_mod_cache[$usergroup][0].";".$nicks_mod_cache[$usergroup][2]."'>".$nicks_mod_cache[$usergroup][1].getgroupname(str_replace("l","",$usergroup))."</option>";
						$i++;
				}
			}
		if($i > 1) {
			echo "<tr>\n";
			echo "<td class='tbl'>".$locale['uf_primarygroup'].":</td>\n";
			echo "<td class='tbl'><select name='user_primarygroup' class='textbox' style='width:100px;'>";
			echo $groups;
			echo "</select></td>\n";
			echo "</tr>\n";
		}
	}
} elseif ($profile_method == "display") {
} elseif ($profile_method == "validate_insert") {
	$db_fields .= ", user_primarygroup";
	$db_values .= ", '".(isset($_POST['user_primarygroup']) ? $_POST['user_primarygroup'] : "")."'";
} elseif ($profile_method == "validate_update") {
	$db_values .= ", user_primarygroup='".(isset($_POST['user_primarygroup']) ? $_POST['user_primarygroup'] : "")."'";
}
?>
