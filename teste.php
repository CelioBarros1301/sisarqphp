<?php
  $nomeHost = gethostname();
  $ip = gethostbyname($nomeHost);
  
  echo $ip;

  $ip = $_SERVER['SERVER_ADDR'];

echo $ip;
    
?>