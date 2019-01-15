<?php
session_start();
include("scr_functions.php");
$f_id = $_REQUEST['f_id'];
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:spry="http://ns.adobe.com/spry">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sumatra: CSS Editor</title>

<script type="text/javascript">
// SpryTabbedPanels.js - version 0.5 - Spry Pre-Release 1.6
//
// Copyright (c) 2006. Adobe Systems Incorporated.
// All rights reserved.
//
// Redistribution and use in source and binary forms, with or without
// modification, are permitted provided that the following conditions are met:
//
//   * Redistributions of source code must retain the above copyright notice,
//     this list of conditions and the following disclaimer.
//   * Redistributions in binary form must reproduce the above copyright notice,
//     this list of conditions and the following disclaimer in the documentation
//     and/or other materials provided with the distribution.
//   * Neither the name of Adobe Systems Incorporated nor the names of its
//     contributors may be used to endorse or promote products derived from this
//     software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
// AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
// IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
// ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
// LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
// CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
// SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
// INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
// CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
// ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
// POSSIBILITY OF SUCH DAMAGE.

var Spry;
if (!Spry) Spry = {};
if (!Spry.Widget) Spry.Widget = {};

Spry.Widget.TabbedPanels = function(element, opts)
{
	this.element = this.getElement(element);
	this.defaultTab = 0; // Show the first panel by default.
	this.tabSelectedClass = "TabbedPanelsTabSelected";
	this.tabHoverClass = "TabbedPanelsTabHover";
	this.tabFocusedClass = "TabbedPanelsTabFocused";
	this.panelVisibleClass = "TabbedPanelsContentVisible";
	this.focusElement = null;
	this.hasFocus = false;
	this.currentTabIndex = 0;
	this.enableKeyboardNavigation = true;

	Spry.Widget.TabbedPanels.setOptions(this, opts);

	// If the defaultTab is expressed as a number/index, convert
	// it to an element.

	if (typeof (this.defaultTab) == "number")
	{
		if (this.defaultTab < 0)
			this.defaultTab = 0;
		else
		{
			var count = this.getTabbedPanelCount();
			if (this.defaultTab >= count)
				this.defaultTab = (count > 1) ? (count - 1) : 0;
		}

		this.defaultTab = this.getTabs()[this.defaultTab];
	}

	// The defaultTab property is supposed to be the tab element for the tab content
	// to show by default. The caller is allowed to pass in the element itself or the
	// element's id, so we need to convert the current value to an element if necessary.

	if (this.defaultTab)
		this.defaultTab = this.getElement(this.defaultTab);

	this.attachBehaviors();
};

Spry.Widget.TabbedPanels.prototype.getElement = function(ele)
{
	if (ele && typeof ele == "string")
		return document.getElementById(ele);
	return ele;
};

Spry.Widget.TabbedPanels.prototype.getElementChildren = function(element)
{
	var children = [];
	var child = element.firstChild;
	while (child)
	{
		if (child.nodeType == 1 /* Node.ELEMENT_NODE */)
			children.push(child);
		child = child.nextSibling;
	}
	return children;
};

Spry.Widget.TabbedPanels.prototype.addClassName = function(ele, className)
{
	if (!ele || !className || (ele.className && ele.className.search(new RegExp("\\b" + className + "\\b")) != -1))
		return;
	ele.className += (ele.className ? " " : "") + className;
};

Spry.Widget.TabbedPanels.prototype.removeClassName = function(ele, className)
{
	if (!ele || !className || (ele.className && ele.className.search(new RegExp("\\b" + className + "\\b")) == -1))
		return;
	ele.className = ele.className.replace(new RegExp("\\s*\\b" + className + "\\b", "g"), "");

};

Spry.Widget.TabbedPanels.setOptions = function(obj, optionsObj, ignoreUndefinedProps)
{
	if (!optionsObj)
		return;
	for (var optionName in optionsObj)
	{
		if (ignoreUndefinedProps && optionsObj[optionName] == undefined)
			continue;
		obj[optionName] = optionsObj[optionName];
	}
};

Spry.Widget.TabbedPanels.prototype.getTabGroup = function()
{
	if (this.element)
	{
		var children = this.getElementChildren(this.element);
		if (children.length)
			return children[0];
	}
	return null;
};

Spry.Widget.TabbedPanels.prototype.getTabs = function()
{
	var tabs = [];
	var tg = this.getTabGroup();
	if (tg)
		tabs = this.getElementChildren(tg);
	return tabs;
};

Spry.Widget.TabbedPanels.prototype.getContentPanelGroup = function()
{
	if (this.element)
	{
		var children = this.getElementChildren(this.element);
		if (children.length > 1)
			return children[1];
	}
	return null;
};

Spry.Widget.TabbedPanels.prototype.getContentPanels = function()
{
	var panels = [];
	var pg = this.getContentPanelGroup();
	if (pg)
		panels = this.getElementChildren(pg);
	return panels;
};

Spry.Widget.TabbedPanels.prototype.getIndex = function(ele, arr)
{
	ele = this.getElement(ele);
	if (ele && arr && arr.length)
	{
		for (var i = 0; i < arr.length; i++)
		{
			if (ele == arr[i])
				return i;
		}
	}
	return -1;
};

Spry.Widget.TabbedPanels.prototype.getTabIndex = function(ele)
{
	var i = this.getIndex(ele, this.getTabs());
	if (i < 0)
		i = this.getIndex(ele, this.getContentPanels());
	return i;
};

Spry.Widget.TabbedPanels.prototype.getCurrentTabIndex = function()
{
	return this.currentTabIndex;
};

Spry.Widget.TabbedPanels.prototype.getTabbedPanelCount = function(ele)
{
	return Math.min(this.getTabs().length, this.getContentPanels().length);
};

Spry.Widget.TabbedPanels.addEventListener = function(element, eventType, handler, capture)
{
	try
	{
		if (element.addEventListener)
			element.addEventListener(eventType, handler, capture);
		else if (element.attachEvent)
			element.attachEvent("on" + eventType, handler);
	}
	catch (e) {}
};

Spry.Widget.TabbedPanels.prototype.onTabClick = function(e, tab)
{
	this.showPanel(tab);

	if (e.preventDefault) e.preventDefault();
	else e.returnValue = false;
	if (e.stopPropagation) e.stopPropagation();
	else e.cancelBubble = true;

	return false;
};

Spry.Widget.TabbedPanels.prototype.onTabMouseOver = function(e, tab)
{
	this.addClassName(tab, this.tabHoverClass);
	return false;
};

Spry.Widget.TabbedPanels.prototype.onTabMouseOut = function(e, tab)
{
	this.removeClassName(tab, this.tabHoverClass);
	return false;
};

Spry.Widget.TabbedPanels.prototype.onTabFocus = function(e, tab)
{
	this.hasFocus = true;
	this.addClassName(tab, this.tabFocusedClass);
	return false;
};

Spry.Widget.TabbedPanels.prototype.onTabBlur = function(e, tab)
{
	this.hasFocus = false;
	this.removeClassName(tab, this.tabFocusedClass);
	return false;
};

Spry.Widget.TabbedPanels.ENTER_KEY = 13;
Spry.Widget.TabbedPanels.SPACE_KEY = 32;

Spry.Widget.TabbedPanels.prototype.onTabKeyDown = function(e, tab)
{
	var key = e.keyCode;
	if (!this.hasFocus || (key != Spry.Widget.TabbedPanels.ENTER_KEY && key != Spry.Widget.TabbedPanels.SPACE_KEY))
		return true;

	this.showPanel(tab);

	if (e.preventDefault) e.preventDefault();
	else e.returnValue = false;
	if (e.stopPropagation) e.stopPropagation();
	else e.cancelBubble = true;

	return false;
};

Spry.Widget.TabbedPanels.prototype.preorderTraversal = function(root, func)
{
	var stopTraversal = false;
	if (root)
	{
		stopTraversal = func(root);
		if (root.hasChildNodes())
		{
			var child = root.firstChild;
			while (!stopTraversal && child)
			{
				stopTraversal = this.preorderTraversal(child, func);
				try { child = child.nextSibling; } catch (e) { child = null; }
			}
		}
	}
	return stopTraversal;
};

Spry.Widget.TabbedPanels.prototype.addPanelEventListeners = function(tab, panel)
{
	var self = this;
	Spry.Widget.TabbedPanels.addEventListener(tab, "click", function(e) { return self.onTabClick(e, tab); }, false);
	Spry.Widget.TabbedPanels.addEventListener(tab, "mouseover", function(e) { return self.onTabMouseOver(e, tab); }, false);
	Spry.Widget.TabbedPanels.addEventListener(tab, "mouseout", function(e) { return self.onTabMouseOut(e, tab); }, false);

	if (this.enableKeyboardNavigation)
	{
		// XXX: IE doesn't allow the setting of tabindex dynamically. This means we can't
		// rely on adding the tabindex attribute if it is missing to enable keyboard navigation
		// by default.

		// Find the first element within the tab container that has a tabindex or the first
		// anchor tag.
		
		var tabIndexEle = null;
		var tabAnchorEle = null;

		this.preorderTraversal(tab, function(node) {
			if (node.nodeType == 1 /* NODE.ELEMENT_NODE */)
			{
				var tabIndexAttr = tab.attributes.getNamedItem("tabindex");
				if (tabIndexAttr)
				{
					tabIndexEle = node;
					return true;
				}
				if (!tabAnchorEle && node.nodeName.toLowerCase() == "a")
					tabAnchorEle = node;
			}
			return false;
		});

		if (tabIndexEle)
			this.focusElement = tabIndexEle;
		else if (tabAnchorEle)
			this.focusElement = tabAnchorEle;

		if (this.focusElement)
		{
			Spry.Widget.TabbedPanels.addEventListener(this.focusElement, "focus", function(e) { return self.onTabFocus(e, tab); }, false);
			Spry.Widget.TabbedPanels.addEventListener(this.focusElement, "blur", function(e) { return self.onTabBlur(e, tab); }, false);
			Spry.Widget.TabbedPanels.addEventListener(this.focusElement, "keydown", function(e) { return self.onTabKeyDown(e, tab); }, false);
		}
	}
};

Spry.Widget.TabbedPanels.prototype.showPanel = function(elementOrIndex)
{
	var tpIndex = -1;
	
	if (typeof elementOrIndex == "number")
		tpIndex = elementOrIndex;
	else // Must be the element for the tab or content panel.
		tpIndex = this.getTabIndex(elementOrIndex);
	
	if (!tpIndex < 0 || tpIndex >= this.getTabbedPanelCount())
		return;

	var tabs = this.getTabs();
	var panels = this.getContentPanels();

	var numTabbedPanels = Math.max(tabs.length, panels.length);

	for (var i = 0; i < numTabbedPanels; i++)
	{
		if (i != tpIndex)
		{
			if (tabs[i])
				this.removeClassName(tabs[i], this.tabSelectedClass);
			if (panels[i])
			{
				this.removeClassName(panels[i], this.panelVisibleClass);
				panels[i].style.display = "none";
			}
		}
	}

	this.addClassName(tabs[tpIndex], this.tabSelectedClass);
	this.addClassName(panels[tpIndex], this.panelVisibleClass);
	panels[tpIndex].style.display = "block";

	this.currentTabIndex = tpIndex;
};

Spry.Widget.TabbedPanels.prototype.attachBehaviors = function(element)
{
	var tabs = this.getTabs();
	var panels = this.getContentPanels();
	var panelCount = this.getTabbedPanelCount();

	for (var i = 0; i < panelCount; i++)
		this.addPanelEventListeners(tabs[i], panels[i]);

	this.showPanel(this.defaultTab);
};

</script>
<script type="text/javascript">
<!--
var addstyle = false;

function WantThis(url) {
 window.opener.document.getElementById('<?php echo $f_id; ?>').value = "url(../"+url+")";
 window.close();
} 

function getContent(page, params, elementid, waitmsg, formname){
var xmlhttp=false;
try {
    xmlhttp = new ActiveXObject('Msxml2.XMLHTTP'); 
    } catch (e) {
    try {
         xmlhttp = new ActiveXObject('Microsoft.XMLHTTP'); 
    } catch (E) {
         xmlhttp = false;
    }
 }
 if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
     xmlhttp = new XMLHttpRequest();
 }
if(params !=''){
	var parametars = params;
}else{
	el =document.getElementById(formname).elements.length;

	var parametars="";
	for(x=0; x<el;x++){
		if(document.getElementById(formname).elements[x].name != 'undefined'){
			if(document.getElementById(formname).elements[x].type == "checkbox"){
				if(document.getElementById(formname).elements[x].checked == true){
					parametars = document.getElementById(formname).elements[x].name+"="+document.getElementById(formname).elements[x].value+"&"+parametars;
				}
			
			}else{
				parametars = document.getElementById(formname).elements[x].name+"="+document.getElementById(formname).elements[x].value+"&"+parametars;
			}
		}
	}
}
var file = page+'?'+parametars;
if(formname ==""){
	xmlhttp.open('GET', file, true);
}else{
	xmlhttp.open('POST', page, true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send(parametars)
}
xmlhttp.onreadystatechange=function() {
if(xmlhttp.readyState == 1){
if(elementid !=""){
document.getElementById(elementid).innerHTML = "<img src='stra_imgs/waiting.gif' align='middle'>"+waitmsg+ "" ;
}
   }else if(xmlhttp.readyState==4) { 
   var content = xmlhttp.responseText;
      if( content ){  
      document.getElementById(elementid).innerHTML = content; 
/*	  sortables_init();
	  alternate();*/
      }
   }
}
if(formname ==""){
	xmlhttp.send(null)
}
return;

}

-->

</script>
<style type="text/css">
@charset "UTF-8";

/* SpryTabbedPanels.css - version 0.4 - Spry Pre-Release 1.6 */

/* Copyright (c) 2006. Adobe Systems Incorporated. All rights reserved. */

/* Horizontal Tabbed Panels
 */
.TabbedPanels {
	margin: 0px;
	padding: 0px;
	float: left;
	clear: none;
	width: 100%; /* IE Hack to force proper layout when preceded by a paragraph. (hasLayout Bug)*/
}

.TabbedPanelsTabGroup {
	margin: 0px;
	padding: 0px;
}

.TabbedPanelsTab {
	position: relative;
	top: 1px;
	float: left;
	padding: 4px 10px;
	margin: 0px 1px 0px 0px;
	background-color: #FFFFFF;
	list-style: none;
	border-left: solid 1px #CCC;
	border-bottom: solid 1px #999;
	border-top: solid 1px #999;
	border-right: solid 1px #999;
	-moz-user-select: none;
	-khtml-user-select: none;
	cursor: pointer;
	font-size: 11px;
	font-weight: bold;
}

.TabbedPanelsTabHover {
	background-color: #CCC;
}

.TabbedPanelsTabSelected {
	background-color: #e3e0dc;
	border-bottom: 1px solid #EEE;
}

.TabbedPanelsTab a {
	color: black;
	text-decoration: none;
}

.TabbedPanelsContentGroup {
	clear: both;
	border-left: solid 1px #CCC;
	border-bottom: solid 1px #CCC;
	border-top: solid 1px #999;
	border-right: solid 1px #999;
	background-color: #e3e0dc;
}

.TabbedPanelsContent {
	padding: 4px;
	height: 230px;
	overflow: auto;
}

.TabbedPanelsContentVisible {
}

.VTabbedPanels .TabbedPanelsTabGroup {
	float: left;
	width: 10em;
	height: 20em;
	background-color: #EEE;
	position: relative;
	border-top: solid 1px #999;
	border-right: solid 1px #999;
	border-left: solid 1px #CCC;
	border-bottom: solid 1px #CCC;
}

.VTabbedPanels .TabbedPanelsTab {
	float: none;
	margin: 0px;
	border-top: none;
	border-left: none;
	border-right: none;
}

.VTabbedPanels .TabbedPanelsTabSelected {
	background-color: #EEE;
	border-bottom: solid 1px #999;
}

.VTabbedPanels .TabbedPanelsContentGroup {
	clear: none;
	float: left;
	padding: 0px;
	width: 30em;
	height: 20em;
}
/*end of spry*/
*{
outline:0;
padding:0px;
margin:0px;
}
body{
color:#333333;
font:11px "Trebuchet MS";
}
#wrapper{
	background:#eee;
	border:1px solid #104780;
	width:440px;
	height:330px;
	margin:0px auto;
}
#styles_panel{
border-left: 1px solid #86A8C9;
height: 350px;
background: #FFFFFF;
margin: 0px;
width: 160px;
float: right;
}
#styles{
border-top:1px outset #dddddd;
width:160;
overflow:auto;
margin:0px;
height:300px;
border-bottom:1px  inset #dddddd;
}
#properties{
	height: 295px;
	width: 419px;
	float: left;
	padding: 10px 10px 0px 10px;
}
#properties  label{
width: 65px;
float:left;
}
#properties textarea{
padding:5px 0px 5px 10px;
}
#properties .style_input{
border:1px inset #666666;
font-size:10px;
padding:2px;
margin-right:10px;
}
#save_bar{
clear:both;
width:auto;
padding:10px 0;
}
#styles_table .style_name{
/*	padding-right:10px;
*/
}
#styles ul{
list-style: none;
}
#styles li{
border-bottom: 1px dashed #EEEEEE;
}
#styles a{
text-decoration: none;
display: block;
padding: 2px 10px;
white-space: nowrap;
}
#styles a:hover{
color: #FFFFFF;
background: #86A8C9;
}
#title{
color:#ffffff;
background:#86A8C9;
width:auto;
padding:5px;
position:;
}
#title input{
font-size: 11px;
border: 1px solid #57ABA9;
padding: 2px;
}
#css_groups{
margin-top:10px;
margin-bottom:3px;
width:auto;
}
#css_groups li{
display:inline;
}
#css_groups a{
padding: 2px 5px;
background-color:#FFFFFF;
border:1px solid #ccc;
text-decoration:none;
}
#css_groups li a:hover{
background-color:#eee;
border:1px solid #ccc;
}
#status{
width:150px;
float:right;
}
#properties th{
background-color:#efefd3;
text-align:left;
padding:5px;
border-bottom:1px solid #ccc;
}
#style_control{
	width:auto;
	background:#E3E0DC;
	height:12px;
	padding:5px;
}

#save_bar input{
	border:1px solid #ccc;
	background:#E3E0DC;
	font-size:11px;
	padding:2px 5px;
}
#fileBrowser {
}

/* File Browser Table */
#fileBrowser table
{
	width:100%;
}

/* rows */
#fileBrowser table tr td 
{
	padding:1px; 
	font-size:12px;	
}

#fileBrowser a 
{ 
	text-decoration:none;
}

#fileBrowser a:hover 
{
	text-decoration:underline;
}

/* rows */
#fileBrowser table tr.fr td, 
#fileBrowser table tr.fl td 
{ 
	border-top:1px solid #fff;
	border-bottom:1px solid #ddd; 
}

/* folder row */
#fileBrowser table tr.fr td.nm 
{ 
	font-weight:bold; 
}

/* parent row */
#fileBrowser table tr.parent 
{ 
	font-weight:bold;
}
#fileBrowser table tr.parent td 
{
	border-bottom:1px solid #ccc; 
	background:#efefd3; /*efefd3*/
}

/* header */
#fileBrowser div.header 
{ 
	margin-bottom:10px; font-size:12px; 
}
#fileBrowser div.header .breadcrumbs
{
	font-size:24px;
}

/* sorting row */

#fileBrowser tr.sort td {  }

/* Columns */
 
/* line number */
#fileBrowser table tr td.ln
{
	border-left:1px solid #ccc; 
	font-weight:normal; 
	text-align:right; 
	padding:0 10px 0 10px; width:10px;
	color: #999;
}

/* date  */
#fileBrowser table tr td.dt 
{ 
	border-right:1px solid #ccc;
}
   
/* footer row */
#fileBrowser table tr.footer td 
{
	border:0;	
	font-weight:bold;
}

/* sort row */
#fileBrowser table tr.sort td 
{
	border:0; 
	border-bottom:1px solid #ccc; 
}

/* alternating Row Colors */
/* folders */
tr.fr.r1 
{
	background-color:#eee;

}
tr.fr.r2 { }
/* files */
tr.r1 
{
	background-color:#eee; 
}
tr.r2 {  }

</style>
</head>

<body>
<div id="wrapper">
  
  <div id="title">
  <label id="status"></label>
    <label>&nbsp;&nbsp;&nbsp;Sumatra: CSS Editor</label>
  </div>
  <div id="properties">
       <div id="TabbedPanels1" class="TabbedPanels">
      <ul class="TabbedPanelsTabGroup">
        <li class="TabbedPanelsTab" tabindex="0">Select background image</li>
        </ul>
      <div class="TabbedPanelsContentGroup">
        <div class="TabbedPanelsContent" id="load_styles">
		<?php 	
		include("file_browser.php");
		echo "<div id=\"fileBrowser\">";
		new FileBrowser();
		echo "</div>";			
		?>
        </div>
        </div>
       </div> 
</div>
  </div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
