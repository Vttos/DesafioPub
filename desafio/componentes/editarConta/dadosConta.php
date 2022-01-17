<?php
    require '../config.php';    

    $editaConta = [];
    $idConta = filter_input(INPUT_GET, 'idconta');

    if($idConta){

        $sql = $pdo->prepare("SELECT * FROM conta WHERE idconta = :idConta");
        $sql->bindValue(':idConta', $idConta);
        $sql->execute();

        if($sql->rowCount() > 0){

            $editaConta = $sql->fetch( PDO::FETCH_ASSOC );

        // } else {
        //     header("Location: ../conta.php");
        //     exit;
        }

    // } else{
    //     header("Location: ../conta.php");
    //     exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        body{
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            
        }

        header{
            height: 20vh;
            width: 100%;
            background-color: #0739E8;
            padding-left: 700px;
        }

        form{
            margin: 4vh 0;
        }
        
        button{
            margin-top: 7%;
            height: 26px;
            width: 190px;
            margin-left: 0;
            background-color: #0739E8;
            color: #E9F4F2;
            
        }

        button:hover{
            background-color: #E9F4F2;
            color: #0739E8;
            
        }

    
    </style>
</head>
<body>
    <header>
        <a href="../contas.php"><button>Contas</button></a>
        <a href="../receita.php"><button>Receitas</button></a>
        <a href="../despesas.php"><button>Despesas</button></a>
    </header>

    <div>
    </div>
    <form method="POST" action="editarConta.php">
        <input type="hidden" name="idConta" value="<?=$editaConta['idconta'] ?>" />

        <label>
            Saldo: <input type="text" name="saldo" value="<?=$editaConta['saldo'] ?>" />
        </label>

        </br>
        </br>
 
        <label>
            <select name="tipo">
                <option value="<?=$editaConta['tipo'] ?>"><?=$editaConta['tipo'] ?></option>
                <option value="carteira">carteira</option>
                <option value="conta corrente">conta corrente</option>
                <option value="poupança">poupança</option>
            </select>
        </label>
        
        </br>
        </br>
 
        <label>
            Banco: <input type="text" name="banco" value="<?=$editaConta['banco'] ?>" />
        </label>
        
        </br>
        </br>

        <input type="submit" value="Auterar" />
    </form>

</body>
</html>