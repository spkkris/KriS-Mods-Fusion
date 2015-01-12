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
//	|	Filename : json_page.php												|
//	|	Read the source easier via Notepad++ 									|
//	|		comment fonts changed - Courrier New, 10pt							|
//	|---------------------------------------------------------------------------|
//	|	For more informations, please refer to README.TXT						|
//	|---------------------------------------------------------------------------|

															
//	|-------------------|	required source files			|-------------------|
require_once "../../../maincore.php";
require_once "functions.php";
if( !function_exists('json_encode') ) {
	require_once "json.php";
}

if(empty($_GET['act']))
	echo "{\"error\":\"Cannot get data generated via json without the correct parameter\"}";
else{
	$act = $_GET['act'];
	// shouts data
	if ($act == 'chat'){
		if(isset($_GET['q']) && $_GET['q'] == 'all'){
			$numrows = dbcount("(shout_id)", DB_SHOUTBOX);
			$result = dbquery(
				"SELECT ts.*, tu.user_id, tu.user_name FROM ".DB_SHOUTBOX." ts
				LEFT JOIN ".DB_USERS." tu ON ts.shout_name=tu.user_id
				ORDER BY ts.shout_datestamp DESC LIMIT 0,".$settings['numofshouts']
			);
			if (dbrows($result)) {
				$i = 0; $a = "";
				while ($data = dbarray($result)) {
					$a[$i]['shout_id'] = $data['shout_id'];
					// username
					if ($data['user_name']) {
						//--- online users
						$que2 = "SELECT online_user FROM ".DB_ONLINE." WHERE online_user=".$data['shout_name'];
						$res2 = dbquery($que2);
						if ($db = dbarray($res2)) {
							$a[$i]['user_online']	= 1;
						} else {
							$a[$i]['user_online']	= 0;
						}
						//--- online users
						//--- tooltip users
						$que2 = "SELECT * FROM ".DB_USERS." WHERE user_id=".$data['shout_name'];
						$res2 = dbquery($que2);
						if ($db = dbarray($res2)) {
							if(isset($db['user_avatar']))
								$a[$i]['user_avatar']	= $db['user_avatar'];
							else
								$a[$i]['user_avatar']	= false;
							
							$a[$i]['shout_name'] 	= $data['shout_name'];
							$a[$i]['user_name'] 	= $data['user_name'];
							$a[$i]['user_level']	= setULcolour($db['user_level'],getuserlevel($db['user_level']));
							$a[$i]['user_level2']	= $db['user_level'];
							$a[$i]['user_loc']		= $db['user_location'];
							$a[$i]['user_web']		= $db['user_web'];
						}
						//--- tooltip users
					} else {
						$a[$i]['user_name'] = $data['shout_name'];
						$a[$i]['shout_name'] 	= 0;
						$a[$i]['user_avatar']	= "";
						$a[$i]['user_level']	= "";
						$a[$i]['user_level2']	= 0;
						$a[$i]['user_loc']		= "";
						$a[$i]['user_sig']		= "";
						$a[$i]['user_web']		= "";
					}
					
					// date
					$a[$i]['date'] =showdate("shortdate", $data['shout_datestamp']);
					
					// message
					$a[$i]['chat'] = sbwrap(make_clickable(parseubb(parsesmileys2($data['shout_message']), "b|i|u|color")));
					$a[$i]['chat2'] = $data['shout_message'];
					if ((iADMIN && checkrights("S")))
						$a[$i]['admin'] = 1;
					if ((iMEMBER && $data['shout_name'] == $userdata['user_id'] && isset($data['user_name'])))
						$a[$i]['self'] = 1;
					if ($numrows > $settings['numofshouts']) {
						$a[$i]['archive'] = 1;
					}
					$i++;
				}
				if (!empty($a))
					echo json_encode($a);
				else
					echo '{"no_post":"0"}';
			}
		}
		else if(isset($_GET['q']) && $_GET['q'] == 'top' && isset($_GET['p']) && isnum($_GET['p'])){
			$p = $_GET['p'];
			$numrows = dbcount("(shout_id)", DB_SHOUTBOX);
			$result = dbquery(
				"SELECT ts.*, tu.user_id, tu.user_name FROM ".DB_SHOUTBOX." ts
				LEFT JOIN ".DB_USERS." tu ON ts.shout_name=tu.user_id
				WHERE shout_id > {$p}
				ORDER BY ts.shout_datestamp DESC LIMIT 0,1"
			);
			if (dbrows($result)) {
				$a = "";
				while ($data = dbarray($result)) {
					$a[0]['shout_id'] = $data['shout_id'];
					// username
					if ($data['user_name']) {
						$a[0]['user_name'] = $data['user_name'];
						$a[0]['shout_name'] = $data['shout_name'];
						//--- online users
						$que2 = "SELECT online_user FROM ".DB_ONLINE." WHERE online_user=".$data['shout_name'];
						$res2 = dbquery($que2);
						if ($db = dbarray($res2)) {
							$a[0]['user_online']	= 1;
						} else {
							$a[0]['user_online']	= 0;
						}
						//--- online users
						//--- tooltip users
						$que2 = "SELECT * FROM ".DB_USERS." WHERE user_id=".$data['shout_name'];
						$res2 = dbquery($que2);
						if ($db = dbarray($res2)) {
							if(isset($db['user_avatar']))
								$a[0]['user_avatar']	= $db['user_avatar'];
							else
								$a[0]['user_avatar']	= false;
								
							$a[0]['shout_name'] 	= $data['shout_name'];
							$a[0]['user_name'] 		= $data['user_name'];
							$a[0]['user_level']		= setULcolour($db['user_level'],getuserlevel($db['user_level']));
							$a[0]['user_level2']	= $db['user_level'];
							$a[0]['user_loc']		= $db['user_location'];
							$a[0]['user_web']		= $db['user_web'];
						}
						//--- tooltip users
					} else {
						$a[0]['user_name'] 		= $data['shout_name'];
						$a[0]['shout_name'] 	= 0;
						$a[0]['user_avatar']	= "";
						$a[0]['user_level']		= "";
						$a[0]['user_level2']	= 0;
						$a[0]['user_loc']		= "";
						$a[0]['user_sig']		= "";
						$a[0]['user_web']		= "";
					}
					
					// date
					$a[0]['date'] =showdate("shortdate", $data['shout_datestamp']);
					
					// message
					$a[0]['chat'] = sbwrap(make_clickable(parseubb(parsesmileys2($data['shout_message']), "b|i|u|url|color")));
					$a[0]['chat2'] = $data['shout_message'];
					if (iADMIN && checkrights("S"))
						$a[0]['admin'] = 1;
					if (iMEMBER && $data['shout_name'] == $userdata['user_id'] && isset($data['user_name']))
						$a[0]['self'] = 1;
					if ($numrows > $settings['numofshouts']) {
						$a[0]['archive'] = 1;
					}
//					$i++;
				}
				if (!empty($a))
					echo json_encode($a);
			}
			else
				echo '{"no_post":"0"}';
		}
		else if(isset($_GET['q']) && $_GET['q'] == 'bot' && isset($_GET['p']) && isnum($_GET['p'])){
			$q = $_GET['q']+1;
			$numrows = dbcount("(shout_id)", DB_SHOUTBOX);
			$result = dbquery(
				"SELECT ts.*, tu.user_id, tu.user_name FROM ".DB_SHOUTBOX." ts
				LEFT JOIN ".DB_USERS." tu ON ts.shout_name=tu.user_id
				WHERE shout_id < {$_GET['p']}
				ORDER BY ts.shout_datestamp DESC 
				LIMIT 0,1"
			);
			if (dbrows($result)) {
				$a = "";
				while ($data = dbarray($result)) {
					$a[0]['shout_id'] = $data['shout_id'];
					// username
					if ($data['user_name']) {
						$a[0]['user_name']	= $data['user_name'];
						$a[0]['shout_name']	= $data['shout_name'];
						//--- online users
						$que2 = "SELECT online_user FROM ".DB_ONLINE." WHERE online_user=".$data['shout_name'];
						$res2 = dbquery($que2);
						if ($db = dbarray($res2)) {
							$a[0]['user_online']	= 1;
						} else {
							$a[0]['user_online']	= 0;
						}
						//--- online users
						//--- tooltip users
						$que2 = "SELECT * FROM ".DB_USERS." WHERE user_id=".$data['shout_name'];
						$res2 = dbquery($que2);
						if ($db = dbarray($res2)) {
							if(isset($db['user_avatar']))
								$a[0]['user_avatar']	= $db['user_avatar'];
							else
								$a[0]['user_avatar']	= false;
								
							$a[0]['shout_name'] 	= $data['shout_name'];
							$a[0]['user_name'] 		= $data['user_name'];
							$a[0]['user_level']		= setULcolour($db['user_level'],getuserlevel($db['user_level']));
							$a[0]['user_level2']	= $db['user_level'];
							$a[0]['user_loc']		= $db['user_location'];
							$a[0]['user_web']		= $db['user_web'];
						}
						//--- tooltip users
					} else {
						$a[0]['user_name'] 		= $data['shout_name'];
						$a[0]['shout_name'] 	= 0;
						$a[0]['user_avatar']	= "";
						$a[0]['user_level']		= "";
						$a[0]['user_level2']	= 0;
						$a[0]['user_loc']		= "";
						$a[0]['user_sig']		= "";
						$a[0]['user_web']		= "";
					}
					
					// date
					$a[0]['date'] =showdate("shortdate", $data['shout_datestamp']);
					
					// message
					$a[0]['chat'] = sbwrap(make_clickable(parseubb(parsesmileys2($data['shout_message']), "b|i|u|url|color")));
					$a[0]['chat2'] = $data['shout_message'];
					if (iADMIN && checkrights("S"))
						$a[0]['admin'] = 1;
					if (iMEMBER && $data['shout_name'] == $userdata['user_id'] && isset($data['user_name']))
						$a[0]['self'] = 1;
					if ($numrows > $settings['numofshouts']) {
						$a[0]['archive'] = 1;
					}
				}
				if (!empty($a))
					echo json_encode($a);
			}
			else
				echo '{"no_post":"0"}';
		}
		
	}
	// edit a single shout
	else if ($_GET['act'] == 'edt'){
		if(isset($_GET['p']) && isnum($_GET['p'])){
			$query = "SELECT * FROM ".DB_SHOUTBOX." WHERE shout_id=".$_GET['p'];
			$result = dbquery($query);
			if($data = dbarray($result)){
				$a['shout_id'] = $data['shout_id'];
				$a['chat'] = $data['shout_message'];
			}
			if(isset($a))
				echo json_encode($a);
		}
	}
}

function setULcolour($level, $str){
	switch($level){
		case 101:
			$str = $str;
			break;
		case 102:
			$str = "<span style=\"color:#0000FF;\">".$str."</span>";
			break;
		case 103:
			$str = "<span style=\"color:#FF9A00;\">".$str."</span>";
			break;
		default:
			$str = $str;
			break;
	}
	return $str;
}
?>