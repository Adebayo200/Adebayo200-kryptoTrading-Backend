<?php
 class Database
 {
    private $user ="root";
    private $pws = "";
    private $DNS = "mysql:host=localhost;dbname=kryptotrading";
    
    public $con = null;

    public function __construct()
    {
       $this->con = new PDO($this->DNS, $this->user, $this->pws);
       if(!$this->con)
       {
         echo "Error: in connection";
       }
    }
 }    
