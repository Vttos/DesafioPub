<?php
    require '../config.php';

    $idreceita = filter_input(INPUT_GET, 'idreceita');


    $valoRAtual = [];
    $sql = $pdo->query("SELECT valorReceita, id_banco FROM receita WHERE idreceita = $idreceita");

    if($sql->rowCount() > 0){
        $valoRAtual = $sql->fetch(PDO::FETCH_ASSOC);
    }

    $idBanco = $valoRAtual['id_banco'];
    $saldoAtual = [];
    $sql = $pdo->query("SELECT saldo FROM conta WHERE idconta = $idBanco");

    if($sql->rowCount() > 0){
        $saldoAtual = $sql->fetch(PDO::FETCH_ASSOC);
    }

    if($idreceita){
        

        $menos = $saldoAtual['saldo'] - $valoRAtual['valorReceita'];

        $sql = $pdo->prepare("UPDATE conta SET saldo = :menos WHERE idconta = :idBanco");
        $sql->bindValue(':idBanco', $idBanco);
        $sql->bindValue(':menos', $menos);
        $sql->execute();
    }

    if($idreceita){
        $sql = $pdo->prepare("DELETE FROM receita WHERE idreceita = :idr");
        $sql->bindValue(':idr', $idreceita);
        $sql->execute();
    }

    header("Location: ../receita.php");
    exit;