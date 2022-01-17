<?php
    require 'config.php';    

    $conta = [];
    $sql = $pdo->query("SELECT * FROM conta");

    if($sql->rowCount() > 0){
        $conta = $sql->fetchALL(PDO::FETCH_ASSOC);
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

        a{
            text-decoration: none;
            color: black;
        }

        a:hover{
            color: #0739E8;
        }
    
    </style>
</head>
<body>
    <header>
        <a href="../componentes/contas.php"><button>Contas</button></a>
        <a href="../componentes/receita.php"><button>Receitas</button></a>
        <a href="../componentes/despesas.php"><button>Despesas</button></a>
    </header>

   
    <form method="POST" action="./acoes/adicionarConta.php">
        <label>
            Saldo: <input type="text" name="saldo" />
        </label>
        <label>
            <select name="tipo">
                <option>Tipo de conta</option>
                <option value="carteira">carteira</option>
                <option value="conta corrente">conta corrente</option>
                <option value="poupança">poupança</option>
            </select>
        </label>
        <label>
            Banco: <input type="text" name="banco" />
        </label>

        <input type="submit" value="Adicionar" />
    </form>

    <table border="1" width="60%">
        <tr>
            <th>Saldo</th>
            <th>Tipo</th>
            <th>Banco</th>
        </tr>
        <?php foreach($conta as $dados): ?>
            <tr>
                <td> R$ <?=$dados['saldo']; ?>,00 </td>
                <td><?=$dados['tipo']; ?></td>
                <td><?=$dados['banco']; ?></td>
                <td>
                <a href="./editarConta/dadosConta.php?idconta=<?=$dados['idconta'];?>">  Editar -  </a>
                <a href="./excluir/excluirConta.php?idconta=<?=$dados['idconta'];?>" onclick="return confirm('Tem Certeza que deseja excluir.')">  Excluir  </a>
                </td>
            </tr>
            
        <?php endforeach; ?>

    </table>
</body>
</html>
