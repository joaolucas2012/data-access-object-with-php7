<?php

// Fazer o requerimento de um classe sempre que ela for necessária
spl_autoload_register(function($class_name){
  $fileName = $class_name.".php";
  if(file_exists($fileName)){
    require_once($fileName);
  }
});

?>