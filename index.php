<?php
	session_start();
	require_once("modules/load.php");

	global $pdo;
	/*
		Pega dados do Usuario Logado
	*/
	if(isset($_SESSION["Username"]) && isset($_SESSION["Password"]))
	{
		$User = $pdo->prepare("SELECT * FROM account WHERE Username= ?"); 
		$User->execute(array($_SESSION["Username"]));
		$FetchUser = $User->fetchObject();
		/*
			Verificar usuario possui Time
		*/
		$TeamUser = $pdo->prepare("SELECT * FROM account_id WHERE ID= ?");
		$TeamUser->execute(array($FetchUser->ID));
		$FetchTeam = $TeamUser->fetchObject();
		/*
			Se Existir Equipe Ele cria buscar
		*/
		if($FetchTeam->Team == 2)
		{
			$TeamDados = $pdo->prepare("SELECT * FROM team WHERE team_onwer= ?");
			$TeamDados->execute(array($_SESSION["Username"]));
			$TeamDadosFetch = $TeamDados->fetchObject();
		}
	}	
?>
<!DOCTYPE html>
<html lang="pt_BR">
<head>
	<meta charset="UTF-8">
	<title>Team Menager Beta 2</title>
	<link rel="stylesheet" type="text/css" href="public/disc/semantic.min.css">
	<link rel="stylesheet" type="text/css" href="public/css/dragon.css">
</head>
<body>

	<!-- menu -->
	<div id="menu">
		<ul>
			<li><a href="home">Home</a></li>
			<?php if(isset($_SESSION["Username"]) && isset($_SESSION["Password"])): ?>
			<li><a href="user&username=<?php echo $_SESSION["Username"]; ?>"><?php echo $_SESSION["Username"]; ?></a></li>
			<?php 
				/*
					Verifica se o usuario possui time;
				*/
				if($FetchTeam->Team == 1){ 
			?>
			<li><a href="create">Create Team</a></li>
			<?php } else { ?>
			<li><a href="menager&team_name=<?php echo $TeamDadosFetch->team_name; ?>">Manage Team</a></li>
			<?php } ?>
			<li><a href="?Deslogar=true">Sign Out</a></li>
			<?php endif; ?>	
		</ul>
		<?php if(!isset($_SESSION["Username"]) && !isset($_SESSION["Password"])): ?>
		<div class="buttons">
			<a href="?cmd=cadastro" class="tiny ui blue button">Criar Conta</a>
			<button type="button" id="openModel" class="tiny ui orange button">Iniciar Sessão</button>
		</div>
		<?php endif; ?>
	</div>
	<!-- menu -->
	<!-- header -->
	<div id="header">
		<!-- logo -->
		<div class="logo"></div>
		<!-- logo -->
	</div>
	<!-- header -->
	<!-- conteudo -->
	<div id="conteudo">
		<?php
			$Page = new Page;
		?>
	</div>
	<!-- conteudo -->
	<!-- footer -->
	<div id="footer">
	<p>Todas imagens usadas e aplicadas neste site detem direitos da <b>Riot Games</b>.<br>
	<b>Site não possui nenhum intuito de gerar lucros.</b><br>
	   Todos direitos reservados &copy; <?php echo date("Y"); ?>
	   <br>
	   <a href="sobre">Sobre</a> - <a href="developer">Desenvolvedores</a>
	</p>
	</div>
	<!-- footer -->
	
	<!-- model -->
	<div class="ui small modal">
  	<i class="close icon"></i>
  	<div class="header">
    	Iniciar Sessão
  	</div>
  	<div class="image content">
    <div class="description">
      <p>
      	<form name="loginForm" id="loginForm" class="ui large form" method="POST">
      		<div class="field">
        	<div class="ui left icon input">
          	<i class="user icon"></i>
            	<input type="text" name="Username" placeholder="Digite seu Username" />
        	</div>
        	</div>

      		<div class="field">
          	<div class="ui left icon input">
            <i class="lock icon"></i>
            	<input type="password" name="Password" placeholder="Digite seu Password" />
          	</div>
        	</div>
			<button type="button" class="ui orange button Login" onclick="Load('?Login=true','responce','POST',Form('loginForm'));">Iniciar Sessão</button>
      	</p>
    	</form>
    	<div id="responce"></div>
    </div>
  	</div>
	</div>
	<!-- model -->
	<script type="text/javascript" src="public/js/jquery.js"></script>
	<script type="text/javascript" src="public/js/ahri.js"></script>
	<script type="text/javascript" src="public/js/ajax.js"></script>
	<script type="text/javascript" src="public/disc/semantic.min.js"></script>
</body>
</html>