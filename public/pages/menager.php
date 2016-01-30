<?php
	global $pdo;
	$PegaDados = $pdo->prepare("SELECT * FROM account WHERE Username = ?");
	$PegaDados->execute(array($_SESSION["Username"]));
	$Fetch = $PegaDados->fetchObject();
	$Verifica = $pdo->prepare("SELECT * FROM account_id WHERE ID = ?");
	$Verifica->execute(array($Fetch->ID));
	$VerificaFetch = $Verifica->fetchObject();
	if($VerificaFetch->Team == 1)
	{
		echo "Você ainda não possui nenhuma Equipe.";
	}
	else
	{
		$PegaTeam = $pdo->prepare("SELECT * FROM team WHERE team_name= ?");
		$PegaTeam->execute(array($_GET["team_name"]));
		$FetchPegaTeam = $PegaTeam->fetchObject();
		if($VerificaFetch->Team_name != $FetchPegaTeam->team_name)
		{
			exit("Você não pode acessar esta área");
		}
		else{
			$LineUp = $pdo->prepare("SELECT * FROM team_player WHERE team_id = ?");
			$LineUp->execute(array($FetchPegaTeam->team_id));
			if($LineUp->rowCount() == 0)
			{
				$CriarTeamPlayer = $pdo->prepare("INSERT INTO team_player SET team_id = ?");
				$CriarTeamPlayer->execute(array($FetchPegaTeam->team_id));
			}
			else
			{
				$LineFetch = $LineUp->fetchObject();
			}
		}
?>
<div id="box">
	<div class="headerText"><h4><?php echo $FetchPegaTeam->team_name; ?></h4></div>
	<div class="body">
	<p style="font-size:13px;">
		- Veja as informações básicas da sua Equipe: <br>
		 Dono da Organição: <b><?php echo $Fetch->Username; ?></b><br>
		 Caixa disponivel: R$<b><?php echo number_format($FetchPegaTeam->team_money,2); ?></b><br>

	</p>
		<ul style="list-style:none;">
			<li><i class="angle right icon"></i><a href="">Contratos</a></li>
			<li><i class="angle right icon"></i><a href="match">JOGAR!</a></li>
			<li><i class="angle right icon"></i><a href="">Desfazer Equipe</a></li>
			<li><i class="angle right icon"></i><a href="buy&team_name=<?php echo $FetchPegaTeam->team_name; ?>">Buscar jogadores</a></li>
		</ul>
	</div>
</div>
<div id="box">
	<div class="headerText"><h4>Lineup</h4></div>
	<div class="body">
		<?php 
			$Top = $LineFetch->top;
			$Mid = $LineFetch->mid;
			$Jugle = $LineFetch->jugle;
			$Atirador = $LineFetch->atirador;
			$Suporte = $LineFetch->suporte;
			if(empty($Top) && empty($Mid) && empty($Jugle) && empty($Atirador) && empty($Suporte))
			{
				echo "Você ainda não contrato nenhum jogador";
			}
			else
			{
		?>
		<div id="lineBox">
			<img src="public/img/players/default.png"/>
			<div class="descript">
				<b><?php echo $Top;?></b>
				<br>
				<i>Top Laner</i>
			</div>
		</div>
		<div id="lineBox">
			<img src="public/img/players/default.png"/>
			<div class="descript">
				<b><?php echo $Mid;?></b>
				<br>
				<i>Mid Laner</i> 
			</div>
		</div>
		<div id="lineBox">
			<img src="public/img/players/default.png"/>
			<div class="descript">
				<b><?php echo $Jugle;?></b>
				<br>
				<i>Jugle</i> 
			</div>
		</div>
		<div id="lineBox">
			<img src="public/img/players/brtt.png"/>
			<div class="descript">
				<b><?php echo utf8_encode($Atirador);?></b>
				<br>
				<i>Atirador</i> 
			</div>
		</div>
		<div id="lineBox">
			<img src="public/img/players/default.png"/>
			<div class="descript">
				<b><?php echo $Suporte;?></b>
				<br>
				<i>Suporte</i>  
			</div>
		</div>
	<?php } ?>
	</div>
</div>

<div id="box">
	<div class="headerText"><h4>Campeonato</h4></div>
	<div class="body">
		
		<?php
		for($i=1;$i<9;$i++)
		{
			echo $i."º - ".$_GET["team_name"]." -  pts<br>".$i+1000;

		
		}
		?>

	</div>
</div>
<?php } ?>