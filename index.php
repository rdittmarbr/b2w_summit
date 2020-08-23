<?php
/*------------------=-----------=------------------------------------------------------------------------------
Sistema             : CLibras - Sistema para controle de chamadas
Modulo              : index
-------------------------------------------------------------------------------------------------------------*/
$gl_TimeStart = microtime(true);     //Tempo de Inicio de Execucao do Script
$gl_Config    = false;               //Sistema configurado
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//Headers http
header('Content-type: text/html; charset=utf-8');
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0');
//------------------------------------------------------------------------------
//Verificando se o sistema esta configurado
if ((!file_exists('_LocalSettings.php') or !file_exists('_Config.php')) and $gl_Config) {
  print('O Sistema nao esta configurado. Execute o processo de instalacao novamente.');
  die();
}
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//Carregando os Modulos
include_once('_Config.php');
include_once('_LocalSettings.php');
include_once(ES_LIB . '_functions.php'); //Debug do sistema
include_once(ES_LIB . '_TcDebug.php');   //Debug do sistema
include_once(ES_LIB . '_TcDB.php');      //Conea DB
include_once(ES_LIB . '_TcUser.php');    //Controle de acesso
//-------------------------------------------------------------------------------------------------------------
// verifica se o debug foi ativado no _config e seta as variaveis para exibir os erros
if (ES_PHPDEBUG) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}
//-------------------------------------------------------------------------------------------------------------
//Definindo as Variavies Globais Utilizadas
$gl_Active = false;                      // Usuário está ativo
$gl_Owner  = my($_SERVER['PHP_SELF']);   // Pega o nome do arquivo
//-------------------------------------------------------------------------------------------------------------
// Iniciando os objetos e classes do sistema
// Debug (Log)
$TcDebug = (ES_SYDEBUG ? new TcDebug($gl_Owner) : false);
// Acesso/Conectando ao DB
$TcDB    = new TcDB($gl_Owner, $gl_DB, $TcDebug);
// Acessando o sistema e carregando as configuracoes do usuario
$TcUser  = new TcUser($gl_Owner, $gl_User, $TcDB, $TcDebug);
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Gravando o log $_POST
if (ES_SYDEBUG and count($_POST) > 0) {
  $TcDebug->write($gl_Owner, '$_POST', $_POST);
}
//-------------------------------------------------------------------------------------------------------------
//Tratativas refente ao Formulario de Login/logout
//Força o logout do sistema - recarregando todos os módulos js e limpando o html
if (($gl_Owner == 'logout') or (isset($_POST['usutpy']) and $_POST['usutpy'] == 'O')) {
  if (ES_SYDEBUG and isset($_SESSION['user']) and isset($_SESSION['ip']))
    $TcDebug->setFile(date('md-H') . "-{$_SESSION['user']}.{$_SESSION['ip']}.txt");
  $gl_Active = $TcUser->logout();
  //Gravando o log para fechar a sessão do arquivo
  if (ES_SYDEBUG) {
    $TcDebug->save();
    $TcDebug->setFile();
  }
}
$gl_Active = $TcUser->active();
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
  <!-- fontawasome -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <script src="https://kit.fontawesome.com/0f38697d6b.js" crossorigin="anonymous"></script>
  <!-- <link rel="stylesheet" type="text/css" href="inc/bootstrap.min.css"> -->
  <link rel="stylesheet" href="alexandre-layout-design/bootstrap-4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- <link rel="stylesheet" type="text/css" href="css/login.css" /> -->
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
  <script src="js/fx.js"></script>
  <script src="js/dom.js"></script>
  <script src="js/prototype.js"></script>
  <script src="js/class.js"></script>
  <script src="js/class.TcAjax.js"></script>
  <script src="js/class.TcDesktop.js"></script>
  <script src="js/class.TcCalendar.js"></script>
  <script src="js/class.TcCookie.js"></script>
  <script src="js/class.TcVideo.js"></script>

  <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
  <script src="https://sindresorhus.com/screenfull.js/src/screenfull.js"></script>
  <!-- Funções do Desktop -->
  <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->

  <!-- esses são os css da atualização do layout -->
  <link href="css/attLayout/geral.css" rel="stylesheet" />
  <link href="css/attLayout/login.css" rel="stylesheet" />
  <link href="css/attLayout/navbar.css" rel="stylesheet" />
  <link href="css/attLayout/paginaInicial.css" rel="stylesheet" />
  <link href="css/attLayout/paginaAgendamento.css" rel="stylesheet" />
  <link href="css/attLayout/paginaMeusDados.css" rel="stylesheet" />
  <link href="css/attLayout/paginaMudarSenha.css" rel="stylesheet" />
  <link href="css/attLayout/paginaSistema.css" rel="stylesheet" />
  <link href="css/attLayout/paginaInterpreteOnline.css" rel="stylesheet" />
  <!-- <link href="css/attLayout/faq.css" rel="stylesheet" /> -->
  <link href="css/attLayout/aviso.css" rel="stylesheet" />

  <!-- <link href="css/navbar.css" rel="stylesheet" />
<link href="css/footer.css" rel="stylesheet" />
<link href="css/cores.css" rel="stylesheet" />
<link href="css/estilo.css" rel="stylesheet" />
<link href="css/tutorial.css" rel="stylesheet" />
<link href="css/CSS_PAGINAS.css" rel="stylesheet" /> -->


  <script src="alexandre-layout-design/js/alexandre.js"></script>
  <!-- <script src="alexandre-layout-design/js/calendario.js"></script> -->

  <!-- Font Awesome JS -->
  <script defer src='https://useq.fontawesome.com/releases/v5.0.13/js/solid.js' integrity='sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ' crossorigin='anonymous'></script>
  <script defer src='https://useq.fontawesome.com/releases/v5.0.13/js/fontawesome.js' integrity='sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY' crossorigin='anonymous'></script>

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
    var gl_Desktop = false; //Gerenciamento do desktop
    window.onload = function(e) {
      //Controle do desktop
      gl_Desktop = new TcDesktop(<?= ES_JSDEBUG ?>); //Gerenciamento do desktop
      //Testa a gravação de cookies, caso desabilitado, recupera a mensagem de erro.
      /*if( gl_Desktop.cookieTest('clibras') ) {*/
      //Recupera todos os módulos abertos
      gl_Desktop.getModule('<?= $gl_System['start'] ?>');
      /*  } else {
          alert('cade os coookies???');
          //gl_Desktop.getModule('hlp','cookie');
          //esDesktop.getModule({error:'cookiesneed'});
        }*/
      //gl_Desktop.addModule('TcCookie',new TcCookies);
    };
  </script>
</head>

<body>
  <header>
    <div id='header'></div>
  </header>
  <main>
    <div id='body'></div>
  </main>
  <footer>
    <div id='footer'></div>
  </footer>
</body>

</html>
<?PHP
//------------------------------------------------------------------------------
//Finalizando as Classes
if ($gl_Active and ES_SYDEBUG)
  $TcDebug->setFile(date('md-H') . "-{$_SESSION['user']}.{$_SESSION['ip']}.txt");
unset($TcUser);
unset($TcDB);
unset($TcDebug);
//------------------------------------------------------------------------------
