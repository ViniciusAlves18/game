<?php
	global $pdo;
	$PegaTeam = $pdo->prepare("SELECT * FROM team WHERE team_name = ?");
	$PegaTeam->execute(array($_GET["team_name"]));
	$PegaTeamFetch = $PegaTeam->fetchObject();

	$PegaDados = $pdo->prepare("SELECT * FROM account WHERE Username = ?");
	$PegaDados->execute(array($_SESSION["Username"]));
	$Fetch = $PegaDados->fetchObject();

	$Verifica = $pdo->prepare("SELECT * FROM account_id WHERE ID = ?");
	$Verifica->execute(array($Fetch->ID));
	$VerificaFetch = $Verifica->fetchObject();

	if($VerificaFetch->Team_name != $PegaTeamFetch->team_name)
	{
		exit("Você não pode acessar esta área");
	}
	else{
		$PegaPlayer = $pdo->prepare("SELECT * FROM players ORDER BY player_role ASC");
		$PegaPlayer->execute();

		$TeamPlayers = $pdo->prepare("SELECT * FROM team_player WHERE team_id= ?");
		$TeamPlayers->execute(array($PegaTeamFetch->team_id));
	}

?>
<div id="box">
	<div class="headerText"><h4>Sobre Contrações</h4></div>
	<div class="body">
		<p style="font-size:11px;">
		- Você pode buscar jogadores de todas as posições. <br>
		- Os preços dos jogadores são baseados nos preços dos hérois. <br>
		- Caso você já tenha um jogador da posição que deseja contratar, <br>
		apenas compre que automaticamente ele sera substituido. <br>
		- As escalão oficial são <b>5</b> jogadores. <br></p>
	</div>
</div>
<div id="box" style="width:63%;">
<div class="headerText"><h4>Lista de jogadores</h4></div>
<div class="body">
<table class="ui very basic celled table">
<thead>
    <tr>
    	<th>Jogador</th>
    	<th>Valor do Contrato</th>
    	<th>Ação</th>
  	</tr>
  </thead>
  <tbody>
  	 <?php
  	 	while($Flip = $PegaPlayer->fetchObject())
  	 	{
  	 		switch($Flip->player_role) {
  	 			case 1:
  	 				$Role = "Top";
  	 			break;

  	 			case 2:
  	 				$Role = "Jugle";
  	 			break;

  	 			case 3:
  	 				$Role = "Mid";
  	 			break;

  	 			case 4:
  	 				$Role = "Atirador";
  	 			break;

  	 			case 5:
  	 				$Role = "Suporte";
  	 			break;
  	 			
  	 			default:
  	 				$Role = "Error";
  	 			break;
  	 		}
  	 		echo"
				<tr>
	      		<td>
	        	<h4 class=\"ui image header\">
	          		
	          	<div class=\"content\">
	            	{$Flip->player_name}
	            <div class=\"sub header\">
	            	{$Role}
	          	</div>
	        	</div>
	      		</h4>
	      		</td>
	      		<td>
	        		R$ <b>".number_format($Flip->player_value,2)."</b>
	      		</td>
				<td>
					<a class=\"ui blue button buy\" id=\"buy_{$Flip->player_id}\" data-role=\"{$Flip->player_role}\" data-id=\"{$Flip->player_id}\">Contratar</a>
				</td>
      		";
  	 	}
  	 ?>
</tbody>
</table>
</div>
</div>


