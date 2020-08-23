<?php
if (!isset($_SESSION)) {//Verificar se a sessão não já está aberta.
  session_start(); }
$_SESSION['user'] = $_POST["cl_uuser"];
?>
<!doctype html>
<html lang="pt-br">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <meta http-equiv="content-language" content="pt-br" />
   <title>CLibras Aberta</title>
   <link rel="stylesheet" href="css/clibras.css" />
</head>

<body>
<div class="cl_bd">
<div class="cl_top">
   <div class="cl_top  wrapper">
      <h1>CLibras Aberta</h1>
   </div>

   <div class="cl_card wrapper">
      <h2>Seja bem vindo <?php print $_SESSION['user'] ?></h2>
   </div>
   <div id="image-map"  class="image-mapper">
      <img class="image-mapper-img" src="img/bg.png" usemap="#image-map" />
      <svg class="image-mapper-svg width image-mapper-img"  style="width: 100%;">
         <circle cx="86"  cy="390" r="82" class="image-mapper-shape" style="fill: rgb(102, 102, 102); stroke: rgb(51, 51, 51); stroke-width: 1px; opacity: 0.6; cursor: pointer;"></circle>
         <circle cx="191" cy="237" r="82" class="image-mapper-shape" style="fill: rgb(102, 102, 102); stroke: rgb(51, 51, 51); stroke-width: 1px; opacity: 0.6; cursor: pointer;"></circle>
         <circle cx="191" cy="533" r="82" class="image-mapper-shape" style="fill: rgb(102, 102, 102); stroke: rgb(51, 51, 51); stroke-width: 1px; opacity: 0.6; cursor: pointer;"></circle>
         <circle cx="387" cy="533" r="82" class="image-mapper-shape" style="fill: rgb(102, 102, 102); stroke: rgb(51, 51, 51); stroke-width: 1px; opacity: 0.6; cursor: pointer;"></circle>
         <circle cx="582" cy="533" r="82" class="image-mapper-shape" style="fill: rgb(102, 102, 102); stroke: rgb(51, 51, 51); stroke-width: 1px; opacity: 0.6; cursor: pointer;"></circle>
      </svg>
      <map name="image-map" >
         <area target="" alt="" title="Restaurante Universitário"           href="http://clibrasbbb.ufpr.br/bigbluebutton/api/join?fullName=Aluno&meetingID=UFPR&password=Int%C3%A9rprete&redirect=true&checksum=394b3fe6f974f1d67badddfad1ac763d811b7ab0" coords="191,237,82" shape="circle">
         <area target="" alt="" title="Sistema de Bibliotecas"              href="http://clibrasbbb.ufpr.br/bigbluebutton/api/join?fullName=Aluno&meetingID=UFPR&password=Int%C3%A9rprete&redirect=true&checksum=394b3fe6f974f1d67badddfad1ac763d811b7ab0" coords=" 86,390,82" shape="circle">
         <area target="" alt="" title="Pró-reitoria de Assuntos Estudantis" href="http://clibrasbbb.ufpr.br/bigbluebutton/api/join?fullName=Aluno&meetingID=UFPR&password=Int%C3%A9rprete&redirect=true&checksum=394b3fe6f974f1d67badddfad1ac763d811b7ab0" coords="191,533,82" shape="circle">
         <area target="" alt="" title="" href=""           coords="775,533,82" shape="circle">
         <area target="" alt="" title="" href=""           coords="582,533,82" shape="circle">   !-->
      </map>
   </div>
</div>
<div class="cl_bg"></div>
</div>
</body>
</html>
