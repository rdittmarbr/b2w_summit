<?PHP
/*------------------------------------------------------------------------------------------------------------
Módulo         : Usuário - manutenção
--------------------------------------------------------------------------------------------------------------
Mantenedor     : Rodrigo Dittmar
Tabelas        : user
Dependencias   :
------------------------------------------------------------------------------------------------------------*/
$aModule['cfg']['name'] = 'Manutenção dos dados do Usuário'; // Módulo é executado publicamente
$aModule['cfg']['system'] = true;             // Módulo do sistema
$aModule['cfg']['public'] = true;             // Módulo Público
$aModule['cfg']['paper'] = 'public';          // Grupo do usuário que pode executar
$aModule['cfg']['post'] = '';                 // Arquivo que contém o arquivo HTML (False para especificado no arquivo),
$aModule['main']              = '';           // HTML
$aModule['form']['type']      = 'A';          // Formulário de Ação
$aModule['form']['form']      = 'usudta.html';           // Nome do arquivo HTML (False para não carregar nenhum formulario
$aModule['form']['container'] = 'body';                  // Container do formulario
$aModule['js']['before'] = 'clearChild(body);gl_Desktop.setURL("/ame/?usudta")';
$aModule['sql']['select'] = 'select idUser, name, code, avatar, socialName, register, email, emailAlternative, libras, braile, daltonico from cl_user
                             where ( idUser = :iduser )';
$aModule['sql']['param']['iduser'] = $_SESSION['id'];

$aModule['data']['iduser'          ] = array( 'usuusu', ES_VBINTEGER, 10 );         // ID Usuário
$aModule['data']['avatar'          ] = array( 'usuavt', ES_VBVARCHAR, 100 );        // Avatar - Imagem do Usuário
$aModule['data']['name'            ] = array( 'usunme', ES_VBVARCHAR, 60 );         // Nome Completo
$aModule['data']['code'            ] = array( 'usucde', ES_VBVARCHAR, 60 );         // Usuário
$aModule['data']['socialname'      ] = array( 'usunms', ES_VBVARCHAR, 60 );         // Nome Social
$aModule['data']['register'        ] = array( 'usurge', ES_VBVARCHAR, 60 );         // Código de Registro (GRR,Código do Aluno, Matrícula...)
$aModule['data']['email'           ] = array( 'usueml', ES_VBVARCHAR, 100 );        // Email
$aModule['data']['emailalternative'] = array( 'usuema', ES_VBVARCHAR, 100 );        // Email Alternativo
$aModule['data']['libras'          ] = array( 'usudvl', ES_VBBOOL, 1 ); ;           // Usuário Surdo
$aModule['data']['braile'          ] = array( 'usudvb', ES_VBBOOL, 1 ); ;           // Usuário  Cego
$aModule['data']['daltonico'       ] = array( 'usudvd', ES_VBBOOL, 1 ); ;           // Usuário Daltônico
/*------------------=-----------=------------------------------------------------------------------------------
usudta_get          : Recupera o valor solicitado
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aType               :char       : Caracter de controle para o tipo de post ( C - Consulta / U - Update / D - Delete)
aParam              :array      : Vetor de manutenção do formulario
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
if( ! function_exists('usudta_get')) {
}
