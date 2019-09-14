<?php

namespace Controller;

require_once "models/demo.user.php";

class IUsers
{
	public function Get($id)
	{
		if (!empty($id) and !is_numeric($id))
		{
			$id = strtolower($id);
			if ($id !== "me")
			{
				return \Flight::status(204);
			}

			$auth = \Auth\Authorization();
			if (strlen($auth) == 0)
			{
				return \Flight::status(401);
			}

			$payload = \Auth\Decode($auth);
			if ($payload == null)
			{
				return \Flight::status(401);
			}

			return \Flight::json($payload->data);
		}

		$hasid = is_null($id);

		$sql  = "SELECT `id`, `name`, `age` FROM `tbl_user`";
		$sql .= $hasid ? "" : " WHERE `id` = $id";

		$users = \Flight::db()->query($sql)->fetchAll(\PDO::FETCH_CLASS, "Models\\User");
		if (count($users) == 0)
		{
			return \Flight::status(204);
		}

		return \Flight::json($hasid ? $users : $users[0]);
	}

	public function Create()
	{
		$data = \Flight::request()->getBody();
		echo "Create User <$data>";
	}

	public function Update($id)
	{
		$data = \Flight::request()->getBody();
		echo "Update User <$id> <$data>";
	}

	public function Delete($id)
	{
		echo "Delete User <$id>";
	}

	public function Signin($name = null, $pass = null)
	{
		$auth = \Auth\Authorization();
		if (strlen($auth) != 0)
		{
			return \Flight::status(208);
		}

		$result = array();

		$result["message"] = "Incorrect sign-in information";

		$name = \Flight::request()->data->name;
		$pass = \Flight::request()->data->pass;

		if (strlen($name) == 0 or strlen($pass) == 0)
		{
			return \Flight::json($result);
		}

		$user = $this->GetVerifyUser($name, $pass);
		if ($user == null)
		{
			return \Flight::json($result);
		}

		$result["user"] = $user;

		$auth = \Auth\Authorize($result["user"]);
		$cage = $GLOBALS["server"]["cage"];
		header("Set-Cookie: Authorization=$auth; Max-Age=$cage; path=/; httpOnly");

		$result["message"] = "Signed-in Successfully";

		\Flight::json($result);
	}

	public function Signout()
	{
		$result = array();

		$auth = \Auth\Authorization();
		if (strlen($auth) == 0)
		{
			return \Flight::status(401);
		}

		$payload = \Auth\Decode($auth);
		if ($payload == null)
		{
			return \Flight::status(401);
		}

		header("Set-Cookie: Authorization=\"\"; Max-Age=0; path=/; httpOnly");

		$result["message"] = "Signed-out Successfully";

		\Flight::json($result);
	}

	private function GetVerifyUser($name = null, $pass = null)
	{
		$sql   = "SELECT `id`, `name`, `age` FROM `tbl_user` WHERE `name` = \"$name\" AND `pass` = \"$pass\" LIMIT 1";
		$users = \Flight::db()->query($sql)->fetchAll(\PDO::FETCH_CLASS, "Models\\User");

		if (count($users) == 0)
		{
			return null;
		}

		return $users[0];
	}
}

?>