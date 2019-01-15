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


// ***** Popup Control *********************************************************

// ***** dropdown_show_aux *****

function dropdown_show_aux(parent, child)
{
  var p = document.getElementById(parent);
  var c = document.getElementById(child );

  var top  = (c["dropdown_position"] == "y") ? p.offsetHeight+2 : 0;
  var left = (c["dropdown_position"] == "x") ? p.offsetWidth +2 : 0;

  for (; p; p = p.offsetParent)
  {
    top  += p.offsetTop;
    left += p.offsetLeft;
  }

  c.style.position = "absolute";
  c.style.top      = top +'px';
  c.style.left     = left+'px';
  c.style.display  = "block";
}

// ***** dropdown_show *****

function dropdown_show()
{
  var p = document.getElementById(this["dropdown_parent"]);
  var c = document.getElementById(this["dropdown_child" ]);

  dropdown_show_aux(p.id, c.id);
  clearTimeout(c["dropdown_timeout"]);
}

// ***** dropdown_hide *****

function dropdown_hide()
{
  var p = document.getElementById(this["dropdown_parent"]);
  var c = document.getElementById(this["dropdown_child" ]);

  c["dropdown_timeout"] = setTimeout("document.getElementById('"+c.id+"').style.display = 'none'", 333);
}

// ***** dropdown_click *****

function dropdown_click()
{
  var p = document.getElementById(this["dropdown_parent"]);
  var c = document.getElementById(this["dropdown_child" ]);

  if (c.style.display != "block") dropdown_show_aux(p.id, c.id); else c.style.display = "none";
  return false;
}

// ***** dropdown_attach *****

function dropdown_attach(parent, child, showtype, position, cursor)
{
  var p = document.getElementById(parent);
  var c = document.getElementById(child);

  p["dropdown_parent"]     = p.id;
  c["dropdown_parent"]     = p.id;
  p["dropdown_child"]      = c.id;
  c["dropdown_child"]      = c.id;
  p["dropdown_position"]   = position;
  c["dropdown_position"]   = position;

  c.style.position = "absolute";
  c.style.display  = "none";

  if (cursor != undefined) p.style.cursor = cursor;

  switch (showtype)
  {
    case "click":
      p.onclick     = dropdown_click;
      p.onmouseout  = dropdown_hide;
      c.onmouseover = dropdown_show;
      c.onmouseout  = dropdown_hide;
      break;
    case "hover":
      p.onmouseover = dropdown_show;
      p.onmouseout  = dropdown_hide;
      c.onmouseover = dropdown_show;
      c.onmouseout  = dropdown_hide;
      break;
  }
}
