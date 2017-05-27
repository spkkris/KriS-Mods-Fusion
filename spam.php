<?php
require_once "maincore.php";
require_once THEMES."templates/header.php";
opentable('Notki');


if(isset($_POST['submit_forum'])) {
$result = dbquery("SELECT * FROM ".DB_POSTS." WHERE post_id=".$_GET['post_id']."");
$pdata = dbarray($result);
$subject = "Zg³oszenie spamu" ;
$pm = "Witaj!<br><br>Zgloszono spam w po¶cie na forum:<br> <b>".$pdata['post_message']."</b><br /><br /> Pozdrawiam.";
$wynik = dbquery("INSERT INTO ".DB_MESSAGES." (message_to, message_from, message_subject, message_message, message_read, message_datestamp, message_folder) VALUES('1','".$userdata['user_id']."','".$subject."','".$pm."','0','".time()."','0')");

if($wynik){
echo "<div style='text-align:center'><br />\n";
echo "Spam zosta³ zg³oszony.<br /><br />\n";
if (!isset($_GET['thread_id']) || !isnum($_GET['thread_id']) && !isset($_GET['post_id']) || !isnum($_GET['post_id'])) { redirect("index.php"); } else { redirect(FORUM."viewthread.php?thread_id=".$_GET['thread_id']."#post_".$_GET['post_id']); }
}
}
 
echo "<form name='test' method='post' action='".FUSION_SELF."?post_id=".$_GET['post_id']."&thread_id=".$_GET['thread_id']."&forum_id=".$_GET['forum_id']."'>";
echo "<table cellpadding='0' cellspacing='0' class='center'>\n<tr>\n";
echo "<center>Czy na pewno upewnile¶ siê ¿e to spam? Je¿eli tak kliknij zglo¶.\n";
echo "</center></tr>\n<tr>\n";   
echo "<td align='center' colspan='2' class='tbl'>\n";
echo "<input type='submit' name='submit_forum' value='Zglo¶' class='button' /></td>\n";
echo "</tr>\n</table>\n</form>\n";




closetable();
require_once THEMES."templates/footer.php";
?>
