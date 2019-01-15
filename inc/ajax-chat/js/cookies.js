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


// ***** setCookie *************************************************************

function setCookie  (name, value, expires,  path, domain, secure)
{
  if (expires) expires = expires.toGMTString();
  document.cookie = name+"="+escape(value)+
                            (expires ? "; expires="+expires : "")+
                            (path    ? "; path="   +path    : "")+
                            (domain  ? "; domain=" +domain  : "")+
                            (secure  ? "; secure"           : "");
}


// ***** setCookieLT ***********************************************************

function setCookieLT(name, value, lifetime, path, domain, secure)
{
  if (lifetime) lifetime = new Date(Date.parse(new Date())+lifetime*1000);
  setCookie(name, value, lifetime, path, domain, secure);
}


// ***** getCookie *************************************************************

function getCookie(name)
{
  var cookie, offset, end;
  cookie  = " "+document.cookie;
  offset  = cookie.indexOf(" "+name+"=");
  if (offset == -1) return undefined;
  offset += name.length+2;
  end     = cookie.indexOf(";", offset)
  if (end    == -1) end = cookie.length;
  return unescape(cookie.substring(offset, end));
}


// ***** delCookie *************************************************************

function delCookie(name, path, domain)
{
  if (getCookie(name)) setCookie(name, "", new Date("January 01, 2000 00:00:01"), path, domain);
}