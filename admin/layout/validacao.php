<?php
    session_start();
    if (!isset($_SESSION["id_usuario"])) {
        header("location: login.php");
        exit();
    }
    include_once("../db/conexao.php");