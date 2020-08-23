<?php
/*------------------=-----------=------------------------------------------------------------------------------
Sistema             : CLibras - Sistema para controle de chamadas
Modulo              : index
-------------------------------------------------------------------------------------------------------------*/
$esTimeStart = microtime(true);     //Tempo de Inicio de Execucao do Script
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//Headers http
header('Content-type: text/html; charset=utf-8');
header('Cache-Control: no-cache, no-store, must-revalidate'); // HTTP 1.1.
header('Pragma: no-cache'); // HTTP 1.0.
header('Expires: 0');
//------------------------------------------------------------------------------
//Verificando se o sistema esta configurado
if (!file_exists('_LocalSettings.php') or !file_exists('_Config.php')) {
  print('O Sistema nao esta configurado. Execute o processo de instalacao novamente.');
  die();
}
//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//Carregando os Modulos
include('_Config.php');
include('_LocalSettings.php');
include_once(ES_LIB . '_functions.php'); //Debug do sistema

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

  <script>

  </script>
</head>

<body>
  <main>
    <div id='body'></div>
    <?php

    foreach ($_GET as $aKey => $aValue) {
      print 'P ' . $aKey . '=>' . password($aValue) . '<br />';
      print 'H ' . $aKey . '=>' . myHash($aValue) . '<br />';
    }
    ?>
  </main>
</body>

</html>