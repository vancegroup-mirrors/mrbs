<?php

// $Id$

// Index is just a stub to redirect to the appropriate view
// as defined in config.inc.php using the variable $default_view
// If $default_room is defined in config.inc.php then this will
// be used to redirect to a particular room.

require_once "defaultincludes.inc";
require_once "mrbs_sql.inc";

switch ($default_view)
{
  case "month":
    $redirect_str = "month.php";
    break;
  case "week":
    $redirect_str = "week.php";
    break;
  default:
    $redirect_str = "day.php";
}

$redirect_str .= "?year=$year&month=$month&day=$day";

if ( ! empty($default_room) )
{
  $area = mrbsGetRoomArea($default_room);
  $room = $default_room;
  $redirect_str .= "&area=$area&room=$room";
}

header("Location: $redirect_str");

?>
