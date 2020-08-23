<?php
/*------------------=-----------=------------------------------------------------------------------------------
Sistema             : CLibras - Sistema para controle de chamadas
Modulo              : index
-------------------------------------------------------------------------------------------------------------*/
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//Headers http
header('Content-type: text/html; charset=utf-8');
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0');
?>
<!DOCTYPE html>
<html lang='pt-BR'>

<head>
    <title>Clibras Aberta - UFPR</title>
    <meta charset='utf-8' />
    <meta name='keywords' content='Libras, UFPR, CLibras' />
    <meta name='copyright' content='UFPR' />
    <meta name='language' content='pt-br' />
    <meta http-equiv='Cache-Control' content='no-store' />
    <?= (ES_ROBOTS ? '<meta name="robots" content="noindex" />' : '') ?>
    <link rel='shortcut icon' href='img/clibras.png' />

    <!-- fonte google -->
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <!-- <link rel="stylesheet" type="text/css" href="inc/bootstrap.min.css"> -->
    <link rel="stylesheet" href="alexandre-layout-design/bootstrap-4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/login.css" />
    <!-- <link rel="stylesheet" type="text/css" href="inc/svg.css" /> -->

    <!-- Definição do CSS -->
    <!-- ? -->
    <!-- <link rel="stylesheet" type="text/css" href="css/css.css" />-->
    <link rel="stylesheet" type="text/css" href="css/animation.css" />

    <!-- skin -->
    <!-- <link rel="stylesheet" type="text/css" href="css/skin/skin.css" /> -->

    <!-- <link rel="stylesheet" type="text/css" href="inc/special.css" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="inc/desktop.css" media="screen" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="inc/window.css" /> -->
    <script src="../../js/fx.js"></script>
    <script src="../../js/dom.js"></script>
    <script src="../../js/prototype.js"></script>
    <script src="../../js/class.js"></script>
    <script src="../../js/class.TcAjax.js"></script>
    <script src="../../js/class.TcDesktop.js"></script>
    <script src="../../js/class.TcCalendar.js"></script>
    <script src="../../js/class.TcCookie.js"></script>
    <!-- <script src="js/class.TcChat.js"></script> !-->
    <script src="../../js/class.TcPage.js"></script>

    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
    <script src="https://sindresorhus.com/screenfull.js/src/screenfull.js"></script>
    <!-- Funções do Desktop -->
    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
    <link href="../../css/attLayout/geral.css" rel="stylesheet" />
    <link href="../../css/attLayout/login.css" rel="stylesheet" />
    <link href="../../css/attLayout/navbar.css" rel="stylesheet" />
    <link href="../../css/attLayout/paginaInicial.css" rel="stylesheet" />
    <link href="../../css/attLayout/paginaAgendamento.css" rel="stylesheet" />
    <link href="../../css/attLayout/paginaMeusDados.css" rel="stylesheet" />
    <link href="../../css/attLayout/paginaMudarSenha.css" rel="stylesheet" />
    <link href="../../css/attLayout/paginaSistema.css" rel="stylesheet" />
    <link href="../../css/attLayout/paginaInterpreteOnline.css" rel="stylesheet" />
    <link href="../../css/attLayout/faq.css" rel="stylesheet" />


    <script src="alexandre-layout-design/js/alexandre.js"></script>
    <!-- <script src="alexandre-layout-design/js/calendario.js"></script> -->

    <!-- Font Awesome JS -->
    <script defer src='https://use.fontawesome.com/releases/v5.0.13/js/solid.js' integrity='sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ' crossorigin='anonymous'></script>
    <script defer src='https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js' integrity='sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY' crossorigin='anonymous'></script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
    <script src='alexandre-layout-design/bootstrap-4.3.1/dist/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>

    <!-- End of Funções desktop -->
    <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

    <!-- VIDEO PLAYER -->
    <script src='js/video.js'></script>
    <link rel='stylesheet' type='text/css' href='inc/video.css'>

    <script>
        //Testa o navegador
        var isIE = ((navigator.appVersion.indexOf('MSIE') != -1));
        var isOpera = ((navigator.userAgent.indexOf('Opera') != -1));
        var isFF = (!(isIE || isOpera));
    </script>
</head>

<body>
    <header>

    </header>
    <main>
    <?php
        include('faq.html');
    ?>
    </main>
    <footer id='footer'>

    </footer>


</body>

</html>
