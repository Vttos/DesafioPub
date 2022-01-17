<?php 

    require '../config.php';

    $valorReceita = filter_input(INPUT_POST, 'valorReceita');

    $dataRecebida = filter_input(INPUT_POST, 'dataRecebida');
    $converteTimeP1 = strtotime($dataRecebida);
    $converteP1 = date("Y/m/d", $converteTimeP1);

    $dataREsperada = filter_input(INPUT_POST, 'dataREsperada'); 
    $converteTimeP2 = strtotime($dataREsperada);
    $converteP2 = date("Y/m/d", $converteTimeP2);

    $receita = filter_input(INPUT_POST, 'receita');
    $bancoReceita = filter_input(INPUT_POST, 'bancoReceita');
    $descricao = filter_input(INPUT_POST, 'descricao');

    $somar = [];
    $sql = $pdo->query("SELECT saldo FROM conta WHERE idconta = $bancoReceita");

    if($sql->rowCount() >= 0){
        $somar = $sql->fetch(PDO::FETCH_ASSOC);
    }

    if($bancoReceita){
        

        $mais = $somar['saldo'] + $valorReceita;

        $sql = $pdo->prepare("UPDATE conta SET saldo = :mais WHERE idconta = :bancoReceita");
        $sql->bindValue(':bancoReceita', $bancoReceita);
        $sql->bindValue(':mais', $mais);
        $sql->execute();
    }

    if($valorReceita && $dataRecebida && $receita){

        $sql = $pdo->prepare("INSERT INTO receita (valorReceita, dataRecebimento, dataEsperado, descrição, id_banco, tipoReceita) VALUES (:valorReceita, :converteP1, :converteP2, :descricao, :bancoReceita, :receita)");
        $sql->bindValue(':valorReceita', $valorReceita);
        $sql->bindValue(':converteP1', $converteP1);
        $sql->bindValue(':converteP2', $converteP2);
        $sql->bindValue(':receita', $receita);
        $sql->bindValue(':bancoReceita', $bancoReceita);
        $sql->bindValue(':descricao', $descricao);
        $sql->execute();



        header('Location: ../receita.php');
        exit;

    } else{
        header('Location: ../receita.php');
        exit;
    }