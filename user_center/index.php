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


opentable($locale['001']);  
echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
echo "<td align='center' width='25%' class='tbl2'><span class='small'>\n";
	echo "<a href='index.php'><strong>".$locale['002']."</strong></a></span></td>\n"; 
echo "<td align='center' width='25%' class='tbl1'><span class='small'>\n";
	echo "<a href='edit_profile.php'>".$locale['003']."</a></span></td>\n"; 
echo "<td align='center' width='25%' class='tbl1'><span class='small'>\n";
	echo  "<a href='messages.php'>".$locale['004']."</a></span></td>\n";
echo "<td align='center' width='25%' class='tbl1'><span class='small'>\n"; 
	echo "<a href='vip_zone.php'>".$locale['005']."</a></span></td>\n";
	echo "</table>";
	
echo "<tr><td colspan='4' class='tbl1'>

 <table cellpadding='0' cellspacing='0' width='100%'>


 <tr>";
	
	
echo "<td align='center' width='25%' class='tbl'>
 <span class='small'><a href='my_tracked_threads.php'><img src='images/obserwowane.gif' alt='obserwowane tematy' style='border:0px;'><br>
Obserwowane tematy</a></span>
 </td>

<td align='center' width='25%' class='tbl'>
 <span class='small'><a href='my_threads.php'><img src='images/tematy.gif' alt='moje tematy' style='border:0px;'><br>
Moje tematy</a></span>
 </td>
 
 <td align='center' width='25%' class='tbl'>
 <span class='small'><a href='my_posts.php'><img src='images/posty.gif' alt='moje posty' style='border:0px;'><br>
Moje ostatnie posty</a></span>
 </td>

 
<td align='center' width='25%' class='tbl'>
 <span class='small'><a href='new_posts'><img src='images/nowe.gif' alt='nowe posty' style='border:0px;'><br>
Nowe posty</a></span>
 </td>
</tr>
<tr>

 <td align='center' width='25%' class='tbl'>
 <span class='small'><a href='submit.php?stype=l'><img src='images/dodaj/link.gif' alt='dodaj link' style='border:0px;'><br>
Dodaj link</a></span>
 </td>


 <td align='center' width='25%' class='tbl'>
 <span class='small'><a href='submit.php?stype=n'><img src='images/dodaj/news.gif' alt='dodaj news' style='border:0px;'><br>
Dodaj news</a></span>
 </td>
 
  <td align='center' width='25%' class='tbl'>
 <span class='small'><a href='submit.php?stype=a'><img src='images/dodaj/art.gif' alt='dodaj art' style='border:0px;'><br>
Dodaj art</a></span>
 </td>
 
  <td align='center' width='25%' class='tbl'>
 <span class='small'><a href='submit.php?stype=p'><img src='images/dodaj/zdjecie.gif' alt='dodaj zdjecie' style='border:0px;'><br>
Dodaj zdjecie</a></span>
 </td>

 </tr>";

echo " </table>
</td>
</tr><br>";
   
echo "<table cellpadding='0' cellspacing='1' width='100%' class='tbl-border'>\n<tr>\n";
echo "<td align='right' width='100%' class='tbl2'><span class='small'>\n";
	echo "<strong>Panel u¿ytkownika v1.0 by PHP-Fusion Revolution</strong></span></td>\n"; 
	echo "</table>";   
              
closetable();



require_once THEMES."templates/footer.php";
?>
