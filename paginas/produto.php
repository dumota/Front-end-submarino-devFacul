<?php
    //segurança, verificar se a variavel $pagina não existe
    if(!isset ($pagina))exit;

    //recuperar o id
    //o trim retira espaços a mais , aqueles desnecessarios
    $id = trim( $_GET["id"]  ?? "");
    //transforma o id que tava em String em um int
    $id = (int)$id;

    //recuperar o produto com o id
    //o limit é um limite de procuras para o id , vai que tem varios, ai ele n para , mesmo se achar
    $sql    = "select * from produto where id = {$id} limit 1";
    $result = mysqli_query($con, $sql);
    $dados  = mysqli_fetch_array($result);

    //recuperar os dados do banco
    $id        = $dados["id"];
    $produto   = $dados["produto"];
    $valor     = $dados["valor"];
    $promo     = $dados["promo"];
    $descricao = $dados["descricao"];
    $imagem    = $dados["imagem"];


?>
<!--dessa forma abaixo é possivel resumir o php, mas apenas para código com uma linha-->
<h1><?= $produto ?></h1>

<div class="row">
    <div class="col-12 col-md-4">
       <a href="produtos/<?=$imagem?>" data-lightbox="produto" title="<?=$produto?>">
         <img src="produtos/<?=$imagem?>" alt="<?=$produto?>" class="w-100">   
       </a> 
    </div>

    <div class="col-12 col-md-8">
    <?php
    if( empty ($promo)){
     $valor = "R$".number_format($valor,2,",",".");
        $de = "";
    }else{
        $de = "R$".number_format($valor,2,",",".");
        $valor = "R$".number_format($promo,2,",",".");
    }

    echo"<p class='De text-center' >{$de}</p>
         <p class='valor text-center'>{$valor}</p>";

    ?>        
    <form name="formProduto" method="post" action="index.php?pagina=adicionar">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="input-group">
            <input type="number" name="quantidade" value="1" class="form-control form-control-lg" placeholder="quantidade" required inputmode="numeric">
            <div class="input-group-append">
                <button type="submit" class="btn btn-success btn-lg">
                    <i class="fas fa-check"></i>
                    Adicionar ao Carrinho
                </button>
            </div>
        </div>

    </form>
    <h2 class="text-center">Descrição do produto</h2>
    <!-- o nl2br= new line two br, quebra linhas entre os enters -->
    <?=nl2br($descricao);?>
    </div>
</div>
