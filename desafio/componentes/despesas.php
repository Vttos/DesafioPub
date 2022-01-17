<?php
    require 'config.php'; 
    
    
    $conta = [];
    $sql = $pdo->query("SELECT * FROM conta");

    if($sql->rowCount() > 0){
        $conta = $sql->fetchALL(PDO::FETCH_ASSOC);
    }

    $despesas = [];
    $sql = $pdo->query("SELECT despesas.*, conta.banco AS conta FROM despesas 
        INNER JOIN conta ON conta.idconta = despesas.id_banco");

    if($sql->rowCount() > 0){
        $despesas = $sql->fetchALL(PDO::FETCH_ASSOC);
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

    <div> 
    </div>

    <form method="POST" action="./acoes/adicionarDespesa.php">
        <label>
            Valor: <input type="text" name="valorDespesa"/>
        </label>
        <label>
            Data de pagamento: <input type="date" name="dataPagamento"/>
        </label>
        <label> 
            Data de pagamento esperado: <input type="date" name="dataPEsperado"/>
        </label>
        <label>
            <select name="despesa">
                <option>Tipo de despesa</option>
                <option value="alimentação">Alimentação</option>
                <option value="educação">Educação</option>
                <option value="lazer">Lazer</option>
                <option value="roupa">Roupa</option>
                <option value="saúde">Saúde</option>
                <option value="transporte">Transporte</option>
                <option value="outros">Outros</option>
            </select>
        </label>
        <label>
        <select name="bancoDespesa">
                <option>Banco</option>

                <?php foreach($conta as $b): ?>
                    <option value="<?=$b['idconta']?>"><?=$b['banco']?></option>
                <?php endforeach; ?>

            </select>
        </label>

        <input type="submit" value="Adicionar" />
    </form>

    <table border="1" width="60%">
        <tr>
            <th>Valor</th>
            <th>Data de pagamento</th>
            <th>Data de pagamento esperado</th>
            <th>Tipo de despesa</th>
            <th>Banco</th>
        </tr>
        <?php foreach($despesas as $dados): 
            $dataTimeD1 = strtotime($dados['dataPagamento']);
            $auterarD1 = date("d/m/Y", $dataTimeD1);
            
            $dataTimeD2 = strtotime($dados['dataEsperado']);
            $auterarD2 = date("d/m/Y", $dataTimeD2);  
        ?>
            <tr>
                <td> R$ <?=$dados['valorDespesa']; ?>,00 </td>
                <td><?=$auterarD1; ?></td>
                <td><?=$auterarD2; ?></td>
                <td><?=$dados['tipoDespesa']; ?></td>
                <td><?=$dados['conta']; ?></td>
                <td>
                <a href="./editarDespesa/dadosDespesa.php?idDespesa=<?=$dados['iddespesa'];?>">  Editar -  </a>
                <a href="./excluir/excluirDespesa.php?iddespesa=<?=$dados['iddespesa'];?>" onclick="return confirm('Tem Certeza que deseja excluir.')">  Excluir  </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>
