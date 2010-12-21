<?php
// $Id$

require_once "defaultincludes.inc";

// Constant definitions for the value of the summarize parameter.   These are used
// for bit-wise comparisons.    For example summarize=3 means produce both
// a report and a summary; summaraize=5 means produce a report as a CSV file
define('REPORT',      0x01);
define('SUMMARY',     0x02);
// a series of constants defining the ouput format.   These are in the same
// bit series as the output contents above, though not all combinations are sensible
define('OUTPUT_HTML', 0x04);
define('OUTPUT_CSV',  0x08);
define('OUTPUT_ICAL', 0x10);

// Constants for booking privacy matching
define('PRIVATE_NO',   0);
define('PRIVATE_YES',  1);
define('PRIVATE_BOTH', 2);  // Can be anything other than 0 or 1

// Constants for booking confirmation matching
define('CONFIRMED_NO',   0);
define('CONFIRMED_YES',  1);
define('CONFIRMED_BOTH', 2);  // Can be anything other than 0 or 1

// Constants for booking approval matching
define('APPROVED_NO',   0);
define('APPROVED_YES',  1);
define('APPROVED_BOTH', 2);  // Can be anything other than 0 or 1


function date_time_string($t)
{
  global $twentyfourhour_format;
  if ($twentyfourhour_format)
  {
    $timeformat = "%H:%M:%S";
  }
  else
  {
    $timeformat = "%I:%M:%S%p";
  }
  return utf8_strftime("%A %d %B %Y ".$timeformat, $t);
}

function hours_minutes_seconds_format()
{
  global $twentyfourhour_format;

  if ($twentyfourhour_format)
  {
    $timeformat = "%H:%M:%S";
  }
  else
  {
    $timeformat = "%I:%M:%S%p";
  }
  return $timeformat;
}

// Convert a start time and end time to a plain language description.
// This is similar but different from the way it is done in view_entry.
function describe_span($starts, $ends)
{
  global $twentyfourhour_format;
  $start_date = utf8_strftime('%A %d %B %Y', $starts);
  $start_time = utf8_strftime(hours_minutes_seconds_format(), $starts);
  $duration = $ends - $starts;
  if ($start_time == "00:00:00" && $duration == 60*60*24)
  {
    return $start_date . " - " . get_vocab("all_day");
  }
  toTimeString($duration, $dur_units);
  return $start_date . " " . $start_time . " - " . $duration . " " . $dur_units;
}

// Convert a start period and end period to a plain language description.
// This is similar but different from the way it is done in view_entry.
function describe_period_span($starts, $ends)
{
  list( $start_period, $start_date) =  period_date_string($starts);
  list( , $end_date) =  period_date_string($ends, -1);
  $duration = $ends - $starts;
  toPeriodString($start_period, $duration, $dur_units);
  return $start_date . " - " . $duration . " " . $dur_units;
}

// this is based on describe_span but it displays the start and end
// date/time of an entry
function start_to_end($starts, $ends)
{
  global $twentyfourhour_format;
  $start_date = utf8_strftime('%A %d %B %Y', $starts);
  $start_time = utf8_strftime(hours_minutes_seconds_format(), $starts);

  $end_date = utf8_strftime('%A %d %B %Y', $ends);
  $end_time = utf8_strftime(hours_minutes_seconds_format(), $ends);
  return $start_date . " " . $start_time . " - " . $end_date . " " . $end_time;
}


// this is based on describe_period_span but it displays the start and end
// date/period of an entry
function start_to_end_period($starts, $ends)
{
  list( , $start_date) =  period_date_string($starts);
  list( , $end_date) =  period_date_string($ends, -1);
  return $start_date . " - " . $end_date;
}

// Escape a string for either HTML or CSV output
function escape($string)
{
  global $output_as_csv;
  if ($output_as_csv)
  {
    $string = str_replace('"', '""', $string);
  }
  else
  {
    $string = mrbs_nl2br(htmlspecialchars($string));
  }
  return $string;
}

// Add $value to a CSV row, escaping the value as well
// Return the new row
function csv_row_add_value($row, $value)
{
  global $csv_col_sep;
  
  // if it's not the first entry add a column separator
  if (!empty($row))
  {
    $row .= $csv_col_sep;
  }
  $row .= '"';
  $row .= escape($value);
  $row .= '"';
  return $row;
}

// Output the first row (header row) for CSV reports
function csv_report_header($display)
{
  global $csv_row_sep;
  global $custom_fields, $tbl_entry;
  global $approval_somewhere, $confirmation_somewhere;
  
  // Build an array of values to go into the header row
  $values = array();
  $values[] = get_vocab("area") . ' - ' . get_vocab("room");
  $values[] = get_vocab("namebooker"); 
  if ($display == "d")
  {
    $values[] = get_vocab("start_date") . ' - ' . get_vocab("duration");
  }
  else
  {
    $values[] = get_vocab("start_date") . ' - ' . get_vocab("end_date");
  }
  $values[] = get_vocab("fulldescription_short");
  $values[] = get_vocab("type"); 
  $values[] = get_vocab("createdby");
  if ($confirmation_somewhere)
  {
    $values[] = get_vocab("confirmation_status");
  }
  if ($approval_somewhere)
  {
    $values[] = get_vocab("approval_status");
  }
  // Now do the custom fields
  foreach ($custom_fields as $key => $value)
  {
    $values[] = get_loc_field_name($tbl_entry, $key);
  }
  $values[] = get_vocab("lastupdate");
  
  // Remove any HTML entities from the values
  $n_values = count($values);
  $charset = get_charset();
  // Find out what the non-breaking space is in this character set
  $nbsp = mrbs_entity_decode('&nbsp;', ENT_NOQUOTES, $charset);
  for ($i=0; $i < $n_values; $i++)
  {
    $values[$i] = mrbs_entity_decode($values[$i], ENT_NOQUOTES, $charset);
    // Trim non-breaking spaces from the string
    $values[$i] = trim($values[$i], $nbsp);
    // And do an ordinary trim
    $values[$i] = trim($values[$i]);
  }
  
  // Now turn the array of values into a CSV row
  $line = "";  // initialise the row
  foreach ($values as $v)
  {
    $line = csv_row_add_value($line, $v);
  }
  $line .= $csv_row_sep;  // terminate the row
  
  // Output the row
  echo $line;
}

// Report on one entry. See below for columns in $row[].
// $last_area_room remembers the current area/room.
// $last_date remembers the current date.
function reporton(&$row, &$last_area_room, &$last_date, $sortby, $display)
{
  global $typel;
  global $enable_periods;
  global $output_as_csv;
  global $csv_row_sep;
  global $custom_fields, $field_natures, $field_lengths, $tbl_entry;
  global $approval_somewhere, $confirmation_somewhere;
  
  // Initialise the line for CSV reports
  $line = "";
  
  // Display Area/Room, but only when it changes:
  $area_room = $row['area_name'] . " - " . $row['room_name'];
  $date = utf8_strftime("%d-%b-%Y", $row['start_time']);
  
  // entries to be sorted on area/room
  echo $output_as_csv ? '' : "<div class=\"div_report\">\n";
  if( $sortby == "r" )
  {
    if ($area_room != $last_area_room)
    {
      echo $output_as_csv ? '' : "<h2>". get_vocab("room") . ": " . escape($area_room) . "</h2>\n";
    }
    if ($date != $last_date || $area_room != $last_area_room)
    {
      echo $output_as_csv ? '' : "<h3>". get_vocab("date") . ": " . $date . "</h3>\n";
      $last_date = $date;
    }
    // remember current area/room that is being processed.
    // this is done here as the if statement above needs the old
    // values
    if ($area_room != $last_area_room)
    {
      $last_area_room = $area_room;
    }
  }
  else
    // entries to be sorted on start date
  {
    if ($date != $last_date)
    {
      echo $output_as_csv ? '' : "<h2>". get_vocab("date") . ": " . $date . "</h2>\n";
    }
    if ($area_room != $last_area_room  || $date != $last_date)
    {
      echo $output_as_csv ? '' : "<h3>". get_vocab("room") . ": " . escape($area_room) . "</h3>\n";
      $last_area_room = $area_room;
    }
    // remember current date that is being processed.
    // this is done here as the if statement above needs the old
    // values
    if ($date != $last_date)
    {
      $last_date = $date;
    }
  }
  
  if ($output_as_csv)
  {
    $line = csv_row_add_value($line, $area_room); // for the CSV report put the area-room name on every line
    $line = csv_row_add_value($line, $row['name']);
  }
  else
  {
    echo "<div class=\"report_entry_title\">\n";
  
    echo "<div class=\"report_entry_name\">\n";
    // Brief Description (title), linked to view_entry:
    echo "<a href=\"view_entry.php?id=".$row['id']."\">" . htmlspecialchars($row['name']) . "</a>\n";
    echo "</div>\n";
  }
  echo $output_as_csv ? '' : "<div class=\"report_entry_when\">\n";

  // what do you want to display duration or end date/time
  if( $display == "d" )
  {
    // Start date/time and duration:
    $when = (empty($enable_periods) ? 
             describe_span($row['start_time'], $row['end_time']) : 
             describe_period_span($row['start_time'], $row['end_time']));
  }
  else
  {
    // Start date/time and End date/time:
    $when = (empty($enable_periods) ? 
             start_to_end($row['start_time'], $row['end_time']) :
             start_to_end_period($row['start_time'], $row['end_time']));
  }
  if ($output_as_csv)
  {
    $line = csv_row_add_value($line, $when);
  }
  else
  {
    echo "$when\n";
    echo "</div>\n";
    echo "</div>\n";
    
    echo "<table>\n";
    echo "<colgroup>\n";
    echo "<col class=\"col1\">\n";
    echo "<col class=\"col2\">\n";
    echo "</colgroup>\n";
  }

  // Description:
  if ($output_as_csv)
  {
    $line = csv_row_add_value($line, $row['description']);
  }
  else
  {
    echo "<tr>\n";
    echo "<td>" . get_vocab("description") . ":</td>\n";
    echo "<td>" . escape($row['description']) . "</td>\n";
    echo "</tr>\n";
  }

  // Entry Type:
  $et = empty($typel[$row['type']]) ? "?".$row['type']."?" : $typel[$row['type']];
  if ($output_as_csv)
  {
    $line = csv_row_add_value($line, $et);
  }
  else
  {
    echo "<tr>\n";
    echo "<td>" . get_vocab("type") . ":</td>\n";
    echo "<td>" . escape($et) . "</td>\n";
    echo "</tr>\n";
  }

  // Created by:
  if ($output_as_csv)
  {
    $line = csv_row_add_value($line, $row['create_by']);
  }
  else
  {
    echo "<tr>\n";
    echo "<td>" . get_vocab("createdby") . ":</td>\n";
    echo "<td>" . escape($row['create_by']) . "</td>\n";
    echo "</tr>\n";
  }
  
  // Confirmation status
  if ($confirmation_somewhere)
  {
    // Translate the status field bit into meaningful text
    if ($row['confirmation_enabled'])
    {
      $confirmation_status = ($row['status'] & STATUS_TENTATIVE) ? get_vocab("tentative") : get_vocab("confirmed");
    }
    else
    {
      $confirmation_status = '';
    }
    // Now output the text
    if ($output_as_csv)
    {
      $line = csv_row_add_value($line, $confirmation_status);
    }
    else
    {
      echo "<tr>\n";
      echo "<td>" . get_vocab("confirmation_status") . ":</td>\n";
      echo "<td>" . escape($confirmation_status) . "</td>\n";
      echo "</tr>\n";
    }
  }
  
  // Approval status
  if ($approval_somewhere)
  {
    // Translate the status field bit into meaningful text
    if ($row['approval_enabled'])
    {
      $approval_status = ($row['status'] & STATUS_AWAITING_APPROVAL) ? get_vocab("awaiting_approval") : get_vocab("approved");
    }
    else
    {
      $approval_status = '';
    }
    // Now output the text
    if ($output_as_csv)
    {
      $line = csv_row_add_value($line, $approval_status);
    }
    else
    {
      echo "<tr>\n";
      echo "<td>" . get_vocab("approval_status") . ":</td>\n";
      echo "<td>" . escape($approval_status) . "</td>\n";
      echo "</tr>\n";
    }
  }
  
  // Now do any custom fields
  foreach ($custom_fields as $key => $value)
  {
    // Output a yes/no if it's a boolean or integer <= 2 bytes (which we will
    // assume are intended to be booleans)
    if (($field_natures[$key] == 'boolean') || 
        (($field_natures[$key] == 'integer') && isset($field_lengths[$key]) && ($field_lengths[$key] <= 2)) )
    {
      $output = empty($row[$key]) ? get_vocab("no") : get_vocab("yes");
    }
    // Otherwise output a string
    else
    {
      $output = (isset($row[$key])) ? $row[$key] : ''; 
    }
    
    if ($output_as_csv)
    {
      $line = csv_row_add_value($line, $output);
    }
    else
    {
      echo "<tr>\n";
      echo "<td>" . get_loc_field_name($tbl_entry, $key) . ":</td>\n";
      echo "<td>" . escape($output) . "</td>\n";
      echo "</tr>\n";
    }
  }

  // Last updated:
  if ($output_as_csv)
  {
    $line = csv_row_add_value($line, date_time_string($row['last_updated']));
  }
  else
  {
    echo "<tr>\n";
    echo "<td>" . get_vocab("lastupdate") . ":</td>\n";
    echo "<td>" . date_time_string($row['last_updated']) . "</td>\n";
    echo "</tr>\n";
  }

  if ($output_as_csv)
  {
    // terminate and output the line
    $line .= $csv_row_sep;
    echo $line;
  }
  else
  {
    echo "</table>\n";
    echo "</div>\n\n";
  }
}

// Collect summary statistics on one entry. See below for columns in $row[].
// $sumby selects grouping on brief description (d) or created by (c).
// This also builds hash tables of all unique names and rooms. When sorted,
// these will become the column and row headers of the summary table.
function accumulate(&$row, &$count, &$hours, $report_start, $report_end,
                    &$room_hash, &$name_hash)
{
  global $sumby;
  global $output_as_csv;
  // Use brief description or created by as the name:
  $name = escape($row[($sumby == "d" ? 'name' : 'create_by')]);
  // Area and room separated by break (if not CSV):
  $room = escape($row['area_name']);
  $room .= ($output_as_csv) ? '/' : "<br>";
  $room .= escape($row['room_name']);
  // Accumulate the number of bookings for this room and name:
  @$count[$room][$name]++;
  // Accumulate hours used, clipped to report range dates:
  @$hours[$room][$name] += (min((int)$row['end_time'], $report_end)
                            - max((int)$row['start_time'], $report_start)) / 3600.0;
  $room_hash[$room] = 1;
  $name_hash[$name] = 1;
}

function accumulate_periods(&$row, &$count, &$hours, $report_start,
                            $report_end, &$room_hash, &$name_hash)
{
  global $sumby;
  global $periods;
  global $output_as_csv;
  
  $max_periods = count($periods);

  // Use brief description or created by as the name:
  $name = escape($row[($sumby == "d" ? 'name' : 'create_by')]);
  // Area and room separated by break (if not CSV):
  $room = escape($row['area_name']);
  $room .= ($output_as_csv) ? '/' : "<br>";
  $room .= escape($row['room_name']);
  // Accumulate the number of bookings for this room and name:
  @$count[$room][$name]++;
  // Accumulate hours used, clipped to report range dates:
  $dur = (min((int)$row['end_time'], $report_end) - max((int)$row['start_time'], $report_start))/60;
  @$hours[$room][$name] += ($dur % $max_periods) + floor( $dur/(24*60) ) * $max_periods;
  $room_hash[$room] = 1;
  $name_hash[$name] = 1;
}

// Output a table cell containing a count (integer) and hours (float):
// (actually output two cells, so that we can style the counts and hours)
function cell($count, $hours)
{
  global $output_as_csv;
  global $csv_col_sep;
  
  echo ($output_as_csv) ? $csv_col_sep . '"'  : "<td class=\"count\">(";
  echo $count;
  echo ($output_as_csv) ? '"' . $csv_col_sep . '"' : ")</td><td>";
  echo sprintf("%.2f", $hours);
  echo ($output_as_csv) ? '"'   : "</td>\n";
}

// Output the summary table (a "cross-tab report"). $count and $hours are
// 2-dimensional sparse arrays indexed by [area/room][name].
// $room_hash & $name_hash are arrays with indexes naming unique rooms and names.
function do_summary(&$count, &$hours, &$room_hash, &$name_hash)
{
  global $enable_periods;
  global $output_as_csv;
  global $csv_row_sep, $csv_col_sep;
        
  // Make a sorted array of area/rooms, and of names, to use for column
  // and row indexes. Use the rooms and names hashes built by accumulate().
  // At PHP4 we could use array_keys().
  reset($room_hash);
  while (list($room_key) = each($room_hash))
  {
    $rooms[] = $room_key;
  }
  ksort($rooms);
  reset($name_hash);
  while (list($name_key) = each($name_hash))
  {
    $names[] = $name_key;
  }
  ksort($names);
  $n_rooms = sizeof($rooms);
  $n_names = sizeof($names);

  if (!$output_as_csv)
  {
    echo "<div id=\"div_summary\">\n";
    echo "<h1>" . (empty($enable_periods) ? get_vocab("summary_header") : get_vocab("summary_header_per")). "</h1>\n";
    echo "<table>\n";
  
    echo "<thead>\n";
    echo "<tr>\n";
  }
  echo ($output_as_csv) ? '""' . $csv_col_sep : "<th>&nbsp;</th>\n";

  for ($c = 0; $c < $n_rooms; $c++)
  {
    echo ($output_as_csv) ? '"'  : "<th colspan=\"2\">";
    if ($output_as_csv)
    {
      echo $rooms[$c] . ' - ' . get_vocab("entries");
      echo '"' . $csv_col_sep . '"';
      echo $rooms[$c] . ' - ';
      echo ($enable_periods) ? get_vocab("periods") : get_vocab("hours");
    }
    else
    {
      echo $rooms[$c];
    }
    echo ($output_as_csv) ? '"' . $csv_col_sep : "</th>\n";
    $col_count_total[$c] = 0;
    $col_hours_total[$c] = 0.0;
  }
  echo ($output_as_csv) ? '"'  : "<th colspan=\"2\"><br>";
  if ($output_as_csv)
  {
    echo get_vocab("total") . ' - ' . get_vocab("entries");
    echo '"' . $csv_col_sep . '"';
    echo get_vocab("total") . ' - ';
    echo ($enable_periods) ? get_vocab("periods") : get_vocab("hours");
  }
  else
  {
    echo get_vocab("total");
  }
  echo ($output_as_csv) ? '"'  : "</th>\n";
  echo ($output_as_csv) ? $csv_row_sep : "</tr>\n";
  $grand_count_total = 0;
  $grand_hours_total = 0;
  echo ($output_as_csv) ? ''   : "</thead>\n";
  
  echo ($output_as_csv) ? ''   : "<tbody>\n";
  for ($r = 0; $r < $n_names; $r++)
  {
    $row_count_total = 0;
    $row_hours_total = 0.0;
    $name = $names[$r];
    echo ($output_as_csv) ? '"'  : "<tr><td>";
    echo $name;
    echo ($output_as_csv) ? '"' : "</td>\n";
    for ($c = 0; $c < $n_rooms; $c++)
    {
      $room = $rooms[$c];
      if (isset($count[$room][$name]))
      {
        $count_val = $count[$room][$name];
        $hours_val = $hours[$room][$name];
        cell($count_val, $hours_val);
        $row_count_total += $count_val;
        $row_hours_total += $hours_val;
        $col_count_total[$c] += $count_val;
        $col_hours_total[$c] += $hours_val;
      }
      else
      {
        if ($output_as_csv)
        {
          echo $csv_col_sep . $csv_col_sep;
        }
        else
        {
          echo "<td class=\"count\">&nbsp;</td><td>&nbsp;</td>\n";
        }
      }
    }
    cell($row_count_total, $row_hours_total);
    echo ($output_as_csv) ? $csv_row_sep : "</tr>\n";
    $grand_count_total += $row_count_total;
    $grand_hours_total += $row_hours_total;
  }
  echo ($output_as_csv) ? '"'  : "<tr><td>";
  echo get_vocab("total");
  echo ($output_as_csv) ? '"' : "</td>\n";
  for ($c = 0; $c < $n_rooms; $c++)
  {
    cell($col_count_total[$c], $col_hours_total[$c]);
  }
  cell($grand_count_total, $grand_hours_total);
  echo ($output_as_csv) ? $csv_row_sep : "</tr>\n";
  if (!$output_as_csv)
  {
    echo "</tbody></table>\n";
    echo "</div>\n";
  }
}

// Get non-standard form variables
$From_day = get_form_var('From_day', 'int');
$From_month = get_form_var('From_month', 'int');
$From_year = get_form_var('From_year', 'int');
$To_day = get_form_var('To_day', 'int');
$To_month = get_form_var('To_month', 'int');
$To_year = get_form_var('To_year', 'int');
$creatormatch = get_form_var('creatormatch', 'string');
$areamatch = get_form_var('areamatch', 'string');
$roommatch = get_form_var('roommatch', 'string');
$namematch = get_form_var('namematch', 'string');
$descrmatch = get_form_var('descrmatch', 'string');
$summarize = get_form_var('summarize', 'int');
$typematch = get_form_var('typematch', 'array');
$sortby = get_form_var('sortby', 'string');
$display = get_form_var('display', 'string');
$sumby = get_form_var('sumby', 'string');
$match_approved = get_form_var('match_approved', 'string');
$match_confirmed = get_form_var('match_confirmed', 'string');
$match_private = get_form_var('match_private', 'string');


// Check the user is authorised for this page
checkAuthorised();

// Also need to know whether they have admin rights
$user = getUserName();
$is_admin =  (isset($user) && authGetUserLevel($user)>=2) ;

if (empty($summarize))
{
  $summarize = REPORT + OUTPUT_HTML;
}

$output_as_html = (!isset($summarize)) || ($summarize & OUTPUT_HTML);
$output_as_csv = $summarize & OUTPUT_CSV;
$output_as_ical = $summarize & OUTPUT_ICAL;

// Get information about custom fields
$fields = sql_field_info($tbl_entry);
$custom_fields = array();
$field_natures = array();
$field_lengths = array();
foreach ($fields as $field)
{
  if (!in_array($field['name'], $standard_fields['entry']))
  {
    $custom_fields[$field['name']] = '';
  }
  $field_natures[$field['name']] = $field['nature'];
  $field_lengths[$field['name']] = $field['length'];
}

// Get the custom form inputs
foreach ($custom_fields as $key => $value)
{
  $var = "match_$key";
  if (($field_natures[$key] == 'integer') && ($field_lengths[$key] > 2))
  {
    $var_type = 'int';
  }
  else
  {
    $var_type = 'string';
  }
  $$var = get_form_var($var, $var_type);
}


// print the page header
if ($output_as_csv)
{
  $filename = ($summarize & REPORT) ? $report_filename : $summary_filename;
  header("Content-Type: text/csv; charset=" . get_charset());
  header("Content-Disposition: attachment; filename=\"$filename\"");
}
elseif ($output_as_ical)
{
  require_once "functions_ical.inc";
  require_once "functions_view.inc";
  require_once "mrbs_sql.inc";
  header("Content-Type: application/ics;  charset=" . get_charset(). "; name=\"" . $mail_settings['ics_filename'] . ".ics\"");
  header("Content-Disposition: attachment; filename=\"" . $mail_settings['ics_filename'] . ".ics\"");
}
else // assumed to be $output_as_html
{
  print_header($day, $month, $year, $area, isset($room) ? $room : "");
}

if (isset($areamatch))
{
  // Resubmit - reapply parameters as defaults.
  // Make sure these are not escape-quoted:

  // Make default values when the form is reused.
  $areamatch_default = htmlspecialchars($areamatch);
  $roommatch_default = htmlspecialchars($roommatch);
  (isset($typematch)) ? $typematch_default = $typematch :
    $typematch_default = "";
  $namematch_default = htmlspecialchars($namematch);
  $descrmatch_default = htmlspecialchars($descrmatch);
  $creatormatch_default = htmlspecialchars($creatormatch);
}
else
{
  // New report - use defaults.
  $areamatch_default = "";
  $roommatch_default = "";
  $typematch_default = array();
  $namematch_default = "";
  $descrmatch_default = "";
  $creatormatch_default = "";
  $From_day = $day;
  $From_month = $month;
  $From_year = $year;
  $To_time = mktime(0, 0, 0, $month, $day + $default_report_days, $year);
  $To_day   = date("d", $To_time);
  $To_month = date("m", $To_time);
  $To_year  = date("Y", $To_time);
  $match_private = PRIVATE_BOTH;
  $match_approved = APPROVED_BOTH;
  $match_confirmed = CONFIRMED_BOTH;
}

// $sumby: d=by brief description, c=by creator.
if (empty($sumby))
{
  $sumby = "d";
}
// $sortby: r=room, s=start date/time.
if (empty($sortby))
{
  $sortby = "r";
}
// $display: d=duration, e=start date/time and end date/time.
if (empty($display))
{
  $display = "d";
}

$private_somewhere = some_area('private_enabled') || some_area('private_mandatory');
$approval_somewhere = some_area('approval_enabled');
$confirmation_somewhere = some_area('confirmation_enabled');
$times_somewhere = (sql_query1("SELECT COUNT(*) FROM $tbl_area WHERE enable_periods=0") > 0);

// Upper part: The form.
if ($output_as_html)
{
  ?>
  <div class="screenonly">
 
    <form class="form_general" method="get" action="report.php">
      <fieldset>
      <legend><?php echo get_vocab("report_on");?></legend>
      
        <fieldset>
        <legend><?php echo get_vocab("search_criteria");?></legend>
      
        <div id="div_report_start">
          <?php
          echo "<label for=\"From_datepicker\">" . get_vocab("report_start") . ":</label>\n";
          genDateSelector("From_", $From_day, $From_month, $From_year);
          ?>
        
        </div>
      
        <div id="div_report_end">
          <?php
          echo "<label for=\"To_datepicker\">" . get_vocab("report_end") . ":</label>\n";
          genDateSelector("To_", $To_day, $To_month, $To_year);
          ?>
        </div>
      
        <div id="div_areamatch">                  
          <label for="areamatch"><?php echo get_vocab("match_area");?>:</label>
          <input type="text" id="areamatch" name="areamatch" value="<?php echo $areamatch_default; ?>">
        </div>   
      
        <div id="div_roommatch">
          <label for="roommatch"><?php echo get_vocab("match_room");?>:</label>
          <input type="text" id="roommatch" name="roommatch" value="<?php echo $roommatch_default; ?>">
        </div>
      
        <div id="div_typematch">
          <label for="typematch"><?php echo get_vocab("match_type")?>:</label>
          <select id="typematch" name="typematch[]" multiple="multiple" size="5">
            <?php
            foreach ( $typel as $key => $val )
            {
              if (!empty($val) )
              {
                echo "                  <option value=\"$key\"" .
                (is_array($typematch_default) && in_array ( $key, $typematch_default ) ? " selected" : "") .
                ">$val</option>\n";
              }
            }
          ?>
          </select>
          <span><?php echo get_vocab("ctrl_click_type") ?></span>
        </div>
      
        <div id="div_namematch">     
          <label for="namematch"><?php echo get_vocab("match_entry");?>:</label>
          <input type="text" id="namematch" name="namematch" value="<?php echo $namematch_default; ?>">
        </div>   
      
        <div id="div_descrmatch">
          <label for="descrmatch"><?php echo get_vocab("match_descr");?>:</label>
          <input type="text" id="descrmatch" name="descrmatch" value="<?php echo $descrmatch_default; ?>">
        </div>
      
        <div id="div_creatormatch">
          <label for="creatormatch"><?php echo get_vocab("createdby");?>:</label>
          <input type="text" id="creatormatch" name="creatormatch" value="<?php echo $creatormatch_default; ?>">
        </div>
        
        <?php
        // Privacy status
        // Only show this part of the form if there are areas that allow private bookings
        if ($private_somewhere)
        {
          echo "<div id=\"div_privacystatus\">\n";
          echo "<label>" . get_vocab("privacy_status") . ":</label>\n";
          echo "<div class=\"group\">\n";   
          $options = array(PRIVATE_BOTH => 'both', PRIVATE_NO => 'default_public', PRIVATE_YES => 'default_private');
          foreach ($options as $option => $token)
          {
            echo "<label>";
            echo "<input class=\"radio\" type=\"radio\" name=\"match_private\" value=\"$option\"" .          
                 (($match_private == $option) ? " checked=\"checked\"" : "") .
                 ">" . get_vocab($token);
            echo "</label>\n";
          }
          echo "</div>\n";
          echo "</div>\n";
        }
        
        // Confirmation status
        // Only show this part of the form if there are areas that require approval
        if ($confirmation_somewhere)
        {
          echo "<div id=\"div_confirmationstatus\">\n";
          echo "<label>" . get_vocab("confirmation_status") . ":</label>\n";
          echo "<div class=\"group\">\n";   
          $options = array(CONFIRMED_BOTH => 'both', CONFIRMED_YES => 'confirmed', CONFIRMED_NO => 'tentative');
          foreach ($options as $option => $token)
          {
            echo "<label>";
            echo "<input class=\"radio\" type=\"radio\" name=\"match_confirmed\" value=\"$option\"" .          
                 (($match_confirmed == $option) ? " checked=\"checked\"" : "") .
                 ">" . get_vocab($token);
            echo "</label>\n";
          }
          echo "</div>\n";
          echo "</div>\n";
        }
        
        // Approval status
        // Only show this part of the form if there are areas that require approval
        if ($approval_somewhere)
        {
          echo "<div id=\"div_approvalstatus\">\n";
          echo "<label>" . get_vocab("approval_status") . ":</label>\n";
          echo "<div class=\"group\">\n";   
          $options = array(APPROVED_BOTH => 'both', APPROVED_YES => 'approved', APPROVED_NO => 'awaiting_approval');
          foreach ($options as $option => $token)
          {
            echo "<label>";
            echo "<input class=\"radio\" type=\"radio\" name=\"match_approved\" value=\"$option\"" .          
                 (($match_approved == $option) ? " checked=\"checked\"" : "") .
                 ">" . get_vocab($token);
            echo "</label>\n";
          }
          echo "</div>\n";
          echo "</div>\n";
        }
        

        // Now do the custom fields
        foreach ($custom_fields as $key => $value)
        {
          $var = "match_$key";
          echo "<div>\n";
          echo "<label for=\"$var\">" . get_loc_field_name($tbl_entry, $key) . ":</label>\n";
          // Output a checkbox if it's a boolean or integer <= 2 bytes (which we will
          // assume are intended to be booleans)
          if (($field_natures[$key] == 'boolean') || 
              (($field_natures[$key] == 'integer') && isset($field_lengths[$key]) && ($field_lengths[$key] <= 2)) )
          {
            echo "<input type=\"checkbox\" class=\"checkbox\" " .
                  "id=\"$var\" name=\"$var\" value=\"1\" " .
                  ((!empty($$var)) ? " checked=\"checked\"" : "") .
                  ">\n";
          }
          // Otherwise output a text input
          else
          {
            echo "<input type=\"text\" " .
                  "id=\"$var\" name=\"$var\" " .
                  "value=\"" . htmlspecialchars($$var) . "\"" .
                  ">\n";
          }
          echo "</div>\n";
        }
        ?>
        </fieldset>
      
        <fieldset>
        <legend><?php echo get_vocab("presentation_options");?></legend>  
        <div id="div_summarize">
          <label><?php echo get_vocab("include");?>:</label>
          <?php
          // Radio buttons to choose the value of the summarize parameter
          // Set up an array of arrays mapping the button value to the description
          // Each outer array represents a different group of buttons
          $buttons = array();
          // The HTML output buttons
          $buttons[] = array(REPORT + OUTPUT_HTML           => "report_only",
                             SUMMARY + OUTPUT_HTML          => "summary_only",
                             REPORT + SUMMARY + OUTPUT_HTML => "report_and_summary");
          // The CSV output buttons
          $buttons[] = array(REPORT + OUTPUT_CSV            => "report_as_csv",
                             SUMMARY + OUTPUT_CSV           => "summary_as_csv");
          // The iCal output button
          if ($times_somewhere) // We can't do iCalendars for periods yet
          {
            $buttons[] = array(REPORT + OUTPUT_ICAL           => "report_as_ical");
          }
          
          echo "<div class=\"group_container\">\n";
          foreach ($buttons as $button_group)
          {
            echo "<div class=\"group\">\n";
            // Output each radio button
            foreach ($button_group as $value => $token)
            {
              echo "<label>";
              echo "<input class=\"radio\" type=\"radio\" name=\"summarize\" value=\"$value\"";          
              if ($summarize == $value) echo " checked=\"checked\"";
              echo ">" . get_vocab($token);
              echo "</label>\n";
            }
            echo "</div>\n";
          }
          echo "</div>\n";
          ?>
        </div>
      
        <div id="div_sortby"> 
          <label><?php echo get_vocab("sort_rep");?>:</label>
          <div class="group">
            <label>
              <input class="radio" type="radio" name="sortby" value="r"
              <?php 
              if ($sortby=="r") echo " checked=\"checked\"";
              echo ">". get_vocab("room");?>
            </label>
            <label>
              <input class="radio" type="radio" name="sortby" value="s"
              <?php 
              if ($sortby=="s") echo " checked=\"checked\"";
              echo ">". get_vocab("sort_rep_time");?>
            </label>
          </div>
        </div>
      
        <div id="div_display">
          <label><?php echo get_vocab("rep_dsp");?>:</label>
          <div class="group">
            <label>
              <input class="radio" type="radio" name="display" value="d"
              <?php 
              if ($display=="d") echo " checked=\"checked\"";
              echo ">". get_vocab("rep_dsp_dur");?>
            </label>
            <label>
              <input class="radio" type="radio" name="display" value="e"
              <?php 
              if ($display=="e") echo " checked=\"checked\"";
              echo ">". get_vocab("rep_dsp_end");?>
            </label>
          </div>
        </div>
      
        <div id="div_sumby">
          <label><?php echo get_vocab("summarize_by");?>:</label>
          <div class="group">
            <label>
              <input class="radio" type="radio" name="sumby" value="d"
              <?php 
              if ($sumby=="d") echo " checked=\"checked\"";
              echo ">" . get_vocab("sum_by_descrip");
              ?>
            </label>
            <label>
              <input class="radio" type="radio" name="sumby" value="c"
              <?php 
              if ($sumby=="c") echo " checked=\"checked\"";
              echo ">" . get_vocab("sum_by_creator");
              ?>
            </label>
          </div>
        </div>
        </fieldset>
      
        <div id="report_submit">
          <input class="submit" type="submit" value="<?php echo get_vocab("submitquery") ?>">
        </div>
        
      
      </fieldset>
    </form>
  </div>
  <?php
}

// Lower part: Results, if called with parameters:
if (isset($areamatch))
{
  // Start and end times are also used to clip the times for summary info.
  $report_start = mktime(0, 0, 0, $From_month+0, $From_day+0, $From_year+0);
  $report_end = mktime(0, 0, 0, $To_month+0, $To_day+1, $To_year+0);
  
  // Construct the SQL query
  $sql = "SELECT E.*, "
       .  sql_syntax_timestamp_to_unix("E.timestamp") . " AS last_updated, "
       . "A.area_name, R.room_name, "
       . "A.approval_enabled, A.confirmation_enabled";
  if ($output_as_ical)
  {
    // If we're producing an iCalendar then we'll also need the repeat
    // information in order to construct the recurrence rule
    $sql .= ", T.rep_type, T.end_date, T.rep_opt, T.rep_num_weeks";
  }
  $sql .= " FROM $tbl_area A, $tbl_room R, $tbl_entry E";
  if ($output_as_ical)
  {
    // We do a LEFT JOIN because we still want the single entries, ie the ones
    // that won't have a match in the repeat table
    $sql .= " LEFT JOIN $tbl_repeat T ON E.repeat_id=T.id";
  }
  $sql .= " WHERE E.room_id=R.id AND R.area_id=A.id"
        . " AND E.start_time < $report_end AND E.end_time > $report_start";
  if ($output_as_ical)
  {
    // We can't export periods in an iCalendar yet
    $sql .= " AND A.enable_periods=0";
  }
  
  if (!empty($areamatch))
  {
    // sql_syntax_caseless_contains() does the SQL escaping
    $sql .= " AND" .  sql_syntax_caseless_contains("A.area_name", $areamatch);
  }
  if (!empty($roommatch))
  {
    // sql_syntax_caseless_contains() does the SQL escaping
    $sql .= " AND" .  sql_syntax_caseless_contains("R.room_name", $roommatch);
  }
  if (!empty($typematch))
  {
    $sql .= " AND ";
    if ( count( $typematch ) > 1 )
    {
      $or_array = array();
      foreach ( $typematch as $type )
      {
        $or_array[] = "E.type = '".addslashes($type)."'";
      }
      $sql .= "(". implode( " OR ", $or_array ) .")";
    }
    else
    {
      $sql .= "E.type = '".addslashes($typematch[0])."'";
    }
  }
  if (!empty($namematch))
  {
    // sql_syntax_caseless_contains() does the SQL escaping
    $sql .= " AND" .  sql_syntax_caseless_contains("E.name", $namematch);
  }
  if (!empty($descrmatch))
  {
    // sql_syntax_caseless_contains() does the SQL escaping
    $sql .= " AND" .  sql_syntax_caseless_contains("E.description", $descrmatch);
  }
  if (!empty($creatormatch))
  {
    // sql_syntax_caseless_contains() does the SQL escaping
    $sql .= " AND" .  sql_syntax_caseless_contains("E.create_by", $creatormatch);
  }
  
  // (In the next three cases, you will get the empty string if that part
  // of the form was not displayed - which means that you need all bookings)
  // Note that although you can say eg "status&STATUS_PRIVATE" in MySQL, you get
  // an error in PostgreSQL as the expression is of the wrong type.
  
  // Match the privacy status
  if (($match_private != PRIVATE_BOTH) && ($match_private != ''))
  {
    $sql .= " AND ";
    $sql .= "(status&" . STATUS_PRIVATE;
    $sql .= ($match_private) ? "!=0)" : "=0)";  // Note that private works the other way round to the next two
  }
  // Match the confirmation status
  if (($match_confirmed != CONFIRMED_BOTH) && ($match_confirmed != ''))
  {
    $sql .= " AND ";
    $sql .= "(status&" . STATUS_TENTATIVE;
    $sql .= ($match_confirmed) ? "=0)" : "!=0)";
  }
  // Match the approval status
  if (($match_approved != APPROVED_BOTH) && ($match_approved != ''))
  {
    $sql .= " AND ";
    $sql .= "(status&" . STATUS_AWAITING_APPROVAL;
    $sql .= ($match_approved) ? "=0)" : "!=0)";
  }
  
  // Now do the custom fields
  foreach ($custom_fields as $key => $value)
  {
    $var = "match_$key";
    // Booleans (or integers <= 2 bytes which we assume are intended to be booleans)
    if (($field_natures[$key] == 'boolean') || 
       (($field_natures[$key] == 'integer') && isset($field_lengths[$key]) && ($field_lengths[$key] <= 2)) )
    {
      if (!empty($$var))
      {
        $sql .= " AND E.$key!=0";
      }
    }
    // Integers
    elseif (($field_natures[$key] == 'integer') && isset($field_lengths[$key]) && ($field_lengths[$key] > 2))
    {
      if (isset($$var) && $$var !== '')  // get_form_var() returns an empty string if no input
      {
        $sql .= " AND E.$key=" . $$var;
      }
    }
    // Strings
    else
    {
      if (!empty($$var))
      {
        $sql .= " AND" . sql_syntax_caseless_contains("E.$key", $$var);
      }
    }
  }

  // If we're not an admin (they are allowed to see everything), then we need
  // to make sure we respect the privacy settings.  (We rely on the privacy fields
  // in the area table being not NULL.   If they are by some chance NULL, then no
  // entries will be found, which is at least safe from the privacy viewpoint)
  if (!$is_admin)
  {
    if (isset($user))
    {
      // if the user is logged in they can see:
      //   - all bookings, if private_override is set to 'public'
      //   - their own bookings, and others' public bookings if private_override is set to 'none'
      //   - just their own bookings, if private_override is set to 'private'
      $sql .= " AND ((A.private_override='public') OR
                     (A.private_override='none' AND ((E.status&" . STATUS_PRIVATE . "=0) OR E.create_by = '" . addslashes($user) . "')) OR
                     (A.private_override='private' AND E.create_by = '" . addslashes($user) . "'))";                
    }
    else
    {
      // if the user is not logged in they can see:
      //   - all bookings, if private_override is set to 'public'
      //   - public bookings if private_override is set to 'none'
      $sql .= " AND ((A.private_override='public') OR
                     (A.private_override='none' AND (E.status&" . STATUS_PRIVATE . "=0)))";
    }
  }
  
  if ($summarize & OUTPUT_ICAL)
  {
    // If we're producing an iCalendar then we'll want the entries ordered by
    // repeat_id and then recurrence_id
    $sql .= " ORDER BY repeat_id, ical_recur_id";
  }
  elseif ($sortby == "r")
  {
    // Order by Area, Room, Start date/time
    $sql .= " ORDER BY area_name, sort_key, start_time";
  }
  else
  {
    // Order by Start date/time, Area, Room
    $sql .= " ORDER BY start_time, area_name, sort_key";
  }

  // echo "<p>DEBUG: SQL: <tt> $sql </tt></p>\n";

  $res = sql_query($sql);
  if (! $res)
  {
    fatal_error(0, sql_error());
  }
  $nmatch = sql_count($res);
  if ($nmatch == 0)
  {
    echo "<p class=\"report_entries\">" . get_vocab("nothing_found") . "</p>\n";
    sql_free($res);
  }
  else
  {
    $last_area_room = "";
    $last_date = "";
    if ($output_as_html)
    {
      echo "<p class=\"report_entries\">" . $nmatch . " "
      . ($nmatch == 1 ? get_vocab("entry_found") : get_vocab("entries_found"))
      .  "</p>\n";
    }
    
    // Output the header row for CSV reports
    if ($output_as_csv && ($summarize & REPORT))
    {
      csv_report_header($display);
    }
    
    if ($output_as_ical)
    {
      // If we're producing an iCalendar then initialize an array to hold the events
      // and a variable to keep track of the last repeat id we've seen
      $ical_events = array();
      $last_repeat_id = 0;
    }

    for ($i = 0; ($row = sql_row_keyed($res, $i)); $i++)
    {
      if ($summarize & REPORT)
      {
        if ($output_as_ical)
        {
          $text_body = array();
          $html_body = array();
          // If this is an individual entry, then construct an event
          if ($row['repeat_id'] == 0)
          {
            $text_body['content'] = create_details_body($row, FALSE);
            $html_body['content'] = create_details_body($row, TRUE);
            $ical_events[] = create_ical_event("REQUEST", $row, $text_body, $html_body, NULL, FALSE);
          }
          // Otherwise it's a series
          else
          {
            // if it's a series that we haven't seen yet, then construct an event
            if ($row['repeat_id'] != $last_repeat_id)
            {
              // Unless is the very first series, check to see whether we got
              // all the entries we would have expected in the last series and
              // issue cancellations for those that are missing
              if (isset($actual_entries))
              {
                $missing_entries = array_diff($expected_entries, $actual_entries);
                foreach ($missing_entries as $missing_entry)
                {
                  $duration = $start_row['end_time'] - $start_row['start_time'];
                  $start_row['start_time'] = $missing_entry;
                  $start_row['end_time'] = $start_row['start_time'] + $duration;
                  $start_row['ical_recur_id'] = gmdate(RFC5545_FORMAT . '\Z', $missing_entry);
                  $ical_events[] = create_ical_event("CANCEL", $start_row, NULL, NULL, NULL, FALSE);
                }
              }
              // Initialise for the new series
              $last_repeat_id = $row['repeat_id'];
              unset($replace_index);
              // We need to set the repeat start and end dates because we've only been
              // asked to export dates in the report range.  The end date will be the earlier
              // of the series end date and the report end date.  The start date of the series
              // will be the recurrence-id of the first entry in the series, which is this one
              // thanks to the SQL query which ordered the entries by recurrence-id.
              $start_row = $row;  // Make a copy of the data because we are going to tweak it.
              $start_row['end_date'] = min($report_end, $start_row['end_date']);
              $duration = $start_row['end_time'] - $start_row['start_time'];
              $start_row['start_time'] = strtotime($row['ical_recur_id']);
              $start_row['end_time'] = $start_row['start_time'] + $duration;
              // However, if this is a series member that has been changed, then we 
              // cannot trust the rest of the data (eg the description).   We will
              // use this data for now in case we don't get anything better, but we
              // will make a note that we really need an unchanged member of the series, 
              // which will have the correct data for the series which we can use to
              // replace this event.   (Of course, if we don't get an unchanged member
              // then it doesn't matter because all the original members will have been
              // changed and so there's no longer any need for the original data.)
              if ($row['entry_type'] == ENTRY_RPT_CHANGED)
              {
                // Record the index number of the event that needs to be replaced.
                // As we have not yet added that event to the array, it will be
                // the current length of the array.
                $replace_index = count($ical_events);
              }
              // Construct an array of the entries we'd expect to see in this series so that
              // we can check whether any are missing and if so set their status to cancelled.
              // (We use PHP_INT_MAX rather than $max_rep_entrys because $max_rep_entrys may
              // have changed since the series was created.)
              $expected_entries = mrbsGetRepeatEntryList($start_row['start_time'], 
                                                         $start_row['end_date'],
                                                         $start_row['rep_type'],
                                                         $start_row['rep_opt'],
                                                         PHP_INT_MAX,
                                                         $start_row['rep_num_weeks']);
              // And keep an array of all the entries we actually see
              $actual_entries = array();
              // Create the series event
              $text_body['content'] = create_details_body($start_row, FALSE);
              $html_body['content'] = create_details_body($start_row, TRUE);
              $ical_events[] = create_ical_event("REQUEST", $start_row, $text_body, $html_body, NULL, TRUE);
            }
            // Add this entry to the array of ones we've seen
            $actual_entries[] = strtotime($row['ical_recur_id']);
            // And if it's a series member that has been altered
            if ($row['entry_type'] == ENTRY_RPT_CHANGED)
            {
              $text_body['content'] = create_details_body($row, FALSE);
              $html_body['content'] = create_details_body($row, TRUE);
              $ical_events[] = create_ical_event("REQUEST", $row, $text_body, $html_body, NULL, FALSE);
            }
            // Otherwise it must be an original member, in which case check
            // to see if we were looking out for one
            elseif (isset($replace_index))
            {
              // Use this row to define the sequence as it has got all the original
              // data, except that we need to change the start and end times, keeping
              // the original duration.   We get the start time from the recurrence
              // id of the first member of the series, which we saved earlier on.
              $duration = $row['end_time'] - $row['start_time'];
              $row['start_time'] = $start_row['start_time'];
              $row['end_time'] = $row['start_time'] + $duration;
              $row['end_date'] = min($report_end, $row['end_date']);
              $text_body['content'] = create_details_body($row, FALSE);
              $html_body['content'] = create_details_body($row, TRUE);
              $ical_events[$replace_index] = create_ical_event("REQUEST", $row, $text_body, $html_body, NULL, TRUE);
              // Clear the $replace_index now that we've found an original entry
              unset ($replace_index);
            }
          }
        }
        else
        {
          reporton($row, $last_area_room, $last_date, $sortby, $display);
        }
      }

      if ($summarize & SUMMARY)
      {
        (empty($enable_periods) ?
         accumulate($row, $count, $hours, $report_start, $report_end,
                    $room_hash, $name_hash) :
         accumulate_periods($row, $count, $hours, $report_start, $report_end,
                            $room_hash, $name_hash)
          );
      }
    }
    
    if ($output_as_ical)
    {
      // We've got to the end of the rows, so check to see whether there were
      // any entries missing from the very last series, if there was one, and
      // issue cancellations for the missing entries
      if (isset($actual_entries))
      {
        $missing_entries = array_diff($expected_entries, $actual_entries);
        foreach ($missing_entries as $missing_entry)
        {
          $duration = $start_row['end_time'] - $start_row['start_time'];
          $start_row['start_time'] = $missing_entry;
          $start_row['end_time'] = $start_row['start_time'] + $duration;
          $start_row['ical_recur_id'] = gmdate(RFC5545_FORMAT . '\Z', $missing_entry);
          $ical_events[] = create_ical_event("CANCEL", $start_row, NULL, NULL, NULL, FALSE);
        }
      }
      // Build the iCalendar from the array of events and output it
      $icalendar = create_icalendar("REQUEST", $ical_events);
      echo $icalendar;
      exit;
    }
    
    if ($summarize & SUMMARY)
    {
      do_summary($count, $hours, $room_hash, $name_hash);
    }
  }
}

if ($output_as_html)
{
  require_once "trailer.inc";
}
?>
