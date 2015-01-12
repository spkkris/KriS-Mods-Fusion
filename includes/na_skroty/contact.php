<?php
// by piotrek199214 
include INCLUDES."/na_skroty/locale/main.php";

	opentable($locale['s001']);
	echo ">> <a href='".$settings['siteurl']."'>".$locale['s002']."</a> >> <a href='".BASEDIR."/contact.php'><b>".$locale['s004']."</b></a>";
	closetable();
?>
