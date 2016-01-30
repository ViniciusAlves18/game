<?php
	global $pdo;

	$PegaDados = $pdo->prepare("SELECT * FROM account WHERE Username = ?");
	$PegaDados->execute(array($_SESSION["Username"]));
	$Fetch = $PegaDados->fetchObject();
	$Verifica = $pdo->prepare("SELECT * FROM account_id WHERE ID = ?");
	$Verifica->execute(array($Fetch->ID));
	$VerificaFetch = $Verifica->fetchObject();
	if($VerificaFetch->Team == 2)
	{
		echo "Você ja possui uma Equipe.";
		$PegaTeam = $pdo->prepare("SELECT * FROM team WHERE team_onwer= ?");
		$PegaTeam->execute(array($_SESSION["Username"]));
		$FetchTeam = $PegaTeam->fetchObject();
		header("Location: menager&team_name=".$FetchTeam->team_name);
	}
	else
	{
?>

	<div id="box">
	<div class="header">
		<img src="public/img/box/cblol.jpg"/>
	</div>
	<div class="body">
		<h4>Informações Iniciais</h4>
			<ul style="list-style:none;">
				<li>Caixa Inicial - R$<b>75</b> Mil</li>
				<li>Campeonato Inicial - <b>CBLOL</b> / <?php echo date("Y"); ?></li>
				<li>MMR Inicial - 1500 (Ouro - Tier V)</li>
			</ul>
		</div>
	<div class="footer">
			<button type="button" id="Create" class="mini ui blue button">Create Team</button>
	</div>
	</div>
	<div id="box">
	<div class="headerText"><h4>Coloque as Informações abaixo parar criar um Time</h4></div>
	<div class="body">
		
		<form class="ui  form" method="POST">
			<div class="fields">
		    <div class="field" id="Org">
		      <label>Organização</label>
		      <input type="text" name="Team_Name" id="Team_Name" placeholder="Exemplo Slog Gaming" />
		    </div>
		    <div class="field">
		    <!-- 1 => None | 2 => Razer | 3 => Azubu | 4 => Alpha | 5 => Twitch | 6 => Nvidia -->
		      <label>Patrocinadores</label>
		      <select name="Team_Sponsor" id="Team_Sponsor" class="ui dropdown">
		      	<option value="1">Nenhum</option>
		      	<option value="2">Razer</option>
		      	<option value="3">Azubu</option>
		      	<option value="4">Alpha</option>
		      	<option value="5">Twitch</option>
		      	<option value="6">Nvidia</option>
		      </select>
		    </div>
		    <div class="field">
		      <label>Dono</label>
		      <div class="disabled field">
		          <input type="text" value="<?php echo $_SESSION["Username"]; ?>" name="Team_Onwer" id="Team_Onwer" disabled=""/>
		      </div>
		      </div>
		  </div>
		</form>
	</div>
</div>
<?php } ?>