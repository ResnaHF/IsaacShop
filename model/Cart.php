<?php

class Cart{
    private $number;
    private $numberTab;
    private $amount;
    private $amountTab;
    private $itemTab;
    
    
    private $tab;
    
    function __construct(){
        $this->number = 0; 
        $this->numberTab = array();
        $this->amount = 0;
        $this->amountTab = array();
        $this->itemTab = array();
    }
    
    function getNumber(){
        return $this->number;
    }
    
    function getNumberItem($idItem){
        if(isset($this->numberTab[$idItem])){
            return $this->numberTab[$idItem];
        }else{
            return 0;
        }
    }
    
    function getAmount(){
        return $this->amount;
    }
    
    function getAmountItem($idItem){
        if(isset($this->amountTab[$idItem])){
            return $this->amountTab[$idItem];
        }else{
            return 0;
        }
    }
    
    function getItem($idItem){
        if(isset($this->itemTab[$idItem])){
            return $this->itemTab[$idItem];
        }else{
            return null;
        }
    }
    
    function getIdList(){
        $list = array_keys($this->numberTab);
        asort($list);
        return $list;
    }
    
    function plus($idItem){
        if(isset($this->numberTab[$idItem])){
            $this->numberTab[$idItem] += 1;
        }else{
            $this->numberTab[$idItem] = 1;
        }
        $this->number += 1;
        return $this;
    }
    
    function minus($idItem){
        if(isset($this->numberTab[$idItem])){
            if($this->numberTab[$idItem] == 1){
                unset($this->numberTab[$idItem]);
            }else{
                $this->numberTab[$idItem] -= 1;
            }
            
            $this->number -= 1;
        }
        return $this;
    }
    
    function remove($idItem){
        if(isset($this->numberTab[$idItem])){
            $this->number -= $this->numberTab[$idItem];
            unset($this->numberTab[$idItem]);
        }
        return $this;
    }
    
    function compute(){
        $this->amount = 0;
        $itemList = ArticlesDAO::getItemList(array_keys($this->numberTab));
        foreach($itemList as $item){
            if(isset($this->numberTab[$item->getId()])){
                $this->amount += ($this->amountTab[$item->getId()] = $this->numberTab[$item->getId()] * $item->getPrice());
                $this->itemTab[$item->getId()] = $item;
            }
        }
        return $this;
    }
}

?>