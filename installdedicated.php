<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once "common.php";
?>

<div id="page-wrapper">
	<div class="container">
	
	<br>
	<div class="panel panel-default">
		<div class="panel-heading"><strong>Installing Mods on a Dedicated Server with the Game Schedule</strong></div>	
		<div class="panel-body">
			<p>To install/update modfolders on a dedicated server you have to use special mission which you can download here:</p>
			<p><a style="margin-left:20px;" href="download\gameschedule_dedicated_install.Intro.7z">gameschedule_dedicated_install.Intro.7z</a> 
			
			<?php		
			echo "<span style=\"color:#993366;font-size:10px;\">(".GS_convert_size_in_bytes(filesize("download/gameschedule_dedicated_install.Intro.7z"), "website").")</span>";
			echo "<span style=\"float:right;font-size:10px;\">".date("F d Y H:i",filemtime("download/gameschedule_dedicated_install.Intro.7z"))."</span>";
			?>
			
			</p>
			<p>For safety reasons only the server admin should have access to this mission.</p>
			<br>
			<p>Open <i>init.sqs</i> and change value there to your server unique identifier (it's displayed in the "Edit Server" section on the website).</p>			
			<p>If your server is set to private you have to copy the file <i>fwatch\tmp\schedule\params.bin</i> from your computer to the server.</p>
			<br>
			<p>Fwatch must be running on the server. It's not required for the player.</p>
			<p>Start the mission. Current schedule will be downloaded and mods will be installed.</p>
			<p>There is no user input. If modfolder exists without id then installer always creates a new copy. Installation script must not have commands that require user action: <i>ASK_GET</i> and <i>ASK_RUN</i>.
			Program will be terminated when they are encountered.</p>
			</p>
			<br>
			<p>Issues you examine in the same way as on client: by checking files <i>fwatch\data\addonInstallerLog.txt</i>, <i>fwatch\tmp\schedule\downloadLog.txt</i>, <i>fwatch\tmp\schedule\unpackLog.txt</i>, <i>fwatch\tmp\schedule\schedule.sqf</i>.
		</div>
	</div><!-- /panel -->				

	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>