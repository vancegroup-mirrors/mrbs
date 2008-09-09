<?php

// $Id$

require_once "grab_globals.inc.php";
include "config.inc.php";
include "$dbsys.inc";
include "mrbs_auth.inc";
include "functions.inc";
include "version.inc";

// Get form variables
$day = get_form_var('day', 'int');
$month = get_form_var('month', 'int');
$year = get_form_var('year', 'int');
$area = get_form_var('area', 'int');

// If we dont know the right date then make it up
if (!isset($day) or !isset($month) or !isset($year))
{
  $day   = date("d");
  $month = date("m");
  $year  = date("Y");
}
if (empty($area))
{
  $area = get_default_area();
}

print_header($day, $month, $year, $area);

echo "<h3>" . get_vocab("about_mrbs") . "</h3>\n";
echo "<table id=\"version_info\">\n";
echo "<tr><td><a href=\"http://mrbs.sourceforge.net\">" . get_vocab("mrbs") . "</a>:</td><td>" . get_mrbs_version() . "</td></tr>\n";
echo "<tr><td>" . get_vocab("database") . ":</td><td>" . sql_version() . "</td></tr>\n";
echo "<tr><td>" . get_vocab("system") . ":</td><td>" . php_uname() . "</td></tr>\n";
echo "<tr><td>" . get_vocab("servertime") . ":</td><td>" . utf8_strftime("%c", time()) . "</td></tr>\n";
echo "<tr><td>PHP:</td><td>" . phpversion() . "</td></tr>\n";
echo "</table>\n";

echo "<p>\n" . get_vocab("browserlang") .":\n";

echo implode(", ", array_keys($langs));

echo "\n</p>\n";

echo "<h3>" . get_vocab("help") . "</h3>\n";
echo "<p>\n";
echo get_vocab("please_contact") . '<a href="mailto:' . htmlspecialchars($mrbs_admin_email)
  . '">' . htmlspecialchars($mrbs_admin)
  . "</a> " . get_vocab("for_any_questions") . "\n";
echo "</p>\n";
 
include "site_faq" . $faqfilelang . ".html";

include "trailer.inc";
?>
