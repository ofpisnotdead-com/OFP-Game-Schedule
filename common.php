<?php
define("GS_FWATCH_LAST_UPDATE","[2020,1,1,3,16,45,29,387,60,FALSE]");
define("GS_VERSION", 0.5);
define("GS_ENCRYPT_KEY", 0);
define("GS_MODULUS_KEY", 0);
define("GS_DECRYPT_KEY", 0);
define("GS_LOGO_FOLDER", "logo");	// Folder to save uploaded images in
define("GS_OTHER_URL", []);			// Links to other schedule websites
define("GS_SIZE_TYPES", ["KB", "MB", "GB"]);

// Available actions for pages
define("GS_FORM_ACTIONS", [
	"Add New"  => "GS_STR_INDEX_ADDNEW", 
	"Edit"     => "GS_STR_INDEX_EDIT", 
	"Schedule" => "GS_STR_INDEX_SCHEDULE", 
	"Mods"     => "GS_STR_INDEX_MODS", 
	"Share"    => "GS_STR_INDEX_SHARE", 
	"Delete"   => "GS_STR_INDEX_DELETE", 
	"Update"   => "GS_STR_INDEX_UPDATE",
]);

define("GS_FORM_ACTIONS_BY_PAGE", [
	"server" => ["Add New", "Edit", "Schedule", "Mods", "Share", "Delete"],
	"mod"    => ["Add New", "Edit", "Update",           "Share", "Delete"]
]);

define("GS_FORM_ACTIONS_NON_SHAREABLE", ["Add New", "Share", "Delete"]);

define("GS_FORM_ACTIONS_MODUPDATE", [
	"Add"    => "GS_STR_MOD_NEWVER",
	"Edit"   => "GS_STR_MOD_EDITVER",
	"Modify" => "GS_STR_MOD_EDITSCRIPT",
	"Link"   => "GS_STR_MOD_JUMP"
]);

// List of VOIP software
define("GS_VOICE", [
	"TeamSpeak3" => ["url"=>"ts3server://"        , "info"=>"https://support.teamspeakusa.com/index.php?/Knowledgebase/Article/View/46/0/how-can-i-link-to-my-teamspeak-3-server-on-my-webpage", "download"=>"https://teamspeak.com/en/downloads/"],
	"Mumble"     => ["url"=>"mumble://"           , "info"=>"https://wiki.mumble.info/wiki/Mumble_URL"                                                                                         , "download"=>"https://www.mumble.com/mumble-download.php"],
	"Discord"    => ["url"=>"https://discord.gg/" , "info"=>"https://support.discordapp.com/hc/en-us/articles/208866998-Invites-101"                                                           , "download"=>"https://discordapp.com/download"],
	"Steam"      => ["url"=>"https://s.team/chat/", "info"=>"https://steamcommunity.com/updates/chatupdate"                                                                                    , "download"=>"https://store.steampowered.com/about/"]
]);

// Maximal input length
define("GS_MAX_TXT_INPUT_LENGTH"   , 100);
define("GS_MAX_MSG_INPUT_LENGTH"   , 255);
define("GS_MAX_CODE_INPUT_LENGTH"  , 10);
define("GS_MAX_SCRIPT_INPUT_LENGTH", 4096);

// Log codes
define("GS_LOG_UNKNOWN"              , 0);
define("GS_LOG_SERVER_ADDED"         , 1);
define("GS_LOG_SERVER_UPDATED"       , 2);
define("GS_LOG_SERVER_EVENT_REMOVED" , 3);
define("GS_LOG_SERVER_EVENT_UPDATE"  , 4);
define("GS_LOG_SERVER_EVENT_ADDED"   , 5);
define("GS_LOG_SERVER_MOD_REMOVED"   , 6);
define("GS_LOG_SERVER_MOD_ADDED"     , 7);
define("GS_LOG_SERVER_REVOKE_ACCESS" , 8);
define("GS_LOG_MOD_REVOKE_ACCESS"    , 9);
define("GS_LOG_SERVER_SHARE_ACCESS"  , 10);
define("GS_LOG_MOD_SHARE_ACCESS"     , 11);
define("GS_LOG_SERVER_TRANSFER_ADMIN", 12);
define("GS_LOG_MOD_TRANSFER_ADMIN"   , 13);
define("GS_LOG_SERVER_DELETE"        , 14);
define("GS_LOG_MOD_DELETE"           , 15);
define("GS_LOG_MOD_ADDED"            , 16);
define("GS_LOG_MOD_UPDATED"          , 17);
define("GS_LOG_MOD_SCRIPT_UPDATED"   , 18);
define("GS_LOG_MOD_SCRIPT_ADDED"     , 19);
define("GS_LOG_MOD_VERSION_ADDED"    , 20);
define("GS_LOG_MOD_VERSION_UPDATED"  , 21);
define("GS_LOG_MOD_LINK_ADDED"       , 22);
define("GS_LOG_MOD_LINK_UPDATED"     , 23);
define("GS_LOG_MOD_LINK_DELETED"     , 24);
define("GS_LOG_SERVER_MOD_CHANGED"   , 25);

// User permissions
define("GS_PERM_NOUSER",0);
define("GS_PERM_USER",1);
define("GS_PERM_ADMIN", 2);
define("GS_PERM_UNLIMITED", 3);
define("GS_PERM_EXPERIENCED", 4);
define("GS_PERMISSION_LEVELS", [		// Order matters here
	GS_PERM_NOUSER,
	GS_PERM_USER,
	GS_PERM_EXPERIENCED,
	GS_PERM_UNLIMITED,
	GS_PERM_ADMIN
]);

define("GS_PERMISSION_MAX_SERVERS", [
	GS_PERM_NOUSER      => 0,
	GS_PERM_USER        => 4,
	GS_PERM_EXPERIENCED => 10,
	GS_PERM_UNLIMITED   => PHP_INT_MAX,
	GS_PERM_ADMIN       => PHP_INT_MAX
]);
define("GS_PERMISSION_MAX_MODS", GS_PERMISSION_MAX_SERVERS);

define("GS_PERMISSION_MAX_SERV_SCHEDULE", [
	GS_PERM_NOUSER      => 0,
	GS_PERM_USER        => 4,
	GS_PERM_EXPERIENCED => 10,
	GS_PERM_UNLIMITED   => PHP_INT_MAX,
	GS_PERM_ADMIN       => PHP_INT_MAX
]);

define("GS_PERMISSION_MAX_SERV_MODS", [
	GS_PERM_NOUSER      => 0,
	GS_PERM_USER        => 8,
	GS_PERM_EXPERIENCED => 20,
	GS_PERM_UNLIMITED   => PHP_INT_MAX,
	GS_PERM_ADMIN       => PHP_INT_MAX
]);

define("GS_PERMISSION_MAX_SERV_CONTRIBUTORS", [
	GS_PERM_NOUSER      => 0,
	GS_PERM_USER        => 6,
	GS_PERM_EXPERIENCED => 20,
	GS_PERM_UNLIMITED   => PHP_INT_MAX,
	GS_PERM_ADMIN       => PHP_INT_MAX
]);
define("GS_PERMISSION_MAX_MOD_CONTRIBUTORS", GS_PERMISSION_MAX_SERV_CONTRIBUTORS);

$gs_my_permission_level = GS_PERM_NOUSER;

// Check user's permission level
if(isset($user) && $user->isLoggedIn()){
	$sql = "
		SELECT 
			permission_id 
			
		FROM 
			user_permission_matches,
			permissions 
			
		WHERE 
			user_permission_matches.permission_id = permissions.id AND 
			user_permission_matches.user_id       = ?
	";

	if ($db->query($sql,[$user->data()->id])->error()) {
		if ($user->data()->id == 1)
			echo $sql . $db->errorString();
		die(lang("GS_STR_ERROR_GET_DB_RECORD"));
	}

	// Final permission level is the one farthest in the array
	foreach($db->results(true) as $row) {
		$selected = array_search($row["permission_id"], GS_PERMISSION_LEVELS);
		$current  = array_search($gs_my_permission_level, GS_PERMISSION_LEVELS);

		if ($selected > $current)
			$gs_my_permission_level = $row["permission_id"];
	}
}



// Functions
// Format list with installation scripts for html select 
function GS_script_list_to_script_select($script_list, $name, $section) {
	$scripts_select = [];
	
	foreach ($script_list as $sid=>$description) {
		$option_name = "";
		$first_item  = true;
		
		// For a duplicated script id make option name indicate it
		for ($i=0, $max=count($description);  $i<$max;  $i++) {
			if ($first_item) {
				$first_item  = false;
				$option_name = $section!="Modify" ? lang("GS_STR_MOD_SAME_AS")." {$name} " : "";
			}
			else
				$option_name .= " ".lang("GS_STR_MOD_AND")." ";
			
			$option_name .= $description[$i];
			
			if ($i==3  &&  $max>4) {
				$others       = $max - $i - 1;
				$plural       = $others == 1 ? "" : "s";
				$option_name .= " ".lang("GS_STR_MOD_AND")." {$others} other{$plural}";
				break;
			}
		}
		
		$scripts_select[] = [$option_name, $sid];
	}
	
	return $scripts_select;
}

// Convert list of usernames to the list of records id
function GS_username_to_id($userlist, &$userlist_id) {
	$sql = "
		SELECT 
			users.id, 
			users.username 
		FROM 
			users 
		WHERE 
			users.username IN (". substr( str_repeat(",?",count($userlist)), 1) . ")
	";
	
	$db          = DB::getInstance();
	$result      = $db->query($sql, $userlist);
	$success     = false;
	$userlist_id = [];
	
	if ($result) {
		$users = $db->results(true);
		
		foreach ($users as $user)		
			if (array_search($user["username"], $userlist) !== FALSE)
				$userlist_id[] = $user["id"];	
	}
	
	return $userlist_id;
}

// Convert list of uniqueid to the list of records id
function GS_uniqueid_to_id($table_name, $id_list) {
	$output = [];
	
	if (!empty($id_list)) {
		$db  = DB::getInstance();
		$sql = "
			SELECT 
				$table_name.id 
			FROM 
				$table_name 
			WHERE 
				$table_name.uniqueid IN (". substr(str_repeat(",?",count($id_list)), 1) . ")
		";

		if (!$db->query($sql,$id_list)->error())
			foreach($db->results(true) as $row)
				$output[] = $row["id"];
	}
	
	return $output;
}

// Handle form for server/mod sharing
function GS_record_sharing($record_type, $record_table, $record_column, &$form, $id, $uid, $permission_to, $gs_my_permission_level, $current_entry_owner) {
	$db          = DB::getInstance();
	$limit       = $record_type=="server" ? GS_PERMISSION_MAX_SERV_CONTRIBUTORS[$gs_my_permission_level] : GS_PERMISSION_MAX_MOD_CONTRIBUTORS[$gs_my_permission_level];
	$permissions = [];
	$permissions_select = [];

	foreach ($permission_to as $key=>$value)
		if (!in_array($key, GS_FORM_ACTIONS_NON_SHAREABLE)) {
			$permissions[]           = $key;
			$stringtable_key         = str_replace("_INDEX_","_SHARE_",GS_FORM_ACTIONS[$key]);
			$permissions_select[]    = [lang($stringtable_key), $key, "checked"];
		}
	
	if ($current_entry_owner)
		$permissions_select[] = [lang("GS_STR_SHARE_TRANSFER"), "isowner"];

	$checkbox_JS = "GS_limit_permissions_choice('permissions[]');";
	$confirm_msg = lang($record_type == "server" ? "GS_STR_SHARE_TRANSFER_CONFIRM_SERVER" : "GS_STR_SHARE_TRANSFER_CONFIRM_MOD");

	$form->add_select("username", lang("GEN_UNAME"), "", [], "", "datalist", "placeholder=\"bob45\"");
	$form->add_select("permissions", lang("GS_STR_SHARE_PERMISSIONS"), lang("GS_STR_SHARE_TRANSFER_HINT"), $permissions_select, "", "checkbox", "onClick=\"{$checkbox_JS}\"");
	$form->add_button("action", $form->hidden["display_form"], lang("GS_STR_SHARE_GRANT"), "btn-primary", "", "onClick=\"return GS_confirm_transfer_ownership('permissions[]', '{$confirm_msg}')\"");	
	$form->add_html("<script type=\"text/javascript\">{$checkbox_JS}</script>");
	$form->include_file("usersc/js/gs_functions.js");
		
		
	// If user wants to cancel record sharing
	if ($form->hidden["action"] == "Revoke") {
		$userlist = Input::get("userlist");
		
		if (is_array($userlist)) {
			$set = "";
			
			foreach ($permissions as $permission)
				$set .= ", gs_{$record_table}_admins.right_".strtolower($permission)." = 0";

			$userlist_id = GS_username_to_id($userlist, $userlist_id);
			if (!empty($userlist_id)) {
				// Get id of the records that are going to be modificated for logging purposes
				$records_id_list = [];
				$sql = "
					SELECT
						gs_{$record_table}_admins.id
					FROM
						gs_{$record_table}_admins
					WHERE
						gs_{$record_table}_admins.serverid = ? AND
						gs_{$record_table}_admins.userid IN (". substr( str_repeat(",?",count($userlist_id)), 1) . ")
				";
				if (!$db->query($sql, array_merge([$id],$userlist_id))->error())
					foreach($db->results(true) as $row)
						$records_id_list[] = $row["id"];
				
				// Modify table
				$sql      = "
					UPDATE 
						gs_{$record_table}_admins
					JOIN 
						users 				
					ON 
						gs_{$record_table}_admins.userid = users.id AND 
						users.id IN (". substr( str_repeat(",?",count($userlist_id)), 1) . ")

					SET " . substr($set, 1) . " , gs_{$record_table}_admins.modified=?, gs_{$record_table}_admins.modifiedby=?
				";

				$count  = count($userlist_id); /*$db->count() - 1;*/
				
				$sql_arguments   = $userlist_id;
				$sql_arguments[] = date("Y-m-d H:i:s");
				$sql_arguments[] = $uid;

				$result = $form->feedback(
					$db->query($sql, $sql_arguments),
					"GS_STR_SHARE_REMOVED", 
					"GS_STR_SHARE_REMOVED_ERROR",
					"GS_lang",
					[$count]
				);
				
				if ($result)
					foreach($records_id_list as $record_id)
						$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$record_id, "type"=>constant("GS_LOG_".strtoupper($record_type)."_REVOKE_ACCESS"), "added"=>date("Y-m-d H:i:s")]);
			} else 
				$form->alert(lang("GS_STR_SHARE_FIND_USERS_ERROR"));			
		} else
			$form->alert(lang("GS_STR_SHARE_NOSEL_ERROR"));
	}
	
	
	// Find who already has access
	$sql = "
		SELECT
			gs_{$record_table}_admins.*,
			users.username
			
		FROM
			gs_{$record_table}_admins,
			users
			
		WHERE
			gs_{$record_table}_admins.{$record_column}id = ? AND
			gs_{$record_table}_admins.userid             = users.id
			
		ORDER BY
			users.username
	";
	
	if ($db->query($sql,[$id])->error())
		$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));

	$users         = $db->results(true);
	$js_users_perm = ["name"=>"Contributors", "data"=>[]];
	$contributors  = [];

	foreach ($users as $person)
		if ($person["isowner"] == "0")
			foreach ($permissions as $permission)
				if ($person["right_".strtolower($permission)]) {
					$contributors[] = $person["username"];
					$all            = [];
					
					foreach ($permissions as $permission2)
						$all[] = $person["right_".strtolower($permission2)] ? true : false;
					
					$js_users_perm["data"][] = [
						"username"    => $person["username"],
						"permissions" => $all
					];
					break;
				}




	
	
	
	
	
	// If user wants to share server
	if ($form->hidden["action"] == "Share") {
		$data          = &$form->save_input();
		$custom_errors = [];
		$transfer      = false;
		$new_guy       = true;
		
		// If user selected option to transer ownership
		if (in_array("isowner", $data["permissions"])) {
			if (count($data["permissions"]) == 1) {	// all other options must be unchecked
				$transfer = true;
				if (!$current_entry_owner)
					$custom_errors[] = [lang("GS_STR_SHARE_NOTOWNER_ERROR"), "permissions"];
			} else
				$custom_errors[] = [lang("GS_STR_SHARE_TRANSFER_HINT"), "permissions"];
			
			$data["permissions"] = array_diff($data["permissions"], ["isowner"]);	//don't save that input
		}		
		
		$form->init_validation     ( ["max"=>40, "required"=>true] );
		$form->add_validation_rules( ["username"]   , ["min"=>3] );
		$form->add_validation_rules( ["permissions"], ["in"=>$permissions_select, "required"=>empty($custom_errors) && !$transfer] );			

		if ($form->validate($custom_errors, lang("GS_STR_ERROR_FORMDATA")))
		{
			// Create an array for inserting into table db
			$contributor = [
				"{$record_column}id" => $id,
				"userid"             => NULL
			];

			if ($transfer)
				$contributor["isowner"] = 1;
			else
				foreach ($permissions as $permission)
					$contributor["right_".strtolower($permission)] = in_array($permission, $data["permissions"]);
					
			// Find user ID number among existing contributors
			foreach ($users as $person)
				if (isset($data["username"])  &&  strcasecmp($person["username"], $data["username"]) == 0) {
					if ($person["isowner"] == 0) {
						$contributor["id"]	   = $person["id"];
						$contributor["userid"] = $person["userid"];
						$new_guy               = array_search(strtolower($person["username"]), array_map("strtolower",$contributors)) === FALSE;
					} else {
						$new_guy = false;
						$form->alert("{$data["username"]} ".lang("GS_STR_SHARE_ALREADY_ERROR"));
					}
					
					break;
				}
			
			
			// Otherwise search database
			if (isset($data["username"])  &&  !isset($contributor["userid"])  &&  $new_guy)
				if (count($contributors) < $limit) {
					$contributor["userid"] = $db->cell("users.id",["username","LIKE",$data["username"]]);
					
					if (!isset($contributor["userid"]))
						$form->alert(lang("GS_STR_SHARE_FIND_USER_ERROR")); 
				} else
					$form->alert(lang("GS_STR_SHARE_LIMIT_ERROR"));


			// Upload data
			if (isset($contributor["userid"])) {
				$contributor["modified"]   = date("Y-m-d H:i:s");
				$contributor["modifiedby"] = $uid;
				
				if ($new_guy) {
					$contributor["created"]   = date("Y-m-d H:i:s");
					$contributor["createdby"] = $uid;
				}
				
				$result = $db->insert("gs_{$record_table}_admins", $contributor, true);

				$form->feedback(
					$result, 
					($new_guy ? lang("GS_STR_SHARE_GRANTED")." {$data["username"]}" : lang("GS_STR_SHARE_UPDATED")),
					($new_guy ? lang("GS_STR_SHARE_GRANTED_ERROR")                  : lang("GS_STR_SHARE_UPDATED_ERROR"))
				);

				if ($result) {
					$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$db->lastId(), "type"=>constant("GS_LOG_".strtoupper($record_type)."_" . ($transfer ? "TRANSFER_ADMIN" : "SHARE_ACCESS")), "added"=>date("Y-m-d H:i:s")]);
					$data["username"] = "";
					
					if ($transfer) {
						$former_admin_record_id = -1;
						$sql = "
							SELECT
								gs_{$record_table}_admins.id
							FROM
								gs_{$record_table}_admins
							WHERE
								gs_{$record_table}_admins.serverid = ? AND
								gs_{$record_table}_admins.userid IN (". substr( str_repeat(",?",count($userlist_id)), 1) . ")
						";
						if (!$db->query($sql, array_merge([$id],$userlist_id))->error())
							foreach($db->results(true) as $row)
								$records_id_list[] = $row["id"];
						
						
						$former_admin               = ["isowner"=>0];
						$former_admin["modified"]   = date("Y-m-d H:i:s");
						$former_admin["modifiedby"] = $uid;
						
						foreach ($permissions as $permission)
							$former_admin["right_".strtolower($permission)] = false;

						$db->update("gs_{$record_table}_admins", ["and",["userid","=",$uid],["{$record_column}id","=",$id]], $former_admin);
						Redirect::to('index.php');
					} else {
						if ($db->query($sql,[$id])->error())
							$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
						
						$users         = $db->results(true);
						$js_users_perm = ["name"=>"Contributors", "data"=>[]];
						$contributors  = [];
						
						foreach ($users as $person)
							if ($person["isowner"] == "0")
								foreach ($permissions as $permission)
									if ($person["right_".strtolower($permission)]) {
										$contributors[] = $person["username"];
										$all            = [];
										
										foreach ($permissions as $permission2)
											$all[] = $person["right_".strtolower($permission2)] ? true : false;
										
										$js_users_perm["data"][] = [
											"username"    => $person["username"],
											"permissions" => $all
										];
										break;
									}
					}
				}
			}
		}
	}



	
	
	
	
	if (count($contributors) >= $limit) {
		$form->controls = [];
		$form->add_heading(lang("GS_STR_SHARE_LIMIT_ERROR"), "Username");
	}
	
	
	// Display form to remove users
	if (!empty($contributors)) {		
		$form->add_js_var($js_users_perm);
		$form->add_space();
		$form->add_select("userlist", lang("GS_STR_SHARE_CONTRIBUTORS"), "", $contributors, "", $limit, " onChange=\"GS_show_user_permissions('userlist', 'username', 'permissions[]', {$js_users_perm["name"]})\"");
		$form->add_button("action", "Revoke", lang("GS_STR_SHARE_REVOKE"), "btn-warning");
	}
}

// Handle form for server/mod deletion
function GS_record_delete($record_type, $record_table, &$form, $id, $uid) {
	$db = DB::getInstance();
	$record_type_localized = ucfirst(lang("GS_STR_".strtoupper($record_type)));
	
	$form->add_button("action", "Go Back", lang("GS_STR_DELETE_GOBACK"), "btn-success btn-lg");
	
	if ($form->hidden["action"] == "Delete") {
		$result = $db->update("gs_{$record_table}", $id, ["removed"=>true, "modified"=>date("Y-m-d H:i:s"), "modifiedby"=>$uid]);
		
		$form->feedback(
			$result,
			"$record_type_localized " . lang("GS_STR_DELETE_DONE"),
			lang("GS_STR_DELETE_DONE_ERROR")." $record_type_localized"
		);
		
		if ($result)	
			$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$id, "type"=>constant("GS_LOG_".strtoupper($record_type)."_DELETE"), "added"=>date("Y-m-d H:i:s")]);
	} else {
		$form->add_space();
		$form->add_button("action", $form->hidden["display_form"], lang(GS_FORM_ACTIONS[$form->hidden["display_form"]]), "btn-danger btn-sm");
	}
}

// Interpret expression typed by the user (for jumping between mod versions)
function GS_parse_jump_rule($string, $from_version, $to_version) {
	$string     = strtolower(trim($string));
	$max        = strlen($string);
	$lastType   = "";
	$wordStart  = 0;
	$triadStart = 0;
	$i          = 0;
	$triad      = [];
	$comparison = ["==", "=", "!=", "<>", ">", "<", ">=", "<="];
	$logical    = ["and", "or", "&&", "||"];
	$macro      = ["v", "ver", "version"];
	
	if ($max == 0)
		return false;
	
	// For each letter
	while ($i <= $max) {
		$letter = isset($string[$i]) ? $string[$i] : "";
		$type   = "";	
		
			// Handle parentheses ------------------------------
			if ($letter == ")") 
				return "parenthesis closed without being opened at $i: <SPAN STYLE=\"font-family:monospace;\">" . substr($string,0,$i+1) . "</SPAN>";

			if ($letter == "(") {
				$level = 0;

				for ($j=$i;  $j<$max;  $j++) {
					if ($string[$j] == "(")
						$level++;

					if ($string[$j] == ")")
						$level--;
					
					if ($level == 0)
						break;
				}
				
				if ($level == 0) {
					$parenthesis = substr($string, $i+1, $j-$i-1);
					$result      = GS_parse_jump_rule($parenthesis, $from_version, $to_version);
					
					if (is_string($result))
						return $result;
					else
						$result = $result ? "true" : "false";

					$triad      = [];
					$string     = substr_replace($string, $result, $i, $j-$i+1);
					$max        = strlen($string);
					$lastType   = "";
					$i          = 0;
					$wordStart  = 0;
					$triadStart = 0;
					continue;
				} else
					return "parenthesis opened without being closed at $i: <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$i) . "</SPAN>";
			}
			// -------------------------------------------------
		
		
		// Find word type to be able to separate word from other words
		if (ctype_alpha($letter))
			$type = "letter";
		
		if (is_numeric($letter)  ||  in_array($letter,[".","-"]))
			$type = "number";
		
		if (in_array($letter,["<",">","=","!","&","|"]))
			$type = "operator";
		
		
		// Extract word
		if ($lastType != $type) {
			$word = trim(substr($string, $wordStart, $i-$wordStart));

			if (strlen($word)>0  &&  !ctype_space($word)) {
				$triad[] = $word;
				
				if ($lastType=="letter"  &&  !in_array($word,$macro,TRUE)  &&  !in_array($word,$logical,TRUE)  &&  !in_array($word,["true","false"],TRUE))
					return "invalid operand \"$word\" in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
			}

			// When built a full expression
			if (count($triad) == 3) {
				// Replace 'ver' with version number and bools with actual bools
				for ($z=0; $z<3; $z++) {
					if (in_array($triad[$z],$macro,TRUE))
						$triad[$z] = $from_version;
					
					if (in_array($triad[$z],["true","false"],TRUE))
						$triad[$z] = $triad[$z]=="true" ? true : false;
				}
				
				$l  = &$triad[0];
				$op = &$triad[1];
				$r  = &$triad[2];
				
				// If logic operator doesn't have two boolean arguments then keep going
				if (in_array($op, $logical)  &&  (!is_bool($l) || !is_bool($r))) {
					if (!is_bool($l))
						return "left operand must be boolean in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
					else {
						$i          = $wordStart;
						$triadStart = $wordStart;
						$lastType   = "";
						$triad      = [];
						continue;
					}
				}
				
				// Verify numbers
				if (in_array($op,$comparison)) {
					if (!is_numeric($l) || !is_numeric($r))
						return "operands must be numbers in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
					
					if ($l>$to_version  ||  $r>$to_version)
						return "number cannot be larger than $to_version in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
					
					if ($op==">" && $r==$to_version  ||  $op=="<" && $l==$to_version)
						return "comparison going out of range in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
					
					if (in_array($to_version,[$l,$r])  &&  in_array($op,["=","==","<=",">="],TRUE))
						return "number cannot be equal $to_version in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";					
				}
				
				if (in_array($op,$logical)  &&  (!is_bool($l) || !is_bool($r)))
					return "operands must be booleans in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";

				$result = "";
		
				// Evaluate expression
				switch ($op) {
					case "=="  : 
					case "="   : $result=$l == $r; break;
					case "!="  :
					case "<>"  : $result=$l != $r; break;
					case ">"   : $result=$l > $r; break;
					case "<"   : $result=$l < $r; break;
					case ">="  : $result=$l >= $r; break;
					case "<="  : $result=$l <= $r; break;
					case "or"  : 
					case "||"  : $result=$l || $r; break;
					case "and" : 
					case "&&"  : $result=$l && $r; break;
					default    : return "invalid operator $op in <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
				}
				
				// Insert result into string and reset parsing
				$result     = $result ? "true" : "false";
				$string     = substr_replace($string, $result, $triadStart, $i-$triadStart);
				$max        = strlen($string);
				$i          = 0;
				$wordStart  = 0;
				$triadStart = 0;
				$lastType   = "";
				$triad      = [];
				continue;
			} else
				// Finished string - return result
				if ($i >= $max) {
					if (count($triad) == 1) {
						if ($word == "true")
							return true;
						else
							if ($word == "false")
								return false;
					}
							
					return "incomplete expression <SPAN STYLE=\"font-family:monospace;\">" . substr($string,$triadStart,$i-$triadStart) . "</SPAN>";
				}

			// Move on to the next word
			$lastType  = $type;
			$wordStart = $i;
		}
		
		$i++;
	}
}

// https://stackoverflow.com/questions/13740661/validate-windows-filename
function GS_is_valid_windows_filename($filename) {
$regex = <<<'EOREGEX'
~                               # start of regular expression
^                               # Anchor to start of string.
(?!                             # Assert filename is not: CON, PRN, AUX, NUL, COM1, COM2, COM3, COM4, COM5, COM6, COM7, COM8, COM9, LPT1, LPT2, LPT3, LPT4, LPT5, LPT6, LPT7, LPT8, and LPT9.
    (CON|PRN|AUX|NUL|COM[1-9]|LPT[1-9])
    (\.[^.]*)?                  # followed by optional extension
    $                           # and end of string
)                               # End negative lookahead assertion.
[^<>:"/\\|?*\x00-\x1F]*         # Zero or more valid filename chars.
[^<>:"/\\|?*\x00-\x1F\ .]       # Last char is not a space or dot.
$                               # Anchor to end of string.
                                #
                                # tilde = end of regular expression.
                                # i = pattern modifier PCRE_CASELESS. Make the match case insensitive.
                                # x = pattern modifier PCRE_EXTENDED. Allows these comments inside the regex.
                                # D = pattern modifier PCRE_DOLLAR_ENDONLY. A dollar should not match a newline if it is the final character.
~ixD
EOREGEX;

    return preg_match($regex, $filename) === 1;
}

// Convert bytes to a readable text or to an array for the game
function GS_convert_size_in_bytes($bytes, $output_type) {
	if ($bytes == "")
		return "";
	
	$bytes     = intval($bytes);
	$kilobytes = 0;
	$megabytes = 0;
	
	if ($bytes > 1048576) {
		$megabytes  = $bytes / 1048576;
		$megabytes -= fmod($megabytes, 1);
		$bytes     -= $megabytes * 1048576;
	}
	
	if ($bytes > 1024) {
		$kilobytes  = $bytes / 1024;
		$kilobytes -= fmod($kilobytes, 1);
		$bytes     -= $kilobytes * 1024;
	}
	
	if ($output_type == "game")
		return "[$bytes, $kilobytes, $megabytes]";
	
	if ($output_type == "website") {
		$array = [$bytes, $kilobytes, $megabytes];
		$index = 2;
		
		if ($array[2] == 0) 
			$index = 1;
		
		if ($array[1] == 0) 
			$index = 0;
		
		$size = $array[$index];

		if ($index > 0) 
			$size += $array[$index-1] / 1024;
		
		return (round($size, 2) . " " . ["B","KB","M"][$index]);
	}
	
	return "";
}

// Convert date in Fwatch format to a timestamp
function GS_fwatch_date_to_timestamp($input, $output_string=false) {
	$time_array  = explode(",", substr($input, 1, -1));
	$date_object = DateTime::createFromFormat('Y-n-d G:i:s.u', sprintf('%d-%02d-%02d %02d:%02d:%02d.%06d', $time_array[0],$time_array[1],$time_array[2], $time_array[4],$time_array[5],$time_array[6],$time_array[7]));
	
	if ($date_object)
		return $output_string ? $date_object->format('Y-m-d H:i:s') : $date_object->getTimestamp();
	else
		return $output_string ? "" : 0;
}

// https://www.techiedelight.com/rsa-algorithm-implementation-c/
function GS_encrypt($string, $encrypt_key, $modulus_key) {
	if ($encrypt_key==0 ||  $modulus_key==0)
		return $string;
	
	$encrypted = "";
	$letters   = str_split($string);

	foreach($letters as $letter) {
		$letter = ord($letter);
		$result = 1;
		$key    = $encrypt_key;
		
		while($key > 0) {
			if ($key % 2 == 1)
				$result = ($result * ($letter)) % $modulus_key;

			$letter = $letter * $letter % $modulus_key;
			$key    = $key / 2;
		}
		
		if ($encrypted != "")
			$encrypted .= chr(97);
		
		$digits = str_split((string)$result);
		
		foreach($digits as $digit)
			$encrypted .= chr(98 + intval($digit));
	}
	
	return $encrypted;
}

// https://www.techiedelight.com/rsa-algorithm-implementation-c/
function GS_decrypt($string, $decrypt_key, $modulus_key) {
	$numbers = [];
	$words   = explode("a",$string);
	
	foreach($words as $word) {
		$letters = str_split($word);
		$number  = "";
		
		foreach($letters as $letter)
			$number .= ord($letter) - 98;
			
		$numbers[] = intval($number);
	}
	
	foreach($numbers as $number) {
		$number = intval($number);
		$result = 1;
		$key    = $decrypt_key;
		
		while($key > 0) {
			if ($key % 2 == 1)
				$result = ($result * ($number)) % $modulus_key;

			$number = $number * $number % $modulus_key;
			$key    = $key / 2;
		}
		
		$decrypted .= chr($result);
	}
	
	return $decrypted;
}

// List servers with upcoming events
function GS_list_servers($server_id_list, $password, $request_type, $last_modified, $language="English") {
	$output          = ["info"=>[], "mods"=>[], "id"=>[], "lastmodified"=>$last_modified];
	$specific_server = "";
	$ignore_outdated = true;
	
	if (count($server_id_list)==1 && ($server_id_list[0]=="all" || $server_id_list[0]=="current")) {
		if ($server_id_list[0] == "all")
			$ignore_outdated = false;
		
		unset($server_id_list[0]);
	} else {
		$specific_server = "AND gs_serv.uniqueid IN (".substr( str_repeat(",?",count($server_id_list)), 1).")";
		$ignore_outdated = false;
	}
	// Get server list
	$sql = "
		SELECT 
			gs_serv.id,
			gs_serv.name, 
			gs_serv.ip,
			gs_serv.port,
			gs_serv.password,
			gs_serv.version,
			gs_serv.equalmodreq,
			gs_serv.languages,
			gs_serv.location,
			gs_serv.message,
			gs_serv.website,
			gs_serv.logo,
			gs_serv.uniqueid,
			gs_serv.access,
			gs_serv.maxcustomfilesize,
			gs_serv.voice,
			gs_serv.created,
			gs_serv.createdby,
			gs_serv.modifiedby,
			gs_serv.modified AS modified1,
			gs_serv_times.type, 
			gs_serv_times.starttime, 
			gs_serv_times.timezone, 
			gs_serv_times.duration,
			gs_serv_times.modified AS modified2
			
		FROM 
			gs_serv, 
			gs_serv_times 
			
		WHERE 
			gs_serv.id            = gs_serv_times.serverid  AND
			gs_serv.removed       = 0 AND
			gs_serv_times.removed = 0
			$specific_server
			
		ORDER BY 
			gs_serv.name
	";
		
	// Get servers
	$db = DB::getInstance();

	if (!$db->query($sql,$server_id_list)->error()) {
		$last_id    = -1;
		$table_rows = [];
		
		foreach($db->results(true) as $row) {
			$id = $row["id"];
			
			// Required fields
			if ($row["ip"]=="")
				continue;
			
			// Check access code
			if ($row["access"] != "")
				if (array_search($row["access"], $password) === FALSE)
					continue;

			for ($i=1; $i<=2; $i++)
				if (strtotime($row["modified$i"]) > $output["lastmodified"])
					$output["lastmodified"] = strtotime($row["modified$i"]);			
			
			// Check if game time hasn't expired
			$playtime        = "";												// formatted string
			$playtime_array  = [];
			$valid           = false;											// discard or keep
			$time_zone       = new DateTimeZone($row["timezone"]);				// time zone object
			$start_date      = new DateTime($row["starttime"], $time_zone);		// when does the game start
			$start_date_orig = clone $start_date;
			$type            = ["single", "weekly", "daily"][$row["type"]];		// recurrence
			$now             = new DateTime("now", $time_zone);					// get current time
				
			// if it's a recurrent event then I need to update it to the current time because of DST
			if (date_diff($now, $start_date)->format("%R%a") < 0  &&  $type!="single") {				
				$offset = 0;
				
				if ($type=="weekly"  &&  $now->format('w')!=$start_date->format('w')) {
					$now_day   = intval($now->format('w'));
					$start_day = intval($start_date->format('w'));

					if ($start_day > $now_day)
						$offset = $start_day - $now_day;
					else
						$offset = 7 - $now_day + $start_day;
				}

				$start_date->setDate($now->format('Y'), $now->format('m'), $now->format('d'));
				$start_date->modify("+".$offset." day");
			}

			if (date_diff($now, $start_date)->format("%R%a") > -1  ||  $type!="single") {
				$offset = $time_zone -> getOffset($start_date) / 60;		// difference from gmt in minutes
				//$date   = getdate(date_timestamp_get($start_date));		// date object to array
				$valid  = true;
								
				if ($request_type == "game") {
					//$date_orig = getdate(date_timestamp_get($start_date_orig));
					$year     = $start_date_orig->format("Y");
					$month    = $start_date_orig->format("n");
					$day      = $start_date_orig->format("j");
					$dayname  = $start_date_orig->format("w");
					$hours    = $start_date->format("H");
					$minutes  = $start_date->format("i");
					$seconds  = $start_date->format("s");
					$playtime = "[{$row["type"]},[$year,$month,$day,$dayname,$hours,$minutes,$seconds,0,$offset,false],{$row["duration"]}]";
				}
				
				if ($request_type == "website") {
					// Convert date to universal
					$start_date->setTimezone(new DateTimeZone("UTC"));
					
					// Describe event
					$playtime_text   = "";
					$playtime_format = "jS F H:i";
					
					switch($type) {
						case "weekly" : $playtime_text=lang("GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC".$start_date->format("w"))." "; $playtime_format="H:i"; break;
						case "daily"  : $playtime_text=lang("GS_STR_SERVER_EVENT_REPEAT_DAILY_DESC")." "; $playtime_format="H:i"; break;
					}
					
					$playtime_text .= $start_date->format($playtime_format);
					
					$end_date = clone $start_date;
					$end_date->modify("+{$row["duration"]} minute");
					$playtime_text .= $end_date->format(" - H:i T P");
					
					$playtime = [
						"type"        => intval($row["type"]), 
						"date"        => $start_date->getTimestamp(),
						"starttime"   => $start_date->format('c'),
						"duration"    => intval($row["duration"]),
						"description" => $playtime_text
					];
				}
			}

			
			// Add server to list
			if ($last_id != $id   &&   ($valid || !$ignore_outdated)) {
				$last_id                       = $id;
				$output["info"][$id]["events"] = [];
				$output["id"][$id]             = $row["uniqueid"];

				if ($request_type == "game") {
					foreach ($row as $key=>$value) {
						$value     = html_entity_decode($value, ENT_QUOTES);
						$new_value = $value;
						$add_value = $value != "";

						switch ($key) {
							case "uniqueid"          : 
							case "website"           :
							case "message"           : 
							case "location"          : 
							case "name"              : $new_value="\"\"".GS_convert_cyrillic($value, $language!="Russian")."\"\""; break;
							case "equalmodreq"       : $new_value=$value=="1" ? "true" : "false"; break;
							case "version"           : $new_value="$value"; break;
							case "logo"              : $new_value="\"\"".GS_get_current_url(false).GS_LOGO_FOLDER."/{$value}\"\""; break;
							case "maxcustomfilesize" : $new_value=GS_convert_size_in_bytes(intval($value), "game"); break;
							
							case "port"              : if ($value=="0") $add_value=false;
							case "ip"                : 
							case "password"          : $new_value="\"\"".GS_encrypt($value, GS_ENCRYPT_KEY, GS_MODULUS_KEY)."\"\""; break;
							
							case "voice" : {
								$add_value = false;
								$index = 0;
								foreach(GS_VOICE as $program_name=>$program_info) {
									if (substr($value,0,strlen($program_info["url"])) == $program_info["url"]) {
										$new_value = "[$index,\"\"{$program_info["url"]}";
										
										switch ($program_name) {
											case "TeamSpeak3" : {
												$parts = [];
												parse_str(parse_url($value, PHP_URL_QUERY), $parts);
												
												if (isset($parts["password"]))
													$parts["password"] = GS_encrypt($parts["password"], GS_ENCRYPT_KEY, GS_MODULUS_KEY);
												
												if (isset($parts["channelpassword"]))
													$parts["channelpassword"] = GS_encrypt($parts["channelpassword"], GS_ENCRYPT_KEY, GS_MODULUS_KEY);
												
												$new_value .= GS_encrypt(substr(strtok($value,"?"),strlen($program_info["url"])),GS_ENCRYPT_KEY,GS_MODULUS_KEY) . "?" . http_build_query($parts);
											} break;
											
											default : $new_value.=GS_encrypt(substr($value,strlen($program_info["url"])), GS_ENCRYPT_KEY, GS_MODULUS_KEY); break;
										}

										$new_value .= "\"\"]";;
										$add_value = true;
										break;
									}
									
									$index++;
								}
							} break;
							
							case "languages" : {
								$temp_array = explode(", ", $row["languages"]);
								$new_value  = "[";
								
								foreach($temp_array as $item)
									$new_value .= "]+[\"\"".trim($item)."\"\"";
									
								$new_value .= "]";
							} break;
							
							default : $add_value=false; break;
						}
							
						if ($add_value)
							$output["info"][$id]["sqf"] .= "_server_{$key}={$new_value};";
					}
					
					if (GS_ENCRYPT_KEY==0 ||  GS_MODULUS_KEY==0)
						$output["info"][$id]["sqf"] .= "_server_encrypted=false;";
				}
					
				if ($request_type == "website")
					$output["info"][$id] = $row;
			}

			// Add game time to list
			if ($valid)
				$output["info"][$id]["events"][] = $playtime;
		}
	}

	// Get mods assigned to servers
	if (!empty($output["info"])) {
		$sql = "
			SELECT 
				gs_serv.id AS serverid,
				gs_mods.id,
				gs_mods.name,
				gs_mods.uniqueid,
				gs_serv_mods.created

			FROM 
				gs_serv,
				gs_mods, 
				gs_serv_mods 

			WHERE 
				gs_serv.id      = gs_serv_mods.serverid AND
				gs_mods.id      = gs_serv_mods.modid    AND
				gs_serv.removed = 0                     AND
				gs_mods.removed = 0                     AND
				gs_serv_mods.removed = 0                AND
				gs_serv_mods.serverid IN (" . substr( str_repeat(",?",count($output["info"])), 1) . ")

			ORDER BY 
				gs_serv.id, gs_serv_mods.id
		";
	
		if (!$db->query($sql,array_keys($output["info"]))->error()) {
			$last_id    = -1;
			$table_rows = [];
		
			foreach($db->results(true) as $row) {
				if (strtotime($row["created"]) > $output["lastmodified"])
					$output["lastmodified"] = strtotime($row["created"]);
			
				$mod_id  = $row["id"];
				$serv_id = $row["serverid"];

				if ($last_id != $serv_id) {
					$last_id                          = $serv_id;
					$output["info"][$serv_id]["mods"] = [];
				}

				$output["info"][$serv_id]["mods"][] = $mod_id;
				
				if (!in_array($mod_id, $output["mods"]))
					$output["mods"][] = $mod_id;
			}
		}
	}
	
	return $output;
}

// List mods details
function GS_list_mods($mods_id_list, $mods_uniqueid_list, $user_mods_version, $password, $request_type, $last_modified) {
	$output          = ["info"=>[], "id"=>[], "lastmodified"=>$last_modified];
	$mods_links      = [];
	$mods_updates    = [];
	$where_condition = "";
	$argument_list   = [];
	$add_description = false;
	
	if ($request_type == "game_download_mods") {
		$request_type    = "game";
		$add_description = true;
	}

	if (!empty($mods_id_list)) {
		$argument_list    = $mods_id_list;
		$where_condition .= "gs_mods.id IN (".substr( str_repeat(",?",count($mods_id_list)), 1).")";
	}
	
	if (!empty($mods_uniqueid_list)) {
		if ($mods_uniqueid_list[0] == "all")
			$where_condition = "gs_mods.removed=0";
		else {
			$argument_list    = array_merge($argument_list, $mods_uniqueid_list);
			$where_condition .= ($where_condition!="" ? " OR " : "") . "gs_mods.uniqueid IN (".substr( str_repeat(",?",count($mods_uniqueid_list)), 1).")";
		}
	}
	
	if (!empty($where_condition)) {
		$sql = "
			SELECT 
				gs_mods.id,
				gs_mods.name,
				gs_mods.description,
				gs_mods.uniqueid,
				gs_mods.type,
				gs_mods.forcename,
				gs_mods.modified AS modified1,
				gs_mods.created,
				gs_mods.createdby,
				gs_mods.modifiedby,
				gs_mods.access,
				gs_mods_updates.version,
				gs_mods_updates.created AS update_created,
				gs_mods_updates.modified AS modified2,
				gs_mods_updates.changelog,
				gs_mods_scripts.id AS scriptid,
				gs_mods_scripts.size,
				gs_mods_scripts.script,
				gs_mods_scripts.modified AS modified3,
				gs_mods_links.fromver,
				gs_mods_links.removed,
				scripts2.id       AS scriptid2,
				scripts2.size     AS size2,
				scripts2.script   AS script2,
				scripts2.modified AS modified4

			FROM
				gs_mods 
					JOIN gs_mods_updates 
						ON gs_mods.id = gs_mods_updates.modid
                                
					JOIN gs_mods_scripts 
						ON gs_mods_updates.scriptid = gs_mods_scripts.id 
					
					LEFT JOIN gs_mods_links
						ON gs_mods_updates.id = gs_mods_links.updateid
					
					LEFT JOIN gs_mods_scripts scripts2
						ON gs_mods_links.scriptid = scripts2.id
				
			WHERE
				$where_condition
				
			ORDER BY
				gs_mods.name,
				gs_mods_updates.version
			";

		// Request data from db
		$db = DB::getInstance();
		
		if (!$db->query($sql,$argument_list)->error()) {
			$table_rows = $db->results(true);
			
				// First check for private mods
				$private_mods = [];
				
				foreach($table_rows as $row)
					if ($row["access"] == 0 && !in_array($row["id"],$mods_id_list) && !in_array($row["id"],$private_mods))
						$private_mods[] = $row["id"];
				
				// Check if these private mods are used on any servers
				if (!empty($private_mods) && !empty($password)) {
					$sql = "
					SELECT 
						gs_mods.id
						
					FROM 
						gs_serv, 
						gs_mods, 
						gs_serv_mods 

					WHERE 
						gs_serv.id = gs_serv_mods.serverid AND 
						gs_mods.id = gs_serv_mods.modid AND 
						gs_serv.access in (".substr( str_repeat(",?",count($password)), 1).") AND
						gs_mods.id IN (".substr( str_repeat(",?",count($private_mods)), 1).")
					";
					
					// If so then allow to display it
					if (!$db->query($sql,array_merge($password,$private_mods))->error())
						foreach($db->results(true) as $row)
							$private_mods = array_diff($private_mods, $row["id"]);
				}

			// Copy table rows to arrays
			$last_id      = -1;
			$last_version = 0;	
			
			foreach($table_rows as $row) {
				$id      = $row["id"];
				$version = $row["version"];
				
				if ($row["access"] == 0)
					if (in_array($id,$private_mods))
						continue;

				if ($last_id != $id) {
					if ($request_type == "game") {
						$output["info"][$id]["sqf"]    = "_mod_name=\"\"{$row["name"]}\"\";_mod_forcename=".($row["forcename"]=="1" ? "true" : "false").";";
						$output["info"][$id]["script"] = "begin_mod {$row["name"]} {$row["uniqueid"]} {$row["forcename"]}";
						
						if ($add_description)
							$output["info"][$id]["sqf"] .= "_mod_description=\"\"".strip_tags($row["description"])."\"\";";
					}

					$output["id"][$id] = $row["uniqueid"];
					$mods_links[$id]   = [];
					$last_id           = $id;
					$last_version      = 0;
				}

				for ($i=1; $i<=4; $i++)
					if (strtotime($row["modified$i"]) > $output["lastmodified"])
						$output["lastmodified"] = strtotime($row["modified$i"]);

				if (isset($row["fromver"])) {
					$columns_to_copy = ["fromver", "version", "scriptid2", "size2", "script2", "removed"];
					$link_num        = count($mods_links[$id]);
					
					foreach($columns_to_copy as $column)
						$mods_links[$id][$link_num][$column] = $request_type=="game" ? html_entity_decode($row[$column], ENT_QUOTES) : $row[$column];
				}

				if ($last_version != $version) {
					$last_version    = $version;
					$columns_to_copy = ["version", "scriptid", "size", "script", "update_created", "changelog"];
					$update_num      = count($mods_updates[$id]);
					
					foreach($columns_to_copy as $column)
						$mods_updates[$id][$update_num][$column] = $request_type=="game" ? html_entity_decode($row[$column], ENT_QUOTES) : $row[$column];
				}
				
				if ($request_type == "website") {
					$output["info"][$id]["name"]        = $row["name"];
					$output["info"][$id]["description"] = $row["description"];
					$output["info"][$id]["version"]     = $version;
					$output["info"][$id]["uniqueid"]    = $row["uniqueid"];
					$output["info"][$id]["forcename"]   = $row["forcename"] == "1" ? "true" : "false";
					$output["info"][$id]["type"]        = $row["type"];
					$output["info"][$id]["createdby"]   = $row["createdby"];
					$output["info"][$id]["modifiedby"]  = $row["modifiedby"];
					$output["info"][$id]["created"]     = $row["created"];
					$output["info"][$id]["modified"]    = $row["modified1"];
				}
			}
		}

		// For every mod
		foreach ($mods_updates as $id=>$updates) {
			$input_version = 0;
			
			if (array_key_exists($output["id"][$id], $user_mods_version))
				$input_version = $user_mods_version[$output["id"][$id]];
			
			$output["info"][$id]["updates"] = [];
			$current_version                = $input_version;
			$temp_scripts_id                = [];
			$dates                          = [];
			$download_size                  = [0   , 0   , 0   ];
			$download_size_unit             = ["gb", "mb", "kb"];
			
			if ($request_type == "website")
				$output["info"][$id]["installversion"] = $current_version;

			// Go through every version of this mod
			foreach ($updates as $update_num=>$update) {
				$toversion = $update["version"];
				$script_id = $update["scriptid"];
				$size      = $update["size"];
				$script    = $update["script"];
				$date      = $update["update_created"];
				$changelog = nl2br(htmlspecialchars($update["changelog"]));

				if ($update_num==0 && $input_onlylog && $changelog=="")
					$changelog = "First release";

				// Look for a valid jump between versions
				foreach ($mods_links[$id] as $link) {
					if (!$link["removed"]) {
						$parse_result = GS_parse_jump_rule($link["fromver"], $current_version, $link["version"]);

						if ($parse_result === TRUE) {
							$toversion = $link["version"];
							$script_id = $link["scriptid2"];
							$size      = $link["size2"];
							$script    = $link["script2"];
							break;
						}
					}
				}

				// Add version details to the array
				$update_index = false;

				// If update is going sequentially then current version is smaller than update version - add info from the update
				if ($current_version < $toversion) {
					$current_version = $toversion;
					$size_array      = explode(' ', $size);

					// If script is not duplicated then add it
					if (!in_array($script_id,$temp_scripts_id)) {
						$temp_scripts_id[] = $script_id;
						$output["info"][$id]["updates"][] = ["version"=>$toversion, "date"=>$date, "script"=>$script];

						if (count($size_array) > 1) {
							$size_number = floatval($size_array[0]);
							$size_unit   = strtolower($size_array[1]);
							$index_unit  = array_search($size_unit, $download_size_unit);

							if ($index_unit !== FALSE)
								$download_size[$index_unit] += $size_number;
						}
					} else {
						// If script is duplicated then find update that uses this script and change its version number and date
						$update_index = array_search($script_id, $temp_scripts_id);
						
						for ($i=count($temp_scripts_id)-1; $i>=0 && $script_id == $temp_scripts_id[$i]; $i--) {
							$output["info"][$id]["updates"][$i]["version"] = $current_version;
							$output["info"][$id]["updates"][$i]["date"]    = $date;
						}
					}
				} else {
					// If a jump was made then current version is higher than the update version - add all info from the "smaller" updates to the last item in the array
					if (!empty($output["info"][$id]["updates"]))
						$update_index = count($output["info"][$id]["updates"])-1;
				}

				// Add patch notes for every version above input mod version			
				if ($request_type=="website"  &&  ($input_version==0 || $toversion>$input_version)) {

					// If there was a jump or script was duplicated then add to the existing array (and refresh date)
					if ($update_index !== FALSE)
						$output["info"][$id]["updates"][$update_index]["date"] = $date;
					else
						// otherwise add to the last array
						$update_index = !empty($output["info"][$id]["updates"]) ? count($output["info"][$id]["updates"])-1 : 0;

					$output["info"][$id]["updates"][$update_index]["note"][]         = $changelog;
					$output["info"][$id]["updates"][$update_index]["note_date"][]    = $date;
					$output["info"][$id]["updates"][$update_index]["note_version"][] = $update["version"];
				}
			}

			// Format download size to a readable text
			$formatted_download_size = "0 KB";
			
			if ($download_size[2] > 1024) {
				$full_megs         = $download_size[2] / 1024;
				$download_size[1] += $full_megs;
				$download_size[0] -= $full_megs  * 1024;
			}
			
			if ($download_size[1] > 1024) {
				$full_gigs         = $download_size[1] / 1024;
				$download_size[0] += $full_gigs;
				$download_size[1] -= $full_gigs  * 1024;
			}
			
			if ($download_size[0] > 0) {
				$download_size[0]        += $download_size[1]/1024 + $download_size[2]/1048576;
				$formatted_download_size  = floatval(sprintf("%01.1f", $download_size[0])) . " GB";
			} 
			else
				if ($download_size[1] > 0) {
					$download_size[1]        += $download_size[2]/1024;
					$formatted_download_size  = floatval(sprintf("%01.0f", $download_size[1])) . " MB";
				}
				else
					if ($download_size[2] > 0)
						$formatted_download_size = floatval(sprintf("%01.0f", $download_size[2])) . " KB";
			
			if ($request_type == "website") {
				$output["info"][$id]["size"]      = $formatted_download_size;
				$output["info"][$id]["sizearray"] = "[" . implode(",", $download_size) . "]";			
			}

			if ($request_type == "game") {
				$output["info"][$id]["sqf"]    .= "_mod_version={$current_version};_mod_size=\"\"{$formatted_download_size}\"\";_mod_sizearray=[" . implode(",",$download_size) . "];";
				$output["info"][$id]["version"] = $current_version;
				
				for ($i=0; $i<count($output["info"][$id]["updates"]); $i++)
					$output["info"][$id]["script"] .= "\nbegin_ver {$output["info"][$id]["updates"][$i]["version"]} ".strtotime($output["info"][$id]["updates"][$i]["date"])."\n" . $output["info"][$id]["updates"][$i]["script"];
			}
		}
	}
	
	return $output;
}

// Handle url query string
function GS_get_common_input() {
	$input      = ["modver"=>[]];
	$input_keys = ["server", "mod", "ver", "password", "listid"];

	foreach($input_keys as $key)
		$input[$key] = isset($_GET[$key]) ? explode(",",$_GET[$key]) : [];

	foreach($input["mod"] as $key=>$value)
		$input["modver"][$value] = isset($input["ver"][$key]) ? $input["ver"][$key] : 0;		
	
	return $input;
}

// Get current domain and folder
function GS_get_current_url($add_https=true, $add_path=true) {
	$path = $_SERVER['REQUEST_URI'];
	$pos  = strrpos($path, "/");
	
	if ($pos !== false)
		$path = substr($path, 0, $pos);

	return "http" . ($add_https && isset($_SERVER['HTTPS']) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . ($add_path ? "$path/" : "");
}

// Read array with servers and output html
function GS_format_server_info(&$servers, &$mods, $box_size, $extended_info=false, $server_order=[]) {
	$html         = "";
	$js_starttime = [];
	$js_duration  = [];
	$js_type      = [];
	$user_list    = [];
	$js_addedon   = [];
	
	// Get user list first
	if ($extended_info) {
		$user_id_list = [];
		
		foreach ($servers["info"] as $server_id=>$server)
			$user_id_list[] = $server["createdby"];
			
		$db  = DB::getInstance();
		$sql = "SELECT users.username, users.id FROM users WHERE users.id IN (". substr(str_repeat(",?",count($user_id_list)), 1) . ")";

		if (!$db->query($sql,$user_id_list)->error())
			foreach($db->results(true) as $row)
				$user_list[$row["id"]] = $row["username"];
	}
	
	if (count($server_order) == 0)
		$server_order = $servers["id"];

	foreach($server_order as $uniqueid) {
		$id = array_search($uniqueid, $servers["id"]);
		if ($id === FALSE)
			continue;

		$server            = $servers["info"][$id];
		$server_name       = empty($server["name"]) ? $server["uniqueid"] : $server["name"];
		$current_starttime = [];
		$current_duration  = [];
		$current_type      = [];
		
		$html .= "
		<div class=\"col-lg-$box_size\">
			<div class=\"panel panel-default\">
				<div class=\"panel-body servers_background\" style=\"display:flex;\">
					<div style=\"flex-grow:2\">
					<h2 style=\"margin-top:0;\">$server_name</h2>
					<dl class=\"row\" style=\"margin-bottom:0;\">
		";
		
		$keys = [
			"version"           => lang("GS_STR_SERVER_VERSION"),
			"modfolders"        => lang("GS_STR_SERVER_MODS"),
			"maxcustomfilesize" => lang("GS_STR_SERVER_CUSTOMFILE"),
			"game time"         => lang("GS_STR_SERVER_GAMETIME"),
			"languages"         => lang("GS_STR_SERVER_LANGUAGES"),
			"location"          => lang("GS_STR_SERVER_LOCATION"), 
			"voice"				=> lang("GS_STR_SERVER_VOICE_SOFT"),
			"website"           => lang("GS_STR_SERVER_WEBSITE"), 
			"message"           => lang("GS_STR_SERVER_MESSAGE"),
			"access"            => lang("GS_STR_SERVER_ACCESSCODE")
		];

		foreach ($keys as $key=>$name) {
			$value    = "";
			$dd_class = "";
			
			switch($key) {
				case "maxcustomfilesize" : {
					$value = GS_convert_size_in_bytes(intval($server[$key]), "website");
				} break;
				
				case "website" : {
					if (!empty($server[$key])) {
						$domain = parse_url($server[$key])["host"];
						
						if (substr($domain,0,4) == "www." )
							$domain = substr($domain,4);
						
						$value = "<a href=\"{$server[$key]}\" target=\"_blank\">$domain</a>";
					}
				} break;
				
				case "modfolders" : {
					$mod_list_links = [];
					
					foreach ($server["mods"] as $id) {
						$version          = $mods["info"][$id]["version"]!=1 ? " &nbsp; v{$mods["info"][$id]["version"]}" : "";
						$mod_list_links[] = "<a href=\"show.php?mod={$mods["info"][$id]["uniqueid"]}\" target=\"_blank\">{$mods["info"][$id]["name"]}</a> &nbsp; <span style=\"font-size:70%;\">{$mods["info"][$id]["size"]}{$version}</span>";
					}
					
					$value = implode("<br>",$mod_list_links);
				} break;
				
				case "game time" : {
					$dd_class = "servergametime";
					foreach ($server["events"] as $event) {
						$value .= (empty($value) ? "" : "<br>") . $event["description"];
						$current_starttime[] = $event["starttime"];
						$current_duration[]  = $event["duration"];
						$current_type[]      = $event["type"];
					}
				} break;
				
				case "voice" : {
					foreach(GS_VOICE as $program_name=>$program_info)
						if (substr($server["voice"],0,strlen($program_info["url"])) == $program_info["url"])
							$value = "<a href=\"{$program_info["download"]}\">$program_name</a>";
				} break;
				
				default: $value=$server[$key];
			}
			
			if (!empty($value))
				$html .= "<dt>{$name}:</dt><dd".($dd_class!="" ? " class=\"$dd_class\"" : "").">{$value}</dd>";
		}
		
		$js_starttime[] = $current_starttime;
		$js_duration[]  = $current_duration;
		$js_type[]      = $current_type;
		
		$html .= "</dl>";

		if (isset($user_list[$server["createdby"]])) {
			$js_addedon[] = date("c",strtotime($server["created"]));
			$html .= "<span style=\"float:right;\">".lang("GS_STR_ADDED_BY_ON",[$user_list[$server["createdby"]],"<span class=\"server_addedon\">".date("jS M Y",strtotime($server["created"]))."</span>"])."</span>";
		}
		
		$html .= "</div>
		<div>
			
			<a href=\"show.php?server={$server["uniqueid"]}\"><span class=\"glyphicon glyphicon-link\"></span></a>
			<br>
			<a href=\"rss.php?server={$server["uniqueid"]}\"><span class=\"fa fa-rss\"></span></a>
		</div>
		
		</div></div></div>";
	}
	
	$locale_file = "en-gb";
	
	switch(lang("THIS_CODE")) {
		case "ru-RU" : $locale_file="ru"; break;
	}

	$localized_strings = [
		"Daily" => "GS_STR_SERVER_EVENT_REPEAT_DAILY_DESC",
		"0"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC0",
		"1"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC1",
		"2"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC2",
		"3"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC3",
		"4"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC4",
		"5"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC5",
		"6"     => "GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC6"
	];
	
	foreach($localized_strings as $key=>$value)
		$localized_strings[$key] = lang($value);
		
	$html .= "
	<script type=\"text/javascript\" src=\"usersc/js/gs_functions.js\"></script>
	<script type=\"text/javascript\" src=\"usersc/js/moment.js\"></script>
	<script type=\"text/javascript\" src=\"usersc/js/{$locale_file}.js\"></script>
	<script type=\"text/javascript\">
		GS_convert_server_events(".json_encode($js_starttime).",".json_encode($js_duration).",".json_encode($js_type).",".json_encode($localized_strings).");
		GS_convert_addedon_date('server_addedon',".json_encode($js_addedon).");
	</script>
	";
		
	return $html;
}

// Get and format data from the log table
function GS_get_activity_log($limit, $exclude_type, $show_private, $input=[]) {
	$db      = DB::getInstance();
	$max     = $db->cell("gs_log.count(*)");
	$offset  = 0;
	$buffer  = 100;
	$output  = [];
	$last_id = -1;
	
	$detailed_server_mod_change = !in_array(GS_LOG_SERVER_MOD_CHANGED, $exclude_type);
	
	if (!isset($max))
		return $output;

	while($offset < $max && count($output)<$limit) {
		$sql = "SELECT * FROM gs_log";
		
		if (!empty($exclude_type))
			$sql .= " WHERE gs_log.type NOT IN (". substr( str_repeat(",?",count($exclude_type)), 1) . ")";
		
		$sql .= " ORDER BY ID DESC LIMIT $offset, $buffer";
		
		$logs    = $db->query($sql,$exclude_type)->results(true);
		$offset += $buffer;
		
		if ($db->error())
			return $output;

		$data = [	
			"gs_serv_times"   => [],
			"gs_serv_mods"    => [],
			"gs_serv_admins"  => [],
			"gs_serv"         => [],
			"gs_mods_links"   => [],
			"gs_mods_updates" => [],
			"gs_mods_admins"  => [],
			"gs_mods_scripts" => [],
			"gs_mods"         => [],
			"users"           => []
		];

		// First pass - determine what records from other tables we need to get
		foreach ($logs as $log) {
			$array = "";
				
			switch($log["type"]) {
				case GS_LOG_SERVER_ADDED          : 
				case GS_LOG_SERVER_UPDATED        :
				case GS_LOG_SERVER_DELETE         : $array="gs_serv"; break;
				case GS_LOG_SERVER_EVENT_REMOVED  :
				case GS_LOG_SERVER_EVENT_UPDATE   :
				case GS_LOG_SERVER_EVENT_ADDED    : $array="gs_serv_times"; break;
				case GS_LOG_SERVER_MOD_ADDED      :
				case GS_LOG_SERVER_MOD_REMOVED    : $array="gs_serv_mods"; break;
				case GS_LOG_SERVER_REVOKE_ACCESS  :
				case GS_LOG_SERVER_SHARE_ACCESS   :
				case GS_LOG_SERVER_TRANSFER_ADMIN : $array="gs_serv_admins"; break;
				case GS_LOG_MOD_REVOKE_ACCESS     :
				case GS_LOG_MOD_SHARE_ACCESS      :
				case GS_LOG_MOD_TRANSFER_ADMIN    : $array="gs_mods_admins"; break;
				case GS_LOG_MOD_ADDED             : 
				case GS_LOG_MOD_UPDATED           : 
				case GS_LOG_MOD_DELETE            : $array="gs_mods"; break;
				case GS_LOG_MOD_SCRIPT_ADDED      : 
				case GS_LOG_MOD_SCRIPT_UPDATED    : $array="gs_mods_scripts"; break;
				case GS_LOG_MOD_VERSION_ADDED     : 
				case GS_LOG_MOD_VERSION_UPDATED   : $array="gs_mods_updates"; break;
				case GS_LOG_MOD_LINK_ADDED        : 
				case GS_LOG_MOD_LINK_DELETED      :
				case GS_LOG_MOD_LINK_UPDATED      : $array="gs_mods_links"; break;
				default                           : $array=""; break;
			}
			
			if ($array != "")
				$data[$array][$log["itemid"]] = [];
				
			$data["users"][$log["userid"]] = [];
		}

		foreach(array_keys($data) as $array) {
			$script_list_id = [];
			
			switch($array) {
				case "gs_mods_links"   : 
				case "gs_mods_updates" : $script_list_id=array_keys($data["gs_mods_scripts"]); break;
			}
			
			if (!empty($data[$array]) || !empty($script_list_id)) {
				$sql = "SELECT id";
				$columns = "";
				
				switch($array) {
					case "users"           : $columns=["username"]; break;
					case "gs_serv"         : $columns=["name","uniqueid","access"]; break;
					case "gs_serv_times"   : $columns=["serverid","starttime","duration","type","timezone"]; break;
					case "gs_serv_mods"    : $columns=["serverid","modid"]; break;
					case "gs_serv_admins"  : $columns=["serverid","userid"]; break;
					case "gs_mods"         : $columns=["name","access","uniqueid"]; break;
					case "gs_mods_scripts" : $columns=["size"]; break;
					case "gs_mods_updates" : $columns=["modid","scriptid","version","changelog"]; break;
					case "gs_mods_links"   : $columns=["updateid","scriptid","fromver"]; break;
					case "gs_mods_admins"  : $columns=["modid","userid"]; break;
				}
				
				foreach($columns as $column)
					$sql .= ",$array.$column";
					
				$sql .= " FROM $array WHERE ";
				
				if (!empty($data[$array]))
					$sql .= "$array.id in (". substr( str_repeat(",?",count($data[$array])), 1) . ") OR ";
				
				if (!empty($script_list_id))
					$sql .= "$array.scriptid in (". substr( str_repeat(",?",count($script_list_id)), 1) . ") OR ";
				$sql = substr($sql, 0, strlen($sql)-3);

				$db->query($sql,array_merge(array_keys($data[$array]),$script_list_id));

				foreach($db->results(true) as $row) {
					$data[$array][$row["id"]] = $row;
					
					switch($array) {
						case "gs_serv_times"   : $data["gs_serv"][$row["serverid"]]=[]; break;
						case "gs_serv_mods"    : $data["gs_serv"][$row["serverid"]]=[]; $data["gs_mods"][$row["modid"]]=[]; break;
						case "gs_serv_admins"  : $data["gs_serv"][$row["serverid"]]=[]; $data["users"][$row["userid"]]=[]; break;
						case "gs_mods_admins"  : $data["gs_mods"][$row["modid"]]=[]; $data["users"][$row["userid"]]=[]; break;
						case "gs_mods_updates" : $data["gs_mods"][$row["modid"]]=[]; $data["gs_mods_scripts"][$row["scriptid"]]=[]; break;
						case "gs_mods_links"   : $data["gs_mods_updates"][$row["updateid"]]=[]; $data["gs_mods_scripts"][$row["scriptid"]]=[]; break;
					}
				}
			}
		}

		$operation_names = [
			GS_LOG_SERVER_ADDED          => "GS_STR_LOG_SERVER_ADDED",
			GS_LOG_SERVER_UPDATED        => "GS_STR_LOG_SERVER_UPDATED",
			GS_LOG_SERVER_EVENT_REMOVED  => "GS_STR_LOG_SERVER_EVENT_REMOVED",
			GS_LOG_SERVER_EVENT_UPDATE   => "GS_STR_LOG_SERVER_EVENT_UPDATE",
			GS_LOG_SERVER_EVENT_ADDED    => "GS_STR_LOG_SERVER_EVENT_ADDED",
			GS_LOG_SERVER_MOD_REMOVED    => "GS_STR_LOG_SERVER_MOD_REMOVED",
			GS_LOG_SERVER_MOD_ADDED      => "GS_STR_LOG_SERVER_MOD_ADDED",
			GS_LOG_SERVER_REVOKE_ACCESS  => "GS_STR_LOG_SERVER_REVOKE_ACCESS",
			GS_LOG_MOD_REVOKE_ACCESS     => "GS_STR_LOG_MOD_REVOKE_ACCESS",
			GS_LOG_SERVER_SHARE_ACCESS   => "GS_STR_LOG_SERVER_SHARE_ACCESS",
			GS_LOG_MOD_SHARE_ACCESS      => "GS_STR_LOG_MOD_SHARE_ACCESS",
			GS_LOG_SERVER_TRANSFER_ADMIN => "GS_STR_LOG_SERVER_TRANSFER_ADMIN",
			GS_LOG_MOD_TRANSFER_ADMIN    => "GS_STR_LOG_MOD_TRANSFER_ADMIN",
			GS_LOG_SERVER_DELETE         => "GS_STR_LOG_SERVER_DELETE",
			GS_LOG_MOD_DELETE            => "GS_STR_LOG_MOD_DELETE",
			GS_LOG_MOD_ADDED             => "GS_STR_LOG_MOD_ADDED",
			GS_LOG_MOD_UPDATED           => "GS_STR_LOG_MOD_UPDATED",
			GS_LOG_MOD_SCRIPT_UPDATED    => "GS_STR_LOG_MOD_SCRIPT_UPDATED",
			GS_LOG_MOD_SCRIPT_ADDED      => "GS_STR_LOG_MOD_SCRIPT_ADDED",
			GS_LOG_MOD_VERSION_ADDED     => "GS_STR_LOG_MOD_VERSION_ADDED",
			GS_LOG_MOD_VERSION_UPDATED   => "GS_STR_LOG_MOD_VERSION_UPDATED",
			GS_LOG_MOD_LINK_ADDED        => "GS_STR_LOG_MOD_LINK_ADDED",
			GS_LOG_MOD_LINK_UPDATED      => "GS_STR_LOG_MOD_LINK_UPDATED",
			GS_LOG_MOD_LINK_DELETED      => "GS_STR_LOG_MOD_LINK_DELETED"
		];

		// Second pass - format data from the log
		foreach ($logs as $log) {
			$table_row            = [];
			$table_row["id"]      = $log["id"];
			$table_row["date"]    = strtotime($log["added"]);
			$table_row["user"]    = $data["users"][$log["userid"]]["username"];
			$table_row["typenum"] = $log["type"];
			
			$server_private = false;
			$mod_private    = false;
			$valid_row      = true;
			$server_id      = null;
			$mod_id         = null;
			$user_id        = null;
			$event          = null;
			$server_name    = "";
			$playtime_text  = "";
			$mod_name       = "";
			$user_name      = "";
			$versions       = [];
			$conditions     = [];
			$lang_arguments = [$table_row["user"]];
			
			switch($log["type"]) {
				case GS_LOG_SERVER_ADDED   : 
				case GS_LOG_SERVER_UPDATED :
				case GS_LOG_SERVER_DELETE  : $server_id = $log["itemid"]; break;
				
				case GS_LOG_SERVER_EVENT_REMOVED :
				case GS_LOG_SERVER_EVENT_UPDATE  :
				case GS_LOG_SERVER_EVENT_ADDED   : {
					$event           = $data["gs_serv_times"][$log["itemid"]];
					$type            = $event["type"];
					$server_id       = $event["serverid"];
					$time_zone       = new DateTimeZone($event["timezone"]);
					$start_date      = new DateTime($event["starttime"], $time_zone);
					$playtime_text   = "";
					$playtime_format = "jS F H:i";
					
					switch($type) {
						case "1" : $playtime_text=lang("GS_STR_SERVER_EVENT_REPEAT_WEEKLY_DESC".$start_date->format("w"))." "; $playtime_format="H:i"; break;
						case "2" : $playtime_text=lang("GS_STR_SERVER_EVENT_REPEAT_DAILY_DESC")." "; $playtime_format="H:i"; break;
					}
					
					$end_date       = clone $start_date;
					$end_date->modify("+{$event["duration"]} minute");
					$playtime_text .= $start_date->format($playtime_format) . $end_date->format(" - H:i");
				} break;
				
				case GS_LOG_SERVER_MOD_REMOVED :
				case GS_LOG_SERVER_MOD_ADDED   : {
					$serv_mod   = $data["gs_serv_mods"][$log["itemid"]];
					$mod_id     = $serv_mod["modid"];
					$server_id  = $serv_mod["serverid"];
				} break;
				
				case GS_LOG_SERVER_REVOKE_ACCESS  :
				case GS_LOG_SERVER_SHARE_ACCESS   :
				case GS_LOG_SERVER_TRANSFER_ADMIN : {
					$admin     = $data["gs_serv_admins"][$log["itemid"]];
					$server_id = $admin["serverid"];
					$user_id   = $admin["userid"];
				} break;
				
				case GS_LOG_MOD_REVOKE_ACCESS  :
				case GS_LOG_MOD_SHARE_ACCESS   :
				case GS_LOG_MOD_TRANSFER_ADMIN : {
					$admin     = $data["gs_mods_admins"][$log["itemid"]];
					$mod_id    = $admin["modid"];
					$user_id   = $admin["userid"];
				} break;
				
				case GS_LOG_MOD_ADDED   : 
				case GS_LOG_MOD_UPDATED : 
				case GS_LOG_MOD_DELETE  : $mod_id = $log["itemid"]; break;
				
				case GS_LOG_MOD_SCRIPT_ADDED   : 
				case GS_LOG_MOD_SCRIPT_UPDATED : {
					$script_id = $log["itemid"];
					$updates   = [];

					foreach($data["gs_mods_links"] as $link)
						if ($link["scriptid"] == $script_id) {
							$conditions[] = $link["fromver"];
							$updates[]    = $link["updateid"];
						}

					foreach($data["gs_mods_updates"] as $update)
						if ($update["scriptid"] == $script_id || in_array($update["id"],$updates)) {
							$versions[] = $update["version"];
							$mod_id     = $update["modid"];
						}
				} break;
				
				case GS_LOG_MOD_VERSION_ADDED   : 
				case GS_LOG_MOD_VERSION_UPDATED : {
					$update_id  = $log["itemid"];
					$update     = $data["gs_mods_updates"][$update_id];
					$versions[] = $update["version"];
					$mod_id     = $update["modid"];
					$table_row["mod_changelog"] = $update["changelog"];
				} break;
				
				case GS_LOG_MOD_LINK_ADDED   :
				case GS_LOG_MOD_LINK_DELETED :
				case GS_LOG_MOD_LINK_UPDATED : {
					$link_id      = $log["itemid"];
					$link         = $data["gs_mods_links"][$link_id];
					$conditions[] = $link["fromver"];
					$update       = $data["gs_mods_updates"][$link["updateid"]];
					$versions[]   = $update["version"];
					$mod_id       = $update["modid"];
				} break;
			}
			
			if (isset($server_id)) {
				$server         = $data["gs_serv"][$server_id];
				$server_name    = ($server["name"]!="" ? $server["name"] : $server["uniqueid"]);
				$server_private = $server["access"] != "";
				
				$table_row["server_id"]   = $server["uniqueid"];
				$table_row["server_name"] = $server_name;
			}
			
			if (isset($mod_id)) {
				$mod         = $data["gs_mods"][$mod_id];
				$mod_name    = $mod["name"];
				$mod_private = !$mod["access"];
				
				$table_row["mod_id"]   = $mod["uniqueid"];
				$table_row["mod_name"] = $mod_name;
			}
			
			if (isset($user_id))
				$user_name = $data["users"][$user_id]["username"];

			switch($log["type"]) {
				case GS_LOG_SERVER_ADDED   : 
				case GS_LOG_SERVER_UPDATED :
				case GS_LOG_SERVER_DELETE  : {
					if (isset($server_id)) 
						$lang_arguments[] = $server_name;
					else
						$valid_row = false;
				} break;

				case GS_LOG_SERVER_EVENT_REMOVED :
				case GS_LOG_SERVER_EVENT_UPDATE  :
				case GS_LOG_SERVER_EVENT_ADDED   : {
					if (isset($server_id) && isset($event)) {
						$lang_arguments[] = $playtime_text;
						$lang_arguments[] = $server_name;
					} else
						$valid_row = false;
				} break;
				
				case GS_LOG_SERVER_MOD_REMOVED :
				case GS_LOG_SERVER_MOD_ADDED   : {
					if (isset($server_id) && isset($mod_id)) {
						$lang_arguments[] = $mod_name;
						$lang_arguments[] = $server_name;
					} else
						$valid_row = false;
				} break;
				
				case GS_LOG_SERVER_REVOKE_ACCESS  :
				case GS_LOG_SERVER_SHARE_ACCESS   :
				case GS_LOG_SERVER_TRANSFER_ADMIN : {
					if (isset($server_id) && isset($user_id)) {
						$lang_arguments[] = $server_name;	
						$lang_arguments[] = $user_name;	
					} else
						$valid_row = false;
				} break;
				
				case GS_LOG_MOD_REVOKE_ACCESS  :
				case GS_LOG_MOD_SHARE_ACCESS   :
				case GS_LOG_MOD_TRANSFER_ADMIN : {
					if (isset($mod_id) && isset($user_id)) {
						$lang_arguments[] = $mod_name;	
						$lang_arguments[] = $user_name;	
					} else
						$valid_row = false;
				} break;
				
				case GS_LOG_MOD_ADDED   : 
				case GS_LOG_MOD_UPDATED : 
				case GS_LOG_MOD_DELETE  : {
					if (isset($mod_id))
						$lang_arguments[] = $mod_name;
					else
						$valid_row = false;
				} break;
					
				case GS_LOG_MOD_SCRIPT_ADDED   : 
				case GS_LOG_MOD_SCRIPT_UPDATED : {
					if (isset($mod_id)) {
						$str = $mod_name;
						
						if (!empty($versions))
							$str .= " " . mb_strtolower(lang("GS_STR_SERVER_VERSION")) . " " . max($versions);
						
						if (!empty($conditions))
							$str .= " " . $condtions[0];
						
						$lang_arguments[] = $str;
					} else
						$valid_row = false;
				} break;
				
				case GS_LOG_MOD_VERSION_ADDED   : 
				case GS_LOG_MOD_VERSION_UPDATED : {
					if (isset($mod_id)) {
						$table_row["mod_version"] = max($versions);
						$lang_arguments[]         = $mod_name;
						$lang_arguments[]         = max($versions);
					} else 
						$valid_row = false;
				} break;
				
				case GS_LOG_MOD_LINK_ADDED   :
				case GS_LOG_MOD_LINK_DELETED :
				case GS_LOG_MOD_LINK_UPDATED : {
					if (isset($mod_id))
						$lang_arguments[] = "$mod_name - {$condtions[0]} ".lang("GS_STR_MOD_TO")." $versions";
					else 
						$valid_row = false;
				} break;
			}
			
			$operation_name = $operation_names[$log["type"]];
			
			if ($detailed_server_mod_change) {
				if (in_array($log["type"],[GS_LOG_SERVER_MOD_REMOVED,GS_LOG_SERVER_MOD_ADDED])) {
					$operation_name = "GS_STR_LOG_SERVER_MOD_CHANGED";
					unset($table_row["mod_name"]);
					
					if ($last_id >= 0 && $last_id==$server_id)
						$valid_row = false;
					else
						$last_id = $server_id;
				} else
					$last_id = -1;
			}
			
			if (isset($input["mod"]) && !empty($input["mod"]) && (isset($mod_id) && !in_array($mod["uniqueid"],$input["mod"]) || !isset($mod_id)))
				$valid_row = false;
			
			if (isset($input["server"]) && !empty($input["server"]) && (isset($server_id) && !in_array($server["uniqueid"],$input["server"]) || !isset($server_id)))
				$valid_row = false;

			$table_row["description"] = lang($operation_name, $lang_arguments);

			// Check record privacy before adding to the list
			if (
				$show_private ||
				$valid_row && (
					(!$server_private && !$mod_private) || 
					(isset($server_id) && !$server_private && $mod_private)
				)
			)
				$output[] = $table_row;
			
			if (count($output) >= $limit)
				break;
		}
	}

	return $output;
}

// Translate with plural form
function GS_lang($string_name, $number_array) {
	if (substr($string_name, 0, 7) != "GS_STR_")
		return $string_name;
	
	global $lang;
	$string = $lang[$string_name];
	$number = $number_array[0];
	
	if (strpos($string,"%m1%") === false)
		return $string;
	
	$current = $lang["THIS_CODE"];
	$string  = str_replace("%m1%",$number,$string);
	$ending  = "";
	
	if ($current == "en-US")
		$ending = $number!=1 ? "s" : "";

	if ($current == "ru-RU") {
		$words = explode(" ", str_replace("%m2%","",$string));
		$word  = count($words)>1 ? mb_strtolower($words[count($words)-1]) : "";
		$type  = "feminine";
		
		$ru_words = [
			"neuter"    => ["событ"],
			"masculine" => ["мод","пользовател","сервер"],
			"feminine"  => []
		];
		
		$endings = [
			"neuter"     => [
				"1"      => ["ие","ий"],
				"234"    => ["ия","ий"],
				"567890" => ["ий"]
			],
			"masculine"  => [
				"1"      => ["",""],
				"234"    => ["а","а"],
				"567890" => ["ов"]
			],
			"feminine"  => [
				"1"      => ["",""],
				"234"    => ["",""],
				"567890" => [""]
			],
		];
		
		foreach($ru_words as $current_type=>$list)
			if (in_array($word,$list))
				$type = $current_type;

		switch(substr($number,-1)) {
			case 1 : if ($number==1 || $number>20) $ending.=$endings[$type]["1"][0]; else $ending.=$endings[$type]["1"][1]; break;
			case 2 : 
			case 3 : 
			case 4 : if ($number<10 || $number>20) $ending.=$endings[$type]["234"][0]; else $ending.=$endings[$type]["234"][1]; break;
			case 5 : 
			case 6 : 
			case 7 : 
			case 8 : 
			case 9 : 
			case 0 : $ending.=$endings[$type]["567890"][0]; break;
		}
	}

	return str_replace("%m2%",$ending,$string);
}

// Transform UTF8 characters to Windows-1251
function GS_convert_cyrillic($input, $to_latin=false) {
	if (mb_strlen($input) == strlen($input))
		return $input;

	$utf8        = ["а","б","в","г","д","е" ,"ё" ,"ж" ,"з","и","й","к","л","м","н","о","п","р","с","т","у","ф","х","ц" ,"ч" ,"ш" ,"щ"   ,"ъ","ы","ь","э","ю" ,"я" ,"А","Б","В","Г","Д","Е" ,"Ё" ,"Ж" ,"З","И","Й","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц" ,"Ч" ,"Ш" ,"Щ"   ,"Ъ","Ы","Ь","Э","Ю" ,"Я"];
	$windows1251 = ["\xE0","\xE1","\xE2","\xE3","\xE4","\xE5","\xB8","\xE6","\xE7","\xE8","\xE9","\xEA","\xEB","\xEC","\xED","\xEE","\xEF","\xF0","\xF1","\xF2","\xF3","\xF4","\xF5","\xF6","\xF7","\xF8","\xF9","\xFA","\xFB","\xFC","\xFD","\xFE","\xFF","\xC0","\xC1","\xC2","\xC3","\xC4","\xC5","\xA8","\xC6","\xC7","\xC8","\xC9","\xCA","\xCB","\xCC","\xCD","\xCE","\xCF","\xD0","\xD1","\xD2","\xD3","\xD4","\xD5","\xD6","\xD7","\xD8","\xD9","\xDA","\xDB","\xDC","\xDD","\xDE","\xDF"];
	$latin       = ["a","b","v","g","d","ye","yo","zh","z","i","y","k","l","m","n","o","p","r","s","t","u","f","h","ts","ch","sh","shsh","" ,"i","" ,"e","yu","ya","A","B","V","G","D","YE","YO","ZH","Z","I","Y","K","L","M","N","O","P","R","S","T","U","F","H","TS","CH","SH","SHSH","" ,"I","" ,"E","YU","YA"];
	
	$output      = "";
	$length      = mb_strlen($input, 'UTF-8');
	$letters     = [];
	$array       = $to_latin ? "latin" : "windows1251";
	
	for ($i = 0; $i<$length; $i++) {
		$letter = mb_substr($input, $i, 1, 'UTF-8');
		
		if (mb_strlen($letter) != strlen($letter)) {
			$index   = array_search($letter, $utf8);
			$output .= $index!==false ? $$array[$index] : "";
		} else
			$output .= $letter;
	}

	return $output;
}
?>