<?php

namespace Auth;

require_once "libraries/Firebase/JWT/JWT.php";

define("Bearer", "Bearer ");

/**
 * Gets the authorization token in headers.
 * @param boolean $noschema Removes schema or not ?
 * @return The authorization token.
 */
function Authorization($noschema = true)
{
	$result = \Flight::request()->cookies->Authorization;

	if (strlen($result) == 0)
	{
		$headers = getallheaders();
		if (!empty($headers) and array_key_exists("Authorization", $headers))
		{
			$result = $headers["Authorization"];
		}
	}

	if ($noschema)
	{
		$result = substr($result, strlen(Bearer));
	}

	return $result;
}

/**
 * Decodes an authorization token.
 * @param string $auth The authorization token.
 * @return json The payload.
 */
function Decode($auth)
{
	$pub = \Flight::get("rsa_pub");
	if (strlen($pub) == 0)
	{
		return null;
	}

	$result = null;

	try
	{
		$result = \Firebase\JWT\JWT::decode($auth, $pub, array("RS256"));
	}
	catch (\Exception $e)
	{
		return null;
	}

	return $result;
}

/**
 * Verifies an authorization token in the requested header.
 * @return json	The verification status.
 */
function Verify()
{
	$result = array();

	$result["authorized"] = false;
	$result["message"] = "";

	$auth = \Auth\Authorization();
	if (strlen($auth) == 0)
	{
		$result["message"] = "Verification Required";
		return a2j($result);
	}

	$payload = Decode($auth);
	if ($payload == null)
	{
		$result["message"] = "Access Denied";
		return a2j($result);
	}

	$result["authorized"] = true;
	$result["message"] = "Access Granted";

	return a2j($result);
}

/**
 * Generates an authorization token.
 * @param array	$data	The data that to include into the payload.
 * @return string	An authorization token.
 */
function Authorize($data)
{
	$pri = \Flight::get("rsa_pri");
	if (strlen($pri) == 0)
	{
		return "";
	}

	$iat = time();

	$payload = array(
		"sub"	=> $GLOBALS["title"],
		"name"	=> $GLOBALS["author"],
		"iss"	=> $GLOBALS["server"]["base"],
		"exp"	=> $iat + $GLOBALS["server"]["cage"],
		"iat"	=> $iat,
		"data"	=> $data,
	);

	$encoded = \Firebase\JWT\JWT::encode($payload, $pri, "RS256");
	if (strlen($encoded) == 0)
	{
		return "";
	}

	return Bearer.$encoded;
}

?>