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
$fForm = "dskcld";
$aModule['cfg']['name'] = 'Desktop';          // Módulo é executado publicamente
$aModule['cfg']['system'] = true;             // Módulo do sistema
$aModule['cfg']['public'] = true;             // Módulo é executado publicamente
$aModule['cfg']['paper'] = 'public';          // Grupo do usuário que pode executar
$aModule['cfg']['post'] = '';                 // Arquivo que contém o arquivo HTML (False para especificado no arquivo),
$aModule['main']              = '';           // HTML
$aModule['form']['type']      = 'A';          // Formulário de Ação
$aModule['form']['form']      = 'dskcld.html';   // Nome do arquivo HTML (False para não carregar nenhum formulario
$aModule['form']['container'] = 'clibrascalendario';               // Container do formulario
$aModule['js']['before']      = '';   // limpando os containers
?>
