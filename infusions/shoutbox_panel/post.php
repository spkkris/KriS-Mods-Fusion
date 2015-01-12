<?php
//	|---------------------------------------------------------------------------|
//	|	PHP-Fusion 7 Content Management System									|
//	|	Copyright © 2002 - 2005 Nick Jones										|
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
//	|	Copyright © 2008 Rizald 'Elyn' Maxwell									|
//	|	www.NubsPixel.com														|
//	|	Filename : post.php														|
//	|	Read the source easier via Notepad++ 									|
//	|		comment fonts changed - Courrier New, 10pt							|
//	|---------------------------------------------------------------------------|
//	|	For more informations, please refer to README.TXT						|
//	|---------------------------------------------------------------------------|

// get maincore basedir
$folder_level = ""; $i = 0;
while (!file_exists($folder_level."config.php")) { 
	$folder_level .= "../"; $i++;
	if ($i == 5) { die("Config file not found"); }
}
require_once $folder_level."config.php";
define("BASEDIR2", $folder_level);

require_once BASEDIR2."maincore.php";

$result = dbquery("SELECT * FROM ".DB_ONLINE." WHERE online_user=".($userdata['user_level'] != 0 ? "'".$userdata['user_id']."'" : "'0' AND online_ip='".USER_IP."'"));
if (dbrows($result)) {
	$result = dbquery("UPDATE ".DB_ONLINE." SET online_lastactive='".time()."' WHERE online_user=".($userdata['user_level'] != 0 ? "'".$userdata['user_id']."'" : "'0' AND online_ip='".USER_IP."'")."");
} else {
	$result = dbquery("INSERT INTO ".DB_ONLINE." (online_user, online_ip, online_lastactive) VALUES ('".($userdata['user_level'] != 0 ? $userdata['user_id'] : "0")."', '".USER_IP."', '".time()."')");
}
$result = dbquery("DELETE FROM ".DB_ONLINE." WHERE online_lastactive<".(time()-60)."");


if(isset($_POST['act'])){
	if($_POST['act'] == "new" || $_POST['act']== 'edt'){
		$captcha = true;
		if (iMEMBER) {
			$shout_name = $userdata['user_id'];
		} elseif ($settings['guestposts'] == "1") {
			$shout_name = trim(stripinput($_POST['shout_name']));
			$shout_name = preg_replace("(^[0-9]*)", "", $shout_name);
			if (isnum($shout_name)) { $shout_name = ""; }
			include_once INCLUDES."securimage/securimage.php";
			$securimage = new Securimage();
			if (!isset($_POST['sb_captcha_code']) || $securimage->check($_POST['sb_captcha_code']) == false) { 
				$captcha = false;
			}
		}
		if($captcha){
			$shout_message = str_replace("\n", " ", $_POST['shout_message']);
			$shout_message = preg_replace("/^(.{255}).*$/", "$1", $shout_message);
			$shout_message = trim(stripinput(censorwords($shout_message)));
			if (iMEMBER && ($_POST['act']== 'edt') && (isset($_POST['shout_id']) && isnum($_POST['shout_id']))) {
				$comment_updated = false;
				if ((iADMIN && checkrights("S")) || (iMEMBER && dbcount("(shout_id)", DB_SHOUTBOX, "shout_id='".$_POST['shout_id']."' AND shout_name='".$userdata['user_id']."'"))) {
					if ($shout_message) {
						$result = dbquery("UPDATE ".DB_SHOUTBOX." SET shout_message='$shout_message' WHERE shout_id='".$_POST['shout_id']."'".(iADMIN ? "" : " AND shout_name='".$userdata['user_id']."'"));
					}
				}
			} elseif ($shout_name && $shout_message) {
				$result = dbquery("INSERT INTO ".DB_SHOUTBOX." (shout_name, shout_message, shout_datestamp, shout_ip) VALUES ('$shout_name', '$shout_message', '".time()."', '".USER_IP."')");
			}
		}
	}
	else if($_POST['act']== 'del'){
		if (iMEMBER && (isset($_POST['shout_id']) && isnum($_POST['shout_id']))) {
			if ((iADMIN && checkrights("S")) || (iMEMBER && dbcount("(shout_id)", DB_SHOUTBOX, "shout_id='".$_POST['shout_id']."' AND shout_name='".$userdata['user_id']."'"))) {
				$result = dbquery("DELETE FROM ".DB_SHOUTBOX." WHERE shout_id='".$_POST['shout_id']."'".(iADMIN ? "" : " AND shout_name='".$userdata['user_id']."'"));
			}
		}
	}
}
?>