<?php

# $Id$

###########################################################################
#   MRBS Configuration File
#   Configure this file for your site.
#   You shouldn't have to modify anything outside this file.
###########################################################################

###################
# Database settings
###################
# Choose database system: see INSTALL for the list of supported databases
# ("mysql"=MySQL,...) and valid strings.
$dbsys = "mysql";
# Hostname of database server (SID for Oracle) :
$db_host = "localhost";
# Port used by database server (leave empty if using the default one)
$db_port = "";
# Database name:
$db_database = "mrbs";
# Database login user name:
$db_login = "mrbs";
# Database login password:
$db_password = "mrbs-password";
# Set this to TRUE to NOT use PHP persistent (pooled) database connections:
$db_nopersist = FALSE;
# Communication protocol tu use. For pgsql, you can use 'unix' instead of
# 'tcp' to use Unix Domain Sockets instead of TCP/IP.
$db_protocol = "tcp";

################################
# DBMS specific options
################################

# ****ORACLE*****

# Home directory path when Oracle is installed if it is running in the local machine.
# Default value: value of the environment variable ORACLE_HOME
$oci8_home = "";


################################
# Site identification information
#################################
$mrbs_admin = "Your Administrator";
$mrbs_admin_email = "admin_email@your.org";

# This is the text displayed in the upper left corner of every page. Either
# type the name of your organization, or you can put your logo like this :
# $mrbs_company = "<a href=http://www.your_organisation.com/><img src=your_logo.gif border=0></a>";
$mrbs_company = "Your Company";

# This is to fix URL problems when using a proxy in the environment.
# If links inside MRBS appear broken, then specify here the URL of
# your MRBS root directory, as seen by the users. For example:
# $url_base =  "http://webtools.uab.ericsson.se/oam";
$url_base = "";


###################
# Calendar settings
###################
# Note: Be careful to avoid specify options that displays blocks overlaping
# the next day, since it is not properly handled.

# This setting controls whether to use "clock" based intervals (FALSE and
# the default) or user defined periods (TRUE).  If user-defined periods
# are used then $resolution, $morningstarts, $eveningends,
# $eveningends_minutes and $twentyfourhour_format are ignored.
$enable_periods = FALSE;

# Resolution - what blocks can be booked, in seconds.
# Default is half an hour: 1800 seconds.
$resolution = 1800;

# Start and end of day, NOTE: These are integer hours only, 0-23, and
# morningstarts must be < eveningends. See also eveningends_minutes.
$morningstarts = 7;
$eveningends   = 19;

# Minutes to add to $eveningends hours to get the real end of the day.
# Examples: To get the last slot on the calendar to be 16:30-17:00, set
# eveningends=16 and eveningends_minutes=30. To get a full 24 hour display
# with 15-minute steps, set morningstarts=0; eveningends=23;
# eveningends_minutes=45; and resolution=900.
$eveningends_minutes = 0;

# Define the name or description for your periods in chronological order
# For example:
# $periods[] = "Period&nbsp;1"
# $periods[] = "Period&nbsp;2"
# ...
# or
# $periods[] = "09:15&nbsp;-&nbsp;09:50"
# $periods[] = "09:55&nbsp;-&nbsp;10:35"
# ...
# &nbsp; is used to ensure that the name or description is not wrapped
# when the browser determines the column widths to use in day and week
# views

$periods[] = "Period&nbsp;1";
$periods[] = "Period&nbsp;2";

# Start of week: 0 for Sunday, 1 for Monday, etc.
$weekstarts = 0;

# Trailer date format: 0 to show dates as "Jul 10", 1 for "10 Jul"
$dateformat = 0;

# Time format in pages. 0 to show dates in 12 hour format, 1 to show them
# in 24 hour format
$twentyfourhour_format = 1;

########################
# Miscellaneous settings
########################

# Maximum repeating entrys (max needed +1):
$max_rep_entrys = 365 + 1;

# Default report span in days:
$default_report_days = 60;

# Results per page for searching:
$search["count"] = 20;

# Page refresh time (in seconds). Set to 0 to disable
$refresh_rate = 0;

# should areas be shown as a list or a drop-down select box?
$area_list_format = "list";
#$area_list_format = "select";

# Entries in monthly view can be shown as start/end slot or brief description
# Set to TRUE for brief description, FALSE for time slot
$monthly_view_brief_description = TRUE;

# To view weeks in the bottom (trailer.inc) as week numbers (42) instead of
# 'first day of the week' (13 Oct), set this to TRUE
$view_week_number = FALSE;

# To display times on right side in day and week view, set to TRUE;
$times_right_side = FALSE;

# Color class to use for horizontal stripes on the day view;
# Default="white"=no stripes. "A" to "J": See color classes further down.
$stripe_color = "white";

# Define default starting view (month, week or day)
# Default is day
$default_view = "day";

###############################################
# Authentication settings - read AUTHENTICATION
###############################################
$auth["session"] = "php"; # How to get and keep the user ID. One of "http" "php" "cookie" "ip" "host" "nt" "omni".
$auth["type"] = "config"; # How to validate the user/password. One of "none" "config" "db" "pop3" "imap" "ldap".

# The list of administrators (can modify other peoples settings)
$auth["admin"][] = "127.0.0.1";		# localhost IP address. Useful with IP sessions.
$auth["admin"][] = "administrator";	# A user name from the user list. Useful with most other session schemes.
#$auth["admin"][] = "10.0.0.1";
#$auth["admin"][] = "10.0.0.2";
#$auth["admin"][] = "10.0.0.3";

# 'auth_config' user database
# Format: $auth["user"]["name"] = "password";
$auth["user"]["administrator"] = "secret";
$auth["user"]["alice"] = "a";
$auth["user"]["bob"] = "b";

# 'session_http' configuration settings
$auth["realm"]  = "mrbs";

# 'auth_ext' configuration settings
$auth["prog"]   = "";
$auth["params"] = "";

# 'auth_ldap' configuration settings
# Where is the LDAP server
#$ldap_host = "localhost";
# LDAP base distinguish names
#$ldap_base_dn[] = "ou=organizationalunit1,o=organization,c=MY";
#$ldap_base_dn[] = "ou=organizationalunit2,o=organization,c=MY";
#$ldap_base_dn[] = "ou=organizationalunit3,o=organization,c=MY";

# 'auth_ldap' extra configuration for ldap configuration of who can use
# the system
# If it's set, the $ldap_filter will be combined with the uid like this:
#   (&(uid=username)($ldap_filter))
# After binding to check the password, this check is used to see that
# they are a valid user of mrbs.
$ldap_filter = "mrbsuser=y";

# 'auth_imap' configuration settings
# Where is the IMAP server
$imap_host = "imap-server-name";
# The IMAP server port
$imap_port = "143"; 

# 'auth_pop3' configuration settings
# Where is the POP3 server
$pop3_host = "pop3-server-name";
# The POP3 server port
$pop3_port = "110";

##########
# Language
##########

# Set this to 1 to use UTF-8 in all pages and in the database, otherwise
# text gets enterered in the database in different encodings, dependent
# on the users' language
$unicode_encoding = 1;

# Set this to a different language specifier to default to different
# language tokens. This must equate to a lang.* file in MRBS.
# e.g. use "fr" to use the translations in "lang.fr" as the default
# translations
$default_language_tokens = "en";

# Set this to 1 to disable the automatic language changing MRBS performs
# based on the user's browser language settings. It will ensure that
# the language displayed is always the value of $default_language_tokens,
# as specified above
$disable_automatic_language_changing = 0;

# Set this to a valid locale (for the OS you run the MRBS server on)
# if you want to override the automatic locale determination MRBS
# performs
$override_locale = "";

# faq file language selection. IF not set, use the default english file.
# IF your language faq file is available, set $faqfilelang to match the
# end of the file name, including the underscore (ie. for site_faq_fr.html
# use "_fr"
$faqfilelang = ""; 

# This next require must be done after the definitions above, as the definitions
# are used in the included file
require_once "language.inc";

#############
# Entry Types
#############
# This array maps entry type codes (letters A through J) into descriptions.
# Each type has a color (see TD.x classes in the style sheet mrbs.css).
#    A=Pink  B=Blue-green  C=Peach  D=Yellow      E=Light blue
#    F=Tan   G=Red         H=Aqua   I=Light green J=Gray
# The value for each type is a short (one word is best) description of the
# type. The values must be escaped for HTML output ("R&amp;D").
# Please leave I and E alone for compatibility.
# If a type's entry is unset or empty, that type is not defined; it will not
# be shown in the day view color-key, and not offered in the type selector
# for new or edited entries.

# $typel["A"] = "A";
# $typel["B"] = "B";
# $typel["C"] = "C";
# $typel["D"] = "D";
$typel["E"] = get_vocab("external");
# $typel["F"] = "F";
# $typel["G"] = "G";
# $typel["H"] = "H";
$typel["I"] = get_vocab("internal");
# $typel["J"] = "J";

##########################################
# PHP System Configuration - internal use, do not change
##########################################
# Disable magic quoting on database returns:
set_magic_quotes_runtime(0);
ini_set("magic_quotes_sybase", "0");

# Make sure notice errors are not reported, they can break mrbs code:
error_reporting (E_ALL ^ E_NOTICE);

# Debug flag : leave it to FALSE for production site.
$debug_flag = FALSE;

# MRBS developers, make sure to update this string before each release:
$mrbs_version = "MRBS 1.2-pre2";

?>