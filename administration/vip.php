<?php
require_once "../maincore.php";
require_once THEMES."templates/admin_header.php";
include LOCALE.LOCALESET."admin/settings.php";
include LOCALE.LOCALESET."admin/vip.php";

if (!checkRights("VIP") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }




$vip = dbarray(dbquery("SELECT * FROM ".$db_prefix."vip"));

if (isset($_POST['save'])) {
$error = 0;
	$result = dbquery("UPDATE ".$db_prefix."vip SET 
		numer_usera = '".$_POST['numer_usera']."',
		identyfikator = '".$_POST['identyfikator']."',
		numer_sms = '".$_POST['numer_sms']."',
		tresc_sms = '".$_POST['tresc_sms']."',
		koszt = '".$_POST['koszt']."',
		koszt_brutto = '".$_POST['koszt_brutto']."'
	");
	if (!$result) { $error = 1; }

	redirect(FUSION_SELF.$aidlink."&error=".$error);
}



opentable($locale['title']);
require_once ADMIN."settings_links.php";
echo "<form name='settingsform' method='post' action='".FUSION_SELF.$aidlink."'>\n";
echo "<table cellpadding='0' cellspacing='0' width='500' class='center'>\n<tr>\n";
echo "<td class='tbl2' align='center' colspan='2'>".$locale['title']."</td>\n";
echo "</tr>\n<tr>\n";
echo "<td class='tbl' width='50%'>".$locale['001']."<br /><span class='small2'>".$locale['002']."</span></td>\n";
echo "<td class='tbl' width='50%'><input type='text' name='numer_usera' value='".$vip['numer_usera']."' maxlength='50' class='textbox' style='width:200px;' /></td>\n";
echo "</tr>\n<tr>\n";
echo "<td class='tbl' width='50%'>".$locale['003']."<br /><span class='small2'>".$locale['004']."</span></td>\n";
echo "<td class='tbl' width='50%'><input type='text' name='identyfikator' value='".$vip['identyfikator']."' maxlength='50' class='textbox' style='width:200px;' /></td>\n";
echo "</tr>\n<tr>\n";
echo "<td class='tbl' width='50%'>".$locale['005']."<br /><span class='small2'>".$locale['006']."</span></td>\n";
echo "<td class='tbl' width='50%'><input type='text' name='numer_sms' value='".$vip['numer_sms']."' maxlength='50' class='textbox' style='width:200px;' /></td>\n";
echo "</tr>\n<tr>\n";
echo "<td class='tbl' width='50%'>".$locale['007']."<br /><span class='small2'>".$locale['008']."</span></td>\n";
echo "<td class='tbl' width='50%'><input type='text' name='tresc_sms' value='".$vip['tresc_sms']."' maxlength='50' class='textbox' style='width200px;' /></td>\n";
echo "</tr>\n<tr>\n";
echo "<td class='tbl' width='50%'>".$locale['009']."<br /><span class='small2'>".$locale['010']."</span></td>\n";
echo "<td class='tbl' width='50%'><input type='text' name='koszt' value='".$vip['koszt']."' maxlength='50' class='textbox' style='width:200px;' /></td>\n";
echo "</tr>\n<tr>\n";
echo "<td class='tbl' width='50%'>".$locale['011']."<br /><span class='small2'>".$locale['012']."</span></td>\n";
echo "<td class='tbl' width='50%'><input type='text' name='koszt_brutto' value='".$vip['koszt_brutto']."' maxlength='50' class='textbox' style='width:200px;' /></td>\n";
echo "</tr>\n<tr>\n";
echo "<td class='tbl2' align='center' colspan='2'><strong>".$locale['013']."</strong> ".$locale['014']."</td>\n";
echo "</tr>\n<tr>\n";
echo "<td align='center' colspan='2' class='tbl'><br />\n";
echo "<input type='submit' name='save' value='".$locale['015']."' class='button' />\n</td>\n";
echo "</tr>\n</table>\n</form>\n";
closetable();

require_once THEMES."templates/footer.php";
?>
