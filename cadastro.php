<?php
    // CONEXÃO
    require_once 'db_connect.php';
    
    

    if(isset($_POST['btn_cadastrar'])){
        $nome = $_POST['name'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $confirmar_senha = $_POST['confirmar_senha'];
        $erros = array();

        if($nome != '' and $login != '' and  $senha != '' and $confirmar_senha != ''){
            if($senha == $confirmar_senha){
                
                $sql_validar_usuario = "SELECT * 
                                        FROM usuarios 
                                        WHERE login = '$login';
                ";

                $resultado_validar_usuario = mysqli_query($connect, $sql_validar_usuario);

                if(mysqli_num_rows($resultado_validar_usuario) == 0){
                    $sql = "INSERT INTO pessoas(pessoa_id, nome)
                                    VALUES('','$nome');
                    ";

                    $resultado = mysqli_query($connect, $sql);

                    if(!$resultado){
                        $erros[] = '<li id="mensagem">Não foi possivel criar o usuario! Cod.1</li>';
                    } else {
    
                        $sql_pessoa = "SELECT pessoa_id 
                                       FROM pessoas 
                                       WHERE Nome = '$nome' 
                                       ORDER BY pessoa_Id desc
                                       LIMIT 1;
                        ";
                        
                        $resultado_pessoa = mysqli_query($connect,$sql_pessoa);
    
                        while($campo = mysqli_fetch_array($resultado_pessoa)){
                            $id_pessoa = $campo['pessoa_id'];
                        };

                        $md5 = md5($senha);
                        $sql_usuario = "INSERT INTO usuarios(usuario_id,pessoa_id,login,senha)
                                        VALUES('',$id_pessoa,'$login','$md5');
                        ";

                        $resultado_usuario = mysqli_query($connect, $sql_usuario);
                        
                        if(!$resultado_usuario){
                            $erros[] = '<li id="mensagem">Não foi possivel criar o usuario! Cod.2</li>';
                        } else {
                            echo "
                                <div class='successful' id='sucessful'>
                                    <div class='successful-box'>
                                        <img class='img-successful' src='./IMG/icons-confirmar.png'/>
                                        <h1 class='headline-successful'>SUCESSO AO CRIAR SUA CONTA</h1>
                                        <button onclick='confirmarIncricao()' class='button-successful btn-on'>ENTRAR</button>
                                    </div>
                                </div>
                            ";
                        }
                    };
                } else {
                    $erros[] = '<li id="mensagem">Usuario ocupado, tente outro!</li>';
                }
            } else {
                $erros[] = '<li id="mensagem">As senhas precisam ser iguais!</li>';
            }
        } else {
            $erros[] = '<li id="mensagem">Os campos precisam ser preenchidos!</li>';
        }
    }
    

?>

<!DOCTYPE html>
<html lang="pt=BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="CSS/style_cadastro.css"/>
    <link rel="icon" type="imagem/png" href="./IMG/favicon.png"/>
    <title>MEDTECH - Cadastro</title>
</head>
<body>
    <div id="container">
       
        <div class='container-width' id="container-login">
            <form action='' method='POST'>
                <div class="forms-links">
                    <a href="./" class="form-headline" id="link-logar">Entrar</a>
                        <div  onmouseover="mouseover()" onmouseout="mouseout()" class='border-link-effect'></div>
                    <a href="#" class="form-headline link-active" id="link-cadastrar">Cadastrar</a>
                        <div class='border-link-effect border-effect-active' id="border-effect-cadastrar"></div>
                </div>
                
                <div id='form-items'>
                    <?php
                        if(!empty($erros)){
                            foreach($erros as $erro){
                                echo "$erro";
                            }
                        }
                    ?>
                    <input type='text' oninput='validacaoBotao()'  name='name' id=name' placeholder="Seu nome"/>
                    <input type='text' oninput='validacaoBotao()'  name='login' id='login' placeholder="Seu login"/>
                    <input type='password' oninput='validacaoBotao()'  name='senha' id='senha' placeholder="Senha"/>
                    
                    <!-- ICONE DE OCULTAR A SENHA -->
                    <div class='password-icon'>
                        <img id='2' onclick="estadoDaSenha(this)" src='IMG/icon-aberto.png'/>
                    </div>

                    <input type='password' oninput='validacaoBotao()'  name='confirmar_senha' id='confirmar_senha' placeholder="Confirme senha"/>
                    
                    <!-- ICONE DE OCULTAR A SENHA -->
                    <div class='password-icon' id="password-icon-2">
                        <img id='3' onclick="estadoDaSenha(this)" src='IMG/icon-aberto.png'/>
                    </div>
                    
                    <input type='submit' name='btn_cadastrar' class='btn-off' value='CRIAR CONTA'/>
                </div>

            </form>

        </div>
        <div class='container-width' id="container-image">
            <img id='background-image' src="IMG/background-cadastro.gif">
        </div>
    </div>
    <script src="./JS/script_cadastro.js"></script>
</body>
</html>