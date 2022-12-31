<?php
    // CONEXÃO
    require_once 'db_connect.php';

    // SESSÃO INICIO
    session_start();

    if(isset($_POST['btn_entrar'])){
        $erros = array();
        $login = mysqli_escape_string($connect, $_POST['login']);
        $senha = mysqli_escape_string($connect, $_POST['senha']);

        if(empty($login) or empty($senha)){
            $erros[] = '<li id="mensagem">O campo login/senha precisa ser preenchido!</li>';
        } else {
            $sql = "SELECT login
                    FROM usuarios
                    WHERE login = '$login'";
    
            $resultado = mysqli_query($connect, $sql);
    
            if(mysqli_num_rows($resultado) > 0){
                
                $senha = md5($senha);
                $sql = "SELECT *
                        FROM usuarios
                        WHERE login = '$login' AND senha = '$senha'";

                $resultado = mysqli_query($connect, $sql);

                if(mysqli_num_rows($resultado) == 1){
                    $dados = mysqli_fetch_array($resultado);
                    mysqli_close($connect);
                    $_SESSION['logado'] = true;
                    $_SESSION['usuario_id'] = $dados['usuario_id'];
                    header('Location: home.php');
                } 
                else {
                    $erros[] = '<li id="mensagem">Usuário e senha não conferem</li>';
                }
            } else {
                $erros[] = '<li id="mensagem">Usuário inexistente</li>';
            }
        }
    } 
?>
<!DOCTYPE html>
<html lang="pt=BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/style_login.css" />
    <link rel="icon" type="imagem/png" href="./IMG/favicon.png"/>
    <title>MEDTECH - Login</title>
</head>
<body>
    <div id="container">
        <div class='container-width' id="container-image">
            <img id='background-image' src="IMG/background-inicio.gif">
        </div>
        <div class='container-width' id="container-login">
            <div>
                <h1 id="headline">
                    <span>Olá,</span><br>
                    <?php 
                        $timezone = new DateTimeZone('America/Sao_Paulo');
                        $timeNow = new DateTime('now', $timezone);
                        $timeNow = $timeNow->format('H:i');

                        if($timeNow >= '06:00' AND $timeNow < '12:00'){
                            echo "Bom dia!";
                        } else if($timeNow >= '12:00' AND $timeNow <= '18:00' ){
                            echo "Boa tarde!";
                        } else {
                            echo "Boa noite!";
                        }
                    ?>
                </h1>
            </div>
                
            <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method='POST'>
                <div class="forms-links">
                    <a href="#" class="form-headline link-active" id="link-logar">Entrar</a>
                        <div class='border-link-effect border-effect-active'></div>
                    <a href="./cadastro.php"class="form-headline" id="link-cadastrar">Cadastrar</a>
                        <div onmouseover="mouseover()" onmouseout="mouseout()" class='border-link-effect' id="border-effect-cadastrar"></div>
                </div>
                <div id='form-items'>
                    <?php
                        if(!empty($erros)){
                            foreach($erros as $erro){
                                echo "$erro";
                            }
                        }
                    ?> 
                    <input type='text' oninput='validacaoBotao()'  name='login' id='login' placeholder="Seu nome"/>
                    <input type='password' oninput='validacaoBotao()'  name='senha' id='senha' placeholder="Sua senha"/>

                    <!-- ICONE DE OCULTAR A SENHA -->
                    <div class='password-icon'>
                        <img onclick="estadoDaSenha(this)" src='IMG/icon-aberto.png'/>
                    </div>

                    <a href="#" >
                        <p id="password-forget">Esqueceu a senha?</p>
                    </a>
                    <input type='submit' name='btn_entrar' class='btn-off' value='ENTRAR'/>
                </div>
            </form>
        </div>
    </div>
    
    <script src="./JS/script.js"></script>

</body>
</html>