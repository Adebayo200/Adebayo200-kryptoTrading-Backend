<?php
 spl_autoload_register('autoloader');

 function autoloader($classname)
 {
     $path = "Model/";
     $extension = ".php";
     $fullpath = $path.$classname.$extension;

     include_once($fullpath);
 }