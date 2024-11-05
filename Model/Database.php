<?php
 class Database
 {
    private $user ="kryptot7_krypto";
    private $pws = "krypto123$";
    private $DNS = "mysql:host=wghp11.wghservers.com;dbname=kryptot7_kryptotrading";
    
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