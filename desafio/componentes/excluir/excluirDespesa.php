<?php
    require '../config.php';

    $iddespesa = filter_input(INPUT_GET, 'iddespesa');

    $valoDAtual = [];
    $sql = $pdo->query("SELECT valorDespesa, id_banco FROM despesas WHERE iddespesa = $iddespesa");

    if($sql->rowCount() > 0){
        $valoDAtual = $sql->fetch(PDO::FETCH_ASSOC);
    }


    // $idBanco = $valoDAtual['id_banco'];
    // $salAtual = [];
    // $sql = $pdo->query("SELECT saldo FROM conta WHERE idconta = $idBanco");

    // if($sql->rowCount() > 0){
    //     $saldoAtual = $sql->fetch(PDO::FETCH_ASSOC);
    // }

    // if($iddespesa){
        

    //     $soma = $salAtual['saldo'] + $valoDAtual['valorDespesa'];

    //     $sql = $pdo->prepare("UPDATE conta SET saldo = :soma WHERE idconta = :idBanco");
    //     $sql->bindValue(':idBanco', $idBanco);
    //     $sql->bindValue(':soma', $soma);
    //     $sql->execute();
    // }

    if($iddespesa){
        $sql = $pdo->prepare("DELETE FROM despesas WHERE iddespesa = :idd");
        $sql->bindValue(':idd', $iddespesa);
        $sql->execute();
    }

    header("Location: ../despesas.php");
    exit;