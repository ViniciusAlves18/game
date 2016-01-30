<?php
	
	class Page
	{
		public function __construct()
		{
			if(isset($_GET["cmd"]))
			{
				if(file_exists("public/pages/{$_GET["cmd"]}.php"))
				{
				    require_once("public/pages/{$_GET["cmd"]}.php");
				}
				else
				{
					echo "Página Solicitada não existe.";
				}
			}
		}
	}