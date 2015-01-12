<?php
// by piotrek199214 
include INCLUDES."/na_skroty/locale/main.php";

$isTrue = false;
$str = "";
if (isset($_GET['readmore'])&& isnum($_GET['readmore'])){
	$result = dbquery(
		"SELECT ta.news_cat, tac.news_cat_name, ta.news_id, ta.news_subject FROM ".DB_NEWS." ta
		LEFT JOIN ".DB_NEWS_CATS." tac ON ta.news_cat=tac.news_cat_id
		WHERE news_id='{$_GET['readmore']}'"
		);
	if (dbrows($result)) {
		$data = dbarray($result);
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='news.php'> ".$locale['s007']." </a>";
	if ($data['news_cat'] != 0) {
		$str .= ">> {$data['news_cat_name']} ";
	}
		$str .= ">> <a href='news.php?readmore={$_GET['readmore']}'><b>{$data['news_subject']}</b> </a>";
		$isTrue = true;
	}
} else {
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='news.php'> <b>".$locale['s007']."</b> </a>";
		$isTrue = true;
}


if($isTrue){
	opentable($locale['s001']);
	echo $str;
	closetable();
}
?>
