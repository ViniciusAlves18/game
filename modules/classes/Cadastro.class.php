<?php
	
	class Cadastro extends Db
	{
		private $username;
		private $password;
		private $champion;
		private $email;

		public function __construct()
		{
			global $pdo;

			if(isset($_GET["Cadastro"]) == true)
			{
				$this->username = strip_tags(trim($_POST["Username"]));
				$this->password = strip_tags(trim($_POST["Password"]));
				$this->champion = strip_tags(trim($_POST["Champion"]));
				$this->email = 	  strip_tags(trim($_POST["Email"]));
				
				$CheckUsern = $pdo->prepare("SELECT Username FROM account WHERE Username=?");
				$CheckEmail = $pdo->prepare("SELECT Email FROM account WHERE Email=?");
				$CheckUsern->execute(array($this->username));
				$CheckEmail->execute(array($this->email));

				if(empty($this->username) && empty($this->password) && empty($this->email))
				{
					exit("<div class=\"ui red message\">Os seguintes erros foram encontrados: <br> - Login em branco <br>- Password em branco <br>- Email em branco </div>");
				}
				elseif($CheckUsern->rowCount() > 0)
				{
					exit("<div class=\"ui red message\">Nome de Úsuario em uso</div>");
				}
				elseif($CheckEmail->rowCount() > 0)
				{
					exit("<div class=\"ui red message\">Email em uso</div>");
				}
				elseif(eregi("[^a-zA-Z0-9_!=?&-]", $this->username))
				{
					exit("<div class=\"ui red message\">Não use s&iacute;mbolos no nome de Úsuario</div>");
				}
				elseif(filter_var($this->email, FILTER_VALIDATE_EMAIL) == false)
				{
					exit("<div class=\"ui red message\">E-Mail inv&aacute;lido</div>");
				}
				else
				{
					$Account = $pdo->prepare("INSERT INTO account SET Username=?,Password=?,Email=?");
					if($Account->execute(array($this->username,$this->password,$this->email)))
					{
						$AccountID = $pdo->prepare("INSERT INTO account_id SET Avatar=?,Team=?,Champion=?,Team_Name=?");
						if($AccountID->execute(array(1,1,$this->champion,"NULL")))
						{
							exit("<div class=\"ui green message\">Conta criada com sucesso. <br> Bem vindo <b>{$this->username}</b>, lembre-se nunca passe seus dados a ninguém.</div>");
						}
						else
						{
							exit("<div class=\"ui red message\">Ops! algo deu errado contante o administrador do sistema</div>");
						}
					}
				}
			}
		}
	}