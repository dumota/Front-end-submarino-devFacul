<?php

    //servidor do Banco de dados
    $servidor ="localhost";
    // usuario de conexão com o banco
    $usuario  ="root";
    //senha que utilizara para entrar no banco
    $senha    ="";
    //no do banco de dados
    $banco    ="sistemas";


    //a variavel con = conexão    
    $con= mysqli_connect($servidor ,$usuario,$senha,$banco) or die ("Erro ao conectar no banco. erro: ".mysqli_connect_erro());

    //setar o charset , ou seja ajeitar as letras para q seja legivel 
    mysqli_set_charset($con,"utf8");