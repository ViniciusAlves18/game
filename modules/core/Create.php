<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		require_once("../load.php");

		global $pdo;

		$Team_Name = strip_tags(trim($_POST["Team_Name"]));
		$Team_Onwer = strip_tags(trim($_POST["Team_Onwer"]));
		$Team_Sponsor = $_POST["Team_Sponsor"];
		$Team_Logo = "teste.jpg";
		$Team_Mmr = 1500;
		$Team_Money = 31500;

		$result = array();

		$Check = $pdo->prepare("SELECT * FROM team WHERE team_name= ?");
		$Check->execute(array($Team_Name));
		if($Check->rowCount() == 1)
		{	
			$result["Status"] = "NAME_EXIST";
		}
		else
		{
			$Insert = $pdo->prepare("INSERT INTO team SET team_name = ?, team_logo = ? , team_mmr = ? , team_onwer = ? , team_money = ? , team_sponsor = ?");
			$Dados = array($Team_Name,$Team_Logo,$Team_Mmr,$Team_Onwer,$Team_Money,$Team_Sponsor);
			if($Insert->execute($Dados))
			{
				$PegaDados = $pdo->prepare("SELECT * FROM account WHERE Username = ?");
				$PegaDados->execute(array($Team_Onwer));
				$Fetch = $PegaDados->fetchObject();

				$Update = $pdo->prepare("UPDATE account_id SET Team = '2',Team_name=? WHERE ID = ?");
				if($Update->execute(array($Team_Name,$Fetch->ID)))
				{
					$result["Status"] = "OK";
				}
				else
				{
					$result["Status"] = "NO";
				}
				
			}
			else
			{
				$result["Status"] = "NO";
			}
		}

		die(json_encode($result));
	}