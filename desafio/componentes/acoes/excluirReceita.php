<?php
    require '../config.php';

    $idreceita = filter_input(INPUT_GET, 'idreceita');

    if($idreceita){
        $sql = $pdo->prepare("DELETE FROM receita WHERE idreceita = :idr");
        $sql->bindValue(':idr', $idreceita);
        $sql->execute();
    }

    header("Location: ../receita.php");
    exit;