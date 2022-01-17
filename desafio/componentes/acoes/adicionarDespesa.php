<?php 

require '../config.php';

    $valorDespesa = filter_input(INPUT_POST, 'valorDespesa');

    $dataPagamento = filter_input(INPUT_POST, 'dataPagamento');
    $converteTimeD1 = strtotime($dataPagamento);
    $converteD1 = date("Y/m/d", $converteTimeD1);

    $dataPEsperado = filter_input(INPUT_POST, 'dataPEsperado'); 
    $converteTimeD2 = strtotime($dataPagamento);
    $converteD2 = date("Y/m/d", $converteTimeD2);

    $despesa = filter_input(INPUT_POST, 'despesa');
    $bancoDespesa = filter_input(INPUT_POST, 'bancoDespesa');

    $subitrair = [];
    $sql = $pdo->query("SELECT saldo FROM conta WHERE idconta = $bancoDespesa");

    if($sql->rowCount() >= 0){
        $subitrair = $sql->fetch(PDO::FETCH_ASSOC);
    }

    if($bancoDespesa){
        

        $menos = $subitrair['saldo'] - $valorDespesa;

        $sql = $pdo->prepare("UPDATE conta SET saldo = :menos WHERE idconta = :bancoDespesa");
        $sql->bindValue(':bancoDespesa', $bancoDespesa);
        $sql->bindValue(':menos', $menos);
        $sql->execute();
    }

    if($valorDespesa && $bancoDespesa && $despesa){

        $sql = $pdo->prepare("INSERT INTO despesas (valorDespesa, dataPagamento, dataEsperado, tipoDespesa, id_banco) VALUES (:valorDespesa, :converteD1, :converteD2, :despesa, :bancoDespesa)");
        $sql->bindValue(':valorDespesa', $valorDespesa);
        $sql->bindValue(':converteD1', $converteD1);
        $sql->bindValue(':converteD2', $converteD2);
        $sql->bindValue(':despesa', $despesa);
        $sql->bindValue(':bancoDespesa', $bancoDespesa);
        $sql->execute();

        header('Location: ../despesas.php');
        exit;

    } else{
        header('Location: ../despesas.php');
        exit;
    }