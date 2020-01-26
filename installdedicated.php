<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
require_once "common.php";
?>

<div id="page-wrapper">
	<div class="container">
	
	<br>
	<div class="panel panel-default">
		<div class="panel-heading"><strong>Installing Mods on a Dedicated Server with Fwatch</strong></div>	
		<div class="panel-body">
			<p>You can remotely install and update modfolders by running this special mission:</p>
			<p><a style="margin-left:20px;" href="download\gameschedule_dedicated_install.Intro.7z">gameschedule_dedicated_install.Intro.7z</a> 
			<?php		
			echo "<span style=\"color:#993366;font-size:10px;\">(".GS_convert_size_in_bytes(filesize("download/gameschedule_dedicated_install.Intro.7z"), "website").")</span>";
			echo "<span style=\"float:right;font-size:10px;\">".date("F d Y H:i",filemtime("download/gameschedule_dedicated_install.Intro.7z"))."</span>";
			?>
			</p>
			<br>
			<br>
			
			<p>Open <i>init.sqs</i> and change id value to your server unique identifier (you can find it in the "Edit Server" menu).</p>
			
			<p>If your server is set to private then transfer <i>fwatch\tmp\schedule\params.bin</i> from your computer.</p>
			
			<p>For safety reasons only the server admin should have access to this mission.</p>
			
			<p>Fwatch must be running on the server. It's not required for the player.</p>
			
			<p>Mission will download current schedule and install mods. 
			There is no user input. 
			If modfolder already exists but without id then installer will create a new copy. 
			Installation script must not have commands that require user action (<i>ASK_GET</i> and <i>ASK_RUN</i>). Otherwise installer will terminate.
			</p>
			<br>
			<br>

			<p>In case of issues check log files:</p>
			<ul>
				<li>fwatch\data\addonInstallerLog.txt</li>
				<li>fwatch\tmp\schedule\downloadLog.txt</li>
				<li>fwatch\tmp\schedule\unpackLog.txt</li>
				<li>fwatch\tmp\schedule\schedule.sqf</li>
			</ul>
		</div>
	</div><!-- /panel -->				

	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>