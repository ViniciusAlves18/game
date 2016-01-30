<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		require_once("../load.php");

		global $pdo;

		/*
			POST[]
		*/
		$Username = strip_tags(trim($_POST["Username"]));
		$Password = strip_tags(trim($_POST["Password"]));

		$result = array();
		/*
			CHECK[]
		*/
		$Check = $pdo->prepare("SELECT * FROM account WHERE Username= :user AND Password = :pass ");
		$Check->execute(array(
					":user" => $Username,
					":pass" => $Password
			));
		if($Check->rowCount() <= 0)
		{
			$result["Status"] = "NO";	
		}
		else
		{
			session_start();
			$_SESSION["Username"] = $Username;
			$_SESSION["Password"] = $Password;
			$result["Status"] = "SUCCESS";
			
		}

		die(json_encode($result));

	}