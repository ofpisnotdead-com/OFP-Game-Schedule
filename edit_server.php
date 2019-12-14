<?php
require_once "header.php";

// If user wants to add new server or edit existing
if (in_array($form->hidden["display_form"], ["Add New","Edit"]))
{
	// Compile voip software list
	$voice_links_combined = "";
	foreach(GS_VOICE as $program_name=>$program_info)
		$voice_links_combined .= "<a href='{$program_info["info"]}' target='_blank'>$program_name</a>, ";
	$voice_links_combined = substr($voice_links_combined, 0, -2) . ". " . lang("GS_STR_SERVER_VOICE_HINT");
	
	$form->add_text("name"             , lang("GS_STR_SERVER_NAME")      , lang("GS_STR_SERVER_NAME_HINT")      , lang("GS_STR_SERVER_NAME_EXAMPLE"));
	$form->add_text("ip"               , lang("GS_STR_SERVER_ADDRESS")   , lang("GS_STR_SERVER_ADDRESS_HINT")   , "192.168.1.101");
	$form->add_text("port"             , lang("GS_STR_SERVER_PORT")      , lang("GS_STR_SERVER_PORT_HINT")      , "2302");
	$form->add_text("password"         , lang("GS_STR_SERVER_PASSWORD")  , lang("GS_STR_SERVER_PASSWORD_HINT")  , "123", "", 0, "");
	$form->add_text("access"           , lang("GS_STR_SERVER_ACCESSCODE"), lang("GS_STR_SERVER_ACCESSCODE_HINT"), "", "", 0, "");
	$form->add_select("version"        , lang("GS_STR_SERVER_VERSION")   , lang("GS_STR_SERVER_VERSION_HINT")   , [["1.99",1.99], ["1.96",1.96], ["2.01",2.01]]);
	$form->add_select("equalmodreq"    , lang("GS_STR_SERVER_EQUALMODS") , lang("GS_STR_SERVER_EQUALMODS_HINT") , [[lang("GS_STR_DISABLED"),0], [lang("GS_STR_ENABLED"),1]]);	
	$form->add_text("maxcustomfilesize", lang("GS_STR_SERVER_CUSTOMFILE"), lang("GS_STR_SERVER_CUSTOMFILE_HINT"), "102400");
	$form->add_text("languages"        , lang("GS_STR_SERVER_LANGUAGES") , lang("GS_STR_SERVER_LANGUAGES_HINT") , "English, Polski");
	$form->add_text("location"         , lang("GS_STR_SERVER_LOCATION")  , lang("GS_STR_SERVER_LOCATION_HINT")  , "Poland");
	$form->add_text("message"          , lang("GS_STR_SERVER_MESSAGE")   , lang("GS_STR_SERVER_MESSAGE_HINT")   , lang("GS_STR_SERVER_MESSAGE_EXAMPLE"), "", 3);
	$form->add_text("website"          , lang("GS_STR_SERVER_WEBSITE")   , lang("GS_STR_SERVER_WEBSITE_HINT")   , GS_get_current_url(true, false));
	$form->add_text("voice"            , lang("GS_STR_SERVER_VOICE")     , $voice_links_combined                  , "ts3server://192.168.1.101?password=123");
	$form->add_imagefile("logo"        , lang("GS_STR_SERVER_LOGO")      , lang("GS_STR_SERVER_LOGO_HINT")      , GS_LOGO_FOLDER, 10240*2);
	
	
	// If user submitted form
	if (in_array($form->hidden["action"], ["Edit","Add New"])) {
		$data = &$form->save_input();

		if ($data["port"] == "")
			$data["port"] = 0;
		
		$data["website"] = filter_var($data["website"], FILTER_SANITIZE_URL);
		
		if (substr($data["voice"],0,30) == "https://discordapp.com/invite/")
			$data["voice"] = "https://discord.gg/".substr($data["voice"],30);
		
		// Validate user input				
		$form->init_validation     (["max"=>GS_MAX_TXT_INPUT_LENGTH] );
		$form->add_validation_rules(["ip"]                                    , ["required"=>true]);
		$form->add_validation_rules(["message","voice"]                       , ["max"=>GS_MAX_MSG_INPUT_LENGTH]);	
		$form->add_validation_rules(["access"]                                , ["max"=>GS_MAX_CODE_INPUT_LENGTH]);	
		$form->add_validation_rules(["version", "Custom"]                     , ["is_num"=>true]);
		$form->add_validation_rules(["equalmodreq","port","maxcustomfilesize"], ["is_int"=>true]);

		$custom_errors = [];
		if (!empty($data["website"])  &&  !filter_var($data["website"], FILTER_VALIDATE_URL))
			$custom_errors[] = [lang("GS_STR_SERVER_URL_ERROR"), "website"];
		
		$voice_found = false;
		foreach(GS_VOICE as $program_name=>$program_info)
			if (substr($data["voice"],0,strlen($program_info["url"])) == $program_info["url"])
				$voice_found = true;
			
		if (!$voice_found && $date["voice"]!="")
			$custom_errors[] = [lang("GS_STR_SERVER_VOICE_ERROR"), "voice"];


		// Send data to the table
		if ($form->validate($custom_errors, lang("GS_STR_ERROR_FORMDATA"))) {
			$form->upload_image();
			
			$data["modified"]   = date("Y-m-d H:i:s");
			$data["modifiedby"] = $uid;
			
			if ($form->hidden["action"] == "Add New") {
				$data["uniqueid"]  = substr(strtolower(Hash::unique()), rand(0,56), 8);
				$data["createdby"] = $uid;
			}
								
			$data["id"] = $id;
			$result     = $db->insert("gs_serv", $data, true);
			
			$form->keep_image($result);
			$form->feedback(
				$result, 
				lang($form->hidden["action"]=="Add New" ? "GS_STR_SERVER_ADDED" : "GS_STR_SERVER_UPDATED"),
				lang($form->hidden["action"]=="Add New" ? "GS_STR_SERVER_ADDED_ERROR" : "GS_STR_SERVER_UPDATED_ERROR")
			);
			
			if ($result) {
				$form->hidden["display_name"] = $data["name"]!="" ? $data["name"] : $data["ip"];
				
				if ($form->hidden["action"] == "Add New") {
					$id                           = $db->lastId();
					$form->hidden["uniqueid"]     = $data["uniqueid"];
					$form->hidden["display_form"] = "Edit";
					
					$db->insert("gs_serv_admins", ["serverid"=>$id, "userid"=>$uid, "isowner"=>1]);
				}
				
				$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$id, "type"=>($form->hidden["action"]=="Add New" ? GS_LOG_SERVER_ADDED : GS_LOG_SERVER_UPDATED), "added"=>date("Y-m-d H:i:s")]);
			}
		}
	} else
		// If no submit then load data for the selected server
		if ($form->hidden["display_form"] == "Edit")
			if (!$form->load_record("gs_serv", $id)) {
				if ($gs_my_permission_level == GS_PERM_ADMIN)
					echo $sql . $db->errorString();
				$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
			}
	
	if (isset($form->data["port"])  &&  $form->data["port"] == 0)
		$form->data["port"] = "";
		
	$form->add_button("action", $form->hidden["display_form"], lang(GS_FORM_ACTIONS[$form->hidden["display_form"]]), "btn-primary btn-lg");
}	










// If user wants to add/remove playing times
if ($form->hidden["display_form"] == "Schedule") 
{
	$form->size = 9;
	
	// If user wants to remove entries
	if ($form->hidden["action"] == "Cancel") {
		$schedulelist = Input::get("schedulelist");
		
		if (is_array($schedulelist)) {
			$id_list = GS_uniqueid_to_id("gs_serv_times", $schedulelist);
			
			if (!empty($id_list)) {				
				$result = $form->feedback(
					$db->update("gs_serv_times", ["id","IN",$id_list], ["removed"=>true, "modified"=>date("Y-m-d H:i:s"), "modifiedby"=>$uid]), 
					"GS_STR_SERVER_EVENT_REMOVED", 
					"GS_STR_SERVER_EVENT_REMOVED_ERROR",
					"GS_lang"
				);
				
				if ($result)
					foreach($id_list as $item_id)
						$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$item_id, "type"=>GS_LOG_SERVER_EVENT_REMOVED, "added"=>date("Y-m-d H:i:s")]);
			} else 
				$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
		} else
			$form->alert(lang("GS_STR_SERVER_EVENT_NONE_ERROR"));
	}
	
	
	// Query to get all records
	$sql = "
		SELECT 
			gs_serv_times.uniqueid, 
			gs_serv_times.type, 
			gs_serv_times.starttime, 
			gs_serv_times.timezone, 
			gs_serv_times.duration, 
			users.username 
			
		FROM 
			gs_serv_times, 
			users 
			
		WHERE 
			gs_serv_times.serverid = ? AND 
			gs_serv_times.userid   = users.id AND
			gs_serv_times.removed  = 0
			
		ORDER BY 
			gs_serv_times.starttime
	";
	
	if ($db->query($sql,[$id])->error())
		$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));

	$events_count = $db->count();
	
	
	
	

		
	// Set up form
	$user_time_zone   = $user->data()->timezone;
	$tosave_time_zone = $user_time_zone;
	
	// Code for timezone list taken from UserSpice5
	$timezone_select_list = [];
	$regions = [
		'Africa'     => DateTimeZone::AFRICA,
		'America'    => DateTimeZone::AMERICA,
		'Antarctica' => DateTimeZone::ANTARCTICA,
		'Asia'       => DateTimeZone::ASIA,
		'Atlantic'   => DateTimeZone::ATLANTIC,
		'Australia'  => DateTimeZone::AUSTRALIA,
		'Europe'     => DateTimeZone::EUROPE,
		'Indian'     => DateTimeZone::INDIAN,
		'Pacific'    => DateTimeZone::PACIFIC
	];

	foreach ($regions as $region_name=>$mask) {
		$timezone_select_list[] = [$region_name,0,"optgroup"];
		
		foreach(DateTimeZone::listIdentifiers($mask) as $timezone) {
			$time                   = new DateTime(NULL, new DateTimeZone($timezone));
			$timezone_select_list[] = [substr($timezone, strlen($region_name) + 1) . ' - ' . $time->format('H:i'),$timezone];
		}
	}


	$form->include_file("usersc/js/gs_functions.js");

	$form->add_datetime("starttime" , lang("GS_STR_SERVER_EVENT_DATE"));
	$form->add_select("timezone"    , lang("GS_STR_SERVER_EVENT_TIMEZONE"), "", $timezone_select_list, $user_time_zone);
	$form->add_select("type"        , lang("GS_STR_SERVER_EVENT_REPEAT")  , "", [[lang("GS_STR_SERVER_EVENT_REPEAT_SINGLE"),0], [lang("GS_STR_SERVER_EVENT_REPEAT_WEEKLY"),1], [lang("GS_STR_SERVER_EVENT_REPEAT_DAILY"),2]], 0);
	$form->add_text("duration"      , lang("GS_STR_SERVER_EVENT_LENGTH")  , lang("GS_STR_SERVER_EVENT_MINUTES"), "60", 60);
	$form->add_button("action"      , $form->hidden["display_form"]       , lang("GS_STR_INDEX_ADDNEW"), "btn-primary",  "SubmitButton");
	$form->add_button("action"      , "Edit"                              , lang("GS_STR_SERVER_EVENT_EDIT"), "btn-info", "EditButton", "STYLE=\"display:none\"");
	$form->add_space();
	$form->add_select("schedulelist", lang("GS_STR_SERVER_EVENT_CURRENT") , "", [], "", GS_PERMISSION_MAX_SERV_SCHEDULE[$gs_my_permission_level]);
	
	$form->change_control(["ID"=>["SubmitButton","EditButton"]], ["Inline"=>3]);

	
	
	
	
	
	// Save new entry
	if ($form->hidden["action"] != "") {
		if ($events_count < GS_PERMISSION_MAX_SERV_SCHEDULE[$gs_my_permission_level]) {
			$data = &$form->save_input();

			$form->init_validation     ( ["max"=>GS_MAX_TXT_INPUT_LENGTH, "required"=>true], ["schedulelist"] );
			$form->add_validation_rules( ["duration"] , [">"=>0, "is_int"=>true]);
			$form->add_validation_rules( ["type"]     , [">="=>0, "<="=>2] );
			$form->add_validation_rules( ["timezone"] , ["is_timezone"=>true] );
			$form->add_validation_rules( ["starttime"], ["is_datetime"=>true] );
			
			if ($form->validate([], lang("GS_STR_ERROR_FORMDATA"))) {
				$playing_time = [
					"serverid"   => $id,
					"userid"     => $uid,
					"type"       => $data["type"],
					"starttime"  => $data["starttime"],
					"timezone"   => $data["timezone"],
					"duration"   => $data["duration"],
					"modified"   => date("Y-m-d H:i:s"),
					"modifiedby" => $uid
				];

				if ($form->hidden["action"] == "Edit") {					
					if (count($data["schedulelist"]) == 1) {
						$id_list = GS_uniqueid_to_id("gs_serv_times", $data["schedulelist"]);
						
						if (!empty($id_list)) {
							$result = $form->feedback(
								$db->update("gs_serv_times", $id_list[0], $playing_time),
								lang("GS_STR_SERVER_EVENT_UPDATE"),
								lang("GS_STR_SERVER_EVENT_UPDATE_ERROR")
							);
							
							if ($result) {
								$tosave_time_zone = $data["timezone"];
								$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$id_list[0], "type"=>GS_LOG_SERVER_EVENT_UPDATE, "added"=>date("Y-m-d H:i:s")]);
							}
						} else 
							$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
					} else
						$form->alert(lang("GS_STR_SERVER_EVENT_MULTI_ERROR"));
						
					$data = [];
				}

				if ($form->hidden["action"] == "Schedule") {
					$playing_time["uniqueid"]  = substr(strtolower(Hash::unique()), rand(0,56), 8);
					$playing_time["created"]   = date("Y-m-d H:i:s");
					$playing_time["createdby"] = $uid;
					
					$result = $form->feedback(
						$db->insert("gs_serv_times", $playing_time),
						lang("GS_STR_SERVER_EVENT_ADDED"),
						lang("GS_STR_SERVER_EVENT_ADDED_ERROR")
					);
					
					if ($result) {
						$tosave_time_zone = $data["timezone"];
						$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$db->lastId(), "type"=>GS_LOG_SERVER_EVENT_ADDED, "added"=>date("Y-m-d H:i:s")]);
					}
				}
				
				// Save user's timezone	
				if (in_array($form->hidden["action"], ["Schedule","Edit"])  &&  isset($tosave_time_zone)  &&  $tosave_time_zone!=$user_time_zone)
					$db->update("users", $uid, ["timezone"=>$tosave_time_zone]);
				
				// Reload schedule				
				if ($db->query($sql,[$id])->error())
					$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
				
				$events_count = $db->count();
			}
		} else
			$form->alert(lang("GS_STR_SERVER_EVENT_MAX_ERROR"));
	}
	
	
	
	// If schedule is full after insertion then remove controls to add new playing time
	if ($events_count >= GS_PERMISSION_MAX_SERV_SCHEDULE[$gs_my_permission_level]) {
		$form->controls[] = [];
		$form->add_heading(lang("GS_STR_SERVER_EVENT_MAX_ERROR"));
	}

	
	
	
	// Display list of playing times to remove
	if ($events_count > 0) {
		$schedule          = $db->results(true);
		$schedule_select   = [];
		$js_curr_schedule  = ["name"=>"Current_Schedule", "data"=>[]];
		$js_new_array      = "New_Schedule";
		$description_field = "SelectOptionDetails";
		$localized_strings = [
			"Now"     => lang("GS_STR_SERVER_EVENT_NOW"),
			"Expired" => lang("GS_STR_SERVER_EVENT_EXPIRED"),
		];

		// Make a list of options for select
		foreach ($schedule as $item) {
			$start_date = new DateTime($item["starttime"], new DateTimeZone($item["timezone"]));
			$start_day  = $start_date->format("Y.m.d");
			$start_hour = $start_date->format("H:i");
			$iso8601    = $start_date->format('c');
			$for_js     = $start_date->format("jS F (l) Y H:i");
			
			$start_date->add(new DateInterval('PT' . $item["duration"] . 'M'));
			$end_hour   = $start_date->format("H:i");
			
			$typename = lang(["GS_STR_SERVER_EVENT_REPEAT_SINGLE", "GS_STR_SERVER_EVENT_REPEAT_WEEKLY", "GS_STR_SERVER_EVENT_REPEAT_DAILY"][$item["type"]]);
			
			$description       = "$start_day &nbsp;&nbsp; $start_hour - $end_hour &nbsp;&nbsp; $type {$item["username"]} {$item["timezone"]}";
			$schedule_select[] = [$description, $item["uniqueid"]];
			$user_info         = lang("GS_STR_ADDED_BY")." {$item["username"]}";
			
			$js_curr_schedule["data"][] = [
				"type"      => $item["type"], 
				"typename"  => $typename,
				"starttime" => $iso8601, 
				"duration"  => $item["duration"], 
				"uniqueid"  => $item["uniqueid"],
				"timezone"  => $item["timezone"], 
				"user"      => $user_info
			];
		}

		
		$form->change_control("schedulelist", ["Options"=>$schedule_select, "Property"=>"onChange=\"GS_display_info_when_selected(this,'{$form->hidden["display_form"]}',$js_new_array,'$description_field'); GS_make_event_editable(this,$js_new_array,['starttime_input','timezone','type','duration'],'EditButton')\""]);
		$form->add_button("action", "Cancel", lang("GS_STR_SERVER_EVENT_REMOVE"), "btn-warning");
		$form->add_emptyspan($description_field);
		$form->include_file("usersc/js/ru.js");
		$form->add_html("
			<SCRIPT TYPE=\"text/javascript\">
				var {$js_curr_schedule["name"]} = ".json_encode($js_curr_schedule["data"])."
				var $js_new_array = GS_format_event_list({$js_curr_schedule["name"]},'schedulelist',".json_encode($localized_strings).");
			</SCRIPT>");
	} else
		$form->remove_controls_until(["Name"=>"action"]);
}















// If user wants to add/remove mods to the server
if ($form->hidden["display_form"] == "Mods")
{
	// If user wants to remove entries
	if ($form->hidden["action"] == "Discard") {
		$modlist = Input::get("modlist");

		// Build a delete query and run it
		if (is_array($modlist)) {
			$id_list = GS_uniqueid_to_id("gs_serv_mods", $modlist);
			
			if (!empty($id_list)) {
				$result = $form->feedback(
					$db->update("gs_serv_mods", ["id","IN",$id_list], ["removed"=>true, "modified"=>date("Y-m-d H:i:s"), "modifiedby"=>$uid]), 
					"GS_STR_SERVER_MOD_REMOVED",
					"GS_STR_SERVER_MOD_REMOVED_ERROR",
					"GS_lang"
				);
				
				if ($result)
					foreach($id_list as $item_id)
						$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$item_id, "type"=>GS_LOG_SERVER_MOD_REMOVED, "added"=>date("Y-m-d H:i:s")]);
			} else 
				$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
		} else
			$form->alert(lang("GS_STR_SERVER_MOD_NOSEL_ERROR"));
	}


	// Get all records
	$sql_allmods = "
		SELECT 
			gs_mods.id, 
			gs_mods.uniqueid,
			gs_mods.name, 
			gs_mods.description, 
			gs_mods.removed,
			gs_mods.access,
			gs_mods.type,
			gs_serv_mods.id AS gs_serv_mods_id,
			gs_serv_mods.uniqueid AS gs_serv_mods_uniqueid,
			gs_serv_mods.removed AS gs_serv_mods_removed,
			gs_serv_mods.serverid, 
			gs_mods_admins.isowner,
			gs_mods_admins.right_edit,
			gs_mods_admins.right_update
			
		FROM 
			gs_mods LEFT JOIN gs_serv_mods 
				ON gs_mods.id            = gs_serv_mods.modid AND 
				   gs_serv_mods.serverid = ?
				   
				LEFT JOIN gs_mods_admins 
					ON gs_mods.id            = gs_mods_admins.modid AND 
					   gs_mods_admins.userid = ?
					   
		WHERE
			gs_mods.removed = 0 AND (
				gs_mods.access              = 1 OR 
				gs_serv_mods.serverid       = ? OR 
				gs_mods_admins.isowner      = 1 OR 
				gs_mods_admins.right_edit   = 1 OR 
				gs_mods_admins.right_update = 1
			)
					   
		ORDER BY 
			gs_mods.name
	";

	if ($db->query($sql_allmods,[$id,$uid,$id])->error()) {
		if ($gs_my_permission_level == GS_PERM_ADMIN)
			echo $sql . $db->errorString();
		$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
	}
	
	$modfolders    = $db->results(true);
	$modfolders_id = [];
	
	foreach ($modfolders as $key=>$value)
		$modfolders_id[] = $value["id"];
		
	// Get all mod authors
	$sql_authorsmods = "
		SELECT 
			gs_mods.id, 
            users.username
			
		FROM 
			gs_mods JOIN gs_mods_admins 
				ON gs_mods.id = gs_mods_admins.modid 
				
			JOIN users 
				ON gs_mods_admins.userid = users.id
					   
		WHERE
        	gs_mods.id IN (". implode(',', $modfolders_id).") AND
            gs_mods_admins.isowner=1
	";
	
	$db->query($sql_authorsmods);
	$mod_authors = $db->results(true);
	
	foreach ($mod_authors as $key=>$value)
		foreach ($modfolders as $key2=>$value2)
			if ($value["id"] == $value2["id"]) {
				$modfolders[$key2]["Curator"] = $value["username"];
				break;
			}
	
	

	
	// Save new entry
	$mod_to_assign = Input::get("mod_to_assign");
	
	if ($form->hidden["action"] == "Assign" || $mod_to_assign!="") {
		$selected_modfolders = $mod_to_assign!="" ? [$mod_to_assign] : Input::get("modlist");
		
		if (is_array($selected_modfolders)) {
			$selected_modfolders = GS_uniqueid_to_id("gs_mods", $selected_modfolders);
			
			if (!empty($selected_modfolders)) {
				// Check whether the mod was already added and if so then remove it
				$already_existing_mods = [];
				
				foreach ($modfolders as $key=>$value)
					if (isset($value["serverid"]) && $value["gs_serv_mods_removed"]==0)
						$already_existing_mods[] = $value["id"];
							
				for ($i=0; $i<count($selected_modfolders); $i++)
					if (array_search($selected_modfolders[$i], $already_existing_mods) !== FALSE) {
						array_splice($selected_modfolders, $i, 1);
						$i--;
					}
					
				$count_existing = count($already_existing_mods);
				$count_selected = count($selected_modfolders);
					
				if ($count_selected > 0) {
					// Resize array to match the limit
					if ($count_existing + $count_selected > GS_PERMISSION_MAX_SERV_MODS[$gs_my_permission_level]) {
						array_splice($selected_modfolders, GS_PERMISSION_MAX_SERV_MODS[$gs_my_permission_level]-$count_existing);
						$form->alert(lang("GS_STR_SERVER_MOD_MAX_ERROR"));
					}
					
					// Build an insert query
					$fields = [
						"modid"     => [],
						"serverid"  => [],
						"uniqueid"  => [],
						"created"   => [],
						"createdby" => []
					];
					
					foreach ($selected_modfolders as $modID) {
						// Check if mod was already added to this server
						$mod_found = false;
						foreach ($modfolders as $mod_in_db) {
							if ($modID == $mod_in_db["id"] && $id==$mod_in_db["serverid"]) {
								$mod_found          = true;
								$fields["id"]       = intval($mod_in_db["gs_serv_mods_id"]);
								$fields["uniqueid"] = intval($mod_in_db["gs_serv_mods_uniqueid"]);
								$fields["removed"]  = 0;
							}
						}
						
						$fields["modid"][]     = $modID;
						$fields["serverid"][]  = $id;
						$fields["created"][]   = date("Y-m-d H:i:s");
						$fields["createdby"][] = $uid;
						
						if (!$mod_found)
							$fields["uniqueid"][]  = substr(strtolower(Hash::unique()), rand(0,56), 8);
					}
					
					$positive_feedback = "GS_STR_SERVER_MOD_ADDED";
					
					// If adding just one mod then include its name
					if (count($selected_modfolders) == 1)					
						foreach ($modfolders as $key=>$value)
							if ($selected_modfolders[0] == $value["id"])
								$positive_feedback=lang("GS_STR_SERVER_MOD_ADDED_ONE", [$value["name"]]);

					$result = $form->feedback(
						$db->insert("gs_serv_mods", $fields, true), 
						$positive_feedback, 
						"GS_STR_SERVER_MOD_ADDED_ERROR",
						"GS_lang"
					);
					
					if ($result) {
						$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$db->lastId(), "type"=>GS_LOG_SERVER_MOD_ADDED, "added"=>date("Y-m-d H:i:s")]);
						
						// Get all records again
						if ($db->query($sql_allmods,[$id,$uid,$id])->error())
							$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));

						$modfolders    = $db->results(true);
						$modfolders_id = [];
						
						foreach ($modfolders as $key=>$value)
							$modfolders_id[] = $value["id"];
							
						// Get all mod authors
						$sql_authorsmods = "
							SELECT 
								gs_mods.id, 
								users.username
								
							FROM 
								gs_mods JOIN gs_mods_admins 
									ON gs_mods.id = gs_mods_admins.modid 
									
								JOIN users 
									ON gs_mods_admins.userid = users.id
										   
							WHERE
								gs_mods.id IN (". implode(',', $modfolders_id).") AND
								gs_mods_admins.isowner=1
						";
						
						$db->query($sql_authorsmods);
						$mod_authors = $db->results(true);
						
						foreach ($mod_authors as $key=>$value)
							foreach ($modfolders as $key2=>$value2)
								if ($value["id"] == $value2["id"]) {
									$modfolders[$key2]["Curator"] = $value["username"];
									break;
								}
					}
				} else
					$form->alert(lang("GS_STR_SERVER_MOD_ALREADY_ERROR"));
			} else
				$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
		} else
			$form->alert(lang("GS_STR_SERVER_MOD_NOSEL_ERROR"));
	}





	// Sort query results into different lists
	$mod_labels       = [];
	$added_labels     = [];
	$mods_to_add      = [];
	$mods_to_rem      = [];
	$mods_to_rem_sort = [];

	for ($i=0; $i<4; $i++)
		$mod_labels[] = lang("GS_STR_MOD_TYPE{$i}");

	foreach ($mod_labels as $label)
		$mods_to_add[$label] = [];

	foreach ($modfolders as $key=>$value)
		if (!isset($value["serverid"]) || $value["gs_serv_mods_removed"]==1) {
			$label                 = lang("GS_STR_MOD_TYPE{$value["type"]}");
			$mods_to_add[$label][] = $key;
			$added_labels[$label]  = true;
		} else {
			$mods_to_rem[]      = $key;
			$mods_to_rem_sort[] = $value["gs_serv_mods_id"];
		}





	// Display form with a list of mods that can be added	
	if (count($mods_to_rem)>=GS_PERMISSION_MAX_SERV_MODS[$gs_my_permission_level]  ||  empty($added_labels))
		$form->add_heading(count($mods_to_rem)>=GS_PERMISSION_MAX_SERV_MODS[$gs_my_permission_level] ? lang("GS_STR_SERVER_MOD_FULL") : lang("GS_STR_SERVER_MOD_NOTHING"), lang("GS_STR_SERVER_MOD_AVAILABLE"));
	else {
		$form->size = 12;
		$html = "";
		$js_table_list = ["name"=>"Mod_Tables_List", "data"=>[]];
		
		foreach ($mod_labels as $key=>$label) {
			$label_description = "";
			
			for ($i=0; $i<4; $i++)
				if ($label == lang("GS_STR_MOD_TYPE{$i}"))
					$label_description = ucfirst(lang("GS_STR_MOD_TYPE{$i}_DESC"));
			
			$section_name = "mod_table_$key";
			$js_table_list["data"][] = $section_name;
			
			$html .= "
			<div id=\"$section_name\" ".($key!=0 ? "style=\"display:none\"" : "").">
			<h4>$label_description</h4>
			<table class=\"table table-striped table-bordered table-hover\">
				<tr>
					<th>".lang("GS_STR_MOD")."</th>
					<th>".lang("GS_STR_MOD_DESCRIPTION")."</th>
					<th>".lang("GS_STR_MOD_CURATOR")."</th>
					<th>".lang("GS_STR_MOD_PREVIEW_INST")."</th>
					<th></th>
				</tr>
				";
				
			foreach ($mods_to_add[$label] as $i) {
				if (!isset($modfolders[$i]["name"]) || !isset($modfolders[$i]["uniqueid"]))
					continue;
				
				$html .= "
				<tr>
					<td>{$modfolders[$i]["name"]}</td>
					<td>{$modfolders[$i]["description"]}</td>
					<td>{$modfolders[$i]["Curator"]}</td>
					<td><a target='_blank' href=\"show.php?mod={$modfolders[$i]["uniqueid"]}\">{$modfolders[$i]["uniqueid"]}</a></td>
					<td><button type=\"submit\" class=\"btn btn-mods btn-xs\" id=\"mod_to_assign\" name=\"mod_to_assign\" value=\"{$modfolders[$i]["uniqueid"]}\">".lang("GS_STR_SERVER_MOD_ASSIGN")."</button></td>
				</tr>
				";
			}
			
			$html .= "</table></div>";
		}
		
		$form->include_file("usersc/js/gs_functions.js");
		$form->add_js_var($js_table_list);
		$form->add_select("modtype", lang("GS_STR_MOD_TYPE"), "", $mod_labels, "", 0, "onChange=\"GS_display_mod_types_table(this,{$js_table_list["name"]})\"");
		$form->add_space(1);
		$form->add_html($html);
	}
		
		
	// Display list of mods that can be removed
	if (!empty($mods_to_rem)) {
		array_multisort($mods_to_rem_sort, SORT_ASC, $mods_to_rem);
		
		$mods_select       = [];
		$js_mods_list      = ["name"=>"Remove_Mods_List", "data"=>[]];
		$description_field = "ModToRemoveDetails";
		
		foreach ($mods_to_rem as $i) {
			$mods_select[]          = [$modfolders[$i]["name"], $modfolders[$i]["gs_serv_mods_uniqueid"]];
			$js_mods_list["data"][] = $modfolders[$i]["description"]."<BR>".lang("GS_STR_MOD_CURATOR")." {$modfolders[$i]["Curator"]}.<BR><A TARGET='_blank' HREF=show.php?mod={$modfolders[$i]["uniqueid"]}>".lang("GS_STR_MOD_PREVIEW_INST")."</A>";
		}
		
		$form->add_space(2);
		$form->add_js_var($js_mods_list);
		$form->add_select("modlist", lang("GS_STR_SERVER_MOD_CURRENT"), "", $mods_select, "", GS_PERMISSION_MAX_SERV_MODS[$gs_my_permission_level], "onChange=\"GS_display_info_when_selected(this,'{$form->hidden["display_form"]}',{$js_mods_list["name"]},'$description_field')\"");
		$form->add_button("action", "Discard", lang("GS_STR_SERVER_MOD_DISCARD"), "btn-warning");
		$form->add_emptyspan($description_field);
	}
}














// If user wants to grant/revoke access for others
if ($form->hidden["display_form"] == "Share")
	GS_record_sharing($record_type, $record_table, $record_column, $form, $id, $uid, $permission_to, $gs_my_permission_level, $current_entry_owner);

// If user wants to delete server
if ($form->hidden["display_form"] == "Delete") 
	GS_record_delete($record_type, $record_table, $form, $id, $uid);




$section_title = lang(GS_FORM_ACTIONS[$form->hidden["display_form"]]) . " " . lang("GS_STR_SERVER");

switch ($form->hidden["display_form"]) {
	case "Schedule" : $section_title=lang("GS_STR_SERVER_EVENT_TITLE"); break;
	case "Mods"     : $section_title=lang("GS_STR_SERVER_MOD_TITLE"); break;
	case "Share"    : $section_title=lang("GS_STR_SERVER_SHARESERVER_TITLE"); break;
}

require_once "footer.php";
?>