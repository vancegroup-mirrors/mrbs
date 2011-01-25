<?php // -*-mode: PHP; coding:utf-8;-*-

// $Id$

// This file contains PHP code that specifies language specific strings
// The default strings come from lang.en, and anything in a locale
// specific file will overwrite the default. This is a Czech file.
//
// Translations provided by: "SmEjDiL" <malyl@col.cz>, 
//   "David Krotil" <David.Krotil@mu-sokolov.cz>
//
// This file is PHP code. Treat it as such.

// Used in style.inc
$vocab["mrbs"]               = "MRBS - Rezervační systém";

// Used in functions.inc
$vocab["report"]             = "Výpis";
$vocab["admin"]              = "Administrátor";
$vocab["help"]               = "Pomoc";
$vocab["search"]             = "Hledat";
$vocab["not_php3"]           = "UPOZORNĚNÍ: Toto zřejmě není funkční s PHP3";

// Used in day.php
$vocab["bookingsfor"]        = "Objednáno pro";
$vocab["bookingsforpost"]    = ""; // Goes after the date
$vocab["areas"]              = "Oblasti";
$vocab["daybefore"]          = "Den vzad";
$vocab["dayafter"]           = "Den vpřed";
$vocab["gototoday"]          = "Dnes";
$vocab["goto"]               = "Přejít na";
$vocab["highlight_line"]     = "Označte tuto řádku";
$vocab["click_to_reserve"]   = "Klepněte na buňku, aby jste provedli rezervaci.";

// Used in trailer.inc
$vocab["viewday"]            = "Dny";
$vocab["viewweek"]           = "Týdny";
$vocab["viewmonth"]          = "Měsíce ";
$vocab["ppreview"]           = "Pro tisk";

// Used in edit_entry.php
$vocab["addentry"]           = "Přidat záznam";
$vocab["editentry"]          = "Editovat záznam";
$vocab["editseries"]         = "Editovat sérii";
$vocab["namebooker"]         = "Popis instrukce";
$vocab["fulldescription"]    = "Celkový popis:<br>&nbsp;&nbsp;(Počet cestujících,<br>&nbsp;&nbsp;Obsazeno/Volná místa atd)";
$vocab["date"]               = "Datum";
$vocab["start_date"]         = "Začátek";
$vocab["end_date"]           = "Konec";
$vocab["time"]               = "Čas";
$vocab["period"]             = "Perioda";
$vocab["duration"]           = "Doba trvání";
$vocab["seconds"]            = "sekundy";
$vocab["minutes"]            = "minuty";
$vocab["hours"]              = "hodiny";
$vocab["days"]               = "dny";
$vocab["weeks"]              = "týdny";
$vocab["years"]              = "roky";
$vocab["periods"]            = "period";
$vocab["all_day"]            = "Vechny dny";
$vocab["type"]               = "Typ";
$vocab["internal"]           = "Volná místa";
$vocab["external"]           = "Obsazeno";
$vocab["save"]               = "Uloit";
$vocab["rep_type"]           = "Typ opakování";
$vocab["rep_type_0"]         = "Nikdy";
$vocab["rep_type_1"]         = "Denně";
$vocab["rep_type_2"]         = "Týdně";
$vocab["rep_type_3"]         = "Měsíčně";
$vocab["rep_type_4"]         = "Ročně";
$vocab["rep_type_5"]         = "Měsíčně, jednou za měsíc";
$vocab["rep_type_6"]         = "n-týdnů";
$vocab["rep_end_date"]       = "Konec opakování";
$vocab["rep_rep_day"]        = "Opakovat v den";
$vocab["rep_for_weekly"]     = "(pro (n-)týdnů)";
$vocab["rep_freq"]           = "Frekvence";
$vocab["rep_num_weeks"]      = "Čislo týdne";
$vocab["rep_for_nweekly"]    = "(pro n-týdnů)";
$vocab["ctrl_click"]         = "Uít CTRL pro výběr více místností";
$vocab["entryid"]            = "Vstupní ID ";
$vocab["repeat_id"]          = "ID pro opakování"; 
$vocab["you_have_not_entered"] = "Nevloil jste";
$vocab["you_have_not_selected"] = "Nevybral jste";
$vocab["valid_room"]         = "prostředek.";
$vocab["brief_description"]  = "Krátký popis.";
$vocab["useful_n-weekly_value"] = "pouitelná x-týdenní hodnota.";

// Used in view_entry.php
$vocab["description"]        = "Popis";
$vocab["room"]               = "Místnost";
$vocab["createdby"]          = "Vytvořil uivatel";
$vocab["lastupdate"]         = "Poslední změna";
$vocab["deleteentry"]        = "Smazat záznam";
$vocab["deleteseries"]       = "Smazat sérii";
$vocab["confirmdel"]         = "Jste si jistý\\nsmazáním tohoto záznamu?\\n\\n";
$vocab["returnprev"]         = "Návrat na předchozí stránku";
$vocab["invalid_entry_id"]   = "patné ID záznamu.";
$vocab["invalid_series_id"]  = "patné ID skupiny.";

// Used in edit_entry_handler.php
$vocab["error"]              = "Chyba";
$vocab["sched_conflict"]     = "Konflikt při plánování";
$vocab["conflict"]           = "Nová rezervace je v konfliktu s jiným záznamem";
$vocab["too_may_entrys"]     = "Vybraná volba byla vytvořena pro jiné záznamy.<br>Prosím vyberte jinou volbu!";
$vocab["returncal"]          = "Návrat do kalendáře";
$vocab["failed_to_acquire"]  = "Chyba výhradního přístupu do databáze"; 

// Authentication stuff
$vocab["accessdenied"]       = "Přístup zamítnut";
$vocab["norights"]           = "Nemáte přístupové právo pro změnu této poloky.";
$vocab["please_login"]       = "Prosím, přihlate se";
$vocab["users.name"]          = "Jméno";
$vocab["users.password"]      = "Heslo";
$vocab["users.level"]         = "Práva";
$vocab["unknown_user"]       = "Neznámý uivatel";
$vocab["you_are"]            = "Jste";
$vocab["login"]              = "Přihlásit se";
$vocab["logoff"]             = "Odhlásit se";

// Authentication database
$vocab["user_list"]          = "Seznam uivatelů";
$vocab["edit_user"]          = "Editovat uivatele";
$vocab["delete_user"]        = "Smazat tohoto uivatele";
//$vocab["users.name"]         = Use the same as above, for consistency.
//$vocab["users.password"]     = Use the same as above, for consistency.
$vocab["users.email"]         = "Emailová adresa";
$vocab["password_twice"]     = "Pokud chcete změnit heslo, prosím napite ho dvakrát";
$vocab["passwords_not_eq"]   = "Chyba: Vloená hesla se neshodují.";
$vocab["add_new_user"]       = "Přidat nového uivatele";
$vocab["action"]             = "Akce";
$vocab["user"]               = "Uivatel";
$vocab["administrator"]      = "Administrátor";
$vocab["unknown"]            = "Neznámý";
$vocab["ok"]                 = "Ano";
$vocab["show_my_entries"]    = "Klepnout pro zobrazání vech nadcházejících záznamů";

// Used in search.php
$vocab["invalid_search"]     = "Prázdný nebo neplatný hledaný řetězec.";
$vocab["search_results"]     = "Výsledek hledání pro";
$vocab["nothing_found"]      = "Nic nenalezeno";
$vocab["records"]            = "Záznam";
$vocab["through"]            = " skrze ";
$vocab["of"]                 = " o ";
$vocab["previous"]           = "Předchozi";
$vocab["next"]               = "Dalí";
$vocab["entry"]              = "Záznam";
$vocab["view"]               = "Náhled";
$vocab["advanced_search"]    = "Rozířené hledání";
$vocab["search_button"]      = "Hledat";
$vocab["search_for"]         = "Hledat co";
$vocab["from"]               = "Od";

// Used in report.php
$vocab["report_on"]          = "Výpis setkání";
$vocab["report_start"]       = "Výpis začátků";
$vocab["report_end"]         = "Výpis konců";
$vocab["match_area"]         = "Hledaná oblast";
$vocab["match_room"]         = "Hledaná místnost";
$vocab["match_type"]         = "Hledaný typ";
$vocab["ctrl_click_type"]    = "Uít CTRL pro výběr více typů";
$vocab["match_entry"]        = "Hledat v popisu";
$vocab["match_descr"]        = "Hledat v celém popisu";
$vocab["include"]            = "Zahrnovat";
$vocab["report_only"]        = "Jen výpis";
$vocab["summary_only"]       = "Jen přehled";
$vocab["report_and_summary"] = "Výpis a přehled";
$vocab["summarize_by"]       = "Přehled od";
$vocab["sum_by_descrip"]     = "Popis instrukce";
$vocab["sum_by_creator"]     = "Tvůrce";
$vocab["entry_found"]        = "nalezeno";
$vocab["entries_found"]      = "nalezeno";
$vocab["summary_header"]     = "Přehled  (záznamu) hodiny";
$vocab["summary_header_per"] = "Přehled  (záznamu) periody";
$vocab["total"]              = "Celkem";
$vocab["submitquery"]        = "Vytvořit sestavu";
$vocab["sort_rep"]           = "Seřadit výpis podle";
$vocab["sort_rep_time"]      = "Výchozí den/čas";
$vocab["rep_dsp"]            = "Zobrazit ve výpisu";
$vocab["rep_dsp_dur"]        = "Trvání";
$vocab["rep_dsp_end"]        = "Čas ukončení";

// Used in week.php
$vocab["weekbefore"]         = "Týden dozadu";
$vocab["weekafter"]          = "Týden dopředu";
$vocab["gotothisweek"]       = "Tento týden";

// Used in month.php
$vocab["monthbefore"]        = "Měsíc dozadu";
$vocab["monthafter"]         = "Měsic dopředu";
$vocab["gotothismonth"]      = "Tento měsíc";

// Used in {day week month}.php
$vocab["no_rooms_for_area"]  = "Pro tuto místnost není definována adná oblast!";

// Used in admin.php
$vocab["edit"]               = "Editovat";
$vocab["delete"]             = "Smazat";
$vocab["rooms"]              = "Místnosti";
$vocab["in"]                 = "v";
$vocab["noareas"]            = "ádné oblasti";
$vocab["addarea"]            = "Přidat oblast";
$vocab["name"]               = "Jméno";
$vocab["noarea"]             = "Není vybrána ádná oblast";
$vocab["browserlang"]        = "Prohlíec je nastaven k pouití";
$vocab["addroom"]            = "Přidat místnost";
$vocab["capacity"]           = "Kapacita";
$vocab["norooms"]            = "ádná místnost.";
$vocab["administration"]     = "Administrace";

// Used in edit_area_room.php
$vocab["editarea"]           = "Editovat oblast";
$vocab["change"]             = "Změna";
$vocab["backadmin"]          = "Návrat do administrace";
$vocab["editroomarea"]       = "Editovat popis oblasti nebo místnosti";
$vocab["editroom"]           = "Editovat místnosti";
$vocab["update_room_failed"] = "Chyba editace místnosti: ";
$vocab["error_room"]         = "Chyba: místnost ";
$vocab["not_found"]          = " nenalezen";
$vocab["update_area_failed"] = "Chyba editace oblasti: ";
$vocab["error_area"]         = "Chyba: oblast ";
$vocab["room_admin_email"]   = "Email administrátora místnosti";
$vocab["area_admin_email"]   = "Email administrátora oblasti";
$vocab["invalid_email"]      = "patný email!";

// Used in del.php
$vocab["deletefollowing"]    = "Bylo smazáno rezervování";
$vocab["sure"]               = "Jste si jistý?";
$vocab["YES"]                = "ANO";
$vocab["NO"]                 = "NE";
$vocab["delarea"]            = "Musíte smazat vechny místnosti v této oblasti předtím ne ji můete smazat<p>";

// Used in help.php
$vocab["about_mrbs"]         = "O MRBS";
$vocab["database"]           = "Databáze";
$vocab["system"]             = "Systém";
$vocab["please_contact"]     = "Prosím kontaktujte ";
$vocab["for_any_questions"]  = "pokud máte nějaké dalí otázky.";

// Used in mysql.inc AND pgsql.inc
$vocab["failed_connect_db"]  = "Fatalní chyba: Nepodařilo se připojit do databáze";

?>
