<?php
require_once "maincore.php";
require_once THEMES."templates/header.php";
opentable('Notki');

if (!isset($_GET['post_id']) || !isnum($_GET['post_id']) || !isset($_GET['thread_id']) || !isnum($_GET['thread_id']) ||
!isset($_GET['forum_id']) || !isnum($_GET['forum_id'])) { redirect("index.php"); }

$forum_moderators = dbresult(dbquery("SELECT forum_moderators FROM ".DB_FORUMS." WHERE forum_id ='".$_GET['forum_id']."'"),0 );
$mod_groups = explode(".", $forum_moderators);

if (iSUPERADMIN) { define("iMOD", true); }

if (!defined("iMOD") && iMEMBER && $forum_moderators) {
   foreach ($mod_groups as $mod_group) {
      if (!defined("iMOD") && checkgroup($mod_group)) { define("iMOD", true); }
   }
}
if (!defined("iMOD")) { define("iMOD", false); }

if(!iMOD) { redirect("index.php"); }


if(isset($_GET['del'])) {

if (!isset($_GET['del']) || !isset($_GET['notka_id']) || !isnum($_GET['notka_id']) || !isnum($_GET['del'])) { redirect("index.php"); }

$result = dbquery("DELETE FROM ".$db_prefix."uwagi_mod WHERE notka_id='".$_GET['notka_id']."'"); 
if($result) {
 
echo "<div style='text-align:center'><br />\n";
echo "Notka zosta³a usunieta.<br /><br />\n";
if (!isset($_GET['thread_id']) || !isnum($_GET['thread_id']) && !isset($_GET['post_id']) || !isnum($_GET['post_id'])) { redirect("index.php"); } else { redirect(FORUM."viewthread.php?thread_id=".$_GET['thread_id']."#post_".$_GET['post_id']); }
 
}
 
} else { 

if(isset($_POST['submit'])) {
$notka = mysql_real_escape_string(trim($_POST['tresc']));
$result = dbquery("SELECT * FROM ".DB_POSTS." WHERE post_id=".$_GET['post_id']."");
$pdata = dbarray($result);
$subject = "Wiadomosc od moderatora" ;
$pm = "Witaj!<br><br>Moderator dodal do twojego postu notkê o nastêpuj±cej tresci: ".$notka."<br><br> Pozdrawiam.";

if(isset($_GET['edit'])) {
 
if (!isset($_GET['edit']) || !isset($_GET['notka_id']) || !isnum($_GET['notka_id']) || !isnum($_GET['edit'])) { redirect("index.php"); } 
 
$wynik = dbquery("UPDATE ".$db_prefix."uwagi_mod SET notka ='".$notka."' WHERE notka_id='".$_GET['notka_id']."'");
if($wynik){
echo "<div style='text-align:center'><br />\n";
echo "Notka zosta³a zmieniona.<br /><br />\n";
if (!isset($_GET['thread_id']) || !isnum($_GET['thread_id']) && !isset($_GET['post_id']) || !isnum($_GET['post_id'])) { redirect("index.php"); } else { redirect(FORUM."viewthread.php?thread_id=".$_GET['thread_id']."#post_".$_GET['post_id']); } 
}
} else {
$wynik = dbquery("INSERT INTO ".$db_prefix."uwagi_mod (user_id, post_id, time, notka) VALUES (".$userdata['user_id'].", ".$_GET['post_id'].", ".time().", '".$notka."')");
dbquery("INSERT INTO ".DB_MESSAGES." (message_to, message_from, message_subject, message_message, message_read, message_datestamp, message_folder) VALUES('".$pdata['post_author']."','".$userdata['user_id']."','".$subject."','".$pm."','0','".time()."','0')");

if($wynik){
echo "<div style='text-align:center'><br />\n";
echo "Notka zosta³a dodana.<br /><br />\n";
if (!isset($_GET['thread_id']) || !isnum($_GET['thread_id']) && !isset($_GET['post_id']) || !isnum($_GET['post_id'])) { redirect("index.php"); } else { redirect(FORUM."viewthread.php?thread_id=".$_GET['thread_id']."#post_".$_GET['post_id']); }
}
}

} else {
 
if(isset($_GET['edit'])) {
 
if (!isset($_GET['edit']) || !isset($_GET['notka_id']) || !isnum($_GET['notka_id']) || !isnum($_GET['edit'])) { redirect("index.php"); }
 
$notki = dbquery("SELECT * FROM ".$db_prefix."uwagi_mod WHERE notka_id='".$_GET['notka_id']."'");
if (dbquery("SELECT FOUND_ROWS()") > 0 ) {
$r = dbarray($notki); 
} 
} 
 
 
echo "<form name='test' method='post' action='".FUSION_SELF."?post_id=".$_GET['post_id']."&thread_id=".$_GET['thread_id']."&forum_id=".$_GET['forum_id']."
".(isset($_GET['edit']) ? "&notka_id=".$_GET['notka_id']."&edit=1" : "")."'>";
echo "<table cellpadding='0' cellspacing='0' class='center'>\n<tr>\n";
echo "<center><select name='tresc' class='textbox'>\n";
echo "<option value='Zmiana nazwy tematu'>Zmiana nazwy tematu</option>\n";
echo "<option value='Usuniêcie posta'>Usuniêcie posta</option>\n";
echo "<option value='Usuniêcie tematu'>Usuniêcie tematu</option>\n";
echo "<option value='Przeniesienie posta'>Przeniesienie posta</option>\n";
echo "<option value='Poprawa posta'>Poprawa posta</option>\n";
echo "<option value='Ogólna uwaga>Ogólna uwaga</option>\n";
echo "<option value='Przeniesienie tematu'>Przeniesienie tematu</option>\n";
echo "</select></center></tr>\n<tr>\n";   
echo "<td align='center' colspan='2' class='tbl'>\n";
echo "<input type='submit' name='submit' value='".(isset($_GET['edit']) ? "Zmien" : "Dodaj")."' class='button' /></td>\n";
echo "</tr>\n</table>\n</form>\n";
}
 
 
}



closetable();
require_once THEMES."templates/footer.php";
?>
