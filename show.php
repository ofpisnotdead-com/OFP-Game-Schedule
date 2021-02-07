<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once "common.php";
?>

<div id="page-wrapper">
	<div class="container">

<?php
// Get servers and mods info from database
$input         = GS_get_common_input();
$input_onlylog = isset($_GET['onlychangelog']) ? $_GET['onlychangelog'] : 0;
$servers       = GS_list_servers($input["server"], $input["password"], GS_REQTYPE_WEBSITE, 0, $lang["THIS_LANGUAGE"], $user);
$mods          = GS_list_mods($servers["mods"], array_keys($input["modver"]), $input["modver"], $input["password"], GS_REQTYPE_WEBSITE, 0, $user);



// Display servers
echo "<DIV CLASS=\"row\">" . GS_format_server_info($servers, $mods, 12, 1, $input["server"]) . "</div>";

if (!empty($servers["info"]))
	echo 
	"<div class=\"jumbotron\">
		<h2><a href=\"quickstart#players\">".lang("GS_STR_QUICKSTART_HOWTO_CONNECT")."</a></h2>
	</div>";



echo "<div class=\"row\">";
$user_list  = [];
$js_addedon = [];
$Parsedown  = new Parsedown();

// Get user names from user id list
$db  = DB::getInstance();
$sql = "SELECT users.username, users.id FROM users WHERE users.id IN (". substr(str_repeat(",?",count($mods["userlist"])), 1) . ")";

if (!$db->query($sql,$mods["userlist"])->error())
	foreach($db->results(true) as $row)
		$user_list[$row["id"]] = $row["username"];

// Display mods
foreach($input["mod"] as $input_index=>$uniqueid) {
	$id = array_search($uniqueid, $mods["id"]);
	if ($id === FALSE)
		continue;

	$mod = $mods["info"][$id];

	echo "
	<div class=\"col-lg-12\">
		<div class=\"panel panel-default\">
			<div class=\"panel-body mods_background\" style=\"display:flex;\">
				<div style=\"flex-grow:2\">
				<h2 style=\"margin-top:0;\">{$mod["name"]}</h2>
				<dl class=\"row\" style=\"margin-bottom:0;\">
	";
	
	$keys = [
		"description" => lang("GS_STR_MOD_DESCRIPTION"),
		"type"        => lang("GS_STR_MOD_TYPE"),
		"version"     => lang("GS_STR_SERVER_VERSION"),
		"size"        => lang("GS_STR_MOD_DOWNLOADSIZE")
	];
	
	foreach ($keys as $key=>$name) {
		$value = "";
		
		switch($key) {
			case "type"        : $value=lang("GS_STR_MOD_TYPE{$mod["type"]}"); break;
			case "description" : $value=$Parsedown->line($mod[$key]); break;
			default            : $value=$mod[$key];
		}
		
		$value = str_replace("&amp;#039;", "'", $value);
		
		if (!empty($value))
			echo "<dt>{$name}:</dt><dd>{$value}</dd>";
	}
	
	echo "</dl>";
	
	if (isset($user_list[$mod["createdby"]])) {
		$js_addedon[] = date("c",strtotime($mod["created"]));
		echo "<small><span style=\"float:right;\">".lang("GS_STR_ADDED_BY_ON",[$user_list[$mod["createdby"]],"<span class=\"mod_addedon\">".date("jS M Y",strtotime($mod["created"]))."</span>"])."</span></small>";
		
		if ($mod["admin"] != $mod["createdby"])
			echo "<br><small><span style=\"float:right;\">".lang("GS_STR_MANAGED_BY_SINCE", [$user_list[$mod["admin"]], date("jS M Y",strtotime($mod["adminsince"]))])."</small>";
	}
	
	echo "</div>
	<div>
		<a href=\"show.php?mod={$mod["uniqueid"]}\"><span class=\"glyphicon glyphicon-link\"></span></a>
		<br>
		<a href=\"rss.php?mod={$mod["uniqueid"]}\"><span class=\"fa fa-rss\"></span></a>
	</div>

	</div></div>";
			
	if (!$input_onlylog)
		echo "<p>" . lang("GS_STR_MOD_PREVIEW_INSTSCRIPT", ["<a target=\"_blank\" href=\"install_scripts\">", "</a>"]);
	else
		echo "<p style=\"font-size:10px;\">" . lang("GS_STR_MOD_SHOW_INSTSCRIPT", ["<a href=\"?mod=".implode(",",$input["mod"])."\">", "</a>"]);
		
	
	// Show version select option
	array_pop($mod["allversions"]);
	if (count($mod["allversions"]) > 0) {
		echo " &nbsp; &nbsp; " . lang("GS_STR_MOD_LINK_FROM") . ": &nbsp; <select onChange=\"GS_mod_version_selection(this, $input_index)\">";
		echo "<option value=\"0\"". ($input["modver"][$mod["uniqueid"]]==0 ? " selected=\"selected\"" : "") .">0</option>";

		foreach($mod["allversions"] as $version)
			echo "<option value=\"$version\"". ($input["modver"][$mod["uniqueid"]]==$version ? " selected=\"selected\"" : "") .">$version</option>";
			
		echo "</select></p>";
	}
	
	// Show mod updates
	foreach($mod["updates"] as $update_index=>$update) {
		// Version, date and author (if different from original owner)
		echo "<div class=\"panel panel-default\">
				<div class=\"panel-heading\"><strong>{$update["version"]}<span style=\"font-size:10px;float:right;\">";

		if ($update["createdby"] != $mod["createdby"])		
			echo lang("GS_STR_ADDED_BY_ON",[$user_list[$update["createdby"]],$update["date"]]);
		else
			echo $update["date"];
		
		echo "</span></strong></div>";

		// Show script
		if (!$input_onlylog)
			echo "<pre style=\"margin:0;border:0;\"><code>". GS_scripting_highlighting($update["script"]) . "</code></pre>";
		
		// Show changelog
		$number_of_notes = 0;
		foreach ($update["note"] as $note)
			if (!empty($note)) {
				$number_of_notes = count($update["note"]);
				break;
			}
		
		if ($number_of_notes > 0) {
			echo "<hr style=\"margin-top:0px;margin-bottom:0px\"><div class=\"panel-body\" style=\"background-color:#fdffe1;\">";
			
			foreach($update["note"] as $note_index=>$note) {
				echo "<p>";

				if ($number_of_notes > 1) {
					echo "<span style=\"font-size:10px;\">{$update["note_version"][$note_index]}<span style=\"float:right;\">";
					
					if ($update["note_author"][$note_index] != $mod["createdby"])
						echo lang("GS_STR_ADDED_BY_ON",[$user_list[$update["note_author"][$note_index]],$update["note_date"][$note_index]]);
					else
						echo $update["note_date"][$note_index];
						
					echo "</span></span><br>";
				}

				echo $Parsedown->line(html_entity_decode($note, ENT_QUOTES))."</p>";
			}
			
			echo "</div>";
		}
		
		echo "</div>";
	}
	
	echo "</div><br><hr><br>";
}


// Add javascript
if (!empty($js_addedon)) {
	$locale_file = "en-gb";
	
	switch(lang("THIS_CODE")) {
		case "ru-RU" : $locale_file="ru"; break;
	}
	
	// Write page url and query string as JS vars so that GS_mod_version_selection() can reload the page
	$url        = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$url_tokens = parse_url($url);
	parse_str($url_tokens["query"], $query_string_vars);
	
	$url_tokens["query"] = "";
	foreach($query_string_vars as $key=>$value)
		if ($key!="mod" && $key!="ver")
			$url_tokens["query"] .= (empty($url_tokens["query"]) ? "" : "&") . "$key=$value";
			
	// https://stackoverflow.com/questions/4354904/php-parse-url-reverse-parsed-url
	$build_url = function(array $parts) {
		return (isset($parts['scheme']) ? "{$parts['scheme']}:" : '') . 
			((isset($parts['user']) || isset($parts['host'])) ? '//' : '') . 
			(isset($parts['user']) ? "{$parts['user']}" : '') . 
			(isset($parts['pass']) ? ":{$parts['pass']}" : '') . 
			(isset($parts['user']) ? '@' : '') . 
			(isset($parts['host']) ? "{$parts['host']}" : '') . 
			(isset($parts['port']) ? ":{$parts['port']}" : '') . 
			(isset($parts['path']) ? "{$parts['path']}" : '') . 
			(isset($parts['query']) ? "?{$parts['query']}" : '') . 
			(isset($parts['fragment']) ? "#{$parts['fragment']}" : '');
	};
	
	echo "
	<script type=\"text/javascript\" src=\"usersc/js/gs_functions.js\"></script>
	<script type=\"text/javascript\" src=\"usersc/js/moment.js\"></script>
	<script type=\"text/javascript\" src=\"usersc/js/{$locale_file}.js\"></script>
	<script type=\"text/javascript\">
		var GS_input_mods = ".json_encode(array_keys($input["modver"])).";
		var GS_input_vers = ".json_encode(array_values($input["modver"])).";
		var GS_input_url  = '".$build_url($url_tokens)."';
		GS_convert_addedon_date('mod_addedon',".json_encode($js_addedon).");
	</script>
	";
}

echo "</div>";



if (!empty($_GET['mod']))
	echo 
	"<div class=\"jumbotron\">
		<h2><a href=\"https://youtu.be/KSK_H8Dc4oo\">".lang("GS_STR_QUICKSTART_HOWTO_INSTALL")."</a></h2>
	</div>";
	
if (isset($user) && $user->isLoggedIn())
	languageSwitcher();
?>


	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
