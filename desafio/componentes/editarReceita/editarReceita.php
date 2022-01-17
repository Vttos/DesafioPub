<?php
    require '../config.php';


    $valorAtual = filter_input(INPUT_POST, 'valorAtual');
    $idReceita = filter_input(INPUT_POST, 'idReceita');
    
    $valorReceita = filter_input(INPUT_POST, 'editaValorReceita');

    $dataRecebida = filter_input(INPUT_POST, 'editaDataRecebida');
    $converteTimeP1 = strtotime($dataRecebida);
    $converteP1 = date("Y/m/d", $converteTimeP1);

    $dataREsperada = filter_input(INPUT_POST, 'editaDataREsperada'); 
    $converteTimeP2 = strtotime($dataREsperada);
    $converteP2 = date("Y/m/d", $converteTimeP2);

    $receita = filter_input(INPUT_POST, 'editaReceita');
    $bancoReceita = filter_input(INPUT_POST, 'editaBancoReceita');
    $descricao = filter_input(INPUT_POST, 'editaDescricao');

    $mudar = [];
    $sql = $pdo->query("SELECT saldo FROM conta WHERE idconta = $bancoReceita");

    if($sql->rowCount() >= 0){
        $somar = $sql->fetch(PDO::FETCH_ASSOC);
    }


    if($bancoReceita){
        

        $mudar = $somar['saldo'] + $valorReceita - $valorAtual;

        $sql = $pdo->prepare("UPDATE conta SET saldo = :mudar WHERE idconta = :bancoReceita");
        $sql->bindValue(':bancoReceita', $bancoReceita);
        $sql->bindValue(':mudar', $mudar);
        $sql->execute();
    }

    if($valorReceita){

        $sql = $pdo->prepare("UPDATE receita SET valorReceita = :valorReceita, dataRecebimento = :converteP1, dataEsperado = :converteP2, descrição = :descricao, id_banco = :bancoReceita, tipoReceita = :receita WHERE idreceita = :idReceita");
        $sql->bindValue(':valorReceita', $valorReceita);
        $sql->bindValue(':converteP1', $converteP1);
        $sql->bindValue(':converteP2', $converteP2);
        $sql->bindValue(':receita', $receita);
        $sql->bindValue(':bancoReceita', $bancoReceita);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':idReceita', $idReceita);
        $sql->execute();



        header('Location: ../receita.php');
        exit;

    } else{
        header('Location: ../receita.php');
        exit;
    }