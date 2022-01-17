<?php
    require '../config.php';

    $idconta = filter_input(INPUT_GET, 'idconta');

    if($idconta){
        $sql = $pdo->prepare("DELETE FROM conta WHERE idconta = :idc");
        $sql->bindValue(':idc', $idconta);
        $sql->execute();
    }

    header("Location: ../contas.php");
    exit;