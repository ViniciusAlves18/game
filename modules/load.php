<?php

	function __autoload($Class){
		require_once("classes/{$Class}.class.php");
	}

	CONST User = "root";
	CONST Pass = "";
	CONST Host = "localhost";
	CONST DbName = "lol";

	$Db = new Db;
	$pdo = $Db->connection();

	global $pdo;

	$Login = new Login;
	$Login->Autenticar();
	$Cadastro = new Cadastro;