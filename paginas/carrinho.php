<?php
    //segurança, verificar se a variavel $pagina não existe
    if(!isset ($pagina))exit;
?>
<h1 class="text-center">Carrinho de Compras</h1>
<?php

    //print_r($_SESSION["cliente"]);
    //dizer uma mensagem de oi para o cliente se a variavel existir
    if(isset($_SESSION['cliente']['nome'])){
        echo "<p><strong> Olá ".$_SESSION['cliente']['nome']."-<a href='sair.php'>Efetuar Logout</a></strong></p>";
    }
    $produto= 0;
    // contar numero de linhas existentes 
    //if para verificar se existe produto dentro do carrinho
   if( isset ($_SESSION['carrinho'])){ 
   $produto = count($_SESSION['carrinho']);
   }

?>
<p class="alert alert-danger">
    Existem <?=$produto?> produto(s) diferente(s) no carrinho:
</p>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <td>Nome do Produto</td>
            <td>Quantidade</td>
            <td>Vlr unit.</td>
            <td>Vlr Total</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <?php

            $totalGeral = 0;
            if($produto > 0){
                //mostar os itens do $_SESSION['carrinho']
                //recuperar os dados do array carrinho
                foreach($_SESSION['carrinho'] as $dados ){
                    $id         = $dados["id"];
                    $produto    = $dados["produto"];
                    $valor      = $dados["valor"];
                    $quantidade = $dados["quantidade"];
                    $total      = $dados["total"];
                    //somar total geral de todos os produtos juntos
                    $totalGeral = $total + $totalGeral;

                    //formatar valores
                    $valor = number_format($valor,2,",",".");
                    $total = number_format($total, 2,",",".");

                    //mostrar os resultados em uma linha da tabela
                    //tr-linha
                    //td-coluna ou cèlula
                    echo"<tr>
                        <td>{$produto}</td>
                        <td>{$quantidade}</td>
                        <td>R$ {$valor}</td>
                        <td>R$ {$total}</td>
                        <td>
                            <button type='button' class='btn btn-danger btn-sm' onclick='excluirProduto({$id})'>
                                <i class='fas fa-trash'></i>
                            </button>
                        </td>
                        </tr>
                    ";
                } 
         }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td>Valor total</td>
            <td></td>
            <td></td>
            <td>R$: <?=number_format($totalGeral,2,",",".");?></td>
            <td></td>
        </tr>
    </tfoot>
</table>

<a href="index.php?pagina=limpar" class="btn btn-danger btn-lg float-left">
    Limpar carrinho
</a>
<a href="index.php?pagina=finalizar" class="btn btn-success btn-lg float-right">
    Finalizar Pedido
</a>

<div class="clearfix"> </div>

<script>
    //função ´para pgt se quer realmente excluir o produto
    function excluirProduto(id){
        //pergunta
        //o confrim é do js, permite fazer uma pergunta e retorna true ou false, pgt booleana
        if( confirm("Deseja realmente excluir este item?")){
            //envio para pg de excluir com o id do produto, envia true
            location.href="index.php?pagina=excluir&id="+id;
        }
    }
</script>