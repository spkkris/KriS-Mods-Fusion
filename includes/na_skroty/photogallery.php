<?php
// by piotrek199214 
include INCLUDES."/na_skroty/locale/main.php";

$isTrue = false;
$str = "";
if (isset($_GET['photo_id'])&& isnum($_GET['photo_id'])){
	$result = dbquery(
		"SELECT ta.album_id, tac.album_title, ta.photo_id, ta.photo_title FROM ".DB_PHOTOS." ta
		LEFT JOIN ".DB_PHOTO_ALBUMS." tac ON ta.album_id=tac.album_id
		WHERE photo_id='{$_GET['photo_id']}'"
		);
	if (dbrows($result)) {
		$data = dbarray($result);
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='photogallery.php'> ".$locale['s008']." </a>";
		$str .= ">> <a href='photogallery.php?album_id={$data['album_id']}'>{$data['album_title']} </a>";
		$str .= ">> <a href='photogallery.php?photo_id={$data['photo_id']}'><b>{$data['photo_title']}</b> </a>";
		$isTrue = true;
	}
}
else if (isset($_GET['album_id']) && isnum($_GET['album_id'])){
	$result = dbquery(
		"SELECT album_title FROM ".DB_PHOTO_ALBUMS." 
		WHERE album_id='{$_GET['album_id']}'");
	if (dbrows($result)) {
		$data = dbarray($result);
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='photogallery.php'> ".$locale['s008']." </a>";
		$str .= ">> <a href='photogallery.php?album_id={$_GET['album_id']}'><b>{$data['album_title']}</b> </a>";
		$isTrue = true;
	}
} else {
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='photogallery.php'> <b>".$locale['s008']."</b> </a>";
		$isTrue = true;
}

if($isTrue){
	opentable($locale['s001']);
	echo $str;
	closetable();
}
?>
