<?php
    require '../config.php'; 

    $conta = [];
    $sql = $pdo->query("SELECT * FROM conta");

    if($sql->rowCount() > 0){
        $conta = $sql->fetchALL(PDO::FETCH_ASSOC);
    }

    $edita = [];
    $idReceita = filter_input(INPUT_GET, 'idReceita');

    if($idReceita){

        $sql = $pdo->prepare("SELECT * FROM receita WHERE idreceita = :idReceita");
        $sql->bindValue(':idReceita', $idReceita);
        $sql->execute();

        if($sql->rowCount() > 0){

            $edita = $sql->fetch( PDO::FETCH_ASSOC );

        } else {
            header("Location: ../receita.php");
            exit;
        }

    } else{
        header("Location: ../receita.php");
        exit;
    }

    
    $banco = $edita['id_banco'];
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

        <form method="POST" action="editarReceita.php">
            
            <input type="hidden" name="valorAtual" value="<?=$edita['valorReceita'] ?>" />
            <input type="hidden" name="idReceita" value="<?=$edita['idreceita'] ?>" />
            
            <label>
                Valor: <input type="text" name="editaValorReceita" value="<?=$edita['valorReceita'] ?>" />
            </label>

            </br>
            </br>

            <label>
                Data de pagamento: <input type="date" name="editaDataRecebida" value="<?=$edita['dataRecebimento'] ?>" />
            </label>

            </br>
            </br>

            <label> 
                Data de pagamento esperado: <input type="date" name="editaDataREsperada" value="<?=$edita['dataEsperado'] ?>" />
            </label>

            </br>
            </br>

            <label>
                Descrição: <input type="text" name="editaDescricao" value="<?=$edita['descrição'] ?>" />
            </label>
            
            </br>
            </br>
            
            <label>
                <select name="editaBancoReceita" >
                    <option value="<?=$edita['id_banco']; ?>"><?=$nomeB['banco']; ?></option>
                    <?php foreach($conta as $b): ?>
                        
                        <option value="<?=$b['idconta'];?>"><?=$b['banco'];?></option>
                    <?php endforeach; ?>
                </select>
            </label>

            </br>
            </br>

            <label>
                <select name="editaReceita" >
                    <option value="<?=$edita['tipoReceita'] ?>"><?=$edita['tipoReceita'] ?></option>
                    <option value="salário">Salário</option>
                    <option value="presente">Presente</option>
                    <option value="premio">Prêmio</option>
                    <option value="outros">Outros</option>
                </select>
            </label>

            </br>
            </br>

            <input type="submit" value="Auterar" />
        </form>

    </body>
</html>



