<?php
    //segurança, verificar se a variavel $pagina não existe
    if(!isset ($pagina))exit;
?>
<h1 class="text-center">Categoria</h1>
<div class="row">
    
    <?php
        $idPagina = $_GET["id"] ?? "";
        //o select * from produto order by rand() limit 6" ele seleciona os dados da tabela produto e ordena randomicamente, com limite de 6
        $sql = "select *  from produto where categoria_id = {$idPagina} limit 6";
        //executar o sql
        $result = mysqli_query($con, $sql);
        
       
        //separar os dados
        //o comando mysqli_fetch_array() , traz todos os resultados que foram contidos na variavel acima
        while($dados = mysqli_fetch_array($result)){
            $id      = $dados["id"];
            $produto = $dados["produto"];
            $imagem  = $dados["imagem"];
            $valor   = $dados["valor"];
            $promo   = $dados["promo"];

            
            //se tiver promo - valor sera promoçãp
            //senão valor = valor do produto
            if( empty ($promo)){
                $valor = "R$".number_format($valor,2,",",".");
                $de = "";
            }else{
                $de = "R$".number_format($valor,2,",",".");
                $valor = "R$".number_format($promo,2,",",".");
            }
            
            


            echo "<div class=\"col-12 col-md-4 text-center\" >
            <img src=\"produtos/{$imagem}\" alt=\"{$produto}\" class=\"w-100\">
            <h2>{$produto}</h2>
            <p class='De'>{$de}</p>
            <p class='valor'>
                {$valor}
            </p>
            <p>
                <a href ='index.php?pagina=produto&id={$id}' class='btn btn-success btn-lg w-100'>Detalhes</a>
            </p>
        </div>";
        }
        if(empty($produto)){
        echo"<div class= 'alert alert-danger container text-center'  role='alert'>
           Não existe produtos cadastrados!
        </div>";
        }
    ?>
</div>