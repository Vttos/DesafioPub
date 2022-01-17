<?php
    


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
        
        button{
            margin-top: 7%;
            height: 26px;
            width: 190px;
            margin-left: 0;
            background-color: #0739E8;
            
        }

        button:hover{
            background-color: #E9F4F2;
        
            
        }

        div{
            
            width: 100vw;
            border: 1px solid black;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 30px;
        }
    
    </style>
</head>
<body>
    <header>
        <a href="./componentes/contas.php"><button>Contas</button></a>
        <a href="./componentes/receita.php"><button>Receitas</button></a>
        <a href="./componentes/despesas.php"><button>Despesas</button></a>
    </header>

    <div>
        
    </div>

</body>
</html>



