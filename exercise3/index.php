<?php
function intSectArrays($arr1, $arr2){
	//If we don't get arrays return.
	if(!is_array($arr1) or !is_array($arr2)) return false;
	sort($arr1);   //sorting first returns faster results during test with higher numbers. 
	sort($arr2); 
	foreach($arr1 as $key => $value){
		if(!in_array($value, $arr2)){
			unset($arr1[$key]); 
		}
	}
	return $arr1; 	
}
$arr1 = array(3, 6, 9); 
$arr2 = array(7, 9, 3); 
var_dump(intSectArrays($arr1, $arr2)); 
?>