<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';


if (isset($_GET["lang"]) && $_GET["lang"]=="ru") {
	$_SESSION['us_lang'] = "ru-RU";
	include $abs_us_root.$us_url_root.'users/lang/'.$_SESSION['us_lang'].".php";
}
?>
<div id="page-wrapper">
	<div class="container">
		<?php languageSwitcher(); ?>
		
		<div class="jumbotron">
			<h2 align="center"><?=lang("GS_STR_QUICKSTART_WELCOME")?></h2>
			<p align="center" class="text-muted"><?=lang("GS_STR_QUICKSTART_DESCRIPTION2")?></p>
			<br>
			<h3 align="center"><a align="center" href="#players"><?=lang("GS_STR_QUICKSTART_FORPLAYERS") ?></a></h3>

			<br>
			<hr>
			<h2 align="center" style="color:#cc4f80;font-size:45px"><?=lang("GS_STR_QUICKSTART_FORORGANIZERS") ?>:</h2>
			<br>
<?php
$strings = [
	"GS_STR_QUICKSTART_FORORGANIZERS_LOGIN",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDSERV",
	"GS_STR_QUICKSTART_FORORGANIZERS_GOSCHEDULE",
	"GS_STR_QUICKSTART_FORORGANIZERS_ADDMODTOSERV",
	"GS_STR_QUICKSTART_FORORGANIZERS_SUBMITMOD",
	"GS_STR_QUICKSTART_FORPLAYERS_START",
	"GS_STR_QUICKSTART_FORPLAYERS_SHOWSERV",
	"GS_STR_QUICKSTART_FORPLAYERS_WAITINSTALL",
	"GS_STR_QUICKSTART_FORPLAYERS_CONNECT",
	"GS_STR_QUICKSTART_FORPLAYERS_HAVEFUN"
];
$images = [
	"mainmenu",
	"addnewserver",
	"schedule",
	"assignmod",
	"addnewmod",
	"serverdisplay",
	"downloadmods",
	"installing",
	"connect"
];

foreach ($strings as $i=>$string) {
	$arguments = [];

	if ($string == "GS_STR_QUICKSTART_FORPLAYERS_START") {
		echo "
		<a name=\"players\"></a>
		<br><br><br><br>
		<hr>
		<h2 align=\"center\" style=\"color:#cc4f80;font-size:45px\">".lang("GS_STR_QUICKSTART_FORPLAYERS")."</h2>
		<br>
		";
		$arguments = ["<A HREF=\"http://ofp-faguss.com/fwatch/116test\">", "</a><br><br>"];
	}
	
	if ($string == "GS_STR_QUICKSTART_FORORGANIZERS_LOGIN")
		$arguments = ["<a href='users/login.php' target='_blank'>Steam / Discord / VK / Google / Facebook</a>"];

	$image_name = "images/" . ($i+1) . "_" . $images[$i] . "_" . substr($lang["THIS_CODE"],0,2) . ".png";
	if (!file_exists($image_name))
		$image_name = substr($image_name,0,-3) . "jpg";
	
	echo "<p align=\"center\">".lang($string, $arguments)."</p>";
	
	if ($i < count($images))
	echo "
	<div class=\"text-center\">
		<img src=\"$image_name\" alt=\"{$images[$i]}\" class=\"img-thumbnail blackborder\">
	</div>
	<br><br>
	";
}
?>

			
			<br><br>
			<p><small><?=lang("GS_STR_TRANSLATION") ?></small></p>
			<br><br>			
		</div>
	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
