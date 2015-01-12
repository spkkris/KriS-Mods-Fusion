<?php
require_once "../maincore.php";
require_once THEMES."templates/admin_header.php";

if (!checkrights("LM") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

opentable("Kasowanie z PA");
// kasowanie wpisu z bazy
if (isset($_GET['skasuj']) == "strone") {
$result = dbquery("DELETE FROM ".DB_ADMIN." WHERE admin_id='".$_GET['id']."'");

echo "<div align='center'>Strona zosta³a skasowana z bazy.</div>";
echo "<div align='right'><a href='".FUSION_SELF.$aidlink."'>Wróæ</a></div>";


// dodawanie linku
} elseif (isset($_GET['dodaj']) == "strone") {

if (isset($_POST['dodaj'])) {
$admin_title = stripinput($_POST['admin_title']);
$admin_link = stripinput($_POST['admin_link']);

$result = dbquery("INSERT INTO ".DB_ADMIN." (admin_rights, admin_image, admin_title, admin_link, admin_page) VALUES ('".$_POST['admin_rights']."', '".$_POST['admin_image']."', '".$admin_title."', '".$admin_link."', '".$_POST['admin_page']."')");

echo "<div align='center'>Strona zosta³a dodana do bazy.</div>";
echo "<div align='right'><a href='".FUSION_SELF.$aidlink."'>Wróæ</a></div>";

} else {
echo "<form name='selectform' method='post' action='".FUSION_SELF.$aidlink."&dodaj=strone'>\n";
echo "Prawa strony: <input type='text' name='admin_rights' value='' maxlength='10' class='textbox' style='width:50px;' /><br>";
echo "Obrazek strony: <input type='text' name='admin_image' value='' maxlength='200' class='textbox' style='width:240px;' /><br>";
echo "Tytu³ strony: <input type='text' name='admin_title' value='' maxlength='200' class='textbox' style='width:240px;' /><br>";
echo "Link do strony: <input type='text' name='admin_link' value='' maxlength='200' class='textbox' style='width:240px;' /><br>";
echo "Kategoria: <select name='admin_page' class='textbox'>\n";
	echo "<option value='1'>Zarz±dzanie tre¶ci±</option>\n";
	echo "<option value='2'>Zarz±dzanie u¿ytkownikami</option>\n";
	echo "<option value='3'>Zarz±dzanie stron±</option>\n";
	echo "<option value='4'>Ustawienia</option>\n";
	echo "<option value='5'>Wtyczki (Infusions)</option>\n";
echo "</select>\n";

echo "<br><div align='center'><input type='submit' name='dodaj' value='Dodaj stronê' class='button' /></div>\n";
echo "</form>";
}


// przenoszenie linku
} elseif (isset($_GET['przenies']) == "strone") {

if (isset($_POST['przenies'])) {
$result = dbquery("UPDATE ".DB_ADMIN." SET admin_page='".$_POST['admin_page']."' WHERE admin_id='".$_GET['id']."'");

echo "<div align='center'>Strona zosta³a przeniesiona.</div>";
echo "<div align='right'><a href='".FUSION_SELF.$aidlink."'>Wróæ</a></div>";

} else {

echo "<form name='selectform' method='post' action='".FUSION_SELF.$aidlink."&przenies=strone&id=".$_GET['id']."'>\n";
echo "<div align='center'>Wybierz gdzie podana strona ma zostaæ przeniesiona:</div>";
echo "<div style='text-align:center'>\n<select name='admin_page' class='textbox'>\n";
	echo "<option value='1'>Zarz±dzanie tre¶ci±</option>\n";
	echo "<option value='2'>Zarz±dzanie u¿ytkownikami</option>\n";
	echo "<option value='3'>Zarz±dzanie stron±</option>\n";
	echo "<option value='4'>Ustawienia</option>\n";
	echo "<option value='5'>Wtyczki (Infusions)</option>\n";
echo "</select>\n";
echo "<input type='submit' name='przenies' value='Przenie¶' class='button' />\n";
echo "</form>";

}


// edytowanie wpisu z bazy
} elseif (isset($_GET['edytuj']) == "strone") {

if (isset($_POST['zapisz'])) {
	$admin_title = stripinput($_POST['admin_title']);
	$admin_link = stripinput($_POST['admin_link']);
	$result = dbquery("UPDATE ".DB_ADMIN." SET admin_image='".$_POST['admin_image']."', admin_title='".$admin_title."', admin_link='".$admin_link."' WHERE admin_id='".$_GET['id']."'");

echo "<div align='center'>Zmiany zosta³y zapisane</div>";
echo "<div align='right'><a href='".FUSION_SELF.$aidlink."'>Wróæ</a></div>";

} else {
$result = dbquery("SELECT * FROM ".DB_ADMIN." WHERE admin_id='".$_GET['id']."'");
$data = dbarray($result);

echo "<form name='selectform' method='post' action='".FUSION_SELF.$aidlink."&edytuj=strone&id=".$data['admin_id']."'>\n";
echo "Obrazek: <input type='text' name='admin_image' value='".$data['admin_image']."' maxlength='200' class='textbox' style='width:240px;' /><br>";
echo "Nazwa: <input type='text' name='admin_title' value='".$data['admin_title']."' maxlength='200' class='textbox' style='width:240px;' /><br>";
echo "Link: <input type='text' name='admin_link' value='".$data['admin_link']."' maxlength='200' class='textbox' style='width:240px;' /><br>";
echo "<input type='submit' name='zapisz' value='Zapisz' class='button' />\n";
echo "</form>";

}


// wy¶wietla dan± kategoriê stron
} elseif (isset($_GET['wybierz']) == "strone") {

if (!empty($_POST['page_id'])) {
$result = dbquery("SELECT * FROM ".DB_ADMIN." WHERE admin_page='".$_POST['page_id']."' ORDER BY admin_title");
$rows = dbrows($result);
 if ($rows != 0) {

	echo "<table cellpadding='0' cellspacing='0' width='100%'>\n<tr>\n";
	while ($data = dbarray($result)) {
	echo "<span class='small'><img src='".get_image("ac_".$data['admin_title'])."' alt='".$data['admin_title']."' style='border:0px;' />\n".$data['admin_title']."</span> - <a href='".FUSION_SELF.$aidlink."&przenies=strone&id=".$data['admin_id']."'>przenie¶</a> | <a href='".FUSION_SELF.$aidlink."&edytuj=strone&id=".$data['admin_id']."'>edytuj</a> | <a href='".FUSION_SELF.$aidlink."&skasuj=strone&id=".$data['admin_id']."'>usuñ</a><br>";
	}
	echo "</tr>\n</table>\n";
	echo "<div align='right'><a href='".FUSION_SELF.$aidlink."'>Wróæ</a></div>";
	
 } else {
 echo "<div align='center'>Brak wyników do wy¶wietlenia</div>";
 }
} else {
redirect(FUSION_SELF.$aidlink);
}


// Wy¶wietla wybór podstron
} else {
echo "<form name='selectform' method='post' action='".FUSION_SELF.$aidlink."&wybierz=strone'>\n";
echo "<div align='center'>Wybierz kategoriê strony któr± chcesz edytowaæ:</div>";
echo "<div style='text-align:center'>\n<select name='page_id' class='textbox'>\n";
	echo "<option value='1'>Zarz±dzanie tre¶ci±</option>\n";
	echo "<option value='2'>Zarz±dzanie u¿ytkownikami</option>\n";
	echo "<option value='3'>Zarz±dzanie stron±</option>\n";
	echo "<option value='4'>Ustawienia</option>\n";
	echo "<option value='5'>Wtyczki (Infusions)</option>\n";
echo "</select>\n<input type='submit' name='edycja' value='Edytuj' class='button' />\n";
echo "</form>";

echo "<form name='selectform' method='post' action='".FUSION_SELF.$aidlink."&dodaj=strone'>\n";
echo "<input type='submit' name='edycja' value='Dodaj stronê' class='button' />\n";
echo "</form>";
}

closetable();
require_once THEMES."templates/footer.php";
?>
