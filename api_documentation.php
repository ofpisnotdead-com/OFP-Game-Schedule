<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once "common.php";
$url = GS_get_current_url() . "api";

?>

<div id="page-wrapper">
	<div class="container">
	
	<br>
	<div class="panel panel-default">
		<div class="panel-heading"><strong>Game Schedule API</strong></div>	
		<div class="panel-body">
			<p>To get information in JSON format about the servers and mods on the website send a request to the <a href="<?=$url?>"><?=$url?></a> with the following arguments:</p>
			<br>
			
			<ul>
			<li><b>server</b> - server identificator. Alternatively write "current" to get all public servers with upcoming game times or "all" for all the public servers.</li>
			<li><b>mod</b> - mod identificator. Alternatively write "all" to get all public mods.</li>
			<li><b>ver</b> - mod version number. Installation details will start from the specified version. Default is 0.</li>
			<li><b>password</b> - password required to preview a private server or a private mod (when it's assigned to a private server).</p>
			</ul>
			<br>
			<p>Separate multiple values with a comma. "ver" is a parallel list to "mod".</p>
			
			<br>
			<p><b>Examples:</b><br>
				<a href="api?server=4abc47b3">api?server=4abc47b3</a><br>
				<a href="api?server=1eec0bb4&password=test">api?server=1eec0bb4&password=test</a><br>
				<a href="api?mod=559d7b3a">api?mod=559d7b3a</a><br>
				<a href="api?mod=c803832d,c4d807e7&ver=1.15,1">api?mod=c803832d,c4d807e7&ver=1.15,1</a><br>
				<a href="api?mod=6361f10f&password=test">api?mod=6361f10f&password=test</a><br>
			</p>
			
			<br>
			<p><a href="api_example.txt">Example PHP script</a></p>
		</div>
	</div><!-- /panel -->				

	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>