<?php
//Cria uma sessão caso ainda nao tenha nenhuma criada.
if (!isset($_SESSION)) {
    session_start();
}

include 'classes/Cliente.php';

//Biblioteca que gera dados falsos, apenas por prequiça de preencher o array na mão =D
require_once 'vendor/fzaninotto/faker/src/autoload.php';
$faker = Faker\Factory::create('pt_BR');

$orderBy = 'asc';

//parametro de ordenação
if (isset($_GET['sort'])) {
    $orderBy = $_GET['sort'];
}

//se a sessao 'clientes' ainda nao existir, cria uma e salvas os clientes nela
if (is_null($_SESSION['clientes'])) {
    $clientes = array();
    for ($i = 0; $i < 10; $i++) {
        $clientes[$i] = new Cliente();
        $clientes[$i]->nome = $faker->name;
        $clientes[$i]->cidade = $faker->word;
        $clientes[$i]->cpf = $faker->cpf;
        $clientes[$i]->idade = $faker->numberBetween(15, 25);
        $clientes[$i]->telefone = $faker->cellphone;
    }
    //salva os clientes gerados em uma sessao
    $_SESSION['clientes'] = json_encode($clientes);

} else {
    //pega os clientes salvos na sessao
    $clientes = json_decode($_SESSION['clientes']);
}

//faz a ordenação do array
if ($orderBy == 'asc') {
    ksort($clientes);
} else if ($orderBy == 'desc') {
    krsort($clientes);
}

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
        <h1>Clientes</h1>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>
                    <?php if ($orderBy == 'asc'): ?>
                        <a href="<?= $_SERVER['PHP_SELF'] . '?sort=desc' ?>">ID <i
                                class="glyphicon glyphicon-chevron-down"></i></a>
                    <?php elseif ($orderBy == 'desc'): ?>
                        <a href="<?= $_SERVER['PHP_SELF'] . '?sort=asc' ?>">ID <i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                    <?php endif; ?>
                </th>
                <th>Nome</th>
                <th>CPF</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($clientes as $key => $cliente): ?>
                <tr>
                    <td><?= $key ?></td>
                    <td><?= $cliente->nome ?></td>
                    <td><?= $cliente->cpf ?></td>
                    <td><a href="cliente.php?id=<?= $key ?>">Detalhes</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>