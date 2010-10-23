#
# MySQL MRBS table creation script
#
# $Id$
#
# Notes:
# (1) If you have decided to change the prefix of your tables from 'mrbs_'
#     to something else using $db_tbl_prefix then you must edit each
#     'CREATE TABLE' and 'INSERT INTO' line below to replace 'mrbs_' with
#     your new table prefix.
#
# (2) If you change the varchar lengths here, then you should check
#     to see whether a corresponding length has been defined in the config file
#     in the array $maxlength.
#
# (3) If you add new fields then you should also change the global variable
#     $standard_fields.   Note that if you are just adding custom fields for
#     a single site then this is not necessary.

CREATE TABLE mrbs_area
(
  id                     int NOT NULL auto_increment,
  area_name              varchar(30),
  area_admin_email       text,
  resolution             int,
  default_duration       int,
  morningstarts          int,
  morningstarts_minutes  int,
  eveningends            int,
  eveningends_minutes    int,
  private_enabled        tinyint(1),
  private_default        tinyint(1),
  private_mandatory      tinyint(1),
  private_override       varchar(32),
  min_book_ahead_enabled tinyint(1),
  min_book_ahead_secs    int,
  max_book_ahead_enabled tinyint(1),
  max_book_ahead_secs    int,
  custom_html            text,
  provisional_enabled    tinyint(1),
  reminders_enabled      tinyint(1),

  PRIMARY KEY (id)
);

CREATE TABLE mrbs_room
(
  id               int NOT NULL auto_increment,
  area_id          int DEFAULT '0' NOT NULL,
  room_name        varchar(25) DEFAULT '' NOT NULL,
  sort_key         varchar(25) DEFAULT '' NOT NULL,
  description      varchar(60),
  capacity         int DEFAULT '0' NOT NULL,
  room_admin_email text,
  custom_html      text,

  PRIMARY KEY (id),
  KEY idxSortKey (sort_key)
);

CREATE TABLE mrbs_entry
(
  id          int NOT NULL auto_increment,
  start_time  int DEFAULT '0' NOT NULL,
  end_time    int DEFAULT '0' NOT NULL,
  entry_type  int DEFAULT '0' NOT NULL,
  repeat_id   int DEFAULT '0' NOT NULL,
  room_id     int DEFAULT '1' NOT NULL,
  timestamp   timestamp,
  create_by   varchar(80) DEFAULT '' NOT NULL,
  name        varchar(80) DEFAULT '' NOT NULL,
  type        char DEFAULT 'E' NOT NULL,
  description text,
  private     TINYINT(1) NOT NULL DEFAULT 0,
  status      tinyint NOT NULL DEFAULT 1,
  reminded    int,
  info_time   int,
  info_user   varchar(80),
  info_text   text,

  PRIMARY KEY (id),
  KEY idxStartTime (start_time),
  KEY idxEndTime   (end_time)
);

CREATE TABLE mrbs_repeat
(
  id          int NOT NULL auto_increment,
  start_time  int DEFAULT '0' NOT NULL,
  end_time    int DEFAULT '0' NOT NULL,
  rep_type    int DEFAULT '0' NOT NULL,
  end_date    int DEFAULT '0' NOT NULL,
  rep_opt     varchar(32) DEFAULT '' NOT NULL,
  room_id     int DEFAULT '1' NOT NULL,
  timestamp   timestamp,
  create_by   varchar(80) DEFAULT '' NOT NULL,
  name        varchar(80) DEFAULT '' NOT NULL,
  type        char DEFAULT 'E' NOT NULL,
  description text,
  rep_num_weeks smallint NULL, 
  private     TINYINT(1) NOT NULL DEFAULT 0,
  reminded    int,
  info_time   int,
  info_user   varchar(80),
  info_text   text,
  
  PRIMARY KEY (id)
);

CREATE TABLE mrbs_variables
(
  id               int NOT NULL auto_increment,
  variable_name    varchar(80),
  variable_content text,
      
  PRIMARY KEY (id)
);

CREATE TABLE mrbs_users
(
  /* The first four fields are required. Don't remove. */
  id        int NOT NULL auto_increment,
  level     smallint DEFAULT '0' NOT NULL,  /* play safe and give no rights */
  name      varchar(30),
  password  varchar(40),
  email     varchar(75),

  PRIMARY KEY (id)
);

INSERT INTO mrbs_variables (variable_name, variable_content)
  VALUES ( 'db_version', '15');
INSERT INTO mrbs_variables (variable_name, variable_content)
  VALUES ( 'local_db_version', '1');
