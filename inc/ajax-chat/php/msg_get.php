<?php

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

if (isset($_GET['room']) &&
    isset($_GET['user']) &&
    isset($_GET['pass']) &&
    isset($_GET['mptr']))
{
  include_once 'init.php';
  $modified = unlog_users();

  if ($chat_data['kick'][$_GET['user']] ||
      $chat_data['kick'][$_SERVER['REMOTE_ADDR']])
  {
    echo "-\r\n";
    die;
  }

  if (isset($chat_data['user'][$_GET['user']]) &&
      isset($chat_data['pass'][$_GET['user']]) &&
           ($chat_data['pass'][$_GET['user']]) == $_GET['pass'])
       echo "+\r\n";
  else echo "-\r\n";

  foreach ($chat_data['data'] as $i => $x)
    if ($i > $_GET['mptr'])
      if (!is_array($x))
           echo "$i\r\n$x\r\n";
      else if ($x['priv'] == '.' && $x['room'] == $_GET['room'] ||
               $x['priv'] != '.' && $x['user'] == $_GET['user'] ||
               $x['priv'] != '.' && $x['priv'] == $_GET['user'])
             echo "$i\r\n{$x['data']}\r\n" . (time()-$x['time']) . "\r\n";

  if ($modified) file_put_contents('data.txt', serialize($chat_data));
}

?>