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

if (isset($_GET['user']) && $_GET['user'] &&
    isset($_GET['pass']) && $_GET['pass'] &&
    isset($_GET['priv']) && $_GET['priv'] &&
    isset($_GET['colr']) && $_GET['colr'] &&
    isset($_GET['data']) && $_GET['data'])
{
  include_once 'init.php';
  $modified = unlog_users();

  $time = time();
  $gndr = $chat_data['gndr'][$_GET['user']];
  $stat = $chat_data['stat'][$_GET['user']];
  $room = $chat_data['room'][$_GET['user']];
  $user = htmlentities(preg_replace("/\\s+/iX", " ", $_GET['user']), ENT_QUOTES);
  $priv = htmlentities(preg_replace("/\\s+/iX", " ", $_GET['priv']), ENT_QUOTES);
  $colr = htmlentities(preg_replace("/\\s+/iX", " ", $_GET['colr']), ENT_QUOTES);
  $data = htmlentities(preg_replace("/\\s+/iX", " ", $_GET['data']), ENT_QUOTES);

  if ($chat_data['mute'][$user] || $chat_data['mute'][$_SERVER['REMOTE_ADDR']] ||
      $chat_data['kick'][$user] || $chat_data['kick'][$_SERVER['REMOTE_ADDR']])
  {
    echo $chat_err_mute;
    die;
  }

  if (isset($chat_data['room'][$user]) &&
      isset($chat_data['user'][$user]) &&
      isset($chat_data['pass'][$user]) &&
           ($chat_data['pass'][$user]) == $_GET['pass'])
  {
    $modified = true;

        $chat_data['time'][$user] = time();
    if ($chat_data['away'][$user]) $chat_data['data'][] = "s\r\n$user\r\n+";
        $chat_data['away'][$user] = false;

    if     (in_array($_GET['user'], $chat_admins) &&
            preg_match("/^\\s*\\/(kick|mute)\\s*([0-9a-zA-Z_]+)\\s*([0-9]+)\\s*$/", $_GET['data'], $matches))
    {
      $cmd_type = $matches[1];
      $cmd_user = $matches[2];
      $cmd_time = $matches[3];
      if ($cmd_type == 'kick') $chat_data['kick'][$cmd_user] = time()+$cmd_time*24*3600;
      if ($cmd_type == 'mute') $chat_data['mute'][$cmd_user] = time()+$cmd_time*24*3600;
      if ($cmd_type == 'kick') echo "User <b>" . htmlentities($cmd_user) . "</b> is kicked for " . $cmd_time . " day(s)";
      if ($cmd_type == 'mute') echo "User <b>" . htmlentities($cmd_user) . "</b> is  muted for " . $cmd_time . " day(s)";
    }
    elseif (in_array($_GET['user'], $chat_admins) &&
            preg_match("/^\\s*\\/(list)\\s*(kick|mute)\\s*$/", $_GET['data'], $matches))
    {
      if ($matches[2] == 'kick') echo count($chat_data['kick']) . " user(s) kicked: " . implode(', ', array_keys($chat_data['kick']));
      if ($matches[2] == 'mute') echo count($chat_data['mute']) . " user(s)  muted: " . implode(', ', array_keys($chat_data['mute']));
    }
    else
    {
      $chat_data['data'][] = array('time' => $time,
                                   'room' => $room,
                                   'user' => $user,
                                   'priv' => $priv,
                                   'data' => "m\r\n$colr\r\n$gndr\r\n$stat\r\n$user\r\n$priv\r\n$data");
      foreach($chat_data['data'] as $i => $x)
      {
        if (count($chat_data['data']) <= $chat_histlen) break;
        unset($chat_data['data'][$i]);
      }
    }
  }

  if ($modified) file_put_contents('data.txt', serialize($chat_data));
}

?>