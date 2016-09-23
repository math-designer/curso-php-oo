<?php
session_start();

$idCliente = $_GET['id'];

$clientes = json_decode($_SESSION['clientes']);

$cliente = $clientes[$idCliente];
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <title>Clientes</title>
</head>
<body>
<div class="container">
    <div class="row">
        <h1>Dados do cliente</h1>
        <div class="well">
            <p>Nome: <?= $cliente->nome ?></p>
            <p>Idade: <?= $cliente->idade ?></p>
            <p>CPF: <?= $cliente->cpf ?></p>
            <p>Cidade: <?= $cliente->cidade ?></p>
            <p>Telefone: <?= $cliente->telefone ?></p>
        </div>
        <a href="index.php" class="btn btn-primary">Voltar</a>
    </div>
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>