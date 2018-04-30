<?php

class Player{
  private $hand = [];

  public function __construct(){
  }

  public function hand(){
    return $this->hand;
  }

  public function obtainCard($card){
    array_push($this->hand, $card); 
  }
}