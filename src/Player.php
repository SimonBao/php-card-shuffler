<?php

class Player{
  private $hand = [];

  public function getHand(){
    return $this->hand;
  }
  // The getHand function provides encapsulation and returns instance variable hand.

  public function obtainCard($card){
    array_push($this->hand, $card); 
  }
  // The obtainCard method recieves a single argument(card) and adds it to the instance variable hand.
}