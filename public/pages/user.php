<?php
	global $pdo;

	$PegaUser = $pdo->prepare("SELECT * FROM account WHERE Username = ?");
	$PegaUser->execute(array($_GET["username"]));
	$PegaUserFetch = $PegaUser->fetchObject(); 

	$PegaAccountID = $pdo->prepare("SELECT * FROM account_id WHERE ID = ?");
	$PegaAccountID->execute(array($PegaUserFetch->ID));
	$PegaAccountIDFetch = $PegaAccountID->fetchObject();

?>

<div id="box">
	<div class="headerText"><h4><?php echo $PegaUserFetch->Username; ?></h4></div>
	<div class="body">
		
		<ul>
			<li>Username : {{Username}}</li>	
			<li>Email : ***{{Email}}</li>
			<li>Heroi Favorito : {{Champion}}</li>
			<li>Team Name : {{Team_Name}}</li>
		</ul>

	</div>
</div>