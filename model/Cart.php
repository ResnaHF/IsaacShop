<?php

class Cart{
    private $tab;
    private $total;
    
    function __construct(){
        $this->total = 0; 
        $this->tab = array();
    }
    
    function getTotal(){
        return 0;
    }
    
    function plus($idItem){
        if(isset($this->tab[$idItem])){
            $this->tab[$idItem] += 1;
        }else{
            $this->tab[$idItem] = 1;
        }
        $this->total += 1;
    }
    
    function minus($idItem){
        if(isset($this->tab[$idItem])){
            if($this->tab[$idItem] == 1){
                unset($this->tab[$idItem]);
            }else{
                $this->tab[$idItem] -= 1;
            }
            
            $this->total -= 1;
        }
    }
    
    function remove($idItem){
        if(isset($this->tab[$idItem])){
            $this->total -= $this->tab[$idItem];
            unset($this->tab[$idItem]);
        }
    }
}

?>