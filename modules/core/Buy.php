<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		session_start();
		require_once("../load.php");
		
		global $pdo;

		$PlayerID = strip_tags(trim($_POST["PlayerID"]));
		$PlayerRole = strip_tags(trim($_POST["PlayerRole"]));

		/*
			Pega dados do Jogador
		*/
		$PegaJogador = $pdo->prepare("SELECT * FROM players WHERE player_id=?");
		$PegaJogador->execute(array($PlayerID));
		$PegaJogadorFetch = $PegaJogador->fetchObject();
		/*
			Pega Time do Usuario
		*/
		$PegaTime = $pdo->prepare("SELECT * FROM team WHERE team_onwer = ?");
		$PegaTime->execute(array($_SESSION["Username"]));
		$PegaTimeFetch = $PegaTime->fetchObject();

		/*
			Verificar se o time tem o dinheiro
		*/
		/*
			Verifica se o Cara ja possui o Player
		*/
		$PegaPlayerTeam = $pdo->prepare("SELECT * FROM team_player WHERE team_id= ?");
		$PegaPlayerTeam->execute(array($PegaTimeFetch->team_id));
		$PegaPlayerTeamFetch = $PegaPlayerTeam->fetchObject();
		$result = array();

		$Money = $PegaTimeFetch->team_money;
		$ValorPlayer = $PegaJogadorFetch->player_value;
		if($ValorPlayer > $Money)
		{
			$result["Status"] = "NOT_MONEY";
		}
		else if($PegaPlayerTeamFetch->top == $PegaJogadorFetch->player_name)
		{
			$result["Status"] = "EXISTS_PLAYER";
		}
		else if($PegaPlayerTeamFetch->jugle == $PegaJogadorFetch->player_name)
		{
			$result["Status"] = "EXISTS_PLAYER";
		}
		else if($PegaPlayerTeamFetch->mid == $PegaJogadorFetch->player_name)
		{
			$result["Status"] = "EXISTS_PLAYER";
		}
		else if($PegaPlayerTeamFetch->atirador == $PegaJogadorFetch->player_name)
		{
			$result["Status"] = "EXISTS_PLAYER";
		}
		else if($PegaPlayerTeamFetch->suporte == $PegaJogadorFetch->player_name)
		{
			$result["Status"] = "EXISTS_PLAYER";
		}
		else
		{
			$DescontarMoney = $pdo->prepare("UPDATE team SET team_money=team_money-$ValorPlayer WHERE team_name=?");
			if($DescontarMoney->execute(array($PegaTimeFetch->team_name)))
			{
				switch ($PlayerRole) {
					case 1:
						$UpdateNoTime = $pdo->prepare("UPDATE team_player SET top = ? WHERE team_id = ?");
						$UpdateNoTime->execute(array($PegaJogadorFetch->player_name,$PegaTimeFetch->team_id));
					break;

					case 2:
						$UpdateNoTime = $pdo->prepare("UPDATE team_player SET jugle = ? WHERE team_id = ?");
						$UpdateNoTime->execute(array($PegaJogadorFetch->player_name,$PegaTimeFetch->team_id));
					break;

					case 3:
						$UpdateNoTime = $pdo->prepare("UPDATE team_player SET mid = ? WHERE team_id = ?");
						$UpdateNoTime->execute(array($PegaJogadorFetch->player_name,$PegaTimeFetch->team_id));
					break;

					case 4:
						$UpdateNoTime = $pdo->prepare("UPDATE team_player SET atirador = ? WHERE team_id = ?");
						$UpdateNoTime->execute(array($PegaJogadorFetch->player_name,$PegaTimeFetch->team_id));
					break;

					case 5:
						$UpdateNoTime = $pdo->prepare("UPDATE team_player SET suporte = ? WHERE team_id = ?");
						$UpdateNoTime->execute(array($PegaJogadorFetch->player_name,$PegaTimeFetch->team_id));
					break;
				}
				$result["Status"] = "OK";
			}
			else
			{
				$result["Status"] = "NO";
			}
			
		}

		die(json_encode($result));
	}