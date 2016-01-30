<?php
	
	class Db
	{
		public function connection()
		{
			try
			{
				$pdo = new PDO("mysql:host=".Host.";dbname=".DbName.";",User,Pass);
			}
			catch(PDOExpection $e)
			{
				echo($e->getMessage);
			}
			return $pdo;
		}	
	}