<?php
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $data = 0;
    $hora = 0;


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
        /*
        if (mysqli_query($conn, $sql)) 
        {
            echo "Mensagem enviada com sucesso.";
        } 
        else 
        {
            echo "Erro ao enviar a mensagem.";
        } */
        echo "teste";
    }

    mysqli_close($conn);
?>