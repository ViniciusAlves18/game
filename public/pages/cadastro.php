<?php
    if(isset($_SESSION["Username"]) && isset($_SESSION["Password"]))
    {
        echo "Você não pode visualizar está página";
    }
    else
    {
?>
<div id="box" style="width:50%;">
	<div class="headerText"><h4>Cadastro</h4></div>
	<div class="body">
		<form name="CadastroForm" id="CadastroForm" class="ui large form" method="POST">
			<div class="field">
			<label>Username:</label>
        	<div class="ui left icon input">
          	<i class="user icon"></i>
            	<input type="text" name="Username" id="Username" placeholder="Digite um Username" />
        	</div>
        	</div>

      		<div class="field">
      		<label>Password:</label>
          	<div class="ui left icon input">
            <i class="lock icon"></i>
            	<input type="password" name="Password" id="Password" placeholder="Digite um Password" />
          	</div>
        	</div>

        	<div class="field">
        	<label>Email:</label>
          	<div class="ui left icon input">
            <i class="mail icon"></i>
            	<input type="text" name="Email" id="Email" placeholder="Digite seu Email" />
          	</div>
        	</div>

        	<div class="field">
        	<label>Selecione seu Héroi Favorito:</label>
          	<div class="ui left icon input">
            <select name="Champion" id="Champion">
            	<option value="Aatrox">Aatrox</option>
            	<option value="Ahri">Ahri</option>
            	<option value="Akali">Akali</option>
            	<option value="Alistar">Alistar</option>
            	<option value="Anivia">Anivia</option>
            	<option value="Annie">Annie</option>
            	<option value="Ashe">Ashe</option>
            	<option value="Azir">Azir</option>

            	<option value="Bardo">Bardo</option>
            	<option value="Blitzcrank">Blitzcrank</option>
            	<option value="Brand">Brand</option>
            	<option value="Braum">Braum</option>

            	<option value="Caitlyn">Caitlyn</option>
            	<option value="Cassiopeia">Cassiopeia</option>
            	<option value="ChoGath">Cho'Gath</option>
            	<option value="Corki">Corki</option>

            	<option value="Darius">Darius</option>
            	<option value="Diana">Diana</option>
            	<option value="DrMundo">Dr. Mundo</option>
            	<option value="Draven">Draven</option>

            	<option value="Ekko">Ekko</option>
            	<option value="Elise">Elise</option>
            	<option value="Evelynn">Evelynn</option>
            	<option value="Ezreal">Ezreal</option>

            	<option value="Fiddlesticks">Fiddlesticks</option>
            	<option value="Fiora">Fiora</option>
            	<option value="Fizz">Fizz</option>

            	<option value="Galio">Galio</option>
            	<option value="Gangplank">Gangplank</option>
            	<option value="Garen">Garen</option>
            	<option value="Gnar">Gnar</option>
            	<option value="Gragas">Gragas</option>
            	<option value="Graves">Graves</option>

            	<option value="Hecarim">Hecarim</option>
            	<option value="Heimerdinger">Heimerdinger</option>

            	<option value="Illaoi">Illaoi</option>
            	<option value="Irelia">Irelia</option>

            	<option value="Janna">Janna</option>
            	<option value="JarvanIV">Jarvan IV</option>
            	<option value="Jax">Jax</option>
            	<option value="Jayce">Jayce</option>
            	<option value="Jinx">Jinx</option>

            	<option value="Karma">Karma</option>
            	<option value="Karthus">Karthus</option>
            	<option value="Kassadin">Kassadin</option>
            	<option value="Katarina">Katarina</option>
            	<option value="Kayle">Kayle</option>
				<option value="Kennen">Kennen</option>
            	<option value="KhaZix">Kha'Zix</option>
            	<option value="Kindred">Kindred</option>
            	<option value="KogMaw">Kog'Maw</option>
            	
            	<option value="LeBlanc">LeBlanc</option>
            	<option value="LeeSin">Lee Sin</option>
            	<option value="Leona">Leona</option>
            	<option value="Lissandra">Lissandra</option>
            	<option value="Lucian">Lucian</option>
            	<option value="Lulu">Lulu</option>
            	<option value="Lux">Lux</option>

            	<option value="Malzahar">Malzahar</option>
            	<option value="Maokai">Maokai</option>
            	<option value="MasterYi">Master Yi</option>
            	<option value="MissFortune">MissFortune</option>
            	<option value="Mordekaiser">Mordekaiser</option>
            	<option value="Morgana">Morgana</option>
            	
            	<option value="Nami">Nami</option>
            	<option value="Nasus">Nasus</option>
            	<option value="Nautilus">Nautilus</option>
            	<option value="Nidalee">Nidalee</option>
            	<option value="Nocturne">Nocturne</option>
            	<option value="Nunu">Nunu</option>

            	<option value="Olaf">Olaf</option>
            	<option value="Orianna">Orianna</option>

            	<option value="Pantheon">Pantheon</option>
            	<option value="Poppy">Poppy</option>

            	<option value="Quinn">Quinn</option>
            	
            	<option value="Rammus">Rammus</option>
            	<option value="RekSai">Rek'Sai</option>
            	<option value="Renekton">Renekton</option>
            	<option value="Rengar">Rengar</option>
            	<option value="Riven">Riven</option>
            	<option value="Rumble">Rumble</option>
            	<option value="Ryze">Ryze</option>

            	<option value="Sejuani">Sejuani</option>
            	<option value="Shaco">Shaco</option>
            	<option value="Shen">Shen</option>
            	<option value="Shyvana">Shyvana</option>
            	<option value="Singed">Singed</option>
            	<option value="Sion">Sion</option>
            	<option value="Sivir">Sivir</option>
            	<option value="Skarner">Skarner</option>
            	<option value="Sona">Sona</option>
            	<option value="Soraka">Soraka</option>
            	<option value="Swain">Swain</option>
            	<option value="Syndra">Soraka</option>
            	
            	<option value="TahmKench">Tahm Kench</option>
            	<option value="Talon">Talon</option>
            	<option value="Taric">Taric</option>
            	<option value="Teemo">Teemo</option>
            	<option value="Thresh">Thresh</option>
            	<option value="Tristana">Tristana</option>
            	<option value="Trundle">Trundle</option>
            	<option value="Tryndamere">Tryndamere</option>
            	<option value="TwistedFate">Twisted Fate</option>
            	<option value="Twitch">Twitch</option>

            	<option value="Urgot">Urgot</option>

            	<option value="Varus">Varus</option>
            	<option value="Vayne">Vayne</option>
            	<option value="Veigar">Veigar</option>
            	<option value="VelKoz">Vel'Koz</option>
				
				<option value="Vi">Vi</option>
            	<option value="Viktor">Viktor</option>
            	<option value="Vladimir">Vladimir</option>
            	<option value="Volibear">Vel'Koz</option>

            	<option value="Warwick">Warwick</option>
            	<option value="Wukong">Wukong</option>
            	
            	<option value="Xerath">Xerath</option>
            	<option value="XinZhao">XinZhao</option>

            	<option value="Yasuo">Yasuo</option>

            	<option value="Zac">Zac</option>
            	<option value="Zed">Zed</option>
				<option value="Ziggs">Ziggs</option>
				<option value="Zilian">Zilian</option>
				<option value="Zyra">Zyra</option>
            </select>
          	</div>
        	</div>
			<button type="button" class="ui blue button" onclick="Load('?Cadastro=true','Message','POST',Form('CadastroForm'));">Cadastra Grátis</button>
		</form>
	</div>
    <div class="footer">
    <div id="Message"></div>
    </div>		
</div>

<div id="box" style="width:40%; font-size:10px;">
	<div class="headerText"><h4>Termos de Uso</h4></div>
	<div class="body">
		*<b>Não use o mesmo nome de Úsuario e Password do League Of Legends</b><br>
		O Team Maneger é um jogo baseado no cénario competetivo do jogo League Of Legends, aonde "simula" toda parte da administração de um Time.
		O jogo não possui fins lucrativo, tudo no jogo pode ser consquistado.  
	</div>
</div>
<?php } ?>