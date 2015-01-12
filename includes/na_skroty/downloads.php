<?php
// by piotrek199214 
include INCLUDES."/na_skroty/locale/main.php";

$isTrue = false;
$str = "";
if (isset($_GET['download_id'])&& isnum($_GET['download_id'])){
	$result = dbquery(
		"SELECT ta.download_cat, tac.download_cat_name, ta.download_id, ta.download_title FROM ".DB_DOWNLOADS." ta
		LEFT JOIN ".DB_DOWNLOAD_CATS." tac ON ta.download_cat=tac.download_cat_id
		WHERE download_id='{$_GET['download_id']}'"
		);
	if (dbrows($result)) {
		$data = dbarray($result);
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='download.php'> ".$locale['s005']." </a>";
		$str .= ">> <a href='download.php?cat_id={$data['download_cat']}'><b>{$data['download_cat_name']}</b> </a>";
		$isTrue = true;
	}
}
else if (isset($_GET['cat_id']) && isnum($_GET['cat_id'])){
	$result = dbquery(
		"SELECT download_cat_name FROM ".DB_DOWNLOAD_CATS." 
		WHERE download_cat_id='{$_GET['cat_id']}'");
	if (dbrows($result)) {
		$data = dbarray($result);
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='downloads.php'> ".$locale['s005']." </a>";
		$str .= ">> <a href='downloads.php?cat_id={$_GET['cat_id']}'><b>{$data['download_cat_name']}</b> </a>";
		$isTrue = true;
	}
} else {
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='downloads.php'> <b>".$locale['s005']."<b> </a>";
		$isTrue = true;
}

if($isTrue){
	opentable($locale['s001']);
	echo $str;
	closetable();
}
?>
