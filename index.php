<?php
    session_start();//iniciando uma sessão, ele creia um arquivo la no servidor , fica um tempo ativa, depois ele sai
    require "config/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/lightbox.min.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>     
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/lightbox.js"></script>
    <script type="text/javascript" src="js/parsley.min.js"></script>
   

    <title>subsubmarino</title>
</head>
<body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" alt="Submarino">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?pagina=sobre">Sobre a Empresa</a>
                </li>
                <?php
                    //sql para selecionar as categorias
                   $sql = "select * from categoria order by categoria";
                   //executar esse comando sql, passando a conexão e a string q vai ser imprimida na tela
                   $result = mysqli_query($con, $sql);
                   //recuperar os dados por linha
                   while($dados = mysqli_fetch_array($result)){
                       $id = $dados["id"];
                       $categoria = $dados["categoria"];
                       //echo "<p>{$id} {$categoria}</p>";
                       echo " <li class=\"nav-item active\">
                              <a class=\"nav-link\" href=\"index.php?pagina=categoria&id={$id}\">{$categoria}</a>
                               </li>";
                   }
                ?>
           
            </ul>


             <ul class="navbar-nav ml-auto">
                  <li class="nav-item">  
                    <a href="index.php?pagina=login" class="nav-link">
                       <i class="fas fa-user"></i> 
                    </a>
                  </li>  
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?pagina=carrinho">
                        <i class="fas  fa-shopping-cart"></i>
                    </a>
                  </li>
             </ul>      


            <form class="form-inline my-2 my-lg-0" name="formBusca" action="index.php">
            <input class="form-control mr-sm-2" name="busca" type="search" placeholder="Busca" aria-label="Search">
            <button class="btn btn-warning my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>
         </nav>
        <main class="container">
            <?php           
                //verificar ou fazer receber o valor da pagina( variavel) ta vindo por get
                $pagina = $_GET["pagina"] ?? "home";
                // $paginas = home , tenho que transformar nisso -> paginas/home.php
                $pagina = "paginas/{$pagina}.php";
                //verificar se a pagina existe
                //função que verifica se arquivo existe ou não
                if (file_exists($pagina)){
                    //incluir a minha pagina
                    include $pagina;
                }
                else{
                    include "paginas/erro.php";
                }
            ?>       
        </main>
        <footer class="bg-primary">
                <div class="container">
                    <p class="text-center">SubSubmarino - Comércio eletrônico</p>
                    <p class="text-center">
                        <strong>Meios de pagamento:</strong>
                        <p class="text-center">
                            <img src="images/pagamentos.png" alt="Meios de Pagamento">
                        </p>
                    </p>
                    <hr>
                    <p class="text-center">    
                          Desenvolvido por Eduardo Mota - <i class="fab fa-whatsapp"></i> whatsapp para contato (99)9999-9999 |
                          <i class="fab fa-facebook-messenger"></i>
                          <i class="fab fa-instagram"></i>
                          <i class="fab fa-youtube"></i>
                    </p>
                </div>
        
        </footer>

  
</body>
</html>