<?php

class Player{
  private $hand;

  public function __construct(){
    $this->hand = [];
  }

  public function hand(){
    return $this->hand;
  }
}