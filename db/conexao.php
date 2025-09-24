<?php
    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bolos";

    $conexao = new mysqli($host, $usuario, $senha, $bd);
    if ($conexao->connect_error) {
        die("Falha na conexão: ". $conexao->connect_error);
    }
