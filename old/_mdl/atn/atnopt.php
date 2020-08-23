<?PHP
/*-----------------------------------------------------------------------------------------------------------
Arquivo        : Tela de Login - Usuario
-------------------------------------------------------------------------------------------------------------
Tabelas        : user
Dependencias   :
-------------------------------------------------------------------------------------------------------------
Linguaguem     : php 5.x
Dependencias   :
-----------------------------------------------------------------------------------------------------------*/
$aModule['cfg']['name'] = 'Opções do atendimento imediato';          // Módulo é executado publicamente
$aModule['cfg']['system'] = true;             // Módulo do sistema
$aModule['cfg']['public'] = true;             // Módulo é executado publicamente
$aModule['cfg']['paper'] = 'public';          // Grupo do usuário que pode executar
$aModule['cfg']['post'] = '';                 // Arquivo que contém o arquivo HTML (False para especificado no arquivo),
$aModule['main']              = '';           // HTML
$aModule['form']['type']      = 'A';          // Formulário de Ação
$aModule['form']['form']      = 'atnopt.html';   // Nome do arquivo HTML (False para não carregar nenhum formulario
$aModule['form']['container'] = 'body';               // Container do formulario
$aModule['js']['before']      = 'body.clearChild;gl_Desktop.setURL("/ame/atnopt")';   // limpando os containers
$aModule['js']['after']      = '';
