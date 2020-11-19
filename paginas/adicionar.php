<?php
    //segurança, verificar se a variavel $pagina não existe
    if(!isset ($pagina))exit;

    if( $_POST){
        //recuperar as variaveis
        $id = trim( $_POST['id'] ?? null);
        $quantidade = trim( $_POST['quantidade']?? 1);

        //verificar se o id esta vazio
        if(empty ($id)){
            echo"<script> 
                    alert('Produto inválida, tente novamente');
                    history.back();
                </script>";
            exit;    
        }

        //selecionar os dados do banco
        $sql    = "select * from produto where id = ".(int)$id." limit 1";
        $result = mysqli_query($con, $sql);
        $dados  = mysqli_fetch_array($result);

        //separar os dados
        $id      = $dados["id"];
        $produto = $dados["produto"];
        $valor   = $dados["valor"];
        $promo   = $dados["promo"];

        //o valor produto sempre serea o valor do produto
        $valorProduto = $valor;
        // se existir o valor promocional sera o valor promo
        if(!empty($promo)){
            $valorProduto = $promo;
        }
        //valor total
        $total = $valorProduto * $quantidade;
      
        //guardar esses valores na sessão
        $_SESSION["carrinho"][$id] = array("id"=>$id, "produto"=>$produto, "valor"=>$valorProduto, "quantidade"=>$quantidade, "total"=>$total);

        //print_r( $_SESSION['carrinho']);

        //redirecionar para o carrinho
        //location.href serve para chmar outra pagina
        echo"<script>location.href='index.php?pagina=carrinho'</script>";

        exit;
    }
    //mensagem de erro = não esta inserindo nada
    echo"<script> 
            alert('requisição inválida, tente novamente');
            history.back();
        </script>";
