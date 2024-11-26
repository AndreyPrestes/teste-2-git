<?php 
require_once "functions.php";
logout();

if (!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id'])){
    die("Você não pode acessar está página por que não está logado. <p><a href=\contactus.php\">Entrar</a></p>");
}

if (!isset($_SESSION)) {
    session_start();
}

session_destroy();

header("Location: contactus.php");

