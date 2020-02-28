<?php
require_once "header.php";

// Code for modal for converting download links; displayed when installation script input is displayed
$js_modal = "
<div id=\"convertlink_modal\" class=\"schedule_modal\">
	<div class=\"schedule_modal-content\">
		<span id=\"convertlink_modal_close\" class=\"schedule_modal_close\">&times;</span>
	
		<p>".lang("GS_STR_MOD_CONVERTLINK_DESC")."</p>
		<ul>
			<li><b>Google Drive</b> - ".lang("GS_STR_MOD_CONVERTLINK_SHAREABLE")."</li>
			<li><b>ModDB</b> - ".lang("GS_STR_MOD_CONVERTLINK_PAGE")."</li>
			<li><b>Mediafire</b> - ".lang("GS_STR_MOD_CONVERTLINK_PAGE")."</li>
			<li><b>GameFront</b> - ".lang("GS_STR_MOD_CONVERTLINK_PAGE")."</li>
		</ul>
		<br>
		
		<div id=\"convertlink_modal_group_link\" class=\"form-group\">
			<label class=\"col-lg-2 control-label\" for=\"convertlink_modal_link\">URL</label>
			<div class=\"col-lg-10\">
				<input class=\"form-control\" id=\"convertlink_modal_link\" type=\"text\" size=\"50\">
			</div>
		</div>
		
		<div id=\"convertlink_modal_group_filename\" class=\"form-group\">
			<label class=\"col-lg-2 control-label\" for=\"convertlink_modal_filename\">".lang("GS_STR_MOD_CONVERTLINK_FILENAME")."</label>
			<div class=\"col-lg-10\">
				<input placeholder=\"example.7z\" class=\"form-control\" id=\"convertlink_modal_filename\" type=\"text\" size=\"50\">
			</div>
		</div>
	
		<div id=\"convertlink_modal_group_size\" class=\"form-group\">
			<label class=\"col-lg-2 control-label\" for=\"convertlink_modal_size\">".lang("GS_STR_MOD_CONVERTLINK_BIGFILE")."</label>
			<div class=\"col-lg-10\">
				<div>
					<div class=\"checkbox\">
						<label>
							<input type=\"checkbox\" id=\"convertlink_modal_size\">
						</label>
					</div>
				</div>
				<span class=\"help-block\">".lang("GS_STR_MOD_CONVERTLINK_BIGFILE_DESC", ["<a id=\"convertlink_modal_testlink\" target=\"_blank\" href=\"\">", "</a>"])."</span>
			</div>
		</div>
		
		<div id=\"convertlink_modal_group_accept\" class=\"form-group\">
			<label class=\"col-lg-2 control-label\"></label>
			<div class=\"col-lg-10\">
				<button type=\"button\" class=\"btn btn-primary btn-sm\" id=\"convertlink_modal_accept\">".lang("GS_STR_MOD_CONVERTLINK_INSERT")."</button><br>
			</div>
		</div>

	</div>
</div>

<script type=\"text/javascript\">
	document.getElementById('convertlink_field').innerHTML = '<a>".lang("GS_STR_MOD_CONVERTLINK")."</a>';
	GS_activate_convertlink_modal()
</script>";

$install_hint    = lang("GS_STR_MOD_INSTALLATION_HINT",["<a target=\"_blank\" href=\"install_scripts\">","</a>","<a target=\"_blank\" href=\"install_scripts#testing\">","</a>"]);
$install_example = "ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25rel.rar";




// If user wants to add new mod or edit existing
if (in_array($form->hidden["display_form"], ["Add New","Edit"]))
{
	// Set up form
	$form->size       = 9;
	$form->label_size = 2;
	$form->input_size = 10;
	
	$mod_type_select = [];
	for($i=0; $i<4; $i++)
		$mod_type_select[] = [lang("GS_STR_MOD_TYPE{$i}")." - ".lang("GS_STR_MOD_TYPE{$i}_DESC"),"{$i}"];
	
	$form->add_text("name"       , lang("GS_STR_MOD_FOLDER")      , lang("GS_STR_MOD_FOLDER_HINT")     , "@ww4mod25");
	$form->add_text("description", lang("GS_STR_MOD_DESCRIPTION") , lang("GS_STR_MOD_DESCRIPTION_HINT"), lang("GS_STR_MOD_DESCRIPTION_EXAMPLE"));
	$form->add_select("type"     , lang("GS_STR_MOD_TYPE")        , ""                                 , $mod_type_select, "0");
	$form->add_select("access"   , lang("GS_STR_MOD_ACCESS")      , lang("GS_STR_MOD_ACCESS_HINT")     , [[lang("GS_STR_MOD_PUBLIC"),"1"], [lang("GS_STR_MOD_PRIVATE"),"0"]], "1", "radio");
	$form->add_select("forcename", lang("GS_STR_MOD_FORCENAME")   , lang("GS_STR_MOD_FORCENAME_HINT")  , [[lang("GS_STR_DISABLED"),"0"], [lang("GS_STR_ENABLED"),"1"]], "0", "radio");
	$form->add_text("scripttext" , lang("GS_STR_MOD_INSTALLATION"), $install_hint                      , $install_example, "", -1);
	$form->add_emptyspan("convertlink_field", "id=\"convertlink_field_group\"");
	$form->add_text("size"       , lang("GS_STR_MOD_DOWNLOADSIZE"), "", "128");
	$form->add_select("sizetype" , "", "", GS_SIZE_TYPES, "MB");
	
	if ($form->hidden["display_form"] == "Add New") {
		$form->include_file("usersc/js/gs_functions.js");
		$form->add_html($js_modal);
	}

	$form->change_control(["size","sizetype"], ["Inline"=>3]);

	
	// If user wants to update mod entry
	if (in_array($form->hidden["action"], ["Edit","Add New"])) {
		$data = &$form->save_input();
		$data["name"] = preg_replace('/\s+/', '', $data["name"]);	// remove whitespace
		
		// Validate file name
		$custom_errors = [];
		if (!GS_is_valid_windows_filename($data["name"]))
			$custom_errors[] = [lang("GS_STR_MOD_NAME_ERROR"), "name"];
		
		// Validate user input
		$unique_array = ["gs_mods", ["and",["description","LIKE",$data["description"]],["removed","!=",1]]];
		$exclude      = $form->hidden["action"]=="Edit" ? ["scripttext", "size", "sizetype"] : [];
		
		if ($form->hidden["action"] == "Edit")
			$unique_array[1][] = ["id","!=",$id];
		
		$form->init_validation     (["max"=>GS_MAX_TXT_INPUT_LENGTH, "required"=>true], $exclude);
		$form->add_validation_rules(["description"], ["max"=>GS_MAX_MSG_INPUT_LENGTH, "unique" =>$unique_array]);
		$form->add_validation_rules(["scripttext"] , ["max"=>GS_MAX_SCRIPT_INPUT_LENGTH, "display"=>lang("GS_STR_MOD_INSTALLATION_SCRIPT")]);
		$form->add_validation_rules(["size"]       , [">"=>0]);
		$form->add_validation_rules(["sizetype"]   , ["in"=>GS_SIZE_TYPES, "display"=>lang("GS_STR_MOD_DOWNLOADSIZE")]);


		// Send data to table
		if ($form->validate($custom_errors, lang("GS_STR_ERROR_FORMDATA"))) {	
			// Set up four arrays for inserting to four db tables
			$mod_fields = [
				"name"        => $data["name"],
				"description" => $data["description"],
				"access"      => $data["access"],
				"forcename"   => $data["forcename"],
				"type"        => $data["type"]
			];
			
			$admin_fields = [
				"modid"       => -1,
				"userid"      => $uid,
				"isowner"     => 1
			];
			
			$script_fields = [
				"size"        => "{$data["size"]} {$data["sizetype"]}",
				"script"      => $data["scripttext"]
			];
			
			$update_fields = [
				"modid"       => -1,
				"scriptid"    => -1,
				"version"     => 1
			];			
			
			$mod_fields["modified"]   = date("Y-m-d H:i:s");
			$mod_fields["modifiedby"] = $uid;
			
			if ($form->hidden["action"] == "Add New") {
				$mod_fields["uniqueid"]     = substr(strtolower(Hash::unique()), rand(0,56), 8);
				$mod_fields["createdby"]    = $uid;
				$script_fields["uniqueid"]  = substr(strtolower(Hash::unique()), rand(0,56), 8);
				$script_fields["createdby"] = $uid;
			}
					
			$mod_fields["id"] = $id;
			$result           = $db->insert("gs_mods", $mod_fields, true);

			$form->feedback(
				$result, 
				lang($form->hidden["action"]=="Add New" ? "GS_STR_MOD_ADDED"       : "GS_STR_MOD_UPDATED"),
				lang($form->hidden["action"]=="Add New" ? "GS_STR_MOD_ADDED_ERROR" : "GS_STR_MOD_UPDATED_ERROR")
			);
			
			if ($result) {
				if ($form->hidden["action"] == "Add New") {
					$id                           = $db->lastId();
					$form->hidden["uniqueid"]     = $mod_fields["uniqueid"];
					$form->hidden["display_form"] = "Edit";
					$admin_fields["modid"]        = $id;
					$update_fields["modid"]       = $id;

					$db->insert("gs_mods_admins" , $admin_fields);
					$db->insert("gs_mods_scripts", $script_fields);

					if (!$db->error()) {
						$update_fields["scriptid"] = $db->lastId();
						$db->insert("gs_mods_updates", $update_fields);
					} else
						echo $db->errorString();
				}
				
				$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$id, "type"=>($form->hidden["action"]=="Add New" ? GS_LOG_MOD_ADDED : GS_LOG_MOD_UPDATED), "added"=>date("Y-m-d H:i:s")]);
				
				$form->hidden["display_name"] = $data["name"];
			}
		}
	} else
		if ($form->hidden["display_form"] == "Edit")
			if (!$form->load_record("gs_mods", $id))
				$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
		
	if ($form->hidden["display_form"] == "Edit")
		$form->change_control(["scripttext", "size", "sizetype"], "remove");
	
	$form->data["description"] = htmlspecialchars($form->data["description"]);
	
	$form->add_button("action", $form->hidden["display_form"], lang(GS_FORM_ACTIONS[$form->hidden["display_form"]]), "btn-mods btn-lg");
}	










// If user wants to update the mod
if ($form->hidden["display_form"] == "Update") 
{
	$form->size       = 12;
	$form->label_size = 2;
	$form->input_size = 10;
	
	
	// Display buttons for navigating between sub-sections
	forEach(GS_FORM_ACTIONS_MODUPDATE as $section=>$section_name) {
		$class = "btn-mods " . ($form->hidden["display_subform"]==$section ? "active" : "");
		
		$form->add_button("display_subform", $section, lang($section_name), $class, "", ($form->hidden["display_subform"]==$section ? "disabled=\"disabled\"" : ""));
		$form->add_html(" &nbsp; &nbsp; ");
		$form->change_control([-1,-2], ["Inline"=>-3]);
	}
	
	// Display controls for the current section	
	$form->add_space(1);

	if ($form->hidden["display_subform"] == "Add")
		$form->add_text("version", lang("GS_STR_MOD_NEWVER"), lang("GS_STR_MOD_NEWVER_HINT"), "");
	
	if ($form->hidden["display_subform"] == "Edit")
		$form->add_select("version", lang("GS_STR_SERVER_VERSION"), "", []);
	
	if ($form->hidden["display_subform"] == "Link") {
		$form->add_select("Link"   , lang("GS_STR_MOD_LINK"), "", []);
		$form->add_text("fromver"  , lang("GS_STR_MOD_LINK_FROM"), lang("GS_STR_MOD_LINK_FROM_HINT"), "v < 1.2");
		$form->add_select("version", lang("GS_STR_MOD_LINK_TO"), lang("GS_STR_MOD_LINK_TO_HINT"), []);
	}
	
	$form->add_select("script", lang("GS_STR_MOD_INSTALLATION"), "", []);
	$form->add_text("scripttext", "", $install_hint, $install_example, "", -1);
	$form->add_emptyspan("convertlink_field", "id=\"convertlink_field_group\"");
	$form->add_text("size", lang("GS_STR_MOD_DOWNLOADSIZE"), "", "128");
	$form->add_select("sizetype", "", "", GS_SIZE_TYPES, "MB");
	$form->add_emptyspan("feedback");
	$form->add_html($js_modal);
	
	
	if (in_array($form->hidden["display_subform"], ["Add", "Edit"]))
		$form->add_text("changelog", lang("GS_STR_MOD_PATCHNOTES"), lang("GS_STR_MOD_PATCHNOTES_HINT"), lang("GS_STR_MOD_PATCHNOTES_EXAMPLE"), "", -1);

	$form->add_button("action", $form->hidden["display_subform"], lang(GS_FORM_ACTIONS_MODUPDATE[$form->hidden["display_subform"]]), "btn-mods btn-lg", "SubmitButton");
		
	// Button to remove a link between versions
	if ($form->hidden["display_subform"] == "Link") {
		$form->add_space();
		$form->add_button("action", "DeleteLink", lang("GS_STR_INDEX_DELETE"), "btn-danger btn-sm", "SubmitButton");
	}
	
	$form->add_html("<BR><BR><A TARGET=\"_blank\" HREF=\"show.php?mod={$form->hidden["uniqueid"]}\">".lang("GS_STR_MOD_PREVIEW_INST")."</A>");
	$form->change_control(["size", "sizetype"], ["Inline"=>3]);
	

	
	// If user wants to update database
	if (array_search($form->hidden["action"], array_keys(GS_FORM_ACTIONS_MODUPDATE)) !== FALSE) {
		$data              = &$form->save_input();
		$undefined_indexes = ["fromver", "script", "version", "scripttext", "Link", "changelog"];
		
		foreach ($undefined_indexes as $index)
			if (!isset($data[$index]))
				$data[$index] = "";
			
		$highest       = NULL;
		$updateid      = NULL;
		$is_ok         = false;
		$custom_errors = [];
		$result        = GS_parse_jump_rule($data["fromver"], 0, $data["version"]);
		
		// Validate rule
		if (is_string($result))
			$custom_errors[] = [lang("GS_STR_MOD_CONDITION_ERROR").": $result", "fromver"];
		else
			$is_ok = true;
		
		// Size number - three digits after dot and no trailing zeros
		if (is_numeric($data["version"])) {
			$data["version"] = floatval(sprintf("%01.3f", $data["version"]));
			$data["version"] = strval($data["version"]);
		}
		
		// Get highest version number for this mod
		if ($form->hidden["display_subform"] == "Add") {
			$highest = $db->cell("gs_mods_updates.MAX(version)",["modid","=",$id]);
			
			if (isset($highest))
				$highest = floatval(sprintf("%01.3f", $highest));
			else {
				$form->alert(lang("GS_STR_MOD_RECENTVER_ERROR"));
				$is_ok = false;
			}
		}
		
		
		// Find update id by version number
		if ($form->hidden["display_subform"] == "Link") {
			$updateid = $db->cell("gs_mods_updates.id",["and",["modid","=",$id],["version","LIKE",$data["version"]]]);

			if (!isset($updateid)) {
				$form->alert(lang("GS_STR_MOD_LINKVER_ERROR"));
				$is_ok = false;
			}
		}

		
		// Set up validation
		$exclude      = [];
		$unique_array = ["gs_mods_updates",["and", ["modid","=",$id], ["version","LIKE",$data["version"]]]];
		
		// If user is copying script from other record - ignore script text in validation
		if ($data["script"]!=-1  &&  $form->hidden["display_subform"]!="Modify")
			$exclude = ["scripttext", "size", "sizetype"];		

		$form->init_validation     (["max"=>GS_MAX_TXT_INPUT_LENGTH, "required"=>true], $exclude);
		$form->add_validation_rules(["scripttext"], ["max"=>GS_MAX_SCRIPT_INPUT_LENGTH, "display"=>lang("GS_STR_MOD_INSTALLATION_SCRIPT")]);
		$form->add_validation_rules(["changelog"] , ["max"=>GS_MAX_SCRIPT_INPUT_LENGTH, "required"=>false]);
		$form->add_validation_rules(["size"]      , [">"=>0]);
		$form->add_validation_rules(["sizetype"]  , ["in"=>GS_SIZE_TYPES, "display"=>lang("GS_STR_MOD_DOWNLOADSIZE")]);

		if ($form->hidden["display_subform"] == "Add")
			$form->add_validation_rules(["version"], [">"=>$highest, "unique"=>$unique_array]);
		
		if ($form->hidden["display_subform"] == "Link") {
			$form->add_validation_rules(["fromver"], ["max"=>GS_MAX_MSG_INPUT_LENGTH]);
			$form->add_validation_rules(["scripttext"], ["required"=>false]);
		}


		if ($form->validate($custom_errors,lang("GS_STR_ERROR_FORMDATA"))  &&  $is_ok) {
			// Set up two arrays for inserting to two db tables
			$update_fields = [
				"modid"     => $id,
				"scriptid"  => $data["script"],
				"version"   => $data["version"],
				"changelog" => $data["changelog"]
			];

			$script_fields = [
				"size"     => "{$data["size"]} {$data["sizetype"]}",
				"script"   => $data["scripttext"]
			];
			
			$link_fields = [
				"updateid" => $updateid,
				"scriptid" => $data["script"],
				"fromver"  => $data["fromver"]
			];

			$script_fields["modified"]   = date("Y-m-d H:i:s");
			$script_fields["modifiedby"] = $uid;
			
			// Update script
			if ($form->hidden["display_subform"] == "Modify") {
				$scriptid = $db->cell("gs_mods_scripts.id",["uniqueid","=",$data["script"]]);
				
				if (isset($scriptid)) {
					$result = $form->feedback(
						$db->update("gs_mods_scripts", $scriptid, $script_fields),
						lang("GS_STR_MOD_SCRIPT_UPDATED"),
						lang("GS_STR_MOD_SCRIPT_UPDATED_ERROR")
					);
					
					if ($result)
						$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$scriptid, "type"=>GS_LOG_MOD_SCRIPT_UPDATED, "added"=>date("Y-m-d H:i:s")]);
				} else
					$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));		
			} else {
				// Add new script
				if ($data["script"] == -1) {
					$script_fields["uniqueid"]  = substr(strtolower(Hash::unique()), rand(0,56), 8);
					$script_fields["createdby"] = $uid;
					$data["script"]             = $script_fields["uniqueid"];
					
					if ($db->insert("gs_mods_scripts", $script_fields)) {
						$update_fields["scriptid"] = $db->lastId();
						$link_fields["scriptid"]   = $db->lastId();
						$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$db->lastId(), "type"=>GS_LOG_MOD_SCRIPT_ADDED, "added"=>date("Y-m-d H:i:s")]);
					} else
						$form->alert(lang("GS_STR_MOD_SCRIPT_ADDED_ERROR"));
				} else { 
					// Get script ID
					$update_fields["scriptid"] = $db->cell("gs_mods_scripts.id", ["uniqueid","=",$data["script"]]);
					$link_fields["scriptid"]   = $update_fields["scriptid"];
				}
				
				if (isset($update_fields["scriptid"])  &&  $update_fields["scriptid"]!=-1) {
					// Add new update
					if ($form->hidden["display_subform"] == "Add") {
						$update_fields["createdby"] = $uid;
						
						$result = $form->feedback(
							$db->insert("gs_mods_updates", $update_fields),
							lang("GS_STR_MOD_VERSION_ADDED"),
							lang("GS_STR_MOD_VERSION_ADDED_ERROR")
						);
						
						if ($result)
							$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$db->lastId(), "type"=>GS_LOG_MOD_VERSION_ADDED, "added"=>date("Y-m-d H:i:s")]);
					}
					
					$update_fields["modified"]   = date("Y-m-d H:i:s");
					$update_fields["modifiedby"] = $uid;
					
					// Edit update
					if ($form->hidden["display_subform"] == "Edit") {
						$recordID = $db->cell("gs_mods_updates.id",["and",["version","LIKE",$data["version"]],["modid","=",$id]]);
						
						if (isset($recordID)) {
							$result = $form->feedback(
								$db->update("gs_mods_updates", $recordID, $update_fields),
								lang("GS_STR_MOD_VERSION_UPDATED"),
								lang("GS_STR_MOD_VERSION_UPDATED_ERROR")
							);
							
							if ($result)
								$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$recordID, "type"=>GS_LOG_MOD_VERSION_UPDATED, "added"=>date("Y-m-d H:i:s")]);
						} else
							$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));							
					}

					// Add new link
					if ($form->hidden["display_subform"] == "Link") {
						$new_link = false;
						
						$link_fields["modified"]   = date("Y-m-d H:i:s");
						$link_fields["modifiedby"] = $uid;

						if ($data["Link"] == -1) {
							$link_fields["uniqueid"]  = substr(strtolower(Hash::unique()), rand(0,56), 8);
							$link_fields["createdby"] = $uid;
							$new_link                 = true;
							$data["Link"]             = $link_fields["uniqueid"];
						}
						
						if ($new_link) {
							$result = $form->feedback(
								$db->insert("gs_mods_links", $link_fields),
								lang("GS_STR_MOD_LINK_ADDED"),
								lang("GS_STR_MOD_LINK_ADDED_ERROR")
							);
							
							if ($result)
								$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$db->lastId(), "type"=>GS_LOG_MOD_LINK_ADDED, "added"=>date("Y-m-d H:i:s")]);
						} else {
							$recordID = $db->cell("gs_mods_links.id",["uniqueid","LIKE",$data["Link"]]);
							
							if (isset($recordID)) {
								$result = $form->feedback(
									$db->update("gs_mods_links", $recordID, $link_fields),
									lang("GS_STR_MOD_LINK_UPDATED"),
									lang("GS_STR_MOD_LINK_UPDATED_ERROR")
								);
								
								if ($result)
									$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$recordID, "type"=>GS_LOG_MOD_LINK_UPDATED, "added"=>date("Y-m-d H:i:s")]);
							} else
								$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));		
						}
					}
				}
			}
		}
	}		
	
	if ($form->hidden["action"] == "DeleteLink") {
		$data = &$form->save_input();
		if ($data["Link"] != "-1") {
			$recordID = $db->cell("gs_mods_links.id",["uniqueid","LIKE",$data["Link"]]);
			
			if (isset($recordID)) {
				$result = $form->feedback(
					$db->update("gs_mods_links", $recordID, ["removed"=>true, "modified"=>date("Y-m-d H:i:s"), "modifiedby"=>$uid]),
					lang("GS_STR_MOD_LINK_DELETED"),
					lang("GS_STR_MOD_LINK_DELETED_ERROR")
				);
				
				if ($result) {
					$form->data = [];
					$db->insert("gs_log", ["userid"=>$uid, "itemid"=>$recordID, "type"=>GS_LOG_MOD_LINK_DELETED, "added"=>date("Y-m-d H:i:s")]);
				}
			} else
				$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));				
		} else 
			$form->alert(lang("GS_STR_MOD_LINK_INVALID_ERROR"));
	}
	
	// Get all updates for this mod
	$sql = "
		SELECT 
			gs_mods_updates.*, 
			gs_mods_scripts.script, 
			gs_mods_scripts.size,
			gs_mods_scripts.uniqueid
			
		FROM 
			gs_mods_updates, 
			gs_mods_scripts 
			
		WHERE 
			gs_mods_updates.modid    = ? AND
			gs_mods_updates.scriptid = gs_mods_scripts.id
			
		ORDER BY
			gs_mods_updates.version
	";

	if ($db->query($sql,[$id])->error())
		$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));

	$updates        = $db->query($sql,[$id])->results(true);
	$highest        = 0;
	$fromver        = 0;
	$to_version     = [];
	$rules          = [];
	$script_list    = [];
	$js_update_list = ["name"=>"Update_List"    , "data"=>[]];
	$js_script_list = ["name"=>"Script_Contents", "data"=>[]];
	$changelog      = "";

	foreach ($updates as $update) {
		$size = explode(' ', $update["size"]);

		// Make a list of all mod versions for linking
		$to_version[] = $update["version"];
		$rules[]      = isset($update["Link"]) ? $update["Link"] : "";

		$js_update_list["data"][] = [
			"version" => $update["version"],
			"uniqueid" => $update["uniqueid"],
			"changelog" => $update["changelog"]
		];
		$js_script_list["data"][] = [
			"uniqueid"   => $update["uniqueid"],
			"script"     => $update["script"],
			"sizenumber" => $size[0],
			"sizetype"   => $size[1]
		];

		// Make a list of existing scripts
		if (isset($script_list[$update["uniqueid"]]))
			$script_list[$update["uniqueid"]][] = "$fromver ".lang("GS_STR_MOD_TO")." {$update["version"]}";
		else
			$script_list[$update["uniqueid"]]   = ["$fromver ".lang("GS_STR_MOD_TO")." {$update["version"]}"];

		if ($update["version"] > $highest)
			$highest = $update["version"];

		$fromver   = $update["version"];
		$changelog = htmlentities($update["changelog"]); 
	}
	
	$form->add_js_var($js_update_list);
	

		

	// Make a new list of scripts that doesn't have duplicated id numbers
	$scripts_select = [$form->hidden["display_subform"]=="Modify" ? [lang("GS_STR_MOD_PICK_ONE"), "-1", "SELECTED"] : [lang("GS_STR_MOD_ADD_NEW_SCRIPT"), "-1"]];
	

	
	$scripts_select = array_merge($scripts_select, GS_script_list_to_script_select($script_list,"",$form->hidden["display_subform"]));

	
	// Pick javascript function depending on the form section
	$js_script_select  = "GS_handle_installation_script_form('script',['scripttextinput','sizetextinput','convertlink_field_group'], 'feedback', {$js_script_list["name"]});";	
	$js_version_select = "";	
	
	if ($form->hidden["display_subform"] == "Edit")
		$js_version_select = "GS_match_installation_script_to_version('version', 'script', 'changelog', 'changelogtextinput', {$js_update_list["name"]});";
	
	if ($form->hidden["display_subform"] == "Modify")
		$js_script_select = "GS_handle_edit_script_form('script', ['scripttext','size','sizetype','convertlink_field_group'], 'SubmitButton', {$js_script_list["name"]})";



	// If adding a new version then suggest version number higher than the current one
	if ($form->hidden["display_subform"] == "Add") {
		if (isset($data["version"])  &&  $data["version"] <= $highest)	// if number in the input field is obsolete then remove it
			unset($data["version"]);

		$suggested = strlen($highest)>3 ? 0.01 : 0.1;
		$form->change_control("version" , ["Default"=>floatval(sprintf("%01.3f", $highest+$suggested))]);
	}

	if (in_array($form->hidden["display_subform"],["Edit","Link"]))
		$form->change_control("version", ["Default"=>$to_version[count($to_version)-1], "Options"=>$to_version, "Property"=>"onChange=\"{$js_version_select} {$js_script_select}\""]);
	
	if (in_array($form->hidden["display_subform"],["Add","Edit","Link"]))
		$form->change_control("script", ["Default"=>$scripts_select[count($scripts_select)-1][1]]);
	
	if ($form->hidden["display_subform"] == "Edit")
		$form->change_control("changelog", ["Default"=>$changelog]);
	
	
	// Get all links
	if (in_array($form->hidden["display_subform"], ["Modify","Link"])) {
		$sql = "
			SELECT 
				gs_mods_links.*, 
				gs_mods_updates.version, 
				gs_mods_scripts.size, 
				gs_mods_scripts.script, 
				gs_mods_scripts.uniqueid as scriptUniqueID 
				
			FROM  
				gs_mods_links, 
				gs_mods_updates, 
				gs_mods_scripts 
				
			WHERE 
				gs_mods_updates.modid  = ?                  AND 
				gs_mods_links.updateid = gs_mods_updates.id AND 
				gs_mods_links.scriptid = gs_mods_scripts.id AND
				gs_mods_links.removed  = 0
				
			ORDER BY 
				gs_mods_updates.version
		";

		if ($db->query($sql,[$id])->error())
			$form->fail(lang("GS_STR_ERROR_GET_DB_RECORD"));
		
		$links        = $db->query($sql,[$id])->results(true);
		$links_select = [[lang("GS_STR_MOD_ADD_NEW_LINK"), "-1", "SELECTED"]];
		$js_link_list = ["name"=>"Links_List", "data"=>[]];
		
		foreach ($links as $link) {
			$condition      = htmlentities($link["fromver"]);
			$links_select[] = ["$condition ".lang("GS_STR_MOD_TO")." {$link["version"]}", $link["uniqueid"]];
			$size           = explode(' ', $update["size"]);
			
			$js_link_list["data"][] = [
				"uniqueid"       => $link["uniqueid"],
				"fromver"        => $link["fromver"],
				"version"        => $link["version"],
				"scriptUniqueID" => $link["scriptUniqueID"]
			];
			$js_script_list["data"][] = [
				"uniqueid"   => $link["scriptUniqueID"],
				"script"     => $link["script"],
				"sizenumber" => $size[0],
				"sizetype"   => $size[1]
			];
			
			// Make a list of existing scripts
			if (isset($script_list[$link["scriptUniqueID"]]))
				$script_list[$link["scriptUniqueID"]][] = "$condition ".lang("GS_STR_MOD_TO")." {$link["version"]}";
			else
				$script_list[$link["scriptUniqueID"]]   = ["$condition ".lang("GS_STR_MOD_TO")." {$link["version"]}"];
			
		}

		array_splice($scripts_select, 1);
		$scripts_select = array_merge($scripts_select, GS_script_list_to_script_select($script_list,""/*"link"*/,$form->hidden["display_subform"]));
		
		$form->add_js_var($js_link_list);
		$form->change_control("Link"  , ["Options"=>$links_select, "Property"=>"onChange=\"GS_handle_link_selection('Link', ['fromver','version','script'], {$js_link_list["name"]});  {$js_script_select}\""]);	
		$form->change_control("script", ["Default"=>""]);	
		$scripts_select[0][] = "SELECTED";
	}
	
	
	
	$form->change_control("script"     , ["Options"=>$scripts_select, "Property"=>"onChange=\"{$js_script_select}\""]);
	$form->change_control("scripttext" , ["Group"=>"ID=\"scripttextinput\""]);
	$form->change_control("size"       , ["Group"=>"ID=\"sizetextinput\""]);
	$form->change_control("changelog"  , ["Group"=>"ID=\"changelogtextinput\""]);
	
	// Include javascript
	$form->include_file("usersc/js/gs_functions.js");
	$form->add_html("
		<SCRIPT TYPE=\"text/javascript\">
			var {$js_script_list["name"]} = ".json_encode($js_script_list["data"]).";
			{$js_script_select}
		</SCRIPT>
	");
}














// If user wants to grant/revoke access for others
if ($form->hidden["display_form"] == "Share") 
	GS_record_sharing($record_type, $record_table, $record_column, $form, $id, $uid, $permission_to, $gs_my_permission_level, $current_entry_owner);











// If user wants to delete mod
if ($form->hidden["display_form"] == "Delete") {
	
	// Show warning about breaking links
	if ($form->hidden["action"] == "") {
		$sql = "
			SELECT 
				gs_serv.id 
			FROM 
				gs_serv_mods LEFT JOIN gs_serv 
					ON gs_serv_mods.serverid = gs_serv.id 
			WHERE 
				gs_serv_mods.modid   = ? AND 
				gs_serv.removed      = 0 AND
				gs_serv_mods.removed = 0
		";
				
		$db->query($sql,[$id]);
		$count = count($db->results(true));
		$ending = "";
		
		if ($count > 0) {
			$used_by = lang_plural2($count, lang("GS_STR_DELETE_MOD_USED"));
			$used_by = str_replace("\$count", $count, $used_by);
			$form->add_html($used_by . ". " . lang("GS_STR_DELETE_MOD_SURE") . "<br><br><br>");
		}
	}
	
	GS_record_delete($record_type, $record_table, $form, $id, $uid);
}




$section_title = lang(GS_FORM_ACTIONS[$form->hidden["display_form"]]) . " " . lang("GS_STR_MOD");

switch ($form->hidden["display_form"]) {
	case "Share"    : $section_title=lang("GS_STR_SERVER_SHAREMOD_TITLE"); break;
}

require_once "footer.php";
?>