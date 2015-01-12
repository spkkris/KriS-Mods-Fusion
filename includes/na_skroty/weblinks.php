<?php
// by piotrek199214 
include INCLUDES."/na_skroty/locale/main.php";

$isTrue = false;
$str = "";
if (isset($_GET['weblink_id'])&& isnum($_GET['weblink_id'])){
	$result = dbquery(
		"SELECT ta.weblink_cat, tac.weblink_cat_name, ta.weblink_id, ta.weblink_name FROM ".DB_WEBLINKS." ta
		LEFT JOIN ".DB_WEBLINK_CATS." tac ON ta.weblink_cat=tac.weblink_cat_id
		WHERE weblink_id='{$_GET['weblink_id']}'"
		);
	if (dbrows($result)) {
		$data = dbarray($result);
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='weblinks.php'> ".$locale['s009']." </a>";
		$str .= ">> <a href='weblinks.php?cat_id={$data['weblink_cat']}'><b>{$data['weblink_cat_name']}</b> </a>";
		$isTrue = true;
	}
}
else if (isset($_GET['cat_id']) && isnum($_GET['cat_id'])){
	$result = dbquery(
		"SELECT weblink_cat_name FROM ".DB_WEBLINK_CATS." 
		WHERE weblink_cat_id='{$_GET['cat_id']}'");
	if (dbrows($result)) {
		$data = dbarray($result);
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='weblinks.php'> ".$locale['s009']." </a>";
		$str .= ">> <a href='weblinks.php?cat_id={$_GET['cat_id']}'><b>{$data['weblink_cat_name']}</b> </a>";
		$isTrue = true;
	}
} else {
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='weblinks.php'> <b>".$locale['s009']."</b> </a>";
		$isTrue = true;
}

if($isTrue){
	opentable($locale['s001']);
	echo $str;
	closetable();
}
?>
