<?PHP
/*------------------------------------------------------------------------------------------------------------
Módulo         : Usuário - manutenção
--------------------------------------------------------------------------------------------------------------
Mantenedor     : Rodrigo Dittmar
Tabelas        : user
Dependencias   :
------------------------------------------------------------------------------------------------------------*/
$aModule['cfg']['name'] = 'Manutenção das opções do sistema'; // Módulo é executado publicamente
$aModule['cfg']['system'] = true;             // Módulo do sistema
$aModule['cfg']['public'] = true;             // Módulo do sistema
$aModule['cfg']['paper'] = 'public';          // Grupo do usuário que pode executar
$aModule['cfg']['post'] = '';                 // Arquivo que contém o arquivo HTML (False para especificado no arquivo),
$aModule['main']              = '';           // HTML
$aModule['form']['type']      = 'A';          // Formulário de Ação
$aModule['form']['form']      = 'ususys.html';           // Nome do arquivo HTML (False para não carregar nenhum formulario
$aModule['form']['container'] = 'body';                  // Container do formulario
$aModule['js']['before'] = 'clearChild(body);gl_Desktop.setURL("/ame/?ususys")';
$aModule['sql']['select'] = 'select idUser, skin, iconAnimated, videoAutoplay, videoMute, notification, geolocation
                             from cl_user
                             where ( idUser = :iduser )';
$aModule['sql']['param']['iduser'] = $_SESSION['id'];

$aModule['data']['iduser'       ] = array( 'usuusu', ES_VBINTEGER, 10 );     // ID Usuário
$aModule['data']['skin'         ] = array( 'ususkn', ES_VBBOOL, 1 ); ;       // Skin
$aModule['data']['iconanimated' ] = array( 'usugic', ES_VBBOOL, 1 ); ;       // Ícones Animados
$aModule['data']['videoautoplay'] = array( 'usugvd', ES_VBBOOL, 1 ); ;       // Autoplay - Video
$aModule['data']['videomute'    ] = array( 'usugvm', ES_VBBOOL, 1 ); ;       // Video - Mudo
$aModule['data']['notification' ] = array( 'usugnt', ES_VBBOOL, 1 ); ;       // Notificação
$aModule['data']['geolocation'  ] = array( 'usugnt', ES_VBBOOL, 1 ); ;       // Geolocalização
