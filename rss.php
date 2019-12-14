<?php
require_once "minimal_init.php";
require_once "common.php";
header('Content-type: application/xml');
$output = "";
$url    = GS_get_current_url();





$output .= "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>
<rss version=\"2.0\" xmlns:atom=\"http://www.w3.org/2005/Atom\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">

<channel>
<title>OFP Game Schedule - Recent Activity</title>
<link>{$url}recent_activity</link>
<atom:link href=\"{$url}rss\" rel=\"self\" type=\"application/rss+xml\" />
<description>Organize OFP multiplayer sessions</description>
<language>en-us</language>
<lastBuildDate>" . date(DATE_RSS) . "</lastBuildDate>

<image>
	<title>OFP Game Schedule</title>
	<url>{$url}images/icon_128.jpg</url>
	<link>{$url}</link>
	<width>128</width>
	<height>128</height>
</image>
";

$db = DB::getInstance();

$exclude_list = [
	GS_LOG_SERVER_UPDATED,
	GS_LOG_SERVER_REVOKE_ACCESS,
	GS_LOG_MOD_REVOKE_ACCESS,
	GS_LOG_SERVER_SHARE_ACCESS,
	GS_LOG_MOD_SHARE_ACCESS,
	GS_LOG_SERVER_TRANSFER_ADMIN,
	GS_LOG_MOD_TRANSFER_ADMIN,
	GS_LOG_MOD_UPDATED,
	GS_LOG_MOD_SCRIPT_UPDATED,
	GS_LOG_MOD_SCRIPT_ADDED,
	GS_LOG_MOD_VERSION_UPDATED,
	GS_LOG_MOD_LINK_ADDED,
	GS_LOG_MOD_LINK_UPDATED,
	GS_LOG_MOD_LINK_DELETED
];


$table      = GS_get_activity_log(40, $exclude_list, false);
$timestamps = [];

foreach($table as $row) {
	$guid = $row["date"];

	if (in_array($row["date"],$timestamps))
		$guid = $row["date"] . count($timestamps);
	else
		$timestamps[] = $row["date"];
	
	$description = "";
	
	if (isset($row["server_name"]))
		$description .= "<a href=\"{$url}show.php?server={$row["server_id"]}\">".lang("GS_STR_SERVER")."</a><br>";
	
	if (isset($row["mod_name"])) {
		$version = "";
		
		if (isset($row["mod_version"]))	
			$version = "&ver=".(floatval($row["mod_version"])-0.01);
		
		$description .= "<a href=\"{$url}show.php?mod={$row["mod_id"]}$version\">".lang("GS_STR_MOD_PREVIEW_INST")."</a><br>";
	}
	
	if (isset($row["mod_changelog"]))
		$description .= "<br>".nl2br($row["mod_changelog"]);
	
	$output .= "
		<item>
			<title>{$row["description"]}</title>
			<link>{$url}recent_activity</link>
			<guid>$guid</guid>
			<pubDate>".date(DATE_RSS,$row["date"])."</pubDate>
			<description><![CDATA[$description]]></description>
		</item>
	";
}
		
$output .= "</channel></rss>";
echo $output;
?>