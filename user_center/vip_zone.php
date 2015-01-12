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

opentable($locale['001']);  
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
echo "<strong>Co zyskujesz wykupuj±c Konto Premium?</strong>
<ul>
<li>Dostêp do wszystkich artykulów strony.</li>
<li>Dostêp do wszystkich dzialów forum.</li>
<li>Dostêp do wszystkich galerii zdjêc.</li>
<li>Dostêp do wszystkich newsów.</li>
<li>Dostêp do wszystkich plików w downloadzie.</li>
<li>Dostêp do wszystkich pól profilu.</li>
<li>Dostêp do wszystkich bbcode u¿ywanych na forum.</li>
<li>Specjalny kolor i prefix nicka.</li>
<li>Mo¿liwosc zobaczenia kto ogl±dal twój profil.</li>
</ul>
";	
echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
echo "<td align='center' width='50%' class='tbl2'><span class='small'>\n";
	echo "<span class='alt'><strong>Okres</strong></span></td>\n"; 
echo "<td align='center' width='50%' class='tbl2'><span class='small'>\n";
	echo "<span class='alt'><strong>SMS</strong></span></td>\n";
	echo "</table>";
	echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
echo "<td align='center' width='50%' class='tbl1'><span class='small'>\n";
	echo "<strong>Do¿ywotnio</strong></td>\n"; 
echo "<td align='center' width='50%' class='tbl1'><span class='small'>\n";
	echo "<strong>".$vip['koszt']."</strong></td>\n";
	echo "</table>";
		echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
echo "<td align='center' width='100%' class='tbl2'><span class='small'>\n";
	echo "<a href='vip_buy.php'><span class='alt'><strong>WYKUP</strong></span></a></td>\n"; 
	echo "</table><br>";

   
echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
echo "<td align='right' width='100%' class='tbl2'><span class='small'>\n";
	echo "<strong>Panel u¿ytkownika v1.0 by PHP-Fusion Revolution</strong></span></td>\n"; 
	echo "</table>";   
              
closetable();



require_once THEMES."templates/footer.php";
?>
