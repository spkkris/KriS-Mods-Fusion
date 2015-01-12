<?php
if (!defined("IN_FUSION")) { die("Access Denied"); }

function color_mapper($field) {
	$cvalue = array();
	$cvalue[] = "00";
	$cvalue[] = "33";
	$cvalue[] = "66";
	$cvalue[] = "99";
	$cvalue[] = "CC";
	$cvalue[] = "FF";
	$select = "<select name='color_mapper' class='textbox' onchange=\"".$field.".value = '#' + this.options[this.selectedIndex].value;\" style='width:75px;'>\n";
	for ($ca=0; $ca<count($cvalue); $ca++) {
      for ($cb=0; $cb<count($cvalue); $cb++) {
         for ($cc=0; $cc<count($cvalue); $cc++) {
            $hcolor = $cvalue[$ca].$cvalue[$cb].$cvalue[$cc];
            $select .= "<option value='".$hcolor."' style='background-color:#".$hcolor.";'>#".$hcolor."</option>\n";
         }
      }
   }
   $select .= "</select>\n";
   return $select;
}

function generate_cache_file() {
	$result = dbquery("SELECT * FROM ".DB_NICKS_MOD." ORDER BY nicks_group_id ASC");
	$output = "<?php\r\nif (!defined(\"IN_FUSION\")) { die(\"Access Denied\"); }\r\n\r\n\$nicks_mod_cache = array(\r\n";
	$count = dbrows($result);
	$i = 1;
	while($data = dbarray($result)) {
		$output .= "	'".$data['nicks_group_id']."' => array('".$data['nicks_color']."', '".$data['nicks_prefix']."', '".$data['nicks_styles']."')".($i == $count ? "" : ",\r\n");
		$i++;
	}
	$output .= "\r\n);\r\n?>";
	$file = fopen(INCLUDES."nicks_mod/nicks_mod_cache.php","w");
	fwrite($file, $output);
	fclose($file);
}
?>
