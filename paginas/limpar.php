<?php
    //segurança, verificar se a variavel $pagina não existe
    if(!isset ($pagina))exit;

    //apagar o conteudo do carrinho, apenas carrinho
    unset($_SESSION['carrinho']);

    //enviar a pagina para o carrinho novamente
    echo "<script>location.href='index.php?pagina=carrinho';</script>";