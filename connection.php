<?php
    $host = "localhost";
    $username="root";
    $password="";
    $dbname="auto-bank";
    $port=3306;

    try{
        $conn = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $username, $password);
        //echo "Success!!!!!!!!";
    } catch(PDOException $err){
        //echo "Erro: Conexao Falhou!" . $err->getMessage();
    }