<?php

	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		require_once("../load.php");

		global $pdo;

		/*
			POST
		*/
		$Username = strip_tags(trim($_POST["Username"]));
		$Password = strip_tags(trim($_POST["Password"]));
		$Champion = strip_tags(trim($_POST["Champion"]));
		$Email 	  = strip_tags(trim($_POST["Email"]));

		$result = array();

		$CheckLogin = $pdo->prepare("SELECT Username FROM account WHERE Username=?");
		$CheckLogin->execute(array($Username));
		
		$CheckEmail = $pdo->prepare("SELECT Email FROM account WHERE Email=?");
		$CheckEmail->execute(array($Email));

		if($CheckLogin->rowCount() > 0)
		{
			$result["Status"] = "LOGIN_EXIST";
		}
		else if($CheckEmail->rowCount() > 0)
		{
			$result["Status"] = "EMAIL_EXIST";
		}
		else
		{
			/*
				Inserir =>
					Username
					Password
					Email
				Inserir AccountID =>
					ID
					Avatar
					Team => 1
					Champion
					Team_Name

			*/
			$InserirNoAccount = $pdo->prepare("INSERT INTO account SET Username=?,Password=?,Email=?");
			if($InserirNoAccount->execute(array($Username,$Password,$Email)))
			{/*
				$PegaNovoUser = $pdo->prepare("SELECT * FROM account WHERE Username=?");
				$PegaNovoUser->execute(array($Username));
				$PegaNovoUserFetch = $PegaNovoUser->fetchObject();
			*/	
				$InserirNoAccountID = $pdo->prepare("INSERT INTO account_id SET Avatar= ?,Team=?,Champion=?,Team_Name=?");
				if($InserirNoAccountID->execute(array(1,1,$Champion,'NULL')))
				{
					$result["Status"] = "OK";
				}	
			}
			
		}
		die(json_encode($result));
	}
	