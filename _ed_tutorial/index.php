<?php
/*------------------------------------------------------------------------------
Sistema        : CLibras - Sistema para controle de chamadas
------------------------------------------------------------------------------*/
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="pt-BR" lang="pt-BR">
<head>
<title>Teste - tutorial</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="keywords" content="Libras, UFPR, CLibras" />
<meta name="copyright" content="UFPR" />
<meta name="language" content="pt-br" />
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../inc/css.css" />
<link rel="stylesheet" type="text/css" href="../inc/special.css" />
<link rel="stylesheet" type="text/css" href="../inc/desktop.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../inc/window.css" />
<script type="text/javascript" src="../js/fx.js"></script>
<script type="text/javascript" src="../js/dom.js"></script>

<script type="text/javascript" src="../js/class.js"></script>
<script type="text/javascript" src="../js/class.TcDesktop.js"></script>
<script type="text/javascript" src="../js/class.TcAjax.js"></script>
<script type="text/javascript" src="../js/class.TcChat.js"></script>
<script type="text/javascript" src="../js/class.TcPage.js"></script>


<script type="text/javascript" >
//Testa o navegador
var i = 0;

var j = ["cl_cabec","cl_atalho","cl_sistema"];

function navega(a ) {
  i = i +a ;
  if (i< 0 ) i = 0;
  $("cl_tutorial_onde").innerText = i;
  $(j[i]).innerText = j[i];
};
</script>

</head>
<body>
<div id="body">
  <div id="cl_cabec">
  </div>
  <div id="cl_atalho">
  </div>
  <div id="cl_sistema">
  </div>
  <div id="cl_fila">
  </div>


  <!-- tutorial !-->
  <div id="cl_tutorial">
    <span onClick="navega(-1);return true;">  &lt; anterior </span>
    <span onClick="navega(1);return true;"> &gt; próximo pr&oacute;ximo </span>
    <div id="cl_tutorial_onde"></div>

  </div>
</div> <!-- body -->
</body>
</html>
