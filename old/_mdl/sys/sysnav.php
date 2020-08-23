<?PHP
/*------------------------------------------------------------------------------------------------------------
Módulo         : Sistema - Menu
--------------------------------------------------------------------------------------------------------------
Mantenedor     : Rodrigo Dittmar
Tabelas        :
Dependencias   :
------------------------------------------------------------------------------------------------------------*/
$aModule['cfg']['name']   = 'Navbar - Vertical';           // Nome do Módulo
$aModule['cfg']['system'] = true;             // Módulo do sistema
$aModule['cfg']['public'] = true;             // Módulo do Público
$aModule['cfg']['post']   = '';               // Arquivo que contém o arquivo HTML (False para especificado no arquivo),
$aModule['main']              = '';           // HTML
$aModule['form']['type']      = 'A';               // Formulário de Ação
$aModule['form']['form']      = 'sysnav.html';     // Nome do arquivo HTML (False para não carregar nenhum formulario
$aModule['form']['container'] = 'body';            // Container do formulario
$aModule['form']['replace']   = false;             // adiciona
$aModule['form']['positon']   = 'before';          // Posição a adicionar o formulário (before / after)
