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


// ***** Config ****************************************************************

// The list of admin users.
// To add multiple admins, use a code like this: array('admin1', 'admin2', 'admin3');
$chat_admins    = array('admin');

// The number of messages to keep
$chat_histlen   = 1000;

// Interval in seconds to wait before setting status to away
$chat_t_away    = 30;

// Interval in seconds to wait before disconnecting a user
$chat_t_logout  = 3600;

// Interval in seconds between refreshes
$chat_t_refresh = 1;

// Messages sent to the users
$chat_err_inval = 'Invalid username or password!';
$chat_err_inuse = 'The username you selected is already in use!';
$chat_err_kick  = 'You are not allowed to enter   the chat. Contact admin for explanation.';
$chat_err_mute  = 'You are not allowed to post in the chat. Contact admin for explanation.';

// Use this function to validate registered users' login information.
function chat_chk($username, $password, &$gender, &$status)
{
  $gender = 'none';
  $status = 'none';

  // Remove this line
  return true;

  // Enter MySQL access information
  $MySQL_username = '';
  $MySQL_password = '';
  $MySQL_database = '';

  // Enter the location of user data in MySQL database
  $MySQL_table          = '';
  $MySQL_username_field = '';
  $MySQL_password_field = '';

  // The code bellow should work without modification for most users
  mysql_connect('localhost', $MySQL_username, $MySQL_password);
  mysql_select_db($MySQL_database);
  $username = isset($username) ? mysql_real_escape_string($username) : '';
  $password = isset($password) ? mysql_real_escape_string($password) : '';
  $result   = mysql_query("select * from $MySQL_table where $MySQL_username_field = '$username' and ($MySQL_password_field = '$password' or $MySQL_password_field = MD5('$password') or MD5($MySQL_password_field) = '$password' or $MySQL_password_field = MD5(MD5('$password')) or MD5(MD5($MySQL_password_field)) = '$password')");

  global $chat_data;
  return mysql_fetch_assoc($result) ||
         isset($chat_data['user'][$username]) &&
         isset($chat_data['pass'][$username]) &&
              ($chat_data['pass'][$username] == $password);
}


// ***** Init ******************************************************************

error_reporting(E_ALL ^ E_NOTICE);
ini_set("log_errors",     0);
ini_set("display_errors", 1);

if (!headers_sent())
{
  session_id  ('lock');
  session_name('lock');
  session_start();

  header("Pragma: no-cache");
  header("Cache-Control: no-cache");
  header("Expires: Fri, 31 Dec 1999 23:59:59 GMT");
}

$chat_data = file_get_contents(dirname(__FILE__) . '/data.txt');
$chat_data = $chat_data ?  unserialize($chat_data) : array();

if (!isset($chat_data['time'])) $chat_data['time'] = array();
if (!isset($chat_data['away'])) $chat_data['away'] = array();
if (!isset($chat_data['gndr'])) $chat_data['gndr'] = array();
if (!isset($chat_data['stat'])) $chat_data['stat'] = array();
if (!isset($chat_data['room'])) $chat_data['room'] = array();
if (!isset($chat_data['user'])) $chat_data['user'] = array();
if (!isset($chat_data['pass'])) $chat_data['pass'] = array();
if (!isset($chat_data['data'])) $chat_data['data'] = array();
if (!isset($chat_data['kick'])) $chat_data['kick'] = array();
if (!isset($chat_data['mute'])) $chat_data['mute'] = array();


// ***** Lib *******************************************************************

// ***** chat_chk_guest     *****

function chat_chk_guest($username, $password, &$gender, &$status)
{
  $gender = 'none';
  $status = 'none';
  return !isset($GLOBALS['chat_data']['user'][$username]) ||
         !isset($GLOBALS['chat_data']['pass'][$username]) ||
               ($GLOBALS['chat_data']['pass'][$username]) == $password;
}

// ***** microtime_float    *****

function microtime_float()
{
  list($usec, $sec) = explode(' ', microtime());
  return (float)$usec+(float)$sec;
}

// ***** file_put_contents  *****

if (!function_exists('file_put_contents'))
{
  function file_put_contents($name, $data)
  {
    if (!($handle = @fopen($name, 'w'))) return false;
    $bytes = fwrite($handle, $data);
    fclose($handle);
    return $bytes;
  }
}

// ***** strip_slashes_deep *****

if (!function_exists('strip_slashes_deep') && get_magic_quotes_gpc())
{
  function strip_slashes_deep($value)
  {
    if (is_array($value)) return array_map('strip_slashes_deep', $value);
    return stripslashes($value);
  }

  $_GET    = strip_slashes_deep($_GET);
  $_POST   = strip_slashes_deep($_POST);
  $_COOKIE = strip_slashes_deep($_COOKIE);
}

// ***** unlog_users        *****

function unlog_users()
{
  $modified = false;

  if (isset($GLOBALS['chat_data']['user'][$_GET['user']]))
  {
    $GLOBALS['chat_data']['user'][$_GET['user']] = microtime_float();
    $modified = true;
  }

  foreach  ($GLOBALS['chat_data']['time'] as $user => $tm)
  if ($tm  <  time()-$GLOBALS['chat_t_away'])
  if ( !$GLOBALS['chat_data']['away'][$user])
  {
    $GLOBALS['chat_data']['data'][] = "s\r\n$user\r\n-";
    $GLOBALS['chat_data']['away'][$user] = true;
  }

  foreach  ($GLOBALS['chat_data']['user'] as $user => $tm)
  if ($tm  <  microtime_float()-$GLOBALS['chat_t_logout'])
  {
    $GLOBALS['chat_data']['data'][] = "-\r\n{$GLOBALS['chat_data']['room'][$user]}\r\n$user";
    unset($GLOBALS['chat_data']['time'][$user]);
    unset($GLOBALS['chat_data']['away'][$user]);
    unset($GLOBALS['chat_data']['gndr'][$user]);
    unset($GLOBALS['chat_data']['stat'][$user]);
    unset($GLOBALS['chat_data']['room'][$user]);
    unset($GLOBALS['chat_data']['user'][$user]);
    unset($GLOBALS['chat_data']['pass'][$user]);
    $modified = true;
  }

  foreach  ($GLOBALS['chat_data']['kick'] as $user => $tm) if ($tm < time())
  {
    unset($GLOBALS['chat_data']['kick'][$user]);
    $modified = true;
  }

  foreach  ($GLOBALS['chat_data']['mute'] as $user => $tm) if ($tm < time())
  {
    unset($GLOBALS['chat_data']['mute'][$user]);
    $modified = true;
  }

  return  $modified;
}

?>