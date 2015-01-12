<?php
//	|---------------------------------------------------------------------------|
//	|	PHP-Fusion 7 Content Management System									|
//	|	Copyright � 2002 - 2005 Nick Jones										|
//	|	http://www.php-fusion.co.uk/											|
//	|---------------------------------------------------------------------------|
//	| 	This program is released as free software under the						|
//	| 	Affero GPL license. You can redistribute it and/or						|
//	| 	modify it under the terms of this license which you						|
//	| 	can read by viewing the included agpl.txt or online						|
//	| 	at www.gnu.org/licenses/agpl.html. Removal of this						|
//	| 	copyright header is strictly prohibited without							|
//	| 	written permission from the original author(s).							|
//	|---------------------------------------------------------------------------|
//	|	xShoutBox Panel															|
//	|	Copyright � 2008 Rizald 'Elyn' Maxwell									|
//	|	www.NubsPixel.com														|
//	|	Filename : xSBox_archive.php											|
//	|	Read the source easier via Notepad++ 									|
//	|		comment fonts changed - Courrier New, 10pt							|
//	|---------------------------------------------------------------------------|
//	|	For more informations, please refer to README.TXT						|
//	|---------------------------------------------------------------------------|
require_once "../../maincore.php";
require_once THEMES."templates/header.php";
require_once "includes/functions.php";

$result = dbquery("SELECT panel_access FROM ".DB_PANELS." WHERE panel_filename='shoutbox_panel' AND panel_status='1'");
if (dbrows($result)) {
	$data = dbarray($result);
	if (!checkgroup($data['panel_access'])) {
		redirect(BASEDIR."index.php");
	}
} else {
	redirect(BASEDIR."index.php");
}

if (iMEMBER && (isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['shout_id']) && isnum($_GET['shout_id']))) {
	if ((iADMIN && checkrights("S")) || (iMEMBER && dbcount("(shout_id)", DB_SHOUTBOX, "shout_id='".$_GET['shout_id']."' AND shout_name='".$userdata['user_id']."'"))) {
		$result = dbquery("DELETE FROM ".DB_SHOUTBOX." WHERE shout_id='".$_GET['shout_id']."'".(iADMIN ? "" : " AND shout_name='".$userdata['user_id']."'"));
	}
	redirect(FUSION_SELF);
}

add_to_title($locale['global_200'].$locale['global_155']);

opentable($locale['global_155']);
if (iMEMBER || $settings['guestposts'] == "1") {
	include_once INCLUDES."bbcode_include.php";
	if (isset($_POST['post_ashout'])) {
		$flood = false;
		if (iMEMBER) {
			$shout_name = $userdata['user_id'];
		} elseif ($settings['guestposts'] == "1") {
			$shout_name = trim(stripinput($_POST['shout_name']));
			$shout_name = preg_replace("(^[0-9]*)", "", $shout_name);
			if (isnum($shout_name)) { $shout_name = ""; }
			include_once INCLUDES."securimage/securimage.php";
			$securimage = new Securimage();
			if (!isset($_POST['captcha_code']) || $securimage->check($_POST['captcha_code']) == false) { redirect($link); }
		}
		$shout_message = str_replace("\n", " ", $_POST['shout_message']);
		$shout_message = preg_replace("/^(.{255}).*$/", "$1", $shout_message);
		$shout_message = trim(stripinput(censorwords($shout_message)));
		if (iMEMBER && (isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['shout_id']) && isnum($_GET['shout_id']))) {
			$comment_updated = false;
			if ((iADMIN && checkrights("S")) || (iMEMBER && dbcount("(shout_id)", DB_SHOUTBOX, "shout_id='".$_GET['shout_id']."' AND shout_name='".$userdata['user_id']."'"))) {
				if ($shout_message) {
					$result = dbquery("UPDATE ".DB_SHOUTBOX." SET shout_message='$shout_message' WHERE shout_id='".$_GET['shout_id']."'".(iADMIN ? "" : " AND shout_name='".$userdata['user_id']."'"));
				}
			}
			redirect(FUSION_SELF);
		} elseif ($shout_name && $shout_message) {
			require_once INCLUDES."flood_include.php";
			if (!flood_control("shout_datestamp", DB_SHOUTBOX, "shout_ip='".USER_IP."'")) {
				$result = dbquery("INSERT INTO ".DB_SHOUTBOX." (shout_name, shout_message, shout_datestamp, shout_ip) VALUES ('$shout_name', '$shout_message', '".time()."', '".USER_IP."')");
			}
			redirect(FUSION_SELF);
		}
	}
	if (iMEMBER && (isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['shout_id']) && isnum($_GET['shout_id']))) {
		$esresult = dbquery(
			"SELECT ts.*, tu.user_id, tu.user_name FROM ".DB_SHOUTBOX." ts
			LEFT JOIN ".DB_USERS." tu ON ts.shout_name=tu.user_id
			WHERE ts.shout_id='".$_GET['shout_id']."'"
		);
		if (dbrows($esresult)) {
			$esdata = dbarray($esresult);
			if ((iADMIN && checkrights("S")) || (iMEMBER && $esdata['shout_name'] == $userdata['user_id'] && isset($esdata['user_name']))) {
				if ((isset($_GET['action']) && $_GET['action'] == "edit") && (isset($_GET['shout_id']) && isnum($_GET['shout_id']))) {
					$edit_url = "?action=edit&amp;shout_id=".$esdata['shout_id'];
				} else {
					$edit_url = "";
				}
				$shout_link = FUSION_SELF.$edit_url;
				$shout_message = $esdata['shout_message'];
			}
		} else {
			$shout_link = FUSION_SELF;
			$shout_message = "";
		}
	} else {
		$shout_link = FUSION_SELF;
		$shout_message = "";
	}
	echo "<a id='edit_shout' name='edit_shout'></a>\n";
	echo "<form name='chatform2' method='post' action='".$shout_link."'>\n";
	echo "<div style='text-align:center'>\n";
	if (iGUEST) {
		echo $locale['global_151']."<br />\n";
		echo "<input type='text' name='shout_name' value='' class='textbox' maxlength='30' style='width:200px;' /><br />\n";
		echo $locale['global_152']."<br />\n";
	}
	echo "<textarea name='shout_message' rows='4' cols='50' class='textbox'>".$shout_message."</textarea><br />\n";
	echo "<div style='text-align:center'>".display_bbcodes("100%", "shout_message", "chatform2", "smiley|b|i|u|url|color")."</div>\n";
	if (iGUEST) {
		echo $locale['global_158']."<br />\n";
		echo "<img id='captcha' src='".INCLUDES."securimage/securimage_show.php' alt='' /><br />\n";
    echo "<a href='".INCLUDES."securimage/securimage_play.php'><img src='".INCLUDES."securimage/images/audio_icon.gif' alt='' class='tbl-border' style='margin-bottom:1px' /></a>\n";
    echo "<a href='#' onclick=\"document.getElementById('captcha').src = '".INCLUDES."securimage/securimage_show.php?sid=' + Math.random(); return false\"><img src='".INCLUDES."securimage/images/refresh.gif' alt='' class='tbl-border' /></a><br />\n";
		echo $locale['global_159']."<br />\n<input type='text' name='captcha_code' class='textbox' style='width:100px' /><br />\n";
	}
	echo "<br /><input type='submit' name='post_ashout' value='".$locale['global_153']."' class='button' />\n";
	echo "</div>\n</form>\n<br />\n";
} else {
	echo "<div style='text-align:center'>".$locale['global_154']."</div>\n";
}
$rows = dbcount("(shout_id)", DB_SHOUTBOX);
if (!isset($_GET['rowstart']) || !isnum($_GET['rowstart'])) { $_GET['rowstart'] = 0; }
if ($rows != 0) {
	$result = dbquery(
		"SELECT * FROM ".DB_SHOUTBOX." LEFT JOIN ".DB_USERS."
		ON ".DB_SHOUTBOX.".shout_name=".DB_USERS.".user_id
		ORDER BY shout_datestamp DESC LIMIT ".$_GET['rowstart'].",20"
	);
	while ($data = dbarray($result)) {
		echo "<div class='tbl2'>\n";
		if ((iADMIN && checkrights("S")) || (iMEMBER && $data['shout_name'] == $userdata['user_id'] && isset($data['user_name']))) {
			echo "<div style='float:right'>\n<a href='".FUSION_SELF."?action=edit&amp;shout_id=".$data['shout_id']."'>".$locale['global_076']."</a> |\n";
			echo "<a href='".FUSION_SELF."?action=delete&amp;shout_id=".$data['shout_id']."'>".$locale['global_157']."</a>\n</div>\n";
		}
		if ($data['user_name']) {
			echo "<span class='comment-name'><a href='".BASEDIR."profile.php?lookup=".$data['shout_name']."' class='slink'>".$data['user_name']."</a></span>\n";
		} else {
			echo "<span class='comment-name'>".$data['shout_name']."</span>\n";
		}
		echo "<span class='small'>".showdate("longdate", $data['shout_datestamp'])."</span>";
		echo "</div>\n<div class='tbl1'>\n".sbawrap(make_clickable(parseubb(parsesmileys($data['shout_message']), "b|i|u|color")))."</div>\n";
	}
} else {
	echo "<div style='text-align:center'><br />\n".$locale['global_156']."<br /><br />\n</div>\n";
}
closetable();

echo "<div align='center' style='margin-top:5px;'>\n".makepagenav($_GET['rowstart'], 20, $rows, 3, FUSION_SELF."?")."\n</div>\n";

require_once THEMES."templates/footer.php";
?>
