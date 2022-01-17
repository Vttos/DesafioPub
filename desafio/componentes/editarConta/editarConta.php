<?php
    require '../config.php';

    $idConta = filter_input(INPUT_POST, 'idConta');

    $saldo = filter_input(INPUT_POST, 'saldo');
    $tipo = filter_input(INPUT_POST, 'tipo');
    $banco = filter_input(INPUT_POST, 'banco');

    if($idConta){

        $sql = $pdo->prepare("UPDATE conta SET saldo = :saldo, tipo = :tipo, banco = :banco WHERE idconta = :idConta");
        $sql->bindValue(':saldo', $saldo);
        $sql->bindValue(':tipo', $tipo);
        $sql->bindValue(':banco', $banco);
        $sql->bindValue(':idConta', $idConta);
        $sql->execute();



        header('Location: ../contas.php');
        exit;

    } else{
        header('Location: ../contas.php');
        exit;
    }