<?PHP
/*------------------------------------------------------------------------------------------------------------
Módulo         : Financeiro - Cadastro de Contas / Bancos
--------------------------------------------------------------------------------------------------------------
Mantenedor     : Rodrigo Dittmar
Tabelas        : 
Dependencias   :
------------------------------------------------------------------------------------------------------------*/
$aModule['cfg']['name'] = 'Manutenção das contas Financeiras'; // Módulo é executado publicamente
$aModule['cfg']['system'] = true;             // Módulo do sistema
$aModule['cfg']['public'] = true;             // Módulo Público
$aModule['cfg']['paper'] = 'public';          // Grupo do usuário que pode executar
$aModule['cfg']['post'] = '';                 // Arquivo que contém o arquivo HTML (False para especificado no arquivo),
$aModule['main']              = '';           // HTML
$aModule['form']['type']      = 'A';          // Formulário de Ação
$aModule['form']['form']      = 'finban.html';           // Nome do arquivo HTML (False para não carregar nenhum formulario
$aModule['form']['container'] = 'body';                  // Container do formulario
$aModule['js']['before'] = 'clearChild(body);gl_Desktop.setURL("/ame/?finban")';
$aModule['sql']['param']['iduser'] = $_SESSION['id'];

/*------------------=-----------=------------------------------------------------------------------------------
finban_get          : Recupera o valor solicitado
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
aType               :char       : Caracter de controle para o tipo de post ( C - Consulta / U - Update / D - Delete)
aParam              :array      : Vetor de manutenção do formulario
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
-------------------------------------------------------------------------------------------------------------*/
if (!function_exists('finban_get')) {
}
