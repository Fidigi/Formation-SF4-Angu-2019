<?php
require "../vendor/autoload.php";

$redis = new Predis\Client(array(
    "scheme" => "tcp",
    "host" => "redis-19914.c3.eu-west-1-2.ec2.cloud.redislabs.com",
    "port" => "19914",
    "password" => "auBoW66cIzCWE6uXkHBXyXxxqN2IWiWr"));


$end = 5;
$limit = 0;
$redis->set('test', 'Hello World of Test 10', "ex", $end);

while($limit < $end){
	sleep(2);
	echo "*".$redis->get('test')."*<br>";
	$limit ++;
}

/*
redis-19914.c3.eu-west-1-2.ec2.cloud.redislabs.com:19914
auBoW66cIzCWE6uXkHBXyXxxqN2IWiWr
*/