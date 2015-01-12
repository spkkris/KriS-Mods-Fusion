<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: post.php
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
require_once "../maincore.php";
require_once THEMES."templates/header.php";
include LOCALE.LOCALESET."forum/post.php";

add_to_title($locale['global_204']);

require_once INCLUDES."forum_include.php";
require_once INCLUDES."bbcode_include.php";

if (!iMEMBER || !isset($_GET['forum_id']) || !isnum($_GET['forum_id'])) { redirect("index.php"); }

if ($settings['forum_edit_lock'] == 1) {
	$lock_edit = true;
} else {
	$lock_edit = false;
}

$result = dbquery(
	"SELECT f.*, f2.forum_name AS forum_cat_name
	FROM ".DB_FORUMS." f
	LEFT JOIN ".DB_FORUMS." f2 ON f.forum_cat=f2.forum_id
	WHERE f.forum_id='".$_GET['forum_id']."'"
);

if (dbrows($result)) {
	$fdata = dbarray($result);
	if (!checkgroup($fdata['forum_access']) || !$fdata['forum_cat']) { redirect("index.php"); }
} else {
	redirect("index.php");
}

if (iMEMBER && $fdata['forum_moderators']) {
	$mod_groups = explode(".", $fdata['forum_moderators']);
	foreach ($mod_groups as $mod_group) {
		if (!defined("iMOD") && checkgroup($mod_group)) { define("iMOD", true); }
	}
}
if (!defined("iMOD")) { define("iMOD", false); }

$caption = $fdata['forum_cat_name']." :: ".$fdata['forum_name'];

if ((isset($_GET['action']) && $_GET['action'] == "newthread") && ($fdata['forum_post'] != 0 && checkgroup($fdata['forum_post']))) {
	include "postnewthread.php";
} elseif ((isset($_GET['action']) && $_GET['action'] == "reply") && ($fdata['forum_reply'] != 0 && checkgroup($fdata['forum_reply']))) {
	if (!isset($_GET['thread_id']) || !isnum($_GET['thread_id'])) {
		redirect("index.php");
	}

	$result = dbquery("SELECT * FROM ".DB_THREADS." WHERE thread_id='".$_GET['thread_id']."' AND forum_id='".$fdata['forum_id']."'");
	
	if (dbrows($result)) {
		$tdata = dbarray($result);
	} else {
		redirect("index.php");
	}
	
	$caption .= " :: ".$tdata['thread_subject'];
	
	if (!$tdata['thread_locked']) {
		include "postreply.php";
	} else {
		redirect("index.php");
	}
} elseif (isset($_GET['action']) && $_GET['action'] == "edit") {
	if ((!isset($_GET['thread_id']) || !isnum($_GET['thread_id'])) || (!isset($_GET['post_id']) || !isnum($_GET['post_id']))) { redirect("index.php"); }

	$result = dbquery("SELECT * FROM ".DB_THREADS." WHERE thread_id='".$_GET['thread_id']."' AND forum_id='".$fdata['forum_id']."'");
	
	if (dbrows($result)) {
		$tdata = dbarray($result);
	} else {
		redirect("index.php");
	}

	$result = dbquery("SELECT tp.*, tt.thread_subject, MIN(tp2.post_id) AS first_post FROM ".DB_POSTS." tp
	INNER JOIN ".DB_THREADS." tt on tp.thread_id=tt.thread_id
	INNER JOIN ".DB_POSTS." tp2 on tp.thread_id=tp2.thread_id
	WHERE tp.post_id='".$_GET['post_id']."' AND tp.thread_id='".$tdata['thread_id']."' AND tp.forum_id='".$fdata['forum_id']."' GROUP BY tp2.post_id");
	
	if (dbrows($result)) {
		$pdata = dbarray($result);
		$last_post = dbarray(dbquery("SELECT post_id FROM ".DB_POSTS." WHERE thread_id='".$_GET['thread_id']."' AND forum_id='".$_GET['forum_id']."' ORDER BY post_datestamp DESC LIMIT 1"));
	} else {
		redirect("index.php");
	}

	if ($userdata['user_id'] != $pdata['post_author'] && !iMOD && !iSUPERADMIN) { redirect("index.php"); }
	
	if (!$tdata['thread_locked'] && (($lock_edit && $last_post['post_id'] == $pdata['post_id'] && $userdata['user_id'] == $pdata['post_author']) || (!$lock_edit && $userdata['user_id'] == $pdata['post_author'])) ) {
		include "postedit.php";
	} else {
		if (iMOD || iSUPERADMIN) { include "postedit.php"; } else { redirect("index.php"); }
	}
} 

elseif ($_GET['action'] == "help") {
   if (!isset($_GET['thread_id']) || !isNum($_GET['thread_id']) || !isset($_GET['post_id']) || !isNum($_GET['post_id']) || !isset($_GET['forum_id']) || !isNum($_GET['forum_id'])) { redirect("index.php"); exit; }
         $result = dbquery("SELECT * FROM ".DB_THREADS." WHERE thread_id='".$_GET['thread_id']."' AND forum_id='".$fdata['forum_id']."'");
   if (dbrows($result)) { $tdata = dbarray($result); } else { redirect("index.php"); }

   $result = dbquery("SELECT * FROM ".DB_POSTS." WHERE post_id='".$_GET['post_id']."' AND thread_id='".$tdata['thread_id']."' AND forum_id='".$fdata['forum_id']."'");
   if (dbrows($result)) { $pdata = dbarray($result); } else { redirect("index.php"); }
   
   
   
   
   
   if ($tdata['thread_author'] == $userdata['user_id'] && $tdata['thread_help1'] < 2 && $pdata['post_author'] != $userdata['user_id'] && $pdata['post_help'] == 0) {
   
   $result = dbquery("UPDATE ".DB_POSTS." SET post_help=post_author WHERE post_id='".$_GET['post_id']."' AND thread_id='".$_GET['thread_id']."' AND forum_id='".$_GET['forum_id']."' ");   
   $result = dbquery("UPDATE ".DB_USERS." SET user_help_point=user_help_point+1 WHERE user_id=".$pdata['post_author']." ");
   $result = dbquery("UPDATE ".DB_THREADS." SET thread_help1=thread_help1+1 WHERE thread_id=".$tdata['thread_id']." ");
   

opentable($locale['552']);
echo "<center><br>\n";
echo"".$locale['553']."<br><br>\n";
echo "<a href='viewthread.php?forum_id=".$_GET['forum_id']."&thread_id=".$_GET['thread_id']."&pid=".$_GET['post_id']."#post_".$_GET['post_id']."'>".$locale['447']."</a> |
<a href='viewforum.php?forum_id=".$_GET['forum_id']."'>".$locale['448']."</a> |
<a href='index.php'>".$locale['449']."</a><br><br>
</center>\n";
closetable();






}
}
else {
	redirect("index.php");
}

require_once THEMES."templates/footer.php";
?>