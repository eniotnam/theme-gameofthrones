<?php

Class CoreController {
    private $_ViewPath = 'views/';
    private $_ViewPat = 'models/';

    private $_Variable = array();


    public function call($variable, $var){
        $this->_Variable[$variable] = $var;
    }

    public function home(){
        extract($this->_Variable);
        require $this->_ViewPath . 'header.php';
        require $this->_ViewPath . 'home.php';
        require $this->_ViewPath . 'footer.php';
//       require 'test.html';

    }
    public function house(){
        extract($this->_Variable);
        require $this->_ViewPath . 'header.php';
        require $this->_ViewPath . 'house.php';
        require $this->_ViewPath . 'footer.php';
    }
     public function connection(){
        extract($this->_Variable);
        require $this->_ViewPath . 'header.php';
        require $this->_ViewPath . 'connection.php';
        require $this->_ViewPath . 'footer.php';
    }
    public function login(){
        extract($this->_Variable);
        require $this->_ViewPath . 'login.php';
        require $this->_ViewPath . 'footer.php';

    }
     
    
    public function test(){
         extract($this->_Variable);
        require $this->_ViewPath . 'header.php';
        require $this->_ViewPath . 'test.php';
        require $this->_ViewPath . 'footer.php';  
    }
}