<?php
print_r($_SESSION);

?>


<!doctype html>
<html lang="pt-br">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
   <meta http-equiv="content-language" content="pt-br" />
   <title>CLibras Aberta - Sistema de Bibliotecas - UFPR</title>
   <link rel="stylesheet" href="css/clibras.css" />
</head>
<body>
<div class="cl_bd">
<div class="cl_top">
   <div class="cl_card">
      <h2>CLibras Aberta - Sistema de Bibliotecas UFPR</h2>
   </div>
   <div class="cl_form">
   <img class="image-mapper-img" src="img/bg1.png" usemap="#image-map" />
   <map name="image-map" >
      <area target="" alt=""  href="index3.php" coords="191,237,82" shape="circle"
        title="Biblioteca de Ciências Humanas">
      <area target="" alt="" href="index2.php" coords=" 86,390,82" shape="circle"
        title="Biblioteca Campus Cabral">
      <area target="" alt="" href="index2.php" coords="276,390,82" shape="circle"
        title="Biblioteca de Ciências Jurídicas">
      <area target="" alt="" coords="466,390,82" shape="circle" title="Biblioteca de Ciências Jurídicas"
         href="http://clibrasbbb.ufpr.br/bigbluebutton/api/join?fullName=<?php print $a["cl_uuser"]?>
                  &meetingID=UFPR-BIBLIOTECA&password=ap&redirect=true&checksum=" >
      <area target="" alt="" href="index4.php" coords="191,533,82" shape="circle"
        title="Biblioteca de Ciências Florestais e da Madeira">
   </map>
</div>

   </div>
</div>
<div class="cl_bg"></div>
</div>
</body>
</html>
