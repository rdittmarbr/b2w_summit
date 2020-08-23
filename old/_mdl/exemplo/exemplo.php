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
$aModule['cfg']['name'] = 'Desktop';          // Módulo é executado publicamente
$aModule['cfg']['system'] = true;             // Módulo do sistema
$aModule['cfg']['public'] = true;             // Módulo é executado publicamente
$aModule['cfg']['registered'] = true;         // Necessário o usuário estar logado
$aModule['cfg']['paper'] = 'public';          // Grupo do usuário que pode executar
$aModule['cfg']['post'] = '';                 // Arquivo que contém o arquivo HTML (False para especificado no arquivo),
$aModule['main']              = '';           // HTML
$aModule['form']['type']      = 'A';          // Formulário de Ação
$aModule['form']['form']      = 'navbar.html,dskusu.html,foobar.html';   // Nome do arquivo HTML (False para não carregar nenhum formulario
$aModule['form']['container'] = 'header,body,footer';               // Container do formulario
$aModule['js']['before']      = 'header.clearChild;body.clearChild;footer.clearChild;'   // limpando os containers
// Valores Padrão para os campos
$aModule['data']['usuusu'] = '';          // ID Usuário
$aModule['data']['usunme'] = '';          // Nome Completo
$aModule['data']['usucde'] = '';          // Usuário
$aModule['data']['usuavt'] = '';          // Avatar - Imagem do Usuário
$aModule['data']['ususme'] = '';          // Nome Social
$aModule['data']['usurge'] = '';          // Código de Registro (GRR,Código do Aluno, Matrícula...)
$aModule['data']['usueml'] = '';          // Email de Registro
$aModule['data']['usuema'] = '';          // Email Alternativo
$aModule['data']['usudvl'] = false;       // Usuário Surdo
$aModule['data']['usudvb'] = false;       // Usuário  Cego
$aModule['data']['usudvd'] = false;       // Usuário Daltônico
$aModule['data']['ususkn'] = '';          // Skin

?>
