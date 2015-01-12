<?php
// by piotrek199214 
include INCLUDES."/na_skroty/locale/main.php";

$isTrue = false;
$str = "";
if (isset($_GET['article_id'])&& isnum($_GET['article_id'])){
	$result = dbquery(
		"SELECT ta.article_cat, tac.article_cat_name, ta.article_id, ta.article_subject FROM ".DB_ARTICLES." ta
		LEFT JOIN ".DB_ARTICLE_CATS." tac ON ta.article_cat=tac.article_cat_id
		WHERE article_id='{$_GET['article_id']}'"
		);
	if (dbrows($result)) {
		$data = dbarray($result);
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='articles.php'> ".$locale['s003']." </a>";
		$str .= ">> <a href='articles.php?cat_id={$data['article_cat']}'>{$data['article_cat_name']} </a>";
		$str .= ">> <a href='articles.php?article_id={$_GET['article_id']}'><b>{$data['article_subject']}</b> </a>";
		$isTrue = true;
	}
}
else if (isset($_GET['cat_id']) && isnum($_GET['cat_id'])){
	$result = dbquery(
		"SELECT article_cat_name FROM ".DB_ARTICLE_CATS." 
		WHERE article_cat_id='{$_GET['cat_id']}'");
	if (dbrows($result)) {
		$data = dbarray($result);
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='articles.php'> ".$locale['s003']." </a>";
		$str .= ">> <a href='articles.php?cat_id={$_GET['cat_id']}'><b>{$data['article_cat_name']}</b> </a>";
		$isTrue = true;
	}
} else {
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='articles.php'> <b>".$locale['s003']."</b> </a>";
		$isTrue = true;
}


if($isTrue){
	opentable($locale['s001']);
	echo $str;
	closetable();
}
?>
