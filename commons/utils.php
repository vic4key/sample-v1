<?php

/**
 * The assert version for JSON.
 * @param	$obj The JSON object.
 */
function jassert($obj)
{
	assert(!empty($obj));
}

/**
 * Converts an array to a json object.
 * @param	array	$a	The array data.
 * @return json	The json data.
 */
function a2j($a)
{
	return json_decode(json_encode($a));
}

/**
 * Lazy load a JavaScript file.
 * @param  string $file The JavaScript file name.
 */
function LazyLoadScript($file)
{
	$GLOBALS["views"]["scripts"][] = $file;
}

/**
 * Lazy load a Cascading Style Sheets file.
 * @param  string $file The Cascading Style Sheets file name.
 */
function LazyLoadStyle($file)
{
	$GLOBALS["views"]["styles"][] = $file;
}

/**
 * Gets the HTTP status message by its status code.
 * @param number $code The status code.
 * @return The HTTP status message.
 */
function GetHTTPStatusMessage($code)
{
    $codes = \flight\net\Response::$codes;
    return (array_key_exists($code, $codes) ? $codes[$code] : "Unknown");
}

?>