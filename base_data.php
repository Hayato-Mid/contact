<?php 
  class Contact{
    private $name;
    private $email;
    private $content;
    
    private static $no = 0;
    
    public function __construct($name, $email , $content){
    $this -> name = $name;
    $this -> email = $email;
    $this -> content = $content;
    
    self::$no++;
    }
    
    public function getName() {
    return $this->name;
    }
  
    public function getMail() {
    return $this->email;
    }
    
    public function getContent() {
    return $this->content;
    }
    
    
    public function setName($name) {
      $this->name = $name;
    }
    public function setName($email) {
      $this->email = $email;
    }
    public function setName($content) {
      $this->content = $content;
    }
    
    public static function getCount() {
    return self::$no;
  }
    
  }
  

?>