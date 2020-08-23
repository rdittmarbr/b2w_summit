<?PHP
/*-----------------------------------------------------------------------------------------------------------
Descricao      : Arquivo de Configuracoes locais
-------------------------------------------------------------------------------------------------------------
Linguaguem     : php 7.x
-----------------------------------------------------------------------------------------------------------*/
//Configurações Globais
define('ES_ROBOTS', false); // Robots (google...) indexar o site

//Caminhos e Pastas
define('ES_LINK', 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']);   //Projeto

// Substituido pela inclusao do caminho completo
// Localização dos módulos dinamicamente
$aFile = explode('/', $_SERVER['SCRIPT_FILENAME']);
unset($aFile[count($aFile) - 1]);
$aFile = implode('/', $aFile) . '/';
define('ES', $aFile); // Recupera a localização atual
unset($aFile);

//define('ES', '/var/www/html/ame/');

// Localização fixa dos módulos
// define('ES', str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'] .'/clibras' ));
define('ES_LIB', ES . '_lib/');               //Bibliotecas PHP - Classe TC_ *
define('ES_MODULE', ES . '_mdl/');            //Módulos
define('ES_LOG', ES . '_log/');               //Local do Log do Projeto
define('ES_HTML', ES . 'html/');              //Formulários HTML

//Debug
define('ES_SYCONFIG', true);       //Imprimir a Configuração do Site
define('ES_SYDEBUG', true);       //Debug
define('ES_DEBUGLEVEL', 9);     //Nivel
define('ES_POSTDEBUG', true);     //Retorna o post JSON
define('ES_JSDEBUG', true);       //Debug javascript
define('ES_JSDEBUGLEVEL', 9);     //Nivel Javascript
define('ES_PHPDEBUG', true);      //Altera os parametros internos do php.ini para exibir mensagens de erro no código

//-----------------------------------------------------------------------------------------------------------
// Configurações do sistema
$gl_User = array(
  'instance' => array(
    'multiple' => true,           // Múltiplas instâncias
    'timeout'  => 86400
  ),        // Timeout (Segundos) - 60*60*24 = 1 dia
  'log'      => array(
    'access' => true,
    'pass'   => true,
    'module' => true
  ),
  'pass'     => array(
    'min'    => ES_LOGINPASS_MIN,             // Tamanho de Senha - Mínimo
    'max'    => ES_LOGINPASS_MAX,             // Tamanho de Senha - Máximo
    'complex' => '',                           // Nível de Complexidade
    'resset'    => array('email', 'register'), // Campos necessários para solicitar o resset da senha
    'tokenTime' => 86400
  ),                    // Tempo de vida da solicitação de nova senha
  'login'    => array('email', 'register', 'code', 'rf'),          // Campos aceitos para o Login
  'project'  => null
);        // Dados do projeto <- Recebe informações da $gl_System['project']
//                  <- Log/Debug/Sessão

//Coniguracao Banco de Dados
$gl_DB = array(
  'host' => 'localhost',
  'db'   => 'ame',
  'user' => 'ame',
  'pass' => 'ame@019',
  'type' => ES_DBMYSQL41
);

//CF - JavaScrip Incorporado
$esSocialPage = array(
  'googleAnalitycs' => '',
  'facebook' => '',
  'instagram' => ''
);

$gl_BBB = array(
  'secret' => 'fb92148cfa45c60c1b33fe4e0327dacd',
  'bbb' => 'https://clibras.teste.ufpr.br/bigbluebutton/api/join?fullName=User+2573276&meetingID=random-6017378&password=ap&redirect=true&checksum=db738b5ecf0277458a9c6ffac26bde6eaf776ab5'
);

$gl_System = array(
  'project' => 'ame',    // Projeto
  'start'   => 'usulgi'  // Módulo inicial
);

$gl_User['project'] = $gl_System['project'];

//Sitio Configurado
$gl_Config     = true;
$gl_Debug      = true;


//- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
$gl_Skin = array(
  'skin' => '',          // Nome do skin ( precedido por / : por exemplo UFPR/ )
  'fixed' => false
);    // Impede a alteração do skin
