<?php

require_once "defines.php";
require_once "utils.php";

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(E_ALL);

/**
 * The custom assert callback.
 * @param  string $file The asser file.
 * @param  number $line The assert line.
 * @param  number $code The assert code.
 */
function fn_assert_callback($file, $line, $code)
{
	throw new Exception();
}

assert_options(ASSERT_ACTIVE, 1);
assert_options(ASSERT_WARNING, 0);
assert_options(ASSERT_QUIET_EVAL, 1);
assert_options(ASSERT_CALLBACK, "fn_assert_callback");

/**
 * Determines that an url is protected or not.
 * @param string $url The url.
 * @return true if the url is protected otherwise return false.
 */
function IsUrlProtected($url)
{
	return strpos($url, "/api/") !== FALSE;
}

/**
 * Initializes.
 * @return true if succeed otherwise return false.
 */
Flight::map("initialize", function()
{
	date_default_timezone_set("Asia/Ho_Chi_Minh");

	$pri = "";
	$pub = "";

	try
	{
		$pri = file_get_contents("commons/rsa/pri.key");
		$pub = file_get_contents("commons/rsa/pub.key");
		if (strlen($pri) == 0 || strlen($pub) == 0)
		{
			return false;
		}
	}
	catch(\Exception $e)
	{
		$pri = "";
		$pub = "";
	}

	Flight::set("rsa_pri", $pri);
	Flight::set("rsa_pub", $pub);

	Flight::set("flight.log_errors", true);

	$mysql = $GLOBALS["mysql"];
	Flight::register("db", "PDO", array(
		"mysql:host={$mysql["host"]};dbname={$mysql["name"]}",
		$mysql["user"],
		$mysql["pass"],
	));

	return true;
});

/**
 * Sends a HTTP-status to client.
 * @param	number	$code		The status code.
 * @param	number	$details	The details information.
 */
Flight::map("status", function($code, $details = [])
{
	# https://en.wikipedia.org/wiki/List_of_HTTP_status_codes
	# 1xx (Informational): The request was received, continuing process
	# 2xx (Successful): The request was successfully received, understood and accepted
	# 3xx (Redirection): Further action needs to be taken in order to complete the request
	# 4xx (Client Error): The request contains bad syntax or cannot be fulfilled
	# 5xx (Server Error): The server failed to fulfill an apparently valid request

	if ($code < 400)
	{
		return Flight::response()->status($code)->send();
	}

	$message = GetHTTPStatusMessage($code);

	$status = array(
		"code"		=> $code,
		"message"	=> $message,
		"details"	=> $details,
	);

	return Flight::halt($code, json_encode($status));
});

/**
 * Renders an page.
 * @param	string	$name	The page content file name.
 */
Flight::map("renderPage", function($name)
{
	$GLOBALS["file_page_content"] = $name;
    Flight::render("Page.Layout.php", $GLOBALS);
});

/**
 * Protects a URL by verifying the authorization token in the request headers.
 * @param	string	$url	The url.
 * @param	string	$fn		The function that determines an url is protected or not.
 */
Flight::map("protectUrl", function($url, $fn)
{
	if ($fn($url))
	{
		$status = \Auth\Verify();
		if (!$status->authorized)
		{
			Flight::status(401, $status);
		}
	}
});

?>