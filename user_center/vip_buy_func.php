<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: index.php
| Author: Nick Jones (Digitanium)
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../maincore.php";
require_once THEMES."templates/header.php";
include LOCALE.LOCALESET."user_center/main.php";
$result = dbquery("SELECT * FROM ".$db_prefix."vip");
$vip = dbarray($result);


$id = "".$vip['numer_usera'].""; # numer ID zarejestrowanego klienta
$code = "".$vip['identyfikator'].""; # identyfikator usÅ‚ug SMS
$type = "sms"; # typ konta: C1 - 8 znakowy kod bezobsÅ‚ugowy
 
 
$del=1;
$check = "";
$check = $_POST['check'];
if($check == NULL)
exit("Proszê wpisac kod");
 
 
$handle = fopen("http://dotpay.pl/check_code.php?id=".$id."&code=".$code."&check=".$check."&type=".$type."&del=".$del, 'r');
$status = fgets($handle, 8);
$czas_zycia = fgets($handle, 24);
fclose($handle);
$czas_zycia = rtrim($czas_zycia);
 
 
 
if ($status == 0) {
opentable('Bl¹d');
echo "Kod niepoprawny.<br>
<a href='vip_zone.php'>Wróæ...</a>";
closetable();

} else
{ # gdy kod poprawny:
if (!isset($_COOKIE['ActiveCode']))
{
setcookie('ActiveCode',1, time()+$czas_zycia);
}
else
{
setcookie('ActiveCode',0, time()+2, "/");
setcookie('ActiveCode',1, time()+$czas_zycia, "/");
}
dbquery("UPDATE ".$db_prefix."users SET 
		user_level = '104'
		WHERE user_id='".$userdata['user_id']."'"
	);
opentable(Ok);
echo "Kod poprawny jestes u¿ytkownikiem VIP.<br>
<a href='vip_zone.php'>Wróæ...</a>";
closetable();

}
		
      
require_once THEMES."templates/footer.php";      
?>
