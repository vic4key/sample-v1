<?php

$HOST_NAME = $_SERVER["SERVER_NAME"];
$PORT_NUM  = $_SERVER["SERVER_PORT"];
$PROTOCOL  = $_SERVER["REQUEST_SCHEME"];

$SUB_PATH  = "/sample";
$HOST_URL  = sprintf("%s://%s", $PROTOCOL, $HOST_NAME);
$BASE_URL  = sprintf("%s%s", $HOST_URL, $SUB_PATH == "/" ? "" : $SUB_PATH);

$GLOBALS = array_merge($GLOBALS, array
(
	"title"		=> "Sample",
	"author"	=> "Vic P.",
	"year"		=> date("Y"),
	"server"	=> array
	(
		"host"		=> $HOST_NAME,
		"port"		=> $PORT_NUM,
		"prot"		=> $PROTOCOL,
		"root"		=> $HOST_URL,
		"base"		=> $BASE_URL,
		"cage"		=> 3*60,
	),
	"mysql"		=> array
	(
		"host"		=> $HOST_NAME,
		"name"		=> "sample",
		"user"		=> "root",
		"pass"		=> "mysql",
	),
	"views"		=> array(
		"scripts"	=> array(),
		"styles"	=> array(),
	)
));

?>