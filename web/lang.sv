<?php // -*-mode: PHP; coding:iso-8859-1;-*-

// $Id$

// This file contains PHP code that specifies language specific strings
// The default strings come from lang.en, and anything in a locale
// specific file will overwrite the default. This is the Swedish file.
//
// Translated provede by: Bo Kleve (bok@unit.liu.se), MissterX
// Modified on 2006-01-04 by: Bj�rn Wiberg <Bjorn.Wiberg@its.uu.se>
// Modified on 2010-06-20 by: Kerstin St�hlbrand <kerstin.stahlbrand@svenskakyrkan.se>
//
// This file is PHP code. Treat it as such.

// The charset to use in "Content-type" header
$vocab["charset"]            = "iso-8859-1";

// Used in style.inc
$vocab["mrbs"]               = "MRBS - M�tesRumsBokningsSystem";

// Used in functions.inc
$vocab["report"]             = "Rapport";
$vocab["admin"]              = "Admin";
$vocab["help"]               = "Hj�lp";
$vocab["search"]             = "S�k";
$vocab["not_php3"]           = "VARNING: Detta fungerar f�rmodligen inte med PHP3";
$vocab["outstanding"]        = "v�ntande bokningar";

// Used in day.php
$vocab["bookingsfor"]        = "Bokningar f�r";
$vocab["bookingsforpost"]    = "";
$vocab["areas"]              = "Omr�den";
$vocab["daybefore"]          = "G� till f�reg�ende dag";
$vocab["dayafter"]           = "G� till n�sta dag";
$vocab["gototoday"]          = "G� till idag";
$vocab["goto"]               = "G� till";
$vocab["highlight_line"]     = "Markera denna rad";
$vocab["click_to_reserve"]   = "Klicka p� cellen f�r att g�ra en bokning.";

// Used in trailer.inc
$vocab["viewday"]            = "Visa dag";
$vocab["viewweek"]           = "Visa vecka";
$vocab["viewmonth"]          = "Visa m�nad";
$vocab["ppreview"]           = "F�rhandsgranska";

// Used in edit_entry.php
$vocab["addentry"]           = "Ny bokning";
$vocab["editentry"]          = "�ndra bokning";
$vocab["copyentry"]          = "Kopiera bokning";
$vocab["editseries"]         = "�ndra serie";
$vocab["copyseries"]         = "Kopiera serie";
$vocab["namebooker"]         = "Kort beskrivning";
$vocab["fulldescription"]    = "Fullst�ndig beskrivning:";
$vocab["date"]               = "Datum";
$vocab["start_date"]         = "Starttid";
$vocab["end_date"]           = "Sluttid";
$vocab["time"]               = "Tid";
$vocab["period"]             = "Period";
$vocab["duration"]           = "L�ngd";
$vocab["seconds"]            = "sekunder";
$vocab["minutes"]            = "minuter";
$vocab["hours"]              = "timmar";
$vocab["days"]               = "dagar";
$vocab["weeks"]              = "veckor";
$vocab["years"]              = "�r";
$vocab["periods"]            = "perioder";
$vocab["all_day"]            = "hela dagen";
$vocab["area"]               = "Omr�de";
$vocab["type"]               = "Typ";
$vocab["internal"]           = "Internt";
$vocab["external"]           = "Externt";
$vocab["save"]               = "Spara";
$vocab["rep_type"]           = "Repetitionstyp";
$vocab["rep_type_0"]         = "ingen";
$vocab["rep_type_1"]         = "dagligen";
$vocab["rep_type_2"]         = "varje vecka";
$vocab["rep_type_3"]         = "m�natligen";
$vocab["rep_type_4"]         = "�rligen";
$vocab["rep_type_5"]         = "M�nadsvis, samma dag";
$vocab["rep_type_6"]         = "Veckovis";
$vocab["rep_end_date"]       = "Repetition slutdatum";
$vocab["rep_rep_day"]        = "Repetitionsdag";
$vocab["rep_for_weekly"]     = "(vid varje vecka)";
$vocab["rep_freq"]           = "Intervall";
$vocab["rep_num_weeks"]      = "Antal veckor";
$vocab["rep_for_nweekly"]    = "(F�r x-veckor)";
$vocab["ctrl_click"]         = "H�ll ner tangenten <I>Ctrl</I> och klicka f�r att v�lja mer �n ett rum";
$vocab["entryid"]            = "Boknings-ID ";
$vocab["repeat_id"]          = "Repetions-ID "; 
$vocab["you_have_not_entered"] = "Du har inte angivit";
$vocab["you_have_not_selected"] = "Du har inte valt";
$vocab["valid_room"]         = "ett giltigt rum.";
$vocab["valid_time_of_day"]  = "en giltig tidpunkt p� dagen.";
$vocab["brief_description"]  = "en kort beskrivning.";
$vocab["useful_n-weekly_value"] = "ett anv�ndbart n-veckovist v�rde.";
$vocab["private"]            = "Privat";
$vocab["unavailable"]        = "Privat";

// Used in view_entry.php
$vocab["description"]        = "Beskrivning";
$vocab["room"]               = "Rum";
$vocab["createdby"]          = "Skapad av";
$vocab["lastupdate"]         = "Senast uppdaterad";
$vocab["deleteentry"]        = "Radera bokningen";
$vocab["deleteseries"]       = "Radera serie";
$vocab["confirmdel"]         = "�r du s�ker att\\ndu vill radera\\nden h�r bokningen?\\n\\n";
$vocab["returnprev"]         = "�ter till f�reg�ende sida";
$vocab["invalid_entry_id"]   = "Ogiltigt boknings-ID!";
$vocab["invalid_series_id"]  = "Ogiltigt serie-ID!";
$vocab["status"]             = "Status";
$vocab["confirmed"]          = "Bekr�ftad bokning";
$vocab["provisional"]        = "Provisorisk bokning";
$vocab["accept"]             = "Acceptera";
$vocab["reject"]             = "Neka";
$vocab["more_info"]          = "Mer information";
$vocab["remind_admin"]       = "P�minn administrat�r";
$vocab["series"]             = "Serier";
$vocab["request_more_info"]  = "Tala om vilken �vrig information du beh�ver.";
$vocab["reject_reason"]      = "Ge en anledning till varf�r du nekar den h�r bokningsf�rfr�gan.";
$vocab["send"]               = "Skicka";
$vocab["accept_failed"]      = "Bokningen kunde inte godk�nnas.";


// Used in edit_entry_handler.php
$vocab["error"]              = "Fel";
$vocab["sched_conflict"]     = "Bokningskonflikt";
$vocab["conflict"]           = "Den nya bokningen krockar med f�ljande bokning(ar)";
$vocab["rules_broken"]       = "The new booking will conflict with the following policies";
$vocab["too_may_entrys"]     = "De valda inst�llningarna skapar f�r m�nga bokningar.<br>V.g. anv�nd andra inst�llningar!";
$vocab["returncal"]          = "�terg� till kalendervy";
$vocab["failed_to_acquire"]  = "Kunde ej f� exklusiv databas�tkomst"; 
$vocab["invalid_booking"]    = "Ogiltig bokning";
$vocab["must_set_description"] = "Du m�ste ange en kort beskrivning f�r bokningen. V�nligen g� tillbaka och korrigera detta.";
$vocab["mail_subject_accepted"]  = "Bokningen godk�nd i $mrbs_company MRBS";
$vocab["mail_subject_rejected"]  = "Bokningen avvisad i $mrbs_company MRBS";
$vocab["mail_subject_more_info"] = "$mrbs_company MRBS: Mer information �nskas";
$vocab["mail_subject_reminder"]  = "P�minnelse fr�n $mrbs_company MRBS";
$vocab["mail_body_accepted"]     = "En bokning har blivit godk�nd av administrat�ren; h�r �r detaljerna:";
$vocab["mail_body_rej_entry"]    = "En bokning har blivit avvisad av administrat�ren; h�r �r detaljerna:";
$vocab["mail_body_more_info"]    = "Administrat�ren beh�ver mer information om bokningen; h�r �r detaljerna:";
$vocab["mail_body_reminder"]     = "P�minnelse - en bokning v�ntar p� godk�nnande; h�r �r detaljerna:";
$vocab["mail_subject_entry"] = "Bokning gjort/�ndrad i $mrbs_company MRBS";
$vocab["mail_body_new_entry"] = "En ny bokning �r gjord; h�r �r detaljerna:";
$vocab["mail_body_del_entry"] = "En bokning har raderats; h�r �r detaljerna:";
$vocab["mail_body_changed_entry"] = "En bokning har �ndrats; h�r �r detaljerna:";
$vocab["mail_subject_delete"] = "Bokning raderad i $mrbs_company MRBS";
$vocab["deleted_by"]          = "Raderad av";
$vocab["reason"]              = "Anledning";
$vocab["info_requested"]      = "Information beh�vs";
$vocab["min_time_before"]     = "Minsta intervall mellan nu och starten f�r en bokning �r";
$vocab["max_time_before"]     = "St�rsta intervall mellan nu och starten f�r en bokning �r";

// Used in pending.php
$vocab["pending"]            = "Provisorisk bokning v�ntar p� godk�nnande";
$vocab["none_outstanding"]   = "Du har inga provisoriska bokningar som v�ntar p� att godk�nnas.";

// Authentication stuff
$vocab["accessdenied"]       = "�tkomst nekad";
$vocab["norights"]           = "Du har inte r�ttighet att �ndra bokningen.";
$vocab["please_login"]       = "V�nligen logga in";
$vocab["users.name"]          = "Anv�ndarnamn";
$vocab["users.password"]      = "L�senord";
$vocab["users.level"]         = "R�ttigheter";
$vocab["unknown_user"]       = "Ok�nd anv�ndare";
$vocab["you_are"]            = "Du �r";
$vocab["login"]              = "Logga in";
$vocab["logoff"]             = "Logga ut";

// Database upgrade code
$vocab["database_login"]           = "Databas inloggning";
$vocab["upgrade_required"]         = "Databasen beh�ver uppdateras.";
$vocab["supply_userpass"]          = "Ange databasens anv�ndarnamn och l�senord som har admin r�ttigheter.";
$vocab["contact_admin"]            = "Om du inte �r MRBS administrat�r v�nligen kontakta $mrbs_admin.";
$vocab["upgrade_to_version"]       = "Uppgradera till databas version";
$vocab["upgrade_to_local_version"] = "Uppgradera till databas lokal version";
$vocab["upgrade_completed"]        = "Databasen har uppdateras klart.";

// User access levels
$vocab["level_0"]            = "Ingen r�ttighet";
$vocab["level_1"]            = "Anv�ndare";
$vocab["level_2"]            = "Administrat�r";
$vocab["level_3"]            = "Superadministrat�r";

// Authentication database
$vocab["user_list"]          = "Anv�ndarlista";
$vocab["edit_user"]          = "�ndra anv�ndare";
$vocab["delete_user"]        = "Radera denna anv�ndare";
//$vocab["users.name"]         = Use the same as above, for consistency.
//$vocab["users.password"]     = Use the same as above, for consistency.
$vocab["users.email"]         = "E-postadress";
$vocab["password_twice"]     = "Om du vill �ndra ditt l�senord, v�nligen mata in detta tv� g�nger";
$vocab["passwords_not_eq"]   = "Fel: L�senorden st�mmer inte �verens.";
$vocab["password_invalid"]   = "L�senordet �r inte giltigt. Det m�ste inneh�lla f�ljande:";
$vocab["policy_length"]      = "tecken";
$vocab["policy_alpha"]       = "bokstav/bokst�ver";
$vocab["policy_lower"]       = "liten bokstav (gemener)";
$vocab["policy_upper"]       = "stora bokstav (VERSALER)";
$vocab["policy_numeric"]     = "siffra/siffror";
$vocab["policy_special"]     = "special tecken";
$vocab["add_new_user"]       = "L�gg till anv�ndare";
$vocab["action"]             = "Handling";
$vocab["user"]               = "Anv�ndare";
$vocab["administrator"]      = "Administrat�r";
$vocab["unknown"]            = "Ok�nd";
$vocab["ok"]                 = "OK";
$vocab["show_my_entries"]    = "Klicka f�r att visa alla dina aktuella bokningar";
$vocab["no_users_initial"]   = "Inga anv�ndare finns i databasen. Till�ter initialt skapande av anv�ndare.";
$vocab["no_users_create_first_admin"] = "Skapa en administrativ anv�ndare f�rst. D�refter kan du logga in och skapa fler anv�ndare.";
$vocab["warning_last_admin"] = "Varning!  Detta �r den sista administrat�ren och du kan inte �ndra r�ttigheterna eller ta bort denna, g�r du det i alla fall har du ingen m�jlighet att komma in i systemet igen.";

// Used in search.php
$vocab["invalid_search"]     = "Tom eller ogiltig s�kstr�ng.";
$vocab["search_results"]     = "S�kresultat f�r";
$vocab["nothing_found"]      = "Inga s�ktr�ffar hittades.";
$vocab["records"]            = "Bokning ";
$vocab["through"]            = " t.o.m. ";
$vocab["of"]                 = " av ";
$vocab["previous"]           = "F�reg�ende";
$vocab["next"]               = "N�sta";
$vocab["entry"]              = "Bokning";
$vocab["view"]               = "Visa";
$vocab["advanced_search"]    = "Avancerad s�kning";
$vocab["search_button"]      = "S�k";
$vocab["search_for"]         = "S�k f�r";
$vocab["from"]               = "Fr�n";

// Used in report.php
$vocab["report_on"]          = "Rapport �ver m�ten";
$vocab["report_start"]       = "Startdatum f�r rapport";
$vocab["report_end"]         = "Slutdatum f�r rapport";
$vocab["match_area"]         = "S�k p� plats";
$vocab["match_room"]         = "S�k p� rum";
$vocab["match_type"]         = "S�k p� bokningstyp";
$vocab["ctrl_click_type"]    = "H�ll ner tangenten <I>Ctrl</I> och klicka f�r att v�lja fler �n en typ";
$vocab["match_entry"]        = "S�k p� kort beskrivning";
$vocab["match_descr"]        = "S�k p� fullst�ndig beskrivning";
$vocab["include"]            = "Inkludera";
$vocab["report_only"]        = "Endast rapport";
$vocab["summary_only"]       = "Endast sammanst�llning";
$vocab["report_and_summary"] = "Rapport och sammanst�llning";
$vocab["report_as_csv"]         = "Rapport som CSV";
$vocab["summary_as_csv"]        = "Sammanst�llning som CSV";
$vocab["summarize_by"]       = "Sammanst�ll p�";
$vocab["sum_by_descrip"]     = "Kort beskrivning";
$vocab["sum_by_creator"]     = "Skapare";
$vocab["entry_found"]        = "bokning hittad";
$vocab["entries_found"]      = "bokningar hittade";
$vocab["summary_header"]     = "Sammanst�llning �ver (bokningar) timmar";
$vocab["summary_header_per"] = "Sammanst�llning �ver (bokningar) perioder";
$vocab["entries"]               = "bokningar";
$vocab["total"]              = "Totalt";
$vocab["submitquery"]        = "Skapa rapport";
$vocab["sort_rep"]           = "Sortera rapport efter";
$vocab["sort_rep_time"]      = "Startdatum/starttid";
$vocab["rep_dsp"]            = "Visa i rapport";
$vocab["rep_dsp_dur"]        = "L�ngd";
$vocab["rep_dsp_end"]        = "Sluttid";
$vocab["fulldescription_short"] = "Fullst�ndig beskrivning";

// Used in week.php
$vocab["weekbefore"]         = "F�reg�ende vecka";
$vocab["weekafter"]          = "N�sta vecka";
$vocab["gotothisweek"]       = "Denna vecka";

// Used in month.php
$vocab["monthbefore"]        = "F�reg�ende m�nad";
$vocab["monthafter"]         = "N�sta m�nad";
$vocab["gotothismonth"]      = "Denna m�nad";

// Used in {day week month}.php
$vocab["no_rooms_for_area"]  = "Rum saknas f�r denna plats";

// Used in admin.php
$vocab["edit"]               = "�ndra";
$vocab["delete"]             = "Radera";
$vocab["rooms"]              = "Rum";
$vocab["in"]                 = "i";
$vocab["noareas"]            = "Inget omr�de";
$vocab["addarea"]            = "L�gg till omr�de";
$vocab["name"]               = "Namn";
$vocab["noarea"]             = "Inget omr�de valt";
$vocab["browserlang"]        = "Din webbl�sare �r inst�lld att anv�nda spr�k(en)";
$vocab["addroom"]            = "L�gg till rum";
$vocab["capacity"]           = "Kapacitet";
$vocab["norooms"]            = "Inga rum.";
$vocab["administration"]     = "Administration";
$vocab["invalid_area_name"]  = "Detta omr�des namn finns redan.";

// Used in edit_area_room.php
$vocab["editarea"]                = "�ndra omr�de";
$vocab["change"]                  = "�ndra";
$vocab["backadmin"]               = "Tillbaka till Administration";
$vocab["editroomarea"]            = "�ndra omr�de eller rum";
$vocab["editroom"]                = "�ndra rum";
$vocab["viewroom"]                = "Visa rum";
$vocab["update_room_failed"]      = "Uppdatering av rum misslyckades: ";
$vocab["error_room"]              = "Fel: rum ";
$vocab["not_found"]               = " hittades ej";
$vocab["update_area_failed"]      = "Uppdatering av omr�de misslyckades: ";
$vocab["error_area"]              = "Fel: omr�de";
$vocab["room_admin_email"]        = "E-postadress till rumsansvarig";
$vocab["area_admin_email"]        = "E-postadress till omr�desansvarig";
$vocab["area_first_slot_start"]   = "Start f�r f�rsta tid";
$vocab["area_last_slot_start"]    = "Start f�r sista tid";
$vocab["area_res_mins"]           = "Tidsintervall (i minuter)";
$vocab["area_def_duration_mins"]  = "G�llande intervall (i minuter)";
$vocab["invalid_area"]            = "Ogiltigt omr�de!";
$vocab["invalid_room_name"]       = "Det h�r rums namnet anv�nds redan i det h�r omr�det!";
$vocab["invalid_email"]           = "Ogiltig e-postadress!";
$vocab["invalid_resolution"]      = "Ogiltig kombination av f�rsta tid, sista tid och tidsintervall!";
$vocab["too_many_slots"]          = 'Du beh�ver �ka v�rdet f�r $max_slots i config filen!';
$vocab["general_settings"]        = "Allm�n";
$vocab["time_settings"]           = "Tidsintervaller";
$vocab["provisional_settings"]    = "Provisoriska bokningar";
$vocab["enable_provisional"]      = "Till�t provisoriska bokningar";
$vocab["enable_reminders"]        = "Till�t anv�ndare att p�minna administrat�ren.";
$vocab["private_settings"]        = "Privata bokningar";
$vocab["allow_private"]           = "Till�t privata bokningar";
$vocab["force_private"]           = "Best�m privata bokningar";
$vocab["default_settings"]        = "G�llande/best�mda inst�llningar";
$vocab["default_private"]         = "Privat";
$vocab["default_public"]          = "�ppen";
$vocab["private_display"]         = "Privat bokning (visa)";
$vocab["private_display_label"]   = "Hur ska privata bokningar visas?";
$vocab["private_display_caution"] = "Varning: t�nk efter vilka konsekvenser detta kan f� innan du �ndrar dessa inst�llningar!";
$vocab["treat_respect"]           = "Respektera att detta �r en privat bokning";
$vocab["treat_private"]           = "Behandla alla bokningar som privata, ignorera den individuella inst�llningen.";
$vocab["treat_public"]            = "Behandla alla bokningar som �ppna, ignorera den individuella inst�llningen.";
$vocab["sort_key"]                = "Sorterings nyckel";
$vocab["sort_key_note"]           = "Det h�r �r nyckeln f�r att sortera rum i bokstavsordning.";
$vocab["booking_policies"]        = "Boknings policy";
$vocab["min_book_ahead"]          = "Bokning i f�rv�g - minimum";
$vocab["max_book_ahead"]          = "Bokning i f�rv�g - maximum";
$vocab["custom_html"]             = "Vanlig visning (HTML)";
$vocab["custom_html_note"]        = "Det h�r f�ltet kan anv�ndas f�r att visa din egen HTML, till exempel en inb�ddad Google karta";
 
// Used in edit_users.php
$vocab["name_empty"]         = "Du m�ste ange ett namn.";
$vocab["name_not_unique"]    = "finns redan.   Ange ett annat namn.";

// Used in del.php
$vocab["deletefollowing"]    = "Detta raderar f�ljande bokningar";
$vocab["sure"]               = "�r du s�ker?";
$vocab["YES"]                = "JA";
$vocab["NO"]                 = "NEJ";
$vocab["delarea"]            = "Du m�ste ta bort alla rum i detta omr�de innan du kan ta bort omr�det!<p>";

// Used in help.php
$vocab["about_mrbs"]         = "Om MRBS";
$vocab["database"]           = "Databas";
$vocab["system"]             = "System";
$vocab["servertime"]         = "Server tid";
$vocab["please_contact"]     = "Var v�nlig kontakta ";
$vocab["for_any_questions"]  = "f�r eventuella fr�gor som ej besvaras h�r.";

// Used in mysql.inc AND pgsql.inc
$vocab["failed_connect_db"]  = "Fatalt fel: Kunde ej ansluta till databasen!";

?>
