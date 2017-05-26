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

opentable('Wykup konto VIP');
echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
echo "<td align='center' width='25%' class='tbl1'><span class='small'>\n";
	echo "<a href='index.php'>".$locale['002']."</a></span></td>\n"; 
echo "<td align='center' width='25%' class='tbl1'><span class='small'>\n";
	echo "<a href='edit_profile.php'>".$locale['003']."</a></span></td>\n"; 
echo "<td align='center' width='25%' class='tbl1'><span class='small'>\n";
	echo  "<a href='messages.php'>".$locale['004']."</a></span></td>\n";
echo "<td align='center' width='25%' class='tbl2'><span class='small'>\n"; 
	echo "<a href='vip_zone.php'><strong>".$locale['005']."</strong></a></span></td>\n";
	echo "</table>";
echo "<form name='inputform' method='post' action='vip_buy_func.php' onsubmit='return ValidateForm(this)'>\n";
	echo "<center><td class='tbl'>Kod:<span style='color:#ff0000'>*</span></td>\n";
		echo "<td class='tbl'><input type='text' name='check' class='textbox' style='width:100px' /></td>\n";
		echo "</tr>\n";
			echo "<tr>\n<td align='center' colspan='2'><br />\n";
			echo "<input type='submit' name='wyslij' value='Wykup' class='button'/><center>\n";

       echo "<center><P>Aby otrzymac <b>kod weryfikacyjny</b> wyslij sms na numer <b>".$vip['numer_sms']." o tresci ".$vip['tresc_sms']."</b>\n";
      echo "<br>\n";
      echo "Usluga dziala w sieciach operatorow: Play, Plus GSM, Era, Orange.\n";
      echo "<br>\n";
      echo "Serwis sms obsluguje Dotpay.pl\n";
      echo "<br>\n";
      echo "Koszt przeslania wiadomosci ".$vip['koszt']." NETTO (".$vip['koszt_brutto']." BRUTTO)\n";
      echo "<br>\n";
      echo "<A href='http://www.dotpay.pl/regulaminsms'>Regulamin</A> us³ugi SMS\n";
      echo "<br>\n";
      echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
echo "<td align='right' width='100%' class='tbl2'><span class='small'>\n";
	echo "<strong>Panel u¿ytkownika v1.0 by PHP-Fusion Revolution</strong></span></td>\n"; 
	echo "</table>";
      closetable();
      
require_once THEMES."templates/footer.php";      
?>
