<?PHP
/*-------------------------------------------------------------------------------------------------------------
Módulo         : Usuário - Login - Exibe o formulario de login ou processa a requisicao de ingresso no sistema
---------------------------------------------------------------------------------------------------------------
Mantenedor     : Rodrigo Dittmar
Tabelas        : user
Dependencias   : TcUser
-------------------------------------------------------------------------------------------------------------*/
$fForm = "usulgn";
$aModule['cfg']['name'] = 'Login do usuário'; // Módulo é executado publicamente
$aModule['cfg']['system'] = true;             // Módulo do sistema
$aModule['cfg']['public'] = true;             // Módulo é executado publicamente
$aModule['cfg']['paper'] = 'public';          // Grupo do usuário que pode executar
$aModule['cfg']['post'] = '';                 // Arquivo que contém o arquivo HTML (False para especificado no arquivo),
$aModule['main']              = '';           // HTML
$aModule['form']['type']      = 'A';          // Formulário de Ação
$aModule['form']['form']      = 'usulgn.html';           // Nome do arquivo HTML (False para não carregar nenhum formulario
$aModule['form']['container'] = 'body';                  // Container do formulario
/* Para enviar mais de uma interface - Exemplo
$aModule['form']['form']      = 'usulgn.html,footer.html';
$aModule['form']['container'] = 'body,footer'; */

/*------------------=-----------=------------------------------------------------------------------------------
usulgn_post         : Processa o Post do formulário
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aType               :char       : Caracter de controle para o tipo de post ( C - Consulta / U - Update / D - Delete)
aParam              :array      : Vetor de manutenção do formulario
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
function usulgn_post( $aType , $aParam ) {

  //Recursos utilizados
  global $TcDebug;
  global $TcUser;
  global $TcPackage;

  if( ES_SYDEBUG ) $TcDebug -> write( 'ajax-json' , 'usulgn_post' , $aParam );

  $aField = array();     // Armazena a estrutura dos dados, para teste/verificação
  $aError = 0;           // Armazena os erros

  // Apelido do campo = [tipo,tamanho,nulo]
  // Apelido do campo - Nome no formulario html
  $aField['usu']    = array("ES_VBVARCHAR",60,false);   //Usuário
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
      if( ES_SYDEBUG ) $TcDebug -> write( 'ajax-json' , 'usulgn_post' , 'login' );
      //Processando o Login
      if( $TcUser -> login( $aParam['usu'] ,$aParam['usupas'] ) ) {
        // Login - Sucess
        if( ES_SYDEBUG ) $TcDebug -> write( 'ajax-json' , 'usulgn_post' , $_SESSION );
        return true;
      } else {
        //Erro ao realizar o login
      }
    }
  }
  return false;
}

?>
