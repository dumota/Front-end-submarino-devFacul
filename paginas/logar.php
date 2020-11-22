<?php
    //segurança, verificar se a variavel $pagina não existe
    if(!isset ($pagina))exit;

    if($_POST){
        //recuperar o email e a senha
        $email=trim($_POST["email"]?? "");
        $senha=trim($_POST["senha"]?? "");

        //validação de email, usando função própria do php
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            //se o email não for valido , colocar mensagem de erro
            echo "<script>
                alert('Digite um email valido!');
                history.back();
            </script>";
            exit;
            //a finção "STRLEN()"   conta qnatos caracteres tem dentro daquela variavel , muito usado em verificação de senhas, proprio do php
        }else if (strlen($senha) < 4){
            echo"<script>
                alert('Digite uma senha Vàlida!');
                history.back();
            </script>";
        }

        $sql = "select id, nome, senha, email from cliente where email = '{$email}' limit 1";
        $result = mysqli_query($con, $sql);
        $dados = mysqli_fetch_array($result);
        //print_r($dados);

        if(empty($dados["id"])){
            echo"<script>
                alert('Usuário ou senha invalidos');
                history.back();
            </script>";
            exit;
        }
        //funçao php para senha "password-verify(var, senhaBanco)", ela compara a senha digitada com a do banco
        else if( !password_verify($senha,$dados["senha"])){
            echo"<script>
            alert('Usuário ou senha invalidos');
            history.back();
            </script>";
            exit;
        }
        //testanto a criptografia
       // echo password_hash($senha,  PASSWORD_DEFAULT);

       //EFETUAR O LOGIN
        $_SESSION["cliente"] = array("id"=>$dados["id"],"nome"=>$dados["nome"],"email"=>$dados["email"]);

        //redirecionar a pagina
        echo"<script>
            location.href='index.php?pagina=carrinho';
        </script>";
        exit;
    }