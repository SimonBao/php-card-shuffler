<?php

class Player{
  private $hand;

  public function __construct(){
    $this->hand = [];
  }

  public function hand(){
    return $this->hand;
  }

  public function obtainCard($card){
    array_push($this->hand, $card); 
  }
}