<?php
    require 'config.php'; 


    $conta = [];
    $sql = $pdo->query("SELECT * FROM conta");

    if($sql->rowCount() > 0){
        $conta = $sql->fetchALL(PDO::FETCH_ASSOC);
    }

    $receita = [];
    $sql = $pdo->query("SELECT receita.*, conta.banco AS conta FROM receita 
        INNER JOIN conta ON conta.idconta = receita.id_banco");

    if($sql->rowCount() > 0){
        $receita = $sql->fetchALL(PDO::FETCH_ASSOC);
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
            width: 100vw;
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

    <!-- <div>
    </div> -->

    <form method="POST" action="./acoes/adicionarReceita.php">
        <label>
            Valor: <input type="text" name="valorReceita"/>
        </label>
        <label>
            Data de pagamento: <input type="date" name="dataRecebida"/>
        </label>
        <label> 
            Data de pagamento esperado: <input type="date" name="dataREsperada"/>
        </label>
        <label>
            Descrição: <input type="text" name="descricao"/>
        </label>
        <label>
        <select name="bancoReceita">
                <option>Banco</option>

                <?php foreach($conta as $b): ?>
                    <option value="<?=$b['idconta'];?>"><?=$b['banco'];?></option>
                <?php endforeach; ?>
            </select>
        </label>
        <label>
            <select name="receita">
                <option>Tipo de receita</option>
                <option value="salário">Salário</option>
                <option value="presente">Presente</option>
                <option value="premio">Prêmio</option>
                <option value="outros">Outros</option>
            </select>
        </label>

        <input type="submit" value="Adicionar" />
    </form>


    <table border="1" width="80%">
        <tr>
            <th>Valor</th>
            <th>Data de pagamento</th>
            <th>Data de pagamento esperado</th>
            <th>descrição</th>
            <th>Banco</th>
            <th>Tipo de receita</th>
        </tr>
        <?php foreach($receita as $dados): 
            $dataP1 = $dados['dataRecebimento']; 
            $dataTimeP1 = strtotime($dados['dataRecebimento']);
            $auterarP1 = date("d/m/Y", $dataTimeP1);
            
            $dataP2 = $dados['dataEsperado']; 
            $dataTimeP2 = strtotime($dados['dataEsperado']);
            $auterarP2 = date("d/m/Y", $dataTimeP2);
        ?>
            <tr>
                <td> R$ <?=$dados['valorReceita']; ?>,00 </td>
                <td><?=$auterarP1; ?></td>
                <td><?=$auterarP2; ?></td>
                <td><?=$dados['descrição']; ?></td>
                <td><?=$dados['conta']; ?></td>
                <td><?=$dados['tipoReceita']; ?></td>
                <td>
                    <a href="./editarReceita/dadosReceita.php?idReceita=<?=$dados['idreceita'];?>">  Editar -  </a>
                    <a href="./excluir/excluirReceita.php?idreceita=<?=$dados['idreceita'];?>" onclick="return confirm('Tem Certeza que deseja excluir.')">  Excluir  </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
    
    
    
</body>
</html>
