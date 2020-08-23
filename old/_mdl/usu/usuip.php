<?PHP
/*-------------------------------------------------------------------------------------------------------------
Módulo         : Usuário - Retorna o IP do Usuário
---------------------------------------------------------------------------------------------------------------
Mantenedor     : Alexandre Carneiro/Rodrigo Dittmar
Tabelas        : user
Dependencias   :
-------------------------------------------------------------------------------------------------------------*/
$aModule['cfg']['name']    = 'Ip do Usuário'; // Módulo é executado publicamente
$aModule['cfg']['version'] = 1;                  // Versão do Módulo
$aModule['cfg']['system']  = true;               // Módulo do sistema
$aModule['cfg']['public']  = true;               // Módulo é executado publicamente
$aModule['cfg']['registered'] = false;           // Módulo Público
$aModule['cfg']['post'] = '';                    // Arquivo que contém o arquivo HTML (False para especificado no arquivo),
$aModule['main']              = '';              // HTML
$aModule['form']['type']      = 'A';             // Formulário de Ação
$aModule['form']['form']      = 'usuip.html';    // Nome do arquivo HTML (False para não carregar nenhum formulario
$aModule['form']['container'] = 'body';          // Container do formulario
