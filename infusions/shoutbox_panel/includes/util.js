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
//	|	Filename : util.js														|
//	|	Read the source easier via Notepad++ 									|
//	|		comment fonts changed - Courrier New, 10pt							|
//	|---------------------------------------------------------------------------|
//	|	For more informations, please refer to README.TXT						|
//	|---------------------------------------------------------------------------|

function gE(id){
	return document.getElementById(id);
}

// fade timing :P
var fadeSteps = 24; var fadeDelay = 24; 
var fadeElem;
var xsb_self = false;
var xsb_edt = 0; var xsb_frs = 0; 
var xsb_las = 0; var intr; 


function fadeMsg(id_name){ 
	if (gE(id_name) != undefined){
		setOpacity(gE(id_name), 0);
		fadeStep = 20; 
		fadeElem = gE(id_name);
		fadeStep = 1; 
		xSB_fadeIn();
	}
}
function xSB_fadeIn() { 
	setOpacity(fadeElem, (fadeStep/fadeSteps)); 
	// set initial background color here 
	//setBGcolor(fadeElem,255,255,255,(fadeStep/fadeSteps)); 
	fadeStep++;
	if((fadeStep/fadeSteps) <= 1){
		window.setTimeout("xSB_fadeIn()", fadeDelay); 
	}
	else{
		if (xsb_admin){ setTimeout('endLoad(xsb_self)', (1000));}
		else { setTimeout('endLoad(xsb_self)', (fld*1000));}
	}
}

//content
function setOpacity(el, opacity){ 
	if(el.style.opacity != undefined){ 
		el.style.opacity = opacity; 
	}else if( el.style.MozOpacity != undefined){ 
		el.style.MozOpacity = opacity; 
	}else if ( el.style.filter != undefined){ 
		el.style.filter="alpha(opacity=" + Math.round(opacity * 100) + ")"; 
	} 
}

/* // backgrounds
// i don't know how to explain this
function setBGcolor(el, co1, co2, co3, ratio){
	var a = (Math.round(co1*ratio)); 
	var b = (Math.round(co2*ratio)); 
	var c = (Math.round(co3*ratio));
	
	el.style.background = "rgb("+a+","+b+","+c+")";
} */

function clear(){
	gE('error').innerHTML = "";
}

function removeElement(parentDiv, childDiv){
	if (childDiv == parentDiv) {
		// do nothing
	}
	else if (gE(childDiv)) {     
		var child = gE(childDiv);
		var parent = gE(parentDiv);
		parent.removeChild(child);
	}
	else {
		return false;
	}
}

function removeOne(y){
	removeElement("nubs_chat", "sid_"+y);
}

function startLoad(){
	if (gE('shout_form') != undefined && gE('shout_form') != null ){
		var width=gE('shout_form').offsetWidth;
		var height=gE('shout_form').offsetHeight;
	}
	gE('xsb_notice').style.visibility = 'visible';
	gE('xsb_notice').style.opacity = 1;
	gE('xsb_notice').style.width = width+'px';
	gE('xsb_notice').style.height = height+'px';
	
	// change this part if you are using different loading image.
	width = (width-100)/2;
	height = (height-100)/2;
	
	gE('load_img').style.left = width+'px';
	gE('load_img').style.top = height+'px';
	
	if (gE('shout_form') != undefined && gE('shout_form') != null ){
		gE('shout_form').style.visibility = 'hidden';
		gE('shout_form').style.opacity = 0;
	}
	
	if(gE("post_shout") != undefined){
		gE('post_shout').style.visibility = 'hidden';
		gE('post_shout').style.opacity = 0;
	}
	if(gE("refresh_shout") != undefined){
		gE('refresh_shout').style.visibility = 'hidden';
		gE('refresh_shout').style.opacity = 0;
	}
}

function endLoad(who){
	gE('shout_form').style.visibility = 'visible';
	gE('shout_form').style.opacity = 1;
	
	gE('xsb_notice').style.visibility = 'hidden';
	gE('xsb_notice').style.opacity = 0;
	gE('xsb_notice').style.height = '0px';
	gE('xsb_notice').style.width = '0px';
	
	if(who && gE("shout_message") != undefined){
		gE("shout_message").value = "";
	}
	xsb_self = false;
	if(gE("post_shout") != undefined){
		gE("post_shout").style.visibility = "visible";
		gE('post_shout').style.opacity = 1;
	}
	if(gE("refresh_shout") != undefined){
		gE("refresh_shout").style.visibility = "visible";
		gE('refresh_shout').style.opacity = 1;
	}
}

// stolen from Panda  :D
function ajaxRequest(content_type,c,method,url,async,funct,param) {
	if (c) {
		c.open(method,url,async);
		c.onreadystatechange = funct;
		if(content_type!=null)
			c.setRequestHeader("Content-Type",content_type);
		c.send(typeof(param)=="undefined"?null:param);
	}
}

function initXmlHttp(){
	var xmlhttp=false;
	if(window.ActiveXObject){
		var aVers = ["MSXML2.XMLHTTP.6.0","MSXML2.XMLHTTP.3.0","MSXML2.XMLHTTP","Microsoft.XMLHTTP"];
		for (var i=0;i<aVers.length&&!xmlhttp;i++){
			try{ xmlhttp=new window.ActiveXObject(aVers[i]); }catch(e){ xmlhttp=false; }
		}
		if (!xmlhttp){
			try{ xmlhttp = window.createRequest(); }
			catch(e){ xmlhttp=false; }
		}
	}
	if (!xmlhttp){
		if (typeof XMLHttpRequest != "undefined"){ xmlhttp = new XMLHttpRequest(); }
	}
	return xmlhttp;
}

/*
	Developed by Robert Nyman, http://www.robertnyman.com
	Code/licensing: http://code.google.com/p/getelementsbyclassname/
*/	
var getElementsByClassName = function (className, tag, elm){
	if (document.getElementsByClassName) {
		getElementsByClassName = function (className, tag, elm) {
			elm = elm || document;
			var elements = elm.getElementsByClassName(className),
				nodeName = (tag)? new RegExp("\\b" + tag + "\\b", "i") : null,
				returnElements = [],
				current;
			for(var i=0, il=elements.length; i<il; i+=1){
				current = elements[i];
				if(!nodeName || nodeName.test(current.nodeName)) {
					returnElements.push(current);
				}
			}
			return returnElements;
		};
	}
	else if (document.evaluate) {
		getElementsByClassName = function (className, tag, elm) {
			tag = tag || "*";
			elm = elm || document;
			var classes = className.split(" "),
				classesToCheck = "",
				xhtmlNamespace = "http://www.w3.org/1999/xhtml",
				namespaceResolver = (document.documentElement.namespaceURI === xhtmlNamespace)? xhtmlNamespace : null,
				returnElements = [],
				elements,
				node;
			for(var j=0, jl=classes.length; j<jl; j+=1){
				classesToCheck += "[contains(concat(' ', @class, ' '), ' " + classes[j] + " ')]";
			}
			try	{
				elements = document.evaluate(".//" + tag + classesToCheck, elm, namespaceResolver, 0, null);
			}
			catch (e) {
				elements = document.evaluate(".//" + tag + classesToCheck, elm, null, 0, null);
			}
			while ((node = elements.iterateNext())) {
				returnElements.push(node);
			}
			return returnElements;
		};
	}
	else {
		getElementsByClassName = function (className, tag, elm) {
			tag = tag || "*";
			elm = elm || document;
			var classes = className.split(" "),
				classesToCheck = [],
				elements = (tag === "*" && elm.all)? elm.all : elm.getElementsByTagName(tag),
				current,
				returnElements = [],
				match;
			for(var k=0, kl=classes.length; k<kl; k+=1){
				classesToCheck.push(new RegExp("(^|\\s)" + classes[k] + "(\\s|$)"));
			}
			for(var l=0, ll=elements.length; l<ll; l+=1){
				current = elements[l];
				match = false;
				for(var m=0, ml=classesToCheck.length; m<ml; m+=1){
					match = classesToCheck[m].test(current.className);
					if (!match) {
						break;
					}
				}
				if (match) {
					returnElements.push(current);
				}
			}
			return returnElements;
		};
	}
	return getElementsByClassName(className, tag, elm);
};