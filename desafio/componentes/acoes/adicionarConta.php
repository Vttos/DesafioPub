<?php
    require '../config.php';

    $saldo = filter_input(INPUT_POST, 'saldo');
    $tipo = filter_input(INPUT_POST, 'tipo');
    $banco = filter_input(INPUT_POST, 'banco');

    if($saldo && $banco){

        $sql = $pdo->prepare("INSERT INTO conta (saldo, tipo, banco) VALUES (:saldo, :tipo, :banco)");
        $sql->bindValue(':saldo', $saldo);
        $sql->bindValue(':tipo', $tipo);
        $sql->bindValue(':banco', $banco);
        $sql->execute();

        header('Location: ../contas.php');
        exit;

    } else{
        header('Location: ../contas.php');
        exit;
    }