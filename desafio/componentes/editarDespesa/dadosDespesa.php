<?php
    require '../config.php'; 
    
    
    $conta = [];
    $sql = $pdo->query("SELECT * FROM conta");

    if($sql->rowCount() > 0){
        $conta = $sql->fetchALL(PDO::FETCH_ASSOC);
    }

    $editaDespesa = [];
    $idDespesa = filter_input(INPUT_GET, 'idDespesa');

    if($idDespesa){

        $sql = $pdo->prepare("SELECT * FROM despesas WHERE iddespesa = :idDespesa");
        $sql->bindValue(':idDespesa', $idDespesa);
        $sql->execute();

        if($sql->rowCount() > 0){

            $editaDespesa = $sql->fetch( PDO::FETCH_ASSOC );

        } else {
            header("Location: ../despesas.php");
            exit;
        }

    } else{
        header("Location: ../despesas.php");
        exit;
    }

    $banco = $editaDespesa['id_banco'];
    $nomeB = [];
    $sql = $pdo->query("SELECT banco FROM conta WHERE idconta = $banco");
    if($sql->rowCount() > 0){
        $nomeB = $sql->fetch(PDO::FETCH_ASSOC);
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

    <form method="POST" action="editarDespesa.php">
        <input type="hidden" name="valorAtualD" value="<?=$editaDespesa['valorDespesa'] ?>" />
        <input type="hidden" name="idDespesa" value="<?=$editaDespesa['iddespesa'] ?>" />
        
        <label>
            Valor: <input type="text" name="valorDespesa" value="<?=$editaDespesa['valorDespesa'] ?>" />
        </label>

        </br>
        </br>

        <label>
            Data de pagamento: <input type="date" name="dataPagamento" value="<?=$editaDespesa['dataPagamento'] ?>" />
        </label>

        </br>
        </br>

        <label> 
            Data de pagamento esperado: <input type="date" name="dataPEsperado" value="<?=$editaDespesa['dataEsperado'] ?>" />
        </label>

        </br>
        </br>

        <label>
            <select name="despesa" >
                <option value="<?=$editaDespesa['tipoDespesa'] ?>"><?=$editaDespesa['tipoDespesa'] ?></option>
                <option value="alimentação">Alimentação</option>
                <option value="educação">Educação</option>
                <option value="lazer">Lazer</option>
                <option value="Roradia">Roupa</option>
                <option value="saúde">Saúde</option>
                <option value="transporte">Transporte</option>
                <option value="outros">Outros</option>
            </select>
        </label>

        </br>
        </br>

        <label>
        <select name="bancoDespesa">
                <option value="<?=$editaDespesa['id_banco'] ?>"><?=$nomeB['banco'] ?></option>

                <?php foreach($conta as $b): ?>
                    <option value="<?=$b['idconta']?>"><?=$b['banco']?></option>
                <?php endforeach; ?>

            </select>
        </label>

        </br>
        </br>

        <input type="submit" value="Auterar" />
    </form>

    </table>

</body>
</html>