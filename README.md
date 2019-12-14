# OFP Game Schedule

Website for organizing Operation Flashpoint / ArmA: Cold War Assault multiplayer sessions. Built on [UserSpice](https://userspice.com/) PHP framework.

By [Faguss](https://ofp-faguss.com).


## Installation:

Requires PHP 7 and UserSpice 4.4.14

* Install [UserSpice](https://github.com/mudmin/UserSpice4)
* Install [Generated_Form](https://github.com/Faguss/Generated_Form) addon
* Copy GS files to your UserSpice installation folder.
* Run query from GS_table_structure.sql
* Go to Admin Dashboard --> Pages and add public access for pages: edit_server.php, edit_mod.php, installationscripts.php, quickstart.php, installdedicated.php, show.php, api_documentation.php, recent_activity.php
* Add administrator access for page admin_log.php
* Go to Permission Levels and add Unlimited User (ID-3) and Experienced user (ID-4)
