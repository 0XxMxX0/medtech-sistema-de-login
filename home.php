INSERT INTO pessoas(pessoa_id, nome)
VALUES('','teste');<?php
     // CONEXÃO
     require_once 'db_connect.php';

     // SESSÃO INICIO
     session_start();

    if(!isset($_SESSION['logado'])){
        header('Location: index.php');
        exite();
    } else {
        // DADOS
        $usuario_id = $_SESSION['usuario_id'];
        
        $sql = "SELECT * 
                FROM usuarios
                WHERE usuario_id = $usuario_id; 
        ";
        $resultado = mysqli_query($connect, $sql);
        $dados = mysqli_fetch_array($resultado);

        $sql2 = "SELECT nome
                FROM pessoas as p
                INNER JOIN usuarios as u
                ON p.pessoa_id = u.pessoa_id
                WHERE u.usuario_id = '$usuario_id'";
        
        $resultado2 = mysqli_query($connect, $sql2);

        $dados2 = mysqli_fetch_array($resultado2);
        mysqli_close($connect);
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema login</title>
</head>
<body>
    <h1>bem vindo, <?php echo $dados2['nome']; ?></h1>
    <a href="logout.php">Sair</a>
</body>
</html>