<?php
$c = [];
for($i=6;$i>0;){
	$t = rand ( 1 , 49 );
	if (!in_array($t, $c)){
		$c[$i] = $t;
		$i--;
	} 
}
var_dump($c);