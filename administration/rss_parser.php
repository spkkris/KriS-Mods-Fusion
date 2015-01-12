<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
/*
	Converted to v7.0 by:
	
	php-Invent Team
	http://www.php-invent.com
	
	Developer: SoBeNoFear (ianunruh@gmail.com)
*/
require_once "../maincore.php";
require_once THEMES."templates/admin_header.php";
include LOCALE.LOCALESET."admin/rss_parser.php";

if (!checkrights("RSS") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../index.php"); }

if(isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = '';
}

if(isset($_GET['id'])) {
	$id = stripinput($_GET['id']);
} else {
	$id = "";
}

if($action == 'mdown') {
	if(isset($_GET['id'])) {$id = stripinput($_GET['id']); } else { $id = ''; };
	if(isset($_GET['order'])) {$order = stripinput($_GET['order']); } else { $order = ''; };
	$data = dbarray(dbquery('SELECT * FROM '.$db_prefix.'rss_feeds WHERE page_order="'.$order.'"'));
	$result = dbquery('UPDATE '.$db_prefix.'rss_feeds SET page_order=page_order-1 WHERE id="'.$data['id'].'"');
	$result = dbquery('UPDATE '.$db_prefix.'rss_feeds SET page_order=page_order+1 WHERE id="'.$id.'"');
	header("Location: rss_parser_admin.php'.$aidlink.'");
} elseif($action == 'mup') {
	if(isset($_GET['id'])) {$id = stripinput($_GET['id']); } else { $id = ''; };
	if(isset($_GET['order'])) {$order = stripinput($_GET['order']); } else { $order = ''; };
	$data = dbarray(dbquery('SELECT * FROM '.$db_prefix.'rss_feeds WHERE page_order="'.$order.'"'));
	$result = dbquery('UPDATE '.$db_prefix.'rss_feeds SET page_order=page_order+1 WHERE id="'.$data['id'].'"');
	$result = dbquery('UPDATE '.$db_prefix.'rss_feeds SET page_order=page_order-1 WHERE id="'.$id.'"');
	header("Location: rss_parser_admin.php'.$aidlink.'");
} elseif($action == 'clear_cache') {
	if(isset($_GET['id'])) {
		$id = stripinput($_GET['id']);
		$SQL = 'SELECT file, name FROM '.$db_prefix.'rss_feeds WHERE id = "'.$id.'"';
		$RES = dbquery($SQL);
		$ROW = dbarray($RES);
		$cacheFile = INFUSIONS.'rss_parser_panel/cache/';
		$cacheFile .= 'cache_'.md5($ROW['file']).'.txt';
		
		if(!file_exists($cacheFile)) {
			opentable($locale['LAN_RSS_205']);
			print '<div align="center">';
			printf($locale['LAN_RSS_230'], $ROW['name']);
			print '<br /><br /><a href="rss_parser_admin.php'.$aidlink.'">'.$locale['LAN_RSS_222'].'</a><br /><br />
					<a href="'.ADMIN.'index.php">'.$locale['LAN_RSS_223'].'</a><br /><br />';
			print '</div>';
			closetable();
		} elseif(unlink($cacheFile)) {
			opentable($locale['LAN_RSS_205']);
			print '<div align="center">';
			printf($locale['LAN_RSS_231'], $ROW['name']);
			print '<br /><br /><a href="rss_parser_admin.php'.$aidlink.'">'.$locale['LAN_RSS_222'].'</a><br /><br />
					<a href="'.ADMIN.'index.php">'.$locale['LAN_RSS_223'].'</a><br /><br />';
			print '</div>';
			closetable();
		} else {
			opentable($locale['LAN_RSS_205']);
			print '<div align="center">'.$locale['LAN_RSS_231'].'
					<br /><br /><a href="rss_parser_admin.php'.$aidlink.'">'.$locale['LAN_RSS_222'].'</a><br /><br />
					<a href="'.ADMIN.'index.php">'.$locale['LAN_RSS_223'].'</a><br /><br />
				</div>';
			closetable();
		}
	} else {
		fallback("rss_parser_admin.php'.iAUTH.'");
	}
	
} elseif ($action == 'delete') {
	$result = dbquery('DELETE FROM '.$db_prefix.'rss_feeds WHERE id="'.$id.'"');
	opentable($locale['LAN_RSS_220']);
	echo '<center><br>
		'.$locale['LAN_RSS_221'].'<br><br>
		<a href="rss_parser_admin.php'.$aidlink.'">'.$locale['LAN_RSS_222'].'</a><br><br>
		<a href="'.ADMIN.'index.php">'.$locale['LAN_RSS_223'].'</a><br><br>
		</center>';
	closetable();
} else {
	
	if (isset($_POST['save_feed'])) {
		$name = stripinput($_POST['name']);
		$file = stripinput($_POST['file']);
		$type = stripinput($_POST['type']);
		$num_items_feeds_page = stripinput($_POST['num_items_feeds_page']);
		$num_items_side_panel = stripinput($_POST['num_items_side_panel']);
		$num_items_center_panel = stripinput($_POST['num_items_center_panel']);
		$cache_limit = stripinput($_POST['cache_limit']);
		$new_window = isset($_POST['new_window']) ? 1:0;
		$feeds_page = isset($_POST['feeds_page']) ? 1:0;
		if ($action == 'edit') {
			$SQL = 'UPDATE '.$db_prefix.'rss_feeds SET 
						name="'.$name.'",
						file="'.$file.'",
						type="'.$type.'",
						new_window="'.$new_window.'",
						in_feeds_page="'.$feeds_page.'",
						num_items_feeds_page="'.$num_items_feeds_page.'",
						num_items_side_panel="'.$num_items_side_panel.'",
						num_items_center_panel="'.$num_items_center_panel.'",
						cache_limit="'.$cache_limit.'"
					WHERE id="'.$id.'"';
			$result = dbquery($SQL);
			unset($action, $cat_name, $cat_description, $cat_id);
			redirect(FUSION_SELF.$aidlink);
		} else {
			$SQL = 'SELECT MAX(page_order) AS porder FROM '.$db_prefix.'rss_feeds';
			$RES = dbquery($SQL);
			$ROW = dbarray($RES);
			$order = $ROW['porder'] + 1;
			$SQL = 'INSERT INTO '.$db_prefix.'rss_feeds (name, file, type, new_window, in_feeds_page, num_items_feeds_page, num_items_side_panel, num_items_center_panel, cache_limit, page_order) 
					VALUES("'.$name.'", "'.$file.'", "'.$type.'", "'.$new_window.'", "'.$feeds_page.'", "'.$num_items_feeds_page.'", "'.$num_items_side_panel.'", "'.$num_items_center_panel.'", "'.$cache_limit.'", "'.$order.'")';
			$result = dbquery($SQL);
			unset($name, $file, $type, $new_window, $feeds_page);
			redirect(FUSION_SELF.$aidlink);
		}
	}
	if ($action == 'edit') {
		$result = dbquery('SELECT * FROM '.$db_prefix.'rss_feeds WHERE id="'.$id.'"');
		$data = dbarray($result);
		$name = $data['name'];
		$file = $data['file'];
		$type = $data['type'];
		$new_window = $data['new_window'] ? 'checked="checked"':'';
		$feeds_page = $data['in_feeds_page'] ? 'checked="checked"':'';
		$type1 = $type==1 ? 'selected':'';
		$type2 = $type==2 ? 'selected':'';
		$num_items_feeds_page = $data['num_items_feeds_page'];
		$num_items_side_panel = $data['num_items_side_panel'];
		$num_items_center_panel = $data['num_items_center_panel'];
		$cache_limit = $data['cache_limit'];
		$formaction = FUSION_SELF.$aidlink.'&action=edit&id='.$data['id'];
		opentable($locale['LAN_RSS_211']);
	} else {
		$formaction = FUSION_SELF.$aidlink;
		opentable($locale['LAN_RSS_210']);
		$name = '';
		$file = '';
		$type1 = '';
		$type2 = '';
		$new_window = '';
		$feeds_page = '';
		$num_items_feeds_page = '0';
		$num_items_side_panel = '0';
		$num_items_center_panel = '0';
		$cache_limit = '0';
	}
	print '<form name="addcat" method="post" action="'.$formaction.'">
		<table align="center" width="500" cellspacing="1" cellpadding="0" class="tbl">
			<tr>
				<td width="200">'.$locale['LAN_RSS_212'].'</td>
				<td>
					<input type="text" name="name" value="'.$name.'" class="textbox" style="width:200px;">
				</td>
			</tr>
			<tr>
				<td>'.$locale['LAN_RSS_213'].'</td>
				<td>
					<input type="text" name="file" value="'.$file.'" class="textbox" style="width:250px;">
				</td>
			</tr>
			<tr>
				<td>'.$locale['LAN_RSS_214'].'</td>
				<td>
					<select name="type" class="textbox">
						<option value="1" '.$type1.'>Remote</option>
						<option value="2" '.$type2.'>Local</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>'.$locale['LAN_RSS_209'].'</td>
				<td>
					<input type="checkbox" name="new_window" class="textbox" value="1" '.$new_window.'>
				</td>
			</tr>
			<tr>
				<td>'.$locale['LAN_RSS_215'].'</td>
				<td>
					<input type="checkbox" name="feeds_page" class="textbox" value="1" '.$feeds_page.'>
				</td>
			</tr>
			<tr>
				<td>'.$locale['LAN_RSS_216'].'</td>
				<td>
					<input type="text" size="3" name="num_items_feeds_page" class="textbox" value="'.$num_items_feeds_page.'" >
				</td>
			</tr>
			<tr>
				<td>'.$locale['LAN_RSS_217'].'</td>
				<td>
					<input type="text" size="3" name="num_items_side_panel" class="textbox" value="'.$num_items_side_panel.'" >
				</td>
			</tr>
			<tr>
				<td>'.$locale['LAN_RSS_218'].'</td>
				<td>
					<input type="text" size="3" name="num_items_center_panel" class="textbox" value="'.$num_items_center_panel.'" >
				</td>
			</tr>
			<tr>
				<td>'.$locale['LAN_RSS_233'].'</td>
				<td>
					<input type="text" size="3" name="cache_limit" class="textbox" value="'.$cache_limit.'" >
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2">
					<input type="submit" name="save_feed" value="'.$locale['LAN_RSS_219'].'" class="button">
				</td>
			</tr>
		</table>
		</form>';
	closetable();
	tablebreak();
	// list rss feeds
	opentable($locale['LAN_RSS_200']);
	print '<table align="center" width="600" cellspacing="1" cellpadding="0" class="tbl-border">';
	$result = dbquery('SELECT * FROM '.$db_prefix.'rss_feeds ORDER BY page_order ASC');
	$numrows = dbrows($result);
	if ($numrows != 0) {
		print '<tr>
				<td class="tbl2">'.$locale['LAN_RSS_201'].'</td>
				<td class="tbl2">'.$locale['LAN_RSS_202'].'</td>
				<td class="tbl2"  style="text-align:center">'.$locale['LAN_RSS_208'].'</td>
				<td align="right" width="235" class="tbl2">'.$locale['LAN_RSS_203'].'</td>
			</tr>';
		$i = 1;
		while ($data = dbarray($result)) {
			if ($numrows != 1) {
				$up = $data['page_order'] - 1;
				$down = $data['page_order'] + 1;
				if ($i == 1) {
					$up_down = ' <a href="'.FUSION_SELF.$aidlink.'&amp;action=mdown&id='.$data['id'].'&order='.$down.'"><img src="'.THEME.'images/down.gif" border="0"></a>';
				} else if ($i < $numrows) {
					$up_down = ' <a href="'.FUSION_SELF.$aidlink.'&amp;action=mup&id='.$data['id'].'&order='.$up.'"><img src="'.THEME.'images/up.gif" border="0"></a>';
					$up_down .= ' <a href="'.FUSION_SELF.$aidlink.'&amp;action=mdown&id='.$data['id'].'&order='.$down.'"><img src="'.THEME.'images/down.gif" border="0"></a>';
				} else {
					$up_down = ' <a href="'.FUSION_SELF.$aidlink.'&amp;action=mup&id='.$data['id'].'&order='.$up.'"><img src="'.THEME.'images/up.gif" border="0"></a>';
				}
				$i++;
			} else {
				$up_down = '';
				$i++;
			}
			$feed_page = $data['in_feeds_page'] ? $locale['LAN_RSS_195'] : $locale['LAN_RSS_196'];
			$order = $data['page_order'];
			print '<tr>
					<td class="tbl1">
						<a href="'.FUSION_SELF.$aidlink.'&amp;action=edit&id='.$data['id'].'">'.$data['name'].'</a><br>
					</td>
					<td class="tbl1" width="75">
						'.$order.$up_down.'
					</td>
					<td class="tbl1" width="75" style="text-align:center">
						'.$feed_page.'
					</td>
					<td align="right" valign="top" class="tbl1" width="235">
						<a href="'.$data['file'].'" target="_blank">'.$locale['LAN_RSS_204'].'</a> -
						<a href="'.FUSION_SELF.$aidlink.'&amp;action=clear_cache&id='.$data['id'].'">'.$locale['LAN_RSS_205'].'</a> - 
						<a href="'.FUSION_SELF.$aidlink.'&amp;action=delete&id='.$data['id'].'">'.$locale['LAN_RSS_206'].'</a>
					</td>
				</tr>';
		}
		print '</table>';
		print '<div align="center">'.$locale['LAN_RSS_234'].'</div>';
	} else {
		print '<tr><td align="center" class="tbl1">'.$locale['LAN_RSS_207'].'</td></tr></table>';
	}
	closetable();
}

require_once THEMES."templates/footer.php";
?>