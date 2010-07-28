<?php 

// $Id$

// Only used if JavaScript is enabled

require_once "systemdefaults.inc.php";
require_once "config.inc.php";
require_once "functions.inc";
require_once "theme.inc";

header("Content-type: text/css"); 
expires_header(60*30); // 30 minute expiry

?>

<?php
// Over-rides for multiple bookings.  If JavaScript is enabled then we want to see the JavaScript controls.
// And we will need to extend the padding so that the controls don't overwrite the booking text
?>

div.multiple_control {
    display: block;   /* if JavaScript is enabled then we want to see the JavaScript controls */
  }
.multiple_booking .maxi a {padding-left: <?php echo $main_cell_height + $main_table_cell_border_width + 2 ?>px}

<?php
// Don't display anything with a class of js_none (used for example for hiding Submit
// buttons when we're submitting onchange)
?>
.js_none {
    display: none;
  }
