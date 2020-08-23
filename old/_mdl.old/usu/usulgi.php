<?PHP
/*-------------------------------------------------------------------------------------------------------------
Módulo         : Usuário - Login - Exibe o formulario de login ou processa a requisicao de ingresso no sistema
---------------------------------------------------------------------------------------------------------------
Mantenedor     : Alexandre Carneiro/Rodrigo Dittmar
Tabelas        : user
Dependencias   : TcUser
-------------------------------------------------------------------------------------------------------------*/
$aModule['cfg']['name']    = 'Login do usuário'; // Módulo é executado publicamente
$aModule['cfg']['version'] = 1;                  // Versão do Módulo
$aModule['cfg']['system']  = true;               // Módulo do sistema
$aModule['cfg']['public']  = true;               // Módulo é executado publicamente
$aModule['cfg']['registered'] = false;           // Módulo Público
$aModule['cfg']['paper'] = 'public';             // Grupo do usuário que pode executar
$aModule['cfg']['post'] = '';                    // Arquivo que contém o arquivo HTML (False para especificado no arquivo),
$aModule['main']              = '';              // HTML
$aModule['form']['type']      = 'A';             // Formulário de Ação
$aModule['form']['form']      = 'usulgi.html';           // Nome do arquivo HTML (False para não carregar nenhum formulario
$aModule['form']['container'] = 'body';                  // Container do formulario
$aModule['js']['before'][]    = 'clearChild(body)';
$aModule['js']['after'][]     = 'gl_Desktop.setURL("/ame/")';

// Setando o usuário para teste

$aIP = get_IP();
if( $aIP == "200.17.210.139" or $aIP == "10.164.14.50") {
  $aModule['js']['after'][] = 'in_usulgi_usuusu.value="rdittmar";in_usulgi_usupas.value="123456";';
} else if( $aIP == "200.17.210.169" ) {
  $aModule['js']['after'][] = 'in_usulgi_usuusu.value="alexandrecarneiro";in_usulgi_usupas.value="123456"; alert("ok");';
}

/*------------------=-----------=------------------------------------------------------------------------------
usulgn_post         : Processa o Post do formulário
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aType               :char       : Caracter de controle para o tipo de post ( C - Consulta / U - Update / D - Delete)
aParam              :array      : Vetor de manutenção do formulario
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
if( ! function_exists('usulgi_post')) {

  function usulgi_post( $aType , $aParam ) {
    //Recursos utilizados
    global $TcDebug;
    global $TcUser;
    global $TcPackage;

    if( ES_SYDEBUG ) $TcDebug -> write( 'ajax-json' , 'usulgi_post' , $aParam );

    $aField = array();     // Armazena a estrutura dos dados, para teste/verificação
    $aError = 0;           // Armazena os erros

    // Apelido do campo = [tipo,tamanho,nulo]
    // Apelido do campo - Nome no formulario html
    $aField['usuusu'] = array("ES_VBVARCHAR",60,false);   //Usuário
    $aField['usupas'] = array("ES_VBVARCHAR",60,false);   //Senha
    $aField['usutpy'] = array("ES_VBVARCHAR",60,false);   //Tipo de Login

    //Realiza os testes com as variáveis
    foreach( $aField as $aKey => $aRow ) {
      if( !isset( $aParam[$aKey]) ) {
        $aError++;
      }
    }

    //Executa o Login se não houver erro
    if( !$aError ) {
      //---------------------------------------------------------------------------------------------------------
      //Realizando o Login
      if( $aParam["usutpy"] == 'I' ) {
        if( ES_SYDEBUG ) $TcDebug -> write( 'ajax-json' , 'usulgi_post' , 'login' );
        //Processando o Login
        if( $TcUser -> login( $aParam['usuusu'] ,$aParam['usupas'] ) ) {
          // Login - Sucess
          if( ES_SYDEBUG ) $TcDebug -> write( 'ajax-json' , 'usulgi_post' , $_SESSION );
          return true;
        } else {
          //Erro ao realizar o login
        }
      }
    }
    return false;
  }
}
