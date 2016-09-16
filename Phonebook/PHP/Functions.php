<?php 
header('Content-Type: application/json');
//Functions for modeling data 

include_once "./fObject.php";


	
function human_filesize($bytes, $decimals = 2) {
	  $sz = 'BKMGTP';
	  $factor = floor((strlen($bytes) - 1) / 3);
	  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}


//Functions triggered onLoad ev

	$arr=array();
	
	$dir="../Dir/";
	$files=array_diff(scandir($dir), array('..', '.'));
	
		foreach($files as $value)
		{		
		$fName=explode(".",$value)[0];				
				$fExtension=explode('.',$value)[1];
				
				$f=filesize("../Dir/".$value);
				
				$fSize=	human_filesize($f);
				$fileDetails=new fileObj($fName, $fExtension,$fSize);
				$element=serialize($fileDetails);
				array_push($arr,$fileDetails);																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																											
		}
		
		echo json_encode($arr);
		
?>