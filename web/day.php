<?php
# $Id$

include "config.inc";
include "functions.inc";
include "$dbsys.inc";
include "mincals.inc";

#If we dont know the right date then make it up 
if (!isset($day) or !isset($month) or !isset($year))
{
	$day   = date("d");
	$month = date("m");
	$year  = date("Y");
} else {
# Make the date valid if day is more then number of days in month
	while (!checkdate($month, $day, $year))
		$day--;
}
if (empty($area))
	$area = get_default_area();

# print the page header
print_header($day, $month, $year, $area);

# Define the start and end of the day.
$am7=mktime($morningstarts,0,0,$month,$day,$year);
$pm7=mktime($eveningends,$eveningends_minutes,0,$month,$day,$year);

echo "<table><tr><td width=\"100%\">";

#Show all avaliable areas
echo "<u>$lang[areas]</u><br>";
$sql = "select id, area_name from mrbs_area order by area_name";
$res = sql_query($sql);
if ($res) for ($i = 0; ($row = sql_row($res, $i)); $i++)
{
	echo "<a href=\"day.php?year=$year&month=$month&day=$day&area=$row[0]\">";
	if ($row[0] == $area)
		echo "<font color=red>" . htmlspecialchars($row[1]) . "</font></a><br>\n";
	else echo htmlspecialchars($row[1]) . "</a><br>\n";
}

#Draw the three month calendars
minicals($year, $month, $day, $area);
echo "</tr></table>";

#y? are year, month and day of yesterday
#t? are year, month and day of tomorrow

$i= mktime(0,0,0,$month,$day-1,$year);
$yy = date("Y",$i);
$ym = date("m",$i);
$yd = date("d",$i);

$i= mktime(0,0,0,$month,$day+1,$year);
$ty = date("Y",$i);
$tm = date("m",$i);
$td = date("d",$i);

#Show current date
echo "<h2 align=center>" . strftime("%A %d %B %Y", $am7) . "</h2>\n";

#Show Go to day before and after links
echo "<table width=\"100%\"><tr><td><a href=\"day.php?year=$yy&month=$ym&day=$yd&area=$area\">&lt;&lt; $lang[daybefore]</a></td>
      <td align=center><a href=\"day.php?area=$area\">$lang[gototoday]</a></td>
      <td align=right><a href=\"day.php?year=$ty&month=$tm&day=$td&area=$area\">$lang[dayafter] &gt;&gt;</a></td></tr></table>";


#We want to build an array containing all the data we want to show
#and then spit it out. 

#Get all appointments for today in the area that we care about
#Note: The predicate clause 'start_time <= ...' is an equivalent but simpler
#form of the original which had 3 BETWEEN parts. It selects all entries which
#occur on or cross the current day.
$sql = "SELECT mrbs_room.id, start_time, end_time, name, mrbs_entry.id, type
   FROM mrbs_entry, mrbs_room
   WHERE mrbs_entry.room_id = mrbs_room.id
   AND area_id = $area 
   AND start_time <= $pm7 AND end_time > $am7";

$res = sql_query($sql);
if (! $res) fatal_error(0, sql_error());
for ($i = 0; ($row = sql_row($res, $i)); $i++) {
	# Each row weve got here is an appointment.
	#Row[0] = Room ID
	#row[1] = start time
	#row[2] = end time
	#row[3] = short description
	#row[4] = id of this booking
	#row[5] = type (internal/external)

	# $today is a map of the screen that will be displayed
	# It looks like:
	#     $today[Room ID][Time][id]
	#                          [color]
	#                          [data]

	# Fill in the map for this meeting. Start at the meeting start time,
	# or the day start time, whichever is later. End one slot before the
	# meeting end time (since the next slot is for meetings which start then),
	# or at the last slot in the day, whichever is earlier.
	# Note: int casts on database rows for max may be needed for PHP3.
	$end_t = min($row[2] - $resolution, $pm7);
	for ($t = max((int)$row[1], $am7); $t <= $end_t; $t += $resolution)
	{
		$today[$row[0]][$t]["id"]    = $row[4];
		$today[$row[0]][$t]["color"] = $row[5];
		$today[$row[0]][$t]["data"]  = "";
	}

	# Show the name of the booker in the first segment that the booking
	# happens in, or at the start of the day if it started before today.
	if ($row[1] < $am7)
		$today[$row[0]][$am7]["data"] = $row[3];
	else
		$today[$row[0]][$row[1]]["data"] = $row[3];
}

# We need to know what all the rooms area called, so we can show them all
# pull the data from the db and store it. Convienently we can print the room 
# headings and capacities at the same time

$sql = "select room_name, capacity, id from mrbs_room where area_id=$area order by 1";
$res = sql_query($sql);

# It might be that there are no rooms defined for this area.
# If there are none then show an error and dont bother doing anything
# else
if (! $res) fatal_error(0, sql_error());
if (sql_count($res) == 0)
{
	echo "<h1>$lang[no_rooms_for_area]</h1>";
	sql_free($res);
}
else
{
	#This is where we start displaying stuff
	echo "<table cellspacing=0 border=1 width=\"100%\">";
	echo "<tr><th width=\"1%\">$lang[time]</th>";

	$room_column_width = (int)(95 / sql_count($res));
	for ($i = 0; ($row = sql_row($res, $i)); $i++)
	{
		echo "<th width=\"$room_column_width%\">" . htmlspecialchars($row[0])
			. "($row[1])</th>";
		$rooms[] = $row[2];
	}
	echo "</tr>\n";
	
	# URL for highlighting a time. Don't use REQUEST_URI or you will get
	# the timetohighlight parameter duplicated each time you click.
	$hilite_url="day.php?year=$year&month=$month&day=$day&area=$area&timetohighlight";

	# This is the main bit of the display
	# We loop through unixtime and then the rooms we just got

	for ($t = $am7; $t <= $pm7; $t += $resolution)
	{
		# Show the time linked to the URL for highlighting that time
		echo "<tr>";
		tdcell("red");
		echo "<a href=\"$hilite_url=$t\">" . date("H:i",$t) . "</a></td>";

		# Loop through the list of rooms we have for this area
		while (list($key, $room) = each($rooms))
		{
			if(isset($today[$room][$t]["id"]))
			{
				$id    = $today[$room][$t]["id"];
				$color = $today[$room][$t]["color"];
				$descr = htmlspecialchars($today[$room][$t]["data"]);
			}
			else
				unset($id);
			
			# $c is the colour of the cell that the browser sees. White normally, 
			# red if were hightlighting that line and a nice attractive green if the room is booked.
			# We tell if its booked by $id having something in it
			if (isset($id))
				$c = $color;
			elseif (isset($timetohighlight) && ($t == $timetohighlight))
				$c = "red";
			else
				$c = "white";

			tdcell($c);

			# If the room isnt booked then allow it to be booked
			if(!isset($id))
			{
				$hour = date("H",$t);
				$minute  = date("i",$t);

				echo "<center><a href=\"edit_entry.php?room=$room&hour=$hour&minute=$minute&year=$year&month=$month&day=$day\"><img src=new.gif width=10 height=10 border=0></a></center>";
			}
			elseif ($descr != "")
			{
				#if it is booked then show 
				echo " <a href=\"view_entry.php?id=$id&day=$day&month=$month&year=$year\">$descr</a>";
			}
			else
				echo "&nbsp;\"&nbsp;";

			echo "</td>\n";
		}
		echo "</tr>\n";
		reset($rooms);
	}
	echo "</table>";
	show_colour_key();
}

include "trailer.inc"; 
?>
