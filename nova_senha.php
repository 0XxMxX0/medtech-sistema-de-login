<?php

    // CONEXÃO
    require_once 'db_connect.php';
    

    if(isset($_POST['btn_nova_senha'])){
        $nome = $_POST['name'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $confirmarSenha = $_POST['confirmar_nova_senha'];
        


        $sql_validar_login = "SELECT *
                              FROM usuarios as u
                              inner join pessoas as p
                              on u.pessoa_id = p.pessoa_id
                              WHERE login = '$login' AND nome = '$nome';
        ";

        $resultado2 = mysqli_query($connect, $sql_validar_login);

        if(mysqli_num_rows($resultado2) > 0){


            if($senha == $confirmarSenha){
                $senha_md5 = md5($senha);
                $sql_atualizar_senha = "UPDATE usuarios 
                                        SET senha = '$senha_md5'
                                        WHERE login = '$login';
                ";

                $resultado3 = mysqli_query($connect, $sql_atualizar_senha);

                if(!$resultado3){
                    $erros[] = '<li id="mensagem">As senhas precisam ser iguais!</li>';
                }

            } else {
                $erros[] = '<li id="mensagem">As senhas precisam ser iguais!</li>';
            }

        } else {
            $erros[] = '<li id="mensagem">Nenhum usuario encontrado!</li>';
        }
    } 
?>


<!DOCTYPE html>
<html lang="pt=BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/style_nova_senha.css"/>
    <link rel="icon" type="imagem/png" href="./IMG/favicon.png"/>
    <title>MEDTECH - Nova senha</title>
</head>
<body>
    <div id="container">
       
        <div class='container-width' id="container-login">
            <form action='' method='POST'>
                <div class="forms-links ">
                    <a href="#" class="form-headline link-active" id="link-logar">Redefinir senha</a>
                    <div  onmouseover="mouseover()" onmouseout="mouseout()" class='border-link-effect border-effect-active'></div>
                </div>
                
                <div id='form-items'>
                    <?php
                        if(!empty($erros)){
                            foreach($erros as $erro){
                                echo "$erro";
                            }
                        }
                    ?>
                    <input type='text' oninput='validacaoBotao()'  oninput='validacaoLogin()' name='name' id=name' placeholder="Confirme seu nome"/>
                    <input type='text' oninput='validacaoBotao()'  oninput='validacaoLogin()' name='login' id='login' placeholder="Confirme seu login"/>
                    <input type='password' oninput='validacaoBotao()'   name='senha' id='senha' placeholder="Nova senha"/>
                    
                    <!-- ICONE DE OCULTAR A SENHA -->
                    <div class='password-icon'>
                        <img id='2' onclick="estadoDaSenha(this)" src='IMG/icon-aberto.png'/>
                    </div>

                    <input type='password' oninput='validacaoBotao()'  name='confirmar_nova_senha' id='confirmar_nova_senha' placeholder="Confirmar nova senha"/>
                    
                    <!-- ICONE DE OCULTAR A SENHA -->
                    <div class='password-icon' id="password-icon-2">
                        <img id='3' onclick="estadoDaSenha(this)" src='IMG/icon-aberto.png'/>
                    </div>
                    
                    <input type='submit' name='btn_nova_senha' class='btn-off' value='CONFIRMAR'/>
                </div>

            </form>

        </div>
    </div>
    <script src="./JS/script_nova_senha.js"></script>
</body>
</html>