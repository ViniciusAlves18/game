<?php

	class Login extends Db
	{
		private $username;
		private $password;

		public function __construct()
		{
			if(isset($_GET["Deslogar"]) == true)
			{
				unset($_SESSION["Username"]);
				unset($_SESSION["Password"]);
				session_destroy();
				header("Location: ?");
			}
		}

		public function Autenticar()
		{
			global $pdo; 

			if(isset($_GET["Login"]) == true)
			{
				$this->username = strip_tags(trim($_POST["Username"]));
				$this->password = strip_tags(trim($_POST["Password"]));
				
				$Check = $pdo->prepare("SELECT Username,Password FROM account WHERE Username=? AND Password=?");
				$Check->execute(array($this->username,
									  $this->password));
				$Row = $Check->rowCount();
				
				if(empty($this->username) && empty($this->password))
				{
					exit("<script>$('.Login').text('Existem campos em branco');</script>");
				}
				elseif($Row <= 0)
				{
					exit("<script>$('.Login').text('Username ou Passoword inválidos');</script>");
				}
				else
				{
					$_SESSION["Username"] = $this->username;
					$_SESSION["Password"] = $this->password;
					exit("<script>location.reload();</script>");
				}
			}
		}
	}