<?// Function to get the client ip address
function print_ln( $a ){
  print $a . "\r\n</br>";
}
print_ln('getenv');
print_ln( 'HTTP_CLIENT_IP:' . getenv('HTTP_CLIENT_IP') );
print_ln( 'HTTP_X_FORWARDED_FOR' . getenv('HTTP_X_FORWARDED_FOR'));
print_ln( 'HTTP_X_FORWARDED' . getenv('HTTP_X_FORWARDED'));
print_ln( 'HTTP_FORWARDED_FOR' . getenv('HTTP_FORWARDED_FOR'));
print_ln( 'HTTP_FORWARDED'. getenv('HTTP_FORWARDED'));
print_ln( 'REMOTE_ADDR' . getenv('REMOTE_ADDR'));
print_ln('');
print_ln('$_SERVER');
print_ln( 'HTTP_CLIENT_IP:' . $_SERVER['HTTP_CLIENT_IP'] );
print_ln( 'HTTP_X_FORWARDED_FOR' . $_SERVER['HTTP_X_FORWARDED_FOR']);
print_ln( 'HTTP_X_FORWARDED' . $_SERVER['HTTP_X_FORWARDED']);
print_ln( 'HTTP_FORWARDED_FOR' . $_SERVER['HTTP_FORWARDED_FOR']);
print_ln( 'HTTP_FORWARDED'. $_SERVER['HTTP_FORWARDED']);
print_ln( 'REMOTE_ADDR' . $_SERVER['REMOTE_ADDR']);

print(phpinfo());
?>
