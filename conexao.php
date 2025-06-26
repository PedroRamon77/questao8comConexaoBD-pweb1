<?php

$host = "localhost";
$user = "root";
$pass = "pedroramon";
$bd = "loja";

$conexao = mysqli_connect($host,$user,$pass,$bd);

if (!$conexao) die("Erro de Conexão: ". mysqli_connect_erro());