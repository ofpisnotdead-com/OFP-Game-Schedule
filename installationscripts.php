<?php
require_once 'users/init.php';
require_once $abs_us_root.$us_url_root.'users/includes/template/prep.php';
?>

<div id="page-wrapper">
	<div class="container">
	
	
	<div class="jumbotron">
		<h1 align="center">How to Write Installation Instructions</h1>
		<p align="center" class="text-muted">These scripts will determine how your mod is going to be installed</p>
		<p align="center" style="font-size: 1em;">
			<a href="#auto_installation">Auto</a> &nbsp;
			<a href="#links">Links</a> &nbsp;
			<a href="#manual_installation">Manual</a> &nbsp;
			<a href="#installation_examples">Examples</a> &nbsp;
			<a href="#testing">Testing</a> &nbsp;
			<a href="#changelog">Changelog</a>
		</p>
	</div>
	
	
	
	<a name="auto_installation"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>Auto Installation</strong></div>
		<div class="panel-body">
			<p>Simply paste the link to the file and the installator will figure out what to do on its own. Write download to each file in a new line.</p>
			
<pre><code>ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25rel.rar
ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25patch1.rar</code></pre>
			
<br>		
			<p>Add <code>/password:</code> switch if an archive is locked</p>
			<pre><code>http://example.com/locked.rar  /password:123</code></pre>
			
			<br>
			<h4 class="commandtitle">How does it work?</h4>

			<p>Installer checks the extension of the downloaded file:
			<ul>
				<li>If it's <code>.rar</code>, <code>.zip</code>, <code>.7z</code>, <code>.ace</code> or <code>.exe</code> then it will extract it and inspect its contents</li>
				<li>If an <code>.exe</code> couldn't be unpacked then it will ask the user to run it</li>
				<li>If it's <code>.pbo</code> then it will move it to the <code>addons</code> directory in the modfolder.</li>
				<li>If it's <code>.pbo</code> but with more than one dot in its name (aka mission file) then it will be moved to the <code>Missions</code> directory in the modfolder.</li>
				<li>Other types of files are ignored</li>
			</ul></p>

			<p>When installer encounters a directory it will read its name:</p>
			<ul>
				<li>If it matches modfolder name then it will be moved to the game directory. Other modfolders will be ignored (exception: unless dir name is contained in the downloaded filename)</li>
				<li>If it matches <code>addons</code>, <code>bin</code>, <code>campaigns</code>, <code>dta</code>, <code>worlds</code>, <code>Missions</code>, <code>MPMissions</code> then it will be moved to the modfolder</li>
				<li>If it has a dot in its name (aka it's an unpacked mission) then it will be moved to the <code>Missions</code> directory in the modfolder</li>
				<li>In any other case it will go through the contents of a directory and apply the same rules for each file and folder there</p>
			</ul></p>

			<p>Existing files will be overwritten. Destination directories that don't exist will be created.<br>
			Installer will handle only the first encountered executable and ignore all others.</p>

		</div>
	</div><!-- /panel -->


	<a name="links"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>Link Format</strong></div>	
		<div class="panel-body">
			<p>Links must start with the protocol. Spaces should be replaced with <code>%20</code>. It's preferable to use direct links to files:</p>
			<pre><code>ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25rel.rar</code></pre>
			
			<p>If a direct link is not available then add more links to jump through the intermediate pages:</p>
<pre><code><span class="fake_link">&lt;starting url&gt;</span>  &lt;optionally intermediate links&gt;  <span class="download_filename">&lt;file name&gt;</span></code></pre>
			<p>You don't actually have to type in full urls but only the unique parts. Last argument is always a file name. If it contains spaces then put it in quotation marks. Examples:</p>
		
<pre><code><span class="fake_link">https://www.moddb.com/downloads/start/36064</span>  /downloads/mirror/  <span class="download_filename">ww4mod25rel.rar</span>
<span class="fake_link">http://www.mediafire.com/file/4rm6uf16ihe36ce</span>  ://download  <span class="download_filename">wgl512_2006-11-12.rar</span>
<span class="fake_link">https://www.gamefront.com/games/operation-flashpoint/file/fdf-mod</span>  fdf-mod/download  expires=  <span class="download_filename">fdfmod14_ww2.rar</span>
<span class="fake_link">https://docs.google.com/uc?export=download&id=1S_94TXo6EvKZas6QqjVbcKuuFn2vLrr9</span>  confirm=  <span class="download_filename">ww4mod25rel.rar</span></code></pre>
<p>More information on how to find intermediate links you'll find <a href="#testing">below</a>.</p>


<br><br>

To enable backup links add <code>/mirror</code> switch. If download failed then installer will try the one in the next line.
<pre><code><span class="fake_link">ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25rel.rar</span>  /mirror
<span class="fake_link">https://www.moddb.com/downloads/start/36064</span>  /downloads/mirror/  <span class="download_filename">ww4mod25rel.rar</span>  /mirror
<span class="fake_link">https://ofp.today/Addons</span>  file=ww4mod25rel.rar  <span class="download_filename">ww4mod25rel.rar</span></code></pre>
<p>Last link must not have the switch.</p>

		</div>
	</div><!-- /panel -->	
	
	
	
	<a name="manual_installation"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>Manual Installation</strong></div>
		<div class="panel-body">
		<p>There's a bunch of commands to make installer do exactly what you want:</p>
		
		<ul>
		<li><a href="#unpack">Unpack, Extract</a></li>
		<li><a href="#move">Move, Copy</a></li>
		<li><a href="#unpackpbo">UnpackPBO, ExtractPBO</a></li>
		<li><a href="#makepbo">MakePBO</a></li>
		<li><a href="#delete">Delete, Remove</a></li>
		<li><a href="#edit">Edit</a></li>
		<li><a href="#if_version">If_version, else, endif</a></li>
		<li><a href="#rename">Rename</a></li>
		<li><a href="#makedir">Makedir, Newfolder</a></li>
		<li><a href="#get">Get, Download</a></li>
		<li><a href="#ask_get">Ask_get, Ask_download</a></li>
		<li><a href="#ask_run">Ask_run, Ask_execute</a></li>
		</ul>
		<br>		
		
		<p>Some commands have aliases. For example <code>remove</code> and <code>delete</code> are the same.</p>
		<p>Write each command in a separate line.</p>
		<p>Commands usually require arguments. Separate them by spaces. If an argument contains space then put it in quotation marks.</p>
		<p>I recommend to capitalize command names for readability.</p>
		<p>Invalid command names will be ignored.</p>
		<p>Leading and trailing spaces will be ignored.</p>
		<p>Script can have both auto installation links and manual commands.</p>
		
<a name="unpack"></a><hr class="betweencommands">
<h3 class="commandtitle">Unpack, Extract</h3>
<pre><code>UNPACK  &lt;url or file&gt;  /password:&lt;text&gt;</code></pre>
<p>Extracts archive from the <span class="courier">fwatch\tmp\</span> directory to the <span class="courier">_extracted</span> subfolder (its previous contents are wiped).</p>
<br><br>
<p>Example:</p>
<pre><code>UNPACK  ftp://ftp.armedassault.info/ofpd/mods/fdfmod13_installer.exe</code></pre>
<br>
<p>How to handle nested archives:</p>
<pre><code>UNPACK  www.example.com/first.rar
UNPACK  _extracted\second.rar
UNPACK  _extracted\_extracted\third.rar</code></pre>
<br>
<p>Add <code>/password:</code> switch if an archive is locked</p>
<pre><code>UNPACK  first.rar  /password:123</code></pre>
<br>
<p>Use this command without any arguments to extract the last downloaded file.</p>




<a name="move"></a><hr class="betweencommands">
<h3 class="commandtitle">Move, Copy</h3>
<pre><code>MOVE  &lt;file or or url|&gt;  &lt;destination&gt;  &lt;new name&gt;  /no_overwrite  /match_dir</code></pre>
<p>Program will move or copy selected file or folder from the <span class="courier">fwatch\tmp\_extracted</span> directory to the modfolder.</p>
<p>Overwrites files.</p>
<p>Sub-directories in the destination path that don't exist will be created.</p>
<br><br>

<p>Example:</p>
<pre><code>MOVE  "FDFmod Readme.html"</code></pre>

<p>This will move<br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\fwatch\tmp\_extracted\FDFmod Readme.html</span><br>
to the<br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\&lt;modfolder&gt;\</span>
</p>

<br><br>

<pre><code>MOVE  example.pbo  addons</code></pre>

<p>This will move<br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\fwatch\tmp\_extracted\example.pbo</span><br>
to the<br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\&lt;modfolder&gt;\addons\</span>
</p>

<br><br>

<p><strong>Exception:</strong> if the directory you want to move has the same name as the modfolder you’re installing then the
destination path is changed to the game folder.</p>

<pre><code>MOVE  finmod</code></pre>

<p>This will move<br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\fwatch\tmp\_extracted\finmod</span><br>
to the<br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\</span>
</p>
<p>You can cancel this behaviour by specifying destination argument.</p>

<br><br>

<p>Wildcards can be used to match multiple files.</p>
<pre><code>MOVE  *.pbo  addons</code></pre>
<p>To match both files and folders add <code>/match_dir</code> switch.</p>
<pre><code>MOVE  *  /match_dir</code></pre>

<br><br>

<p>To rename a file write new name as the third argument.</p>	
<pre><code>MOVE  misc\readme.txt  docs  readme_old.txt</code></pre>
<p>Use dot if you don’t want to change location.</p>	
<pre><code>MOVE  misc\readme.txt  .  readme_old.txt</code></pre>

<br><br>

<p>Add <code>/no_overwrite</code> switch to disable overwriting files.</p>	
<pre><code>MOVE  *.pbo  addons  /no_overwrite</code></pre>

<br><br>

<p>If a link was passed then the file will be downloaded. Add a vertical bar to separate download arguments from the move arguments</p>	
<pre><code>MOVE  ftp://ftp.armedassault.info/ofpd/gameserver/editorupdate102.pbo  |  addons</code></pre>

<br><br>

<p>To access files in the modfolder start the first argument with <code>&lt;mod&gt;</code>.</p>	
<pre><code>MOVE  &lt;mod&gt;\addons\example.pbo  obsolete</code></pre>

<br><br>

<p>To access the last downloaded file use <code>&lt;download&gt;</code> or <code>&lt;dl&gt;</code> as the first argument.</p>	
<pre><code>MOVE  &lt;dl&gt;  addons</code></pre>

<br><br>

<p>Command <code>Copy</code> can take files from any location if the path starts with <code>&lt;game&gt;</code>.</p>	
<pre><code>COPY  &lt;game&gt;\bin\Resource.cpp  bin</code></pre>




<a name="unpackpbo"></a><hr class="betweencommands">
<h3 class="commandtitle">UnpackPBO, ExtractPBO</h3>
<pre><code>UNPACKPBO  &lt;file&gt;  &lt;destination&gt;</code></pre>
<p>Program will unpack selected PBO file from the modfolder directory.</p>
<p>Overwrites existing files.</p>
<br><br>
<p>Example:</p>
<pre><code>UNPACKPBO  addons\ww4_fx.pbo</code></pre>
<br><br>
<p>Optionally you can specify where to extract files. Sub‐directories in the destination path that don’t exist will be created.</p>
<pre><code>UNPACKPBO  addons\ww4_fx.pbo  temp</code></pre>
<br><br>
<p>To access files from any location start the path with <code>&lt;game&gt;</code>. If destination wasn’t specified then the addon will be unpacked to the modfolder.</p>
<pre><code>UNPACKPBO  &lt;game&gt;\addons\kozl.pbo  addons</code></pre>




<a name="makepbo"></a><hr class="betweencommands">
<h3 class="commandtitle">MakePBO</h3>
<pre><code>MAKEPBO  &lt;folder&gt;  /no_delete</code></pre>
<p>Program will create a PBO file (without compression) out of the selected folder from the modfolder and then remove the source.</p>

<br><br>
<p>Example:</p>
<pre><code>MAKEPBO  addons\ww4_fx</code></pre>

<br><br>
<p>Add switch <code>/no_delete</code> to keep the original directory.</p>
<pre><code>MAKEPBO  addons\ww4_fx  /no_delete</code></pre>

<br><br>
<p>Use this command without file name to pack the last addon extracted with <code>unpackpbo</code>.</p>





<a name="delete"></a><hr class="betweencommands">
<h3 class="commandtitle">Delete, Remove</h3>
<pre><code>DELETE  &lt;file&gt;  /match_dir</code></pre>
<p>Program will delete selected file or directory from the modfolder.</p>
<br><br>
<p>Example:</p>
<pre><code>DELETE  Install_win98_ME.bat</code></pre>
<br><br>
<p>Wildcards can be used to match multiple files.</p>
<pre><code>DELETE  addons\*.txt</code></pre>
<p>To match both files and folders add <code>/match_dir</code> switch.</p>
<pre><code>DELETE  temp\*  /match_dir</code></pre>
<br><br>
<p>Use this command without any arguments to remove the last downloaded file.</p>




<a name="edit"></a><hr class="betweencommands">
<h3 class="commandtitle">Edit</h3>
<pre><code>EDIT  &lt;file name&gt;  &lt;line number&gt;  &lt;text&gt;  /insert  /newfile</code></pre>
<p>Replaces text line in the selected file from the modfolder directory.</p>

<br><br>
<p>Example:</p>
<pre><code>EDIT addons\FDF_Suursaari\config.cpp - 58 - cutscenes[]      = {"..\finmod\addons\suursaari_anim\intro"};</code></pre>

<br><br>
<p>Add switch <code>/insert</code> to add a new line instead of replacing. If the line number is zero or exceeds the number of lines in the file then installer will add text at the end.</p>
<p>Use <code>/newline</code> to create a new file. Existing file will be trashed.</p>
<p>To access the last downloaded file use <code>&lt;download&gt;</code> or <code>&lt;dl&gt;</code>.</p>




<a name="if_version"></a><hr class="betweencommands">
<h3 class="commandtitle">If_version, else, endif</h3>
<pre><code>IF_VERSION  &lt;operator&gt;  &lt;number&gt;
ELSE
ENDIF</code></pre>
<p>Compares game version with given number.</p>
<p>If it’s correct then following instructions are executed until the end of the script or until program encounters <code>endif</code> command. Content between else and <code>endif</code> will be ignored.</p>
<p>If condition wasn’t correct then installer will skip commands until end of script or until it encounters <code>else</code> or <code>endif</code>.</p>
<p>Allowed comparison operators are: <code>=</code>, <code>==</code>, <code>&lt;</code>, <code>&lt;=</code>, <code>&gt;</code>, <code>&gt;=</code>, <code>&lt;&gt;</code>, <code>!=</code>. If there’s no operator then equality is assumed.</p>
<p>Conditions can be nested.</p>

<br><br>
<p>Example:</p>
<pre><code>IF_VERSION  <=  1.96
	UNPACK	https://www.mediafire.com/download/86d97zspupnjk9c  ://download  "WW4 Extended OFP patch v111.zip"
	MOVE	v196_patch\ww4ext_inf_cfg.pbo.OFP  addons  ww4ext_inf_cfg.pbo
ENDIF</code></pre>
<pre><code>IF_VERSION  >=  1.99
	COPY	&lt;game&gt;\bin\Config.cpp  bin
ELSE
	COPY	&lt;game&gt;\Res\bin\Config.cpp  bin
ENDIF</code></pre>




<a name="rename"></a><hr class="betweencommands">
<h3 class="commandtitle">Rename</h3>
<pre><code>RENAME  &lt;file&gt;  &lt;new name&gt;  /match_dir</code></pre>
<p>Program will rename selected file or directory from the modfolder.</p>
<br><br>
<p>Example:</p>
<pre><code>RENAME  addons\lo_res_tex.pbo  lo_res_tex.pbx</code></pre>
<br><br>
<p>Wildcards can be used to match multiple files.</p>
<pre><code>RENAME  addons\*.pbo  *.pbx
RENAME  addons\*.pbo  ??????????????????_OLD*</code></pre>
<p>To match both files and folders add <code>/match_dir</code> switch.</p>
<pre><code>RENAME  *  old_*  /match_dir</code></pre>




<a name="makedir"></a><hr class="betweencommands">
<h3 class="commandtitle">Makedir, Newfolder</h3>
<pre><code>MAKEDIR  &lt;path&gt;</code></pre>
<p>Creates a folder and its parents.</p>
<br><br>
<p>Example:</p>
<pre><code>MAKEDIR  addons
MAKEDIR  dta\hwtl</code></pre>
<p>This will create:</p>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\&lt;modfolder&gt;</span><br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\&lt;modfolder&gt;\addons</span><br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\&lt;modfolder&gt;\dta</span><br>
<span class="courier" style="margin-left:2em;">&lt;game folder&gt;\&lt;modfolder&gt;\dta\hwtl</span><br>




<a name="get"></a><hr class="betweencommands">
<h3 class="commandtitle">Get, Download</h3>
<pre><code>GET  &lt;url&gt;</code></pre>
<p>Downloads a file to the <span class="courier">fwatch\tmp\</span> directory.</p>
<br><br>
<p>Example:</p>
<pre><code>GET  ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25rel.rar</code></pre>




<a name="ask_get"></a><hr class="betweencommands">
<h3 class="commandtitle">Ask_get, Ask_download</h3>
<pre><code>ASK_GET  &lt;file name&gt;  &lt;url&gt;</code></pre>
<p>Requests the user to manually download given file. Installation is paused until user decides to continue or abort.</p>
<br><br>
<p>Example:</p>
<pre><code>ASK_GET  ww4mod25rel.rar  https://www.moddb.com/mods/sanctuary1/downloads/ww4-modpack-25</code></pre>




<a name="ask_run"></a><hr class="betweencommands">
<h3 class="commandtitle">Ask_run, Ask_execute</h3>
<pre><code>ASK_RUN  &lt;url or file&gt;</code></pre>
<p>Requests the user to manually launch selected file from the <span class="courier">fwatch\tmp\</span> directory. Installation is paused until user decides to continue or abort.</p> 
<p>Use this command for executables that cannot be extracted.</p>
<br><br>
<p>Examples:</p>
<pre><code>ASK_RUN  ftp://ftp.armedassault.info/ofpd/mods/ECP%20v1.085%20(Full%20Installer).exe
ASK_RUN  _extracted\example.exe</code></pre>
<br><br>
If the file is in the modfolder then start the path with <code>&lt;mod&gt;</code>.
<pre><code>ASK_RUN  &lt;mod&gt;\Install_win2k_XP.bat</code></pre>
<br><br>
<p>Use this command without any arguments to run the last downloaded file.</p>




		</div>
	</div><!-- /panel -->


	<a name="installation_examples"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>Example Installation Scripts</strong></div>
		<div class="panel-body">
			<p>This is a script for installing WW4 2.5 mod</p>

<pre><code>UNPACK  ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25rel.rar  /mirror
UNPACK  https://www.moddb.com/downloads/start/36064  /downloads/mirror/  ww4mod25rel.rar  /mirror
UNPACK  https://ofp.today/download/unofaddons2/ww4mod25rel.7z
MOVE    *  /match_dir

UNPACK  ftp://ftp.armedassault.info/ofpd/unofaddons2/ww4mod25patch1.rar  /mirror
UNPACK  https://ofp.today/download/unofaddons2/ww4mod25patch1.7z
MOVE    *.txt
MOVE    *.pbo  addons  /match_dir
MOVE    *  Bonus  /match_dir

UNPACK  http://ofp-faguss.com/fwatch/download/ofp_aspect_ratio206.rar
MOVE    Files\WW4mod25\Resource.cpp  bin

UNPACK  http://ofp-faguss.com/fwatch/download/anims_fwatch.rar
MOVE    Files\WW4mod25\Anims.pbo  dta

UNPACK     http://ofp-faguss.com/files/ww4_binoculars.zip
UNPACKPBO  dta\scripts.pbo
MOVE       ww4_fwatch_binoc.sqs  dta\scripts
MAKEPBO
MOVE       replacement\Config.cpp  bin</code></pre>

<hr class="betweencommands">

<p>This is a script for installing FDF 1.4 mod</p>

<pre><code>UNPACK  ftp://ftp.armedassault.info/ofpd/mods/fdfmod13_installer.exe /mirror
UNPACK  http://pulverizer.pp.fi/ewe/mods/fdfmod13_installer.exe /mirror
UNPACK  http://fdfmod.dreamhosters.com/ofp/fdfmod13_installer.exe /mirror
UNPACK  <SPAN STYLE="font-size:0.75em">https://www.gamefront.com/games/operation-flashpoint-resistance/file/finnish-defence-forces  finnish-defence-forces/download  expires=  fdfmod13_installer.exe</SPAN>
MOVE  * /match_dir
MOVE  "<mod>\Missions\FDF MOD\*"  Missions
DELETE  "Missions\FDF MOD"

UNPACK  ftp://ftp.armedassault.info/ofpd/mods/fdfmod14_ww2.rar  /mirror
UNPACK  http://pulverizer.pp.fi/ewe/mods/fdfmod14_ww2.rar  /mirror
UNPACK  http://fdfmod.dreamhosters.com/ofp/fdfmod14_ww2.rar  /mirror
UNPACK  https://www.gamefront.com/games/operation-flashpoint/file/fdf-mod  fdf-mod/download  expires=  fdfmod14_ww2.rar  /mirror
UNPACK  https://ofp.today/download/mods/fdfmod14_ww2.7z
MOVE  *  /match_dir
MOVE  "<mod>\Missions\FDF WW2\*"  Missions
DELETE  "Missions\FDF WW2"

UNPACK  ftp://ftp.armedassault.info/ofpd/mods/FDF_desert_pack.rar  /mirror
UNPACK  http://fdfmod.dreamhosters.com/ofp/FDF_desert_pack.rar  /mirror
UNPACK  https://ofp.today/download/mods/FDF_desert_pack.7z
MOVE  "FDF Mod - Al Maldajah - Readme.txt" readme_addons
MOVE  * /match_dir
MOVE  "<mod>\Missions\FDF MOD\*" Missions
DELETE  "Missions\FDF MOD"

UNPACK  ftp://ftp.armedassault.info/ofpd/islands2/fdf_winter_maldevic.rar /mirror
UNPACK  http://fdfmod.dreamhosters.com/ofp/fdf_winter_maldevic.rar /mirror
UNPACK  https://ofp.today/file/islands2/fdf_winter_maldevic.7z
MOVE  finmod
MOVE  "Missions\FDF Mod\*" Missions
MOVE  "FDF Mod - Winter Maldevic - Readme.txt" readme_addons

UNPACK  ftp://ftp.armedassault.info/ofpd/islands/Suursaari_release_v10.zip  /mirror
UNPACK  http://fdfmod.dreamhosters.com/ofp/Suursaari_release_v10.zip  /mirror
UNPACK  https://ofp.today/download/islands/Suursaari_release_v10.7z
MOVE    FDF_Suursaari.pbo  addons
MOVE    Suursaari_anim  addons
MOVE    *  readme_addons

UNPACKPBO  addons\FDF_Suursaari.pbo
EDIT       addons\FDF_Suursaari\config.cpp  58  "cutscenes[]      = {"..\finmod\addons\suursaari_anim\intro"};"
MAKEPBO

UNPACK  http://ofp-faguss.com/fwatch/download/ofp_aspect_ratio206.rar
MOVE    Files\FDF\Resource.cpp  bin

UNPACK  http://ofp-faguss.com/fwatch/download/anims_fwatch.rar
MOVE    Files\FDF\Anims.pbo  dta</code></pre>

<hr class="betweencommands">

<p>This is a script for installing WGL 5.12 mod</p>

<pre><code>ftp://ftp.armedassault.info/ofpd/unofaddons2/WGL5.1_Setup.exe  /mirror
https://www.moddb.com/downloads/start/93621  /downloads/mirror/  WGL5.1_Setup.exe  /mirror
https://ofp.today/Addons?dir=mods  file=WGL5.1_Setup.exe  WGL5.1_Setup.exe

http://pulverizer.pp.fi/ewe/mods/wgl512_2006-11-12.rar  /mirror
https://www.moddb.com/downloads/start/93801  /downloads/mirror/  wgl512_2006-11-12.rar  /mirror
http://www.mediafire.com/file/4rm6uf16ihe36ce  ://download  wgl512_2006-11-12.rar

IF_VERSION  <=  1.96
	UNPACKPBO  &lt;game&gt;\Res\Dta\HWTL\data.pbo  dta\HWTL
	COPY       &lt;mod&gt;\newdata\*.pa?           dta\HWTL\Data
	MAKEPBO
	
	UNPACKPBO  &lt;game&gt;\Res\Dta\HWTL\data3d.pbo  dta\HTWL
	COPY       &lt;mod&gt;\newdata\*.p3d             dta\HWTL\data3d
	MAKEPBO
ELSE
	UNPACKPBO  &lt;game&gt;\DTA\Data.pbo  dta
	COPY       &lt;mod&gt;\newdata\*.pa?  dta\Data
	MAKEPBO
	
	UNPACKPBO  &lt;game&gt;\DTA\Data3D.pbo  dta
	COPY       &lt;mod&gt;\newdata\*.p3d    dta\Data3D
	MAKEPBO
ENDIF

UNPACK  http://ofp-faguss.com/fwatch/download/ofp_aspect_ratio206.rar
MOVE    Files\WGL\Resource.cpp  bin

UNPACK  http://ofp-faguss.com/fwatch/download/anims_fwatch.rar
MOVE    Files\WGL\Anims.pbo  dta

UNPACK  http://pulverizer.pp.fi/ewe/missions/wglmiss.7z
MOVE    *  mpmissions</code></pre>
<!--
<hr class="betweencommands">

<p>This is a script for installing Llaumax sky replacement</p>

<pre><code>UNPACK  ftp://ftp.armedassault.info/ofpd/unofaddons2/OFPR_Addon_LlauMaxSkyPackV12.zip
IF_VERSION  <=  1.96
	UNPACKPBO  &lt;game&gt;\Res\Dta\HWTL\data.pbo  dta\HWTL
	MOVE  llaumax\newdata\*.pa?  dta\HWTL\Data
	MAKEPBO
	
	UNPACKPBO  &lt;game&gt;\Res\Dta\HWTL\data3d.pbo  dta\HTWL
	MOVE  llaumax\newdata\*.p3d  dta\HWTL\data3d
	MAKEPBO
ELSE
	UNPACKPBO  &lt;game&gt;\DTA\Data.pbo  dta
	MOVE  llaumax\newdata\*.pa?  dta\Data
	MAKEPBO
	
	UNPACKPBO  &lt;game&gt;\DTA\Data3D.pbo  dta
	MOVE  llaumax\newdata\*.p3d  dta\Data3D
	MAKEPBO
ENDIF</code></pre>
-->
		</div>
	</div><!-- /panel -->
	

	<a name="testing"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>Testing Scripts</strong></div>
		<div class="panel-body">
<ul>
<li>Write your installation script in the <span class="courier">fwatch\data\addonInstaller_test.txt</span></li>
<li>Run <span class="courier">addonInstaller.exe</span> with parameters <code>-testmod=&lt;mod name&gt;</code> and optionally <code>-testdir=&lt;folder name&gt;</code></span></li>
</ul>

<p>Example: <code>-testmod=@ww4mod25 -testdir=@test</code>. Folder <span class="courier">@test</span> will be treated as <span class="courier">@ww4mod25</span>.</p>
<p>See <span class="courier">fwatch\data\addonInstallerLog.txt</span> for feedback on the installation process.</p>
<p>Add parameter <code>-gameversion=&lt;number&gt;</code> for testing conditions.</p>
<br>
<p>In testing mode downloaded files won't be removed so you won't have to redownload them every time you run installator.</p>
<br>
<p>Installer will generate <span class="courier">fwatch\tmp\__downloadtoken</span> file which you can use to find intermediate download links:</p>
<ul>
<li>Open it in your web browser</li>
<li>Find <i>Download</i> button, right-click on it and select <i>Inspect</i></li>
<li>Property <i>href</i> contains the link you're looking for. Pick a small part of it that you think is unique</li>
<li>Do a search to make sure that the selected part does not occur anywhere else in the file</li>
<li>If it doesn't then you can add it to your installation script</li>
</ul>


		</div>
	</div><!-- /panel -->		

	<a name="changelog"></a><br>
	<div class="panel panel-default betweencommands">
		<div class="panel-heading"><strong>Version History</strong></div>
		<div class="panel-body">
<strong>0.1</strong> (03.03.17)<br>
First release.<br>
<br>
<br>
<strong>0.2</strong> (11.03.19)<br>
<ul>
<li>added commands: <code>Ask_Download</code>, <code>Delete</code>, <code>Rename</code>, <code>If_version</code>, <code>else</code>, <code>endif</code>, <code>Makepbo</code>, <code>UnpackPBO</code>, <code>Edit</code></li>
<li>renamed command <code>Execute</code> to <code>Ask_Execute</code></li>
<li>renamed command <code>Mdir</code> to <code>Makedir</code></li>
<br>
<li><code>Move</code> – now overwrites by default, added <code>/no_overwrite</code> switch</li>
<li><code>Move</code> – can access modfolder files with <code>&gt;mod&gt;</code> macro</li>
<li><code>Move</code> – can now rename files</li>
<li><code>Move</code> – wildcards will not match folders unless <code>/match_dir</code> switch was added</li>
<li><code>Move</code> – renamed macro <code>DOWNLOADED_FILENAME</code> to <code>&lt;download&gt;</code> and <code>&lt;dl&gt;</code></li>
<li><code>Move</code> – now source argument can be url</li>
<br>
<li><code>Copy</code> – can access game root directory with <code>&lt;game&gt;</code> macro</li>
<br>
<li><code>Makedir</code> – could be used to create custom folders in the game root directory – fixed</li>
<li><code>Makedir</code> – now creates modfolder if it’s missing</li>
<br>
<li><code>Unpack</code>, <code>Ask_Execute</code> – will work on downloaded file if no argument given</li>
<li><code>Unpack</code>, <code>Ask_Execute</code> – now source argument can be url</li>
<li><code>Unpack</code> – archive within archive was unpacked to the wrong folder – fixed</li>
<li><code>Unpack</code> – added <code>/password:</code> switch</li>
<br>
<li>Auto Installation – added <code>/password:</code> switch</li>
<br>
<li><code>Get</code> – now considered obsolete</li>
<br>
<li>added <code>-testmod</code> parameter</li>
</ul>

<br>
<br>
<strong>0.3</strong> (02.04.19)<br>
<ul>
<li>Download links can now be followed with <code>/mirror</code> switch</li>
<li>Download links can now be followed with extra arguments for multi-step downloading</li>
<br>
<li><code>Move</code> – wildcard with <code>/match_dir</code> will move modfolder to the game dir but not recursively</li>
<li><code>Move</code> – added vertical bar to separate download arguments from move arguments</li>
<br>
<li><code>Ask_Get</code> – doesn't make a request if file already exists</li>
<li><code>Ask_Get</code> – asks user to select download directory and saves its location</li>
<li><code>Ask_Get</code> – automatically moves file to the <span class="courier">fwatch\tmp\</span></li>
<br>
<li><code>Ask_Run</code> – executes the file instead of opening folder with it</li>
<li><code>Ask_Run</code> - restores "Aspect_Ratio.hpp" from before executing the file in order to keep user's settings</li>
<br>
<li><code>Get</code> - now considered active again</li>
<li><code>Get</code> - cannot pass custom wget arguments anymore</li>
<br>
<li>added <code>-testdir</code> parameter</li>
</ul>

<br>
<br>
<strong>0.31</strong> (06.04.19)<br>
<ul>
<li>Auto installation - doesn't ignore modfolders if their name is contained in downloaded filename</li>
</ul>

<br>
<br>
<strong>0.4</strong> (15.07.19)<br>
<ul>
<li><code>Edit</code> – added <code>/newfile</code> switch</li>
<li><code>Edit</code> – switch <code>/insert</code> can now be used to append text at the end</li>
</ul>







		</div>
	</div><!-- /panel -->	
	
	
	
	


	</div>
</div>

<!-- Place any per-page javascript here -->


<?php require_once $abs_us_root . $us_url_root . 'usersc/templates/' . $settings->template . '/footer.php'; //custom template footer ?>
