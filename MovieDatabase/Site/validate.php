<?php
	function validate($string){
		$forbiddenTags=array("/(<script)/i","/(<img)/i","/(<iframe)/i","/(([a-z]|[A-Z])>)/i","/(<([a-z]|[A-Z]))/i");
		$safe=TRUE;
		for($i=0; $i<count($forbiddenTags); $i++){
			if(preg_match($forbiddenTags[$i], $string)==1){
				$safe=FALSE;
			}
		}
		$forbiddenChars=array(chr(39),chr(34));
		for($i=0; $i<count($forbiddenChars); $i++){
			if(strpos($string,$forbiddenChars[$i])==true){
				$safe=FALSE;
			}
		}
		return $safe;
	}
	
