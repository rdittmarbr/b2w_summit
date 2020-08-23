<?PHP
/*------------------------------------------------------------------------------------------------------------
Módulo         : Usuário - manutenção
--------------------------------------------------------------------------------------------------------------
Mantenedor     : Alexandre Carneiro / Rodrigo Dittmar
Tabelas        : User
Dependencias   :
------------------------------------------------------------------------------------------------------------*/
$aModule['cfg']['name']   = 'Recuperar a Senha do usuário'; // Módulo é executado publicamente
$aModule['cfg']['system']  = true;               // Módulo do sistema
$aModule['cfg']['public']  = true;               // Módulo é executado publicamente,
$aModule['cfg']['registered'] = false;           // Módulo Público
$aModule['cfg']['paper']  = 'public';                       // Grupo do usuário que pode executar
$aModule['cfg']['post']   = '';                             // Arquivo que contém o arquivo HTML (False para especificado no arquivo),
$aModule['main']              = '';                         // HTML
$aModule['form']['type']      = 'A';                        // Formulário de Ação
$aModule['form']['form']      = 'usupsr.html';              // Nome do arquivo HTML (False para não carregar nenhum formulario
$aModule['form']['container'] = 'body';                     // Container do formulario
$aModule['js']['before'][] = 'clearChild(body);gl_Desktop.setURL("/ame/?usupsr")';
