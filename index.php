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

    <form action="back.php" method="post">
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