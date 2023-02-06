<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabalho N2 murilo</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="index.php" method="get">

        <label for="name">Nome:</label>
        <input type="text" id="name" name="name"><br><br>
        
        <label for="tel">Telefone:</label>
        <input type="tel" id="tel" name="tel"><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        
        <label for="message">Mensagem:</label>
        <textarea id="message" name="message"></textarea><br><br>
        
        <input type="submit" value="Enviar">

    </form>



</body>

</html>

<?php
    date_default_timezone_set('America/Sao_Paulo');
    $name = $_GET['name'];
    $tel = $_GET['tel'];
    $email = $_GET['email'];
    $message = $_GET['message'];

    $data = date('d/m/Y');
    $hora = date('G:i:s');

    $bdhost = "localhost";
    $bduser = "root";
    $bdpass = "";
    $bddata = "trabalho2";
    
    // Conexão com a base de dados
    $conn = mysqli_connect($bdhost, $bduser, $bdpass, $bddata) or die ("could not connect to mysql"); 
    mysqli_select_db($conn, "trabalho2") or die ("no database");
    // Inserção dos dados de entrada no banco de dados
    

    $sql = "INSERT INTO mensagens (data, hora , nome, telefone, email, mensagem) VALUES ('{$data}', '{$hora}', '{$name}', '{$tel}', '{$email}', '{$message}')";
    
    if ($name == null or $tel == 0 or $email == null or $message == null)
    {
        echo "Um dos campos vazios , por favor, prencha todas as informações.";
        echo "{$name} <br>";
        echo "{$tel} <br>";
        echo $email;
        echo $message;
    }
    else
    {
        if (mysqli_query($conn, $sql)) 
        {
            echo "Mensagem enviada com sucesso.";
        } 
        else 
        {
            echo "Erro ao enviar a mensagem. <br>";
        }
    }


    $sql_q = mysqli_query($conn,"SELECT * FROM mensagens") or die(mysqli_error($conn));

    while($aux = mysqli_fetch_assoc($sql_q))
    {
        echo "-----------------------------------------<br />";
        echo "data: ".$aux["data"]."<br />";
        echo "hora: ".$aux["hora"]."<br />";
        echo "Nome: ".$aux["nome"]."<br />"; 
        echo "telefone: ".$aux["telefone"]."<br />";
        echo "email: ".$aux["email"]."<br />";
        echo "mensagem: ".$aux["mensagem"]."<br />";
    }

    mysqli_close($conn);
    
    
?>

