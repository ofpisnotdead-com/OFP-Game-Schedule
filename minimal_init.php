<?php
// Load userspice DB class
if (!class_exists('DB')) {
	$GLOBALS['config']['mysql'] = [];

	$file = fopen("users/init.php", "r");
	if ($file) {
		$config_line_found = false;
		
		while (!feof($file) && count($GLOBALS['config']['mysql'])<4) {
			$line = trim(fgets($file,512));
			
			if (!$config_line_found) {
				if (strpos($line,"\$GLOBALS['config']") !== false)
					$config_line_found = true;
			} else {
				foreach(["host", "username", "password", "db"] as $find)
					if (strpos($line,$find) !== false) {
						$tokens = explode("=>", str_replace(["'",","],"",$line));
						
						if (count($tokens) >= 2)
							$GLOBALS['config']['mysql'][trim($tokens[0])] = trim($tokens[1]);
					}
			}
		}
		
		fclose($file);
	}
	
	require_once "users/classes/Config.php";
	require_once "users/classes/DB.php";
	DB::getDB([]);
}



// Load userspice lang
if(!function_exists('lang')) {
	$lang = [
		"THIS_LANGUAGE" =>"English",
		"THIS_CODE"     =>"en-US",
		"MISSING_TEXT"  =>"Missing Text",
	];
	include("usersc/lang/en-US.php");

	function lang($key,$markers = NULL){
		global $lang, $us_url_root, $abs_us_root;
		if($markers == NULL){
			if(isset($lang[$key])){
			$str = $lang[$key];
		}else{
			$str = "";
		}
		}else{
			//Replace any dyamic markers
			if(isset($lang[$key])){
			$str = $lang[$key];
			$iteration = 1;
			foreach($markers as $marker){
				$str = str_replace("%m".$iteration."%",$marker,$str);
				$iteration++;
			}
		}else{
			$str = "";
		}
		}


		//Ensure we have something to return
		// dump($key);
		if($str == ""){
			if(isset($lang["MISSING_TEXT"])){
				$missing = $lang["MISSING_TEXT"];
			}else{
				$missing = "Missing Text";
			}
			//if nothing is found, let's check to see if the language is English.
			if(isset($lang['THIS_CODE']) && $lang['THIS_CODE'] != "en-US"){
				$save = $lang['THIS_CODE'];
				if($save == ''){
					$save = 'en-US';
				}
				//if it is NOT English, we are going to try to grab the key from the English translation
				include($abs_us_root.$us_url_root."users/lang/en-US.php");
				if($markers == NULL){
					if(isset($lang[$key])){
					$str = $lang[$key];
				}else{
					$str = "";
				}
				}else{
					//Replace any dyamic markers
					if(isset($lang[$key])){
					$str = $lang[$key];
					$iteration = 1;
					foreach($markers as $marker){
						$str = str_replace("%m".$iteration."%",$marker,$str);
						$iteration++;
					}
				}else{
					$str = "";
				}
				}
				$lang = [];
				include($abs_us_root.$us_url_root."users/lang/$save.php");
				if($str == ""){
					//This means that we went to the English file and STILL did not find the language key, so...
					$str = "{ $missing }";
					return $str;
				}else{
					//falling back to English
					return $str;
				}
			}else{
				//the language is already English but the code is not found so...
				$str = "{ $missing }";
				return $str;
			}
		}else{
			return $str;
		}
	}
}
?>