<?php

require_once "controllers/demo.user.php";

/**
 * User APIs
 */

$IUsers = new \Controller\IUsers;

Flight::route("GET /api/users(/?@id:[me\d]+)", array($IUsers, "Get"));
Flight::route("PATCH /api/users/@id:[\d]+", array($IUsers, "Update"));
Flight::route("DELETE /api/users/@id:[\d]+", array($IUsers, "Delete"));

/**
 * Sign Up/In/Out
 */

Flight::route("POST /users", array($IUsers, "Create"));

Flight::route("POST /users/signin", array($IUsers, "Signin"));
Flight::route("DELETE /users/signout", array($IUsers, "Signout"));

?>