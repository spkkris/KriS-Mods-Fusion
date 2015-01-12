<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright (C) 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Filename: regulamin.php
| Author: Piterus
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "maincore.php";
require_once THEMES."templates/header.php";
require_once INCLUDES."comments_include.php";
require_once INCLUDES."ratings_include.php";
include LOCALE.LOCALESET."custom_pages.php";
include LOCALE.LOCALESET."regulamin.php";

$cp_result = dbquery("SELECT * FROM ".DB_SETTINGS);
if (dbrows($cp_result)) {
	$cp_data = dbarray($cp_result);
	add_to_title("".$locale['regulamin']."");
	opentable("".$locale['regulamin']."");
	
		ob_start();
		eval("?>".stripslashes($cp_data['license_agreement'])."<?php ");
		$regulamin = ob_get_contents();
		ob_end_clean();
		
			echo $regulamin;
		
	
}
closetable();

require_once THEMES."templates/footer.php";
?>
