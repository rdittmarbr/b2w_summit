
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Language" content="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- fonte google -->
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- CSS pessoal -->
    <!-- <link href="../css/navbar.css" rel="stylesheet" />
    <link href="../css/footer.css" rel="stylesheet" />
    <link href="../css/cores.css" rel="stylesheet" />
    <link href="../css/estilo.css" rel="stylesheet" />
    <link href="../css/tutorial.css" rel="stylesheet" />
    <link href="../css/CSS_PAGINAS.css" rel="stylesheet" /> -->
    <link href="html-css/geral.css" rel="stylesheet" />
    <link href="html-css/nav.css" rel="stylesheet" />
    <link href="html-css/inicial.css" rel="stylesheet" />

    <!-- Scripts -->
    <script src="js/alexandre.js"></script>
    <script src="../js/dom.js"></script>
    <script src="../js/fx.js"></script>

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <title>CLIBRAS</title>
</head>

<body>
    <script type="text/javascript">
    //Testa o navegador
    var isIE = ((navigator.appVersion.indexOf("MSIE") != -1));
    var isOpera = ((navigator.userAgent.indexOf("Opera") != -1));
    var isFF = (!(isIE || isOpera));
    var gl_Desktop = false; //Gerenciamento do desktop

    </script>

    <div class="wrapper">
        <?php
            //navbar
            include("html-css/nav.html");
            include("html-css/inicial.html");

            //conteudo
            //isso aqui é o que vai ficar variando na página

            // include("html-css/agendar-atendimento.html");
            // include("html-css/pagina-inicial.html");
            // include("../_mdl/usu/usumnt.html");
            // include("html-css/sistema.html");
            // include("html-css/atendimento-imediato.html");
            // include("html-css/mudar-senha.html");
            // include("html-css/esqueceu-senha.html");
        ?>

    </div>

    <?php
        //tutorial
        include("html-css/tutorial.html");

        //FOOTER
        // include("html-css/footer.html")
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="bootstrap-4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>


</html>
