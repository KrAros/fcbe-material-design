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
    isset($_GET['gues']))
{
  include_once 'init.php';
  $modified = unlog_users();

  if ($chat_data['kick'][$_GET['user']] ||
      $chat_data['kick'][$_SERVER['REMOTE_ADDR']])
  {
    echo "FAILED\r\n$chat_err_kick";
    die;
  }

  $modified = true;

  $gndr = 'none';
  $stat = 'none';
  $room = $_GET['room'];
  $user = $_GET['user'];
  $pass = $_GET['pass'];
  $gues = $_GET['gues'];

  if (  true) if (!preg_match('/^\w+( +\w+)*$/', $room))       { echo "FAILED\r\n$chat_err_inval"; die; }
  if (  true) if (!preg_match('/^\w+$/',         $user))       { echo "FAILED\r\n$chat_err_inval"; die; }
  if (!$gues) if (!chat_chk      ($user, $pass, $gndr, $stat)) { echo "FAILED\r\n$chat_err_inval"; die; }
  if ( $gues) $user = "guest-$user";
  if ( $gues) if (!chat_chk_guest($user, $pass, $gndr, $stat)) { echo "FAILED\r\n$chat_err_inuse"; die; }
  if (  true) if (isset($chat_data['user'][$user]))            { $GLOBALS['chat_data']['data'][] = "-\r\n{$chat_data['room'][$user]}\r\n{$user}"; }

  $chat_data['time'][$user] = time();
  $chat_data['away'][$user] = false;
  $chat_data['gndr'][$user] = $gndr;
  $chat_data['stat'][$user] = $stat;
  $chat_data['room'][$user] = $room;
  $chat_data['user'][$user] = time();
  $chat_data['pass'][$user] = md5(rand());
  $chat_data['data'][] = "+\r\n{$room}\r\n{$user}\r\n{$gndr}\r\n{$stat}";
  echo "OK\r\n{$user}\r\n{$chat_data['pass'][$user]}\r\n";

  if ($modified) file_put_contents('data.txt', serialize($chat_data));
}

?>