<?php
/*------------------=-----------=------------------------------------------------------------------------------
Sistema             : CLibras - Sistema para controle de chamadas
Modulo              : Executa de comandos através do AJAX / JSON
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
include('_Config.php');
include('_LocalSettings.php');
include_once(ES_LIB . '_functions.php'); //Funções auxiliares do sistema
include_once(ES_LIB . '_TcClass.php');   //Parametros padrões
include_once(ES_LIB . '_TcDebug.php');   //Debug do sistema
include_once(ES_LIB . '_TcDB.php');      //Sessao - Usuario
include_once(ES_LIB . '_TcUser.php');    //Controle de acesso
include_once(ES_LIB . '_TcPackage.php'); //Controle de acesso
//-------------------------------------------------------------------------------------------------------------
// verifica se o debug foi ativado no _config e seta as variaveis para exibir os erros
if (ES_PHPDEBUG) {
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}
//-------------------------------------------------------------------------------------------------------------
//Definindo as Variavies Globais Utilizadas
$gl_Active = false;                      // Usuário ativo
$gl_Login  = false;                      // Força o envio do Login
$gl_Owner  = my($_SERVER['PHP_SELF']);   // Retorna o nome do arquivo em execução
//-------------------------------------------------------------------------------------------------------------
// Iniciando os objetos e classes do sistema
// Debug (Log)
$TcDebug = (ES_SYDEBUG ? new TcDebug($gl_Owner) : null);
// Acesso/Conectando ao DB
$TcDB    = new TcDB($gl_Owner, $gl_DB, $TcDebug);
// Acessando o sistema e carregando as configuracoes do usuario
$TcUser  = new TcUser($gl_Owner, array('project' => $gl_System['project']), $TcDB, $TcDebug);
// Carga/Manutenção dos pacotes e processamento das requisições
$TcPackage = new TcPackage($gl_Owner, $TcDB, $TcUser, $TcDebug);
//-------------------------------------------------------------------------------------------------------------
// Tratando os valores enviados do formulário (Convertendo de string para vetor)
// entrada :usupas:teste,usu:testes -> $_POST['V']['USU'] = 'testes' $_POST['V']['USUPAS'] = 'teste'
if (isset($_POST['V'])) {
  $_POST['V'] = formDecode($_POST['V']);
  if (ES_SYDEBUG) $TcDebug->write($gl_Owner, '$_POST', $_POST);
  if (ES_SYDEBUG) $TcDebug->write($gl_Owner, '$_COOKIE', $_COOKIE);
}
$gl_Active = $TcUser->active();

//-------------------------------------------------------------------------------------------------------------
//Se o usuário não está ativo, busca pelos formulários públicos ou processa o login (formulário ou autenticação)
if (!$gl_Active) {

  // Se não foi solicitado módulo, encaminha o login
  if (!isset($_POST['M']) or $_POST['M'] == '') {
    $_POST['M']  = 'usulgi';
  }

  //--------------------------------------------------------------
  // Carrega o módulo
  if ($TcPackage->getModule($_POST['M'], 'M')) {

    $TcPackage->processModule($_POST['M']);

    //Verifica se foi postado os dados do formulario de login
    if (isset($_POST['V']) && ($_POST['M'] == 'usulgi')) {
      if (ES_SYDEBUG) $TcDebug->write($gl_Owner, '', 'POST Detectado usulgi');
      // Verifica se existe a função para login
      if (function_exists('usulgi_post')) {
        if (call_user_func('usulgi_post', 'L', $_POST['V'])) {
          $gl_Active = true;
        } else {
          //Apresenta erro ao realizar o login
          $TcPackage->addJS('after', 'alert("erro ao realizar o login");');
          $TcPackage->addJS('after', 'in_usulgi_usu.value="";in_usulgi_usupas.value="";');
        }
      }
    }
    //--------------------------------------------------------------
    // Não sendo possível carregar o módulo - Usuário não logado
  } else {
    if (ES_SYDEBUG) $TcDebug->write($gl_Owner, '', 'Erro ao carregar o módulo - Reenviando o Login');
    $TcPackage->getModule('usulgi', 'M');
    $TcPackage->processModule('usulgi');
  }
}

//-------------------------------------------------------------------------------------------------------------
//Verifica se o usuário está ativo
if ($gl_Active) {

  if (!isset($_POST['M']) or $_POST['M'] == '' or $_POST['M'] == 'usulgi') {

    // usuário não conectado
    if (ES_SYDEBUG) $TcDebug->write($gl_Owner, '', 'usuário ATIVO - processando módulos carregados!');

    if ($TcPackage->getModule('dskusu', 'M')) {
      $TcPackage->processModule('dskusu');
    }
  } else {

    // usuário não conectado
    if (ES_SYDEBUG) $TcDebug->write($gl_Owner, '', 'usuário ATIVO - processando modulo :' . $_POST['M']);

    if ($TcPackage->getModule($_POST['M'], 'M')) {
      $TcPackage->processModule($_POST['M']);
    }
  }
}

//-----------------------------------------------------------------------------------------------------------
//Enviando a requisicao como JSON
$TcPackage->writePackage();
//-----------------------------------------------------------------------------------------------------------
//Finalizando as Classes
if ($gl_Active and ES_SYDEBUG)
  $TcDebug->setFile(date('md-H') . "-{$_SESSION['user']}.{$_SESSION['ip']}.txt");

unset($TcPackage);
unset($TcUser);
unset($TcDB);
unset($TcDebug);
