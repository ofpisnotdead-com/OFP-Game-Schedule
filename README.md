# OFP Game Schedule

Website for organizing [Operation Flashpoint](https://en.wikipedia.org/wiki/Operation_Flashpoint:_Cold_War_Crisis) / [ArmA: Cold War Assault](https://store.steampowered.com/app/65790/ARMA_Cold_War_Assault/) multiplayer sessions. Built with [UserSpice](https://userspice.com/) PHP framework. Made by [Faguss](https://ofp-faguss.com). Russian translation by [Mju](https://twitter.com/paumju)

[Live version](https://ofp-faguss.com/schedule/)


## Installation:

Requires PHP 7 and UserSpice 4.4.14

* Install [UserSpice](https://github.com/mudmin/UserSpice4)
* Install [Generated_Form](https://github.com/Faguss/Generated_Form) addon
* Copy [Parsedown.php](https://github.com/erusev/parsedown) to users\classes
* Copy GS files to your UserSpice installation folder.
* Run query from the file GS_table_structure.sql
* Go to Admin Dashboard --> Pages and add public access for pages: edit_server.php, edit_mod.php, installationscripts.php, quickstart.php, installdedicated.php, show.php, api_documentation.php, recent_activity.php
* Add administrator access for page admin_log.php
* Go to Permission Levels and add Unlimited User (ID-3) and Experienced user (ID-4)
