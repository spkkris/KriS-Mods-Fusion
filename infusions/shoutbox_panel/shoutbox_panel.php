<?php
//	|---------------------------------------------------------------------------|
//	|	PHP-Fusion 7 Content Management System									|
//	|	Copyright © 2002 - 2005 Nick Jones										|
//	|	http://www.php-fusion.co.uk/											|
//	|---------------------------------------------------------------------------|
//	| 	This program is released as free software under the						|
//	| 	Affero GPL license. You can redistribute it and/or						|
//	| 	modify it under the terms of this license which you						|
//	| 	can read by viewing the included agpl.txt or online						|
//	| 	at www.gnu.org/licenses/agpl.html. Removal of this						|
//	| 	copyright header is strictly prohibited without							|
//	| 	written permission from the original author(s).							|
//	|---------------------------------------------------------------------------|
//	|	xShoutBox Panel															|
//	|	Copyright © 2008 Rizald 'Elyn' Maxwell									|
//	|	www.NubsPixel.com														|
//	|	Filename : xSBox_panel.php												|
//	|	Read the source easier via Notepad++ 									|
//	|		comment fonts changed - Courrier New, 10pt							|
//	|---------------------------------------------------------------------------|
//	|	For more informations, please refer to README.TXT						|
//	|---------------------------------------------------------------------------|

// deny access if the page is open with a weird way.
if (!defined("IN_FUSION")) { die("Access Denied"); }

// checks if user admin
if (iADMIN){$admin = 'true';}else{$admin = 'false';}

//	|-------------------|	required variables			|-------------------|
$reF = 5; // in seconds
$reD = 60; // in seconds

if(!defined("xSBox")){define("xSBox",INFUSIONS."shoutbox_panel/");}
//	|-------------------|	required variables			|-------------------|
if(empty($aidlink))
	$aidlink = 0;
// javascripts, the core functions in all ajax shoutbox
add_to_head("
<link type='text/css' href='".xSBox."includes/style.css' rel='stylesheet'>
<script type='text/javascript'>
var fld = ".$settings['flood_interval'].";
var xsb_admin = ".$admin.";
var xsb_limit = ".$settings['numofshouts'].";
</script>
<script type='text/javascript' src='".xSBox."includes/util.js'></script>
<script type='text/javascript'>
function post(xsb_admin){
	xsb_self = true;
	var sM = gE('shout_message').value;
	startLoad();
	var ac = '';var sn = '';var cp = '';var ne = false; var ed = 0;
	if (gE('shout_name') == undefined )
		sn = '';
	else
		sn = 'shout_name='+gE('shout_name').value+'&';
	if(gE('sb_captcha_code') == undefined)
		cp = '';
	else{
		cp = 'sb_captcha_code='+gE('sb_captcha_code').value+'&';
		gE('sb_captcha_code').value = '';
	}
	if (xsb_edt != 0){
		ac = 'act=edt&shout_id='+xsb_edt+'&';
		xsb_edt = 0; 
	}
	else{
		ac = 'act=new&';
		ne = true;
	}
	var xmlElemn = initXmlHttp();
	ajaxRequest('application/x-www-form-urlencoded',xmlElemn,'POST','".xSBox."post.php',true,function(){}, ac+sn+cp+'shout_message='+sM );
	if(ne){
		getOne(parseInt(xsb_frs), false);
	} else {
		gE('nubs_chat').value = '';
		getOne('edit', false);
	}
	if (xsb_admin){ setTimeout('endLoad(xsb_self)', (1000));}
	else { setTimeout('endLoad(xsb_self)', ".($reF*1000).");}
	if(gE('sb_captcha_code') != undefined)
		setTimeout('xEnd(xsb_self)', 1000);
}

function checkEnter(e){
	var k;
	if(window.event)
		k = e.keyCode;
	else if(e.which)
		k = e.which;

	if(k == 13)
		post(xsb_admin);
}

function xEnd(){
	if(gE('sb_captcha_code') != undefined)
		gE('sb_captcha').src = '".INCLUDES."securimage/securimage_show.php?sid=' + Math.random(); return false;
}

function edtShout(p){
	xsb_edt = p;
	
	gE('shout_message').value = gE('s_'+p).innerHTML;
}
			
function delShout(id){
	var xmlElem = initXmlHttp();
	ajaxRequest('application/x-www-form-urlencoded',xmlElem,'POST','".xSBox."post.php',true,function(){}, 'act=del&shout_id='+id );
	removeOne(id);
	getOne(xsb_las,true);
}

function updateDiv(){
	intr = setInterval('getOne(0, false)',".($reF*1000).");
}

function getOne(id, del){
	var q; 
	if(id == 0){q = '&q=top&p='+(parseInt(xsb_frs));}
	else if(id == 'start'){q = '&q=all';}
	else if(id == 'edit'){q = '&q=all';}
	else if(del){ q = '&q=bot&p='+id; }
	else{q = '&q=top&p='+id;}
	
	var x = gE('nubs_chat').innerHTML;
	var xmlElem = initXmlHttp();
	ajaxRequest(null,xmlElem,'GET','".xSBox."includes/json_page.php?act=chat'+q,true,function(){
		if (xmlElem.readyState==4 && xmlElem.status==200){
			var xmlObj = xmlElem.responseText;
			var g = eval(\"(\"+ xmlObj +\")\");
			if (g.error){
				gE('nubs_chat').innerHTML = '<table width=\'100%\' style=\'height: 100px\'><tr><td align=\'center\'><strong>'+g.error+'<strong><\/i><\/td><\/tr><\/table>';
			}
			else if (g.no_post){}
			else{
				var i;
				var n = ''; var m = ''; var p='';
				var os = new Array();
				for(i = 0; i<g.length;i++){
					n += '<div id=\'sid_'+g[i].shout_id+'\'>';
					if (g[i].shout_name != 0) {
						n += '<div class=\'info\'>';
						n += '<span class=\'tooltip\'>';
						n += '<table class=\'tbl-border\' style=\'padding:5px; bg-color:#000000; cell-spacing:1px;\' width=\'100%\'><tr><td rowspan=\'2\' align=\'center\' class=\'tbl2\' width=\'40px\'>';
						if(g[i].user_avatar)
							n += '<img src=\'".IMAGES."avatars/'+g[i].user_avatar+'\' width=\'40\' height=\'40\' class=\'xsb_status\' alt=\'avatar\' \/><br \/>';
						else
							n += '<img src=\'".IMAGES."avatars/noav.png\' width=\'40\' height=\'40\' class=\'xsb_status\' alt=\'avatar\' \/><br \/>';
						n += '<\/td><td align=\'right\' valign=\'top\'>';
						n += '<a href=\'".BASEDIR."profile.php?lookup='+g[i].shout_name+'\'>'+g[i].user_name+'<\/a>';
						n += '<\/td><\/tr><tr><td align=\'right\' valign=\'top\'>';
						n += g[i].user_level;
						if(g[i].user_loc){
								n += '<\/td><\/tr><tr><td align=\'left\' class=\'tbl2\' valign=\'top\'>Sk±d:<\/td><td align=\'right\'>';
								n += g[i].user_loc;
						}
						n += '<\/td><\/tr><tr><td align=\'left\' class=\'tbl2\' valign=\'top\'>Strona:<\/td><td align=\'right\'>';
						if(g[i].user_web)
							n += '<a href=\''+g[i].user_web+'\'>Odwied¼ WWW<\/a>';
						else
							n += 'Brak WWW';
						n += '<\/tr><\/table>';
						n += '<\/span>';
						
						n += '<div class=\'shoutboxname_'+g[i].shout_name+'\'>';
						if(g[i].user_online == 1){ os[g[i].shout_name] = '<img src=\'".xSBox."images/online.png\'class=\'xsb_status\' alt=\'online\'>'; }
						else{ os[g[i].shout_name] = '<img src=\'".xSBox."images/offline.png\' class=\'xsb_status\' alt=\'offline\'>'; }
						os[g[i].shout_name] += '&nbsp;<strong>'+g[i].user_name+'<\/strong>';
						
						n += os[g[i].shout_name];
						n += '<\/div>';
					} else {
						n += '<div class=\'shoutboxname\'>';
						n += '<img src=\'".xSBox."images/guest.png\' class=\'xsb_status\' alt=\'offline\' \/>&nbsp;';
						n += g[i].user_name+'<\/div>';
					}
					n +='<\/div>';
					
					n += '<div class=\'shoutboxdate\'>'+g[i].date+'<\/div>';
					n += '<div class=\'shoutbox\'>'+g[i].chat+'<\/div>';
					if (g[i].admin == 1){
						n += '[<a href=\'#edt\' class=\'side\' onclick=\'edtShout('+g[i].shout_id+')\'>".$locale['global_076']."<\/a>]';
						n += '[<a href=\'#del\' class=\'side\' onclick=\'delShout('+g[i].shout_id+')\'>".$locale['global_157']."<\/a>]';
						if(g[i].user_level2 == 101)
							n += '[<a href=\'".BASEDIR."administration/members.php".$aidlink."&step=ban&act=on&user_id='+g[i].shout_name+'&status=1\' class=\'side\'>Ban<\/a>]';
					} else if (g[i].self == 1){
						n += '[<a href=\'#edt\' class=\'side\' onclick=\'edtShout('+g[i].shout_id+')\'>".$locale['global_076']."<\/a>]';
						n += '[<a href=\'#del\' class=\'side\' onclick=\'delShout('+g[i].shout_id+')\'>".$locale['global_157']."<\/a>]';
					}
					n += '<div class=\'xsb\' id=\'s_'+g[i].shout_id+'\'>'+g[i].chat2+'<\/div>';
					n +='<br \/><br \/><\/div>';

					if (g[i].archive = 1) {
						m = '<div style=\"text-align:center;\"><a href=\"".xSBox."shoutbox_archive.php\" class=\"side\">".$locale['global_155']."<\/a><\/div>';
					}
				}
				if(g[i] == undefined){i = 0;}
				if (del){
					gE('nubs_chat').innerHTML = x+n;
					fadeMsg('sid_'+g[i].shout_id);
				} else if (id == 'edit'){
					gE('nubs_chat').innerHTML = n;
					fadeMsg('sid_'+xsb_edt);
				} else if (id == 'start'){
					gE('nubs_chat').innerHTML = n+x;
				} else {
					gE('nubs_chat').innerHTML = n+x;
					fadeMsg('sid_'+g[i].shout_id);
				}
						
				gE('nubs_archive').innerHTML = m;
				
				if(!del)
					xsb_frs = g[i].shout_id;
				if(id == 'start')
					xsb_las = g[(g.length)-1].shout_id;
				
				var y = xsb_frs - xsb_las+1;
				
				if (y > xsb_limit){
					setTimeout('removeOne('+xsb_las+')', ".($reD*1000).");
					xsb_las++;
				}
				
				var cArray = getElementsByClassName('shoutboxname_'+g[i].shout_name);
				for(var te= 0; te < cArray.length; te++){
					cArray[te].innerHTML= os[g[i].shout_name];
				}
			}
		}
	},null);
}

function xsb_refresh(){
	intr = null;
	gE('nubs_chat').innerHTML = '';
	
	getOne('start', false);
	intr = setInterval('getOne(0, false)',".($reF*1000).");
}
</script>");
openside($locale['global_150']);
if (iMEMBER || $settings['guestposts'] == "1"){
	include_once INCLUDES."bbcode_include.php";
	echo "<div id='xsb_notice'><img id='load_img' src='".xSBox."images/loading.gif' /></div>";
	echo "<div id='shout_form' align='center'>";
	echo "<form name='chatform' method='post' action=''>\n";
	if (iGUEST && $settings['guestposts'] == "1") {
		echo $locale['global_151']."<br />\n";
		echo "<input type='text' name='shout_name' id='shout_name' value='' class='textbox' maxlength='30' style='width:150px' /><br />\n";
		echo $locale['global_158']."<br />\n";
		echo "<img id='sb_captcha' src='".INCLUDES."securimage/securimage_show.php' alt='' /><br />\n";
	    echo "<a href='".INCLUDES."securimage/securimage_play.php'><img src='".INCLUDES."securimage/images/audio_icon.gif' alt='' class='tbl-border' style='margin-bottom:1px' /></a>\n";
	    echo "<a href='#' onclick=\"document.getElementById('sb_captcha').src = '".INCLUDES."securimage/securimage_show.php?sid=' + Math.random(); return false\"><img src='".INCLUDES."securimage/images/refresh.gif' alt='' class='tbl-border' /></a><br />\n";
		echo $locale['global_159']."<br />\n<input type='text' name='sb_captcha_code' id='sb_captcha_code' class='textbox' style='width:150px' /><br />\n";
	}
	echo $locale['global_152']."<br />\n";
	echo "<textarea name='shout_message' id='shout_message' rows='4' cols='20' class='textbox' style='width:150px' onkeydown='checkEnter(event);'></textarea><br />\n";
	echo display_bbcodes("150px;", "shout_message", "chatform", "smiley|b|u|url|color")."\n";
	echo "</form>\n";
	echo "<input type='submit' name='post_shout' id='post_shout' value='".$locale['global_153']."' class='textbox' onclick='post(xsb_admin)'/>&nbsp;";
	echo "<input type='submit' name='refresh_shout' id='refresh_shout' value='Od¶wie¿!' class='textbox' onclick='xsb_refresh()'/><br /><br /></div>\n";
}
if (iGUEST && $settings['guestposts'] != "1"){
	echo "<div style='text-align:center'>".$locale['global_154']."</div><br /><br />\n";
}
echo "<div id='nubs_chat'>&nbsp;</div>";
echo "<div id='nubs_archive'>&nbsp;</div>";
echo "<script type='text/javascript'>
	window.onbeforeunload = function(){
		xsb_frs = 0;
	};
	</script>";

closeside();

?>