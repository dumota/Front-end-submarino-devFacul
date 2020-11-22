<?php
    //segurança, verificar se a variavel $pagina não existe
    if(!isset ($pagina))exit;

    //verificar se pessoa ta logada
    if(!isset($_SESSION['cliente'])){
        echo"<script>
            alert('por favor, efetue o login');
            location.href='index.php?pagina=login';
        </script>";
        exit;
    }
?>
<h1 class="text-center">Finalizar seu pedido</h1>
<!-- adicionar o fromulario html do pagseguro-->
<form method="post" target="pagseguro"  action="https://pagseguro.uol.com.br/v2/checkout/payment.html"> 
<div class="row">
    <div class="col-12 col-md-4">
        <h3>Seus Dados:</h3>
        <input type="hidden" name="encoding" value="UTF-8">
         <!-- Dados do comprador (opcionais) -->  
        <input name="senderName" type="text" value="<?= $_SESSION['cliente']['nome'];?>" class="form-control" required>  
        <input name="senderEmail" type="text" value="<?= $_SESSION['cliente']['email'];?>" class="form-control" required>  
    </div>
    <div class="col-12 col-md-8">
        <h3>Confira seus Pedido:</h3>
        <?php
            $produto=0;

            if( isset ($_SESSION['carrinho'])){ 
            $produto = count($_SESSION['carrinho']);
            }
        ?>
          
     <!-- Campos obrigatórios -->  
     <input name="receiverEmail" type="hidden" value="suporte@lojamodelo.com.br">  
     <input name="currency" type="hidden" value="BRL">  

        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>Nome do Produto</td>
                    <td>Quantidade</td>
                    <td>Vlr unit.</td>
                    <td>Vlr Total</td>
                    
                </tr>
            </thead>
            <tbody>
                <?php

                    $i= $totalGeral = 0;
                    if($produto > 0){
                        //mostar os itens do $_SESSION['carrinho']
                        //recuperar os dados do array carrinho
                        foreach($_SESSION['carrinho'] as $dados ){

                            //somar mais um no $i , tipo um contador para usar no pagSeguro
                            $i ++;
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
                               
                                </tr>";
                                // formatar o valor com duas casas decimais , pq o pagSeguro é chato , mas é regra dele
                                //modelo americano de formatação
                                $valorPag = number_format($dados['valor'],2,".","");
                                echo "   
                                <input name='itemId{$i}' type='hidden' value='0001'>  
                                <input name='itemDescription{$i}' type='hidden' value='{$produto}'>  
                                <input name='itemAmount{$i}' type='hidden' value='{$valorPag}'>  
                                <input name='itemQuantity{$i}' type='hidden' value='{$quantidade}'>  
                                <input name='itemWeight{$i}' type='hidden' value='1000'>  ";
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
                    
                </tr>
            </tfoot>
        </table>
        <!-- adicionando um botao para auxiliar o envio de dados para o pagseguro-->
        <button type="submit" class="btn btn-success">
            Efetuar Pagamento    
        </button>
     </form>    
    </div>
</div>