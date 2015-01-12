<?php
// by piotrek199214 
include INCLUDES."/na_skroty/locale/main.php";

$isTrue = false;
$str = "";
if (isset($_GET['weblink_id'])&& isnum($_GET['weblink_id'])){
	$result = dbquery(
		"SELECT ta.faq_cat, tac.faq_cat_name, ta.faq_id, FROM ".DB_FAQS." ta
		LEFT JOIN ".DB_FAQ_CATS." tac ON ta.faq_cat=tac.faq_cat_id
		WHERE faq_id='{$_GET['faq_id']}'"
		);
	if (dbrows($result)) {
		$data = dbarray($result);
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='faq.php'> ".$locale['s006']." </a>";
		$str .= ">> <a href='faq.php?cat_id={$data['faq_cat']}'><b>{$data['faq_cat_name']}</b> </a>";
		$isTrue = true;
	}
}
else if (isset($_GET['cat_id']) && isnum($_GET['cat_id'])){
	$result = dbquery(
		"SELECT faq_cat_name FROM ".DB_FAQ_CATS." 
		WHERE faq_cat_id='{$_GET['cat_id']}'");
	if (dbrows($result)) {
		$data = dbarray($result);
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='faq.php'> ".$locale['s006']." </a>";
		$str .= ">> <a href='faq.php?cat_id={$_GET['cat_id']}'><b>{$data['faq_cat_name']}</b> </a>";
		$isTrue = true;
	}
} else {
		$str .= ">> <a href='".$settings['siteurl']."'> ".$locale['s002']." </a>";
		$str .= ">> <a href='faq.php'> <b>".$locale['s006']."</b> </a>";
		$isTrue = true;
}

if($isTrue){
	opentable($locale['s001']);
	echo $str;
	closetable();
}
?>
