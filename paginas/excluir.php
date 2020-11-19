<?php
    //segurança, verificar se a variavel $pagina não existe
    if(!isset ($pagina))exit;

    //recuperar o id para a exclusão
    $id = trim($_GET['id']?? null);

    //verificar se esta vazio
    if(empty($id)){
        //mensagem de erro e voltar a pagina anterior
        echo "<script> alert('Produto invalido');history.back();</script>";
        exit;
    }

    //excluir o produto em si agr
    unset($_SESSION['carrinho'][$id]);

    //redirecionar para o carrinho
    echo "<script> location.href='index.php?pagina=carrinho';</script>";