<?
if (! (isset($_GET['password'])) )
  print(" use password.php?password=senha ");
 else
  print( md5($_GET['password']) )
?>
