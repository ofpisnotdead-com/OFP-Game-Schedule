<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once "common.php";
?>

<div id="page-wrapper">
	<div class="container">

<?php
// Get data from the database
$input         = GS_get_common_input();
$input_onlylog = isset($_GET['onlychangelog']) ? $_GET['onlychangelog'] : 0;
$servers       = GS_list_servers($input["server"], $input["password"], "website", 0);
$mods          = GS_list_mods($servers["mods"], array_keys($input["modver"]), $input["modver"], $input["password"], "website", 0);

echo "<DIV CLASS=\"row\">" . GS_format_server_info($servers, $mods, 12, 1, $input["server"]) . "</div>";

if (!empty($servers["info"]))
	echo 
	"<div class=\"jumbotron\">
		<h2><a href=\"quickstart#players\">".lang("GS_STR_QUICKSTART_HOWTO_CONNECT")."</a></h2>
	</div>";




echo "<div class=\"row\">";
$user_list  = [];
$js_addedon = [];

// Get user list first
$user_id_list = [];

foreach($mods["info"] as $id=>$mod)
	$user_id_list[] = $mod["createdby"];
	
$db  = DB::getInstance();
$sql = "SELECT users.username, users.id FROM users WHERE users.id IN (". substr(str_repeat(",?",count($user_id_list)), 1) . ")";

if (!$db->query($sql,$user_id_list)->error())
	foreach($db->results(true) as $row)
		$user_list[$row["id"]] = $row["username"];


foreach($input["mod"] as $uniqueid) {
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
			case "type" : $value=lang("GS_STR_MOD_TYPE{$mod["type"]}"); break;
			default: $value=$mod[$key];
		}
		
		$value = str_replace("&amp;#039;", "'", $value);
		
		if (!empty($value))
			echo "<dt>{$name}:</dt><dd>{$value}</dd>";
	}
	
	echo "</dl>";
	
	if (isset($user_list[$mod["createdby"]])) {
		$js_addedon[] = date("c",strtotime($mod["created"]));
		echo "<span style=\"float:right;\">".lang("GS_STR_ADDED_BY_ON",[$user_list[$mod["createdby"]],"<span class=\"mod_addedon\">".date("jS M Y",strtotime($mod["created"]))."</span>"])."</span>";
	}
	
	echo "</div>
	<div>
		<a href=\"show.php?mod={$mod["uniqueid"]}\"><span class=\"glyphicon glyphicon-link\"></span></a>
		<br>
		<a href=\"rss.php?mod={$mod["uniqueid"]}\"><span class=\"fa fa-rss\"></span></a>
	</div>

	</div></div>";
			
	if (!$input_onlylog)
		echo "<p>" . lang("GS_STR_MOD_PREVIEW_INSTSCRIPT", ["<a target=\"_blank\" href=\"install_scripts\">", "</a>"]) . "</p>";
	else
		echo "<p style=\"font-size:10px;\">" . lang("GS_STR_MOD_SHOW_INSTSCRIPT", ["<a href=\"?mod=".implode(",",$input["mod"])."\">", "</a>"]) . "</p>";
	
	foreach($mod["updates"] as $update_index=>$update) {
		echo "<div class=\"panel panel-default\">
				<div class=\"panel-heading\"><strong>{$update["version"]}<span style=\"font-size:10px;float:right;\">{$update["date"]}</span></strong></div>";

		if (!$input_onlylog)
			echo "<pre style=\"margin:0;border:0;\"><code>". GS_scripting_highlighting($update["script"]) . "</code></pre>";
		
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

				if ($number_of_notes > 1)
					echo "<span style=\"font-size:10px;\">{$update["note_version"][$note_index]}<span style=\"float:right;\">{$update["note_date"][$note_index]}</span></span><br>";
				
				echo $note;
				echo "</p>";
			}
			
			echo "</div>";
		}
		
		echo "</div>";
	}
	
	echo "</div><br><hr><br>";
}

if (!empty($js_addedon)) {
	$locale_file = "en-gb";
	
	switch(lang("THIS_CODE")) {
		case "ru-RU" : $locale_file="ru"; break;
	}
	
	echo "
	<script type=\"text/javascript\" src=\"usersc/js/gs_functions.js\"></script>
	<script type=\"text/javascript\" src=\"usersc/js/moment.js\"></script>
	<script type=\"text/javascript\" src=\"usersc/js/{$locale_file}.js\"></script>
	<script type=\"text/javascript\">
		GS_convert_addedon_date('mod_addedon',".json_encode($js_addedon).");
	</script>
	";
}

echo "</div>";

if (!empty($mods["info"]))
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
