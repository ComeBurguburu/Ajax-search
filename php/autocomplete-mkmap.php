<?php
/*!
Autocomplete a input Ajax wrapper for jQuery 
by Côme BURGUBURU

Version 1.14.0
Full source at https://github.com/ComeBurguburu/autocomplete
Copyright (c) 2015-2042

*/
include("phpLIKE.php");

function extension($file){
	$tab=explode(".",$file);
	return $tab[count($tab)-1];
}

function mkmap($root,$find){
	$cpt=0;
	$max=isset($_REQUEST["max_values"])?$_REQUEST["max_values"]:null;

	$folder = opendir ($root);
if(LIKE($root,$find) || (isset($_REQUEST["show_all"]) && $_REQUEST["show_all"]==="true" && $find ==="")){
	if (count(scandir($root)) <= 2){
		echo "<div><img src=\"".("icon/folder.png")."\"/>".realpath($root)."\</div>";
		$cpt++;
		if($cpt===$max)
			exit;
}}

while ($file = readdir ($folder)) {
	if ($file != "." && $file != "..") {
		$pathfile = realpath($root.'\\'.$file); 

		if(@filetype($pathfile) == 'dir'){ 
			mkmap($pathfile,$find); 
		} 
		else{
			//die(print_r(Array("pathfil"=>$pathfile,"find"=>$find)));
			if(LIKE($pathfile,$find) || (isset($_REQUEST["show_all"]) && $_REQUEST["show_all"]==="true" && $find==="")){
				echo"<div>";

				if(file_exists("icon/".extension($file).".png")){
					echo "<img src=\"".("icon/".extension($file)).".png"."\"/>";
				}
				else{
					echo "<img src=\"".("icon/_blank.png")."\"/>";
				}


				echo realpath($pathfile)."</div>\n";
				$cpt++;
		if($cpt===$max)
			exit;
			}
		}
	} 
}
//echo "dn";
closedir ($folder);
}
if(!isset($_REQUEST["path"])){
	die("no param");
}
$find=$_REQUEST["path"];

$path="../..";
mkmap($path,$find);
?>
