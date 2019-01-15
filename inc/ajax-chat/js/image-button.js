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


var imageButtons = {};


// ***** Auxiliary *************************************************************

function imageButtonElement (e)
{
  if (navigator.appName == "Microsoft Internet Explorer")
       return window.event.srcElement;
  else return e.target;
}

function imageButtonMouseBtn(e)
{
  if (navigator.appName == "Microsoft Internet Explorer")
       return window.event.button;
  else return e.which;
}

function imageButtonAttachEvent(element, eventName, eventHandler)
{
  if (navigator.appName == "Microsoft Internet Explorer")
       element.attachEvent('on'+eventName, eventHandler);
  else element.addEventListener(eventName, eventHandler, false);
}


// ***** Buttons ***************************************************************

function imageButtonPress(e)
{
  if (!window['imageButtons'       ]) return;
  if (!window['imageButtonElement' ]) return;
  if (!window['imageButtonMouseBtn']) return;
  if ( window['imageButtonMouseBtn'](e) != 1) return;
  window['imageButtons'][window['imageButtonElement'](e).id] = true;
  window['imageButtonElement'](e).style['backgroundPosition'] = "1px 1px";
}

function imageButtonRelea(e)
{
  if (!window['imageButtons'       ]) return;
  if (!window['imageButtonElement' ]) return;
  if (!window['imageButtonMouseBtn']) return;
  if ( window['imageButtonMouseBtn'](e) != 1) return;
  window['imageButtons'][window['imageButtonElement'](e).id] = false;
  window['imageButtonElement'](e).style['backgroundPosition'] = "0px 0px";
}

function imageButtonEnter(e)
{
  if (!window['imageButtons'      ]) return;
  if (!window['imageButtonElement']) return;
  if (!window['imageButtons'][window['imageButtonElement'](e).id]) return;
  window['imageButtonElement'](e).style['backgroundPosition'] = "1px 1px";
}

function imageButtonLeave(e)
{
  if (!window['imageButtons'      ]) return;
  if (!window['imageButtonElement']) return;
  if (!window['imageButtons'][window['imageButtonElement'](e).id]) return;
  window['imageButtonElement'](e).style['backgroundPosition'] = "0px 0px";
}

function imageButtonAdd (id)
{
  var element = document.getElementById(id);
  imageButtonAttachEvent(element, 'mousedown', imageButtonPress);
  imageButtonAttachEvent(element, 'mouseup',   imageButtonRelea);
  imageButtonAttachEvent(element, 'mouseover', imageButtonEnter);
  imageButtonAttachEvent(element, 'mouseout',  imageButtonLeave);
  imageButtonAttachEvent(element, 'blur',      imageButtonRelea);
}


// ***** Document **************************************************************

function imageButtonDocumentPress(e)
{
  if (!window['imageButtons']) return;
  for(var i in window['imageButtons'])
  {
    window['imageButtons'][i] = false;
    document.getElementById(i).style["backgroundPosition"] = "0px 0px";
  }
}

imageButtonAttachEvent(document, 'mouseup', imageButtonDocumentPress);
