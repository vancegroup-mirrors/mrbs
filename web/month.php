<?php
# $Id$

# mrbs/month.php - Month-at-a-time view

include "config.inc";
include "functions.inc";
include "$dbsys.inc";
include "mincals.inc";

# 3-value compare: Returns result of compare as "< " "= " or "> ".
function cmp3($a, $b)
{
	if ($a < $b) return "< ";
	if ($a == $b) return "= ";
	return "> ";
}

# Default parameters:
if (empty($debug_flag)) $debug_flag = 0;
if (empty($month) || empty($year) || !checkdate($month, 1, $year))
{
	$month = date("m");
	$year  = date("Y");
}
$day = 1;
# print the page header
print_header($day, $month, $year, $area);

if (empty($area))
	$area = get_default_area();
if (empty($room))
	$room = sql_query1("select min(id) from mrbs_room where area_id=$area");
# Note $room will be -1 if there are no rooms; this is checked for below.

# Month view start time. This ignores morningstarts/eveningends because it
# doesn't make sense to not show all entries for the day, and it messes
# things up when entries cross midnight.
$month_start = mktime(0, 0, 0, $month, 1, $year);

# What column the month starts in: 0 means $weekstarts weekday.
$weekday_start = (date("w", $month_start) - $weekstarts + 7) % 7;

$days_in_month = date("t", $month_start);

$month_end = mktime(23, 59, 59, $month, $days_in_month, $year);

# Table with areas, rooms, minicals.
echo "<table width=\"100%\"><tr>";
$this_area_name = "";
$this_room_name = "";

# Show all areas
echo "<td width=\"30%\"><u>$lang[areas]</u><br>";
$sql = "select id, area_name from mrbs_area order by area_name";
$res = sql_query($sql);
if ($res) for ($i = 0; ($row = sql_row($res, $i)); $i++)
{
	echo "<a href=\"month.php?year=$year&month=$month&area=$row[0]\">";
	if ($row[0] == $area)
	{
		$this_area_name = htmlspecialchars($row[1]);
		echo "<font color=red>$this_area_name</font></a><br>\n";
	}
	else echo htmlspecialchars($row[1]) . "</a><br>\n";
}
echo "</td>\n";

# Show all rooms in the current area:
echo "<td width=\"30%\"><u>$lang[room]</u><br>";
$sql = "select id, room_name from mrbs_room where area_id=$area order by room_name";
$res = sql_query($sql);
if ($res) for ($i = 0; ($row = sql_row($res, $i)); $i++)
{
	echo "<a href=\"month.php?year=$year&month=$month&area=$area&room=$row[0]\">";
	if ($row[0] == $room)
	{
		$this_room_name = htmlspecialchars($row[1]);
		echo "<font color=red>$this_room_name</font></a><br>\n";
	}
	else echo htmlspecialchars($row[1]) . "</a><br>\n";
}
echo "</td>\n";

#Draw the three month calendars - Note they link to day view.
minicals($year, $month, $day, $area);
echo "</tr></table>\n";

# Don't continue if this area has no rooms:
if ($room <= 0)
{
	echo "<h1>$lang[no_rooms_for_area]</h1>";
	include "trailer.inc";
	exit;
}

# Show Month, Year, Area, Room header:
echo "<h2 align=center>" . strftime("%B %Y", $month_start)
  . " - $this_area_name - $this_room_name</h2>\n";

# Show Go to month before and after links
#y? are year and month of the previous month.
#t? are year and month of the next month.

$i= mktime(0,0,0,$month-1,1,$year);
$yy = date("Y",$i);
$ym = date("n",$i);

$i= mktime(0,0,0,$month+1,1,$year);
$ty = date("Y",$i);
$tm = date("n",$i);
echo "<table width=\"100%\"><tr><td>
  <a href=\"month.php?year=$yy&month=$ym&area=$area&room=$room\">
  &lt;&lt; $lang[monthbefore]</a></td>
  <td align=center><a href=\"month.php?area=$area&room=$room\">$lang[gotothismonth]</a></td>
  <td align=right><a href=\"month.php?year=$ty&month=$tm&area=$area&room=$room\">
  $lang[monthafter] &gt;&gt;</a></td></tr></table>";

if ($debug_flag)
	echo "<p>DEBUG: month=$month year=$year start=$weekday_start range=$month_start:$month_end\n";

# Used below: localized "all day" text but with non-breaking spaces:
$all_day = ereg_replace(" ", "&nbsp;", $lang["all_day"]);

#Get all meetings for this month in the room that we care about
# row[0] = Start time
# row[1] = End time
# row[2] = Entry ID
$sql = "SELECT start_time, end_time, id
   FROM mrbs_entry
   WHERE room_id=$room
   AND start_time <= $month_end AND end_time > $month_start
   ORDER by 1";

# Build an array of information about each day in the month.
# The information is stored as:
#  d[monthday]["id"][] = ID of each entry, for linking.
#  d[monthday]["data"][] = "start-stop" times of each entry.

$res = sql_query($sql);
if (! $res) echo sql_error();
else for ($i = 0; ($row = sql_row($res, $i)); $i++)
{
	if ($debug_flag)
		echo "<br>DEBUG: result $i, id $row[2], starts $row[0], ends $row[1]\n";

	# Fill in data for each day during the month that this meeting covers.
	# Note: int casts on database rows for min and max is needed for PHP3.
	$t = max((int)$row[0], $month_start);
	$end_t = min((int)$row[1], $month_end);
 	$day_num = date("j", $t);
	$midnight = mktime(0, 0, 0, $month, $day_num, $year);
	while ($t < $end_t)
	{
		if ($debug_flag) echo "<br>DEBUG: Entry $row[2] day $day_num\n";
		$d[$day_num]["id"][] = $row[2];

		$midnight_tonight = $midnight + 86400;

		# Describe the start and end time, accounting for "all day"
		# and for entries starting before/ending after today.
		# There are 9 cases, for start time < = or > midnight this morning,
		# and end time < = or > midnight tonight.
		# Use ~ (not -) to separate the start and stop times, because MSIE
		# will incorrectly line break after a -.

		switch (cmp3($row[0], $midnight) . cmp3($row[1], $midnight_tonight))
		{
			case "> < ":         # Starts after midnight, ends before midnight
			case "= < ":         # Starts at midnight, ends before midnight
				$d[$day_num]["data"][] = date("H:i", $row[0]) . "~" . date("H:i", $row[1]);
				break;
			case "> = ":         # Starts after midnight, ends at midnight
				$d[$day_num]["data"][] = date("H:i", $row[0]) . "~24:00";
				break;
			case "> > ":         # Starts after midnight, continues tomorrow
				$d[$day_num]["data"][] = date("H:i", $row[0]) . "~====&gt;";
				break;
			case "= = ":         # Starts at midnight, ends at midnight
				$d[$day_num]["data"][] = $all_day;
				break;
			case "= > ":         # Starts at midnight, continues tomorrow
				$d[$day_num]["data"][] = $all_day . "====&gt;";
				break;
			case "< < ":         # Starts before today, ends before midnight
				$d[$day_num]["data"][] = "&lt;====~" . date("H:i", $row[1]);
				break;
			case "< = ":         # Starts before today, ends at midnight
				$d[$day_num]["data"][] = "&lt;====" . $all_day;
				break;
			case "< > ":         # Starts before today, continues tomorrow
				$d[$day_num]["data"][] = "&lt;====" . $all_day . "====&gt;";
				break;
		}

		# Only if end time > midnight does the loop continue for the next day.
		if ($row[1] <= $midnight_tonight) break;
		$day_num++;
		$t = $midnight = $midnight_tonight;
	}
}
if ($debug_flag) 
{
	echo "<p>DEBUG: Array of month day data:<p><pre>\n";
	for ($i = 1; $i <= $days_in_month; $i++)
	{
		if (isset($d[$i]["id"]))
		{
			$n = count($d[$i]["id"]);
			echo "Day $i has $n entries:\n";
			for ($j = 0; $j < $n; $j++)
				echo "  ID: " . $d[$i]["id"][$j] .
					" Data: " . $d[$i]["data"][$j] . "\n";
		}
	}
	echo "</pre>\n";
}

echo "<table border=2 width=\"100%\">\n<tr>";
# Weekday name header row:
for ($weekcol = 0; $weekcol < 7; $weekcol++)
{
	echo "<th width=\"14%\">" . day_name(($weekcol + $weekstarts)%7) . "</th>";
}
echo "</tr><tr>\n";

# Skip days in week before start of month:
for ($weekcol = 0; $weekcol < $weekday_start; $weekcol++)
{
	echo "<td bgcolor=\"#cccccc\" height=100>&nbsp;</td>\n";
}

# Draw the days of the month:
for ($cday = 1; $cday <= $days_in_month; $cday++)
{
	if ($weekcol == 0) echo "</tr><tr>\n";
	echo "<td valign=top height=100 class=month><div class=monthday><a href=\"day.php?year=$year&month=$month&day=$cday&area=$area\">$cday</a></div>\n";

	# Anything to display for this day?
	if (isset($d[$cday]["id"][0]))
	{
		echo "<font size=-2>";
		$n = count($d[$cday]["id"]);
		# Show the start/stop times, 2 per line, linked to view_entry.
		# If there are 12 or fewer, show them, else show 11 and "...".
		for ($i = 0; $i < $n; $i++)
		{
			if ($i == 11 && $n > 12)
			{
				echo " ...\n";
				break;
			}
			if ($i > 0 && $i % 2 == 0) echo "<br>"; else echo " ";
			echo "<a href=\"view_entry.php?id=" . $d[$cday]["id"][$i]
					. "&day=$cday&month=$month&year=$year\">"
					. $d[$cday]["data"][$i] . "</a>";
		}
		echo "</font>";
	}
    echo "</td>\n";
	if (++$weekcol == 7) $weekcol = 0;
}

# Skip from end of month to end of week:
if ($weekcol > 0) for (; $weekcol < 7; $weekcol++)
{
	echo "<td bgcolor=\"#cccccc\" height=100>&nbsp;</td>\n";
}
echo "</tr></table>\n";

include "trailer.inc";
?>
