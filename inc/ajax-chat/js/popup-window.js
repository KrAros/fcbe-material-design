// Copyright (C) 2008 Ilya S. Lyubinskiy. All rights reserved.
// Technical support: http://www.php-development.ru/
//
// YOU MAY NOT
// (1) Remove or modify this copyright notice.
// (2) Re-distribute this code or any part of it.
//     Instead, you may link to the homepage of this code:
//     http://www.php-development.ru/javascripts/ajax-chat.php
// (3) Use this code or any part of it as part of another product.
//
// YOU MAY
// (1) Use this code on your website.
//
// NO WARRANTY
// This code is provided "as is" without warranty of any kind.
// You expressly acknowledge and agree that use of this code is at your own risk.


// ***** Variables *************************************************************

var popup_zIndex = 1;
var popup_mouseX;
var popup_mouseY;
var popup_drag = false;
var popup_drag_target;
var popup_drag_mouseX;
var popup_drag_mouseY;
var popup_oldfunction;


// ***** popup_mousedown *******************************************************

function popup_mousedown(e)
{
  var ie = navigator.appName == "Microsoft Internet Explorer";

  popup_mouseX = ie ? window.event.clientX : e.clientX;
  popup_mouseY = ie ? window.event.clientY : e.clientY;
}


// ***** popup_mousedown_window ************************************************

function popup_mousedown_window(e)
{
  var ie = navigator.appName == "Microsoft Internet Explorer";

  if ( ie && window.event.button != 1) return;
  if (!ie && e.button            != 0) return;

  popup_drag   = true;
  popup_drag_target = this['target'];
  popup_drag_mouseX = ie ? window.event.clientX : e.clientX;
  popup_drag_mouseY = ie ? window.event.clientY : e.clientY;

  if (ie)
       popup_oldfunction = document.onselectstart;
  else popup_oldfunction = document.onmousedown;

  if (ie)
       document.onselectstart = new Function("return false;");
  else document.onmousedown   = new Function("return false;");
}


// ***** popup_mousemove *******************************************************

function popup_mousemove(e)
{
  var ie      = navigator.appName == "Microsoft Internet Explorer";
  var element = document.getElementById(popup_drag_target);
  var mouseX  = ie ? window.event.clientX : e.clientX;
  var mouseY  = ie ? window.event.clientY : e.clientY;

  if (!popup_drag || element.style.position == 'fixed') return;

  element.style.left = (element.offsetLeft+mouseX-popup_drag_mouseX)+'px';
  element.style.top  = (element.offsetTop +mouseY-popup_drag_mouseY)+'px';
  popup_drag_mouseX  = ie ? window.event.clientX : e.clientX;
  popup_drag_mouseY  = ie ? window.event.clientY : e.clientY;
}


// ***** popup_mouseup *********************************************************

function popup_mouseup(e)
{
  var ie      = navigator.appName == "Microsoft Internet Explorer";
  var element = document.getElementById(popup_drag_target);

  if (!popup_drag) return;

  popup_drag = false;

  if (ie)
       document.onselectstart = popup_oldfunction;
  else document.onmousedown   = popup_oldfunction;
}


// ***** popup_exit ************************************************************

function popup_exit(e)
{
  var ie      = navigator.appName == "Microsoft Internet Explorer";
  var element = document.getElementById(popup_drag_target);

  if (chat_focu) document.getElementById('send').focus();
  popup_mouseup(e);
  element.style.display = 'none';
}


// ***** popup_show ************************************************************

function popup_show(id, drag_id, exit_id, position, x, y, position_id, fixed)
{
  var element      = document.getElementById(id);
  var drag_element = document.getElementById(drag_id);
  var exit_element = document.getElementById(exit_id);
  var width        = window.innerWidth  ? window.innerWidth  : document.documentElement.clientWidth;
  var height       = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight;

  if (position == "element" || position == "element-right" || position == "element-bottom")
  {
    var position_element = document.getElementById(position_id);
    for (var p = position_element; p; p = p.offsetParent) x += p.offsetLeft;
    for (var p = position_element; p; p = p.offsetParent) y += p.offsetTop;
    if (position == "element-right" ) x += position_element.clientWidth;
    if (position == "element-bottom") y += position_element.clientHeight;
    element.style.left = x+'px';
    element.style.top  = y+'px';
  }

  if (position == "mouse")
  {
    element.style.left = (document.documentElement.scrollLeft+popup_mouseX+x)+'px';
    element.style.top  = (document.documentElement.scrollTop +popup_mouseY+y)+'px';
  }

  if (position == "screen-top-left")
  {
    element.style.left = (document.documentElement.scrollLeft+(width -element.clientWidth )*0+x)+'px';
    element.style.top  = (document.documentElement.scrollTop +(height-element.clientHeight)*0+y)+'px';
  }

  if (position == "screen-center")
  {
    element.style.left = (document.documentElement.scrollLeft+(width -element.clientWidth )/2+x)+'px';
    element.style.top  = (document.documentElement.scrollTop +(height-element.clientHeight)/2+y)+'px';
  }

  if (position == "screen-bottom-right")
  {
    element.style.left = (document.documentElement.scrollLeft+(width -element.clientWidth )*1+x)+'px';
    element.style.top  = (document.documentElement.scrollTop +(height-element.clientHeight)*1+y)+'px';
  }

  drag_element['target']   = id;
  drag_element.onmousedown = popup_mousedown_window;
  exit_element.onclick     = popup_exit;

  if (fixed && navigator.appName == 'Netscape')
       element.style.position = "fixed";
  else element.style.position = "absolute";
  element.style.zIndex     = popup_zIndex++;
  element.style.display    = "block";

  if (chat_focu)
    if      (id ==  'login') document.getElementById( 'user').focus();
    else if (id == 'glogin') document.getElementById('guser').focus();
    else                     document.getElementById( 'send').focus();
  if (true)
    if      (id ==  'login') popup_hide('glogin');
    else if (id == 'glogin') popup_hide( 'login');
}


// ***** popup_hide ************************************************************

function popup_hide(id)
{
  with (document.getElementById(id).style)
  {
    if (chat_focu) if (display == 'block') document.getElementById( 'send').focus();
    display = 'none';
  }
}


// ***** Attach Events *********************************************************

if (navigator.appName == "Microsoft Internet Explorer")
     document.attachEvent   ('onmousedown', popup_mousedown);
else document.addEventListener('mousedown', popup_mousedown, false);

if (navigator.appName == "Microsoft Internet Explorer")
     document.attachEvent   ('onmousemove', popup_mousemove);
else document.addEventListener('mousemove', popup_mousemove, false);

if (navigator.appName == "Microsoft Internet Explorer")
     document.attachEvent   ('onmouseup',   popup_mouseup);
else document.addEventListener('mouseup',   popup_mouseup,   false);
