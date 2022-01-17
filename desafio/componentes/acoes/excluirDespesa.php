<?php
    require '../config.php';

    $iddespesa = filter_input(INPUT_GET, 'iddespesa');

    if($iddespesa){
        $sql = $pdo->prepare("DELETE FROM despesas WHERE iddespesa = :idd");
        $sql->bindValue(':idd', $iddespesa);
        $sql->execute();
    }

    header("Location: ../despesas.php");
    exit;