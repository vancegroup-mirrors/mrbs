<?php // -*-mode: PHP; coding:iso-8859-1;-*-

// $Id$

// This file contains PHP code that specifies language specific strings
// The default strings come from lang.en, and anything in a locale
// specific file will overwrite the default. This is a Spanish file.
//
//
//
//
// This file is PHP code. Treat it as such.

// The charset to use in "Content-type" header
$vocab["charset"]            = "iso-8859-1";

// Used in style.inc
$vocab["mrbs"]               = "Sistema de Reservas de Salas de Reuni�n";

// Used in functions.inc
$vocab["report"]             = "Informes";
$vocab["admin"]              = "Administraci�n";
$vocab["help"]               = "Ayuda";
$vocab["search"]             = "B�squeda";
$vocab["not_php3"]           = "ATENCI�N: Puede que esto no funcione con PHP3";

// Used in day.php
$vocab["bookingsfor"]        = "Reservas para el";
$vocab["bookingsforpost"]    = "";
$vocab["areas"]              = "Edificios";
$vocab["daybefore"]          = "D�a Anterior";
$vocab["dayafter"]           = "D�a Siguiente";
$vocab["gototoday"]          = "D�a Actual";
$vocab["goto"]               = "Ir a";
$vocab["highlight_line"]     = "Remarcar esta L�nea";
$vocab["click_to_reserve"]   = "Selecciona una Casilla para hacer una Reserva.";

// Used in trailer.inc
$vocab["viewday"]            = "Ver D�a";
$vocab["viewweek"]           = "Ver Semana";
$vocab["viewmonth"]          = "Ver Mes";
$vocab["ppreview"]           = "Vista Previa";

// Used in edit_entry.php
$vocab["addentry"]           = "Nueva Reserva";
$vocab["editentry"]          = "Editar Reserva";
$vocab["copyentry"]          = "Copiar Reserva";
$vocab["editseries"]         = "Editar Serie";
$vocab["copyseries"]         = "Copiar Serie";
$vocab["namebooker"]         = "Nombre";
$vocab["fulldescription"]    = "Descripci�n Completa:";
$vocab["date"]               = "Fecha";
$vocab["start_date"]         = "Fecha Inicio";
$vocab["end_date"]           = "Fecha Fin";
$vocab["time"]               = "Hora";
$vocab["period"]             = "Periodo";
$vocab["duration"]           = "Duraci�n";
$vocab["seconds"]            = "Segundos";
$vocab["minutes"]            = "Minutos";
$vocab["hours"]              = "Horas";
$vocab["days"]               = "D�as";
$vocab["weeks"]              = "Semanas";
$vocab["years"]              = "Aa�os";
$vocab["periods"]            = "Periodos";
$vocab["all_day"]            = "D�a Completo";
$vocab["type"]               = "Tipo";
$vocab["internal"]           = "Interna";
$vocab["external"]           = "Externa";
$vocab["save"]               = "Salvar";
$vocab["rep_type"]           = "Tipo Repetici�n";
$vocab["rep_type_0"]         = "Ninguna";
$vocab["rep_type_1"]         = "Diaria";
$vocab["rep_type_2"]         = "Semanal";
$vocab["rep_type_3"]         = "Mensual";
$vocab["rep_type_4"]         = "Anual";
$vocab["rep_type_5"]         = "D�a correspondiente del Mes";
$vocab["rep_type_6"]         = "n-Semanal";
$vocab["rep_end_date"]       = "Fecha Tope Repetici�n";
$vocab["rep_rep_day"]        = "D�a Repetici�n";
$vocab["rep_for_weekly"]     = "(Semanal)";
$vocab["rep_freq"]           = "Frecuencia";
$vocab["rep_num_weeks"]      = "N�mero de Semanas";
$vocab["rep_for_nweekly"]    = "(n-Semanas)";
$vocab["ctrl_click"]         = "Usar Control-Click para seleccionar m�s de una Sala";
$vocab["entryid"]            = "ID de Entrada ";
$vocab["repeat_id"]          = "ID de Repetici�n "; 
$vocab["you_have_not_entered"] = "No ha introducido ning�n";
$vocab["you_have_not_selected"] = "No ha seleccionado ning�n";
$vocab["valid_room"]         = "Sala.";$vocab["valid_time_of_day"]  = "Hora V�lida del D�a.";
$vocab["valid_time_of_day"]  = "Hora V�lida del D�a.";
$vocab["brief_description"]  = "Breve Descripci�n.";
$vocab["useful_n-weekly_value"] = "valor �til de n-Semanalmente.";

// Used in view_entry.php
$vocab["description"]        = "Descripci�n";
$vocab["room"]               = "Sala";
$vocab["createdby"]          = "Creada por";
$vocab["lastupdate"]         = "Ultima Actualizaci�n";
$vocab["deleteentry"]        = "Borrar Reserva";
$vocab["deleteseries"]       = "Borrar Serie";
$vocab["confirmdel"]         = "Seguro que desea borrar esta reserva?";
$vocab["returnprev"]         = "Volver a P�gina Anterior";
$vocab["invalid_entry_id"]   = "ID de Entrada Incorrecto.";
$vocab["invalid_series_id"]  = "ID de Serie Incorrecto.";

// Used in edit_entry_handler.php
$vocab["error"]              = "Error";
$vocab["sched_conflict"]     = "Conflicto de Planificaci�n";
$vocab["conflict"]           = "La nueva reserva entra en conflicto con la(s) siguiente(s) entrada(s)";
$vocab["too_may_entrys"]     = "Las opciones seleccionadas crear�n demasiadas entradas.<br>Por favor, revise las opciones";
$vocab["returncal"]          = "Volver a Vista de Calendario";
$vocab["failed_to_acquire"]  = "Error al obtener acceso a la Base de Datos"; 
$vocab["invalid_booking"]    = "Reserva Incorrecta";
$vocab["must_set_description"] = "Debes introducir una breve descripci�n para la Reserva. Por favor, vuelve atr�s e introduce una.";
$vocab["mail_subject_new_entry"]     = "Reserva creada en el MRBS de tu Compa��a";
$vocab["mail_subject_changed_entry"] = "Reserva modificada en el MRBS de tu Compa��a";
$vocab["mail_subject_delete"]        = "Reserva borrada en el MRBS de tu Compa��a";
$vocab["mail_body_new_entry"]     = "Nueva Reserva a�adida, aqu� est�n los detalles:";
$vocab["mail_body_changed_entry"] = "Reserva modificada, aqu� est�n los detalles:";
$vocab["mail_body_del_entry"]     = "Reserva borrada, aqu� est�n los detalles:";

// Authentication stuff
$vocab["accessdenied"]       = "Acceso Denegado";
$vocab["norights"]           = "No tiene autorizaci�n para modificar este dato.";
$vocab["please_login"]       = "Introduzca su Nombre de Usuario";
$vocab["users.name"]          = "Nombre";
$vocab["users.password"]      = "Contrase�a";
$vocab["unknown_user"]       = "Usuario An�nimo";
$vocab["users.level"]         = "Privilegios";
$vocab["you_are"]            = "Hola";
$vocab["login"]              = "Entrar";
$vocab["logoff"]             = "Salir";

// Authentication database
$vocab["user_list"]          = "Lista de Usuarios";
$vocab["edit_user"]          = "Editar Usuario";
$vocab["delete_user"]        = "Borrar este Usuario";
//$vocab["users.name"]         = Use the same as above, for consistency.
//$vocab["users.password"]     = Use the same as above, for consistency.
$vocab["users.email"]         = "Direcci�n de Correo Electr�nico";
$vocab["password_twice"]     = "Si quieres cambiar la contrase�a, por favor teclee la nueva dos veces";
$vocab["passwords_not_eq"]   = "Error: Las contrase�as no son iguales.";
$vocab["add_new_user"]       = "A�adir un Nuevo Usuario";
$vocab["action"]             = "Acciones";
$vocab["user"]               = "Usuario";
$vocab["administrator"]      = "Administrador";
$vocab["unknown"]            = "Desconocido";
$vocab["ok"]                 = "OK";
$vocab["show_my_entries"]    = "Click para mostrar todos mis eventos futuros";
$vocab["no_users_initial"]   = "No hay usuarios en la Base de Datos, permitiendo la creacion del usuario inicial";
$vocab["no_users_create_first_admin"] = "Crea un Usuario con permisos de Administrador y entonces podr�s acceder y crear m�s Usuarios.";

// Used in search.php
$vocab["invalid_search"]     = "Cadena de b�squeda vac�a o incorrecta.";
$vocab["search_results"]     = "Buscar resultados de";
$vocab["nothing_found"]      = "No se encontraron coincidencias.";
$vocab["records"]            = "Registros ";
$vocab["through"]            = " a trav�s ";
$vocab["of"]                 = " de ";
$vocab["previous"]           = "Anterior";
$vocab["next"]               = "Siguiente";
$vocab["entry"]              = "Entrada";
$vocab["view"]               = "Ver";
$vocab["advanced_search"]    = "B�squeda Advanzada";
$vocab["search_button"]      = "B�squeda";
$vocab["search_for"]         = "Buscar por";
$vocab["from"]               = "Desde";

// Used in report.php
$vocab["report_on"]          = "Informe de Reuniones";
$vocab["report_start"]       = "Fecha Inicio";
$vocab["report_end"]         = "Fecha Fin";
$vocab["match_area"]         = "Edificio";
$vocab["match_room"]         = "Sala";
$vocab["match_type"]         = "Tipo de Coincidencia";
$vocab["ctrl_click_type"]    = "Use Control-Click para seleccionar m�s de un Tipo";
$vocab["match_entry"]        = "Descripci�n Breve";
$vocab["match_descr"]        = "Descripci�n Completa";
$vocab["include"]            = "Incluir";
$vocab["report_only"]        = "Solamente Informe";
$vocab["summary_only"]       = "Solamente Resumen";
$vocab["report_and_summary"] = "Informe y Resumen";
$vocab["summarize_by"]       = "Resumir por";
$vocab["sum_by_descrip"]     = "Descripci�n Breve";
$vocab["sum_by_creator"]     = "Creador";
$vocab["entry_found"]        = "registro encontrado";
$vocab["entries_found"]      = "registros encontrados";
$vocab["summary_header"]     = "Resumen de (Registros) Horas";
$vocab["summary_header_per"] = "Resumen de (Entradas) Periodos";
$vocab["total"]              = "Total";
$vocab["submitquery"]        = "Pedir Informe";
$vocab["sort_rep"]           = "Ordenar Informe por";
$vocab["sort_rep_time"]      = "Fecha/Hora de Comienzo";
$vocab["rep_dsp"]            = "Mostrar en Informe";
$vocab["rep_dsp_dur"]        = "Duraci�n";
$vocab["rep_dsp_end"]        = "Hora de Finalizaci�n";

// Used in week.php
$vocab["weekbefore"]         = "Ir a Semana Anterior";
$vocab["weekafter"]          = "Ir a Semana Posterior";
$vocab["gotothisweek"]       = "Ir a Semana Corriente";

// Used in month.php
$vocab["monthbefore"]        = "Ir a Mes Anterior";
$vocab["monthafter"]         = "Ir a Mes Posterior";
$vocab["gotothismonth"]      = "Ir a Mes Corriente";

// Used in {day week month}.php
$vocab["no_rooms_for_area"]  = "No hay Salas definidas para este Edificio";

// Used in admin.php
$vocab["edit"]               = "Editar";
$vocab["delete"]             = "Borrar";
$vocab["rooms"]              = "Salas";
$vocab["in"]                 = "en";
$vocab["noareas"]            = "No hay Edificios";
$vocab["addarea"]            = "Agregar Edificio";
$vocab["name"]               = "Nombre";
$vocab["noarea"]             = "No se seleccion� Edificio";
$vocab["browserlang"]        = "Su navegador est� configurado para usar los siguientes juegos de caracteres";
$vocab["addroom"]            = "Agregar Sala";
$vocab["capacity"]           = "Capacidad (Personas)";
$vocab["norooms"]            = "No hay Salas.";
$vocab["administration"]     = "Administraci�n";

// Used in edit_area_room.php
$vocab["editarea"]           = "Editar Edificio";
$vocab["change"]             = "Cambiar";
$vocab["backadmin"]          = "Volver a Admin";
$vocab["editroomarea"]       = "Editar Descripci�n de Edificio o Sala";
$vocab["editroom"]           = "Editar Sala";
$vocab["update_room_failed"] = "Actualizaci�n de Sala fallida: ";
$vocab["error_room"]         = "Error: Sala ";
$vocab["not_found"]          = " no encontrado";
$vocab["update_area_failed"] = "Actualizaci�n de Edificio fallida: ";
$vocab["error_area"]         = "Error: Edificio ";
$vocab["room_admin_email"]   = "Correo Electr�nico del Administrador de Sala";
$vocab["area_admin_email"]   = "Correo Electr�nico del Administrador de Edificio";
$vocab["invalid_email"]      = "Correo Electr�nico Incorrecto!";

// Used in del.php
$vocab["deletefollowing"]    = "Esto borrar� las siguientes Agendas";
$vocab["sure"]               = "EST� SEGURO?";
$vocab["YES"]                = "S�";
$vocab["NO"]                 = "NO";
$vocab["delarea"]            = "Debe borrar todas las Salas antes de borrar este Edificio<p>";

// Used in help.php
$vocab["about_mrbs"]         = "Acerca de MRBS";
$vocab["database"]           = "Base de Datos";
$vocab["system"]             = "Sistema";
$vocab["please_contact"]     = "Contacte con ";
$vocab["servertime"]         = "Hora del Servidor";
$vocab["for_any_questions"]  = "para cualquier duda.";

// Used in mysql.inc AND pgsql.inc
$vocab["failed_connect_db"]  = "Error: No se pudo conectar a la Base de Datos";

?>
